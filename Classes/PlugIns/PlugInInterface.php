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

/**
 * PlugInInterface.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
interface PlugInInterface {

	/**
	 * Constructor
	 *
	 * @param \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface $mapBuilder
	 * @param array $options
	 */
	public function __construct(\AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface $mapBuilder, array $options = array());

	/**
	 * Set id
	 *
	 * @param string $id
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\PlugInInterface
	 */
	public function setId($id);

	/**
	 * Get id
	 *
	 * @return string
	 */
	public function getId();

	/**
	 * Set plugInName
	 *
	 * @param string $plugInName
	 * @return \AdGrafik\GoogleMapsPHP\PlugIns\AbstractPlugIn
	 */
	public function setPlugInName($plugInName);

	/**
	 * Get plugInName
	 *
	 * @return string
	 */
	public function getPlugInName();

	/**
	 * isWithinViewport
	 *
	 * @param \AdGrafik\GoogleMapsPHP\API\Base\LatLngBounds $bounds
	 * @return boolean
	 */
	public function isWithinViewport(\AdGrafik\GoogleMapsPHP\API\Base\LatLngBounds $bounds);

}

?>