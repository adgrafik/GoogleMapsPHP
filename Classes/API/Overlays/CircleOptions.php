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
 * API equivalent to google.maps.CircleOptions.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class CircleOptions {

	/**
	 * @var string|\AdGrafik\GoogleMapsPHP\API\Base\LatLng $center
	 */
	public $center;

	/**
	 * @var boolean $clickable
	 */
	public $clickable;

	/**
	 * @var boolean $draggable
	 */
	public $draggable;

	/**
	 * @var boolean $editable
	 */
	public $editable;

	/**
	 * @var string $fillColor
	 */
	public $fillColor;

	/**
	 * @var float $fillOpacity
	 */
	public $fillOpacity;

	/**
	 * @var integer $radius
	 */
	public $radius;

	/**
	 * @var string $strokeColor
	 */
	public $strokeColor;

	/**
	 * @var float $strokeOpacity
	 */
	public $strokeOpacity;

	/**
	 * @var string<\AdGrafik\GoogleMapsPHP\API\Overlays\StrokePosition::CENTER|INSIDE|OUTSIDE> $strokePosition
	 */
	public $strokePosition;

	/**
	 * @var integer $strokeWeight
	 */
	public $strokeWeight;

	/**
	 * @var boolean $visible
	 */
	public $visible;

	/**
	 * @var integer $zIndex
	 */
	public $zIndex;

	/**
	 * Constructor
	 *
	 * @param array $options
	 */
	public function __construct(array $options = array()) {
		ClassUtility::setPropertiesFromArray($this, $options);
	}

	/**
	 * Set center
	 *
	 * @param string|\AdGrafik\GoogleMapsPHP\API\Base\LatLng $center
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions
	 */
	public function setCenter($center) {
		if ($center instanceof \AdGrafik\GoogleMapsPHP\API\Base\LatLng === FALSE) {
			$center = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Base\\LatLng', $center);
		}
		$this->center = $center;
		return $this;
	}

	/**
	 * Get center
	 *
	 * @return string|\AdGrafik\GoogleMapsPHP\API\Base\LatLng
	 */
	public function getCenter() {
		return $this->center;
	}

	/**
	 * Set clickable
	 *
	 * @param boolean $clickable
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions
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
	 * Set draggable
	 *
	 * @param boolean $draggable
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions
	 */
	public function setDraggable($draggable) {
		$this->draggable = (boolean) $draggable;
		return $this;
	}

	/**
	 * Get draggable
	 *
	 * @return boolean
	 */
	public function isDraggable() {
		return $this->draggable;
	}

	/**
	 * Set editable
	 *
	 * @param boolean $editable
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions
	 */
	public function setEditable($editable) {
		$this->editable = (boolean) $editable;
		return $this;
	}

	/**
	 * Get editable
	 *
	 * @return boolean
	 */
	public function isEditable() {
		return $this->editable;
	}

	/**
	 * Set fillColor
	 *
	 * @param string $fillColor
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions
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
	 * Set radius
	 *
	 * @param integer $radius
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions
	 */
	public function setRadius($radius) {
		$this->radius = (integer) $radius;
		return $this;
	}

	/**
	 * Get radius
	 *
	 * @return integer
	 */
	public function getRadius() {
		return $this->radius;
	}

	/**
	 * Set strokeColor
	 *
	 * @param string $strokeColor
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions
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
	 * Set strokePosition
	 *
	 * @param string<\AdGrafik\GoogleMapsPHP\API\Overlays\StrokePosition::CENTER|INSIDE|OUTSIDE> $strokePosition
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions
	 */
	public function setStrokePosition($strokePosition) {
		$this->strokePosition = $strokePosition;
		return $this;
	}

	/**
	 * Get strokePosition
	 *
	 * @return string<\AdGrafik\GoogleMapsPHP\API\Overlays\StrokePosition::CENTER|INSIDE|OUTSIDE>
	 */
	public function getStrokePosition() {
		return $this->strokePosition;
	}

	/**
	 * Set strokeWeight
	 *
	 * @param integer $strokeWeight
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions
	 */
	public function setStrokeWeight($strokeWeight) {
		$this->strokeWeight = (integer) $strokeWeight;
		return $this;
	}

	/**
	 * Get strokeWeight
	 *
	 * @return integer
	 */
	public function getStrokeWeight() {
		return $this->strokeWeight;
	}

	/**
	 * Set visible
	 *
	 * @param boolean $visible
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions
	 */
	public function setVisible($visible) {
		$this->visible = (boolean) $visible;
		return $this;
	}

	/**
	 * Get visible
	 *
	 * @return boolean
	 */
	public function isVisible() {
		return $this->visible;
	}

	/**
	 * Set zIndex
	 *
	 * @param integer $zIndex
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions
	 */
	public function setZIndex($zIndex) {
		$this->zIndex = (integer) $zIndex;
		return $this;
	}

	/**
	 * Get zIndex
	 *
	 * @return integer
	 */
	public function getZIndex() {
		return $this->zIndex;
	}

}

?>