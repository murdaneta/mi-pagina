<?php

class WPBakeryShortCode_cmo_section_header extends WPBakeryShortCode {
	function content($atts, $content = null) {

		extract ( shortcode_atts ( array (
            'heading' => 'Heading here',
            'heading_tag' => 'h2',
            'header_text' => '',
            'text_alignment' => 'text-center',
            'separator_style' => '',
            'color' => '',
            'css_animation' => '',
            'el_class' => '',
		), $atts ) );

        $heading_tag = empty($heading_tag) ? 'h2' : $heading_tag;

		$css_class = "cmo-section-header wpb_content_element clearfix";
        $css_class .= " " . $text_alignment;
        $css_class .= " " . $separator_style;
		$css_class .= get_css_animation( $css_animation );
		$css_class .= $this->getExtraClass ( $el_class );

		$id = shortcode_unique_id( "cmo-section-header" );
        $css_style = '';
        $css_gen = new CUMULO_CSS_Generator( "cmo-section-header", $id );
        if( $color != '' ) {
            $css_style .= $css_gen->css( ".heading", array( 'color' => $color ) );
            $css_style .= $css_gen->css( ".separator", array( 'border-color' => $color ) );
            $css_style .= $css_gen->css( ".separator:before", array( 'background-color' => $color ) );
            $css_style .= $css_gen->css( ".separator:after", array( 'background-color' => $color ) );
            $css_style .= $css_gen->css( ".header-text", array( 'color' => $color ) );
            
            if ( $separator_style == 'separator-weightlifting') {
            	$css_style .= $css_gen->css( ".separator .small-cir", array( 'border-color' => $color ) );
            	$css_style .= $css_gen->css( ".separator .large-cir", array( 'border-color' => $color ) );
            	$css_style .= $css_gen->css( ".separator .bar", array( 'background-color' => $color ) );
            }
        }

        $output = '';
        $output .= "<div class=\"{$css_class}\" id='{$id}'>\n";
        if( $css_style != '' ) {
            $output .= "<style scoped>{$css_style}</style>";
        }
		$output .= "<" . $heading_tag . " class='heading'>{$heading}</" . $heading_tag . ">";
        $output .= "<div class='separator'>";

        if ( $separator_style == 'separator-weightlifting') {
        	$output .= "<span class='small-cir left'></span><span class='large-cir left'></span><span class='bar'></span><span class='large-cir right'></span><span class='small-cir right'></span>";
        }

        $output .= "</div>";
		$output .= "<p class='header-text' >{$header_text}</p>";
		$output .= "</div>\n";

		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "Section Header", 'cumulo_plugin' ),
    "base" => "cmo_section_header",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_sectionheader.png', dirname( __FILE__ ) ),
    "params" => array (
        array (
            "type" => "textfield",
            "heading" => __ ( "Heading", 'cumulo_plugin' ),
            "param_name" => "heading",
            "value" => __ ( "Heading here", 'cumulo_plugin' ),
            "admin_label" => true
        ),
        array (
            "type" => "dropdown",
            "heading" => __ ( "Heading Tag", 'cumulo_plugin' ),
            "param_name" => "heading_tag",
            "value" => array (
                __ ( "Default (H2)", 'cumulo_plugin' ) => '',
                __ ( "H1", 'cumulo_plugin' ) => 'h1',
                __ ( "H2", 'cumulo_plugin' ) => 'h2',
                __ ( "H3", 'cumulo_plugin' ) => 'h3',
                __ ( "H4", 'cumulo_plugin' ) => 'h4',
                __ ( "H5", 'cumulo_plugin' ) => 'h5',
                __ ( "H6", 'cumulo_plugin' ) => 'h6',
            )
        ),
        array (
            "type" => "dropdown",
            "heading" => __ ( "Separator Style", 'cumulo_plugin' ),
            "param_name" => "separator_style",
            "value" => array (
                __ ( "Default", 'cumulo_plugin' ) => '',
                __ ( "Weight Lifting", 'cumulo_plugin' ) => 'separator-weightlifting',
                __ ( "None", 'cumulo_plugin' ) => 'separator-none'
            )
        ),
        array (
            "type" => "textarea",
            "heading" => __ ( "Section Header Text", 'cumulo_plugin' ),
            "param_name" => "header_text",
            "value" => ''
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Alignment', 'cumulo_plugin' ),
            'param_name' => 'text_alignment',
            'value' => array(
                __( "Center", 'cumulo_plugin' ) => 'text-center',
                __( "Left", 'cumulo_plugin' ) => 'text-left',
                __( "Right", 'cumulo_plugin' ) => 'text-right',
            )
        ),
        css_animation_class(),
        extra_class (),
        array(
            'type' => 'colorpicker',
            'heading' => 'Color',
            'param_name' => 'color',
            'value' => '',
            'description' => __( 'Leave blank to use theme\'s default.', 'cumulo_plugin' ),
            'group' => __( 'Colors', 'cumulo_plugin' )
        ),
    )
) );
