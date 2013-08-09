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

namespace GoogleMapsPHP\PlugIns\Polygon;

/**
 * Plug-in class for GoogleMapsPHP initial options.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class PlugIn extends \GoogleMapsPHP\PlugIns\AbstractPlugIn {

	/**
	 * isWithinViewport
	 *
	 * @param \GoogleMapsPHP\API\Base\LatLngBounds $bounds
	 * @return boolean
	 */
	public function isWithinViewport(\GoogleMapsPHP\API\Base\LatLngBounds $bounds) {

		$paths = $this->getObject()->getPaths();
		foreach ($paths as &$latlng) {
			if ($bounds->contains($latlng)) {
				return TRUE;
			}
		}

		return FALSE;
	}

}

?>