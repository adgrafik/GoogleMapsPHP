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

namespace GoogleMapsPHP\PlugIns\Map;

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

		// Split properties into API and plug-in options.
		$this->parseOptions($options, $objectOptions, $plugInOptions, $additionalOptions, '\\GoogleMapsPHP\\API\\Map\\MapOptions', '\\GoogleMapsPHP\\PlugIns\\Map\\PlugIn');

		// Create API object.
		$defaultOptions = $this->getSettings()->get('defaultOptions.map');
		$defaultOptions['mapTypeId'] = eval('return ' . $defaultOptions['mapTypeId'] . ';');
		$object = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Map', $additionalOptions['div'], $defaultOptions)
			->setOptions($objectOptions)
			->setDiv($this->getMapBuilder()->getMapId());

		// Create plug-in object.
		$plugIn = ClassUtility::makeInstance('\\GoogleMapsPHP\\PlugIns\\Map\\PlugIn', $this->getMapBuilder(), $plugInOptions)
			->setId($this->getMapBuilder()->getMapId())
			->setObject($object);

		$this->getMapBuilder()->getJsonObject()->setMapPlugIn($plugIn);
	}

}

?>