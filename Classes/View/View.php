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
	 * @var array $nodeStack
	 */
	protected $nodeStack;

	/**
	 * Constructor
	 */
	public function __construct() {

		$this->nodeStack = array();

		$settings = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\Configuration\\Settings');

		$this->documentNode = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\View\\Node\\Document', $settings->get('view.node.document.xmlVersion'), $settings->get('view.node.document.xmlEncoding'));
		$this->documentNode->encoding = $settings->get('view.node.document.xmlEncoding');
		$this->documentNode->preserveWhiteSpace = FALSE;
		$this->documentNode->formatOutput = TRUE;

		$this->headNode = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\View\\Node\\Head', 'head');
		$this->documentNode->appendChild($this->headNode);

		$this->bodyNode = ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\View\\Node\\Body', 'body');
		$this->documentNode->appendChild($this->bodyNode);
	}

	/**
	 * addJavaScriptLibrary
	 *
	 * @param array $settings
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\JavaScriptLibrary
	 */
	public function addJavaScriptLibrary(array $settings = array()) {
		return $this->addJavaScriptNode('\\AdGrafik\\GoogleMapsPHP\\View\\Node\\JavaScriptLibrary', $settings);
	}

	/**
	 * addJavaScript
	 *
	 * @param array $settings
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\JavaScript
	 */
	public function addJavaScript(array $settings = array()) {
		return $this->addJavaScriptNode('\\AdGrafik\\GoogleMapsPHP\\View\\Node\\JavaScript', $settings);
	}

	/**
	 * addHtml
	 *
	 * @param array $settings
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\Html
	 */
	public function addHtml(array $settings = array()) {
		return $this->addHtmlNode('\\AdGrafik\\GoogleMapsPHP\\View\\Node\\Html', $settings);
	}

	/**
	 * addHead
	 *
	 * @param \AdGrafik\GoogleMapsPHP\View\Node\NodeInterface $node
	 * @param boolean $forceOnTop
	 * @return \AdGrafik\GoogleMapsPHP\View\View
	 */
	public function addHead($node, $forceOnTop = FALSE) {

		$key = count($this->headStack);
		$this->headStack[$key] = $node;
		$this->headStack[$key]->setForceOnTop($forceOnTop);

		$referenceNode = NULL;
		if ($forceOnTop) {
			foreach ($this->headNode->childNodes as $childNode) {
				if ($childNode->isForceOnTop() === FALSE) {
					$referenceNode = $childNode;
					break;
				}
			}
		}

		$this->headNode->insertBefore($this->headStack[$key], $referenceNode);

		return $this;
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
	 * addJavaScriptNode
	 *
	 * @param string $nodeClassName
	 * @param array $settings
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\JavaScript
	 */
	protected function addJavaScriptNode($nodeClassName, array $settings = array()) {

		$external = isset($settings['external']) ? $settings['external'] : FALSE;
		$forceOnTop = isset($settings['forceOnTop']) ? $settings['forceOnTop'] : FALSE;
		$source = isset($settings['source'])
			? ($external
				? $settings['source']
				: GMP_HTTP_PATH . $settings['source'])
			: '';

		$node = ClassUtility::makeInstance($nodeClassName, 'script');
		$this->addHead($node, $forceOnTop);
		$node->setAttribute('type', 'text/javascript');

		// Check if is file or source.
		$fileHeaders = @get_headers($source);
		if (strpos($fileHeaders[0], '200')) {
			$node->setAttribute('src', $source);
		} else {
			$node->nodeValue = $source;
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

		$tagName = isset($settings['tagName']) ? $settings['tagName'] : 'div';
		$attributes = isset($settings['attributes']) ? $settings['attributes'] : array();
		$forceOnTop = isset($settings['forceOnTop']) ? $settings['forceOnTop'] : FALSE;

		$node = ClassUtility::makeInstance($nodeClassName, $tagName);
		$this->addBody($node, $forceOnTop);

		if (isset($attributes['id'])) {
			$node->setAttribute('id', $attributes['id']);
			$node->setIdAttribute('id', TRUE);
			unset($attributes['id']);
		}

		foreach ($attributes as $attributeName => &$attributeValue) {
			$node->setAttribute($attributeName, $attributeValue);
		}

		return $node;
	}

}

?>