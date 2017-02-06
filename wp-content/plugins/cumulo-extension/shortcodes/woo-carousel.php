<?php

class WPBakeryShortCode_cmo_woo_carousel extends WPBakeryShortCodesContainer {
	
	function content( $atts, $content = null ) {
		extract ( shortcode_atts ( array (
				'el_class' => ''
		), $atts ) );

		$content = wpb_js_remove_wpautop( $content, true );

		$css_class = "cmosc-woo-carousel";
		$css_class .= $this->getExtraClass( $el_class );

		$output = '';
		$output .= "<div class=\"{$css_class}\">\n";
		if ( !empty($title) ) {
            $output .= "<h2 class=\"cmosc-woo-carousel-title\">{$title}</h2>";
		}
		$output .= do_shortcode( $content );
		$output .= "</div>\n";

		return $output;
	}
}

vc_map ( 
	array (
		"name" => __( "Woo Carousel", 'cumulo_plugin' ),
		"base" => "cmo_woo_carousel",
		"category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
		"icon" => plugins_url( '/assets/images/icon_woocarousel.png', dirname( __FILE__ ) ),
		"as_parent" => array( 'only' => 'featured_products, products, product_category, best_selling_products, top_rated_products, recent_products, sale_products, product_attribute' ),
		"content_element" => true,
		"js_view" => 'VcColumnView',
		"show_settings_on_create" => true,
		"params" => array (
				extra_class()
		)
	)
);
