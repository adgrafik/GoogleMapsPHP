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
 * Session class.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class ErrorHandler implements \AdGrafik\GoogleMapsPHP\Object\SingletonInterface {

	/**
	 * Constructor.
	 */
	public function __construct($methodName) {
		set_error_handler(array($this, $methodName));
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
	public function errorHandler($number, $message, $file, $line) {
		throw new \AdGrafik\GoogleMapsPHP\Exceptions\ErrorException($message, 0, $number, $file, $line);
	}

}

?>