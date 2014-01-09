
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

GoogleMapsPHP.PlugIns.Map = GoogleMapsPHP.PlugIns.AbstractPlugIn.extend({

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

		this.fitBoundsOnLoad = settings.fitBoundsOnLoad || false;
		this.closeAllInfoWindowsOnMapClick = settings.closeAllInfoWindowsOnMapClick || false;

		this.canvas = document.getElementById( settings.object.div );
	},

	/**
	 * create
	 *
	 * @return GoogleMapsPHP.PlugIns.Map
	 */
	create: function() {

		// Create map.
		this.object = new google.maps.Map( this.canvas, this.options );
		this.getMapBuilder().setMap( this.object );

		// Add click event for the map.
		var $this = this;
		if ( this.closeAllInfoWindowsOnMapClick === true ) {
			google.maps.event.addListener( this.object, 'click', function( event ) {
				$this.getMapBuilder().close( true );
			});
		}

		// Add fit bounds event for the map.
		if ( this.fitBoundsOnLoad === true ) {
			google.maps.event.addListenerOnce( this.object, 'idle', function( event ) {

				var bounds = new google.maps.LatLngBounds();
				var plugIns = $this.getMapBuilder().getPlugIns();
				for ( var id in plugIns ) {
					if ( plugIns[id].getBounds ) {
						bounds.union( plugIns[id].getBounds() );
					}
				}

				if ( bounds.isEmpty() === false ) {
					this.fitBounds( bounds );
				}
			});
		}

		return this;
	}
});