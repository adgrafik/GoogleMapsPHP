<?php

/***************************************************************
 * Copyright notice
 *
 * (c) 2013 Arno Dudek <webmaster@adgrafik.at>
 * All rights reserved
 *
 * This script is part of the GoogleMapsPHP project. An easy to 
 * use Google Maps API for PHP.
 *
 * Commercial use requires one-time purchase of a commercial license 
 * license for every domain. The license can be found at
 * https://github.com/adgrafik/GoogleMapsPHP/blob/master/LICENSE
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

namespace GoogleMapsPHP;

use GoogleMapsPHP\Utility\ClassUtility;

/**
 * This class initialize the MapBuilder and manage the JSON output.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 * @api
 */
class PlugInProvider implements \GoogleMapsPHP\MapBuilder\MapBuilderInterface {

	/**
	 * @var array $registeredMapIds
	 */
	static protected $registeredMapIds = array();

	/**
	 * @var integer $mapIdCount
	 */
	static protected $mapIdCount = 0;

	/**
	 * @var \GoogleMapsPHP\Configuration\Settings $settings
	 */
	protected $settings;

	/**
	 * @var \GoogleMapsPHP\MapBuilder\JsonObject $jsonObject
	 */
	protected $jsonObject;

	/**
	 * @var string $mapId
	 */
	protected $mapId;

	/**
	 * @var array $options
	 */
	protected $options;

	/**
	 * @var \GoogleMapsPHP\API\Base\LatLngBounds $bounds
	 */
	protected $bounds;

	/**
	 * @var boolean $viewportManagement
	 */
	protected $viewportManagement;

	/**
	 * Constructor
	 * MapBuilder( [$mapId] [, $options] );
	 *
	 * @param mixed $mapId
	 * @param mixed $options Can be an object of type \GoogleMapsPHP\API\Map\MapOptions or an map options array.
	 */
	public function __construct($mapId = '', $options = array()) {

		$arguments = func_get_args();
		if (is_array($mapId) || $mapId instanceof \GoogleMapsPHP\Object\OptionsArrayAccess) {
			$options = $mapId;
			$mapId = 'map' . ++self::$mapIdCount;
		} else if ($mapId == '') {
			$mapId = 'map' . ++self::$mapIdCount;
		}

		$this->options = (array) $options;

		$this->setSettings(ClassUtility::makeInstance('\\GoogleMapsPHP\\Configuration\\Settings'));

		// Register error handler if current object is this class.
		if (GMP_XHR && get_class($this) === get_class()) {

			set_error_handler(array(
				$this->getSettings()->get('plugInProvider.errorHandler.className'),
				$this->getSettings()->get('plugInProvider.errorHandler.methodName'),
			));

			set_exception_handler(array(
				$this->getSettings()->get('plugInProvider.exceptionHandler.className'),
				$this->getSettings()->get('plugInProvider.exceptionHandler.methodName'),
			));
		}

		// Get AJAX request
		if (isset($_REQUEST['mapId'])) {
			$mapId = $_REQUEST['mapId'];
		}

		$this->registerMapId($mapId);
		$this->setMapId($mapId);

		$this->setJsonObject(ClassUtility::makeInstance('\\GoogleMapsPHP\\MapBuilder\\JsonObject'));

		if (isset($_REQUEST['bounds'])) {
			$this->setBounds($_REQUEST['bounds']);
		}

		if (isset($_REQUEST['viewportManagement'])) {
			$this->setViewportManagement($_REQUEST['viewportManagement']);
		}
	}

	/**
	 * errorHandler
	 *
	 * @param integer $number
	 * @param string $message
	 * @param string $file
	 * @param integer $line
	 * @return void
	 * @throws \GoogleMapsPHP\Exceptions\ErrorException
	 */
	static public function errorHandler($number, $message, $file, $line) {
		throw new \GoogleMapsPHP\Exceptions\ErrorException($message, 0, $number, $file, $line);
	}

	/**
	 * exceptionHandler
	 *
	 * @param \Exception $exception
	 * @return void
	 */
	static public function exceptionHandler(\Exception $exception) {

		if ($exception instanceof \ErrorException) {
			switch($exception->getSeverity()){
				case E_ERROR:				$severity = 'Error';				break;
				case E_WARNING:				$severity = 'Warning';				break;
				case E_PARSE:				$severity = 'Parse Error';			break;
				case E_NOTICE:				$severity = 'Notice';				break;
				case E_CORE_ERROR:			$severity = 'Core Error';			break;
				case E_CORE_WARNING:		$severity = 'Core Warning';			break;
				case E_COMPILE_ERROR:		$severity = 'Compile Error';		break;
				case E_COMPILE_WARNING:		$severity = 'Compile Warning';		break;
				case E_USER_ERROR:			$severity = 'User Error';			break;
				case E_USER_WARNING:		$severity = 'User Warning';			break;
				case E_USER_NOTICE:			$severity = 'User Notice';			break;
				case E_STRICT:				$severity = 'Strict Notice';		break;
				case E_RECOVERABLE_ERROR:	$severity = 'Recoverable Error';	break;
				default:					$severity = 'Unknown error'; 		break;
			}
		} else {
			$severity = 'Exception';
		}

		$json = array(
			'status' => 'error',
			'message' => $severity . PHP_EOL . $exception->getMessage() . ' in ' . $exception->getFile() . ' on line ' . $exception->getLine() . PHP_EOL . $exception->getTraceAsString(),
		);

		$json = json_encode($json);

		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Content-Type: application/json');
		header('Content-Length: ' . strlen($json));

		echo $json;

		exit;
	}

	/**
	 * Set settings
	 *
	 * @param \GoogleMapsPHP\Configuration\Settings $settings
	 * @return \GoogleMapsPHP\MapBuilder\MapBuilderInterface
	 */
	public function setSettings(\GoogleMapsPHP\Configuration\Settings $settings) {
		$this->settings = $settings;
		return $this;
	}

	/**
	 * Get settings
	 *
	 * @return \GoogleMapsPHP\Configuration\Settings
	 */
	public function getSettings() {
		return $this->settings;
	}

	/**
	 * Set jsonObject
	 *
	 * @param \GoogleMapsPHP\MapBuilder\JsonObject $jsonObject
	 * @return \GoogleMapsPHP\PlugInProvider
	 */
	public function setJsonObject(\GoogleMapsPHP\MapBuilder\JsonObject $jsonObject) {
		$this->jsonObject = $jsonObject;
		return $this;
	}

	/**
	 * Get jsonObject
	 *
	 * @return \GoogleMapsPHP\MapBuilder\JsonObject
	 */
	public function getJsonObject() {
		return $this->jsonObject;
	}

	/**
	 * Set debug
	 *
	 * @param boolean $debug
	 * @return \GoogleMapsPHP\MapBuilder\MapBuilderInterface
	 */
	public function setDebug($debug) {
		$this->getSettings()->set('debug', $debug);
		return $this;
	}

	/**
	 * Get debug
	 *
	 * @return boolean
	 */
	public function isDebug() {
		return $this->getSettings()->get('debug');
	}

	/**
	 * Set mapId
	 *
	 * @param string $mapId
	 * @return \GoogleMapsPHP\MapBuilder\MapBuilderInterface
	 */
	public function setMapId($mapId) {
		$this->mapId = $mapId;
		return $this;
	}

	/**
	 * Get mapId
	 *
	 * @return string
	 */
	public function getMapId() {
		return $this->mapId;
	}

	/**
	 * Set bounds
	 *
	 * @param mixed $bounds
	 * @param mixed $northEast
	 * @return \GoogleMapsPHP\MapBuilder\MapBuilderInterface
	 */
	public function setBounds($bounds) {

		if ($bounds instanceof \GoogleMapsPHP\API\Base\LatLngBounds === FALSE) {
			$bounds = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Base\\LatLngBounds', $bounds);
		}

		$this->bounds = $bounds;

		return $this;
	}

	/**
	 * Get bounds
	 *
	 * @return \GoogleMapsPHP\API\Base\LatLngBounds
	 */
	public function getBounds() {
		return $this->bounds;
	}

	/**
	 * Set viewportManagement
	 *
	 * @param boolean $viewportManagement
	 * @return \GoogleMapsPHP\MapBuilder\MapBuilderInterface
	 */
	public function setViewportManagement($viewportManagement) {
		$this->viewportManagement = (boolean) $viewportManagement;
		return $this;
	}

	/**
	 * Get viewportManagement
	 *
	 * @return boolean
	 */
	public function isViewportManagement() {
		return $this->viewportManagement;
	}

	/**
	 * Add a plug-in.
	 *
	 * @param string|array|\GoogleMapsPHP\PlugIns\PlugInInterface $plugInBuilderName
	 * @param array [$options]
	 * @return \GoogleMapsPHP\MapBuilder\MapBuilderInterface
	 * @throws \GoogleMapsPHP\Exceptions\InvalidArgumentException
	 */
	public function add($plugInBuilderName) {

		// If $plugInBuilderName is array add every item, else if is already 
		// an instance of PlugInInterface, add it directly to the JsonObject.
		if (is_array($plugInBuilderName)) {
			foreach ($plugInBuilderName as &$options) {
				ClassUtility::callMethod(array($this, 'add'), $options);
			}
			return $this;
		} else if ($plugInBuilderName instanceof \GoogleMapsPHP\PlugIns\PlugInInterface) {
			$this->getJsonObject()->addPlugIn($plugInBuilderName);
			return $this;
		}

		if (($plugInBuilder = $this->getSettings()->get('plugInBuilders.' . $plugInBuilderName)) === NULL) {
			throw new \GoogleMapsPHP\Exceptions\InvalidArgumentException(sprintf('Plug-in builder "%s" is not registered.', $plugInBuilderName), 1371909752);
		}

		$arguments = func_get_args();
		array_shift($arguments);

		$plugInBuilder = ClassUtility::makeInstance($plugInBuilder['className'], $this);
		ClassUtility::callMethod(array($plugInBuilder, 'build'), $arguments);

		return $this;
	}

	/**
	 * printJsonObject
	 *
	 * @return string
	 */
	public function printJsonObject() {

		// Don't attach layer if viewport management in use and layer is out of map.
		if ($this->isViewportManagement()) {
			$withinViewport = array();
			$plugIns = $this->getJsonObject()->getPlugIns();
			foreach ($plugIns as $key => &$plugIn) {
				if ($plugIn->isWithinViewport($this->getBounds())) {
					$withinViewport[] = $plugIns[$key];
				}
			}
			$this->getJsonObject()->setPlugIns($withinViewport);
		}

		$options = 0;
		if ($this->isDebug() && defined('JSON_PRETTY_PRINT')) {
			$options = $options | JSON_PRETTY_PRINT;
		}

		$this->getJsonObject()->setDebug($this->isDebug());
		$json = json_encode($this->getJsonObject(), $options);

		if ($this->isDebug() && defined('JSON_PRETTY_PRINT') === FALSE) {
			$json = \GoogleMapsPHP\Utility\JsonUtility::prettify($json);
		}

		// Remove all NULL values to reduce output length.
		$json = preg_replace('/[\t\s]*"[^"]*":\s*null,?/', '', $json);

		return $json;
	}


	/**
	 * printJson
	 *
	 * @return string
	 */
	public function sendJson() {

		$json = $this->printJsonObject();

		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Content-Type: application/json');
		header('Content-Length: ' . strlen($json));

		echo $json;

		exit;
	}

	/**
	 * __toString
	 *
	 * @return string
	 */
	public function __toString() {

		try {
			$html = $this->printJson();
		} catch (\Exception $exception) {
			$html = (string) $exception;
		}

		return $html;
	}

	/**
	 * registerMapId
	 *
	 * @param string $mapId
	 * @return void
	 * @throws \GoogleMapsPHP\Exceptions\InvalidArgumentException
	 */
	protected function registerMapId($mapId) {
		if (in_array($mapId, self::$registeredMapIds)) {
			throw new \GoogleMapsPHP\Exceptions\InvalidArgumentException(sprintf('Given UID "%s" is already used.', $mapId), 1370096543);
		}
		self::$registeredMapIds[] = $mapId;
	}

}

?>