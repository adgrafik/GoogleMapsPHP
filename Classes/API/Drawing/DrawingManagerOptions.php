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

namespace AdGrafik\GoogleMapsPHP\API\Drawing;

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * API equivalent to google.maps.drawing.DrawingManagerOptions.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class DrawingManagerOptions {

	/**
	 * @var array|\AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions $circleOptions
	 */
	public $circleOptions;

	/**
	 * @var boolean $drawingControl
	 */
	public $drawingControl;

	/**
	 * @var array|\AdGrafik\GoogleMapsPHP\API\Drawing\DrawingControlOptions $drawingControlOptions
	 */
	public $drawingControlOptions;

	/**
	 * @var string<\AdGrafik\GoogleMapsPHP\API\Drawing\OverlayType::*> $drawingMode
	 */
	public $drawingMode;

	/**
	 * @var array|\AdGrafik\GoogleMapsPHP\API\Overlays\MarkerOptions $markerOptions
	 */
	public $markerOptions;

	/**
	 * @var array|\AdGrafik\GoogleMapsPHP\API\Overlays\PolygonOptions $polygonOptions
	 */
	public $polygonOptions;

	/**
	 * @var array|\AdGrafik\GoogleMapsPHP\API\Overlays\PolylineOptions $polylineOptions
	 */
	public $polylineOptions;

	/**
	 * @var array|\AdGrafik\GoogleMapsPHP\API\Overlays\RectangleOptions $rectangleOptions
	 */
	public $rectangleOptions;

	/**
	 * Constructor
	 *
	 * @param array $options
	 */
	public function __construct(array $options = array()) {
		ClassUtility::setPropertiesFromArray($this, $options);
	}

	/**
	 * Set circleOptions
	 *
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions $circleOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\Drawing\DrawingManagerOptions
	 */
	public function setCircleOptions($circleOptions) {

		if ($circleOptions instanceof \AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions === FALSE) {
			$pixelOffset = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\API\\Overlays\\CircleOptions', $circleOptions);
		}

		$this->circleOptions = $circleOptions;
		return $this;
	}

	/**
	 * Get circleOptions
	 *
	 * @return array|\AdGrafik\GoogleMapsPHP\API\Overlays\CircleOptions
	 */
	public function getCircleOptions() {
		return $this->circleOptions;
	}

	/**
	 * Set drawingControl
	 *
	 * @param boolean $drawingControl
	 * @return \AdGrafik\GoogleMapsPHP\API\Drawing\DrawingManagerOptions
	 */
	public function setDrawingControl($drawingControl) {
		$this->drawingControl = (boolean) $drawingControl;
		return $this;
	}

	/**
	 * Get drawingControl
	 *
	 * @return boolean
	 */
	public function isDrawingControl() {
		return $this->drawingControl;
	}

	/**
	 * Set drawingControlOptions
	 *
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Drawing\DrawingControlOptions $drawingControlOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\Drawing\DrawingManagerOptions
	 */
	public function setDrawingControlOptions($drawingControlOptions) {

		if ($drawingControlOptions instanceof \AdGrafik\GoogleMapsPHP\API\Drawing\DrawingControlOptions === FALSE) {
			$drawingControlOptions = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\API\\Drawing\\DrawingControlOptions', $drawingControlOptions);
		}

		$this->drawingControlOptions = $drawingControlOptions;
		return $this;
	}

	/**
	 * Get drawingControlOptions
	 *
	 * @return array|\AdGrafik\GoogleMapsPHP\API\Drawing\DrawingControlOptions
	 */
	public function getDrawingControlOptions() {
		return $this->drawingControlOptions;
	}

	/**
	 * Set drawingMode
	 *
	 * @param string<\AdGrafik\GoogleMapsPHP\API\Drawing\OverlayType::*> $drawingMode
	 * @return \AdGrafik\GoogleMapsPHP\API\Drawing\DrawingManagerOptions
	 */
	public function setDrawingMode($drawingMode) {

		$this->drawingMode = new \StdClass();
		$this->drawingMode->className = 'drawing.OverlayType';
		$this->drawingMode->constant = $drawingMode;

		return $this;
	}

	/**
	 * Get drawingMode
	 *
	 * @return string<\AdGrafik\GoogleMapsPHP\API\Drawing\OverlayType::*>
	 */
	public function getDrawingMode() {
		return $this->drawingMode;
	}

	/**
	 * Set markerOptions
	 *
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Overlays\MarkerOptions $markerOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\Drawing\DrawingManagerOptions
	 */
	public function setMarkerOptions($markerOptions) {

		if ($markerOptions instanceof \AdGrafik\GoogleMapsPHP\API\Overlays\MarkerOptions === FALSE) {
			$markerOptions = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\API\\Overlays\\MarkerOptions', $markerOptions);
		}

		$this->markerOptions = $markerOptions;
		return $this;
	}

	/**
	 * Get markerOptions
	 *
	 * @return array|\AdGrafik\GoogleMapsPHP\API\Overlays\MarkerOptions
	 */
	public function getMarkerOptions() {
		return $this->markerOptions;
	}

	/**
	 * Set polygonOptions
	 *
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Overlays\PolygonOptions $polygonOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\Drawing\DrawingManagerOptions
	 */
	public function setPolygonOptions($polygonOptions) {

		if ($polygonOptions instanceof \AdGrafik\GoogleMapsPHP\API\Overlays\PolygonOptions === FALSE) {
			$polygonOptions = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\API\\Overlays\\PolygonOptions', $polygonOptions);
		}

		$this->polygonOptions = $polygonOptions;
		return $this;
	}

	/**
	 * Get polygonOptions
	 *
	 * @return array|\AdGrafik\GoogleMapsPHP\API\Overlays\PolygonOptions
	 */
	public function getPolygonOptions() {
		return $this->polygonOptions;
	}

	/**
	 * Set polylineOptions
	 *
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Overlays\PolylineOptions $polylineOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\Drawing\DrawingManagerOptions
	 */
	public function setPolylineOptions($polylineOptions) {

		if ($polylineOptions instanceof \AdGrafik\GoogleMapsPHP\API\Overlays\PolylineOptions === FALSE) {
			$polylineOptions = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\API\\Overlays\\PolylineOptions', $polylineOptions);
		}

		$this->polylineOptions = $polylineOptions;
		return $this;
	}

	/**
	 * Get polylineOptions
	 *
	 * @return array|\AdGrafik\GoogleMapsPHP\API\Overlays\PolylineOptions
	 */
	public function getPolylineOptions() {
		return $this->polylineOptions;
	}

	/**
	 * Set rectangleOptions
	 *
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Overlays\RectangleOptions $rectangleOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\Drawing\DrawingManagerOptions
	 */
	public function setRectangleOptions($rectangleOptions) {

		if ($rectangleOptions instanceof \AdGrafik\GoogleMapsPHP\API\Overlays\RectangleOptions === FALSE) {
			$rectangleOptions = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\API\\Overlays\\RectangleOptions', $rectangleOptions);
		}

		$this->rectangleOptions = $rectangleOptions;
		return $this;
	}

	/**
	 * Get rectangleOptions
	 *
	 * @return array|\AdGrafik\GoogleMapsPHP\API\Overlays\RectangleOptions
	 */
	public function getRectangleOptions() {
		return $this->rectangleOptions;
	}

}

?>