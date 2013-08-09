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

namespace GoogleMapsPHP\PlugIns\KmlLayer;

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
	 */
	public function build(array $options = array()) {

		if (isset($options['url']) === FALSE) {
			throw new \GoogleMapsPHP\Exceptions\RequiredArgumentMissingException('The property "url" of \GoogleMapsPHP\API\Layers\Kml is required.', 1373132025);
		}

		// Split properties into API and plug-in options.
		$this->parseOptions($options, $objectOptions, $plugInOptions, $additionalOptions, '\\GoogleMapsPHP\\API\\Layers\\KmlOptions', '\\GoogleMapsPHP\\PlugIns\\KmlLayer\\PlugIn');

		// Create API object.
		$object = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Layers\\KmlLayer', $objectOptions);

		// Create plug-in object.
		$plugIn = ClassUtility::makeInstance('\\GoogleMapsPHP\\PlugIns\\KmlLayer\\PlugIn', $this->getMapBuilder(), $plugInOptions)
			->setId($this->evaluateId($plugInOptions))
			->setObject($object);

		$this->getMapBuilder()->getJsonObject()->addPlugIn($plugIn);
	}

}

?>