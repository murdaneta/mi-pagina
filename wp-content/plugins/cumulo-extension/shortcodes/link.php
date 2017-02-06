<?php

/* Simple Shortcodes */

if( !function_exists( 'cmo_link_handler') ) {
	function cmo_link_handler( $atts, $content = null ) {
		$args = array (
				"icon"		=> "fa-angle-double-right",
				"href" 		=> "",
				"target" 	=> "",
				"top"		=> 0
		);
		extract( shortcode_atts( $args, $atts ) );

		$output = '';
		if ( !empty($content) ) {
			$output = "<div class=\"cmosc-link\"";
			if ( !empty($top) ) $output .= " style=\"margin-top: {$top}px;\"";

			$output .= "><a";

			if ( !empty($href) ) $output .= " href=\"$href\"";
			if ( !empty($target) ) $output .= " target=\"$target\"";

			$output .= "><i class=\"fa {$icon}\"></i>{$content}</a></div>";
		}

		return $output;
	}
	add_shortcode( 'cmo_link', 'cmo_link_handler' );
}