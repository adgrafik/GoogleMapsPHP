<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 1999-2013 Kasper Skårhøj (kasperYYYY@typo3.com)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

namespace GoogleMapsPHP\Utility;

/**
 * OptionSplit class.
 *
 * @author Kasper Skårhøj <kasperYYYY@typo3.com>
 */
class OptionSplit {

	/*******************************************************************
	 *
	 * Various API functions, used from elsewhere in the frontend classes
	 *
	 *******************************************************************/
	/**
	 * Implementation of the "optionSplit" feature in TypoScript (used eg. for MENU objects)
	 * What it does is to split the incoming TypoScript array so that the values are exploded by certain strings ("||" and "|*|") and each part distributed into individual TypoScript arrays with a similar structure, but individualized values.
	 * The concept is known as "optionSplit" and is rather advanced to handle but quite powerful, in particular for creating menus in TYPO3.
	 *
	 * @param array $conf A TypoScript array
	 * @param integer $splitCount The number of items for which to generated individual TypoScript arrays
	 * @return array The individualized TypoScript array.
	 * @author Kasper Skårhøj <kasperYYYY@typo3.com>
	 * @see tslib_cObj::IMGTEXT(), tslib_menu::procesItemStates()
	 * @todo Define visibility
	 */
	static public function split($conf, $splitCount) {
		// Initialize variables:
		$splitCount = intval($splitCount);
		$conf2 = array();
		if ($splitCount && is_array($conf)) {
			// Initialize output to carry at least the keys:
			for ($aKey = 0; $aKey < $splitCount; $aKey++) {
				$conf2[$aKey] = array();
			}
			// Recursive processing of array keys:
			foreach ($conf as $cKey => &$val) {
				if (is_array($val)) {
					$tempConf = self::split($val, $splitCount);
					foreach ($tempConf as $aKey => &$val) {
						$conf2[$aKey][$cKey] = $val;
					}
				} else {
					// Splitting of all values on this level of the TypoScript object tree:
					if (!strstr($val, '|*|') && !strstr($val, '||')) {
						for ($aKey = 0; $aKey < $splitCount; $aKey++) {
							$conf2[$aKey][$cKey] = $val;
						}
					} else {
						$main = explode('|*|', $val);
						$mainCount = count($main);
						$lastC = 0;
						$middleC = 0;
						$firstC = 0;
						if ($main[0]) {
							$first = explode('||', $main[0]);
							$firstC = count($first);
						}
						if ($main[1]) {
							$middle = explode('||', $main[1]);
							$middleC = count($middle);
						}
						if ($main[2]) {
							$last = explode('||', $main[2]);
							$lastC = count($last);
							$value = $last[0];
						}
						for ($aKey = 0; $aKey < $splitCount; $aKey++) {
							if ($firstC && isset($first[$aKey])) {
								$value = $first[$aKey];
							} elseif ($middleC) {
								$value = $middle[($aKey - $firstC) % $middleC];
							}
							if ($lastC && $lastC >= $splitCount - $aKey) {
								$value = $last[$lastC - ($splitCount - $aKey)];
							}
							$conf2[$aKey][$cKey] = trim($value);
						}
					}
				}
			}
		}
		return $conf2;
	}

}

?>