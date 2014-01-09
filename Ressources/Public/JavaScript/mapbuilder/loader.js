
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

GoogleMapsPHP.PlugIns.Loader = GoogleMapsPHP.PlugIns.AbstractPlugIn.extend({

	/**
	 * initialize
	 *
	 * @param object settings
	 * @param object mapBuilder
	 * @return void
	 */
	initialize: function( settings, mapBuilder ) {

		this.parent( settings, mapBuilder );

		this.url = settings.url;
		this.parameters = settings.parameters || {};
		this.viewportManagement = settings.viewportManagement || false;
		this.viewportOffset = settings.viewportOffset || .5;

		this.xhr = null;
	},

	/**
	 * create
	 *
	 * @return GoogleMapsPHP.PlugIns.Loader
	 */
	create: function() {

		var $this = this;

		if ( this.viewportManagement ) {
			google.maps.event.addListener( this.getMap(), 'idle', function(){
				$this.load();
			});
		} else {
			google.maps.event.addListenerOnce( this.getMap(), 'idle', function(){
				$this.load();
			});
		}

		return this;
	},

	/**
	 * load
	 *
	 * @return GoogleMapsPHP.PlugIns.Loader
	 */
	load: function() {

		var $this = this;

		// Append bounds to parameters.
		var bounds = this.getMapBuilder().getMapBoundsWithOffset( this.viewportOffset );
		this.parameters.bounds = ( bounds )
			? bounds.toUrlValue()
			: '';

		this.parameters.mapId = this.getMapBuilder().getMapId();
		this.parameters.viewportManagement = this.viewportManagement;

		// Abort running request.
		if ( this.xhr ) {
			this.xhr.abort();
			this.onComplete();
		}

		var url = this.url || '',
			parameters = this.parameters || '',
			method = this.method || 'POST',
			onSuccess = this.onSuccess || false,
			onError = this.onSuccess || false;

		this.xhr = jQuery.ajax({

			url: this.url,
			data: this.parameters,
			type: method,
			dataType: 'json',
			converters: {'text json': function( data ){
				eval( 'data = ' + data );
				return data;
			}},

			success: function( data, status, xhr ){
				$this.onSuccess( data, status, xhr );
			},

			onComplete: function( xhr, status ){
				$this.onComplete( xhr, status );
			},

			error: function( xhr, status, error ){
				$this.onError( xhr, status, error );
			}
		});

		return this;
	},

	/**
	 * onSuccess
	 *
	 * @param object data
	 * @param string status
	 * @param object xhr
	 * @return void
	 */
	onSuccess: function( data, status, xhr ) {

		if ( data.status == 'error' ) {
			GoogleMapsPHP.Utility.log( data.message );
			return;
		}

		// Remap objects if viewport management is set.
		if ( this.viewportManagement ) {
			var plugIns = this.getMapBuilder().getPlugIns();
			var mapBounds = this.getMapBuilder().getMapBoundsWithOffset( this.viewportOffset );
			for ( var id in plugIns ) {
				if ( typeof plugIns[id].getBounds == 'function' ) {
					var plugInBounds = plugIns[id].getBounds();
					if ( plugInBounds && plugInBounds.intersects( mapBounds ) === false ) {
						this.getMapBuilder().detach( plugIns[id].getId() );
					}
				}
			}
		}

		// Create plugIns.
		data.plugIns = data.plugIns || [];
		this.getMapBuilder().build( data.plugIns );
	},

	/**
	 * onComplete
	 *
	 * @param object xhr
	 * @param string status
	 * @return void
	 */
	onComplete: function( xhr, status ) {
		this.xhr = null;
	},

	/**
	 * onError
	 *
	 * @param object xhr
	 * @param string status
	 * @param object error
	 * @return void
	 */
	onError: function( xhr, status, error ) {
		if ( status != 'abort' && console ) {
			GoogleMapsPHP.Utility.log( status );
			GoogleMapsPHP.Utility.log( error );
			GoogleMapsPHP.Utility.log( xhr );
		}
	},

	/**
	 * getUrl
	 *
	 * @return string
	 */
	getUrl: function() {
		return this.url;
	},

	/**
	 * getParameters
	 *
	 * @return object
	 */
	getParameters: function() {
		return this.parameters;
	},

	/**
	 * isViewportManagement
	 *
	 * @return boolean
	 */
	isViewportManagement: function() {
		return this.viewportManagement;
	}
});