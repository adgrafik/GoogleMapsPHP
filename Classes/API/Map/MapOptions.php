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

namespace GoogleMapsPHP\API\Map;

use GoogleMapsPHP\Utility\ClassUtility;

/**
 * API equivalent to google.maps.MapOptions.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class MapOptions {

	/**
	 * @var string $backgroundColor
	 */
	public $backgroundColor;

	/**
	 * @var string|\GoogleMapsPHP\API\Base\LatLng $center
	 */
	public $center;

	/**
	 * @var boolean $disableDefaultUI
	 */
	public $disableDefaultUI;

	/**
	 * @var boolean $disableDoubleClickZoom
	 */
	public $disableDoubleClickZoom;

	/**
	 * @var boolean $draggable
	 */
	public $draggable;

	/**
	 * @var string $draggableCursor
	 */
	public $draggableCursor;

	/**
	 * @var string $draggingCursor
	 */
	public $draggingCursor;

	/**
	 * @var integer $heading
	 */
	public $heading;

	/**
	 * @var boolean $keyboardShortcuts
	 */
	public $keyboardShortcuts;

	/**
	 * @var boolean $mapMaker
	 */
	public $mapMaker;

	/**
	 * @var boolean $mapTypeControl
	 */
	public $mapTypeControl;

	/**
	 * @var array|\GoogleMapsPHP\API\Controls\MapTypeControlOptions $mapTypeControlOptions
	 */
	public $mapTypeControlOptions;

	/**
	 * @var string<\GoogleMapsPHP\API\Map\MapTypeId::HYBRID|ROADMAP|SATELLITE|TERRAIN> $mapTypeId
	 */
	public $mapTypeId;

	/**
	 * @var integer $maxZoom
	 */
	public $maxZoom;

	/**
	 * @var integer $minZoom
	 */
	public $minZoom;

	/**
	 * @var boolean $noClear
	 */
	public $noClear;

	/**
	 * @var boolean $overviewMapControl
	 */
	public $overviewMapControl;

	/**
	 * @var array|\GoogleMapsPHP\API\Controls\OverviewMapControlOptions $overviewMapControlOptions
	 */
	public $overviewMapControlOptions;

	/**
	 * @var boolean $panControl
	 */
	public $panControl;

	/**
	 * @var array|\GoogleMapsPHP\API\Controls\PanControlOptions $panControlOptions
	 */
	public $panControlOptions;

	/**
	 * @var boolean $rotateControl
	 */
	public $rotateControl;

	/**
	 * @var array|\GoogleMapsPHP\API\Controls\RotateControlOptions $rotateControlOptions
	 */
	public $rotateControlOptions;

	/**
	 * @var boolean $scaleControl
	 */
	public $scaleControl;

	/**
	 * @var array|\GoogleMapsPHP\API\Controls\ScaleControlOptions $scaleControlOptions
	 */
	public $scaleControlOptions;

	/**
	 * @var boolean $scrollwheel
	 */
	public $scrollwheel;

	/**
	 * @var \GoogleMapsPHP\API\StreetView\StreetViewPanorama $streetView
	 * TODO: implement StreetViewPanorama
	public $streetView;
	 */

	/**
	 * @var boolean $streetViewControl
	 */
	public $streetViewControl;

	/**
	 * @var array|\GoogleMapsPHP\API\Controls\StreetViewControlOptions $streetViewControlOptions
	 */
	public $streetViewControlOptions;

	/**
	 * @var array $styles
	 */
	public $styles;

	/**
	 * @var integer $tilt
	 */
	public $tilt;

	/**
	 * @var integer $zoom
	 */
	public $zoom;

	/**
	 * @var boolean $zoomControl
	 */
	public $zoomControl;

	/**
	 * @var array|\GoogleMapsPHP\API\Controls\ZoomControlOptions $zoomControlOptions
	 */
	public $zoomControlOptions;

	/**
	 * Constructor
	 *
	 * @param array $options
	 */
	public function __construct(array $options = array()) {
		ClassUtility::setPropertiesFromArray($this, $options);
	}

	/**
	 * Set backgroundColor
	 *
	 * @param string $backgroundColor
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setBackgroundColor($backgroundColor) {
		$this->backgroundColor = $backgroundColor;
		return $this;
	}

	/**
	 * Get backgroundColor
	 *
	 * @return string
	 */
	public function getBackgroundColor() {
		return $this->backgroundColor;
	}

	/**
	 * Set center
	 *
	 * @param mixed $center
	 * @param float $longitude
	 * @param boolean $noWrap
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setCenter($center, $longitude = NULL, $noWrap = FALSE) {

		if ($center instanceof \GoogleMapsPHP\API\Base\LatLng === FALSE) {
			$center = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Base\\LatLng', $center, $longitude, $noWrap);
		}

		$this->center = $center;
		return $this;
	}

	/**
	 * Get center
	 *
	 * @return \GoogleMapsPHP\API\Base\LatLng
	 */
	public function getCenter() {
		return $this->center;
	}

	/**
	 * Set disableDefaultUI
	 *
	 * @param boolean $disableDefaultUI
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setDisableDefaultUI($disableDefaultUI) {
		$this->disableDefaultUI = (boolean) $disableDefaultUI;
		return $this;
	}

	/**
	 * Get disableDefaultUI
	 *
	 * @return boolean
	 */
	public function isDisableDefaultUI() {
		return $this->disableDefaultUI;
	}

	/**
	 * Set disableDoubleClickZoom
	 *
	 * @param boolean $disableDoubleClickZoom
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setDisableDoubleClickZoom($disableDoubleClickZoom) {
		$this->disableDoubleClickZoom = (boolean) $disableDoubleClickZoom;
		return $this;
	}

	/**
	 * Get disableDoubleClickZoom
	 *
	 * @return boolean
	 */
	public function isDisableDoubleClickZoom() {
		return $this->disableDoubleClickZoom;
	}

	/**
	 * Set draggable
	 *
	 * @param boolean $draggable
	 * @return \GoogleMapsPHP\API\Map\MapOptions
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
	 * Set draggableCursor
	 *
	 * @param string $draggableCursor
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setDraggableCursor($draggableCursor) {
		$this->draggableCursor = $draggableCursor;
		return $this;
	}

	/**
	 * Get draggableCursor
	 *
	 * @return string
	 */
	public function getDraggableCursor() {
		return $this->draggableCursor;
	}

	/**
	 * Set draggingCursor
	 *
	 * @param string $draggingCursor
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setDraggingCursor($draggingCursor) {
		$this->draggingCursor = $draggingCursor;
		return $this;
	}

	/**
	 * Get draggingCursor
	 *
	 * @return string
	 */
	public function getDraggingCursor() {
		return $this->draggingCursor;
	}

	/**
	 * Set heading
	 *
	 * @param integer $heading
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setHeading($heading) {
		$this->heading = (integer) $heading;
		return $this;
	}

	/**
	 * Get heading
	 *
	 * @return integer
	 */
	public function getHeading() {
		return $this->heading;
	}

	/**
	 * Set keyboardShortcuts
	 *
	 * @param boolean $keyboardShortcuts
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setKeyboardShortcuts($keyboardShortcuts) {
		$this->keyboardShortcuts = (boolean) $keyboardShortcuts;
		return $this;
	}

	/**
	 * Get keyboardShortcuts
	 *
	 * @return boolean
	 */
	public function isKeyboardShortcuts() {
		return $this->keyboardShortcuts;
	}

	/**
	 * Set mapMaker
	 *
	 * @param boolean $mapMaker
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setMapMaker($mapMaker) {
		$this->mapMaker = (boolean) $mapMaker;
		return $this;
	}

	/**
	 * Get mapMaker
	 *
	 * @return boolean
	 */
	public function isMapMaker() {
		return $this->mapMaker;
	}

	/**
	 * Set mapTypeControl
	 *
	 * @param boolean $mapTypeControl
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setMapTypeControl($mapTypeControl) {
		$this->mapTypeControl = (boolean) $mapTypeControl;
		return $this;
	}

	/**
	 * Get mapTypeControl
	 *
	 * @return boolean
	 */
	public function isMapTypeControl() {
		return $this->mapTypeControl;
	}

	/**
	 * Set mapTypeControlOptions
	 *
	 * @param array|\GoogleMapsPHP\API\Controls\MapTypeControlOptions $mapTypeControlOptions
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setMapTypeControlOptions($mapTypeControlOptions) {

		if ($mapTypeControlOptions instanceof \GoogleMapsPHP\API\Controls\MapTypeControlOptions === FALSE) {
			$mapTypeControlOptions = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Controls\\MapTypeControlOptions', $mapTypeControlOptions);
		}

		$this->mapTypeControlOptions = $mapTypeControlOptions;
		return $this;
	}

	/**
	 * Get mapTypeControlOptions
	 *
	 * @return \GoogleMapsPHP\API\Controls\MapTypeControlOptions
	 */
	public function getMapTypeControlOptions() {
		return $this->mapTypeControlOptions;
	}

	/**
	 * Set mapTypeId
	 *
	 * @param string<\GoogleMapsPHP\API\Map\MapTypeId::HYBRID|ROADMAP|SATELLITE|TERRAIN> $mapTypeId
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setMapTypeId($mapTypeId) {

		$this->mapTypeId = new \StdClass();
		$this->mapTypeId->className = 'MapTypeId';
		$this->mapTypeId->constant = $mapTypeId;

		return $this;
	}

	/**
	 * Get mapTypeId
	 *
	 * @return string
	 */
	public function getMapTypeId() {
		return ($this->mapTypeId instanceof \StdClass)
			? $this->mapTypeId->constant
			: NULL;
	}

	/**
	 * Set maxZoom
	 *
	 * @param integer $maxZoom
	 * @return \GoogleMapsPHP\API\Map\MapOptions
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
	 * @return \GoogleMapsPHP\API\Map\MapOptions
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
	 * Set noClear
	 *
	 * @param boolean $noClear
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setNoClear($noClear) {
		$this->noClear = (boolean) $noClear;
		return $this;
	}

	/**
	 * Get noClear
	 *
	 * @return boolean
	 */
	public function isNoClear() {
		return $this->noClear;
	}

	/**
	 * Set overviewMapControl
	 *
	 * @param boolean $overviewMapControl
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setOverviewMapControl($overviewMapControl) {
		$this->overviewMapControl = (boolean) $overviewMapControl;
		return $this;
	}

	/**
	 * Get overviewMapControl
	 *
	 * @return boolean
	 */
	public function isOverviewMapControl() {
		return $this->overviewMapControl;
	}

	/**
	 * Set overviewMapControlOptions
	 *
	 * @param array|\GoogleMapsPHP\API\Controls\OverviewMapControlOptions $overviewMapControlOptions
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setOverviewMapControlOptions($overviewMapControlOptions) {

		if ($overviewMapControlOptions instanceof GoogleMapsPHP\API\Controls\OverviewMapControlOptions === FALSE) {
			$overviewMapControlOptions = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Controls\\OverviewMapControlOptions', $overviewMapControlOptions);
		}

		$this->overviewMapControlOptions = $overviewMapControlOptions;
		return $this;
	}

	/**
	 * Get overviewMapControlOptions
	 *
	 * @return \GoogleMapsPHP\API\Controls\OverviewMapControlOptions
	 */
	public function getOverviewMapControlOptions() {
		return $this->overviewMapControlOptions;
	}

	/**
	 * Set panControl
	 *
	 * @param boolean $panControl
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setPanControl($panControl) {
		$this->panControl = (boolean) $panControl;
		return $this;
	}

	/**
	 * Get panControl
	 *
	 * @return boolean
	 */
	public function isPanControl() {
		return $this->panControl;
	}

	/**
	 * Set panControlOptions
	 *
	 * @param array|\GoogleMapsPHP\API\Controls\PanControlOptions $panControlOptions
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setPanControlOptions($panControlOptions) {

		if ($panControlOptions instanceof GoogleMapsPHP\API\Controls\PanControlOptions === FALSE) {
			$panControlOptions = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Controls\\PanControlOptions', $panControlOptions);
		}

		$this->panControlOptions = $panControlOptions;
		return $this;
	}

	/**
	 * Get panControlOptions
	 *
	 * @return \GoogleMapsPHP\API\Controls\PanControlOptions
	 */
	public function getPanControlOptions() {
		return $this->panControlOptions;
	}

	/**
	 * Set rotateControl
	 *
	 * @param boolean $rotateControl
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setRotateControl($rotateControl) {
		$this->rotateControl = (boolean) $rotateControl;
		return $this;
	}

	/**
	 * Get rotateControl
	 *
	 * @return boolean
	 */
	public function isRotateControl() {
		return $this->rotateControl;
	}

	/**
	 * Set rotateControlOptions
	 *
	 * @param array|\GoogleMapsPHP\API\Controls\RotateControlOptions $rotateControlOptions
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setRotateControlOptions($rotateControlOptions) {

		if ($rotateControlOptions instanceof GoogleMapsPHP\API\Controls\RotateControlOptions === FALSE) {
			$rotateControlOptions = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Controls\\RotateControlOptions', $rotateControlOptions);
		}

		$this->rotateControlOptions = $rotateControlOptions;
		return $this;
	}

	/**
	 * Get rotateControlOptions
	 *
	 * @return \GoogleMapsPHP\API\Controls\RotateControlOptions
	 */
	public function getRotateControlOptions() {
		return $this->rotateControlOptions;
	}

	/**
	 * Set scaleControl
	 *
	 * @param boolean $scaleControl
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setScaleControl($scaleControl) {
		$this->scaleControl = (boolean) $scaleControl;
		return $this;
	}

	/**
	 * Get scaleControl
	 *
	 * @return boolean
	 */
	public function isScaleControl() {
		return $this->scaleControl;
	}

	/**
	 * Set scaleControlOptions
	 *
	 * @param array|\GoogleMapsPHP\API\Controls\ScaleControlOptions $scaleControlOptions
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setScaleControlOptions($scaleControlOptions) {

		if ($scaleControlOptions instanceof GoogleMapsPHP\API\Controls\ScaleControlOptions === FALSE) {
			$scaleControlOptions = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Controls\\ScaleControlOptions', $scaleControlOptions);
		}

		$this->scaleControlOptions = $scaleControlOptions;
		return $this;
	}

	/**
	 * Get scaleControlOptions
	 *
	 * @return \GoogleMapsPHP\API\Controls\ScaleControlOptions
	 */
	public function getScaleControlOptions() {
		return $this->scaleControlOptions;
	}

	/**
	 * Set scrollwheel
	 *
	 * @param boolean $scrollwheel
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setScrollwheel($scrollwheel) {
		$this->scrollwheel = (boolean) $scrollwheel;
		return $this;
	}

	/**
	 * Get scrollwheel
	 *
	 * @return boolean
	 */
	public function isScrollwheel() {
		return $this->scrollwheel;
	}

	/**
	 * Set streetView
	 *
	 * @param \GoogleMapsPHP\API\StreetView\StreetViewPanorama $streetView
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setStreetView(\GoogleMapsPHP\API\StreetView\StreetViewPanorama $streetView) {
		$this->streetView = $streetView;
		return $this;
	}

	/**
	 * Get streetView
	 *
	 * @return \GoogleMapsPHP\API\StreetView\StreetViewPanorama
	 */
	public function getStreetView() {
		return $this->streetView;
	}

	/**
	 * Set streetViewControl
	 *
	 * @param boolean $streetViewControl
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setStreetViewControl($streetViewControl) {
		$this->streetViewControl = (boolean) $streetViewControl;
		return $this;
	}

	/**
	 * Get streetViewControl
	 *
	 * @return boolean
	 */
	public function isStreetViewControl() {
		return $this->streetViewControl;
	}

	/**
	 * Set streetViewControlOptions
	 *
	 * @param array|\GoogleMapsPHP\API\Controls\StreetViewControlOptions $streetViewControlOptions
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setStreetViewControlOptions($streetViewControlOptions) {

		if ($streetViewControlOptions instanceof GoogleMapsPHP\API\Controls\StreetViewControlOptions === FALSE) {
			$streetViewControlOptions = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Controls\\StreetViewControlOptions', $streetViewControlOptions);
		}

		$this->streetViewControlOptions = $streetViewControlOptions;
		return $this;
	}

	/**
	 * Get streetViewControlOptions
	 *
	 * @return \GoogleMapsPHP\API\Controls\StreetViewControlOptions
	 */
	public function getStreetViewControlOptions() {
		return $this->streetViewControlOptions;
	}

	/**
	 * Set styles
	 *
	 * @param array $styles
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setStyles(array $styles) {
		$this->styles = $styles;
		return $this;
	}

	/**
	 * Get styles
	 *
	 * @return array
	 */
	public function getStyles() {
		return $this->styles;
	}

	/**
	 * Set tilt
	 *
	 * @param integer $tilt
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setTilt($tilt) {
		$this->tilt = (integer) $tilt;
		return $this;
	}

	/**
	 * Get tilt
	 *
	 * @return integer
	 */
	public function getTilt() {
		return $this->tilt;
	}

	/**
	 * Set zoom
	 *
	 * @param integer $zoom
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setZoom($zoom) {
		$this->zoom = (integer) $zoom;
		return $this;
	}

	/**
	 * Get zoom
	 *
	 * @return integer
	 */
	public function getZoom() {
		return $this->zoom;
	}

	/**
	 * Set zoomControl
	 *
	 * @param boolean $zoomControl
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setZoomControl($zoomControl) {
		$this->zoomControl = (boolean) $zoomControl;
		return $this;
	}

	/**
	 * Get zoomControl
	 *
	 * @return boolean
	 */
	public function isZoomControl() {
		return $this->zoomControl;
	}

	/**
	 * Set zoomControlOptions
	 *
	 * @param array|\GoogleMapsPHP\API\Controls\ZoomControlOptions $zoomControlOptions
	 * @return \GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setZoomControlOptions($zoomControlOptions) {

		if ($zoomControlOptions instanceof GoogleMapsPHP\API\Controls\ZoomControlOptions === FALSE) {
			$zoomControlOptions = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Controls\\ZoomControlOptions', $zoomControlOptions);
		}

		$this->zoomControlOptions = $zoomControlOptions;
		return $this;
	}

	/**
	 * Get zoomControlOptions
	 *
	 * @return \GoogleMapsPHP\API\Controls\ZoomControlOptions
	 */
	public function getZoomControlOptions() {
		return $this->zoomControlOptions;
	}

}

?>