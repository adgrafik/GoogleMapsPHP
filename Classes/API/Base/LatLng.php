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

namespace AdGrafik\GoogleMapsPHP\API\Base;

/**
 * API equivalent to google.maps.LatLng.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class LatLng extends \AdGrafik\GoogleMapsPHP\Object\PropertyArrayAccess {

	/**
	 * @var float $latitude
	 */
	protected $latitude;

	/**
	 * @var float $longitude
	 */
	protected $longitude;

	/**
	 * @var boolean $noWrap
	 */
	protected $noWrap;

	/**
	 * @var string $className
	 */
	public $className;

	/**
	 * @var array $arguments
	 */
	public $arguments;

	/**
	 * Constructor
	 *
	 * @param mixed $latitude Can be a string of latitude,longitude or a float of latitude.
	 * @param float $longitude
	 * @param boolean $noWrap
	 */
	public function __construct($latitude, $longitude = NULL, $noWrap = FALSE) {

		$this->setLatLng($latitude, $longitude);
		$this->setNoWrap($noWrap);

		$this->className = 'LatLng';
		$this->arguments = array(
			&$this->latitude,
			&$this->longitude,
			&$this->noWrap
		);
	}

	/**
	 * Set latitude and longitude
	 *
	 * @param mixed $latitude Can be a string of latitude,longitude or a float of latitude.
	 * @param float $longitude
	 * @return \AdGrafik\GoogleMapsPHP\API\Base\LatLng
	 * @throws \AdGrafik\GoogleMapsPHP\Exceptions\ValueNotValidException
	 */
	public function setLatLng($latitude, $longitude = NULL) {

		if ($longitude === NULL) {
			list($latitude, $longitude) = explode(',', $latitude);
		}

		if ($longitude === NULL) {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\InvalidValueException('The longitude was not set.', 1369496352);
		}

		$this->setLatitude($latitude);
		$this->setLongitude($longitude);

		return $this;
	}

	/**
	 * Set latitude
	 *
	 * @param float $latitude
	 * @return \AdGrafik\GoogleMapsPHP\API\Base\LatLng
	 */
	public function setLatitude($latitude) {
		$this->latitude = (float) $latitude;
		return $this;
	}

	/**
	 * Get latitude
	 *
	 * @return float
	 */
	public function getLatitude() {
		return $this->latitude;
	}

	/**
	 * Set longitude
	 *
	 * @param float $longitude
	 * @return \AdGrafik\GoogleMapsPHP\API\Base\LatLng
	 */
	public function setLongitude($longitude) {
		$this->longitude = (float) $longitude;
		return $this;
	}

	/**
	 * Get longitude
	 *
	 * @return float
	 */
	public function getLongitude() {
		return $this->longitude;
	}

	/**
	 * Set noWrap
	 *
	 * @param boolean $noWrap
	 * @return \AdGrafik\GoogleMapsPHP\API\Base\LatLng
	 */
	public function setNoWrap($noWrap) {
		$this->noWrap = (boolean) $noWrap;
		return $this;
	}

	/**
	 * Get noWrap
	 *
	 * @return boolean
	 */
	public function isNoWrap() {
		return $this->noWrap;
	}

	/**
	 * toString
	 *
	 * @return string
	 */
	public function toString() {
		return sprintf(
			'(%f, %f)',
			$this->getLatitude(),
			$this->getLongitude()
		);
	}

	/**
	 * toUrlValue
	 *
	 * @param $precision
	 * @return string
	 */
	public function toUrlValue($precision = 6) {
		return sprintf(
			'%f,%f',
			round($this->getLatitude(), $precision),
			round($this->getLongitude(), $precision)
		);
	}

	/**
	 * printJavaScript
	 *
	 * @return string
	 */
	public function printJavaScript() {
		return sprintf(
			'new google.maps.LatLng(%f, %f%s)',
			$this->getLatitude(),
			$this->getLongitude(),
			$this->isNoWrap() ? ', true' : ''
		);
	}

	/**
	 * __toString
	 *
	 * @return string
	 */
	public function __toString() {

		try {
			$javaScript = $this->printJavaScript();
		} catch (\Exception $exception) {
			$javaScript = (string) $exception;
		}

		return $javaScript;
	}

}

?>