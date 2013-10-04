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
 * Session class.
 *
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class CacheManager implements \AdGrafik\GoogleMapsPHP\Object\SingletonInterface {

	/**
	 * @var string $cachePath
	 */
	protected $cachePath;

	/**
	 * __construct
	 */
	public function __construct() {
		$this->cachePath = GMP_PATH . 'Ressources/Private/Cache/';
	}

	/**
	 * saveFile
	 *
	 * @param string $pathAndFilename
	 * @param string $content
	 * @param boolean $asVarExport
	 * @return void
	 */
	public function saveFile($pathAndFilename, $content, $asVarExport = FALSE) {
		$cachePathAndFilename = $this->cachePath . md5($pathAndFilename . '_' . filemtime($pathAndFilename)) . '.php';
		if ($asVarExport) {
			$content = '<?php' . PHP_EOL . PHP_EOL . 'return ' . var_export($content, TRUE) . PHP_EOL . PHP_EOL . '?>';
			file_put_contents($cachePathAndFilename, $content);
		} else {
			file_put_contents($cachePathAndFilename, serialize($content));
		}
	}

	/**
	 * readFile
	 *
	 * @param string $savedPathAndFilename
	 * @param boolean $isVarExport
	 * @return mixed
	 */
	public function readFile($savedPathAndFilename, $isVarExport = FALSE) {
		if (is_file($savedPathAndFilename)) {
			$cachedPathAndFilename = $this->cachePath . md5($savedPathAndFilename . '_' . filemtime($savedPathAndFilename)) . '.php';
			if (is_file($cachedPathAndFilename)) {
				if ($isVarExport) {
					return include($cachedPathAndFilename);
				} else {
					$content = file_get_contents($cachedPathAndFilename);
					return unserialize($content);
				}
			}
		}
		return FALSE;
	}

}

?>