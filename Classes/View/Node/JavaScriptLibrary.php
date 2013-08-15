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

namespace AdGrafik\GoogleMapsPHP\View\Node;

/**
 * DOMElement for unique JavaScript libraries.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class JavaScriptLibrary extends \AdGrafik\GoogleMapsPHP\View\Node\AbstractNode {

	/**
	 * @var array $printed
	 */
	static protected $printed = array();

	/**
	 * Set printed
	 *
	 * @param boolean $printed
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\JavaScriptLibrary
	 */
	public function setPrinted($printed) {

		$reference = $this->getPrintReference();

		// If $printed TRUE and not in stack, add to stack.
		if ($printed && in_array($reference, static::$printed) === FALSE) {
			static::$printed[] = $reference;
		}

		// If $printed FALSE and in stack, remove from stack.
		if ($printed === FALSE && ($key = array_search($reference, static::$printed))) {
			unset(static::$printed[$key]);
		}

		return $this;
	}

	/**
	 * Get printed
	 *
	 * @return boolean
	 */
	public function isPrinted() {
		return in_array($this->getPrintReference(), static::$printed);
	}

	/**
	 * getPrintReference
	 *
	 * @return string
	 */
	public function getPrintReference() {
		return $this->nodeValue
			? md5($this->nodeValue)
			: md5($this->getAttribute('src'));
	}

}

?>