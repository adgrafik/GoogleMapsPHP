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

namespace AdGrafik\GoogleMapsPHP\API\MapTypes;

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * API equivalent to google.maps.StyledMapType.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class StyledMapType extends \AdGrafik\GoogleMapsPHP\Object\OptionsArrayAccess {

	/**
	 * @var array<array>|array<\AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyle> $styles
	 */
	public $styles;

	/**
	 * @var array|\AdGrafik\GoogleMapsPHP\API\MapTypes\StyledMapTypeOptions $options
	 */
	public $options;

	/**
	 * Set mapTypeIds
	 *
	 * @param array $styles
	 * @param array|\AdGrafik\GoogleMapsPHP\API\MapTypes\StyledMapTypeOptions $options
	 */
	public function __construct($styles = array(), $options = array()) {

		// Set required values
		$this->options = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\MapTypes\\StyledMapTypeOptions');

		// Set properties
		$this->setStyles($styles);
		$this->setOptions($options);
	}

	/**
	 * Set styles
	 *
	 * @param array<array>|array<\AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyle> $styles
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\StyledMapType
	 */
	public function setStyles(array $styles) {

		foreach ($styles as $key => &$style) {
			if ($style instanceof \AdGrafik\GoogleMapsPHP\API\MapTypes\MapTypeStyle === FALSE) {
				$styles[$key] = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\MapTypes\\MapTypeStyle', $style);
			}
		}

		$this->styles = $styles;
		return $this;
	}

	/**
	 * Get styles
	 *
	 * @return array
	 */
	public function getStyles() {
		return $this->styles;
	}

	/**
	 * Set options
	 *
	 * @param array|\AdGrafik\GoogleMapsPHP\API\MapTypes\StyledMapTypeOptions $options
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\StyledMapType
	 */
	public function setOptions($options) {
		if (is_array($options)) {
			ClassUtility::setPropertiesFromArray($this->options, $options);
		} else if ($options instanceof \AdGrafik\GoogleMapsPHP\API\MapTypes\StyledMapTypeOptions === FALSE) {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\InvalidValueException('Map options must be an array or an instance of "\AdGrafik\GoogleMapsPHP\API\Map\MapOptions".', 1369563745);
		} else {
			$this->options = $options;
		}
		return $this;
	}

	/**
	 * Get options
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\MapTypes\StyledMapTypeOptions
	 */
	public function getOptions() {
		return $this->options;
	}

}

?>