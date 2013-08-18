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

namespace AdGrafik\GoogleMapsPHP\Core;

/**
 * ClassLoader class.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class ClassLoader implements \AdGrafik\GoogleMapsPHP\Object\SingletonInterface {

	/**
	 * @var array $autoloadFiles
	 */
	protected static $autoloadFiles;

	/**
	 * registerAutoloader
	 *
	 * @return boolean
	 */
	public static function registerAutoloader() {
		self::$autoloadFiles = (array) include_once(GMP_PATH . 'GoogleMapsPHP/Configuration/Autoload.php');
		return spl_autoload_register(__CLASS__ . '::autoload');
	}

	/**
	 * unregisterAutoloader
	 *
	 * @return boolean
	 */
	public static function unregisterAutoloader() {
		return spl_autoload_unregister(__CLASS__ . '::autoload');
	}

	/**
	 * autoload
	 *
	 * @param string $className
	 * @return void
	 */
	public static function autoload($className) {

		if (array_key_exists($className, self::$autoloadFiles)) {
			$classPathAndFilename = self::$autoloadFiles[$className];
		} else {
			$classPathAndFilename = str_replace('\\', '/', $className);
			$classPathAndFilename = str_replace('AdGrafik/GoogleMapsPHP/', 'GoogleMapsPHP/Classes/', $classPathAndFilename);
			$classPathAndFilename = GMP_PATH . $classPathAndFilename . '.php';
		}

		if (is_file($classPathAndFilename)) {
			require_once($classPathAndFilename);
		}
	}
}

?>