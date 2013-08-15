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

namespace AdGrafik\GoogleMapsPHP\API\Layers;

/**
 * API equivalent to google.maps.KmlOptions.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class KmlOptions {

	/**
	 * @var boolean $clickable
	 */
	public $clickable;

	/**
	 * @var boolean $preserveViewport
	 */
	public $preserveViewport;

	/**
	 * @var boolean $suppressInfoWindows
	 */
	public $suppressInfoWindows;

	/**
	 * @var string $url
	 */
	public $url;

	/**
	 * Set clickable
	 *
	 * @param boolean $clickable
	 * @return \AdGrafik\GoogleMapsPHP\API\Layers\KmlOptions
	 */
	public function setClickable($clickable) {
		$this->clickable = (boolean) $clickable;
		return $this;
	}

	/**
	 * Get clickable
	 *
	 * @return boolean
	 */
	public function isClickable() {
		return $this->clickable;
	}

	/**
	 * Set preserveViewport
	 *
	 * @param boolean $preserveViewport
	 * @return \AdGrafik\GoogleMapsPHP\API\Layers\KmlOptions
	 */
	public function setPreserveViewport($preserveViewport) {
		$this->preserveViewport = (boolean) $preserveViewport;
		return $this;
	}

	/**
	 * Get preserveViewport
	 *
	 * @return boolean
	 */
	public function isPreserveViewport() {
		return $this->preserveViewport;
	}

	/**
	 * Set suppressInfoWindows
	 *
	 * @param boolean $suppressInfoWindows
	 * @return \AdGrafik\GoogleMapsPHP\API\Layers\KmlOptions
	 */
	public function setSuppressInfoWindows($suppressInfoWindows) {
		$this->suppressInfoWindows = (boolean) $suppressInfoWindows;
		return $this;
	}

	/**
	 * Get suppressInfoWindows
	 *
	 * @return boolean
	 */
	public function isSuppressInfoWindows() {
		return $this->suppressInfoWindows;
	}

	/**
	 * Set url
	 *
	 * @param string $url
	 * @return \AdGrafik\GoogleMapsPHP\API\Layers\KmlOptions
	 */
	public function setUrl($url) {
		$this->url = $url;
		return $this;
	}

	/**
	 * Get url
	 *
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

}

?>