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

namespace GoogleMapsPHP\PlugIns\Marker;

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

		if (is_array($options) && isset($options['position']) === FALSE) {
			throw new \GoogleMapsPHP\Exceptions\RequiredArgumentMissingException('The property "position" of \GoogleMapsPHP\API\Overlays\Marker is required.', 1371382146);
		}

		// Split properties into API and plug-in options.
		$options = $this->parseOptionSplit($options, 'position');

		foreach ($options as $key => &$value) {

			// Split properties to API and layer options.
			$this->parseOptions($value, $objectOptions, $plugInOptions, $additionalOptions, '\\GoogleMapsPHP\\API\\Overlays\\MarkerOptions', '\\GoogleMapsPHP\\PlugIns\\Marker\\PlugIn');

			// Create API object.
			$object = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Overlays\\Marker', $objectOptions);

			// Create plug-in object.
			$plugIn = ClassUtility::makeInstance('\\GoogleMapsPHP\\PlugIns\\Marker\\PlugIn', $this->getMapBuilder(), $plugInOptions)
				->setId($this->evaluateId($plugInOptions))
				->setObject($object);

			$this->getMapBuilder()->getJsonObject()->addPlugIn($plugIn);

			// Create info window.
			if (isset($additionalOptions['infoWindow'])) {
				$additionalOptions['infoWindow']['anchor'] = $plugIn;
				$this->getMapBuilder()->add('InfoWindow', $additionalOptions['infoWindow']);
			}
		}
	}

}

?>