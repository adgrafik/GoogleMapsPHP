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

namespace GoogleMapsPHP\View\Node;

/**
 * DOMElement for JQuery.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class JQuery extends \GoogleMapsPHP\View\Node\AbstractNode {

	/**
	 * @var boolean $printed
	 */
	static protected $printed = FALSE;

	/**
	 * Set printed
	 *
	 * @param boolean $printed
	 * @return \GoogleMapsPHP\View\Node\JQuery
	 */
	public function setPrinted($printed) {
		static::$printed = (boolean) $printed;
		return $this;
	}

	/**
	 * Get printed
	 *
	 * @return boolean
	 */
	public function isPrinted() {
		return static::$printed;
	}

}

?>