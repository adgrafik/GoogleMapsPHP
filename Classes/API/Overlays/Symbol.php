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

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * API equivalent to google.maps.Symbol.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class Symbol extends AbstractIcon {

	/**
	 * @var string $fillColor
	 */
	public $fillColor;

	/**
	 * @var float $fillOpacity
	 */
	public $fillOpacity;

	/**
	 * @var string<\AdGrafik\GoogleMapsPHP\API\Overlays\SymbolPath::BACKWARD_CLOSED_ARROW|BACKWARD_OPEN_ARROW|CIRCLE|FORWARD_CLOSED_ARROW|FORWARD_OPEN_ARROW> $path
	 */
	public $path;

	/**
	 * @var integer $rotation
	 */
	public $rotation;

	/**
	 * @var integer $scale
	 */
	public $scale;

	/**
	 * @var string $strokeColor
	 */
	public $strokeColor;

	/**
	 * @var float $strokeOpacity
	 */
	public $strokeOpacity;

	/**
	 * @var float $strokeWeight
	 */
	public $strokeWeight;

	/**
	 * Constructor
	 *
	 * @param string|array $options
	 */
	public function __construct($options = '') {
		if (is_array($options)) {
			ClassUtility::setPropertiesFromArray($this, $options);
		} else {
			$this->setPath($options);
		}
	}

	/**
	 * Constructor
	 *
	 * @param array $options
	 * @throws \AdGrafik\GoogleMapsPHP\Exceptions\RequiredArgumentMissingException
	 */
	public function __construct(array $options = array()) {
		parent::__construct($options);
		if ($this->getPath() === NULL) {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\RequiredArgumentMissingException('Missing option "path".', 1369555245);
		}
	}

	/**
	 * Set fillColor
	 *
	 * @param string $fillColor
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\Symbol
	 */
	public function setFillColor($fillColor) {
		$this->fillColor = $fillColor;
		return $this;
	}

	/**
	 * Get fillColor
	 *
	 * @return string
	 */
	public function getFillColor() {
		return $this->fillColor;
	}

	/**
	 * Set fillOpacity
	 *
	 * @param float $fillOpacity
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\Symbol
	 */
	public function setFillOpacity($fillOpacity) {
		$this->fillOpacity = (float) $fillOpacity;
		return $this;
	}

	/**
	 * Get fillOpacity
	 *
	 * @return float
	 */
	public function getFillOpacity() {
		return $this->fillOpacity;
	}

	/**
	 * Set path
	 *
	 * @param string<\AdGrafik\GoogleMapsPHP\API\Overlays\SymbolPath::BACKWARD_CLOSED_ARROW|BACKWARD_OPEN_ARROW|CIRCLE|FORWARD_CLOSED_ARROW|FORWARD_OPEN_ARROW> $path
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\Symbol
	 */
	public function setPath($path) {

		$this->path = new \StdClass();
		$this->path->className = 'SymbolPath';
		$this->path->constant = $path;

		return $this;
	}

	/**
	 * Get path
	 *
	 * @return string
	 */
	public function getPath() {
		return ($this->path instanceof \StdClass)
			? $this->path->constant
			: NULL;
	}

	/**
	 * Set rotation
	 *
	 * @param integer $rotation
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\Symbol
	 */
	public function setRotation($rotation) {
		$this->rotation = (integer) $rotation;
		return $this;
	}

	/**
	 * Get rotation
	 *
	 * @return integer
	 */
	public function getRotation() {
		return $this->rotation;
	}

	/**
	 * Set scale
	 *
	 * @param integer $scale
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\Symbol
	 */
	public function setScale($scale) {
		$this->scale = (integer) $scale;
		return $this;
	}

	/**
	 * Get scale
	 *
	 * @return integer
	 */
	public function getScale() {
		return $this->scale;
	}

	/**
	 * Set strokeColor
	 *
	 * @param string $strokeColor
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\Symbol
	 */
	public function setStrokeColor($strokeColor) {
		$this->strokeColor = $strokeColor;
		return $this;
	}

	/**
	 * Get strokeColor
	 *
	 * @return string
	 */
	public function getStrokeColor() {
		return $this->strokeColor;
	}

	/**
	 * Set strokeOpacity
	 *
	 * @param float $strokeOpacity
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\Symbol
	 */
	public function setStrokeOpacity($strokeOpacity) {
		$this->strokeOpacity = (float) $strokeOpacity;
		return $this;
	}

	/**
	 * Get strokeOpacity
	 *
	 * @return float
	 */
	public function getStrokeOpacity() {
		return $this->strokeOpacity;
	}

	/**
	 * Set strokeWeight
	 *
	 * @param float $strokeWeight
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\Symbol
	 */
	public function setStrokeWeight($strokeWeight) {
		$this->strokeWeight = (float) $strokeWeight;
		return $this;
	}

	/**
	 * Get strokeWeight
	 *
	 * @return float
	 */
	public function getStrokeWeight() {
		return $this->strokeWeight;
	}

	/**
	 * __toString
	 *
	 * @return string
	 */
	public function __toString() {

		try {
			$javaScript = $this->printJavaScript();
		} catch (\Exception $exception) {
			$javaScript = (string) $exception;
		}

		return $javaScript;
	}

}

?>