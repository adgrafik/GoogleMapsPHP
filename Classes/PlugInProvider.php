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

namespace AdGrafik\GoogleMapsPHP;

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * This class initialize the MapBuilder and manage the JSON output.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 * @api
 */
class PlugInProvider extends \AdGrafik\GoogleMapsPHP\MapBuilder\AbstractMapBuilder {

	/**
	 * @var \AdGrafik\GoogleMapsPHP\API\Base\LatLngBounds $bounds
	 */
	protected $bounds;

	/**
	 * @var boolean $viewportManagement
	 */
	protected $viewportManagement;

	/**
	 * initializeObject
	 *
	 * @return void
	 */
	public function initializeObject() {

		if (GMP_XHR && get_class($this) === get_class()) {

			// Register error handler.
			$errorHandlerSettings = $this->getSettings()->get('plugInProvider.errorHandler');
			ClassUtility::makeInstance($errorHandlerSettings['className'], $errorHandlerSettings['methodName']);

			// Register exception handler.
			$exceptionHandlerSettings = $this->getSettings()->get('plugInProvider.exceptionHandler');
			ClassUtility::makeInstance($exceptionHandlerSettings['className'], $exceptionHandlerSettings['methodName']);

		}

		$this->setView(ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\View\\Json'));

		if (isset($_REQUEST['bounds'])) {
			$this->setBounds($_REQUEST['bounds']);
		}

		if (isset($_REQUEST['viewportManagement'])) {
			$this->setViewportManagement($_REQUEST['viewportManagement']);
		}
	}

	/**
	 * Set bounds
	 *
	 * @param mixed $bounds
	 * @param mixed $northEast
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface
	 */
	public function setBounds($bounds) {

		if ($bounds instanceof \AdGrafik\GoogleMapsPHP\API\Base\LatLngBounds === FALSE) {
			$bounds = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\API\\Base\\LatLngBounds', $bounds);
		}

		$this->bounds = $bounds;

		return $this;
	}

	/**
	 * Get bounds
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Base\LatLngBounds
	 */
	public function getBounds() {
		return $this->bounds;
	}

	/**
	 * Set viewportManagement
	 *
	 * @param boolean $viewportManagement
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder\MapBuilderInterface
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
	 * printJavaScriptJsonObject
	 *
	 * @return string
	 */
	public function printJavaScriptJsonObject() {

		// Don't attach layer if viewport management in use and layer is out of map.
		if ($this->isViewportManagement()) {
			$withinViewport = array();
			$plugIns = $this->getJsonObject()->getPlugIns();
			foreach ($plugIns as $key => &$plugIn) {
				if ($plugIn->isWithinViewport($this->getBounds())) {
					$withinViewport[] = $plugIns[$key];
				}
			}
			$this->getJsonObject()->setPlugIns($withinViewport);
		}

		return parent::printJavaScriptJsonObject();
	}


	/**
	 * sendJson
	 *
	 * @return string
	 */
	public function sendJson() {
		$this->getView()
			->setData($this->printJavaScriptJsonObject())
			->printView();
	}

	/**
	 * __toString
	 *
	 * @return string
	 */
	public function __toString() {

		try {
			$html = $this->sendJson();
		} catch (\Exception $exception) {
			$html = (string) $exception;
		}

		return $html;
	}

}

?>