<?php

class WPBakeryShortCode_cmo_dropcap extends WPBakeryShortCode {
    function content($atts, $content = null) {
        extract ( shortcode_atts ( array (
            "dropcap_text_color" => "",
            "dropcap_bg_color" => "",
            "content_color" => "",
            'css_animation' => '',
            'el_class' => '',
        ), $atts ) );

        $css_class = "cmo-dropcap wpb_content_element";
        $css_class .= get_css_animation( $css_animation );
        $css_class .= $this->getExtraClass ( $el_class );

        $css_style = '';
        $id = shortcode_unique_id( "cmo-dropcap" );
        $css_gen = new CUMULO_CSS_Generator( "cmo-dropcap", $id );

        if( $dropcap_bg_color != '' ) {
            $css_style .= $css_gen->css_with_self_condition( ":first-letter", "", array( 'background-color' => $dropcap_bg_color ) );
        }
        if( $dropcap_text_color != '' ) {
            $css_style .= $css_gen->css_with_self_condition( ":first-letter", "", array( 'color' => $dropcap_text_color ) );
        }
        if( $content_color != '' ) {
            $css_style .= $css_gen->css( "", array( 'color' => $content_color ) );
        }
        $output = '';
        $output .= "<div class='{$css_class}' id='{$id}'>";
        if( $css_style != '' ) {
            $output .= "<style scoped>{$css_style}</style>";
        }
        $output .= "{$content}";

        $output .= "</div>\n";
        return $output;
    }
}

vc_map ( array (
    "name" => __ ( "Dropcap", 'cumulo_plugin' ),
    "base" => "cmo_dropcap",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_dropcap.png', dirname( __FILE__ ) ),
    "params" => array (
        array (
            "type" => "textarea_html",
            "heading" => __ ( "Content", 'cumulo_plugin' ),
            "param_name" => "content",
            "value" => __ ( "This is content text. You can put any text here.", 'cumulo_plugin' ),
        ),
        css_animation_class(),
        extra_class (),
        array (
            "type" => "colorpicker",
            "heading" => __ ( "Dropcap Background Color", 'cumulo_plugin' ),
            "param_name" => "dropcap_bg_color",
            "value" => '',
            "admin_label" => true,
            'description' => __( 'Leave empty to use the primary color.', 'cumulo_plugin' ),
            'group' => __( 'Colors', 'cumulo_plugin' ),
        ),
        array (
            "type" => "colorpicker",
            "heading" => __ ( "Dropcap Text Color", 'cumulo_plugin' ),
            "param_name" => "dropcap_text_color",
            "value" => '',
            "admin_label" => true,
            'description' => __( 'Leave empty to use the default color.', 'cumulo_plugin' ),
            'group' => __( 'Colors', 'cumulo_plugin' ),
        ),
        array (
            "type" => "colorpicker",
            "heading" => __ ( "Content Color", 'cumulo_plugin' ),
            "param_name" => "content_color",
            "value" => '',
            "admin_label" => true,
            'description' => __( 'Leave empty to use the default color.', 'cumulo_plugin' ),
            'group' => __( 'Colors', 'cumulo_plugin' ),
        ),
    )
) );