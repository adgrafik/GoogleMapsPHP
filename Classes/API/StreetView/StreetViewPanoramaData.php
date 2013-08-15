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

namespace AdGrafik\GoogleMapsPHP\API\StreetView;

/**
 * API equivalent to google.maps.StreetViewPanoramaData.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class StreetViewPanoramaData {

	/**
	 * @var string $copyright
	 */
	public $copyright;

	/**
	 * @var string $imageDate
	 */
	public $imageDate;

	/**
	 * @var array $links
	 */
	public $links;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewLocation $location
	 * TODO: implement StreetViewLocation
	public $location;
	 */

	/**
	 * @var \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewTileData $tiles
	 * TODO: implement StreetViewTileData
	public $tiles;
	 */

	/**
	 * Set copyright
	 *
	 * @param string $copyright
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaData
	 */
	public function setCopyright($copyright) {
		$this->copyright = $copyright;
		return $this;
	}

	/**
	 * Get copyright
	 *
	 * @return string
	 */
	public function getCopyright() {
		return $this->copyright;
	}

	/**
	 * Set imageDate
	 *
	 * @param string $imageDate
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaData
	 */
	public function setImageDate($imageDate) {
		$this->imageDate = $imageDate;
		return $this;
	}

	/**
	 * Get imageDate
	 *
	 * @return string
	 */
	public function getImageDate() {
		return $this->imageDate;
	}

	/**
	 * Set links
	 *
	 * @param array $links
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaData
	 */
	public function setLinks(array $links) {
		$this->links = $links;
		return $this;
	}

	/**
	 * Get links
	 *
	 * @return array
	 */
	public function getLinks() {
		return $this->links;
	}

	/**
	 * Set location
	 *
	 * @param \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewLocation $location
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaData
	 */
	public function setLocation(\AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewLocation $location) {
		$this->location = $location;
		return $this;
	}

	/**
	 * Get location
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewLocation
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * Set tiles
	 *
	 * @param \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewTileData $tiles
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaData
	 */
	public function setTiles(\AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewTileData $tiles) {
		$this->tiles = $tiles;
		return $this;
	}

	/**
	 * Get tiles
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewTileData
	 */
	public function getTiles() {
		return $this->tiles;
	}

}

?>