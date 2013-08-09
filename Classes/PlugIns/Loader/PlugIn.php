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

namespace GoogleMapsPHP\PlugIns\Loader;

/**
 * Plug-in class for GoogleMapsPHP initial options.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class PlugIn extends \GoogleMapsPHP\PlugIns\AbstractPlugIn {

	/**
	 * @var string $url
	 */
	public $url;

	/**
	 * @var array $parameters
	 */
	public $parameters;

	/**
	 * @var boolean $viewportManagement
	 */
	public $viewportManagement;

	/**
	 * @var float $viewportOffset
	 */
	public $viewportOffset;

	/**
	 * Set url
	 *
	 * @param string $url
	 * @return \GoogleMapsPHP\PlugIns\Loader\PlugIn
	 */
	public function setUrl($url) {
		$this->url = $url;
		return $this;
	}

	/**
	 * Get url
	 *
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * Set parameters
	 *
	 * @param array $parameters
	 * @return \GoogleMapsPHP\PlugIns\Loader\PlugIn
	 */
	public function setParameters(array $parameters) {
		$this->parameters = $parameters;
		return $this;
	}

	/**
	 * Get parameters
	 *
	 * @return array
	 */
	public function getParameters() {
		return $this->parameters;
	}

	/**
	 * Set viewportManagement
	 *
	 * @param boolean $viewportManagement
	 * @return \GoogleMapsPHP\PlugIns\Loader\PlugIn
	 */
	public function setViewportManagement($viewportManagement) {
		$this->viewportManagement = (boolean) $viewportManagement;
		return $this;
	}

	/**
	 * Get viewportManagement
	 *
	 * @return boolean
	 */
	public function isViewportManagement() {
		return $this->viewportManagement;
	}

	/**
	 * Set viewportOffset
	 *
	 * @param float $viewportOffset
	 * @return \GoogleMapsPHP\PlugIns\Loader\PlugIn
	 */
	public function setViewportOffset($viewportOffset) {
		$this->viewportOffset = (float) $viewportOffset;
		return $this;
	}

	/**
	 * Get viewportOffset
	 *
	 * @return float
	 */
	public function getViewportOffset() {
		return $this->viewportOffset;
	}

}

?>