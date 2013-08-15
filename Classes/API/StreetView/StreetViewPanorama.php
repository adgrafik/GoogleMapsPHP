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

namespace AdGrafik\GoogleMapsPHP\API\StreetView;

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * API equivalent to google.maps.StreetViewPanorama.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class StreetViewPanorama {

	/**
	 * @var \DOMElement $container
	 */
	public $container;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions $options
	 */
	public $options;

	/**
	 * Constructor
	 *
	 * @param \DOMElement $container
	 * @param mixed $options Can be an object of type \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions or an map options array.
	 */
	public function __construct(\DOMElement $container, $options = array()) {

		// Set required values
		$this->options = new \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions();

		// Set properties
		$this->setDiv($div);
		$this->setOptions($options);

		// Check required options
		if ($this->getCenter() === NULL) {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\RequiredArgumentMissingException('Missing option "center".', 1369566987);
		}
		if ($this->getMapTypeId() === NULL) {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\RequiredArgumentMissingException('Missing option "mapTypeId".', 1369566988);
		}
	}

	/**
	 * Set options
	 *
	 * @param mixed $options Can be an object of type \AdGrafik\GoogleMapsPHP\API\Overlays\MarkerOptions or an map options array.
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setOptions($options) {
		if (is_array($options)) {
			ClassUtility::setPropertiesFromArray($this->options, $options);
		} else if ($options instanceof \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions === FALSE) {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\InvalidValueException('Map options must be an array or an instance of "\AdGrafik\GoogleMapsPHP\API\Overlays\MarkerOptions".', 1369563745);
		} else {
			$this->options = $options;
		}
		return $this;
	}

	/**
	 * Get options
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\MarkerOptions
	 */
	public function getOptions() {
		return $this->options;
	}

	/**
	 * Overload __call
	 *
	 * @param string $propertyName
	 * @param mixed $propertyValue
	 * @return mixed
	 * @throws \AdGrafik\GoogleMapsPHP\Exceptions\InvalidMethodException
	 */
	public function __call($methodName, $arguments) {
		if (ClassUtility::methodExists($this->options, $methodName, FALSE) === FALSE) {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\InvalidMethodException(sprintf('Method "%s" not exists.', $methodName), 1369563744);
		}
		return call_user_func(array($this->options, $methodName), $arguments);
	}

}

?>