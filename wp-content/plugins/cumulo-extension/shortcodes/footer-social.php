<?php
if( !function_exists( 'cmo_footer_social_handler') ) {
	function cmo_footer_social_handler( $atts, $content = null ) {
		$html = "<ul class=\"cmo-footer-social\">";

		$social_links = array( "twitter", "linkedin-square", "facebook-square", "skype", "google-plus", "dribbble", "pinterest", "apple", "instagram", "youtube", "vimeo-square", "rss" );
		foreach($social_links as $social_link) {
			$val = cmo_get_theme_mod_value("footer-social-" . $social_link);

			if ( !empty($val) ) { 
				$html .= "<li><a href=\"{$val}\" class=\"social-{$social_link}\"><i class=\"fa fa-{$social_link}\"></i></a></li>";
			}
		}
		$html .= "</ul>";

		return $html;
	}

	add_shortcode( 'cmo_footer_social', 'cmo_footer_social_handler' );
}