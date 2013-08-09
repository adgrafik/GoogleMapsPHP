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

namespace GoogleMapsPHP\Core;

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];

// Define constants
define('GMP_VERSION', '1.0.0-beta');
define('GMP_PATH', str_replace('GoogleMapsPHP/Classes/Core/Bootstrap.php', '', __FILE__));
define('GMP_DIR', ltrim(str_replace($_SERVER['DOCUMENT_ROOT'], '', GMP_PATH), '/'));
define('GMP_HTTP', $protocol.$host . '/');
define('GMP_HTTP_PATH', GMP_HTTP . GMP_DIR);
define('GMP_XHR', (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'));

// Include autoloader
include_once(GMP_PATH . 'GoogleMapsPHP/Classes/Object/SingletonInterface.php');

// Register class loader.
if (defined('GMP_LOADER') === FALSE || GMP_LOADER === FALSE) {
	include_once(GMP_PATH . 'GoogleMapsPHP/Classes/Core/ClassLoader.php');
	$classLoader = new ClassLoader();
}

?>