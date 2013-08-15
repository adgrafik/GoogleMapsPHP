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

namespace AdGrafik\GoogleMapsPHP\PlugIns;

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * AbstractPlugIn.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
abstract class AbstractPlugIn implements \AdGrafik\GoogleMapsPHP\PlugIns\PlugInInterface {

	/**
	 * @var \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface $mapBuilder
	 */
	protected $mapBuilder;

	/**
	 * @var string $id
	 */
	public $id;

	/**
	 * @var string $categoryId
	 */
	public $categoryId;

	/**
	 * @var string $plugInName
	 */
	public $plugInName;

	/**
	 * @var mixed $object
	 */
	public $object;

	/**
	 * Constructor
	 *
	 * @param \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface $mapBuilder
	 * @param array $options
	 */
	public function __construct(\AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface $mapBuilder, array $options = array()) {

		// Set required values
		$this->setMapBuilder($mapBuilder);
		$this->setId(spl_object_hash($this));
		$plugInName = str_replace('\PlugIn', '', get_class($this));
		$plugInName = substr($plugInName, strrpos($plugInName, '\\') + 1);
		$this->setPlugInName($plugInName);

		ClassUtility::setPropertiesFromArray($this, $options);
	}

	/**
	 * Set mapBuilder
	 *
	 * @param \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface $mapBuilder
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\PlugInInterface
	 */
	public function setMapBuilder(\AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface $mapBuilder) {
		$this->mapBuilder = $mapBuilder;
		return $this;
	}

	/**
	 * Get mapBuilder
	 *
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface
	 */
	public function getMapBuilder() {
		return $this->mapBuilder;
	}

	/**
	 * Set id
	 *
	 * @param string $id
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\PlugInInterface
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * Get id
	 *
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set categoryId
	 *
	 * @param string $categoryId
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\AbstractPlugIn
	 */
	public function setCategoryId($categoryId) {
		$this->categoryId = $categoryId;
		return $this;
	}

	/**
	 * Get categoryId
	 *
	 * @return string
	 */
	public function getCategoryId() {
		return $this->categoryId;
	}

	/**
	 * Set plugInName
	 *
	 * @param string $plugInName
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\AbstractPlugIn
	 */
	public function setPlugInName($plugInName) {
		$this->plugInName = $plugInName;
		return $this;
	}

	/**
	 * Get plugInName
	 *
	 * @return string
	 */
	public function getPlugInName() {
		return $this->plugInName;
	}

	/**
	 * Set object
	 *
	 * @param mixed $object
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\AbstractPlugIn
	 */
	public function setObject($object) {
		$this->object = $object;
		return $this;
	}

	/**
	 * Get object
	 *
	 * @return mixed
	 */
	public function getObject() {
		return $this->object;
	}

	/**
	 * isWithinViewport
	 *
	 * @param \AdGrafik\GoogleMapsPHP\API\Base\LatLngBounds $bounds
	 * @return boolean
	 */
	public function isWithinViewport(\AdGrafik\GoogleMapsPHP\API\Base\LatLngBounds $bounds) {
		return TRUE;
	}

}

?>