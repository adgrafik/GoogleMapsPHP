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
 * API equivalent to google.maps.Size.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class Size extends \AdGrafik\GoogleMapsPHP\Object\PropertyArrayAccess {

	/**
	 * @var integer $width
	 */
	protected $width;

	/**
	 * @var integer $height
	 */
	protected $height;

	/**
	 * @var string $widthUnit
	 */
	protected $widthUnit;

	/**
	 * @var string $heightUnit
	 */
	protected $heightUnit;

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
	 * @param integer $width
	 * @param integer $height
	 * @param string $widthUnit
	 * @param string $heightUnit
	 */
	public function __construct($width, $height, $widthUnit = NULL, $heightUnit = NULL) {

		$this->setWidth($width);
		$this->setHeight($height);

		if ($widthUnit !== NULL) {
			$this->setWidthUnit($widthUnit);
		}

		if ($heightUnit !== NULL) {
			$this->setHeightUnit($heightUnit);
		}

		$this->className = 'Size';
		$this->arguments = array(
			&$this->width,
			&$this->height,
			&$this->widthUnit,
			&$this->heightUnit
		);
	}

	/**
	 * Set width
	 *
	 * @param integer $width
	 * @return \AdGrafik\GoogleMapsPHP\API\Base\Point
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
	 * Set height
	 *
	 * @param integer $height
	 * @return \AdGrafik\GoogleMapsPHP\API\Base\Point
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
	 * Set widthUnit
	 *
	 * @param string $widthUnit
	 * @return \AdGrafik\GoogleMapsPHP\API\Base\Point
	 */
	public function setWidthUnit($widthUnit) {
		$this->widthUnit = $widthUnit;
		return $this;
	}

	/**
	 * Get widthUnit
	 *
	 * @return string
	 */
	public function getWidthUnit() {
		return $this->widthUnit;
	}

	/**
	 * Set heightUnit
	 *
	 * @param string $heightUnit
	 * @return \AdGrafik\GoogleMapsPHP\API\Base\Point
	 */
	public function setHeightUnit($heightUnit) {
		$this->heightUnit = $heightUnit;
		return $this;
	}

	/**
	 * Get heightUnit
	 *
	 * @return string
	 */
	public function getHeightUnit() {
		return $this->heightUnit;
	}

	/**
	 * printJavaScript
	 *
	 * @return string
	 */
	public function printJavaScript() {

		$widthUnit = $this->getWidthUnit()
			? ', \'' . $this->getWidthUnit() . '\''
			: ($this->getHeightUnit()
				? ', \'\''
				: ''
			);
		$heightUnit = $this->getHeightUnit()
			? ', ' . $this->getHeightUnit()
			: '';

		return sprintf('new google.maps.Size(%d, %d%s%s)', $this->getWidth(), $this->getHeight(), $widthUnit, $heightUnit);
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