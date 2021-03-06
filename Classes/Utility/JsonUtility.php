<?php

/***************************************************************
 * Copyright notice
 *
 * (c) 2008 Dave Perrett <hello@daveperrett.com>
 * All rights reserved
 *
 * This script is part of the GoogleMapsPHP project. An easy to 
 * use Google Maps API for PHP.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

namespace AdGrafik\GoogleMapsPHP\Utility;

/**
 * Format JSON With PHP.
 *
 * @see http://www.daveperrett.com/articles/2008/03/11/format-json-with-php/
 * @author Dave Perrett <hello@daveperrett.com>
 */
class JsonUtility {

	/**
	 * Indents a flat JSON string to make it more human-readable.
	 *
	 * @param string $json The original JSON string to process.
	 * @return string Indented version of the original JSON string.
	 */
	static public function prettify($json) {

		$result = '';
		$pos = 0;
		$strLen = strlen($json);
		$indentStr = "\t";
		$newLine = "\n";
		$prevChar = '';
		$outOfQuotes = true;

		for ($i=0; $i<=$strLen; $i++) {

			// Grab the next character in the string.
			$char = substr($json, $i, 1);

			// Are we inside a quoted string?
			if ($char == '"' && $prevChar != '\\') {
				$outOfQuotes = !$outOfQuotes;

			// If this character is the end of an element,
			// output a new line and indent the next line.
			} else if(($char == '}' || $char == ']') && $outOfQuotes) {
				$result .= $newLine;
				$pos --;
				for ($j=0; $j<$pos; $j++) {
					$result .= $indentStr;
				}
			}

			// Add the character to the result string.
			$result .= $char;

			// If the last character was the beginning of an element,
			// output a new line and indent the next line.
			if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
				$result .= $newLine;
				if ($char == '{' || $char == '[') {
					$pos ++;
				}

				for ($j = 0; $j < $pos; $j++) {
					$result .= $indentStr;
				}
			}

			$prevChar = $char;
		}

		return $result;

	}

	/**
	 * makeConstant
	 *
	 * @param string $className
	 * @param string $value
	 * @return \StdClass
	 */
	static public function makeConstant($className, $value) {
		$stdClass = new \StdClass();
		$stdClass->className = $className;
		$stdClass->constant = $value;
		return $stdClass;
	}

}

?>