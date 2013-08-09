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

namespace GoogleMapsPHP\API\MapTypes;

use GoogleMapsPHP\Utility\ClassUtility;

/**
 * API equivalent to google.maps.StyledMapType.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class StyledMapType extends \GoogleMapsPHP\Object\OptionsArrayAccess {

	/**
	 * @var array<array>|array<\GoogleMapsPHP\API\MapTypes\MapTypeStyle> $styles
	 */
	public $styles;

	/**
	 * @var array|\GoogleMapsPHP\API\MapTypes\StyledMapTypeOptions $options
	 */
	public $options;

	/**
	 * Set mapTypeIds
	 *
	 * @param array $styles
	 * @param array|\GoogleMapsPHP\API\MapTypes\StyledMapTypeOptions $options
	 */
	public function __construct($styles = array(), $options = array()) {

		// Set required values
		$this->options = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\MapTypes\\StyledMapTypeOptions');

		// Set properties
		$this->setStyles($styles);
		$this->setOptions($options);
	}

	/**
	 * Set styles
	 *
	 * @param array<array>|array<\GoogleMapsPHP\API\MapTypes\MapTypeStyle> $styles
	 * @return \GoogleMapsPHP\API\MapTypes\StyledMapType
	 */
	public function setStyles(array $styles) {

		foreach ($styles as $key => &$style) {
			if ($style instanceof \GoogleMapsPHP\API\MapTypes\MapTypeStyle === FALSE) {
				$styles[$key] = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\MapTypes\\MapTypeStyle', $style);
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
	 * @param array|\GoogleMapsPHP\API\MapTypes\StyledMapTypeOptions $options
	 * @return \GoogleMapsPHP\API\MapTypes\StyledMapType
	 */
	public function setOptions($options) {
		if (is_array($options)) {
			ClassUtility::setPropertiesFromArray($this->options, $options);
		} else if ($options instanceof \GoogleMapsPHP\API\MapTypes\StyledMapTypeOptions === FALSE) {
			throw new \GoogleMapsPHP\Exceptions\InvalidValueException('Map options must be an array or an instance of "\GoogleMapsPHP\API\Map\MapOptions".', 1369563745);
		} else {
			$this->options = $options;
		}
		return $this;
	}

	/**
	 * Get options
	 *
	 * @return \GoogleMapsPHP\API\MapTypes\StyledMapTypeOptions
	 */
	public function getOptions() {
		return $this->options;
	}

}

?>