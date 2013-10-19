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
class ExceptionHandler implements \AdGrafik\GoogleMapsPHP\Object\SingletonInterface {

	/**
	 * Constructor.
	 */
	public function __construct($methodName) {
		set_exception_handler(array($this, $methodName));
	}

	/**
	 * exceptionHandler
	 *
	 * @param \Exception $exception
	 * @return void
	 */
	public function exceptionHandler(\Exception $exception) {

		if (error_reporting() == 0) {
			return TRUE;
		}

		if ($exception instanceof \ErrorException) {
			switch($exception->getSeverity()){
				case E_ERROR:				$severity = 'Error';				break;
				case E_WARNING:				$severity = 'Warning';				break;
				case E_PARSE:				$severity = 'Parse Error';			break;
				case E_NOTICE:				$severity = 'Notice';				break;
				case E_CORE_ERROR:			$severity = 'Core Error';			break;
				case E_CORE_WARNING:		$severity = 'Core Warning';			break;
				case E_COMPILE_ERROR:		$severity = 'Compile Error';		break;
				case E_COMPILE_WARNING:		$severity = 'Compile Warning';		break;
				case E_USER_ERROR:			$severity = 'User Error';			break;
				case E_USER_WARNING:		$severity = 'User Warning';			break;
				case E_USER_NOTICE:			$severity = 'User Notice';			break;
				case E_STRICT:				$severity = 'Strict Notice';		break;
				case E_RECOVERABLE_ERROR:	$severity = 'Recoverable Error';	break;
				default:					$severity = 'Unknown error'; 		break;
			}
		} else {
			$severity = 'Exception';
		}

		$json = array(
			'status' => 'error',
			'message' => $severity . PHP_EOL . $exception->getMessage() . ' in ' . $exception->getFile() . ' on line ' . $exception->getLine() . PHP_EOL . $exception->getTraceAsString(),
		);

		$json = json_encode($json);

		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Content-Type: application/json');
		header('Content-Length: ' . strlen($json));

		echo $json;

		exit;
	}

}

?>