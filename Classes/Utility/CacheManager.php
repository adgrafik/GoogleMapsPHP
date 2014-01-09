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
	public static $cachePath;

	/**
	 * @var integer $cacheLifeTime
	 */
	public static $cacheLifeTime;

	/**
	 * __construct
	 */
	public function __construct() {
		// Clear cache if expired.
		$caches = glob(static::getCachePath() . '*.php');
		foreach ($caches as &$cachePathAndFilename) {
			if ($this->isExpired($cachePathAndFilename)) {
				unlink($cachePathAndFilename);
			}
		}
	}

	/**
	 * Set cachePath
	 *
	 * @param string $cachePath
	 * @return void
	 */
	public static function setCachePath($cachePath) {
		static::$cachePath = $cachePath;
	}

	/**
	 * Get cachePath
	 *
	 * @return string
	 */
	public static function getCachePath() {
		return static::$cachePath;
	}

	/**
	 * Set cacheLifeTime
	 *
	 * @param integer $cacheLifeTime
	 * @return void
	 */
	public static function setCacheLifeTime($cacheLifeTime) {
		static::$cacheLifeTime = (integer) $cacheLifeTime;
	}

	/**
	 * Get cacheLifeTime
	 *
	 * @return integer
	 */
	public static function getCacheLifeTime() {
		return static::$cacheLifeTime;
	}

	/**
	 * isExpired
	 *
	 * @param string $key
	 * @return boolean
	 */
	public function isExpired($key) {
		$cachePathAndFilename = is_file($key)
			? $key
			: $this->getCachePathAndFilename($key);
		return is_file($cachePathAndFilename)
			? (time() - @filemtime($cachePathAndFilename) >= static::getCacheLifeTime())
			: FALSE;
	}

	/**
	 * saveFile
	 *
	 * @param string $key
	 * @param string $content
	 * @param boolean $asVarExport
	 * @return void
	 */
	public function save($key, $content, $asVarExport = FALSE) {
		$cachePathAndFilename = $this->getCachePathAndFilename($key);
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
	 * @param string $key
	 * @param boolean $isVarExport
	 * @return mixed
	 */
	public function read($key, $isVarExport = FALSE) {
		$cachePathAndFilename = $this->getCachePathAndFilename($key);
		if (is_file($cachePathAndFilename)) {
			if ($isVarExport) {
				return include($cachePathAndFilename);
			} else {
				$content = file_get_contents($cachePathAndFilename);
				return unserialize($content);
			}
		}
		return FALSE;
	}

	/**
	 * getCachePathAndFilename
	 *
	 * @param string $key
	 * @return boolean
	 */
	protected function getCachePathAndFilename($key) {
		return static::$cachePath . $key . '.php';
	}

}

?>