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
 * API equivalent to google.maps.Polyline.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class Polyline extends \AdGrafik\GoogleMapsPHP\Object\OptionsArrayAccess implements \AdGrafik\GoogleMapsPHP\API\Overlays\OverlayInterface {

	/**
	 * @var \AdGrafik\GoogleMapsPHP\API\Overlays\PolylineOptions $options
	 */
	public $options;

	/**
	 * Constructor
	 *
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Overlays\PolylineOptions $options
	 */
	public function __construct($options) {
		$this->setOptions($options);
	}

	/**
	 * Set options
	 *
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Overlays\PolylineOptions $options
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\Polyline
	 */
	public function setOptions($options) {
		if (is_array($options)) {
			$this->options = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Overlays\\PolylineOptions', $options);
		} else if ($options instanceof \AdGrafik\GoogleMapsPHP\API\Overlays\PolylineOptions) {
			$this->options = $options;
		} else {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\InvalidValueException('Options must be an array or an instance of "\AdGrafik\GoogleMapsPHP\API\Overlays\PolylineOptions".', 1369563745);
		}
		return $this;
	}

	/**
	 * Get options
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\PolylineOptions
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