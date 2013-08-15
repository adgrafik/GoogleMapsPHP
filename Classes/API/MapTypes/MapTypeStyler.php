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

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * API equivalent to google.maps.MapTypeStyler.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class MapTypeStyler extends \AdGrafik\GoogleMapsPHP\Object\PropertyArrayAccess {

	/**
	 * @var string $color
	 */
	public $color;

	/**
	 * @var double $gamma
	 */
	public $gamma;

	/**
	 * @var string $hue
	 */
	public $hue;

	/**
	 * @var boolean $invert_lightness
	 */
	public $invert_lightness;

	/**
	 * @var integer $lightness
	 */
	public $lightness;

	/**
	 * @var integer $saturation
	 */
	public $saturation;

	/**
	 * @var string $visibility
	 */
	public $visibility;

	/**
	 * @var integer $weight
	 */
	public $weight;

	/**
	 * Constructor
	 *
	 * @param array $options
	 */
	public function __construct(array $options = array()) {
		ClassUtility::setPropertiesFromArray($this, $options);
	}

	/**
	 * Set color
	 *
	 * @param string $color
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyler
	 */
	public function setColor($color) {
		$this->color = $color;
		return $this;
	}

	/**
	 * Get color
	 *
	 * @return string
	 */
	public function getColor() {
		return $this->color;
	}

	/**
	 * Set gamma
	 *
	 * @param double $gamma
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyler
	 */
	public function setGamma($gamma) {
		$this->gamma = $gamma;
		return $this;
	}

	/**
	 * Get gamma
	 *
	 * @return double
	 */
	public function getGamma() {
		return $this->gamma;
	}

	/**
	 * Set hue
	 *
	 * @param string $hue
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyler
	 */
	public function setHue($hue) {
		$this->hue = $hue;
		return $this;
	}

	/**
	 * Get hue
	 *
	 * @return string
	 */
	public function getHue() {
		return $this->hue;
	}

	/**
	 * Set invert_lightness
	 *
	 * @param boolean $invertLightness
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyler
	 */
	public function setInvertLightness($invertLightness) {
		$this->invert_lightness = (boolean) $invertLightness;
		return $this;
	}

	/**
	 * Get invert_lightness
	 *
	 * @return boolean
	 */
	public function isInvertLightness() {
		return $this->invert_lightness;
	}

	/**
	 * Set lightness
	 *
	 * @param integer $lightness
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyler
	 */
	public function setLightness($lightness) {
		$this->lightness = (integer) $lightness;
		return $this;
	}

	/**
	 * Get lightness
	 *
	 * @return integer
	 */
	public function getLightness() {
		return $this->lightness;
	}

	/**
	 * Set saturation
	 *
	 * @param integer $saturation
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyler
	 */
	public function setSaturation($saturation) {
		$this->saturation = (integer) $saturation;
		return $this;
	}

	/**
	 * Get saturation
	 *
	 * @return integer
	 */
	public function getSaturation() {
		return $this->saturation;
	}

	/**
	 * Set visibility
	 *
	 * @param string $visibility
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyler
	 */
	public function setVisibility($visibility) {
		$this->visibility = $visibility;
		return $this;
	}

	/**
	 * Get visibility
	 *
	 * @return string
	 */
	public function getVisibility() {
		return $this->visibility;
	}

	/**
	 * Set weight
	 *
	 * @param integer $weight
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyler
	 */
	public function setWeight($weight) {
		$this->weight = (integer) $weight;
		return $this;
	}

	/**
	 * Get weight
	 *
	 * @return integer
	 */
	public function getWeight() {
		return $this->weight;
	}

}

?>