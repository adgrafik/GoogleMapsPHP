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

namespace AdGrafik\GoogleMapsPHP\View;

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * View class to manage the HTML output.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class Json extends \AdGrafik\GoogleMapsPHP\View\AbstractView {

	const JSON_STATUS_OK = 'ok';
	const JSON_STATUS_ERROR = 'error';

	/**
	 * @var mixed $data
	 */
	public $data;

	/**
	 * Set data
	 *
	 * @param mixed $data
	 * @return \AdGrafik\GoogleMapsPHP\View\Json
	 */
	public function setData($data) {
		$this->data = $data;
		return $this;
	}

	/**
	 * Get data
	 *
	 * @return mixed
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * printView
	 *
	 * @return string
	 */
	public function printView() {

		$json = $this->getData();

		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Content-Type: application/json');
		header('Content-Length: ' . strlen($json));

		echo $json;

		exit;
	}

}

?>