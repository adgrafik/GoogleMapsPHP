
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

GoogleMapsPHP.PlugIns.MarkerClusterer = GoogleMapsPHP.PlugIns.AbstractPlugIn.extend({

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

		this.markerClustererMarkers = [];
	},

	/**
	 * create
	 *
	 * @return GoogleMapsPHP.PlugIns.MarkerClusterer
	 */
	create: function() {

		if ( typeof MarkerClusterer == 'undefined' ) {
			GoogleMapsPHP.Utility.log( 'MarkerClusterer library not loaded.' );
			return;
		}

		this.object = new MarkerClusterer( this.getMap(), this.markerClustererMarkers, this.options );

		// Get first already created markers.
		var plugIns = this.getMapBuilder().getPlugIns();
		var length = plugIns.length;
		for ( var id in plugIns ) {
			var object = plugIns[id].getObject();
			if ( object instanceof google.maps.Marker ) {
				this.object.addMarker( object );
			}
		}

		// Extend marker builder with a listener.
		var $this = this;
		this.getMapBuilder().addEventListener( 'plugin_created', function( event ) {
			if ( this.getObject() instanceof google.maps.Marker ) {
				$this.object.addMarker( this.getObject() );
			}
		});

		return this;
	}
});