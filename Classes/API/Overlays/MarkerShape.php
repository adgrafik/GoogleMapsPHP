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
 * API equivalent to google.maps.MarkerShape.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class MarkerShape extends \GoogleMapsPHP\Object\PropertyArrayAccess {

	/**
	 * @var array $coords
	 */
	public $coords;

	/**
	 * @var string $type
	 */
	public $type;

	/**
	 * Constructor
	 *
	 * @param array $options
	 * @throws \GoogleMapsPHP\Exceptions\RequiredArgumentMissingException
	 */
	public function __construct(array $options = array()) {
		ClassUtility::setPropertiesFromArray($this, $options);
	}

	/**
	 * Set coords
	 *
	 * @param array $coords
	 * @return \GoogleMapsPHP\API\Overlays\MarkerShape
	 */
	public function setCoords(array $coords) {
		$this->coords = $coords;
		return $this;
	}

	/**
	 * Get coords
	 *
	 * @return array
	 */
	public function getCoords() {
		return $this->coords;
	}

	/**
	 * Set type
	 *
	 * @param string $type
	 * @return \GoogleMapsPHP\API\Overlays\MarkerShape
	 */
	public function setType(string $type) {
		$this->type = $type;
		return $this;
	}

	/**
	 * Get type
	 *
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

}

?>