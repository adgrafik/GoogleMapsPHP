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
	protected $autoloadFiles;

	/**
	 * Constructor
	 */
	public function __construct() {
		spl_autoload_register(array($this, 'autoload'));
		$this->autoloadFiles = (array) include_once(GMP_PATH . 'GoogleMapsPHP/Configuration/Autoload.php');
	}

	/**
	 * Autoloader
	 *
	 * @param string $className
	 * @return void
	 * @throws \AdGrafik\GoogleMapsPHP\ClassNotFoundException
	 */
	public function autoload($className) {

		if (array_key_exists($className, $this->autoloadFiles)) {
			$classPathAndFilename = $this->autoloadFiles[$className];
		} else {
			$classPathAndFilename = str_replace('\\', '/', $className);
			$classPathAndFilename = str_replace('AdGrafik/GoogleMapsPHP/', 'GoogleMapsPHP/Classes/', $classPathAndFilename);
			$classPathAndFilename = GMP_PATH . $classPathAndFilename . '.php';
		}

		if (!is_file($classPathAndFilename)) {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\ClassNotFoundException(sprintf('Class %s not found.', $className), 1369478990);
		}

		include_once($classPathAndFilename);
	}
}

?>