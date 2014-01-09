
/**
 * Simple JavaScript Inheritance
 * Inspired by base2 and Prototype
 * By John Resig http://ejohn.org/
 * Adapted by Arno Dudek http://www.adgrafik.at
 * MIT Licensed.
 */
(function(){
	var initializing = false,
		fnTest = /xyz/.test(function(){xyz;}) ? /\bparent\b/ : /.*/;

	// The base Class implementation (does nothing)
	this.Class = function(){};

	// Create a new Class that inherits from this class
	Class.extend = function(prop) {
		var parent = this.prototype;

		// Instantiate a base class (but only create the instance,
		// don't run the init constructor)
		initializing = true;
		var prototype = new this();
		initializing = false;

		// Copy the properties over onto the new prototype
		for (var name in prop) {
			// Check if we're overwriting an existing function
			prototype[name] = typeof prop[name] == "function" && typeof parent[name] == "function" && fnTest.test(prop[name])
				? (function(name, fn){
					return function() {
						var tmp = this.parent;

						// Add a new .parent() method that is the same method
						// but on the super-class
						this.parent = parent[name];

						// The method only need to be bound temporarily, so we
						// remove it when we're done executing
						var ret = fn.apply(this, arguments);
						this.parent = tmp;

						return ret;
					};
				})(name, prop[name])
			: prop[name];
		}

		// The dummy class constructor
		function Class() {
			// All construction is actually done in the init method
			if ( !initializing && this.initialize )
				this.initialize.apply(this, arguments);
		}

		// Populate our constructed prototype object
		Class.prototype = prototype;

		// Enforce the constructor to be what we expect
		Class.prototype.constructor = Class;

		// And make this class extendable
		Class.extend = arguments.callee;

		return Class;
	};
})( window );


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

GoogleMapsPHP = {};

/**
 * GoogleMapsPHP.Utility
 * Utility class.
 */
GoogleMapsPHP.Utility = {

	debug: false,

	/**
	 * log
	 *
	 * @param string message
	 * @return void
	 */
	log: function( message ) {
		if ( this.debug && console ) {
			console.log( 'GoogleMapsPHP: ' + message );
		}
	},

	/**
	 * makeInstance
	 *
	 * @param object constructor
	 * @param array arguments
	 * @return mixed
	 * @see function from http://stackoverflow.com/a/3362623/
	 */
	makeInstance: function( constructor, arguments ) {
		var Temp = function(){}, instance, object;
		Temp.prototype = constructor.prototype;
		instance = new Temp;
		object = constructor.apply( instance, arguments );
		return Object( object ) === object ? object : instance;
	},

	/**
	 * prepareData
	 *
	 * @param object data
	 * @return object
	 */
	prepareData: function( data ) {
		if ( data.hasOwnProperty( 'className' ) ) {
			var target = eval( 'google.maps.' + data.className );
			if ( data.hasOwnProperty( 'constant' ) ) {
				data = target[data.constant];
			} else {
				data.arguments = data.arguments || [];
				var i = data.arguments.length;
				while ( i-- ) {
					data.arguments[i] = GoogleMapsPHP.Utility.prepareData( data.arguments[i] );
				}
				data = GoogleMapsPHP.Utility.makeInstance( target, data.arguments );
			}
		} else if ( typeof data == 'object' ) {
			for ( var i in data ) {
				data[i] = GoogleMapsPHP.Utility.prepareData( data[i] );
			}
		} else if ( typeof data == 'array' ) {
			var i = data.length;
			while ( i-- ) {
				data[i] = GoogleMapsPHP.Utility.prepareData( data[i] );
			}
		}
		return data;
	}
};

/**
 * GoogleMapsPHP main class.
 */
GoogleMapsPHP.MapBuilder = Class.extend({

	/**
	 * initialize
	 *
	 * @param object settings
	 * @return void
	 */
	initialize: function( settings ) {

		GoogleMapsPHP.Utility.debug = settings.debug || false;

		this.settings = settings || {};
		this.listeners = {};

		this.map = {};
		this.plugIns = {};

		this.hiddenCategories = {};

		// Prepend map plugIn to the end to be build first (array will be reversed).
		settings.plugIns = settings.plugIns || [];
		if ( settings.hasOwnProperty( 'mapPlugIn' ) ) {
			settings.plugIns.unshift( settings.mapPlugIn );
		}

		this.build( settings.plugIns );
	},

	/**
	 * build
	 *
	 * @param string plugIns
	 * @return GoogleMapsPHP.MapBuilder
	 */
	build: function( plugIns ) {

		if ( plugIns.length == 0) {
			GoogleMapsPHP.Utility.log( 'No plug-ins found.' );
		}

		this.fireEvent({
			type: 'plugins_create',
			target: plugIns
		});

		plugIns.reverse();

		var i = plugIns.length;
		while ( i-- ) {

			var plugInName = plugIns[i].plugInName;
			var id = plugIns[i].id;

			// If plug-in exists, nothing else to do.
			if ( this.plugIns.hasOwnProperty( id ) ) {
				continue;
			}

			if ( GoogleMapsPHP.PlugIns.hasOwnProperty( plugInName ) ) {

				this.fireEvent({
					type: 'plugin_create',
					target: this.plugIns[id],
					settings: plugIns[i]
				});

				this.plugIns[id] = new GoogleMapsPHP.PlugIns[plugInName]( plugIns[i], this );
				this.plugIns[id].create();

				this.fireEvent({
					type: 'plugin_created',
					target: this.plugIns[id],
					settings: plugIns[i]
				});

			} else {
				GoogleMapsPHP.Utility.log( 'Plug-in "' + plugInName + '" not exists.' );
			}
		}

		this.fireEvent({
			type: 'plugins_created',
			target: this.plugIns
		});

		return this;
	},

	/**
	 * addEventListener
	 *
	 * @param string message
	 * @param function listener
	 * @return void
	 */
	addEventListener: function( type, listener ) {
		if ( typeof this.listeners[type] == 'undefined' ) {
			this.listeners[type] = [];
		}
		this.listeners[type].unshift(listener);
	},

	/**
	 * removeListener
	 *
	 * @param string message
	 * @param function listener
	 * @return void
	 */
	removeListener: function( type, listener ) {
		if ( this.listeners[type] instanceof Array ) {
			var i = this.listeners[type].length;
			while ( i-- ) {
				if ( this.listeners[type][i] === listener ) {
					this.listeners[type].splice( i, 1 );
					break;
				}
			}
		}
	},

	/**
	 * fireEvent
	 *
	 * @param string|object event
	 * @return void
	 */
	fireEvent: function( event ) {

		if ( typeof event == 'string' ) {
			event = { type: event };
		}

		if ( !event.target ) {
			event.target = this;
		}

		if ( !event.type ) {
			GoogleMapsPHP.Utility.log( "Event object missing 'type' property." );
			return;
		}

		if ( this.listeners[event.type] instanceof Array ) {
			var i = this.listeners[event.type].length;
			while ( i-- ) {
				this.listeners[event.type][i].call( event.target, event );
			}
		}
	},

	/**
	 * show
	 *
	 * @param string [id]
	 * @return GoogleMapsPHP.MapBuilder
	 */
	show: function( id ) {
		if ( typeof id == 'undefined' ) {
			for ( var id in this.plugIns ) {
				if ( typeof this.plugIns[id].show == 'function' ) {
					this.plugIns[id].show();
					if ( typeof this.plugIns[id].getCategoryId == 'function' ) {
						var categoryId = this.plugIns[id].getCategoryId();
						this.hiddenCategories[categoryId] = false;
					}
				}
			}
		} else {
			if ( this.plugIns.hasOwnProperty( id ) && typeof this.plugIns[id].show == 'function' ) {
				this.plugIns[id].show();
			}
		}
		return this;
	},

	/**
	 * this
	 *
	 * @param string [id]
	 * @return GoogleMapsPHP.MapBuilder
	 */
	hide: function( id ) {
		if ( typeof id == 'undefined' ) {
			for ( var id in this.plugIns ) {
				if ( typeof this.plugIns[id].hide == 'function' ) {
					this.plugIns[id].hide();
					if ( typeof this.plugIns[id].getCategoryId == 'function' ) {
						var categoryId = this.plugIns[id].getCategoryId();
						this.hiddenCategories[categoryId] = true;
					}
				}
			}
		} else {
			if ( this.plugIns.hasOwnProperty( id ) && typeof this.plugIns[id].hide == 'function' ) {
				this.plugIns[id].hide();
			}
		}
		return this;
	},

	/**
	 * showCategory
	 *
	 * @param string categoryId
	 * @return GoogleMapsPHP.MapBuilder
	 */
	showCategory: function( categoryId ) {
		this.hiddenCategories[categoryId] = false;
		for ( var id in this.plugIns ) {
			if ( typeof this.plugIns[id].getCategoryId == 'function' && typeof this.plugIns[id].show == 'function' && this.plugIns[id].getCategoryId() == categoryId ) {
				this.plugIns[id].show();
			}
		}
		return this;
	},

	/**
	 * hideCategory
	 *
	 * @param string categoryId
	 * @return GoogleMapsPHP.MapBuilder
	 */
	hideCategory: function( categoryId ) {
		this.hiddenCategories[categoryId] = true;
		for ( var id in this.plugIns ) {
			if ( typeof this.plugIns[id].getCategoryId == 'function' && typeof this.plugIns[id].hide == 'function' && this.plugIns[id].getCategoryId() == categoryId ) {
				this.plugIns[id].hide();
			}
		}
		return this;
	},

	/**
	 * isCategoryHidden
	 *
	 * @return boolean
	 */
	isCategoryHidden: function( categoryId ) {
		return ( this.hiddenCategories[categoryId] === true );
	},

	/**
	 * open
	 *
	 * @param string [id]
	 * @return GoogleMapsPHP.MapBuilder
	 */
	open: function( id ) {
		if ( typeof id == 'undefined' ) {
			for ( var id in this.plugIns ) {
				if ( typeof this.plugIns[id].open == 'function' ) {
					this.plugIns[id].open();
				}
			}
		} else {
			if ( this.plugIns.hasOwnProperty( id ) && typeof this.plugIns[id].open == 'function' ) {
				this.plugIns[id].open();
			}
		}
		return this;
	},

	/**
	 * close
	 *
	 * @param string [id]
	 * @param boolean [checkKeepOpen]
	 * @return GoogleMapsPHP.MapBuilder
	 */
	close: function( id, checkKeepOpen ) {
		if ( typeof id == 'undefined' ) {
			checkKeepOpen = false;
		} else if ( id === false || id === true ) {
			checkKeepOpen = id;
			id = undefined;
		}
		if ( typeof id == 'undefined' ) {
			for ( var id in this.plugIns ) {
				if ( typeof this.plugIns[id].close == 'function' ) {
					this.plugIns[id].close( checkKeepOpen );
				}
			}
		} else {
			if ( this.plugIns.hasOwnProperty( id ) && typeof this.plugIns[id].close == 'function' ) {
				this.plugIns[id].close( checkKeepOpen );
			}
		}
		return this;
	},

	/**
	 * detach
	 *
	 * @param string [id]
	 * @return GoogleMapsPHP.MapBuilder
	 */
	detach: function( id ) {
		if ( typeof id == 'undefined' ) {
			for ( var id in this.plugIns ) {
				if ( typeof this.plugIns[id].detach == 'function' ) {
					this.plugIns[id].detach();
					delete this.plugIns[id];
				}
			}
		} else {
			if ( this.plugIns.hasOwnProperty( id ) && typeof this.plugIns[id].detach == 'function' ) {
				this.plugIns[id].detach();
				delete this.plugIns[id];
			}
		}
		return this;
	},

	/**
	 * makeLatLng
	 *
	 * @param object options
	 * @return google.maps.LatLng
	 */
	makeLatLng: function( options ) {
		return new google.maps.LatLng(
			options.latitude,
			options.longitude,
			options.noWrap || false
		);
	},

	/**
	 * getMapBoundsWithOffset
	 *
	 * @param float viewportOffset
	 * @return google.maps.LatLngBounds
	 */
	getMapBoundsWithOffset: function( viewportOffset ) {
		return new google.maps.LatLngBounds(
			new google.maps.LatLng(
				this.getMap().getBounds().getSouthWest().lat() - viewportOffset,
				this.getMap().getBounds().getSouthWest().lng() - viewportOffset
			),
			new google.maps.LatLng(
				this.getMap().getBounds().getNorthEast().lat() + viewportOffset,
				this.getMap().getBounds().getNorthEast().lng() + viewportOffset
			)
		);
	},

	/**
	 * setMap
	 *
	 * @param google.maps.Map map
	 * @return GoogleMapsPHP.MapBuilder
	 */
	setMap: function( map ) {
		this.map = map;
		return this;
	},

	/**
	 * getMap
	 *
	 * @return google.maps.Map
	 */
	getMap: function() {
		return this.map;
	},

	/**
	 * getMapId
	 *
	 * @return string
	 */
	getMapId: function() {
		return this.getMap().getDiv().id;
	},

	/**
	 * getPlugIns
	 *
	 * @return object
	 */
	getPlugIns: function(){
		return this.plugIns;
	},

	/**
	 * findPlugInById
	 *
	 * @param object options
	 * @return object
	 */
	findPlugInById: function( id ) {
		return ( this.plugIns.hasOwnProperty( id ) ? this.plugIns[id] : null );
	},

	/**
	 * getHiddenCategories
	 *
	 * @return object
	 */
	getHiddenCategories: function() {
		return this.hiddenCategories;
	}
});

GoogleMapsPHP.PlugIns = {};

GoogleMapsPHP.PlugIns.AbstractPlugIn = Class.extend({

	/**
	 * initialize
	 *
	 * @param object settings
	 * @param object mapBuilder
	 * @return void
	 */
	initialize: function( settings, mapBuilder ) {
		this.listeners = {};
		this.id = settings.id;
		this.object = null;
		this.mapBuilder = mapBuilder;
	},

	/**
	 * addEventListener
	 *
	 * @param string message
	 * @param function listener
	 * @return void
	 */
	addEventListener: function( type, listener ) {
		if ( typeof this.listeners[type] == 'undefined' ) {
			this.listeners[type] = [];
		}
		this.listeners[type].unshift(listener);
	},

	/**
	 * removeListener
	 *
	 * @param string message
	 * @param function listener
	 * @return void
	 */
	removeListener: function( type, listener ) {
		if ( this.listeners[type] instanceof Array ) {
			var i = this.listeners[type].length;
			while ( i-- ) {
				if ( this.listeners[type][i] === listener ) {
					this.listeners[type].splice( i, 1 );
					break;
				}
			}
		}
	},

	/**
	 * fireEvent
	 *
	 * @param string|object event
	 * @return void
	 */
	fireEvent: function( event ) {

		if ( typeof event == 'string' ) {
			event = { type: event };
		}

		if ( !event.target ) {
			event.target = this;
		}

		if ( !event.type ) {
			GoogleMapsPHP.Utility.log( "Event object missing 'type' property." );
			return;
		}

		if ( this.listeners[event.type] instanceof Array ) {
			var i = this.listeners[event.type].length;
			while ( i-- ) {
				this.listeners[event.type][i].call( event.target, event );
			}
		}
	},

	/**
	 * create
	 *
	 * @return GoogleMapsPHP.PlugIns.AbstractPlugIn
	 */
	create: function() {},

	/**
	 * getId
	 *
	 * @return string
	 */
	getId: function() {
		return this.id;
	},

	/**
	 * getObject
	 *
	 * @return string
	 */
	getObject: function() {
		return this.object;
	},

	/**
	 * getMapBuilder
	 *
	 * @return object
	 */
	getMapBuilder: function() {
		return this.mapBuilder;
	},

	/**
	 * getMap
	 *
	 * @return object
	 */
	getMap: function() {
		return this.getMapBuilder().getMap();
	}
});