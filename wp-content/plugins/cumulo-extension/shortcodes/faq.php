<?php
class WPBakeryShortCode_cmo_faq extends WPBakeryShortCodesContainer {

	function content( $atts, $content = null ) {
		extract ( shortcode_atts ( array (
				'el_class' => ''
		), $atts ) );

		$css_class = "cmo-faq";
		$css_class .= $this->getExtraClass( $el_class );

		$id = uniqid( "cmo-faq-" );

		global $cmo_faq_id;
		global $cmo_faq_titles;

		$cmo_faq_id = $id;
		$cmo_faq_titles = array();

		$output = '';
		$output .= '<div id="' . esc_attr( $id ) . '" class="' . esc_attr( $css_class ) . '">';

		$innercontent = do_shortcode( $content );
			$output .= '<div class="cmo-faq-titles">';
			foreach( $cmo_faq_titles as $faq_item ) {
				$output .= '<a href="#' . esc_attr( $faq_item["id"] ) . '" class="cmo-faq-link">' . $faq_item['title'] . '</a>';
			}
			$output .= "</div>";

			$output .= '<div class="cmo-faq-items-wrapper">';
				$output .= $innercontent;
			$output .= '</div>';
		$output .= "</div>\n";

		unset( $cmo_faq_titles );
		unset( $cmo_faq_id );

		return $output;
	}
}

vc_map ( 
	array (
		"name" => __( "FAQ", 'cumulo_plugin' ),
		"base" => "cmo_faq",
		"category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
		"icon" => plugins_url( '/assets/images/icon_faq.png', dirname( __FILE__ ) ),
		"as_parent" => array( 'only' => 'cmo_faq_item' ),
		"content_element" => true,
		"js_view" => 'VcColumnView',
		"show_settings_on_create" => false,
		"params" => array (
				extra_class()
		)
	)
);
