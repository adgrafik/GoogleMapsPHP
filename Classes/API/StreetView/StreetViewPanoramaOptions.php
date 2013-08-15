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

namespace AdGrafik\GoogleMapsPHP\API\StreetView;

/**
 * API equivalent to google.maps.StreetViewPanoramaOptions.
 *
 * @see https://developers.google.com/maps/documentation/javascript/reference
 * @author Arno Dudek <webmaster@adgrafik.at>
 */
class StreetViewPanoramaOptions extends \AdGrafik\GoogleMapsPHP\Object\OptionsArrayAccess {

	/**
	 * @var boolean $addressControl
	 */
	public $addressControl;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\API\Controls\StreetViewAddressControlOptions $addressControlOptions
	 */
	public $addressControlOptions;

	/**
	 * @var boolean $clickToGo
	 */
	public $clickToGo;

	/**
	 * @var boolean $disableDoubleClickZoom
	 */
	public $disableDoubleClickZoom;

	/**
	 * @var boolean $enableCloseButton
	 */
	public $enableCloseButton;

	/**
	 * @var boolean $imageDateControl
	 */
	public $imageDateControl;

	/**
	 * @var boolean $linksControl
	 */
	public $linksControl;

	/**
	 * @var boolean $panControl
	 */
	public $panControl;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\API\Controls\PanControlOptions $panControlOptions
	 */
	public $panControlOptions;

	/**
	 * @var string $pano
	 */
	public $pano;

	/**
	 * @var mixed $panoProvider
	 * TODO: implement $panoProvider
	public $panoProvider;
	 */

	/**
	 * @var \AdGrafik\GoogleMapsPHP\API\Base\LatLng $position
	 */
	public $position;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPov $pov
	 * TODO: implement StreetViewPov
	public $pov;
	 */

	/**
	 * @var boolean $scrollwheel
	 */
	public $scrollwheel;

	/**
	 * @var boolean $visible
	 */
	public $visible;

	/**
	 * @var boolean $zoomControl
	 */
	public $zoomControl;

	/**
	 * @var \AdGrafik\GoogleMapsPHP\API\Controls\ZoomControlOptions $zoomControlOptions
	 */
	public $zoomControlOptions;

	/**
	 * Set addressControl
	 *
	 * @param boolean $addressControl
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setAddressControl($addressControl) {
		$this->addressControl = (boolean) $addressControl;
		return $this;
	}

	/**
	 * Get addressControl
	 *
	 * @return boolean
	 */
	public function isAddressControl() {
		return $this->addressControl;
	}

	/**
	 * Set addressControlOptions
	 *
	 * @param \AdGrafik\GoogleMapsPHP\API\Controls\StreetViewAddressControlOptions $addressControlOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setAddressControlOptions(\AdGrafik\GoogleMapsPHP\API\Controls\StreetViewAddressControlOptions $addressControlOptions) {
		$this->addressControlOptions = $addressControlOptions;
		return $this;
	}

	/**
	 * Get addressControlOptions
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\StreetViewAddressControlOptions
	 */
	public function getAddressControlOptions() {
		return $this->addressControlOptions;
	}

	/**
	 * Set clickToGo
	 *
	 * @param boolean $clickToGo
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setClickToGo($clickToGo) {
		$this->clickToGo = (boolean) $clickToGo;
		return $this;
	}

	/**
	 * Get clickToGo
	 *
	 * @return boolean
	 */
	public function isClickToGo() {
		return $this->clickToGo;
	}

	/**
	 * Set disableDoubleClickZoom
	 *
	 * @param boolean $disableDoubleClickZoom
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setDisableDoubleClickZoom($disableDoubleClickZoom) {
		$this->disableDoubleClickZoom = (boolean) $disableDoubleClickZoom;
		return $this;
	}

	/**
	 * Get disableDoubleClickZoom
	 *
	 * @return boolean
	 */
	public function isDisableDoubleClickZoom() {
		return $this->disableDoubleClickZoom;
	}

	/**
	 * Set enableCloseButton
	 *
	 * @param boolean $enableCloseButton
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setEnableCloseButton($enableCloseButton) {
		$this->enableCloseButton = (boolean) $enableCloseButton;
		return $this;
	}

	/**
	 * Get enableCloseButton
	 *
	 * @return boolean
	 */
	public function isEnableCloseButton() {
		return $this->enableCloseButton;
	}

	/**
	 * Set imageDateControl
	 *
	 * @param boolean $imageDateControl
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setImageDateControl($imageDateControl) {
		$this->imageDateControl = (boolean) $imageDateControl;
		return $this;
	}

	/**
	 * Get imageDateControl
	 *
	 * @return boolean
	 */
	public function isImageDateControl() {
		return $this->imageDateControl;
	}

	/**
	 * Set linksControl
	 *
	 * @param boolean $linksControl
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setLinksControl($linksControl) {
		$this->linksControl = (boolean) $linksControl;
		return $this;
	}

	/**
	 * Get linksControl
	 *
	 * @return boolean
	 */
	public function isLinksControl() {
		return $this->linksControl;
	}

	/**
	 * Set panControl
	 *
	 * @param boolean $panControl
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setPanControl($panControl) {
		$this->panControl = (boolean) $panControl;
		return $this;
	}

	/**
	 * Get panControl
	 *
	 * @return boolean
	 */
	public function isPanControl() {
		return $this->panControl;
	}

	/**
	 * Set panControlOptions
	 *
	 * @param \AdGrafik\GoogleMapsPHP\API\Controls\PanControlOptions $panControlOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setPanControlOptions(\AdGrafik\GoogleMapsPHP\API\Controls\PanControlOptions $panControlOptions) {
		$this->panControlOptions = $panControlOptions;
		return $this;
	}

	/**
	 * Get panControlOptions
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\PanControlOptions
	 */
	public function getPanControlOptions() {
		return $this->panControlOptions;
	}

	/**
	 * Set pano
	 *
	 * @param string $pano
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setPano($pano) {
		$this->pano = $pano;
		return $this;
	}

	/**
	 * Get pano
	 *
	 * @return string
	 */
	public function getPano() {
		return $this->pano;
	}

	/**
	 * Set panoProvider
	 *
	 * @param mixed $panoProvider
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setPanoProvider($panoProvider) {
		$this->panoProvider = $panoProvider;
		return $this;
	}

	/**
	 * Get panoProvider
	 *
	 * @return mixed
	 */
	public function getPanoProvider() {
		return $this->panoProvider;
	}

	/**
	 * Set position
	 *
	 * @param \AdGrafik\GoogleMapsPHP\API\Base\LatLng $position
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setPosition(\AdGrafik\GoogleMapsPHP\API\Base\LatLng $position) {
		$this->position = $position;
		return $this;
	}

	/**
	 * Get position
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Base\LatLng
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * Set pov
	 *
	 * @param \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPov $pov
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setPov(\AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPov $pov) {
		$this->pov = $pov;
		return $this;
	}

	/**
	 * Get pov
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPov
	 */
	public function getPov() {
		return $this->pov;
	}

	/**
	 * Set scrollwheel
	 *
	 * @param boolean $scrollwheel
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setScrollwheel($scrollwheel) {
		$this->scrollwheel = (boolean) $scrollwheel;
		return $this;
	}

	/**
	 * Get scrollwheel
	 *
	 * @return boolean
	 */
	public function isScrollwheel() {
		return $this->scrollwheel;
	}

	/**
	 * Set visible
	 *
	 * @param boolean $visible
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
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
	 * Set zoomControl
	 *
	 * @param boolean $zoomControl
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setZoomControl($zoomControl) {
		$this->zoomControl = (boolean) $zoomControl;
		return $this;
	}

	/**
	 * Get zoomControl
	 *
	 * @return boolean
	 */
	public function isZoomControl() {
		return $this->zoomControl;
	}

	/**
	 * Set zoomControlOptions
	 *
	 * @param \AdGrafik\GoogleMapsPHP\API\Controls\ZoomControlOptions $zoomControlOptions
	 * @return \AdGrafik\GoogleMapsPHP\API\StreetView\StreetViewPanoramaOptions
	 */
	public function setZoomControlOptions(\AdGrafik\GoogleMapsPHP\API\Controls\ZoomControlOptions $zoomControlOptions) {
		$this->zoomControlOptions = $zoomControlOptions;
		return $this;
	}

	/**
	 * Get zoomControlOptions
	 *
	 * @return \AdGrafik\GoogleMapsPHP\API\Controls\ZoomControlOptions
	 */
	public function getZoomControlOptions() {
		return $this->zoomControlOptions;
	}

}

?>