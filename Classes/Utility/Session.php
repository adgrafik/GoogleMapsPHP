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
class Session {

	/**
	 * start
	 *
	 * @return void
	 */
	static public function start() {

		// Start session only if no one exists.
		if (!session_id()) {
			session_name('GMPHP');
			session_start();
			$_SESSION['GMPHP'] = array();
		}
	}

	/**
	 * set
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return void
	 */
	static public function set($key, $value) {
		$_SESSION['GMPHP'][$key] = $value;
	}

	/**
	 * get
	 *
	 * @param string $key
	 * @return mixed
	 */
	static public function get($key) {
		return array_key_exists($key, $_SESSION['GMPHP'])
			? $_SESSION['GMPHP'][$key]
			: NULL;
	}

}

?>