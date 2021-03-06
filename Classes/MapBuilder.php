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
 * Class to create and manage HTML output.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 * @api
 */
class MapBuilder extends \AdGrafik\GoogleMapsPHP\MapBuilder\AbstractMapBuilder {

	/**
	 * @var \AdGrafik\GoogleMapsPHP\View\Node\JavaScript $optionsNode
	 */
	protected $optionsNode;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\View\Node\Html $canvasNode
	 */
	protected $canvasNode;

	/**
	 * initializeObject
	 *
	 * @return void
	 */
	public function initializeObject() {

		$this->setView(ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\View\\Html'));

		$this->getSettings()->set('mapBuilder.canvas.attributes.id', $this->getMapId());
		$this->setCanvasNode($this->getView()->addHtml($this->getSettings()->get('mapBuilder.canvas')));

		$this->mapOptions['div'] = $this->getCanvasNode();
		$this->add('Map', $this->mapOptions);
	}

	/**
	 * Set map
	 *
	 * @param \AdGrafik\GoogleMapsPHP\API\Map $map
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder
	 */
	public function setMap(\AdGrafik\GoogleMapsPHP\API\Map $map) {
		$this->getJsonObject()->getMapPlugIn()->getObject()->setMap($map);
		return $this;
	}

	/**
	 * Get map
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Map
	 */
	public function getMap() {
		return $this->getJsonObject()->getMapPlugIn()->getObject();
	}

	/**
	 * Set canvasNode
	 *
	 * @param \AdGrafik\GoogleMapsPHP\View\Node\Html $canvasNode
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder
	 */
	public function setCanvasNode(\AdGrafik\GoogleMapsPHP\View\Node\Html $canvasNode) {
		$this->canvasNode = $canvasNode;
		return $this;
	}

	/**
	 * Get canvasNode
	 *
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\Html
	 */
	public function getCanvasNode() {
		return $this->canvasNode;
	}

	/**
	 * Add plug-in resources.
	 *
	 * @param array $plugInBuilderNames
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder
	 * @throws \AdGrafik\GoogleMapsPHP\Exceptions\InvalidArgumentException
	 */
	public function addPlugInViewResources(array $plugInBuilderNames) {

		foreach ($plugInBuilderNames as &$plugInBuilderName) {

			if (($plugInBuilderSettings = $this->getSettings()->get('plugInBuilder.' . $plugInBuilderName)) === NULL) {
				throw new \AdGrafik\GoogleMapsPHP\Exceptions\InvalidArgumentException(sprintf('Plug-in builder "%s" is not registered.', $plugInBuilderName), 1371919752);
			}

			// Include head resources only if view exists.
			if ($this->getView() instanceof \AdGrafik\GoogleMapsPHP\View\Html && isset($plugInBuilderSettings['view'])) {
				$this->getView()->addResources($plugInBuilderSettings['view']);
			}
		}

		return $this;
	}

	/**
	 * Print canvas DIV-tag.
	 *
	 * @return string
	 */
	public function printHtmlCanvas() {
		return $this->getCanvasNode()
			? $this->getView()->printNode($this->getCanvasNode())
			: '';
	}

	/**
	 * printHtmlHead
	 *
	 * @return string
	 */
	public function printHtmlHead() {
		$this->initializePrint();
		return $this->getView()->printHead();
	}

	/**
	 * printHtmlBody
	 *
	 * @return string
	 */
	public function printHtmlBody() {
		return $this->getView()->printBody();
	}

	/**
	 * Shortcut of printHtmlBody
	 *
	 * @return string
	 */
	public function printHtml() {

		$html = $this->printHtmlHead() . PHP_EOL . $this->printHtmlBody();

		if ($this->isDebug()) {
			$html .= '<!-- Parse time: ' . (microtime(TRUE) - GMP_DEBUG_STAR_TIME) . ' -->';
		}

		return $html;
	}

	/**
	 * printJavaScriptOptionsVariableName
	 *
	 * @return string
	 */
	public function printJavaScriptOptionsVariableName() {
		return 'GoogleMapsPhpOptions' . ucfirst($this->getMapId());
	}

	/**
	 * printJavaScriptOptions
	 *
	 * @return string
	 */
	public function printJavaScriptOptions() {
		return 'var ' . $this->printJavaScriptOptionsVariableName() . ' = ' . $this->printJavaScriptJsonObject() . ';';
	}

	/**
	 * printJavaScriptConstructionVariableName
	 *
	 * @return string
	 */
	public function printJavaScriptConstructionVariableName() {
		return 'GoogleMapsPhp' . ucfirst($this->getMapId());
	}

	/**
	 * printJavaScriptConstruction
	 *
	 * @return string
	 */
	public function printJavaScriptConstruction() {
		$construction = $this->printJavaScriptConstructionVariableName() . ' = new GoogleMapsPHP.MapBuilder( ' . $this->printJavaScriptOptionsVariableName() . ' );';
		$domReadyFunctionWrap = $this->getSettings()->get('mapBuilder.options.wrap');
		if (count($domReadyFunctionWrap) == 2) {
			return $domReadyFunctionWrap[0] . ' ' . $construction . ' ' . $domReadyFunctionWrap[1];
		} else {
			return $construction;
		}
	}

	/**
	 * __toString
	 *
	 * @return string
	 */
	public function __toString() {

		try {
			$html = $this->printHtml();
		} catch (\Exception $exception) {
			$html = (string) $exception;
		}

		return $html;
	}

	/**
	 * Overload __call
	 *
	 * @param string $methodName
	 * @param array $arguments
	 * @return mixed
	 * @throws \AdGrafik\GoogleMapsPHP\Exceptions\InvalidMethodException
	 */
	public function __call($methodName, $arguments) {
		$object = $this->getJsonObject()->getMapPlugIn();
		if (ClassUtility::methodExists($object, $methodName, FALSE) === FALSE) {
			$object = $object->getObject();
			if (ClassUtility::methodExists($object, $methodName, FALSE) === FALSE) {
				throw new \AdGrafik\GoogleMapsPHP\Exceptions\InvalidMethodException(sprintf('Method "%s" not exists.', $methodName), 1369563764);
			}
		}
		call_user_func_array(array($object, $methodName), $arguments);
		return $this;
	}

	/**
	 * initializePrint
	 *
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\JavaScript
	 */
	protected function initializePrint() {

		$this->getView()->addResources($this->getSettings()->get('mapBuilder.view'));

		$source = PHP_EOL . $this->printJavaScriptOptions() . PHP_EOL . $this->printJavaScriptConstruction() . PHP_EOL;
		$this->getView()->addJavaScriptInline(md5($source), array('source' => $source));
	}

}

?>