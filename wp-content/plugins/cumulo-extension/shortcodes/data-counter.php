<?php

class WPBakeryShortCode_cmo_data_counter extends WPBakeryShortCode {
    function content($atts, $content = null) {
		extract ( shortcode_atts ( array (
            'icon_type' => '',
            'icon_fa' => 'fa fa-star',
            'icon_etline' => 'et-line icon-lightbulb',
            'icon_linecons' => 'vc_li vc_li-heart',
            'image' => '',
            'icon_style' => 'icon-left',
            'count' => '',
            'title' => '',
            'text_alignment' => 'text-left',
            'min_height' => '200',
            'css_animation' => '',
            'el_class' => '',
            'background_color' => '',
            'icon_color' => '',
            'count_color' => '',
            'title_color' => '',
        ), $atts ) );

		$css_class = "cmo-data-counter wpb_content_element";

		$css_class .= " " . $icon_style;
		$css_class .= " " . $text_alignment;
        if ($icon_type == '') $css_class .= " icon-none";
        $css_class .= $this->getExtraClass ( $el_class );
        $id = shortcode_unique_id( "cmo-content-box" );
		$css_animation_class = get_css_animation( $css_animation );
        $icon = selected_icon( $icon_type, $icon_fa, $icon_etline, $icon_linecons );

		$css_style = '';
		$css_gen = new CUMULO_CSS_Generator( "cmo-data-counter", $id );
        if( $icon_color != '' ) {
            $css_style .= $css_gen->css( ".icon", array( 'color' => $icon_color ) );
        }
        if( $count_color != '' ) {
            $css_style .= $css_gen->css( ".count", array( 'color' => $count_color ) );
        }
        if( $title_color != '' ) {
			$css_style .= $css_gen->css( ".title", array( 'color' => $title_color ) );
		}
        if( $background_color != '' ) {
            $css_style .= $css_gen->css( "", array( 'background-color' => $background_color ) );
        }
        if ($min_height != '') {
            $css_style .= $css_gen->css( "", array( 'min-height' => $min_height . 'px' ) );
        }

		if( $icon_type == 'image' ) {
			$image_url = wp_get_attachment_url( $image );
			$css_style .= $css_gen->css( ".icon.image", array(
                'background-image' => "url('{$image_url}')"
			) );
		}

        $output = '';
		$output .= "<div class='{$css_class}' id='{$id}' data-value='{$count}'>";
        if( $css_style != '' ) {
            $output .= "<style scoped>{$css_style}</style>";
        }
		$output .= "<div class='wrapper'>";

        if ($icon_type != '') {
            if( $icon_type == 'image' ) {
                $output .= "<span class='icon image {$css_animation_class} '></span>";
            } else {
                $output .= "<i class='icon {$icon} {$css_animation_class} '></i>";
            }
        }

        $output .= "<div class='content-container {$text_alignment}'>";
        $output .=      "<div class='count'>{$count}</div>";
        $output .=      "<div class='title'>{$title}</div>";
        $output .= "</div>";

		$output .= "</div></div>\n";


        /*"<div class='heading heading-with-icon icon-left icon-large'>
            <div class='icon'><i class='fa fontawesome-icon fa-tint circle-yes large'></i></div>
        <h2 class='content-box-heading'>Unlimited Colors</h2></div>";
        "<div class="content-container icon-large">"'*/

		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "Data Counter", 'cumulo_plugin' ),
    "base" => "cmo_data_counter",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_datacounter.png', dirname( __FILE__ ) ),
    "params" => array (

        array (
            "type" => "textfield",
            "heading" => __ ( "Count", 'cumulo_plugin' ),
            "param_name" => "count",
            "value" => '',
            "admin_label" => true,
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Title", 'cumulo_plugin' ),
            "param_name" => "title",
            "value" => '',
            "admin_label" => true,
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Text Alignment', 'cumulo_plugin' ),
            'param_name' => 'text_alignment',
            'value' => array(
                __( "Left", 'cumulo_plugin' ) => 'text-left',
                __( "Center", 'cumulo_plugin' ) => 'text-center',
                __( "Right", 'cumulo_plugin' ) => 'text-right',
            ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Min Height", 'cumulo_plugin' ),
            "param_name" => "min_height",
            "value" => '',
            'description' => __( 'Please specify the minimum height in pixels for the data counter box.', 'cumulo_plugin' )
        ),
        extra_class (),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Type', 'cumulo_plugin' ),
            'value' => array(
                __( 'None', 'cumulo_plugin' ) => '',
                __( 'Font Awesome', 'cumulo_plugin' ) => 'fa',
                __( 'ET-Line', 'cumulo_plugin' ) => 'etline',
                __( 'Linecons', 'cumulo_plugin' ) => 'linecons',
                __( 'Custom Image', 'cumulo_plugin' ) => 'image',
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
            "type" => "attach_image",
            "heading" => __ ( "Image", 'cumulo_plugin' ),
            "param_name" => "image",
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'image',
            ),
            'description' => __( 'Select image.', 'cumulo_plugin' ),
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Position', 'cumulo_plugin' ),
            'param_name' => 'icon_style',
            'value' => array(
                __( "On Left", 'cumulo_plugin' ) => 'icon-left',
                __( "On Right", 'cumulo_plugin' ) => 'icon-right',
                __( "On Top", 'cumulo_plugin' ) => 'icon-top'
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'not_empty' => true,
            ),
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        css_animation_class( 'css_animation', __( "Icon Animation", 'cumulo_plugin' ), 'Icon' ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Icon Color',
            'param_name' => 'icon_color',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Count Color',
            'param_name' => 'count_color',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Title Color',
            'param_name' => 'title_color',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Background Color',
            'param_name' => 'background_color',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' ),
        ),

    )
) );
