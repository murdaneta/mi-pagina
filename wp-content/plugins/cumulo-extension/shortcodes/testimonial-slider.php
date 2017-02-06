<?php

class WPBakeryShortCode_cmo_testimonial_slider extends WPBakeryShortCodesContainer {
	function content( $atts, $content = null ) {
		extract ( shortcode_atts ( array (
            'text_alignment' => '',
            'padding' => '',
            'name_color' => '',
            'position_color' => '',
            'testimonial_color' => '',
            'testimonial_font_size' => '',
            'testimonial_font_style' => '',
            'pagination' => '',
            'pagination_color' => '',
            'navigation' => '',
            'navigation_color' => '',
            'el_class' => ''
		), $atts ) );

        $css_style = '';
        $id = shortcode_unique_id( "cmo-testimonial-slider" );
        $css_gen = new CUMULO_CSS_Generator( "cmo-testimonial-slider", $id );
        if( $name_color != '' ) {
            $css_style .= $css_gen->css( ".name", array( 'color' => $name_color ) );
        }
        if( $padding != '' ) {
            $css_style .= $css_gen->css( ".cmo-testimonial-items", array( 'padding-left' => $padding . 'px' ) );
            $css_style .= $css_gen->css( ".cmo-testimonial-items", array( 'padding-right' => $padding . 'px' ) );
        }
        if( $position_color != '' ) {
            $css_style .= $css_gen->css( ".position", array( 'color' => $position_color ) );
        }
        if( $testimonial_color != '' ) {
            $css_style .= $css_gen->css( ".testimonial", array( 'color' => $testimonial_color ) );
        }
        if( $testimonial_font_size != '' ) {
            $css_style .= $css_gen->css( ".testimonial", array( 'font-size' => $testimonial_font_size . 'px' ) );
        }
        if( $testimonial_font_style != '' ) {
            $css_style .= $css_gen->css( ".testimonial", array( 'font-style' => $testimonial_font_style ) );
        }
        if( $navigation_color != '' ) {
            $css_style .= $css_gen->css( ".owl-controls .owl-buttons div", array( 'color' => $navigation_color ) );
        }
        if( $pagination_color != '' ) {
            $css_style .= $css_gen->css( ".owl-controls .owl-pagination .owl-page span", array( 'background-color' => $pagination_color ) );
        }

        $content = wpb_js_remove_wpautop( $content, true );

        $css_class = "cmo-testimonial-slider wpb_content_element clearfix ";
        $css_class .= " " . $text_alignment;
        $css_class .= " " . $pagination;
        $css_class .= " " . $navigation;
        $css_class .= $this->getExtraClass( $el_class );

        $output = '';
        $output .= "<div class=\"{$css_class}\" id=\"{$id}\">\n";
        if( $css_style != '' ) {
            $output .= "<style scoped>{$css_style}</style>";
        }
        $output .= "<div class='cmo-testimonial-items owl-carousel owl-theme'>\n";
        $output .= $content;
        $output .= "</div>\n";
        $output .= "</div>\n";

        return $output;
	}
}

vc_map ( 
	array (
		"name" => __( "Testimonial Slider", 'cumulo_plugin' ),
		"base" => "cmo_testimonial_slider",
		"category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
		"icon" => plugins_url( '/assets/images/icon_testimonialcarousel.png', dirname( __FILE__ ) ),
		"as_parent" => array( 'only' => 'cmo_testimonial_item' ),
		"content_element" => true,
		"js_view" => 'VcColumnView',
		"show_settings_on_create" => false,
        "params" => array (
            array(
                'type' => 'dropdown',
                'heading' => __( 'Text Alignment', 'cumulo_plugin' ),
                'value' => array(
                    __( 'Center', 'cumulo_plugin' ) => '',
                    __( 'Left', 'cumulo_plugin' ) => 'text-left',
                    __( 'Right', 'cumulo_plugin' ) => 'text-right',
                ),
                'param_name' => 'text_alignment',
            ),
            array (
                "type" => "textfield",
                "heading" => __ ( "Testimonial Font Size (px)", 'cumulo_plugin' ),
                "param_name" => "testimonial_font_size",
                "value" => '',
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Testimonial Font Style', 'cumulo_plugin' ),
                'value' => array(
                    __( 'Default', 'cumulo_plugin' ) => '',
                    __( 'Normal', 'cumulo_plugin' ) => 'normal',
                    __( 'Italic', 'cumulo_plugin' ) => 'italic',
                ),
                'param_name' => 'testimonial_font_style',
            ),
            array (
                "type" => "textfield",
                "heading" => __ ( "Padding (px)", 'cumulo_plugin' ),
                "param_name" => "padding",
                "value" => '',
                "description" => "Put the spacing on the left and right sides of the testimonial slider."
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Page controls', 'cumulo_plugin' ),
                'value' => array(
                    __( 'Show', 'cumulo_plugin' ) => 'pagination-show',
                    __( 'Hide', 'cumulo_plugin' ) => 'pagination-hide'
                ),
                'param_name' => 'pagination',
            ),

            array(
                'type' => 'dropdown',
                'heading' => __( 'Navigation controls', 'cumulo_plugin' ),
                'value' => array(
                    __( 'Show', 'cumulo_plugin' ) => 'navigation-show',
                    __( 'Hide', 'cumulo_plugin' ) => 'navigation-hide'
                ),
                'param_name' => 'navigation',
            ),

            array(
                'type' => 'colorpicker',
                'heading' => 'Name Color',
                'param_name' => 'name_color',
                'value' => '',
                'group' => __( 'Colors', 'cumulo_plugin' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => 'Position Color',
                'param_name' => 'position_color',
                'value' => '',
                'group' => __( 'Colors', 'cumulo_plugin' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => 'Testimonial Color',
                'param_name' => 'testimonial_color',
                'value' => '',
                'group' => __( 'Colors', 'cumulo_plugin' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => 'Pagination Color',
                'param_name' => 'pagination_color',
                'value' => '',
                'dependency' => array(
                    'element' => 'pagination',
                    'value' => 'pagination-show',
                ),
                'group' => __( 'Colors', 'cumulo_plugin' )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => 'Navigation Color',
                'param_name' => 'navigation_color',
                'dependency' => array(
                    'element' => 'navigation',
                    'value' => 'navigation-show',
                ),
                'value' => '',
                'group' => __( 'Colors', 'cumulo_plugin' )
            ),
            extra_class (),
        )
	)
);
