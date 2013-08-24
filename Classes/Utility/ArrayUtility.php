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

namespace AdGrafik\GoogleMapsPHP\Utility;

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

		if ($key === NULL) {
			$reference = array_replace_recursive($reference, $value);
			return;
		}

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
			} else {
				if ($i == (count($key) - 1)) {
					$array[$key[$i]] = $value;
				} else {
					$array[$key[$i]] = array();
					$array = &$array[$key[$i]];
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

}

?>