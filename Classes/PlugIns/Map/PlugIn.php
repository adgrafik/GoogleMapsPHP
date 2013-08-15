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

namespace AdGrafik\GoogleMapsPHP\PlugIns\Map;

/**
 * Plug-in class for GoogleMapsPHP initial options.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class PlugIn extends \AdGrafik\GoogleMapsPHP\PlugIns\AbstractPlugIn {

	/**
	 * @var boolean $fitBoundsOnLoad
	 */
	public $fitBoundsOnLoad;

	/**
	 * @var boolean $closeAllInfoWindowsOnMapClick
	 */
	public $closeAllInfoWindowsOnMapClick;

	/**
	 * Set fitBoundsOnLoad
	 *
	 * @param boolean $fitBoundsOnLoad
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\Map\PlugIn
	 */
	public function setFitBoundsOnLoad($fitBoundsOnLoad) {
		$this->fitBoundsOnLoad = (boolean) $fitBoundsOnLoad;
		return $this;
	}

	/**
	 * Get fitBoundsOnLoad
	 *
	 * @return boolean
	 */
	public function isFitBoundsOnLoad() {
		return $this->fitBoundsOnLoad;
	}

	/**
	 * Set closeAllInfoWindowsOnMapClick
	 *
	 * @param boolean $closeAllInfoWindowsOnMapClick
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\Map\PlugIn
	 */
	public function setCloseAllInfoWindowsOnMapClick($closeAllInfoWindowsOnMapClick) {
		$this->closeAllInfoWindowsOnMapClick = (boolean) $closeAllInfoWindowsOnMapClick;
		return $this;
	}

	/**
	 * Get closeAllInfoWindowsOnMapClick
	 *
	 * @return boolean
	 */
	public function isCloseAllInfoWindowsOnMapClick() {
		return $this->closeAllInfoWindowsOnMapClick;
	}

}

?>