<?php
/* Simple Shortcodes */
if( !function_exists( 'cmo_restaurant_menu_item_handler') ) {
	function cmo_restaurant_menu_item_handler( $atts, $content = null ) {
		$args = array (
				"title"	=> "",
				"price"	=> ""
		);
		extract( shortcode_atts( $args, $atts ) );

		$output = '<div class="cmosc-restaurant-menu-item">';
		$output .= "<div class=\"cmosc-restaurant-menu clearfix\"><span class=\"cmosc-restaurant-menu-item-title\">$title</span>";
		$output .= '<span class="cmosc-restaurant-menu-item-separator"></span>';
		$output .= "<span class=\"cmosc-restaurant-menu-item-price\">$price</span></div>";
		$output .= "<div class=\"cmosc-restaurant-menu-item-desc\">$content</div>";
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'cmo_restaurant_menu_item', 'cmo_restaurant_menu_item_handler' );
}