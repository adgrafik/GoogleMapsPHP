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

namespace AdGrafik\GoogleMapsPHP\PlugIns\InfoWindow;

/**
 * Plug-in class for GoogleMapsPHP initial options.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class PlugIn extends \AdGrafik\GoogleMapsPHP\PlugIns\AbstractPlugIn {

	/**
	 * @var string $anchor
	 */
	public $anchor;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\PlugIns\PlugInInterface $anchorObject
	 */
	protected $anchorObject;

	/**
	 * @var boolean $opened
	 */
	public $opened;

	/**
	 * @var boolean $closeOnClickAgain
	 */
	public $closeOnClickAgain;

	/**
	 * @var boolean $keepOpen
	 */
	public $keepOpen;

	/**
	 * Get anchorId
	 *
	 * @return string
	 */
	public function getAnchorId() {
		return ($this->getAnchor() ? $this->getAnchor()->getId() : NULL);
	}

	/**
	 * Set anchor
	 *
	 * @param \AdGrafik\GoogleMapsPHP\PlugIns\PlugInInterface $anchor
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\InfoWindow\PlugIn
	 */
	public function setAnchor(\AdGrafik\GoogleMapsPHP\PlugIns\PlugInInterface $anchor) {
		$this->anchorObject = $anchor;
		$this->anchor = $anchor->getId();
		return $this;
	}

	/**
	 * Get anchor
	 *
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\PlugInInterface
	 */
	public function getAnchor() {
		return $this->anchorObject;
	}

	/**
	 * Set opened
	 *
	 * @param boolean $opened
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\InfoWindow\PlugIn
	 */
	public function setOpened($opened) {
		$this->opened = (boolean) $opened;
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

	/**
	 * Set closeOnClickAgain
	 *
	 * @param boolean $closeOnClickAgain
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\InfoWindow\PlugIn
	 */
	public function setCloseOnClickAgain($closeOnClickAgain) {
		$this->closeOnClickAgain = (boolean) $closeOnClickAgain;
		return $this;
	}

	/**
	 * Get closeOnClickAgain
	 *
	 * @return boolean
	 */
	public function isCloseOnClickAgain() {
		return $this->closeOnClickAgain;
	}

	/**
	 * Set keepOpen
	 *
	 * @param boolean $keepOpen
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\InfoWindow\PlugIn
	 */
	public function setKeepOpen($keepOpen) {
		$this->keepOpen = (boolean) $keepOpen;
		return $this;
	}

	/**
	 * Get keepOpen
	 *
	 * @return boolean
	 */
	public function isKeepOpen() {
		return $this->keepOpen;
	}

	/**
	 * isWithinViewport
	 *
	 * @param \AdGrafik\GoogleMapsPHP\API\Base\LatLngBounds $bounds
	 * @return boolean
	 */
	public function isWithinViewport(\AdGrafik\GoogleMapsPHP\API\Base\LatLngBounds $bounds) {

		if ($position = $this->getObject()->getPosition()) {
			return $bounds->contains($position);
		} else if ($anchor = $this->getAnchor()) {
			return $anchor->isWithinViewport($bounds);
		} else {
			return TRUE;
		}
	}

}

?>