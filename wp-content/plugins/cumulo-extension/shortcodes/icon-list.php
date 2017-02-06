<?php

class WPBakeryShortCode_cmo_icon_list extends WPBakeryShortCode {
	function content($atts, $content = null) {
		extract ( shortcode_atts ( array (
            'icon_type' => '',
            'icon_fa' => 'fa fa-star',
            'icon_etline' => 'et-line icon-lightbulb',
            'icon_linecons' => 'vc_li vc_li-heart',
            'icon_color' => '',
            'number_color' => '',
            'line_height' => '',
            'text_color' => '',
            'css_animation' => '',
            'el_class' => '',
		), $atts ) );
		
		$css_class = "cmo-icon-list wpb_content_element";
        $css_class .= " " . get_css_animation( $css_animation );
		$css_class .= $this->getExtraClass ( $el_class );

        $css_style = '';
        $id = shortcode_unique_id( "cmo-icon-list" );
        $css_gen = new CUMULO_CSS_Generator( "cmo-icon-list", $id );

        if( $text_color != '' ) {
            $css_style .= $css_gen->css( "", array( 'color' => $text_color ) );
        }
        if( $icon_color != '' ) {
            $css_style .= $css_gen->css( "li > i", array( 'color' => $icon_color ) );
        }

        if ($icon_type == 'numbering') {
            if ( $icon_color != '' ) {
                $css_style .= $css_gen->css( "li:before", array( 'background-color' => $icon_color ) );
            }
            if ( $number_color != '') {
                $css_style .= $css_gen->css( "li:before", array( 'color' => $number_color ) );
            }
        }

        if ( $line_height != '' ) {
            $css_style .= $css_gen->css( ".cmo-icon-list-item", array( 'line-height' => $line_height . 'px' ) );
        }

        $icon = selected_icon( $icon_type, $icon_fa, $icon_etline, $icon_linecons );

        $output = "<div>";
        if( $css_style != '' ) {
            $output .= "<style scoped>{$css_style}</style>";
        }
        if ( $icon_type == 'numbering' ) {
            $output .= "<ol class='ordered-list {$css_class}' id='{$id}'>";
        } else {
            $output .= "<ul class='{$css_class}' id='{$id}'>";
        }
        $items = ( !empty ( $content ) ) ? explode ( "\n", trim ( $content ) ) : array ();
		foreach( $items as $item ) {
            if ( $icon_type == 'numbering' )
			    $output .= "<li class='cmo-icon-list-item {$css_animation}'>";
            else
                $output .= "<li class='cmo-icon-list-item {$css_animation}'><i class='{$icon}'></i> ";
			$output .= "<p>{$item}</p>";
            $output .= "</li>";
		}
        if ( $icon_type == 'numbering' )
		    $output .= "</ol>\n";
        else
		    $output .= "</ul>\n";
        $output .= "</div>\n";
		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "Icon List", 'cumulo_plugin' ),
    "base" => "cmo_icon_list",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_iconlist.png', dirname( __FILE__ ) ),
    "params" => array (
        array (
            "type" => "textarea",
            "heading" => __ ( "Items", 'cumulo_plugin' ),
            "param_name" => "content",
            "value" => '',
            "description" => esc_html( __( "Put each item in new line. Simple HTML tags such as <strong>,<em> are allowed.", 'cumulo_plugin' ) ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Line height (px)", 'cumulo_plugin' ),
            "param_name" => "line_height",
            "value" => '',
            "description" => esc_html( __( "Enter line height.", 'cumulo_plugin' ) ),
        ),
        css_animation_class(),
        extra_class (),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Type', 'cumulo_plugin' ),
            'value' => array(
                __( 'None', 'cumulo_plugin' ) => '',
                __( 'Font Awesome', 'cumulo_plugin' ) => 'fa',
                __( 'ET-Line', 'cumulo_plugin' ) => 'etline',
                __( 'Linecons', 'cumulo_plugin' ) => 'linecons',
                __( 'Numbering', 'cumulo_plugin' ) => 'numbering',
            ),
            'param_name' => 'icon_type',
            'description' => __( 'Select icon library.', 'cumulo_plugin' ),
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'cumulo_plugin' ),
            'param_name' => 'icon_fa',
            'value' => 'fa fa-star',
            'settings' => array(
                'emptyIcon' => false,
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'fa',
            ),
            'description' => __( 'Select icon from FontAwesome icons.', 'cumulo_plugin' ),
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'cumulo_plugin' ),
            'param_name' => 'icon_etline',
            'value' => 'et-line icon-lightbulb',
            'settings' => array(
                'emptyIcon' => false,
                'type'  =>  'etline',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'etline',
            ),
            'description' => __( 'Select icon from ET-Line icons.', 'cumulo_plugin' ),
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'cumulo_plugin' ),
            'param_name' => 'icon_linecons',
            'value' => 'vc_li vc_li-heart',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'linecons',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'linecons',
            ),
            'description' => __( 'Select icon from Linecons icons.', 'cumulo_plugin' ),
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array (
            "type" => "colorpicker",
            "heading" => __ ( "Icon Color", 'cumulo_plugin' ),
            "param_name" => "icon_color",
            "value" => '',
            'description' => __( 'Leave empty to use the primary color.', 'cumulo_plugin' ),
            "admin_label" => true,
            'group' => __( 'Colors', 'cumulo_plugin' ),
        ),
        array (
            "type" => "colorpicker",
            "heading" => __ ( "Number Color", 'cumulo_plugin' ),
            "param_name" => "number_color",
            "value" => '',
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'numbering',
            ),
            'description' => __( 'Leave empty to use the default text color.', 'cumulo_plugin' ),
            "admin_label" => true,
            'group' => __( 'Colors', 'cumulo_plugin' ),
        ),
        array (
            "type" => "colorpicker",
            "heading" => __ ( "Text Color", 'cumulo_plugin' ),
            "param_name" => "text_color",
            "value" => '',
            'description' => __( 'Leave empty to use the default text color.', 'cumulo_plugin' ),
            "admin_label" => true,
            'group' => __( 'Colors', 'cumulo_plugin' ),
        ),
    )
) );
