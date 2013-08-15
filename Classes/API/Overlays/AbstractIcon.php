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

namespace AdGrafik\GoogleMapsPHP\API\Overlays;

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * AbstractIcon.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
abstract class AbstractIcon extends \AdGrafik\GoogleMapsPHP\Object\PropertyArrayAccess implements IconInterface {

	/**
	 * @var \AdGrafik\GoogleMapsPHP\API\Base\Point $anchor
	 */
	public $anchor;

	/**
	 * Set anchor
	 *
	 * @param array|\AdGrafik\GoogleMapsPHP\API\Base\Point $anchor
	 * @return \AdGrafik\GoogleMapsPHP\API\Overlays\Icon
	 */
	public function setAnchor($anchor) {

		if ($anchor instanceof \AdGrafik\GoogleMapsPHP\API\Base\Point === FALSE) {
			$anchor = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\API\\Base\\Point', $anchor);
		}

		$this->anchor = $anchor;
		return $this;
	}

	/**
	 * Get anchor
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Base\Point
	 */
	public function getAnchor() {
		return $this->anchor;
	}

}

?>