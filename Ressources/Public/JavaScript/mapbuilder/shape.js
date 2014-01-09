
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

GoogleMapsPHP.PlugIns.Shape = GoogleMapsPHP.PlugIns.AbstractPlugIn.extend({

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
	 * getBounds
	 *
	 * @return google.maps.LatLngBounds
	 */
	getBounds: function() {

		// Get bounds of object position.
		var bounds = new google.maps.LatLngBounds();
		bounds.union( this.getObject().getPath() );

		return bounds;
	},

	/**
	 * show
	 *
	 * @return GoogleMapsPHP.PlugIns.Polyline
	 */
	show: function() {
		this.getObject().setMap( this.getMap() );
		return this;
	},

	/**
	 * hide
	 *
	 * @return GoogleMapsPHP.PlugIns.Polyline
	 */
	hide: function() {
		this.getObject().setMap( null );
		return this;
	},

	/**
	 * hide
	 *
	 * @return GoogleMapsPHP.PlugIns.Polyline
	 */
	detach: function() {
		this.hide();
		return this;
	}
});