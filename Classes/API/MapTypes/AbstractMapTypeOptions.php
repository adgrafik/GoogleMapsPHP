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

namespace GoogleMapsPHP\API\MapTypes;

use GoogleMapsPHP\Utility\ClassUtility;

/**
 * AbstractMapTypeOptions.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
abstract class AbstractMapTypeOptions extends \GoogleMapsPHP\Object\PropertyArrayAccess implements MapTypeOptionsInterface {

	/**
	 * Constructor
	 *
	 * @param array $options
	 */
	public function __construct(array $options = array()) {
		ClassUtility::setPropertiesFromArray($this, $options);
	}

}

?>