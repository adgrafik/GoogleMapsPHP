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

namespace AdGrafik\GoogleMapsPHP\Utility;

/**
 * MapUtility class.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class MapUtility {

	const GEOGODE_TYPE_ARRAY = 'array';
	const GEOGODE_TYPE_JSON = 'json';
	const GEOGODE_TYPE_XML = 'xml';

	/**
	 * isValidDiv
	 *
	 * @param string $div
	 * @return boolean
	 */
	static public function isValidDiv($div) {
		return (is_string($div) && !preg_match('/[^a-z0-9_]/i', $div));
	}

	/**
	 * geocodeRequest
	 *
	 * @param array|string $request
	 * @param string $type
	 * @return array
	 * @throw array
	 */
	static public function geocodeRequest($request, $type = self::GEOGODE_TYPE_ARRAY) {

		$settings = \AdGrafik\GoogleMapsPHP\Utility\ClassUtility::makeInstance('\\AdGrafik\\GoogleMapsPHP\\Configuration\\Settings');

		$request = is_array($request)
			? $request
			: array('address' => $request);

		$source = $settings->get('utility.geocoder.source');
		$parameters = $settings->get('utility.geocoder.parameters');
		$parameters = array_replace_recursive($parameters, $request);

		// Convert boolen values to string and remove empty values.
		foreach ($parameters as $key => &$value) {
			if (is_bool($value)) {
				$value = $value ? 'true' : 'false';
			} else if ($value === '') {
				unset($parameters[$key]);
			}
		}

		$requestType = ($type === self::GEOGODE_TYPE_ARRAY)
			? self::GEOGODE_TYPE_JSON
			: $type;

		$requestUrl = $source . $requestType . '?' . http_build_query($parameters);
		$response = file_get_contents($requestUrl);

		if ($response === FALSE) {
			throw new \AdGrafik\GoogleMapsPHP\Exception(sprintf('URL "%s" could not be fetched. Possible reasons: network problems, allow_url_fopen is off.', $requestUrl), 1334426097);
		}

		return ($type === self::GEOGODE_TYPE_ARRAY)
			? json_decode($response)
			: $response;
	}
}

?>