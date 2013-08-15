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

namespace AdGrafik\GoogleMapsPHP\MapBuilder;

/**
 * JsonObject class.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class JsonObject {

	/**
	 * @var boolean $debug
	 */
	public $debug;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\PlugIns\Map\PlugIn $mapPlugIn
	 */
	public $mapPlugIn;

	/**
	 * @var array $plugIns
	 */
	public $plugIns;

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	/**
	 * Set debug
	 *
	 * @param boolean $debug
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\JsonObject
	 */
	public function setDebug($debug) {
		$this->debug = (boolean) $debug;
		return $this;
	}

	/**
	 * Set mapPlugIn
	 *
	 * @param \AdGrafik\GoogleMapsPHP\PlugIns\Map\PlugIn $mapPlugIn
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\JsonObject
	 */
	public function setMapPlugIn(\AdGrafik\GoogleMapsPHP\PlugIns\Map\PlugIn $mapPlugIn) {
		$this->mapPlugIn = $mapPlugIn;
		return $this;
	}

	/**
	 * Get mapPlugIn
	 *
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\Map
	 */
	public function getMapPlugIn() {
		return $this->mapPlugIn;
	}

	/**
	 * Set plugIns
	 *
	 * @param array $plugIns
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\JsonObject
	 */
	public function setPlugIns(array $plugIns) {
		$this->plugIns = $plugIns;
		return $this;
	}

	/**
	 * Add plugIn
	 *
	 * @param \AdGrafik\GoogleMapsPHP\PlugIns\PlugInInterface $plugIn
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\JsonObject
	 */
	public function addPlugIn(\AdGrafik\GoogleMapsPHP\PlugIns\PlugInInterface $plugIn) {
		$this->plugIns[] = $plugIn;
		return $this;
	}

	/**
	 * Get plugIns
	 *
	 * @return array
	 */
	public function getPlugIns() {
		return $this->plugIns;
	}

	/**
	 * Get plugIn by ID
	 *
	 * @param integer $id
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\PlugInInterface
	 */
	public function findPlugInById($id) {

		if ($this->plugIns === NULL) {
			return NULL;	
		}

		foreach ($this->plugIns as &$plugIn) {
			if ($plugIn->getId() == $id) {
				return $plugIn;
			}
		}

		return NULL;
	}

}

?>