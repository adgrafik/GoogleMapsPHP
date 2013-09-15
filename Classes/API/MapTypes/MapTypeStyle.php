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
 * API equivalent to google.maps.MapTypeStyle.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class MapTypeStyle {

	/**
	 * @var string $elementType
	 */
	public $elementType;

	/**
	 * @var string $featureType
	 */
	public $featureType;

	/**
	 * @var array $stylers
	 */
	public $stylers;

	/**
	 * Constructor
	 *
	 * @param array $options
	 */
	public function __construct(array $options = array()) {
		$this->stylers = array();
		ClassUtility::setPropertiesFromArray($this, $options);
	}

	/**
	 * Set elementType
	 *
	 * @param string $elementType
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyle
	 */
	public function setElementType($elementType) {
		$this->elementType = $elementType;
		return $this;
	}

	/**
	 * Get elementType
	 *
	 * @return string
	 */
	public function getElementType() {
		return $this->elementType;
	}

	/**
	 * Set featureType
	 *
	 * @param string $featureType
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyle
	 */
	public function setFeatureType($featureType) {
		$this->featureType = $featureType;
		return $this;
	}

	/**
	 * Get featureType
	 *
	 * @return string
	 */
	public function getFeatureType() {
		return $this->featureType;
	}

	/**
	 * Set stylers
	 *
	 * @param array $stylers
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyle
	 */
	public function setStylers(array $stylers) {
		foreach ($stylers as &$styler) {
			$this->addStyler($styler);
		}
		return $this;
	}

	/**
	 * Add a styler
	 *
	 * @param array $styler
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyle
	 */
	public function addStyler(array $styler) {

		if ($styler instanceof \AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyler === FALSE) {
			$styler = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\MapTypes\\MapTypeStyler', $styler);
		}

		$this->stylers[] = $styler;
		return $this;
	}

	/**
	 * Get stylers
	 *
	 * @return array
	 */
	public function getStylers() {
		return $this->stylers;
	}

}

?>