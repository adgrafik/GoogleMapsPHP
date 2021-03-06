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

namespace AdGrafik\GoogleMapsPHP\PlugIns\Rectangle;

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * Builder class for GoogleMapsPHP plug-in.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class Builder extends \AdGrafik\GoogleMapsPHP\PlugIns\AbstractBuilder {

	/**
	 * Build a plugIn
	 *
	 * @param array $options
	 * @return void
	 * @throws \AdGrafik\GoogleMapsPHP\Exceptions\RequiredArgumentMissingException
	 */
	public function build(array $options = array()) {

		if (is_array($options) && isset($options['bounds']) === FALSE) {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\RequiredArgumentMissingException('The property "bounds" of \AdGrafik\GoogleMapsPHP\API\Overlays\Rectangle is required.', 1371382346);
		}

		// Split properties into API and plug-in options.
		$options = $this->parseOptionSplit($options, 'bounds');

		foreach ($options as $key => &$value) {

			// Split properties to API and layer options.
			$this->parseOptions($value, $objectOptions, $plugInOptions, $additionalOptions, 'AdGrafik\\GoogleMapsPHP\\API\\Overlays\\RectangleOptions', 'AdGrafik\\GoogleMapsPHP\\PlugIns\\Rectangle\\PlugIn');

			// Create API object.
			$object = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Overlays\\Rectangle', $objectOptions);

			// Create plug-in object.
			$plugIn = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\PlugIns\\Rectangle\\PlugIn', $this->getMapBuilder(), $plugInOptions)
				->setId($this->evaluateId($plugInOptions))
				->setObject($object);

			$this->getMapBuilder()->getJsonObject()->addPlugIn($plugIn);

			// Create info window.
			if (isset($additionalOptions['infoWindow'])) {

				// If a position is set use this, else calculate the center of the shape.
				if (isset($additionalOptions['infoWindow']['position'])) {
					// If position value is an instance of LatLng or a string containing a "," it must be an explicit position, 
					// else it will be the position of the angle of the ploy shape.
					if ($additionalOptions['infoWindow']['position'] instanceof \AdGrafik\GoogleMapsPHP\API\Base\LatLng === FALSE && strpos($additionalOptions['infoWindow']['position'], ',') === FALSE) {
						// Position counting begins with 1.
						$angleKey = $additionalOptions['infoWindow']['position'] - 1;
						switch ($additionalOptions['infoWindow']['position']) {
							case 1:
								$additionalOptions['infoWindow']['position'] = ClassUtility::makeInstance(
									'AdGrafik\\GoogleMapsPHP\\API\\Base\\LatLng',
									$object->getBounds()->getSouthWest()->getLatitude(),
									$object->getBounds()->getSouthWest()->getLongitude()
								);
								break;
							case 2:
								$additionalOptions['infoWindow']['position'] = ClassUtility::makeInstance(
									'AdGrafik\\GoogleMapsPHP\\API\\Base\\LatLng',
									$object->getBounds()->getSouthWest()->getLatitude(),
									$object->getBounds()->getNorthEast()->getLongitude()
								);
								break;
							case 3:
								$additionalOptions['infoWindow']['position'] = ClassUtility::makeInstance(
									'AdGrafik\\GoogleMapsPHP\\API\\Base\\LatLng',
									$object->getBounds()->getNorthEast()->getLatitude(),
									$object->getBounds()->getNorthEast()->getLongitude()
								);
								break;
							case 4:
								$additionalOptions['infoWindow']['position'] = ClassUtility::makeInstance(
									'AdGrafik\\GoogleMapsPHP\\API\\Base\\LatLng',
									$object->getBounds()->getNorthEast()->getLatitude(),
									$object->getBounds()->getSouthWest()->getLongitude()
								);
								break;
						}
					}
				} else {
					$additionalOptions['infoWindow']['position'] = $object->getBounds()->getCenter();
				}

				$additionalOptions['infoWindow']['anchor'] = $plugIn;
				$this->getMapBuilder()->add('InfoWindow', $additionalOptions['infoWindow']);
			}
		}
	}

}

?>