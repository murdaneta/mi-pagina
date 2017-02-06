<?php
class WPBakeryShortCode_cmo_google_map extends WPBakeryShortCode {

	function content( $atts, $content = null ) {
		// wp_enqueue_script("googleapis-map-custom", plugins_url( 'cumulo-extension/assets/js/map.js' ));
		wp_register_script("googleapis","https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false","1.0",array(),false);
		wp_enqueue_script('googleapis');

		// wp_enqueue_style('ultimate-maps',plugins_url('../assets/css/',__FILE__).'maps.css');

		$width = $height = $map_type = $lat = $lng = $zoom = $streetviewcontrol = $maptypecontrol = $top_margin = $pancontrol = $zoomcontrol = $zoomcontrolsize = $marker_icon = $icon_img = $map_override = $output = $map_style = $scrollwheel = $el_class = '';
		
		extract(shortcode_atts(array(
				//"id" => "map",
				"width" => "100%",
				"height" => "300px",
				"map_type" => "ROADMAP",
				"lat" => "-33.86749",
				"lng" => "151.20699",
				"zoom" => "18",
				"scrollwheel" => "enable",
				"streetviewcontrol" => "false",
				"maptypecontrol" => "false",
				"pancontrol" => "false",
				"zoomcontrol" => "false",
				"zoomcontrolsize" => "small",
				"marker_icon" => "default",
				"icon_img" => "",
				"top_margin" => "page_margin_top",
				"map_override" => "0",
				"map_style" => "",
				"el_class" => "",
		), $atts));
		
		$css_class = "cmo-map-wrapper";
		$css_class .= $this->getExtraClass( $el_class );
		
		$marker_lat = $lat;
		$marker_lng = $lng;

		if( $marker_icon == "default" ) {
			$icon_url = "";
		} else {
			$ico_img = wp_get_attachment_image_src( $icon_img, 'large');
			$icon_url = $ico_img[0];
		}
		
		$id = "map_".uniqid();
		$wrap_id = "wrap_".$id;
		
		$map_type = strtoupper($map_type);
		$width = (substr($width, -1)!="%" && substr($width, -2)!="px" ? $width . "px" : $width);
		$map_height = (substr($height, -1)!="%" && substr($height, -2)!="px" ? $height . "px" : $height);
		$output .= "<div id='".$wrap_id."' class='".$css_class."' style='".($map_height!="" ? "height:" . $map_height . ";" : "")."'><div id='" . $id . "' data-map_override='".$map_override."' class='cmo_google_map wpb_content_element'" . ($width!="" || $map_height!="" ? " style='" . ($width!="" ? "width:" . $width . ";" : "") . ($map_height!="" ? "height:" . $map_height . ";" : "") . "'" : "") . "></div></div>";
		if($scrollwheel == "disable"){
			$scrollwheel = 'false';
		} else {
			$scrollwheel = 'true';
		}
		$output .= "<script type='text/javascript'>
(function($) {
	'use strict';
	var map_$id = null;
	var coordinate_$id;

	jQuery(document).ready(function($){
		try
		{
			// var map_$id = null;
			// var coordinate_$id;
			coordinate_$id=new google.maps.LatLng($lat, $lng);
	
			var mapOptions=
			{
				zoom: $zoom,
				center: coordinate_$id,
				scaleControl: true,
				streetViewControl: $streetviewcontrol,
				mapTypeControl: $maptypecontrol,
				panControl: $pancontrol,
				zoomControl: $zoomcontrol,
				scrollwheel: $scrollwheel,
				zoomControlOptions: {
					style: google.maps.ZoomControlStyle.$zoomcontrolsize
				},";
	
			if($map_style == ""){
				$output .= "mapTypeId: google.maps.MapTypeId.$map_type,";
			} else {
				$output .= " mapTypeControlOptions: {
					mapTypeIds: [google.maps.MapTypeId.$map_type, 'map_style']
				}";
			}
			$output .= "};";
			if($map_style !== "") {
				$output .= '
				var styles = '.rawurldecode(base64_decode(strip_tags($map_style))).';
				var styledMap = new google.maps.StyledMapType(styles,
				   	{name: "Styled Map"});
				';
			}
			
			$output .= "map_$id = new google.maps.Map(document.getElementById('$id'),mapOptions);";
			if ( $map_style !== "" ) {
				$output .= "map_$id.mapTypes.set('map_style', styledMap);
							map_$id.setMapTypeId('map_style');";
			}
			
			if ( $marker_lat!="" && $marker_lng!="" )
			{
				$output .= "
				marker_$id = new google.maps.Marker({
					position: new google.maps.LatLng($marker_lat, $marker_lng),
					animation:  google.maps.Animation.DROP,
					map: map_$id,
					icon: '".$icon_url."'
				});
				google.maps.event.addListener(marker_$id, 'click', toggleBounce);";
					if($content !== ""){
						$output .= "
						var infowindow = new google.maps.InfoWindow();
						infowindow.setContent('<div class=\"map_info_text\" style=\'color:#000;\'>".trim(preg_replace('/\s+/', ' ', do_shortcode($content)))."</div>');
						infowindow.open(map_$id,marker_$id);";
					}
				}
				$output .= "
				}
		catch(e){};

		// resize_uvc_map('".$id."','".$wrap_id."');
		google.maps.event.trigger(map_$id, 'resize');
		$(window).resize(function(){
			// resize_uvc_map('".$id."','".$wrap_id."');
			google.maps.event.trigger(map_$id, 'resize');
			if(map_$id!=null)
			map_$id.setCenter(coordinate_$id);
		});
	});
	/* jQuery(window).load(function($){
			google.maps.event.trigger(map_$id, 'resize');
			if(map_$id!=null)
			map_$id.setCenter(coordinate_$id);
	}); */
	
	function toggleBounce() {
		if (marker_$id.getAnimation() != null) {
			marker_$id.setAnimation(null);
		} else {
			marker_$id.setAnimation(google.maps.Animation.BOUNCE);
		}
	}
})(jQuery);
	</script>";
		return $output;
	}
}

vc_map( array(
	"name" => __("Google Map", "cumulo"),
	"base" => "cmo_google_map",
	"class" => "vc_google_map",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => plugins_url( '/assets/images/icon_googlemap.png', dirname( __FILE__ ) ),
	"description" => __("Display Google Maps.", "cumulo"),
	"category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
	
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Width (in %)", "cumulo"),
			"param_name" => "width",
			"admin_label" => true,
			"value" => "100%",
			"group" => "General Settings"
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Height (in px)", "cumulo"),
			"param_name" => "height",
			"admin_label" => true,
			"value" => "300px",
			"group" => "General Settings"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Map type", "cumulo"),
			"param_name" => "map_type",
			"admin_label" => true,
			"value" => array(__("Roadmap", "cumulo") => "ROADMAP", __("Satellite", "cumulo") => "SATELLITE", __("Hybrid", "cumulo") => "HYBRID", __("Terrain", "cumulo") => "TERRAIN"),
			"group" => "General Settings"
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Latitude", "cumulo"),
			"param_name" => "lat",
			"admin_label" => true,
			"value" => "-33.86749",
			"description" => __('<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">Here is a tool</a> where you can find Latitude & Longitude of your location', "cumulo"),
			"group" => "General Settings"
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Longitude", "cumulo"),
			"param_name" => "lng",
			"admin_label" => true,
			"value" => "151.20699",
			"description" => __('<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">Here is a tool</a> where you can find Latitude & Longitude of your location', "cumulo"),
			"group" => "General Settings"
		),
		array(
			"type" => "dropdown",
			"heading" => __("Map Zoom", "cumulo"),
			"param_name" => "zoom",
			"value" => array(
				__("18 - Default", "cumulo") => 12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20
			),
			"group" => "General Settings"
		),
		array(
			"type" => "checkbox",
			"heading" => __("", "cumulo"),
			"param_name" => "scrollwheel",
			"value" => array(
				__("Disable map zoom on mouse wheel scroll", "cumulo") => "disable",
			),
			"group" => "General Settings"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Street view control", "cumulo"),
			"param_name" => "streetviewcontrol",
			"value" => array(__("Disable", "cumulo") => "false", __("Enable", "cumulo") => "true"),
			"group" => "General Settings"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Map type control", "cumulo"),
			"param_name" => "maptypecontrol",
			"value" => array(__("Disable", "cumulo") => "false", __("Enable", "cumulo") => "true"),
			"group" => "General Settings"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Map pan control", "cumulo"),
			"param_name" => "pancontrol",
			"value" => array(__("Disable", "cumulo") => "false", __("Enable", "cumulo") => "true"),
			"group" => "General Settings"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Zoom control", "cumulo"),
			"param_name" => "zoomcontrol",
			"value" => array(__("Disable", "cumulo") => "false", __("Enable", "cumulo") => "true"),
			"group" => "General Settings"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Zoom control size", "cumulo"),
			"param_name" => "zoomcontrolsize",
			"value" => array(__("Small", "cumulo") => "SMALL", __("Large", "cumulo") => "LARGE"),
			"dependency" => Array("element" => "zoomControl","value" => array("true")),
			"group" => "General Settings"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Marker/Point icon", "cumulo"),
			"param_name" => "marker_icon",
			"value" => array(__("Use Google Default", "cumulo") => "default", __("Upload Custom", "cumulo") => "custom"),
			"group" => "General Settings"
		),
		array(
			"type" => "attach_image",
			"class" => "",
			"heading" => __("Upload Image Icon:", "cumulo"),
			"param_name" => "icon_img",
			"admin_label" => true,
			"value" => "",
			"description" => __("Upload the custom image icon.", "cumulo"),
			"dependency" => Array("element" => "marker_icon","value" => array("custom")),
			"group" => "General Settings"
		),
		/* array(
			"type" => "textarea_html",
			"class" => "",
			"heading" => __("Info Window Text", "cumulo"),
			"param_name" => "content",
			"value" => "",
			"group" => "General Settings"
		),
		
		array(
			"type" => "textarea_raw_html",
			"class" => "",
			"heading" => "Google Styled Map JSON",
			"param_name" => "map_style",
			"value" => "",
			"description" => __("<a target='_blank' href='http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html'>Click here</a> to get the style JSON code for styling your map."),
			"group" => "Styling",
		), */

		css_animation_class(),
		extra_class(),
	)
));