<?php
/**
 * Typing Emulation Shortcode 
 *
 * Usage
 * [cmo_typing texts="Deve^500loper|Designer|Entertainer|Lover" delay="1000" loop="true|false"]
 * ^500 : wait for 500ms
 * default for delay is 1000
*/
if( !function_exists( 'cmo_typing_handler') ) {
	function cmo_typing_handler( $atts, $content = null ) {
		$args = array (
				"texts"		=>	"",
				"delay"	=>	"1000",
				"loop"		=>	"true"
		);

		extract( shortcode_atts( $args, $atts ) );

		$output = '<span class="cmo-typing" ';
		$textarr = array_filter( explode( "|", $texts ) );

		if ( count( textarr ) == 0 ) 
			return "";

		$prop = esc_attr( "['" . implode( "','", $textarr ) . "']" );
		$loop = esc_attr( $loop );
		$delay = esc_attr( $delay );

		$output .= "data-texts=\"$prop\" data-delay=\"$delay\" data-loop=\"$loop\">";
		$output .= "</span>";

		return $output;
	}

	add_shortcode( 'cmo_typing', 'cmo_typing_handler' );
}