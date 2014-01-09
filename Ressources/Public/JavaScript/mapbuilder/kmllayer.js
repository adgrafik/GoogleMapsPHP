
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

GoogleMapsPHP.PlugIns.KmlLayer = GoogleMapsPHP.PlugIns.AbstractPlugIn.extend({

	/**
	 * initialize
	 *
	 * @param object settings
	 * @param object mapBuilder
	 * @return void
	 */
	initialize: function( settings, mapBuilder ) {

		this.parent( settings, mapBuilder );

		this.options = settings.object.options || {};
		GoogleMapsPHP.Utility.prepareData( this.options );
	},

	/**
	 * create
	 *
	 * @return GoogleMapsPHP.PlugIns.KmlLayer
	 */
	create: function() {

		this.object = new google.maps.KmlLayer( this.options );
		this.show();

		// Set current map.
		if ( this.getMapBuilder().isCategoryHidden() === false ) {
//			this.show();
		}

		return this;
	},

	/**
	 * getBounds
	 *
	 * @return google.maps.LatLngBounds
	 */
	getBounds: function() {

		// Get bounds of object position.
		var bounds = this.getObject().getDefaultViewport();

		return bounds;
	},

	/**
	 * show
	 *
	 * @return GoogleMapsPHP.PlugIns.KmlLayer
	 */
	show: function() {
		this.getObject().setMap( this.getMap() );
		return this;
	},

	/**
	 * hide
	 *
	 * @return GoogleMapsPHP.PlugIns.KmlLayer
	 */
	hide: function() {
		this.getObject().setMap( null );
		return this;
	},

	/**
	 * hide
	 *
	 * @return GoogleMapsPHP.PlugIns.KmlLayer
	 */
	detach: function() {
		this.hide();
		return this;
	}
});