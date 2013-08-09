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

namespace GoogleMapsPHP\API\Overlays;

use GoogleMapsPHP\Utility\ClassUtility;

/**
 * API equivalent to google.maps.Marker.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class Marker extends \GoogleMapsPHP\Object\OptionsArrayAccess implements \GoogleMapsPHP\API\Overlays\OverlayInterface {

	/**
	 * @var \GoogleMapsPHP\API\Overlays\MarkerOptions $options
	 */
	public $options;

	/**
	 * Constructor
	 *
	 * @param mixed $options
	 * @throws \GoogleMapsPHP\Exceptions\RequiredArgumentMissingException
	 */
	public function __construct($options) {

		// Set required values
		$this->options = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Overlays\\MarkerOptions');

		// Set properties
		$this->setOptions($options);

		// Check required options
		if ($this->getPosition() === NULL) {
			throw new \GoogleMapsPHP\Exceptions\RequiredArgumentMissingException('Missing option "position".', 1369555246);
		}
	}

	/**
	 * Set options
	 *
	 * @param mixed $options Can be an object of type \GoogleMapsPHP\API\Overlays\MarkerOptions or an map options array.
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setOptions($options) {
		if (is_array($options)) {
			ClassUtility::setPropertiesFromArray($this->options, $options);
		} else if ($options instanceof \GoogleMapsPHP\API\Overlays\MarkerOptions === FALSE) {
			throw new \GoogleMapsPHP\Exceptions\InvalidValueException('Map options must be an array or an instance of "\GoogleMapsPHP\API\Overlays\MarkerOptions".', 1369563745);
		} else {
			$this->options = $options;
		}
		return $this;
	}

	/**
	 * Get options
	 *
	 * @return \GoogleMapsPHP\API\Overlays\MarkerOptions
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
	 * @throws \GoogleMapsPHP\Exceptions\InvalidMethodException
	 */
	public function __call($methodName, $arguments) {
		if (ClassUtility::methodExists($this->options, $methodName, FALSE) === FALSE) {
			throw new \GoogleMapsPHP\Exceptions\InvalidMethodException(sprintf('Method "%s" not exists.', $methodName), 1369563744);
		}
		return call_user_func_array(array($this->options, $methodName), $arguments);
	}

}

?>