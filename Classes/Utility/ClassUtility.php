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

namespace GoogleMapsPHP\Utility;

/**
 * ClassUtility class.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class ClassUtility {

	/**
	 * @var array $singletonInstances
	 */
	static protected $singletonInstances;

	/**
	 * Create an instance of an class or return it if it's declared as SingletonInterface.
	 *
	 * @param string $className
	 * @param array $arguments
	 * @return mixed
	 * @throws \GoogleMapsPHP\InvalidArgumentException
	 */
	static public function makeInstance($className) {

		if (!is_string($className) || empty($className)) {
			throw new \GoogleMapsPHP\Exceptions\InvalidArgumentException(sprintf('Class "%s" must be a non empty string.', $className), 1369925720);
		}

		$className = '\\' . ltrim($className, '\\');

		if (class_exists($className) === FALSE) {
			throw new \GoogleMapsPHP\Exceptions\InvalidArgumentException(sprintf('Class "%s" not exists.', $className), 1369764749);
		}

		// Return singleton instance if it is already registered.
		if (isset(self::$singletonInstances[$className])) {
			return self::$singletonInstances[$className];
		}

		// Create new instance and call constructor with parameters.
		if (func_num_args() > 1) {
			$arguments = func_get_args();
			array_shift($arguments);
			$reflectedClass = new \ReflectionClass($className);
			$instance = $reflectedClass->newInstanceArgs($arguments);
		} else {
			$instance = new $className();
		}

		// Initialize object if method exists.
		if (self::methodExists($instance, 'initializeObject')) {
			call_user_func(array($instance, 'initializeObject'));
		}

		// Register new singleton instance.
		if ($instance instanceof \GoogleMapsPHP\Object\SingletonInterface) {
			self::$singletonInstances[$className] = $instance;
		}

		return $instance;
	}

	/**
	 * Match the values of an array to an object.
	 *
	 * @param mixed $object
	 * @param array $options
	 * @return void
	 */
	static public function setPropertiesFromArray($object, array $options) {
		foreach ($options as $optionName => &$optionsValue) {
			self::setProperty($object, $optionName, $optionsValue);
		}
	}

	/**
	 * Set object property.
	 *
	 * @param mixed $object
	 * @param mixed $propertyName
	 * @param mixed $propertyValue
	 * @return void
	 * @throws \GoogleMapsPHP\InvalidPropertyException
	 */
	static public function setProperty($object, $propertyName, $propertyValue) {

		$setterName = 'set' . ucfirst($propertyName);
		if (self::methodExists($object, $setterName, FALSE) === FALSE) {
			throw new \GoogleMapsPHP\Exceptions\InvalidPropertyException(sprintf('Property "%s" of class "%s" can not be set.', $propertyName, get_class($object)), 1369488120);
		}

		call_user_func(array($object, $setterName), $propertyValue);
	}

	/**
	 * Check if a property exists.
	 *
	 * @param mixed $object
	 * @param mixed $propertyName
	 * @return void
	 */
	static public function propertyExists($object, $propertyName) {

		$getterName = 'get' . ucfirst($propertyName);
		if (self::methodExists($object, $getterName, FALSE) === FALSE) {
			$getterName = 'is' . ucfirst($propertyName);
			if (self::methodExists($object, $getterName, FALSE) === FALSE) {
				return FALSE;
			}
		}

		$setterName = 'set' . ucfirst($propertyName);
		if (self::methodExists($object, $setterName, FALSE) === FALSE) {
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * Unset a property.
	 *
	 * @param mixed $object
	 * @param mixed $propertyName
	 * @return void
	 * @throws \GoogleMapsPHP\InvalidPropertyException
	 */
	static public function unsetProperty($object, $propertyName) {

		$setterName = 'set' . ucfirst($propertyName);
		if (self::methodExists($object, $setterName, FALSE) === FALSE) {
			throw new \GoogleMapsPHP\Exceptions\InvalidPropertyException(sprintf('Property "%s" of class "%s" can not be set.', $propertyName, get_class($object)), 1369488120);
		}

		call_user_func(array($object, $setterName), NULL);
	}

	/**
	 * Get a property's value.
	 *
	 * @param mixed $object
	 * @param mixed $propertyName
	 * @return string
	 * @throws \GoogleMapsPHP\InvalidPropertyException
	 */
	static public function getProperty($object, $propertyName) {

		$getterName = 'get' . ucfirst($propertyName);
		if (self::methodExists($object, $getterName, FALSE) === FALSE) {
			$getterName = 'is' . ucfirst($propertyName);
			if (self::methodExists($object, $getterName, FALSE) === FALSE) {
				throw new \GoogleMapsPHP\Exceptions\InvalidPropertyException(sprintf('Property "%s" of class "%s" dosn\'t exists.', $propertyName, get_class($object)), 1369488121);
			}
		}

		return call_user_func(array($object, $getterName));
	}

	/**
	 * Check if a method exists.
	 *
	 * @param mixed $object
	 * @param string $methodName
	 * @param boolean $strict
	 * @return void
	 */
	static public function methodExists($object, $methodName, $strict = TRUE) {
		if ($strict) {
			return (method_exists($object, $methodName) && is_callable(array($object, $methodName)));
		} else {
			return is_callable(array($object, $methodName));
		}
	}

	/**
	 * Call a method of an object.
	 *
	 * @param array $callback
	 * @param array $arguments
	 * @return void
	 * @throws \GoogleMapsPHP\InvalidMethodException
	 */
	static public function callMethod($callback, $arguments) {
		if (self::methodExists($callback[0], $callback[1]) === FALSE) {
			throw new \GoogleMapsPHP\Exceptions\InvalidMethodException(sprintf('Method "%s" of class "%s" dosn\'t exists.', $callback[1], get_class($callback[0])), 1369488221);
		}
		return call_user_func_array($callback, $arguments);
	}

}

?>