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

namespace AdGrafik\GoogleMapsPHP\MapBuilder;

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * MapBuilderInterface.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
abstract class AbstractMapBuilder implements \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface {

	/**
	 * @var integer $mapIdCount
	 */
	static protected $mapIdCount = 0;

	/**
	 * @var array $registeredMapIds
	 */
	static protected $registeredMapIds = array();

	/**
	 * @var \AdGrafik\GoogleMapsPHP\Configuration\Settings $settings
	 */
	protected $settings;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\View\ViewInterface $view
	 */
	protected $view;

	/**
	 * @var string $mapId
	 */
	protected $mapId;

	/**
	 * @var array $mapOptions
	 */
	protected $mapOptions;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\MapBuilder\JsonObject $jsonObject
	 */
	protected $jsonObject;

	/**
	 * Constructor
	 * MapBuilder( [$mapId] [, $options] );
	 *
	 * @param mixed $mapId
	 * @param mixed $options Can be an object of type \AdGrafik\GoogleMapsPHP\API\Map\MapOptions or an map options array.
	 */
	public function __construct($mapId = '', $options = array()) {

		$arguments = func_get_args();
		if (is_array($mapId) || $mapId instanceof \AdGrafik\GoogleMapsPHP\Object\OptionsArrayAccess) {
			$options = $mapId;
			$mapId = 'map' . ++self::$mapIdCount;
		} else if ($mapId == '') {
			$mapId = 'map' . ++self::$mapIdCount;
		}

		// Get AJAX request
		if (isset($_REQUEST['mapId'])) {
			$mapId = $_REQUEST['mapId'];
		}

		$this->registerMapId($mapId);
		$this->setMapId($mapId);
		$this->setMapOptions($options);

		$this->setSettings(ClassUtility::makeInstance('AdGrafik\GoogleMapsPHP\Configuration\Settings'));
		$this->setJsonObject(ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\MapBuilder\\JsonObject'));
	}

	/**
	 * Set settings
	 *
	 * @param \AdGrafik\GoogleMapsPHP\Configuration\Settings $settings
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface
	 */
	public function setSettings(\AdGrafik\GoogleMapsPHP\Configuration\Settings $settings) {
		$this->settings = $settings;
		return $this;
	}

	/**
	 * Get settings
	 *
	 * @return \AdGrafik\GoogleMapsPHP\Configuration\Settings
	 */
	public function getSettings() {
		return $this->settings;
	}

	/**
	 * Set view
	 *
	 * @param \AdGrafik\GoogleMapsPHP\View\Document $view
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface
	 */
	public function setView(\AdGrafik\GoogleMapsPHP\View\ViewInterface $view) {
		$this->view = $view;
		return $this;
	}

	/**
	 * Get view
	 *
	 * @return \AdGrafik\GoogleMapsPHP\View\ViewInterface
	 */
	public function getView() {
		return $this->view;
	}

	/**
	 * Set mapId
	 *
	 * @param string $mapId
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface
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
	 * Set mapOptions
	 *
	 * @param array $mapOptions
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface
	 */
	public function setMapOptions(array $mapOptions) {
		$this->mapOptions = $mapOptions;
		return $this;
	}

	/**
	 * Get mapOptions
	 *
	 * @return array
	 */
	public function getMapOptions() {
		return $this->mapOptions;
	}

	/**
	 * Set jsonObject
	 *
	 * @param \AdGrafik\GoogleMapsPHP\MapBuilder\JsonObject $jsonObject
	 * @return \AdGrafik\GoogleMapsPHP\PlugInProvider
	 */
	public function setJsonObject(\AdGrafik\GoogleMapsPHP\MapBuilder\JsonObject $jsonObject) {
		$this->jsonObject = $jsonObject;
		return $this;
	}

	/**
	 * Get jsonObject
	 *
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\JsonObject
	 */
	public function getJsonObject() {
		return $this->jsonObject;
	}

	/**
	 * Add a plug-in.
	 *
	 * @param string|array|\AdGrafik\GoogleMapsPHP\PlugIns\PlugInInterface $plugInBuilderName
	 * @param array [$options]
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface
	 * @throws \AdGrafik\GoogleMapsPHP\Exceptions\InvalidArgumentException
	 */
	public function add($plugInBuilderName) {

		// If $plugInBuilderName is array add every item, else if is already 
		// an instance of PlugInInterface, add it directly to the JsonObject.
		if (is_array($plugInBuilderName)) {
			foreach ($plugInBuilderName as &$options) {
				ClassUtility::callMethod(array($this, 'add'), $options);
			}
			return $this;
		} else if ($plugInBuilderName instanceof \AdGrafik\GoogleMapsPHP\PlugIns\PlugInInterface) {
			$this->getJsonObject()->addPlugIn($plugInBuilderName);
			return $this;
		}

		if (($plugInBuilderSettings = $this->getSettings()->get('plugInBuilder.' . $plugInBuilderName)) === NULL) {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\InvalidArgumentException(sprintf('Plug-in builder "%s" is not registered.', $plugInBuilderName), 1371909752);
		}

		$arguments = func_get_args();
		array_shift($arguments);

		// Set default options.
		if (isset($plugInBuilderSettings['arguments'])) {
			foreach ($arguments as $key => &$argument) {
				if (is_array($argument) && array_key_exists($key, $plugInBuilderSettings['arguments'])) {
					$argument = array_replace_recursive($plugInBuilderSettings['arguments'][$key], $argument);
				}
			}
		}

		$plugInBuilder = ClassUtility::makeInstance($plugInBuilderSettings['className'], $this, $plugInBuilderSettings);
		ClassUtility::callMethod(array($plugInBuilder, 'build'), $arguments);

		return $this;
	}

	/**
	 * Set debug
	 *
	 * @param boolean $debug
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface
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
	 * printJavaScriptJsonObject
	 *
	 * @return string
	 */
	public function printJavaScriptJsonObject() {

		$options = 0;
		if ($this->isDebug() && defined('JSON_PRETTY_PRINT')) {
			$options = $options | JSON_PRETTY_PRINT;
		}

		$this->getJsonObject()->setDebug($this->isDebug());
		$json = json_encode($this->getJsonObject(), $options);

		if ($this->isDebug() && defined('JSON_PRETTY_PRINT') === FALSE) {
			$json = \AdGrafik\GoogleMapsPHP\Utility\JsonUtility::prettify($json);
		}

		// Remove all NULL values to reduce output length.
		$json = preg_replace('/[\t\s]*"[^"]*":\s*null,?/', '', $json);

		return $json;
	}

	/**
	 * registerMapId
	 *
	 * @param string $mapId
	 * @return void
	 * @throws \AdGrafik\GoogleMapsPHP\Exceptions\InvalidArgumentException
	 */
	protected function registerMapId($mapId) {
		if (in_array($mapId, self::$registeredMapIds)) {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\InvalidArgumentException(sprintf('Given UID "%s" is already used.', $mapId), 1370096543);
		}
		self::$registeredMapIds[] = $mapId;
	}

}

?>