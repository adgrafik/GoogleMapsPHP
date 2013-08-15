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
class MapBuilder extends \AdGrafik\GoogleMapsPHP\PlugInProvider {

	/**
	 * @var \AdGrafik\GoogleMapsPHP\View\Document $view
	 */
	protected $view;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\View\Node\JQuery $jQueryNode
	 */
	protected $jQueryNode;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\View\Node\GoogleMapsAPI $googleMapsApiNode
	 */
	protected $googleMapsApiNode;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\View\Node\MapBuilder $mapBuilderNode
	 */
	protected $mapBuilderNode;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\View\Node\Options $optionsNode
	 */
	protected $optionsNode;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\View\Node\Canvas $canvasNode
	 */
	protected $canvasNode;

	/**
	 * Constructor
	 * MapBuilder( [$mapId] [, $options] );
	 *
	 * @param mixed $mapId
	 * @param mixed $options Can be an object of type \AdGrafik\GoogleMapsPHP\API\Map\MapOptions or an map options array.
	 */
	public function __construct($mapId = '', $options = array()) {

		// Call parent method with user function cause of flexible parameters.
		call_user_func(array('parent', '__construct'), $mapId, $options);

		// Create XML document and nodes in order of appearance.
		$this->view = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\View\\View');

/*
		// TODO: Use of universal JavaScript nodes.
		$jQueryNode = $this->view->addJavaScriptLibrary($this->getSettings()->get('view.node.jQuery.source'), TRUE);
		if ($jQueryNode) {
			$this->setJQueryNode($jQueryNode);
		}

		$googleMapsApiNode = $this->view->addJavaScriptLibrary($this->getSettings()->get('view.node.googleMapsApi.source'), TRUE);
		if ($googleMapsApiNode) {
			$this->setGoogleMapsApiNode($googleMapsApiNode);
		}

		$mapBuilderNode = $this->view->addJavaScriptLibrary($this->getSettings()->get('view.node.mapBuilder.source'), TRUE);
		if ($mapBuilderNode) {
			$this->setMapBuilderNode($mapBuilderNode);
		}
#print_r($this->mapBuilderNode);
*/

		$jQuerySource = $this->getSettings()->get('view.node.jQuery.source');
		if ($jQuerySource) {
			$http = $this->getSettings()->get('view.node.jQuery.external') ? '' : GMP_HTTP_PATH;
			$this->jQueryNode = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\View\\Node\\JQuery', 'script');
			$this->view->addHead($this->jQueryNode, TRUE);
			$this->jQueryNode->setAttribute('type', 'text/javascript');
			$this->jQueryNode->setAttribute('src', $http . $jQuerySource);
		}

		$googleMapsApiSource = $this->getSettings()->get('view.node.googleMapsApi.source');
		if ($googleMapsApiSource) {
			$http = $this->getSettings()->get('view.node.googleMapsApi.external') ? '' : GMP_HTTP_PATH;
			$this->googleMapsApiNode = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\View\\Node\\GoogleMapsAPI', 'script');
			$this->view->addHead($this->googleMapsApiNode, TRUE);
			$this->googleMapsApiNode->setAttribute('type', 'text/javascript');
			$this->googleMapsApiNode->setAttribute('src', $http . $googleMapsApiSource);
		}

		$mapBuilderSource = $this->getSettings()->get('view.node.mapBuilder.source');
		if ($mapBuilderSource) {
			$http = $this->getSettings()->get('view.node.mapBuilder.external') ? '' : GMP_HTTP_PATH;
			$this->mapBuilderNode = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\View\\Node\\MapBuilder', 'script');
			$this->view->addHead($this->mapBuilderNode, TRUE);
			$this->mapBuilderNode->setAttribute('type', 'text/javascript');
			$this->mapBuilderNode->setAttribute('src', $http . $mapBuilderSource);
		}

		$this->optionsNode = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\View\\Node\\Options', 'script');
		$this->view->addHead($this->optionsNode);
		$this->optionsNode->setAttribute('type', 'text/javascript');

		if (($tagName = $this->getSettings()->get('view.node.canvas.tagName')) === NULL) {
			$tagName = 'div';
		}
		$this->canvasNode = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\View\\Node\\Canvas', $tagName);
		$this->view->addBody($this->canvasNode, TRUE);
		$this->canvasNode->setAttribute('id', $this->getMapId());
		$this->canvasNode->setIdAttribute('id', TRUE);
		$defaultStyle = $this->getSettings()->get('view.node.canvas.defaultStyle');
		if ($defaultStyle) {
			$this->canvasNode->setAttribute('style', $defaultStyle);
		}

		$this->options['div'] = $this->canvasNode;
		$this->add('Map', $this->options);
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
	 * Set view
	 *
	 * @param \AdGrafik\GoogleMapsPHP\View\Document $view
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder
	 */
	public function setView(\AdGrafik\GoogleMapsPHP\View\Document $view) {
		$this->view = $view;
		return $this;
	}

	/**
	 * Get view
	 *
	 * @return \AdGrafik\GoogleMapsPHP\View\Document
	 */
	public function getView() {
		return $this->view;
	}

	/**
	 * Set jQueryNode
	 *
	 * @param \AdGrafik\GoogleMapsPHP\View\Node\JavaScriptLibrary $jQueryNode
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder
	 */
	public function setJQueryNode(\AdGrafik\GoogleMapsPHP\View\Node\JavaScriptLibrary $jQueryNode) {
		$this->jQueryNode = $jQueryNode;
		return $this;
	}

	/**
	 * Get jQueryNode
	 *
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\JavaScriptLibrary
	 */
	public function getJQueryNode() {
		return $this->jQueryNode;
	}

	/**
	 * Set googleMapsApiNode
	 *
	 * @param \AdGrafik\GoogleMapsPHP\View\Node\JavaScriptLibrary $googleMapsApiNode
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder
	 */
	public function setGoogleMapsApiNode(\AdGrafik\GoogleMapsPHP\View\Node\JavaScriptLibrary $googleMapsApiNode) {
		$this->googleMapsApiNode = $googleMapsApiNode;
		return $this;
	}

	/**
	 * Get googleMapsApiNode
	 *
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\JavaScriptLibrary
	 */
	public function getGoogleMapsApiNode() {
		return $this->googleMapsApiNode;
	}

	/**
	 * Set mapBuilderNode
	 *
	 * @param \AdGrafik\GoogleMapsPHP\View\Node\JavaScriptLibrary $mapBuilderNode
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder
	 */
	public function setMapBuilderNode(\AdGrafik\GoogleMapsPHP\View\Node\JavaScriptLibrary $mapBuilderNode) {
		$this->mapBuilderNode = $mapBuilderNode;
		return $this;
	}

	/**
	 * Get mapBuilderNode
	 *
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\JavaScriptLibrary
	 */
	public function getMapBuilderNode() {
		return $this->mapBuilderNode;
	}

	/**
	 * Set optionsNode
	 *
	 * @param \AdGrafik\GoogleMapsPHP\View\Node\Options $optionsNode
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder
	 */
	public function setOptionsNode(\AdGrafik\GoogleMapsPHP\View\Node\Options $optionsNode) {
		$this->optionsNode = $optionsNode;
		return $this;
	}

	/**
	 * Get optionsNode
	 *
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\Options
	 */
	public function getOptionsNode() {
		return $this->optionsNode;
	}

	/**
	 * Set canvasNode
	 *
	 * @param \AdGrafik\GoogleMapsPHP\View\Node\Canvas $canvasNode
	 * @return \AdGrafik\GoogleMapsPHP\MapBuilder
	 */
	public function setCanvasNode(\AdGrafik\GoogleMapsPHP\View\Node\Canvas $canvasNode) {
		$this->canvasNode = $canvasNode;
		return $this;
	}

	/**
	 * Get canvasNode
	 *
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\Canvas
	 */
	public function getCanvasNode() {
		return $this->canvasNode;
	}

	/**
	 * printHtmlGoogleMapsAPI
	 *
	 * @return string
	 */
	public function printHtmlJQuery() {
		return $this->getJQueryNode()
			? $this->getView()->printNode($this->getJQueryNode())
			: '';
	}

	/**
	 * printHtmlGoogleMapsAPI
	 *
	 * @return string
	 */
	public function printHtmlGoogleMapsAPI() {
		return $this->getGoogleMapsApiNode()
			? $this->getView()->printNode($this->getGoogleMapsApiNode())
			: '';
	}

	/**
	 * printHtmlMapBuilder
	 *
	 * @return string
	 */
	public function printHtmlMapBuilder() {
		return $this->getMapBuilderNode()
			? $this->getView()->printNode($this->getMapBuilderNode())
			: '';
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
	 * printHtmlOptions
	 *
	 * @return string
	 */
	public function printHtmlOptions() {
		$this->pushOptionsNodeValue();
		return $this->getView()->printNode($this->getOptionsNode());
	}

	/**
	 * printHtmlHead
	 *
	 * @return string
	 */
	public function printHtmlHead() {
		$this->pushOptionsNodeValue();
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
		return $this->printHtmlHead() . PHP_EOL . $this->printHtmlBody();
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
		return 'var ' . $this->printJavaScriptOptionsVariableName() . ' = ' . $this->printJsonObject() . ';';
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
		$domReadyFunctionWrap = $this->getSettings()->get('view.node.options.wrap');
		if (count($domReadyFunctionWrap) == 2) {
			return $domReadyFunctionWrap[0] . ' ' . $this->printJavaScriptConstructionVariableName() . ' = new GoogleMapsPHP.MapBuilder( ' . $this->printJavaScriptOptionsVariableName() . ' );' . ' ' . $domReadyFunctionWrap[1];
		} else {
			return $this->printJavaScriptConstructionVariableName() . ' = new GoogleMapsPHP.MapBuilder( ' . $this->printJavaScriptOptionsVariableName() . ' );';
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
		return call_user_func_array(array($object, $methodName), $arguments);
	}

	/**
	 * pushOptionsNodeValue
	 *
	 * @return void
	 */
	protected function pushOptionsNodeValue() {

		// Push options only if not prited yet.
		if ($this->getOptionsNode()->isPrinted()) {
			return;
		}

		$mapId = ucfirst($this->getMapId());

		$nodeValue = PHP_EOL . $this->printJavaScriptOptions() . PHP_EOL;
		$nodeValue .= $this->printJavaScriptConstruction() . PHP_EOL;

		// TODO: Save configuration file external needed?
/*
		if ($this->getSettings()->get('view.inlineToExternal.activate')) {
			$filename = strtolower($this->printJavaScriptOptionsVariableName()) . '_' . md5($nodeValue) . '.js';
			$inlineToExternalPathAndFilename = GMP_PATH . $this->getSettings()->get('view.inlineToExternal.path') . $filename;
			if (!is_file($inlineToExternalPathAndFilename)) {
				file_put_contents($inlineToExternalPathAndFilename, $nodeValue);
			}
			$inlineToExternalHttp = GMP_HTTP_PATH . $this->getSettings()->get('view.inlineToExternal.path') . $filename;
			$this->getOptionsNode()->setAttribute('src', $inlineToExternalHttp);
		} else {
		}
*/

		$cDataNode = new \DOMCdataSection($nodeValue);
		$this->getOptionsNode()->appendChild($cDataNode);
	}

}

?>