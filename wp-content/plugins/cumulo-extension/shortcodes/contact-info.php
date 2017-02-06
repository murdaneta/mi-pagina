<?php
/* Simple Shortcodes */
if( !function_exists( 'cmo_contact_info_handler') ) {
	function cmo_contact_info_handler( $atts, $content = null ) {
		$args = array (
				"type"	=> "",
				"icon"	=> ""
		);
		extract( shortcode_atts( $args, $atts ) );

		if ( empty($type) ) return "";
		if ( empty($content) ) $content = cmo_get_theme_mod_value( "footer-extra-{$type}" );
		if ( empty($icon) ) {
			if ( $type == 'phone' ) $icon = "fa fa-fw fa-phone";
			else if ( $type == 'email' ) $icon = "fa fa-fw fa-envelope-o";
			else if ( $type == 'address' ) $icon = "fa fa-fw fa-map-marker";
		}

		$content = str_replace( "\n", "<span class='cmosc-contact-info-separator'></span>", $content );
		$content = str_replace( "|", "<span class='cmosc-contact-info-separator'></span>", $content );

		$output = "";
		if ( !empty($content) ) {
			$output = '<div class="cmosc-contact-info">';
			$output .= "<i class=\"" . esc_attr( $icon ) . "\"></i>";
			$output .= "<div>" . $content . "</div>";
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode( 'cmo_contact_info', 'cmo_contact_info_handler' );
}