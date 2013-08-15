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

namespace AdGrafik\GoogleMapsPHP\Configuration;

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * Settings class.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class Settings implements \AdGrafik\GoogleMapsPHP\Object\SingletonInterface {

	/**
	 * @var array $settings
	 */
	protected $settings;

	/**
	 * Constructor
	 */
	public function __construct() {
		$settings = (array) \Symfony\Component\Yaml\Yaml::parse(GMP_PATH . 'GoogleMapsPHP/Configuration/Settings.yml');
		$this->setSettings($settings);
	}

	/**
	 * Set settings
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return \AdGrafik\GoogleMapsPHP\Configuration\Settings
	 */
	public function set($key, $value) {
		\AdGrafik\GoogleMapsPHP\Utility\ArrayUtility::setValueByObjectPath($this->settings, $key, $value);
		return $this;
	}

	/**
	 * Get settings
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function get($key) {
		return \AdGrafik\GoogleMapsPHP\Utility\ArrayUtility::getValueByObjectPath($this->settings, $key);
	}

	/**
	 * Set settings
	 *
	 * @param array $settings
	 * @return \AdGrafik\GoogleMapsPHP\Configuration\Settings
	 */
	public function setSettings(array $settings) {
		$this->settings = $settings;
		return $this;
	}

	/**
	 * Get settings
	 *
	 * @return array
	 */
	public function getSettings() {
		return $this->settings;
	}

}

?>