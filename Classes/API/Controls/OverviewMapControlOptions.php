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
 * API equivalent to google.maps.OverviewMapControlOptions.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class OverviewMapControlOptions extends AbstractControlOptions {

	/**
	 * @var boolean $opened
	 */
	public $opened;

	/**
	 * Set opened
	 *
	 * @param boolean $opened
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\OverviewMapControlOptions
	 */
	public function setOpened($opened) {
		$this->opened = (boolean) $opened ?: NULL;
		return $this;
	}

	/**
	 * Get opened
	 *
	 * @return boolean
	 */
	public function isOpened() {
		return $this->opened;
	}

}

?>