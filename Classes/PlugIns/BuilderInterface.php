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

namespace AdGrafik\GoogleMapsPHP\PlugIns;

/**
 * BuilderInterface.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
interface BuilderInterface {

	/**
	 * Build a plugIn
	 *
	 * @param array [$options]
	 * @return void
	 */
	public function build();

}

?>