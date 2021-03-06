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

namespace AdGrafik\GoogleMapsPHP\API\Map;

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

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
	 * @var string|\AdGrafik\GoogleMapsPHP\API\Base\LatLng $center
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
	 * @var array|\AdGrafik\GoogleMapsPHP\API\Controls\MapTypeControlOptions $mapTypeControlOptions
	 */
	public $mapTypeControlOptions;

	/**
	 * @var string<\AdGrafik\GoogleMapsPHP\API\Map\MapTypeId::HYBRID|ROADMAP|SATELLITE|TERRAIN> $mapTypeId
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
	 * @var array|\AdGrafik\GoogleMapsPHP\API\Controls\OverviewMapControlOptions $overviewMapControlOptions
	 */
	public $overviewMapControlOptions;

	/**
	 * @var boolean $panControl
	 */
	public $panControl;

	/**
	 * @var array|\AdGrafik\GoogleMapsPHP\API\Controls\PanControlOptions $panControlOptions
	 */
	public $panControlOptions;

	/**
	 * @var boolean $rotateControl
	 */
	public $rotateControl;

	/**
	 * @var array|\AdGrafik\GoogleMapsPHP\API\Controls\RotateControlOptions $rotateControlOptions
	 */
	public $rotateControlOptions;

	/**
	 * @var boolean $scaleControl
	 */
	public $scaleControl;

	/**
	 * @var array|\AdGrafik\GoogleMapsPHP\API\Controls\ScaleControlOptions $scaleControlOptions
	 */
	public $scaleControlOptions;

	/**
	 * @var boolean $scrollwheel
	 */
	public $scrollwheel;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanorama $streetView
	 * TODO: implement StreetViewPanorama
	public $streetView;
	 */

	/**
	 * @var boolean $streetViewControl
	 */
	public $streetViewControl;

	/**
	 * @var array|\AdGrafik\GoogleMapsPHP\API\Controls\StreetViewControlOptions $streetViewControlOptions
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
	 * @var array|\AdGrafik\GoogleMapsPHP\API\Controls\ZoomControlOptions $zoomControlOptions
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setBackgroundColor($backgroundColor) {
		$this->backgroundColor = $backgroundColor ?: NULL;
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setCenter($center, $longitude = NULL, $noWrap = FALSE) {

		if ($center instanceof \AdGrafik\GoogleMapsPHP\API\Base\LatLng === FALSE) {
			$center = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Base\\LatLng', $center, $longitude, $noWrap);
		}

		$this->center = $center;
		return $this;
	}

	/**
	 * Get center
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Base\LatLng
	 */
	public function getCenter() {
		return $this->center;
	}

	/**
	 * Set disableDefaultUI
	 *
	 * @param boolean $disableDefaultUI
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setDisableDefaultUI($disableDefaultUI) {
		$this->disableDefaultUI = (boolean) $disableDefaultUI ?: NULL;
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setDisableDoubleClickZoom($disableDoubleClickZoom) {
		$this->disableDoubleClickZoom = (boolean) $disableDoubleClickZoom ?: NULL;
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setDraggable($draggable) {
		$this->draggable = (boolean) $draggable ?: NULL;
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setDraggableCursor($draggableCursor) {
		$this->draggableCursor = $draggableCursor ?: NULL;
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setDraggingCursor($draggingCursor) {
		$this->draggingCursor = $draggingCursor ?: NULL;
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setHeading($heading) {
		$this->heading = (integer) $heading ?: NULL;
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setKeyboardShortcuts($keyboardShortcuts) {
		$this->keyboardShortcuts = (boolean) $keyboardShortcuts ?: NULL;
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setMapMaker($mapMaker) {
		$this->mapMaker = (boolean) $mapMaker ?: NULL;
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setMapTypeControl($mapTypeControl) {
		$this->mapTypeControl = (boolean) $mapTypeControl ?: NULL;
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
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Controls\MapTypeControlOptions $mapTypeControlOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setMapTypeControlOptions($mapTypeControlOptions) {

		if ($mapTypeControlOptions instanceof \AdGrafik\GoogleMapsPHP\API\Controls\MapTypeControlOptions === FALSE) {
			$mapTypeControlOptions = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Controls\\MapTypeControlOptions', $mapTypeControlOptions);
		}

		$this->mapTypeControlOptions = $mapTypeControlOptions;
		return $this;
	}

	/**
	 * Get mapTypeControlOptions
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\MapTypeControlOptions
	 */
	public function getMapTypeControlOptions() {
		return $this->mapTypeControlOptions;
	}

	/**
	 * Set mapTypeId
	 *
	 * @param string<\AdGrafik\GoogleMapsPHP\API\Map\MapTypeId::HYBRID|ROADMAP|SATELLITE|TERRAIN> $mapTypeId
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setMaxZoom($maxZoom) {
		$this->maxZoom = (integer) $maxZoom ?: NULL;
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setMinZoom($minZoom) {
		$this->minZoom = (integer) $minZoom ?: NULL;
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setNoClear($noClear) {
		$this->noClear = (boolean) $noClear ?: NULL;
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setOverviewMapControl($overviewMapControl) {
		$this->overviewMapControl = (boolean) $overviewMapControl ?: NULL;
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
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Controls\OverviewMapControlOptions $overviewMapControlOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setOverviewMapControlOptions($overviewMapControlOptions) {

		if ($overviewMapControlOptions instanceof AdGrafik\GoogleMapsPHP\API\Controls\OverviewMapControlOptions === FALSE) {
			$overviewMapControlOptions = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Controls\\OverviewMapControlOptions', $overviewMapControlOptions);
		}

		$this->overviewMapControlOptions = $overviewMapControlOptions;
		return $this;
	}

	/**
	 * Get overviewMapControlOptions
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\OverviewMapControlOptions
	 */
	public function getOverviewMapControlOptions() {
		return $this->overviewMapControlOptions;
	}

	/**
	 * Set panControl
	 *
	 * @param boolean $panControl
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setPanControl($panControl) {
		$this->panControl = (boolean) $panControl ?: NULL;
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
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Controls\PanControlOptions $panControlOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setPanControlOptions($panControlOptions) {

		if ($panControlOptions instanceof AdGrafik\GoogleMapsPHP\API\Controls\PanControlOptions === FALSE) {
			$panControlOptions = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Controls\\PanControlOptions', $panControlOptions);
		}

		$this->panControlOptions = $panControlOptions;
		return $this;
	}

	/**
	 * Get panControlOptions
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\PanControlOptions
	 */
	public function getPanControlOptions() {
		return $this->panControlOptions;
	}

	/**
	 * Set rotateControl
	 *
	 * @param boolean $rotateControl
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setRotateControl($rotateControl) {
		$this->rotateControl = (boolean) $rotateControl ?: NULL;
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
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Controls\RotateControlOptions $rotateControlOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setRotateControlOptions($rotateControlOptions) {

		if ($rotateControlOptions instanceof AdGrafik\GoogleMapsPHP\API\Controls\RotateControlOptions === FALSE) {
			$rotateControlOptions = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Controls\\RotateControlOptions', $rotateControlOptions);
		}

		$this->rotateControlOptions = $rotateControlOptions;
		return $this;
	}

	/**
	 * Get rotateControlOptions
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\RotateControlOptions
	 */
	public function getRotateControlOptions() {
		return $this->rotateControlOptions;
	}

	/**
	 * Set scaleControl
	 *
	 * @param boolean $scaleControl
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setScaleControl($scaleControl) {
		$this->scaleControl = (boolean) $scaleControl ?: NULL;
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
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Controls\ScaleControlOptions $scaleControlOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setScaleControlOptions($scaleControlOptions) {

		if ($scaleControlOptions instanceof AdGrafik\GoogleMapsPHP\API\Controls\ScaleControlOptions === FALSE) {
			$scaleControlOptions = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Controls\\ScaleControlOptions', $scaleControlOptions);
		}

		$this->scaleControlOptions = $scaleControlOptions;
		return $this;
	}

	/**
	 * Get scaleControlOptions
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\ScaleControlOptions
	 */
	public function getScaleControlOptions() {
		return $this->scaleControlOptions;
	}

	/**
	 * Set scrollwheel
	 *
	 * @param boolean $scrollwheel
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setScrollwheel($scrollwheel) {
		$this->scrollwheel = (boolean) $scrollwheel ?: NULL;
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
	 * @param \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanorama $streetView
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setStreetView(\AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanorama $streetView) {
		$this->streetView = $streetView;
		return $this;
	}

	/**
	 * Get streetView
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanorama
	 */
	public function getStreetView() {
		return $this->streetView;
	}

	/**
	 * Set streetViewControl
	 *
	 * @param boolean $streetViewControl
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setStreetViewControl($streetViewControl) {
		$this->streetViewControl = (boolean) $streetViewControl ?: NULL;
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
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Controls\StreetViewControlOptions $streetViewControlOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setStreetViewControlOptions($streetViewControlOptions) {

		if ($streetViewControlOptions instanceof AdGrafik\GoogleMapsPHP\API\Controls\StreetViewControlOptions === FALSE) {
			$streetViewControlOptions = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Controls\\StreetViewControlOptions', $streetViewControlOptions);
		}

		$this->streetViewControlOptions = $streetViewControlOptions;
		return $this;
	}

	/**
	 * Get streetViewControlOptions
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\StreetViewControlOptions
	 */
	public function getStreetViewControlOptions() {
		return $this->streetViewControlOptions;
	}

	/**
	 * Set styles
	 *
	 * @param array $styles
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setTilt($tilt) {
		$this->tilt = (integer) $tilt ?: NULL;
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setZoom($zoom) {
		$this->zoom = (integer) $zoom ?: NULL;
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
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setZoomControl($zoomControl) {
		$this->zoomControl = (boolean) $zoomControl ?: NULL;
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
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Controls\ZoomControlOptions $zoomControlOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\Map\MapOptions
	 */
	public function setZoomControlOptions($zoomControlOptions) {

		if ($zoomControlOptions instanceof AdGrafik\GoogleMapsPHP\API\Controls\ZoomControlOptions === FALSE) {
			$zoomControlOptions = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Controls\\ZoomControlOptions', $zoomControlOptions);
		}

		$this->zoomControlOptions = $zoomControlOptions;
		return $this;
	}

	/**
	 * Get zoomControlOptions
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\ZoomControlOptions
	 */
	public function getZoomControlOptions() {
		return $this->zoomControlOptions;
	}

}

?>