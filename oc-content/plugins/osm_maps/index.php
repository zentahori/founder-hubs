<?php
/*
Plugin Name: OpenStreetMap Maps
Plugin URI: http://www.osclass.org/
Description: This plugin shows an OpenStreetMap on the location space of every item.
Version: 1.0.2
Author: Oleksiy Muzalyev
Author URI: http://forums.osclass.org/index.php?action=profile;u=37193
Plugin update URI: openstreetmaps-maps_2
*/

	function osm_maps_location() {
		
		$item = osc_item();
		
		osc_osm_maps_header();
		
		require 'map.php';
		
	}

	// HELPER
	function osc_osm_maps_header() {
		
		echo '<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />',
		 
		     '<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>',
			
		     '<style> #map { height: 240px; width: 100%;}</style>';
			 
	}

	function osm_insert_geo_location ( $item ) {
		
		$itemId = $item['pk_i_id'];
		
		$aItem = Item::newInstance()->findByPrimaryKey ( $itemId );
		
		$address = '';
		
		$addr_comp =  array();
		
		if ( isset ( $aItem['s_address'] ) ) {
			
			$addr_comp[] = $aItem['s_address'];
			
		} 
		
		if ( isset ( $aItem['s_city'] ) ) {
			
			$addr_comp[] = $aItem['s_city'];
			
		} 
		
		if ( isset ( $aItem['s_region'] ) )  {
			
			$addr_comp[] = $aItem['s_region'];
			
		} 
		
		if ( isset ( $aItem['s_country'] ) ) {
			
			$addr_comp[] = $aItem['s_country'];
			
		}
			
		$address = implode ( ',', $addr_comp );
				
		
		if ( $xml = simplexml_load_file ( sprintf ( 'http://open.mapquestapi.com/nominatim/v1/search.php?q=%s&format=xml&addressdetails=1&limit=1', $address ) ) ) {
				
			foreach ( $xml->place as $mpl ) {
		
				$lat = $mpl['lat'];
				
				$lng = $mpl['lon'];
			
			}

			ItemLocation::newInstance()->update ( array ( 'd_coord_lat' => $lat ,'d_coord_long' => $lng ) , array('fk_i_item_id' => $itemId ) );
		
		}
		
	}

	osc_add_hook('location', 'osm_maps_location');

	osc_add_hook('posted_item', 'osm_insert_geo_location');
	osc_add_hook('edited_item', 'osm_insert_geo_location');
	
	osc_register_plugin(osc_plugin_path(__FILE__), '') ;

?>
