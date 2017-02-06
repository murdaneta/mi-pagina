<?php
if( !function_exists( 'cmo_footer_logo') ) {
	function cmo_footer_logo_handler( $atts, $content = null ) {
		$logo_img = cmo_get_theme_mod_value("footer-logo");

		if ( empty($logo_img ) ) 
			$logo_img = cmo_get_theme_mod_value( "header-logo" );

		if ( empty ($logo_img ) ) 
			$logo_img = cmo_get_absolute_url( "assets/images/logo-light.png" );

		if ( !empty($logo_img) )
			$html = "<img src=\"{$logo_img}\" alt=\"Footer Logo\" />";
		else 
			$html = "";

		return $html;
	}
	
	add_shortcode( 'cmo_footer_logo', 'cmo_footer_logo_handler' );
}