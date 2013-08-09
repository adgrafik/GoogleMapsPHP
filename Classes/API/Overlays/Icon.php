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
 * API equivalent to google.maps.Icon.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class Icon extends AbstractIcon {

	/**
	 * @var \GoogleMapsPHP\API\Base\Point $origin
	 */
	public $origin;

	/**
	 * @var \GoogleMapsPHP\API\Base\Size $scaledSize
	 */
	public $scaledSize;

	/**
	 * @var \GoogleMapsPHP\API\Base\Size $size
	 */
	public $size;

	/**
	 * @var string $url
	 */
	public $url;

	/**
	 * Constructor
	 *
	 * @param string|array $options
	 */
	public function __construct($options = '') {
		if (is_array($options)) {
			ClassUtility::setPropertiesFromArray($this, $options);
		} else {
			$this->setUrl($options);
		}
	}

	/**
	 * Set origin
	 *
	 * @param \GoogleMapsPHP\API\Base\Point $origin
	 * @return \GoogleMapsPHP\API\Overlays\Icon
	 */
	public function setOrigin(\GoogleMapsPHP\API\Base\Point $origin) {
		$this->origin = $origin;
		return $this;
	}

	/**
	 * Get origin
	 *
	 * @return \GoogleMapsPHP\API\Base\Point
	 */
	public function getOrigin() {
		return $this->origin;
	}

	/**
	 * Set scaledSize
	 *
	 * @param \GoogleMapsPHP\API\Base\Size $scaledSize
	 * @return \GoogleMapsPHP\API\Overlays\Icon
	 */
	public function setScaledSize(\GoogleMapsPHP\API\Base\Size $scaledSize) {
		$this->scaledSize = $scaledSize;
		return $this;
	}

	/**
	 * Get scaledSize
	 *
	 * @return \GoogleMapsPHP\API\Base\Size
	 */
	public function getScaledSize() {
		return $this->scaledSize;
	}

	/**
	 * Set size
	 *
	 * @param \GoogleMapsPHP\API\Base\Size $size
	 * @return \GoogleMapsPHP\API\Overlays\Icon
	 */
	public function setSize(\GoogleMapsPHP\API\Base\Size $size) {
		$this->size = $size;
		return $this;
	}

	/**
	 * Get size
	 *
	 * @return \GoogleMapsPHP\API\Base\Size
	 */
	public function getSize() {
		return $this->size;
	}

	/**
	 * Set url
	 *
	 * @param string $url
	 * @return \GoogleMapsPHP\API\Overlays\Icon
	 */
	public function setUrl($url) {
		$this->url = $url;
		return $this;
	}

	/**
	 * Get url
	 *
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
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