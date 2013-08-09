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

namespace GoogleMapsPHP\API\Base;

use GoogleMapsPHP\Utility\ClassUtility;

/**
 * API equivalent to google.maps.LatLngBounds.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class LatLngBounds extends \GoogleMapsPHP\Object\PropertyArrayAccess {

	/**
	 * @var \GoogleMapsPHP\API\Base\LatLng $northEast
	 */
	protected $northEast;

	/**
	 * @var \GoogleMapsPHP\API\Base\LatLng $southWest
	 */
	protected $southWest;

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
	 * Arguments examples
	 * ('47.359293,14.231415,49.544816,18.625946')
	 * ('47.359293,14.231415')
	 * ('47.359293,14.231415', '49.544816,18.625946')
	 * (\GoogleMapsPHP\API\Base\LatLng)
	 * (\GoogleMapsPHP\API\Base\LatLng, \GoogleMapsPHP\API\Base\LatLng)
	 *
	 * @param mixed $southWest Can be a string of latitude,longitude, a float of latitude or an instance of \GoogleMapsPHP\API\Base\LatLng.
	 * @param mixed $northEast Can be a string of latitude,longitude, a float of latitude or an instance of \GoogleMapsPHP\API\Base\LatLng.
	 */
	public function __construct($southWest = NULL, $northEast = NULL) {

		if ($northEast === NULL && $southWest !== NULL && $southWest instanceof \GoogleMapsPHP\API\Base\LatLng === FALSE) {
			@list($southWestLat, $southWestLng, $northEastLat, $northEastLng) = explode(',', $southWest);
			$southWest = $southWestLat . ',' . $southWestLng;
			if ($northEastLat !== NULL && $northEastLng !== NULL) {
				$northEast = $northEastLat . ',' . $northEastLng;
			}
		}

		if ($southWest) {
			$this->setSouthWest($southWest);
		}

		if ($northEast) {
			$this->setNorthEast($northEast);
		} else if ($southWest) {
			$this->setNorthEast($southWest);
		}

		$this->className = 'LatLngBounds';
		$this->arguments = array(
			&$this->northEast,
			&$this->southWest
		);
	}

	/**
	 * Set northEast
	 *
	 * @param mixed $northEast
	 * @return $northEastBounds
	 */
	public function setNorthEast($northEast) {

		if ($northEast instanceof \GoogleMapsPHP\API\Base\LatLng === FALSE) {
			$northEast = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Base\\LatLng', $northEast);
		}

		$this->northEast = $northEast;

		return $this;
	}

	/**
	 * Get northEast
	 *
	 * @return \GoogleMapsPHP\API\Base\LatLng
	 */
	public function getNorthEast() {
		return $this->northEast;
	}

	/**
	 * Set southWest
	 *
	 * @param mixed $southWest
	 * @return \GoogleMapsPHP\API\Base\LatLngBounds
	 */
	public function setSouthWest($southWest) {

		if ($southWest instanceof \GoogleMapsPHP\API\Base\LatLng === FALSE) {
			$southWest = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Base\\LatLng', $southWest);
		}

		$this->southWest = $southWest;

		return $this;
	}

	/**
	 * Get southWest
	 *
	 * @return \GoogleMapsPHP\API\Base\LatLng
	 */
	public function getSouthWest() {
		return $this->southWest;
	}

	/**
	 * Computes the center of this LatLngBounds.
	 *
	 * @return \GoogleMapsPHP\API\Base\LatLng
	 */
	public function getCenter() {

		$southWest = $this->getSouthWest();
		$northEast = $this->getNorthEast();

		$latitude = $southWest->getLatitude() + (($northEast->getLatitude() - $southWest->getLatitude()) / 2);
		$longitude = $southWest->getLongitude() + (($northEast->getLongitude() - $southWest->getLongitude()) / 2);

		return ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Base\\LatLng', $latitude, $longitude);
	}

	/**
	 * Returns TRUE if this bounds approximately equals the given bounds.
	 * 
	 * @param \GoogleMapsPHP\API\Base\LatLngBounds $bounds
	 * @return \GoogleMapsPHP\API\Base\LatLngBounds
	 */
	public function equals($bounds) {
		return ($this == $bounds);
	}

	/**
	 * Extends this bounds to contain the given point.
	 * 
	 * @param mixed $latLng
	 * @return \GoogleMapsPHP\API\Base\LatLngBounds
	 */
	public function extend($latLng) {

		if ($this->getSouthWest() === NULL) {
			$southWest = ($latLng instanceof \GoogleMapsPHP\API\Base\LatLng)
				? clone $latLng
				: ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Base\\LatLng', $latLng);
			$this->setSouthWest(clone $southWest);
		}

		if ($this->getNorthEast() === NULL) {
			$northEast = ($latLng instanceof \GoogleMapsPHP\API\Base\LatLng)
				? clone $latLng
				: ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Base\\LatLng', $latLng);
			$this->setNorthEast(clone $northEast);
		}

		if ($latLng instanceof \GoogleMapsPHP\API\Base\LatLng === FALSE) {
			$latLng = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Base\\LatLng', $latLng);
		}

		if ($latLng->getLatitude()  < $this->getSouthWest()->getLatitude())  $this->getSouthWest()->setLatitude($latLng->getLatitude());
		if ($latLng->getLongitude() < $this->getSouthWest()->getLongitude()) $this->getSouthWest()->setLongitude($latLng->getLongitude());
		if ($latLng->getLatitude()  > $this->getNorthEast()->getLatitude())  $this->getNorthEast()->setLatitude($latLng->getLatitude());
		if ($latLng->getLongitude() > $this->getNorthEast()->getLongitude()) $this->getNorthEast()->setLongitude($latLng->getLongitude());

		return $this;
	}

	/**
	 * Returns TRUE if the given lat/lng is in this bounds.
	 * 
	 * @param mixed $latLng
	 * @return boolean
	 */
	public function contains($latLng) {

		if ($latLng instanceof \GoogleMapsPHP\API\Base\LatLng === FALSE) {
			$latLng = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Base\\LatLng', $latLng);
		}

		return (
			   $latLng->getLatitude()  >= $this->getSouthWest()->getLatitude()
			&& $latLng->getLongitude() >= $this->getSouthWest()->getLongitude()
			&& $latLng->getLatitude()  <= $this->getNorthEast()->getLatitude()
			&& $latLng->getLongitude() <= $this->getNorthEast()->getLongitude()
		);
	}

	/**
	 * Returns TRUE if this bounds shares any points with this bounds.
	 * 
	 * @param \GoogleMapsPHP\API\Base\LatLngBounds $bounds
	 * @return boolean
	 */
	public function intersects($bounds) {

		if ($bounds instanceof \GoogleMapsPHP\API\Base\LatLngBounds === FALSE) {
			$bounds = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Base\\LatLngBounds', $bounds);
		}
	 // TODO: implement intersects for LatLngBounds
	}

	/**
	 * Extends this bounds to contain the union of this and the given bounds.
	 * 
	 * @param \GoogleMapsPHP\API\Base\LatLngBounds $bounds
	 * @return \GoogleMapsPHP\API\Base\LatLngBounds
	 */
	public function union($bounds) {

		if ($bounds instanceof \GoogleMapsPHP\API\Base\LatLngBounds === FALSE) {
			$bounds = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Base\\LatLngBounds', $bounds);
		}

		if ($this->southWest === NULL) {
			$this->setSouthWest(clone $bounds->getSouthWest());
		}

		if ($this->northEast === NULL) {
			$this->setNorthEast(clone $bounds->getNorthEast());
		}

		if ($bounds->getSouthWest()->getLatitude()  > $this->getSouthWest()->getLatitude())  $this->getSouthWest()->setLatitude($bounds->getSouthWest()->getLatitude());
		if ($bounds->getSouthWest()->getLongitude() < $this->getSouthWest()->getLongitude()) $this->getSouthWest()->setLongitude($bounds->getSouthWest()->getLongitude());
		if ($bounds->getNorthEast()->getLatitude()  < $this->getNorthEast()->getLatitude())  $this->getNorthEast()->setLatitude($bounds->getNorthEast()->getLatitude());
		if ($bounds->getNorthEast()->getLongitude() > $this->getNorthEast()->getLongitude()) $this->getNorthEast()->setLongitude($bounds->getNorthEast()->getLongitude());

		return $this;
	}

	/**
	 * toString
	 *
	 * @return string
	 */
	public function toString() {
		return sprintf(
			'((%f, %f), (%f, %f))',
			$this->getSouthWest()->getLatitude(),
			$this->getSouthWest()->getLongitude(),
			$this->getNorthEast()->getLatitude(),
			$this->getNorthEast()->getLongitude()
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
			'%f,%f,%f,%f',
			round($this->getSouthWest()->getLatitude(), $precision),
			round($this->getSouthWest()->getLongitude(), $precision),
			round($this->getNorthEast()->getLatitude(), $precision),
			round($this->getNorthEast()->getLongitude(), $precision)
		);
	}

	/**
	 * printJavaScript
	 *
	 * @return string
	 */
	public function printJavaScript() {
		return sprintf(
			'new google.maps.LatLngBounds(%s, %s)',
			$this->getSouthWest()->printJavaScript(),
			$this->getNorthEast()->printJavaScript()
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