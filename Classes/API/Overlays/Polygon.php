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
 * API equivalent to google.maps.Polygon.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class Polygon extends \AdGrafik\GoogleMapsPHP\Object\OptionsArrayAccess implements \AdGrafik\GoogleMapsPHP\API\Overlays\OverlayInterface {

	/**
	 * @var \AdGrafik\GoogleMapsPHP\API\Overlays\PolygonOptions $options
	 */
	public $options;

	/**
	 * Constructor
	 *
	 * @param mixed $options
	 */
	public function __construct($options) {

		// Set required values
		$this->options = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\API\\Overlays\\PolygonOptions');

		// Set properties
		$this->setOptions($options);
	}

	/**
	 * Set options
	 *
	 * @param mixed $options Can be an object of type \AdGrafik\GoogleMapsPHP\API\Overlays\PolygonOptions or an map options array.
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\Polygon
	 */
	public function setOptions($options) {
		if (is_array($options)) {
			ClassUtility::setPropertiesFromArray($this->options, $options);
		} else if ($options instanceof \AdGrafik\GoogleMapsPHP\API\Overlays\PolygonOptions === FALSE) {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\InvalidValueException('Map options must be an array or an instance of "\AdGrafik\GoogleMapsPHP\API\Overlays\PolygonOptions".', 1369563745);
		} else {
			$this->options = $options;
		}
		return $this;
	}

	/**
	 * Get options
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\PolygonOptions
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