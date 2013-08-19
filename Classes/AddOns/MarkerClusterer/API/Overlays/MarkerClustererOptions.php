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

namespace AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\Overlays;

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * This class represents optional arguments to the MarkerClusterer constructor.
 *
 * @see http://gmaps-utility-library-dev.googlecode.com/svn/tags/markerclusterer/
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class MarkerClustererOptions {

	/**
	 * @var integer $maxZoom
	 */
	public $maxZoom;

	/**
	 * @var integer $gridSize
	 */
	public $gridSize;

	/**
	 * @var boolean $zoomOnClick
	 */
	public $zoomOnClick;

	/**
	 * @var array $styles
	 */
	public $styles;

	/**
	 * Constructor
	 *
	 * @param array $options
	 */
	public function __construct(array $options = array()) {
		ClassUtility::setPropertiesFromArray($this, $options);
	}

	/**
	 * Set maxZoom
	 *
	 * @param integer $maxZoom
	 * @return \AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\Overlays\MarkerClustererOptions
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
	 * Set gridSize
	 *
	 * @param integer $gridSize
	 * @return \AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\Overlays\MarkerClustererOptions
	 */
	public function setGridSize($gridSize) {
		$this->gridSize = (integer) $gridSize;
		return $this;
	}

	/**
	 * Get gridSize
	 *
	 * @return integer
	 */
	public function getGridSize() {
		return $this->gridSize;
	}

	/**
	 * Set zoomOnClick
	 *
	 * @param boolean $zoomOnClick
	 * @return \AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\Overlays\MarkerClustererOptions
	 */
	public function setZoomOnClick($zoomOnClick) {
		$this->zoomOnClick = (boolean) $zoomOnClick;
		return $this;
	}

	/**
	 * Get zoomOnClick
	 *
	 * @return boolean
	 */
	public function isZoomOnClick() {
		return $this->zoomOnClick;
	}

	/**
	 * Set styles
	 *
	 * @param array $styles
	 * @return \AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\Overlays\MarkerClustererOptions
	 */
	public function setStyles(array $styles) {
		foreach ($styles as $key => $style) {
			if ($style instanceof \AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\MapTypes\MarkerClustererStyle === FALSE) {
				$styles[$key] = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\AddOns\\MarkerClusterer\\API\\MapTypes\\MarkerClustererStyle', $style);
			}
		}
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

}

?>