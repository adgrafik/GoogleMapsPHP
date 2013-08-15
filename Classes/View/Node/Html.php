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
 * DOMElement for HTML tags.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class Html extends \AdGrafik\GoogleMapsPHP\View\Node\AbstractNode {

	/**
	 * @var boolean $printed
	 */
	protected $printed = FALSE;

	/**
	 * Set printed
	 *
	 * @param boolean $printed
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\Html
	 */
	public function setPrinted($printed) {
		$this->printed = (boolean) $printed;
		return $this;
	}

	/**
	 * Get printed
	 *
	 * @return boolean
	 */
	public function isPrinted() {
		return $this->printed;
	}

}

?>