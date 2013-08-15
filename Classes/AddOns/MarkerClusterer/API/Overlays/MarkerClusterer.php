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
 * MarkerClusterer to manage per-zoom-level clusters for large amounts 
 * of markers (hundreds or thousands).
 *
 * @see http://gmaps-utility-library-dev.googlecode.com/svn/tags/markerclusterer/
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class MarkerClusterer extends \AdGrafik\GoogleMapsPHP\API\Overlays\OverlayView {

	/**
	 * @var \AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\Overlays\MarkerClustererOptions $options
	 */
	public $options;

	/**
	 * Constructor
	 *
	 * @param mixed $options
	 * @throws \AdGrafik\GoogleMapsPHP\Exceptions\RequiredArgumentMissingException
	 */
	public function __construct($options) {

		// Set required values
		$this->options = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\AddOns\\MarkerClusterer\\API\\Overlays\\MarkerClustererOptions');

		// Set properties
		$this->setOptions($options);
	}

	/**
	 * Set options
	 *
	 * @param mixed $options Can be an object of type \AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\Overlays\MarkerClustererOptions or an map options array.
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\MarkerClusterer
	 */
	public function setOptions($options) {
		if (is_array($options)) {
			ClassUtility::setPropertiesFromArray($this->options, $options);
		} else if ($options instanceof \AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\Overlays\MarkerClustererOptions === FALSE) {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\InvalidValueException('Map options must be an array or an instance of "\\AdGrafik\\GoogleMapsPHP\\AddOns\\MarkerClusterer\\API\\Overlays\\MarkerClustererOptions".', 1369563745);
		} else {
			$this->options = $options;
		}
		return $this;
	}

	/**
	 * Get options
	 *
	 * @return \AdGrafik\GoogleMapsPHP\AddOns\MarkerClusterer\API\Overlays\MarkerClustererOptions
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
		return call_user_func_array(array($this->options, $methodName), $arguments);
	}

}

?>