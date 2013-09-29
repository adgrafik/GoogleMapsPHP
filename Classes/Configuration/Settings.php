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
class Settings implements \ArrayAccess, \Iterator, \Countable, \AdGrafik\GoogleMapsPHP\Object\SingletonInterface {

	/**
	 * @var array $settings
	 */
	protected $settings;

	/**
	 * @var integer $_arrayAccessPosition
	 */
	private $_arrayAccessPosition;

	/**
	 * Constructor
	 */
	public function __construct() {
		$settings = (array) \Symfony\Component\Yaml\Yaml::parse(GMP_PATH . 'Configuration/Settings.yml');
		$this->setSettings($settings);
		$this->_arrayAccessPosition = 0;
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
		$value = \AdGrafik\GoogleMapsPHP\Utility\ArrayUtility::getValueByObjectPath($this->settings, $key);
		return is_array($value)
			? $this->parseClassConstants($value)
			: $value;
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

	/**
	 * parseClassConstants
	 *
	 * @param mixed $needle
	 * @param array $haystack
	 * @param boolean $strict
	 * @return boolean
	 */
	protected function parseClassConstants(array $array) {
		foreach ($array as $key => &$value) {
			if (is_array($value)) {
				$array[$key] = $this->parseClassConstants($value);
			} else if (is_string($value) && strpos($value, '::') && defined($value)) {
				$array[$key] = constant($value);
			}
		}
		return $array;
	}

	/**
	 * ArrayAccess
	 *
	 * @param mixed $propertyName
	 * @param mixed $propertyValue
	 * @return void
	 */
	public function offsetSet($propertyName, $propertyValue) {
		$this->settings[$propertyName] = $propertyValue;
	}

	/**
	 * ArrayAccess
	 *
	 * @param mixed $propertyName
	 * @return boolean
	 */
	public function offsetExists($propertyName) {
		return isset($this->settings[$propertyName]);
	}

	/**
	 * ArrayAccess
	 *
	 * @param mixed $propertyName
	 * @return void
	 */
	public function offsetUnset($propertyName) {
		unset($this->settings[$propertyName]);
	}

	/**
	 * ArrayAccess
	 *
	 * @param mixed $propertyName
	 * @return mixed
	 */
	public function &offsetGet($propertyName) {
		return $this->settings[$propertyName];
	}

	/**
	 * Iterator
	 *
	 * @return void
	 */
	public function rewind() {
        reset($this->settings);
		$this->_arrayAccessPosition = key($this->settings);
    }

    /**
	 * Iterator
	 *
	 * @return mixed
	 */
	public function current() {
		return current($this->settings);
    }

    /**
	 * Iterator
	 *
	 * @return integer
	 */
	public function key() {
        return key($this->settings);
    }

    /**
	 * Iterator
	 *
	 * @return void
	 */
	public function next() {
        next($this->settings);
		$this->_arrayAccessPosition = key($this->settings);
    }

    /**
	 * Iterator
	 *
	 * @return boolean
	 */
	public function valid() {
		return isset($this->settings[$this->_arrayAccessPosition]);
    }

    /**
	 * Countable
	 *
	 * @return integer
	 */
	public function count() {
		return count($this->settings);
    }

}

?>