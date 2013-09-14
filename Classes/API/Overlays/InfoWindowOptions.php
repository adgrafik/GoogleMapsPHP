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
 * API equivalent to google.maps.InfoWindowOptions.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class InfoWindowOptions {

	/**
	 * @var string $content
	 */
	public $content;

	/**
	 * @var boolean $disableAutoPan
	 */
	public $disableAutoPan;

	/**
	 * @var integer $maxWidth
	 */
	public $maxWidth;

	/**
	 * @var array|\AdGrafik\GoogleMapsPHP\API\Base\Size $pixelOffset
	 */
	public $pixelOffset;

	/**
	 * @var string|\AdGrafik\GoogleMapsPHP\API\Base\LatLng $position
	 */
	public $position;

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
	 * Set content
	 *
	 * @param string $content
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\InfoWindowOptions
	 */
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}

	/**
	 * Get content
	 *
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Set disableAutoPan
	 *
	 * @param boolean $disableAutoPan
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\InfoWindowOptions
	 */
	public function setDisableAutoPan($disableAutoPan) {
		$this->disableAutoPan = (boolean) $disableAutoPan;
		return $this;
	}

	/**
	 * Get disableAutoPan
	 *
	 * @return boolean
	 */
	public function isDisableAutoPan() {
		return $this->disableAutoPan;
	}

	/**
	 * Set maxWidth
	 *
	 * @param integer $maxWidth
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\InfoWindowOptions
	 */
	public function setMaxWidth($maxWidth) {
		$this->maxWidth = (integer) $maxWidth;
		return $this;
	}

	/**
	 * Get maxWidth
	 *
	 * @return integer
	 */
	public function getMaxWidth() {
		return $this->maxWidth;
	}

	/**
	 * Set pixelOffset
	 *
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Base\Size $pixelOffset
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\InfoWindowOptions
	 */
	public function setPixelOffset($pixelOffset) {

		if ($pixelOffset instanceof \AdGrafik\GoogleMapsPHP\API\Base\LatLng === FALSE) {
			$pixelOffset = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Base\\Size', $pixelOffset);
		}

		$this->pixelOffset = $pixelOffset;
		return $this;
	}

	/**
	 * Get pixelOffset
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Base\Size
	 */
	public function getPixelOffset() {
		return $this->pixelOffset;
	}

	/**
	 * Set position
	 *
	 * @param string|\AdGrafik\GoogleMapsPHP\API\Base\LatLng $position
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\InfoWindowOptions
	 */
	public function setPosition($position) {

		if ($position instanceof \AdGrafik\GoogleMapsPHP\API\Base\LatLng === FALSE) {
			$position = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Base\\LatLng', $position);
		}

		$this->position = $position;
		return $this;
	}

	/**
	 * Get position
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Base\LatLng
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * Set zIndex
	 *
	 * @param integer $zIndex
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\InfoWindowOptions
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