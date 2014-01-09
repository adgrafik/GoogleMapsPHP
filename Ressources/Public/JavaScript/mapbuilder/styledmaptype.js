
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

GoogleMapsPHP.PlugIns.StyledMapType = GoogleMapsPHP.PlugIns.AbstractPlugIn.extend({

	/**
	 * initialize
	 *
	 * @param object settings
	 * @param object mapBuilder
	 * @return void
	 */
	initialize: function( settings, mapBuilder ) {

		this.parent( settings, mapBuilder );

		this.styles = settings.object.styles || [];
		this.options = settings.object.options || {};
		GoogleMapsPHP.Utility.prepareData( this.options );

		this.showOnInitialize = settings.showOnInitialize || false;
	},

	/**
	 * create
	 *
	 * @return GoogleMapsPHP.PlugIns.MapTypeStyle
	 */
	create: function() {

		this.object = new google.maps.StyledMapType( this.styles, this.options );

		this.getMap().mapTypes.set( this.getId(), this.object );

		if ( this.showOnInitialize ) {
			var $this = this;
			google.maps.event.addListenerOnce( this.getMap(), 'idle', function( event ) {
				$this.getMap().setMapTypeId( $this.getId() );

			});
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
		var bounds = new google.maps.LatLngBounds();
		bounds.union( this.getObject().getPaths() );

		return bounds;
	}
});