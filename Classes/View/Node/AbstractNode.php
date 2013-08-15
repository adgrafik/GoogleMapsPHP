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
 * AbstractNode.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
abstract class AbstractNode extends \DOMElement implements \AdGrafik\GoogleMapsPHP\View\Node\NodeInterface {

	/**
	 * @var boolean $forceOnTop
	 */
	protected $forceOnTop = FALSE;

	/**
	 * Set printed
	 *
	 * @param boolean $printed
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\NodeInterface
	 */
	abstract public function setPrinted($printed);

	/**
	 * Get printed
	 *
	 * @return boolean
	 */
	abstract public function isPrinted();

	/**
	 * Set forceOnTop
	 *
	 * @param boolean $forceOnTop
	 * @return \AdGrafik\GoogleMapsPHP\View\Node\NodeInterface
	 */
	public function setForceOnTop($forceOnTop) {
		$this->forceOnTop = (boolean) $forceOnTop;
		return $this;
	}

	/**
	 * Get forceOnTop
	 *
	 * @return boolean
	 */
	public function isForceOnTop() {
		return $this->forceOnTop;
	}

}

?>