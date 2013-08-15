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

namespace AdGrafik\GoogleMapsPHP\API\MapTypes;

/**
 * API equivalent to google.maps.StyledMapTypeOptions.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class StyledMapTypeOptions extends AbstractMapTypeOptions {

	/**
	 * @var string $alt
	 */
	public $alt;

	/**
	 * @var integer $maxZoom
	 */
	public $maxZoom;

	/**
	 * @var integer $minZoom
	 */
	public $minZoom;

	/**
	 * @var string $name
	 */
	public $name;

	/**
	 * Set alt
	 *
	 * @param string $alt
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\StyledMapTypeOptions
	 */
	public function setAlt($alt) {
		$this->alt = $alt;
		return $this;
	}

	/**
	 * Get alt
	 *
	 * @return string
	 */
	public function getAlt() {
		return $this->alt;
	}

	/**
	 * Set maxZoom
	 *
	 * @param integer $maxZoom
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\StyledMapTypeOptions
	 */
	public function setMaxZoom($maxZoom) {
		$this->maxZoom = (integer) $maxZoom;
		return $this;
	}

	/**
	 * Get maxZoom
	 *
	 * @return integer
	 */
	public function getMaxZoom() {
		return $this->maxZoom;
	}

	/**
	 * Set minZoom
	 *
	 * @param integer $minZoom
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\StyledMapTypeOptions
	 */
	public function setMinZoom($minZoom) {
		$this->minZoom = (integer) $minZoom;
		return $this;
	}

	/**
	 * Get minZoom
	 *
	 * @return integer
	 */
	public function getMinZoom() {
		return $this->minZoom;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\StyledMapTypeOptions
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

}

?>