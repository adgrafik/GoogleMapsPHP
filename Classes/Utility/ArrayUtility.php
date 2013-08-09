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
 * ArrayUtility class.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class ArrayUtility {

	/**
	 * setValueByObjectPath
	 *
	 * @param array &$reference
	 * @param string $key
	 * @param mixed $value
	 * @return void
	 */
	static public function setValueByObjectPath(array &$reference, $key, $value) {

		$key = strpos($key, '.')
			? explode('.', $key)
			: array($key);

		$array = &$reference;
		for ($i = 0; $i < count($key); $i++) {
			if (array_key_exists($key[$i], $array)) {
				if (is_array($array[$key[$i]])) {
					$array = &$array[$key[$i]];
				} else {
					$array[$key[$i]] = $value;
				}
			}
		}
	}

	/**
	 * getValueByObjectPath
	 *
	 * @param array &$reference
	 * @param string $key
	 * @return void
	 */
	static public function getValueByObjectPath(array &$reference, $key) {

		$key = strpos($key, '.')
			? explode('.', $key)
			: array($key);

		$array = &$reference;
		for ($i = 0; $i < count($key); $i++) {
			if (array_key_exists($key[$i], $array)) {
				if (is_array($array[$key[$i]]) && $i != (count($key) - 1)) {
					$array = &$array[$key[$i]];
				} else {
					return $array[$key[$i]];
				}
			}
		}

		return NULL;
	}

	/**
	 * TODO: Is ArrayUtility::arrayMerge needed?
	 *
	 * @param mixed $array1
	 * @param mixed $array2
	 * @return mixed
	 * @throws \GoogleMapsPHP\InvalidArgumentException
	 */
	static public function arrayMerge($array1, $array2) {

		$arrays = func_get_args();
		foreach ($arrays as $key => &$array) {
			if (is_array($array) === FALSE && $array instanceof \Traversable === FALSE && $array instanceof \ArrayAccess === FALSE) {
				throw new \GoogleMapsPHP\Exceptions\InvalidArgumentException(sprintf('\\GoogleMapsPHP\\Utility\ArrayUtility::arrayMerge: Argument #%s is not an array in', $key + 1), 1369925720);
			}
		}
		foreach ($array1 as $key => &$value) {
			if (isset($array2[$key]) && $array2[$key]) {
				$array1[$key] = $array2[$key];
			}
		}

		return $array1;
	}

}

?>