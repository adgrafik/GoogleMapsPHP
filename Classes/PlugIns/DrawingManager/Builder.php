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

namespace AdGrafik\GoogleMapsPHP\PlugIns\DrawingManager;

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

		// Split properties to API and layer options.
		$this->parseOptions($options, $objectOptions, $plugInOptions, $additionalOptions, 'AdGrafik\\GoogleMapsPHP\\API\\Drawing\\DrawingManagerOptions', 'AdGrafik\\GoogleMapsPHP\\PlugIns\\DrawingManager\\PlugIn');

		// Create API object.
		$object = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Drawing\\DrawingManager', $objectOptions);

		// Create plug-in object.
		$plugIn = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\PlugIns\\DrawingManager\\PlugIn', $this->getMapBuilder(), $plugInOptions)
			->setId($this->evaluateId($plugInOptions))
			->setObject($object);

		$this->getMapBuilder()->getJsonObject()->addPlugIn($plugIn);
	}

}

?>