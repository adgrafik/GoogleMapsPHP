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

namespace GoogleMapsPHP\PlugIns\Polyline;

use GoogleMapsPHP\Utility\ClassUtility;

/**
 * Builder class for GoogleMapsPHP plug-in.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class Builder extends \GoogleMapsPHP\PlugIns\AbstractBuilder {

	/**
	 * Build a plugIn
	 *
	 * @param array $options
	 * @return void
	 * @throws \GoogleMapsPHP\Exceptions\RequiredArgumentMissingException
	 */
	public function build(array $options = array()) {

		if (is_array($options) && isset($options['path']) === FALSE) {
			throw new \GoogleMapsPHP\Exceptions\RequiredArgumentMissingException('The property "path" of \GoogleMapsPHP\API\Overlays\Polyline is required.', 1373132025);
		}

		// Find option split configuration for markers.
		if (isset($options['marker'])) {
			$markers = $this->parseOptionSplit($options, 'path');
		}

		$options = array($options);
		foreach ($options as $key => &$value) {

			// Split properties into API and plug-in options.
			$this->parseOptions($value, $objectOptions, $plugInOptions, $additionalOptions, '\\GoogleMapsPHP\\API\\Overlays\\PolylineOptions', '\\GoogleMapsPHP\\PlugIns\\Polyline\\PlugIn');

			// Create API object.
			$object = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Overlays\\Polyline', $objectOptions);

			// Create plug-in object.
			$plugIn = ClassUtility::makeInstance('\\GoogleMapsPHP\\PlugIns\\Polyline\\PlugIn', $this->getMapBuilder(), $plugInOptions)
				->setId($this->evaluateId($plugInOptions))
				->setObject($object);

			$this->getMapBuilder()->getJsonObject()->addPlugIn($plugIn);

			// Create info window.
			if (isset($additionalOptions['infoWindow'])) {

				// If a position is set use this, else calculate the center of the poly shape.
				if (isset($additionalOptions['infoWindow']['position'])) {
					// If position value is an instance of LatLng or a string containing a "," it must be an explicit position, 
					// else it will be the position of the angle of the ploy shape.
					if ($additionalOptions['infoWindow']['position'] instanceof \GoogleMapsPHP\API\Base\LatLng === FALSE && strpos($additionalOptions['infoWindow']['position'], ',') === FALSE) {
						// Position counting begins with 1.
						$pathKey = $additionalOptions['infoWindow']['position'] - 1;
						$additionalOptions['infoWindow']['position'] = $value['path'][$pathKey];
					}
				} else {
					$bounds = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Base\\LatLngBounds');
					foreach ($value['path'] as &$latlng) {
						$bounds->extend($latlng);
					}
					$additionalOptions['infoWindow']['position'] = $bounds->getCenter();
				}

				$additionalOptions['infoWindow']['anchor'] = $plugIn;
				$this->getMapBuilder()->add('InfoWindow', $additionalOptions['infoWindow']);
			}

			// Create markers
			if (isset($additionalOptions['marker'])) {
				$markerOptions = array();
				foreach ($markers as $key => &$marker) {
					$markerOptions = $marker['marker'];
					$markerOptions['position'] = $value['path'][$key];
					$this->getMapBuilder()->add('Marker', $markerOptions);
				}
			}
		}
	}

}

?>