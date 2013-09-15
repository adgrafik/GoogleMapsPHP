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
	 * @param array $plugInOptions
	 * @param array $objectOptions
	 * @param array $additionalOptions
	 * @return void
	 * @throws \AdGrafik\GoogleMapsPHP\Exceptions\RequiredArgumentMissingException
	 */
	public function build(array $options = array()) {

		if (isset($options['anchor']) === FALSE && isset($options['position']) === FALSE) {
			throw new \AdGrafik\GoogleMapsPHP\Exceptions\RequiredArgumentMissingException('The property "anchor" or "position" of \AdGrafik\GoogleMapsPHP\API\Overlays\InfoWindow is required.', 1371382056);
		}

		// Find option split configuration.
		$options = $this->parseOptionSplit($options, isset($options['position']) ? 'position' : 'content');
		$layers = array();

		foreach ($options as $key => &$value) {

			// Split properties into API and plug-in options.
			$this->parseOptions($value, $objectOptions, $plugInOptions, $additionalOptions, 'AdGrafik\\GoogleMapsPHP\\API\\Overlays\\InfoWindowOptions', 'AdGrafik\\GoogleMapsPHP\\PlugIns\\InfoWindow\\PlugIn');

			// If an anchor is set by ID attach this layer instead.
			if (isset($plugInOptions['anchor']) && $plugInOptions['anchor'] instanceof \AdGrafik\GoogleMapsPHP\PlugIns\PlugInInterface === FALSE) {
				$plugInOptions['anchor'] = $this->getMapBuilder()->getJsonObject()->findPlugInById($plugInOptions['anchor']);
			}

			// Create API object.
			$object = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Overlays\\InfoWindow', $objectOptions);

			// Create plug-in object.
			$plugIn = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\PlugIns\\InfoWindow\\PlugIn', $this->getMapBuilder(), $plugInOptions)
				->setId($this->evaluateId($plugInOptions))
				->setObject($object);

			$this->getMapBuilder()->getJsonObject()->addPlugIn($plugIn);
		}
	}
}

?>