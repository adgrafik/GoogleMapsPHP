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

namespace AdGrafik\GoogleMapsPHP\API\Controls;

/**
 * API equivalent to google.maps.StreetViewAddressControlOptions.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class StreetViewAddressControlOptions extends AbstractControlOptions {

	/**
	 * @var string $position
	 */
	public $position;

	/**
	 * Set position
	 *
	 * @param string $position
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\StreetViewAddressControlOptions
	 */
	public function setPosition($position) {

		$this->position = new \StdClass();
		$this->position->className = 'ControlPosition';
		$this->position->constant = $position;

		return $this;
	}

	/**
	 * Get position
	 *
	 * @return string
	 */
	public function getPosition() {
		return $this->position;
	}

}

?>