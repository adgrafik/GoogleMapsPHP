
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

GoogleMapsPHP.PlugIns.Rectangle = GoogleMapsPHP.PlugIns.Shape.extend({

	/**
	 * create
	 *
	 * @return GoogleMapsPHP.PlugIns.Rectangle
	 */
	create: function() {

		this.object = new google.maps.Rectangle( this.options );

		// Set current map.
		if ( this.getMapBuilder().isCategoryHidden() === false ) {
			this.show();
		}

		return this;
	},

	/**
	 * getBounds
	 *
	 * @return google.maps.LatLngBounds
	 */
	getBounds: function() {
		return this.getObject().getBounds();
	}
});