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

/**
 * API equivalent to google.maps.Point.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class Point extends \GoogleMapsPHP\Object\PropertyArrayAccess {

	/**
	 * @var integer $x
	 */
	protected $x;

	/**
	 * @var integer $y
	 */
	protected $y;

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
	 * @param integer|array $x
	 * @param integer $y
	 */
	public function __construct($x, $y = NULL) {

		if (is_array($x)) {
			$y = isset($x['y'])
				? $x['y']
				: $x[1];
			$x = isset($x['x'])
				? $x['x']
				: $x[0];
		}

		$this->setX($x);
		$this->setY($y);

		$this->className = 'Point';
		$this->arguments = array(
			&$this->x,
			&$this->y
		);
	}

	/**
	 * Set x
	 *
	 * @param integer $x
	 * @return \GoogleMapsPHP\API\Base\Point
	 */
	public function setX($x) {
		$this->x = (integer) $x;
		return $this;
	}

	/**
	 * Get x
	 *
	 * @return integer
	 */
	public function getX() {
		return $this->x;
	}

	/**
	 * Set y
	 *
	 * @param integer $y
	 * @return \GoogleMapsPHP\API\Base\Point
	 */
	public function setY($y) {
		$this->y = (integer) $y;
		return $this;
	}

	/**
	 * Get y
	 *
	 * @return integer
	 */
	public function getY() {
		return $this->y;
	}

	/**
	 * printJavaScript
	 *
	 * @return string
	 */
	public function printJavaScript() {
		return sprintf(
			'new google.maps.Point%d, %d)',
			$this->getX(),
			$this->getY()
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