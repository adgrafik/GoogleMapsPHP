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

namespace AdGrafik\GoogleMapsPHP\API\Overlays;

/**
 * API equivalent to google.maps.PolylineOptions.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class PolylineOptions extends \AdGrafik\GoogleMapsPHP\Object\PropertyArrayAccess {

	/**
	 * @var boolean $fixedRotation
	 */
	public $fixedRotation;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\API\Overlays\Symbol $icon
	 */
	public $icon;

	/**
	 * @var string $offset
	 */
	public $offset;

	/**
	 * @var string $repeat
	 */
	public $repeat;

	/**
	 * Set fixedRotation
	 *
	 * @param boolean $fixedRotation
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\PolylineOptions
	 */
	public function setFixedRotation($fixedRotation) {
		$this->fixedRotation = (boolean) $fixedRotation;
		return $this;
	}

	/**
	 * Get fixedRotation
	 *
	 * @return boolean
	 */
	public function isFixedRotation() {
		return $this->fixedRotation;
	}

	/**
	 * Set icon
	 *
	 * @param \AdGrafik\GoogleMapsPHP\API\Overlays\Symbol $icon
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\PolylineOptions
	 */
	public function setIcon(\AdGrafik\GoogleMapsPHP\API\Overlays\Symbol $icon) {
		$this->icon = $icon;
		return $this;
	}

	/**
	 * Get icon
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\Symbol
	 */
	public function getIcon() {
		return $this->icon;
	}

	/**
	 * Set offset
	 *
	 * @param string $offset
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\PolylineOptions
	 */
	public function setOffset($offset) {
		$this->offset = $offset;
		return $this;
	}

	/**
	 * Get offset
	 *
	 * @return string
	 */
	public function getOffset() {
		return $this->offset;
	}

	/**
	 * Set repeat
	 *
	 * @param string $repeat
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\PolylineOptions
	 */
	public function setRepeat($repeat) {
		$this->repeat = $repeat;
		return $this;
	}

	/**
	 * Get repeat
	 *
	 * @return string
	 */
	public function getRepeat() {
		return $this->repeat;
	}

}

?>