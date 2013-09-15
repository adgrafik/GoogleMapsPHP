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

namespace AdGrafik\GoogleMapsPHP\View;

use AdGrafik\GoogleMapsPHP\Utility\ClassUtility;

/**
 * View class to manage the HTML output.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class View {

	const HEAD_TYPE_JAVASCRIPT_LIBRARY = 'javaScriptLibrary';
	const HEAD_TYPE_JAVASCRIPT_SOURCE = 'javaScriptSource';
	const HEAD_TYPE_JAVASCRIPT_INLINE = 'javaScriptInline';

	/**
	 * @var \AdGrafik\GoogleMapsPHP\Configuration\Settings $settings
	 */
	protected $settings;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\View\Node\Document $documentNode
	 */
	protected $documentNode;

	/**
	 * @var \DOMElement $headNode
	 */
	protected $headNode;

	/**
	 * @var \DOMElement $bodyNode
	 */
	protected $bodyNode;

	/**
	 * @var array $headStack
	 */
	protected $headStack;

	/**
	 * @var array $bodyStack
	 */
	protected $bodyStack;

	/**
	 * Constructor
	 */
	public function __construct() {

		$this->settings = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\Configuration\\Settings');

		$this->documentNode = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\View\\Node\\Document', $this->settings->get('view.node.document.xmlVersion'), $this->settings->get('view.node.document.xmlEncoding'));
		$this->documentNode->encoding = $this->settings->get('view.node.document.xmlEncoding');
		$this->documentNode->preserveWhiteSpace = FALSE;
		$this->documentNode->formatOutput = TRUE;

		$this->headNode = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\View\\Node\\Head', 'head');
		$this->documentNode->appendChild($this->headNode);

		$this->bodyNode = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\View\\Node\\Body', 'body');
		$this->documentNode->appendChild($this->bodyNode);

		$this->headStack = array(
			self::HEAD_TYPE_JAVASCRIPT_LIBRARY => array(),
			self::HEAD_TYPE_JAVASCRIPT_SOURCE => array(),
			self::HEAD_TYPE_JAVASCRIPT_INLINE => array(),
		);
	}

	/**
	 * includeJava
	 *
	 * @param array $settings
	 * @return void
	 */
	public function addResources(array $settings = array()) {

		if (count($settings['includeJavaScriptLibrary'])) {
			foreach ($settings['includeJavaScriptLibrary'] as &$javaScriptSettings) {
				$this->addJavaScriptLibrary($javaScriptSettings);
			}
		}

		if (count($settings['includeJavaScriptSource'])) {
			foreach ($settings['includeJavaScriptSource'] as &$javaScriptSettings) {
				$this->addJavaScriptSource($javaScriptSettings);
			}
		}

		if (count($settings['includeJavaScriptInline'])) {
			foreach ($settings['includeJavaScriptInline'] as &$javaScriptSettings) {
				$this->addJavaScriptInline($javaScriptSettings);
			}
		}
	}

	/**
	 * addJavaScriptLibrary
	 *
	 * @param array $settings
	 * @return \AdGrafik\GoogleMapsPHP\View\View
	 */
	public function addJavaScriptLibrary(array $settings = array()) {
		return $this->addJavaScriptNode(self::HEAD_TYPE_JAVASCRIPT_LIBRARY, $settings);
	}

	/**
	 * addJavaScriptSource
	 *
	 * @param array $settings
	 * @return \AdGrafik\GoogleMapsPHP\View\View
	 */
	public function addJavaScriptSource(array $settings = array()) {
		return $this->addJavaScriptNode(self::HEAD_TYPE_JAVASCRIPT_SOURCE, $settings);
	}

	/**
	 * addJavaScriptInline
	 *
	 * @param array $settings
	 * @return \AdGrafik\GoogleMapsPHP\View\View
	 */
	public function addJavaScriptInline(array $settings = array()) {
		return $this->addJavaScriptNode(self::HEAD_TYPE_JAVASCRIPT_INLINE, $settings);
	}

	/**
	 * addHead
	 *
	 * @param \AdGrafik\GoogleMapsPHP\View\Node\NodeInterface $node
	 * @return \AdGrafik\GoogleMapsPHP\View\View
	 */
	public function addHead($node) {

		$key = count($this->headStack);

		$referenceNode = NULL;
		if ($node->isForceOnTop()) {
			foreach ($this->headNode->childNodes as $childNode) {
				if ($childNode->isForceOnTop() === FALSE) {
					$referenceNode = $childNode;
					break;
				}
			}
		}

		$this->headNode->insertBefore($node, $referenceNode);

		return $this;
	}

	/**
	 * addHtml
	 *
	 * @param array $settings
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\Html
	 */
	public function addHtml(array $settings = array()) {

		// Overwrite default settings.
		$settings = array_replace_recursive(array(
			'tagName' => 'div',
			'forceOnTop' => FALSE,
			'attributes' => FALSE,
		), $settings);

		return $this->addHtmlNode('AdGrafik\\GoogleMapsPHP\\View\\Node\\Html', $settings);
	}

	/**
	 * addBody
	 *
	 * @param \AdGrafik\GoogleMapsPHP\View\Node\NodeInterface $node
	 * @param boolean $forceOnTop
	 * @return \AdGrafik\GoogleMapsPHP\View\View
	 */
	public function addBody($node, $forceOnTop = FALSE) {

		$key = count($this->bodyStack);
		$this->bodyStack[$key] = $node;
		$this->bodyStack[$key]->setForceOnTop($forceOnTop);

		$referenceNode = NULL;
		if ($forceOnTop) {
			foreach ($this->bodyNode->childNodes as $childNode) {
				if ($childNode->isForceOnTop() === FALSE) {
					$referenceNode = $childNode;
					break;
				}
			}
		}

		$this->bodyNode->insertBefore($this->bodyStack[$key], $referenceNode);

		return $this;
	}

	/**
	 * Set settings
	 *
	 * @param \AdGrafik\GoogleMapsPHP\Configuration\Settings $settings
	 * @return \AdGrafik\GoogleMapsPHP\View\to
	 */
	public function setSettings(\AdGrafik\GoogleMapsPHP\Configuration\Settings $settings) {
		$this->settings = $settings;
		return $this;
	}

	/**
	 * Get settings
	 *
	 * @return \AdGrafik\GoogleMapsPHP\Configuration\Settings
	 */
	public function getSettings() {
		return $this->settings;
	}

	/**
	 * Set documentNode
	 *
	 * @param \AdGrafik\GoogleMapsPHP\View\Node\Document $documentNode
	 * @return \AdGrafik\GoogleMapsPHP\View\View
	 */
	public function setDocumentNode(\AdGrafik\GoogleMapsPHP\View\Node\Document $documentNode) {
		$this->documentNode = $documentNode;
		return $this;
	}

	/**
	 * Get documentNode
	 *
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\Document
	 */
	public function getDocumentNode() {
		return $this->documentNode;
	}

	/**
	 * Set headNode
	 *
	 * @param \AdGrafik\GoogleMapsPHP\View\Node\Head $headNode
	 * @return \AdGrafik\GoogleMapsPHP\View\View
	 */
	public function setHeadNode(\AdGrafik\GoogleMapsPHP\View\Node\Head $headNode) {
		$this->headNode = $headNode;
		return $this;
	}

	/**
	 * Get headNode
	 *
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\Head
	 */
	public function getHeadNode() {
		return $this->headNode;
	}

	/**
	 * Set bodyNode
	 *
	 * @param \AdGrafik\GoogleMapsPHP\View\Node\Body $bodyNode
	 * @return \AdGrafik\GoogleMapsPHP\View\View
	 */
	public function setBodyNode(\AdGrafik\GoogleMapsPHP\View\Node\Body $bodyNode) {
		$this->bodyNode = $bodyNode;
		return $this;
	}

	/**
	 * Get bodyNode
	 *
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\Body
	 */
	public function getBodyNode() {
		return $this->bodyNode;
	}

	/**
	 * printHead
	 *
	 * @param \AdGrafik\GoogleMapsPHP\View\Node\NodeInterface $node
	 * @return string
	 */
	public function printNode(\AdGrafik\GoogleMapsPHP\View\Node\NodeInterface $node) {

		$html = '';
		if ($node->isPrinted() === FALSE) {
			$html = $this->getDocumentNode()->saveXML($node, LIBXML_NOEMPTYTAG);
			$html = str_replace('><![CDATA[', '>' . PHP_EOL . '/*<![CDATA[*/', $html);
			$html = str_replace(']]></', '/*]]>*/' . PHP_EOL . '</', $html);
			$node->setPrinted(TRUE);
		}

		return $html;
	}

	/**
	 * printHead
	 *
	 * @return string
	 */
	public function printHead() {

		$html = '';
		foreach ($this->headNode->childNodes as $childNode) {
			$html .= $this->printNode($childNode) . PHP_EOL;
		}

		return $html;
	}

	/**
	 * printBody
	 *
	 * @return string
	 */
	public function printBody() {

		$html = '';
		foreach ($this->bodyNode->childNodes as $childNode) {
			$html .= $this->printNode($childNode) . PHP_EOL;
		}

		return $html;
	}

	/**
	 * Shortcut of printHtmlBody
	 *
	 * @return string
	 */
	public function printHtml() {
		return $this->printHead() . PHP_EOL . $this->printBody();
	}

	/**
	 * addJavaScriptNode
	 *
	 * @param string $type
	 * @param array $settings
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\JavaScript
	 */
	protected function addJavaScriptNode($type, array $settings = array()) {

		// Overwrite default settings.
		$settings = array_replace_recursive(array(
			'source' => '',
			'forceOnTop' => FALSE,
			'external' => FALSE,
		), $settings);

		// If source empty, nothing else to do.
		if (!$settings['source']) {
			return;
		}

		if ($type !== self::HEAD_TYPE_JAVASCRIPT_INLINE) {
			$settings['source'] = $settings['external']
				? $settings['source']
				: GMP_HTTP_PATH . $settings['source'];
		}

		$key = md5($settings['source']);

		// If source already set, nothing else to do.
		if (isset($this->javaScriptStack[self::HEAD_TYPE_JAVASCRIPT_LIBRARY][$key])) {
			return $this->javaScriptStack[self::HEAD_TYPE_JAVASCRIPT_LIBRARY][$key];
		} else if (isset($this->javaScriptStack[self::HEAD_TYPE_JAVASCRIPT_SOURCE][$key])) {
			return $this->javaScriptStack[self::HEAD_TYPE_JAVASCRIPT_SOURCE][$key];
		} else if (isset($this->javaScriptStack[self::HEAD_TYPE_JAVASCRIPT_INLINE][$key])) {
			return $this->javaScriptStack[self::HEAD_TYPE_JAVASCRIPT_INLINE][$key];
		}

		$node = ClassUtility::makeInstance('AdGrafik\\GoogleMapsPHP\\View\\Node\\JavaScript', 'script');

		$this->headStack[$type][$key] = $node;
		$this->headStack[$type][$key]->setForceOnTop($settings['forceOnTop']);

		$this->addHead($node);
		$node->setAttribute('type', 'text/javascript');

		$this->javaScriptStack[$type][$key] = $node;

		if ($type === self::HEAD_TYPE_JAVASCRIPT_INLINE) {
			$cDataNode = new \DOMCdataSection($settings['source']);
			$node->appendChild($cDataNode);
		} else {
			$node->setAttribute('src', $settings['source']);
		}

		return $node;
	}

	/**
	 * addHtmlNode
	 *
	 * @param string $nodeClassName
	 * @param array $settings
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\JavaScript
	 */
	protected function addHtmlNode($nodeClassName, array $settings = array()) {

		$node = ClassUtility::makeInstance($nodeClassName, $settings['tagName']);
		$this->addBody($node, $settings['forceOnTop']);

		if (isset($settings['attributes']['id'])) {
			$node->setAttribute('id', $settings['attributes']['id']);
			$node->setIdAttribute('id', TRUE);
			unset($settings['attributes']['id']);
		}

		foreach ($settings['attributes'] as $attributeName => &$attributeValue) {
			$node->setAttribute($attributeName, $attributeValue);
		}

		return $node;
	}

}

?>