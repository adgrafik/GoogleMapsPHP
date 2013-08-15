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

namespace AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\MapTypes;

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * An array of these is passed into the MarkerClustererOptions styles option.
 *
 * @see http://gmaps-utility-library-dev.googlecode.com/svn/tags/markerclusterer/
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class MarkerClustererStyle extends \AdGrafik\GoogleMapsPHP\Object\PropertyArrayAccess {

	/**
	 * Image url.
	 *
	 * @var string $url
	 */
	public $url;

	/**
	 * @var integer $height
	 */
	public $height;

	/**
	 * @var integer $width
	 */
	public $width;

	/**
	 * @var array $anchor
	 */
	public $anchor;

	/**
	 * @var string $textColor
	 */
	public $textColor;

	/**
	 * @var integer $textSize
	 */
	public $textSize;

	/**
	 * Constructor
	 *
	 * @param array $options
	 */
	public function __construct(array $options = array()) {
		ClassUtility::setPropertiesFromArray($this, $options);
	}

	/**
	 * Set url
	 *
	 * @param string $url
	 * @return \AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\MapTypes\MarkerClustererStyle
	 */
	public function setUrl($url) {
		$this->url = $url;
		return $this;
	}

	/**
	 * Get url
	 *
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * Set height
	 *
	 * @param integer $height
	 * @return \AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\MapTypes\MarkerClustererStyle
	 */
	public function setHeight($height) {
		$this->height = (integer) $height;
		return $this;
	}

	/**
	 * Get height
	 *
	 * @return integer
	 */
	public function getHeight() {
		return $this->height;
	}

	/**
	 * Set width
	 *
	 * @param integer $width
	 * @return \AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\MapTypes\MarkerClustererStyle
	 */
	public function setWidth($width) {
		$this->width = (integer) $width;
		return $this;
	}

	/**
	 * Get width
	 *
	 * @return integer
	 */
	public function getWidth() {
		return $this->width;
	}

	/**
	 * Set anchor
	 *
	 * @param array $anchor
	 * @return \AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\MapTypes\MarkerClustererStyle
	 */
	public function setAnchor(array $anchor) {
		$this->anchor = $anchor;
		return $this;
	}

	/**
	 * Get anchor
	 *
	 * @return array
	 */
	public function getAnchor() {
		return $this->anchor;
	}

	/**
	 * Set textColor
	 *
	 * @param string $textColor
	 * @return \AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\MapTypes\MarkerClustererStyle
	 */
	public function setTextColor($textColor) {
		$this->textColor = $textColor;
		return $this;
	}

	/**
	 * Get textColor
	 *
	 * @return string
	 */
	public function getTextColor() {
		return $this->textColor;
	}

	/**
	 * Set textSize
	 *
	 * @param integer $textSize
	 * @return \AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\MapTypes\MarkerClustererStyle
	 */
	public function setTextSize($textSize) {
		$this->textSize = (integer) $textSize;
		return $this;
	}

	/**
	 * Get textSize
	 *
	 * @return integer
	 */
	public function getTextSize() {
		return $this->textSize;
	}

}

?>