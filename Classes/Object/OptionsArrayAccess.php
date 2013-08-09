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

namespace GoogleMapsPHP\Object;

use GoogleMapsPHP\Utility\ClassUtility;

/**
 * OptionsArrayAccess class.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class OptionsArrayAccess implements \ArrayAccess, \Iterator, \Countable {

	/**
	 * @var array $_arrayAccessProperties
	 */
	private $_arrayAccessProperties;

	/**
	 * @var integer $_arrayAccessPosition
	 */
	private $_arrayAccessPosition;

	/**
	 * initializeObject
	 */
	public function initializeObject() {

		$this->_arrayAccessProperties = array();
		$this->_arrayAccessPosition = 0;

		$reflectionClass = new \ReflectionClass($this->getOptions());
		$reflectionProperties = $reflectionClass->getProperties();
		foreach ($reflectionProperties as &$reflectionProperty) {
			$propertyName = $reflectionProperty->getName();
			if ($propertyName == '_arrayAccessProperties' || $propertyName == '_arrayAccessPosition') {
				continue;
			}
			if (ClassUtility::propertyExists($this, $propertyName)) {
				$this->_arrayAccessProperties[] = $propertyName;
			}
		}
	}

	/**
	 * ArrayAccess
	 *
	 * @param mixed $propertyName
	 * @param mixed $propertyValue
	 * @return void
	 */
	public function offsetSet($propertyName, $propertyValue) {
		ClassUtility::setProperty($this->options, $propertyName, $propertyValue);
	}

	/**
	 * ArrayAccess
	 *
	 * @param mixed $propertyName
	 * @return boolean
	 */
	public function offsetExists($propertyName) {
		return ClassUtility::propertyExists($this->options, $propertyName);
		return isset($this->_arrayAccessProperties[$propertyName]);
	}

	/**
	 * ArrayAccess
	 *
	 * @param mixed $propertyName
	 * @return void
	 */
	public function offsetUnset($propertyName) {
		ClassUtility::unsetProperty($this->options, $propertyName);
	}

	/**
	 * ArrayAccess
	 *
	 * @param mixed $propertyName
	 * @return mixed
	 */
	public function offsetGet($propertyName) {
		return ClassUtility::getProperty($this->options, $propertyName);
	}

	/**
	 * Iterator
	 *
	 * @return void
	 */
	public function rewind() {
        $this->_arrayAccessPosition = 0;
    }

    /**
	 * Iterator
	 *
	 * @return mixed
	 */
	public function current() {
		return ClassUtility::getProperty($this->options, $this->_arrayAccessProperties[$this->_arrayAccessPosition]);
    }

    /**
	 * Iterator
	 *
	 * @return integer
	 */
	public function key() {
        return $this->_arrayAccessProperties[$this->_arrayAccessPosition];
    }

    /**
	 * Iterator
	 *
	 * @return void
	 */
	public function next() {
        ++$this->_arrayAccessPosition;
    }

    /**
	 * Iterator
	 *
	 * @return boolean
	 */
	public function valid() {
		return isset($this->_arrayAccessProperties[$this->_arrayAccessPosition]);
    }

    /**
	 * Countable
	 *
	 * @return integer
	 */
	public function count() {
		return count($this->_arrayAccessProperties);
    }

	/**
	 * Overload __call
	 *
	 * @param string $methodName
	 * @param array $arguments
	 * @return mixed
	 * @throws \GoogleMapsPHP\Exceptions\InvalidMethodException
	 */
	public function __call($methodName, $arguments) {
		if (ClassUtility::methodExists($this->options, $methodName, FALSE) === FALSE) {
			throw new \GoogleMapsPHP\Exceptions\InvalidMethodException(sprintf('Method "%s" not exists.', $methodName), 1369563744);
		}
		return call_user_func_array(array($this->options, $methodName), $arguments);
	}

}

?>