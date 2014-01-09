
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

GoogleMapsPHP.PlugIns.InfoWindow = GoogleMapsPHP.PlugIns.AbstractPlugIn.extend({

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

		this.anchor = settings.anchor || null;
		this.opened = settings.opened || null;
		this.keepOpen = settings.keepOpen || false;
		this.closeOnClickAgain = settings.closeOnClickAgain || false;
	},

	/**
	 * create
	 *
	 * @return GoogleMapsPHP.PlugIns.InfoWindow
	 */
	create: function() {

		if ( this.anchor ) {
			var anchor = this.getMapBuilder().findPlugInById( this.anchor );
			if ( anchor === null ) {
				GoogleMapsPHP.Utility.log( 'Anchor "' + this.anchor + '" not exists.' );
				return null;
			}
			this.anchor = anchor.getObject();
		}

		this.object = new google.maps.InfoWindow( this.options );

		// Create listener for anchor.
		if ( this.anchor ) {
			var $this = this;
			google.maps.event.addListener( this.anchor, 'click', function( event ) {
				if ( $this.getObject().getMap() instanceof google.maps.Map && $this.closeOnClickAgain ) {
					$this.close();
				} else if ( $this.getObject().getMap() instanceof google.maps.Map === false ) {
					$this.getMapBuilder().close( true );
					$this.open( $this.anchor );
				}
			});
		}
		if ( this.opened ) {
			this.open();
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
		if ( this.anchor instanceof google.maps.Marker ) {
			bounds.extend( this.anchor.getPosition() );
		} else if ( this.getObject().getPosition() ) {
			bounds.extend( this.getObject().getPosition() );
		}

		return bounds;
	},

	/**
	 * open
	 *
	 * @param google.maps.Marker anchor
	 * @return GoogleMapsPHP.PlugIns.InfoWindow
	 */
	open: function( anchor ) {
		// Anchors only works with marker.
		if ( anchor instanceof google.maps.Marker ) {
			this.getObject().open( this.getMap(), anchor );
		} else {
			this.getObject().open( this.getMap() );
		}
		return this;
	},

	/**
	 * close
	 *
	 * @param boolean checkKeepOpen
	 * @return GoogleMapsPHP.PlugIns.InfoWindow
	 */
	close: function( checkKeepOpen ) {
		if ( !checkKeepOpen || ( checkKeepOpen && this.keepOpen === false ) ) {
			this.getObject().close();
		}
		return this;
	},

	/**
	 * show
	 *
	 * @return GoogleMapsPHP.PlugIns.InfoWindow
	 */
	show: function() {
		this.getObject().setMap( this.getMap() );
		return this;
	},

	/**
	 * hide
	 *
	 * @return GoogleMapsPHP.PlugIns.InfoWindow
	 */
	hide: function() {
		this.close();
		this.getObject().setMap( null );
		return this;
	},

	/**
	 * hide
	 *
	 * @return GoogleMapsPHP.PlugIns.InfoWindow
	 */
	detach: function() {
		this.close().hide();
		return this;
	}
});