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

namespace GoogleMapsPHP\PlugIns;

use GoogleMapsPHP\Utility\ClassUtility;

/**
 * AbstractBuilder.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
abstract class AbstractBuilder implements \GoogleMapsPHP\PlugIns\BuilderInterface {

	/**
	 * @var integer $idCount
	 */
	static protected $idCount = 0;

	/**
	 * @var \GoogleMapsPHP\Configuration\Settings $settings
	 */
	protected $settings;

	/**
	 * @var \GoogleMapsPHP\MapBuilder\MapBuilderInterface $mapBuilder
	 */
	protected $mapBuilder;

	/**
	 * Constructor
	 *
	 * @param \GoogleMapsPHP\MapBuilder\MapBuilderInterface $mapBuilder
	 */
	public function __construct(\GoogleMapsPHP\MapBuilder\MapBuilderInterface $mapBuilder) {
		$this->setSettings(ClassUtility::makeInstance('\\GoogleMapsPHP\\Configuration\\Settings'));
		$this->setMapBuilder($mapBuilder);
	}

	/**
	 * Build a plugIn
	 *
	 * @param array [$options]
	 * @return void
	 */
	abstract public function build();

	/**
	 * Set settings
	 *
	 * @param \GoogleMapsPHP\Configuration\Settings $settings
	 * @return \GoogleMapsPHP\PlugIns\AbstractBuilder
	 */
	public function setSettings(\GoogleMapsPHP\Configuration\Settings $settings) {
		$this->settings = $settings;
		return $this;
	}

	/**
	 * Get settings
	 *
	 * @return \GoogleMapsPHP\Configuration\Settings
	 */
	public function getSettings() {
		return $this->settings;
	}

	/**
	 * Set mapBuilder
	 *
	 * @param \GoogleMapsPHP\MapBuilder\MapBuilderInterface $mapBuilder
	 * @return \GoogleMapsPHP\PlugIns\BuilderInterface
	 */
	public function setMapBuilder(\GoogleMapsPHP\MapBuilder\MapBuilderInterface $mapBuilder) {
		$this->mapBuilder = $mapBuilder;
		return $this;
	}

	/**
	 * Get mapBuilder
	 *
	 * @return \GoogleMapsPHP\MapBuilder\MapBuilderInterface
	 */
	public function getMapBuilder() {
		return $this->mapBuilder;
	}

	/**
	 * Evaluate the ID of an plugIn.
	 *
	 * @param array $options
	 * @return string
	 * @throws \GoogleMapsPHP\Exceptions\InvalidArgumentException
	 */
	protected function evaluateId($options) {

		$id = isset($options['id'])
			? $options['id']
			: self::$idCount++;

		$id = preg_replace('/[^0-9a-z_]/i', '_', $id);

		if ($this->getMapBuilder()->getJsonObject()->findPlugInById($id)) {
			throw new \GoogleMapsPHP\Exceptions\InvalidArgumentException(sprintf('Plug-in with ID "%s" already exists.', $id), 1371394123);
		}

		return $id;
	}

	/**
	 * This method search for *OptionSplit keys and returns the values matched the configuration.
	 * If *OptionSplit contains an asterisk "*" the values pushed to every item. If there are less values than items the last item will be repeat.
	 *
	 * @param array $options
	 * @param string $counterPropertyName
	 * @return array
	 */
	protected function parseOptionSplit($options, $counterPropertyName) {

		$finalOptions = array();

		// If counter property is no array no splitting is necessary.
		if (is_array($options[$counterPropertyName]) === FALSE) {
			$finalOptions = array($options);
			return $finalOptions;
		}

		$count = count($options[$counterPropertyName]);
		foreach ($options as $propertyName => &$propertyValue) {

			// Counting property needs special processing.
			if ($propertyName == $counterPropertyName) {
				foreach ($propertyValue as $key => &$value) {
					$finalOptions[$key][$counterPropertyName] = $value;
				}
				unset($options[$counterPropertyName]);
				continue;
			}

			// parse option split, else only if there is no option split set.
			if (strpos($propertyName, 'OptionSplit')) {

				// Get reference property from option split key.
				$referenceProperty = str_ireplace('OptionSplit', '', $propertyName);

				// Do only if reference property exists and is an array.
				if (isset($options[$referenceProperty]) && is_array($options[$referenceProperty])) {

					// If *OptionSplit contains an asterisk "*" the values pushed to every item. If there are less values than items the last item will be repeat.
					if ($options[$propertyName] === '*') {

						foreach ($options[$referenceProperty] as $key => &$propertyValue) {
							$finalOptions[$key][$referenceProperty] = $propertyValue;
						}

					} else {

						// Get the option split configuration.
						$configuration = \GoogleMapsPHP\Utility\OptionSplit::split(array('objectNumber' => $options[$propertyName]), $count);

						// Match each option split value with the content of the property value.
						foreach ($configuration as $key => &$objectNumber) {
							$objectNumber = $objectNumber['objectNumber'];
							if (isset($options[$referenceProperty][$objectNumber])) {
								$finalOptions[$key][$referenceProperty] = $options[$referenceProperty][$objectNumber];
							}
						}
					}
				}

			} else if (array_key_exists($propertyName . 'OptionSplit', $options) === FALSE) {

				for ($x = 0; $x < $count; $x++) { 
					$finalOptions[$x][$propertyName] = $propertyValue;
				}

			}

		}

		return $finalOptions;
	}

	/**
	 * Split properties to API and plugIn options.
	 *
	 * @param array &$options
	 * @param array &$plugInOptions
	 * @param array &$additionalOptions
	 * @param string $apiClassName
	 * @param string $plugInClassName
	 * @return void
	 */
	protected function parseOptions($options, &$apiOptions, &$plugInOptions, &$additionalOptions, $apiClassName, $plugInClassName) {

		$apiOptions = array();
		$plugInOptions = array();
		$additionalOptions = array();

		foreach ($options as $propertyName => &$propertyValue) {
			if (ClassUtility::propertyExists($apiClassName, $propertyName)) {
				$apiOptions[$propertyName] = $propertyValue;
			} else if (ClassUtility::propertyExists($plugInClassName, $propertyName)) {
				$plugInOptions[$propertyName] = $propertyValue;
			} else {
				$additionalOptions[$propertyName] = $propertyValue;
			}
		}
	}

	/**
	 * Match split option with properties.
	 *
	 * @param array $optionSplits
	 * @param integer $key
	 * @param array &$options
	 * @return void
	 */
	protected function matchSplitOptionWithProperties(array $optionSplits, $key, array &$options) {

		foreach ($optionSplits as $propertyName => &$optionSplit) {
			if (array_key_exists($propertyName, $options)) {
				$options[$key][$propertyName] = $optionSplit[$propertyName][$key];
			}
		}
	}

}

?>