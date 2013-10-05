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

namespace AdGrafik\GoogleMapsPHP;

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * This class initialize the MapBuilder and manage the JSON output.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 * @api
 */
class PlugInProvider extends \AdGrafik\GoogleMapsPHP\MapBuilder\AbstractMapBuilder {

	/**
	 * @var \AdGrafik\GoogleMapsPHP\API\Base\LatLngBounds $bounds
	 */
	protected $bounds;

	/**
	 * @var boolean $viewportManagement
	 */
	protected $viewportManagement;

	/**
	 * initializeObject
	 *
	 * @return void
	 */
	public function initializeObject() {

		$this->setView(ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\View\\Json'));

		if (GMP_XHR && get_class($this) === get_class()) {

			// Register error handler if current object is this class.
			set_error_handler(array(
				$this->getSettings()->get('plugInProvider.errorHandler.className'),
				$this->getSettings()->get('plugInProvider.errorHandler.methodName'),
			));

			set_exception_handler(array(
				$this->getSettings()->get('plugInProvider.exceptionHandler.className'),
				$this->getSettings()->get('plugInProvider.exceptionHandler.methodName'),
			));

		}

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
	 * @throws \AdGrafik\GoogleMapsPHP\Exceptions\ErrorException
	 */
	static public function errorHandler($number, $message, $file, $line) {
		throw new \AdGrafik\GoogleMapsPHP\Exceptions\ErrorException($message, 0, $number, $file, $line);
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

		$this->getView()->getJson()
			->setStatus(\AdGrafik\GoogleMapsPHP\View\Json::JSON_STATUS_ERROR)
			->setMessage($severity . PHP_EOL . $exception->getMessage() . ' in ' . $exception->getFile() . ' on line ' . $exception->getLine() . PHP_EOL . $exception->getTraceAsString());

		$this->getView()->printView();
	}

	/**
	 * Set bounds
	 *
	 * @param mixed $bounds
	 * @param mixed $northEast
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface
	 */
	public function setBounds($bounds) {

		if ($bounds instanceof \AdGrafik\GoogleMapsPHP\API\Base\LatLngBounds === FALSE) {
			$bounds = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Base\\LatLngBounds', $bounds);
		}

		$this->bounds = $bounds;

		return $this;
	}

	/**
	 * Get bounds
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Base\LatLngBounds
	 */
	public function getBounds() {
		return $this->bounds;
	}

	/**
	 * Set viewportManagement
	 *
	 * @param boolean $viewportManagement
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface
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
	 * printJavaScriptJsonObject
	 *
	 * @return string
	 */
	public function printJavaScriptJsonObject() {

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

		return parent::printJavaScriptJsonObject();
	}


	/**
	 * sendJson
	 *
	 * @return string
	 */
	public function sendJson() {
		$this->getView()
			->setData($this->printJavaScriptJsonObject())
			->printView();
	}

	/**
	 * __toString
	 *
	 * @return string
	 */
	public function __toString() {

		try {
			$html = $this->sendJson();
		} catch (\Exception $exception) {
			$html = (string) $exception;
		}

		return $html;
	}

}

?>