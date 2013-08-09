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

namespace GoogleMapsPHP\API\Controls;

/**
 * API equivalent to google.maps.ZoomControlOptions.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class ZoomControlOptions extends AbstractControlOptions {

	/**
	 * @var string $position
	 */
	public $position;

	/**
	 * @var string $style
	 */
	public $style;

	/**
	 * Set position
	 *
	 * @param string $position
	 * @return \GoogleMapsPHP\API\Controls\ZoomControlOptions
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

	/**
	 * Set style
	 *
	 * @param string $style
	 * @return \GoogleMapsPHP\API\Controls\ZoomControlOptions
	 */
	public function setStyle($style) {

		$this->style = new \StdClass();
		$this->style->className = 'ZoomControlStyle';
		$this->style->constant = $style;

		return $this;
	}

	/**
	 * Get style
	 *
	 * @return string
	 */
	public function getStyle() {
		return $this->style;
	}

}

?>