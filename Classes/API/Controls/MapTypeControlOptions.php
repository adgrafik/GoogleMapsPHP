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
 * API equivalent to google.maps.MapTypeControlOptions.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class MapTypeControlOptions extends AbstractControlOptions {

	/**
	 * @var array $mapTypeIds
	 */
	public $mapTypeIds;

	/**
	 * @var string $position
	 */
	public $position;

	/**
	 * @var string $style
	 */
	public $style;

	/**
	 * Set mapTypeIds
	 *
	 * @param string|array $mapTypeIds
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\MapTypeControlOptions
	 */
	public function setMapTypeIds($mapTypeIds) {

		if (!$mapTypeIds) {
			$this->mapTypeIds = NULL;
			return $this;
		}

		if (is_array($mapTypeIds) === FALSE) {
			$mapTypeIds = explode(',', $mapTypeIds);
		}

		$this->mapTypeIds = array();

		foreach ($mapTypeIds as &$mapTypeId) {
			$this->addMapTypeId($mapTypeId);
		}

		return $this;
	}

	/**
	 * Add mapTypeId
	 *
	 * @param string $mapTypeId
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\MapTypeControlOptions
	 */
	public function addMapTypeId($mapTypeId) {

		if (!in_array($mapTypeId, (array) $this->mapTypeIds)) {

			if ($mapTypeId == \AdGrafik\GoogleMapsPHP\API\Map\MapTypeId::HYBRID
					|| $mapTypeId == \AdGrafik\GoogleMapsPHP\API\Map\MapTypeId::ROADMAP
					|| $mapTypeId == \AdGrafik\GoogleMapsPHP\API\Map\MapTypeId::SATELLITE
					|| $mapTypeId == \AdGrafik\GoogleMapsPHP\API\Map\MapTypeId::TERRAIN) {

				$this->mapTypeIds[] = \AdGrafik\GoogleMapsPHP\Utility\JsonUtility::makeConstant('MapTypeId', $mapTypeId);

			} else {
				$this->mapTypeIds[] = $mapTypeId;
			}
		}

		return $this;
	}

	/**
	 * Remove mapTypeId
	 *
	 * @param string $mapTypeId
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\MapTypeControlOptions
	 */
	public function removeMapTypeId($mapTypeId) {
		if ($key = array_search($mapTypeId, $this->mapTypeIds)) {
			unset($this->mapTypeIds[$key]);
		}
		return $this;
	}

	/**
	 * Get mapTypeIds
	 *
	 * @return array
	 */
	public function getMapTypeIds() {
		return $this->mapTypeIds;
	}

	/**
	 * Set position
	 *
	 * @param string $position
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\MapTypeControlOptions
	 */
	public function setPosition($position) {

		$this->position = ($position === \AdGrafik\GoogleMapsPHP\API\Controls\ControlPosition::TOP_RIGHT)
			? NULL
			: \AdGrafik\GoogleMapsPHP\Utility\JsonUtility::makeConstant('ControlPosition', $position);

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
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\MapTypeControlOptions
	 */
	public function setStyle($style) {

		$this->style = ($style === \AdGrafik\GoogleMapsPHP\API\Controls\MapTypeControlStyle::DEFAULT_STYLE)
			? NULL
			: \AdGrafik\GoogleMapsPHP\Utility\JsonUtility::makeConstant('MapTypeControlStyle', $style);

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