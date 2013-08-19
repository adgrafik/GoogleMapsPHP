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

namespace AdGrafik\GoogleMapsPHP\PlugIns\Circle;

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

		if (is_array($options) && isset($options['center']) === FALSE) {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\RequiredArgumentMissingException('The property "center" of \AdGrafik\GoogleMapsPHP\API\Overlays\Circle is required.', 1371382446);
		}

		// Split properties into API and plug-in options.
		$options = $this->parseOptionSplit($options, 'center');

		foreach ($options as $key => &$value) {

			// Split properties to API and layer options.
			$this->parseOptions($value, $objectOptions, $plugInOptions, $additionalOptions, '\\AdGrafik\\GoogleMapsPHP\\API\\Overlays\\CircleOptions', '\\AdGrafik\\GoogleMapsPHP\\PlugIns\\Circle\\PlugIn');

			// Create API object.
			$object = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\API\\Overlays\\Circle', $objectOptions);

			// Create plug-in object.
			$plugIn = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\PlugIns\\Circle\\PlugIn', $this->getMapBuilder(), $plugInOptions)
				->setId($this->evaluateId($plugInOptions))
				->setObject($object);

			$this->getMapBuilder()->getJsonObject()->addPlugIn($plugIn);

			// Create info window.
			if (isset($additionalOptions['infoWindow'])) {

				// If no position is set use the center of the shape.
				if (isset($additionalOptions['infoWindow']['position']) === FALSE) {
					$additionalOptions['infoWindow']['position'] = $object->getCenter();
				}

				$this->getMapBuilder()->add('InfoWindow', $additionalOptions['infoWindow']);
			}
		}
	}

}

?>