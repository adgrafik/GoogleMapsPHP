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

namespace GoogleMapsPHP\API\Overlays;

use GoogleMapsPHP\Utility\ClassUtility;

/**
 * API equivalent to google.maps.MarkerOptions.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class MarkerOptions {

	/**
	 * @var \GoogleMapsPHP\API\Base\Point $anchorPoint
	 */
	public $anchorPoint;

	/**
	 * @var string<\GoogleMapsPHP\API\Overlays\Animation::BOUNCE|DROP> $animation
	 */
	public $animation;

	/**
	 * @var boolean $clickable
	 */
	public $clickable;

	/**
	 * @var string $cursor
	 */
	public $cursor;

	/**
	 * @var boolean $draggable
	 */
	public $draggable;

	/**
	 * @var boolean $flat
	 */
	public $flat;

	/**
	 * @var string|array|\GoogleMapsPHP\API\Overlays\Icon|\GoogleMapsPHP\API\Overlays\Symbol $icon
	 */
	public $icon;

	/**
	 * @var boolean $optimized
	 */
	public $optimized;

	/**
	 * @var \GoogleMapsPHP\API\Base\LatLng $position
	 */
	public $position;

	/**
	 * @var boolean $raiseOnDrag
	 */
	public $raiseOnDrag;

	/**
	 * @var boolean $crossOnDrag
	 */
	public $crossOnDrag;

	/**
	 * @var string|array|\GoogleMapsPHP\API\Overlays\Icon|\GoogleMapsPHP\API\Overlays\Symbol $shadow
	 */
	public $shadow;

	/**
	 * @var array|\GoogleMapsPHP\API\Overlays\MarkerShape $shape
	 */
	public $shape;

	/**
	 * @var string $title
	 */
	public $title;

	/**
	 * @var boolean $visible
	 */
	public $visible;

	/**
	 * @var integer $zIndex
	 */
	public $zIndex;

	/**
	 * Set anchorPoint
	 *
	 * @param \GoogleMapsPHP\API\Base\Point $anchorPoint
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setAnchorPoint(\GoogleMapsPHP\API\Base\Point $anchorPoint) {
		$this->anchorPoint = $anchorPoint;
		return $this;
	}

	/**
	 * Get anchorPoint
	 *
	 * @return \GoogleMapsPHP\API\Base\Point
	 */
	public function getAnchorPoint() {
		return $this->anchorPoint;
	}

	/**
	 * Set animation
	 *
	 * @param string<\GoogleMapsPHP\API\Overlays\Animation::BOUNCE|DROP> $animation
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setAnimation($animation) {

		$this->animation = new \StdClass();
		$this->animation->className = 'Animation';
		$this->animation->constant = $animation;

		return $this;
	}

	/**
	 * Get animation
	 *
	 * @return string
	 */
	public function getAnimation() {
		return ($this->animation instanceof \StdClass)
			? $this->animation->constant
			: NULL;
	}

	/**
	 * Set clickable
	 *
	 * @param boolean $clickable
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setClickable($clickable) {
		$this->clickable = (boolean) $clickable;
		return $this;
	}

	/**
	 * Get clickable
	 *
	 * @return boolean
	 */
	public function isClickable() {
		return $this->clickable;
	}

	/**
	 * Set cursor
	 *
	 * @param string $cursor
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setCursor($cursor) {
		$this->cursor = $cursor;
		return $this;
	}

	/**
	 * Get cursor
	 *
	 * @return string
	 */
	public function getCursor() {
		return $this->cursor;
	}

	/**
	 * Set draggable
	 *
	 * @param boolean $draggable
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setDraggable($draggable) {
		$this->draggable = (boolean) $draggable;
		return $this;
	}

	/**
	 * Get draggable
	 *
	 * @return boolean
	 */
	public function isDraggable() {
		return $this->draggable;
	}

	/**
	 * Set flat
	 *
	 * @param boolean $flat
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setFlat($flat) {
		$this->flat = (boolean) $flat;
		return $this;
	}

	/**
	 * Get flat
	 *
	 * @return boolean
	 */
	public function isFlat() {
		return $this->flat;
	}

	/**
	 * Set icon
	 *
	 * @param string|array|\GoogleMapsPHP\API\Overlays\Icon|\GoogleMapsPHP\API\Overlays\Symbol $icon
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setIcon($icon) {

		if ($icon instanceof \GoogleMapsPHP\API\Overlays\Icon === FALSE) {
			$icon = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Overlays\\Icon', $icon);
		}

		$this->icon = $icon;
		return $this;
	}

	/**
	 * Get icon
	 *
	 * @return string|\GoogleMapsPHP\API\Overlays\IconInterface
	 */
	public function getIcon() {
		return $this->icon;
	}

	/**
	 * Set optimized
	 *
	 * @param boolean $optimized
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setOptimized($optimized) {
		$this->optimized = (boolean) $optimized;
		return $this;
	}

	/**
	 * Get optimized
	 *
	 * @return boolean
	 */
	public function isOptimized() {
		return $this->optimized;
	}

	/**
	 * Set position
	 *
	 * @param mixed $position
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setPosition($position) {
		if ($position instanceof \GoogleMapsPHP\API\Base\LatLng === FALSE) {
			$position = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Base\\LatLng', $position);
		}
		$this->position = $position;
		return $this;
	}

	/**
	 * Get position
	 *
	 * @return \GoogleMapsPHP\API\Base\LatLng
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * Set raiseOnDrag
	 *
	 * @param boolean $raiseOnDrag
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setRaiseOnDrag($raiseOnDrag) {
		$this->raiseOnDrag = (boolean) $raiseOnDrag;
		return $this;
	}

	/**
	 * Get raiseOnDrag
	 *
	 * @return boolean
	 */
	public function isRaiseOnDrag() {
		return $this->raiseOnDrag;
	}

	/**
	 * Set crossOnDrag
	 *
	 * @param boolean $crossOnDrag
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setCrossOnDrag($crossOnDrag) {
		$this->crossOnDrag = (boolean) $crossOnDrag;
		return $this;
	}

	/**
	 * Get crossOnDrag
	 *
	 * @return boolean
	 */
	public function isCrossOnDrag() {
		return $this->crossOnDrag;
	}

	/**
	 * Set shadow
	 *
	 * @param string|array|\GoogleMapsPHP\API\Overlays\Icon|\GoogleMapsPHP\API\Overlays\Symbol $shadow
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setShadow($shadow) {

		if ($shadow instanceof \GoogleMapsPHP\API\Overlays\Icon === FALSE) {
			$shadow = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Overlays\\Icon', $shadow);
		}

		$this->shadow = $shadow;
		return $this;
	}

	/**
	 * Get shadow
	 *
	 * @return string|\GoogleMapsPHP\API\Overlays\IconInterface
	 */
	public function getShadow() {
		return $this->shadow;
	}

	/**
	 * Set shape
	 *
	 * @param array|\GoogleMapsPHP\API\Overlays\MarkerShape $shape
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setShape($shape) {

		if ($shape instanceof \GoogleMapsPHP\API\Overlays\MarkerShape === FALSE) {
			$shape = ClassUtility::makeInstance('\\GoogleMapsPHP\\API\\Overlays\\MarkerShape', $shape);
		}

		$this->shape = $shape;
		return $this;
	}

	/**
	 * Get shape
	 *
	 * @return \GoogleMapsPHP\API\Overlays\MarkerShape
	 */
	public function getShape() {
		return $this->shape;
	}

	/**
	 * Set title
	 *
	 * @param string $title
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}

	/**
	 * Get title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Set visible
	 *
	 * @param boolean $visible
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setVisible($visible) {
		$this->visible = (boolean) $visible;
		return $this;
	}

	/**
	 * Get visible
	 *
	 * @return boolean
	 */
	public function isVisible() {
		return $this->visible;
	}

	/**
	 * Set zIndex
	 *
	 * @param integer $zIndex
	 * @return \GoogleMapsPHP\API\Overlays\Marker
	 */
	public function setZIndex($zIndex) {
		$this->zIndex = (integer) $zIndex;
		return $this;
	}

	/**
	 * Get zIndex
	 *
	 * @return integer
	 */
	public function getZIndex() {
		return $this->zIndex;
	}

}

?>