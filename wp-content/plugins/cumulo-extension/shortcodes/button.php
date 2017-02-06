<?php

class WPBakeryShortCode_cmo_button extends WPBakeryShortCode {
	function content($atts, $content = null) {
		extract ( shortcode_atts ( array (
            'caption' => 'Button',
            'shape' => '',
            'icon_type' => '',
            'icon_fa' => 'fa fa-star',
            'icon_etline' => 'et-line icon-lightbulb',
            'icon_linecons' => 'vc_li vc_li-heart',
            'icon_alignment' => 'icon-left',
            'icon_size' => '',
            'image' => '',
            'size' => 'medium',
            'border_width' => '2',
            'margin' => '',
            'link' => '',
            'link_target' => '',
            'link_type' => '',
            'align' => '',
            'color_style' => '',
            'color' => '',
            'border_color' => '',
            'background_color' => '',
            'color_on_hover' => '',
            'border_color_on_hover' => '',
            'background_color_on_hover' => '',
            'css_animation' => '',
            'el_class' => '',
		), $atts ) );
		
		$css_class = "cmo-button ";
		if( $color_style != '' ) {
			$css_class .= " " . $color_style;
		}
		$css_class .= " " . $size;
		$css_class .= " " . $shape;
		$css_class .= " " . $icon_size;
		$css_class .= " " . $link_type;
		$css_class .= get_css_animation( $css_animation );
		$css_class .= $this->getExtraClass ( $el_class );

        $css_style = '';
        $id = shortcode_unique_id( "cmo-button" );
        $css_gen = new CUMULO_CSS_Generator( "cmo-button", $id );

        if ( $border_width != '') {
            $css_style .= $css_gen->css( "", array( 'border-width' => $border_width . 'px') );
        }
        if ( $margin != '') {
            $css_style .= $css_gen->css( "", array( 'margin' => $margin . ' !important;' ) );
        }

        if ( $color != '' ) {
            $css_style .= $css_gen->css( "", array( 'color' => $color) );
        }
        if ( $border_color != '' ) {
            $css_style .= $css_gen->css( "", array( 'border-color' => $border_color) );
        }
        if ( $background_color != '' ) {
//            $css_style .= $css_gen->css( "", array( 'background-color' => $background_color) );
            $css_style .= $css_gen->css_with_self_condition( ":not(:hover)", "", array( 'background-color' => $background_color) );
        }

        if ( $color_on_hover != '' ) {
             $css_style .= $css_gen->css_with_self_condition( ":hover", "", array( 'color' => $color_on_hover) );
        }
        if ( $border_color_on_hover != '' ) {
             $css_style .= $css_gen->css_with_self_condition( ":hover", "", array( 'border-color' => $border_color_on_hover) );
        }
        if ( $background_color_on_hover != '' ) {
            $css_style .= $css_gen->css_with_self_condition( ":hover", "", array( 'background-color' => $background_color_on_hover) );
        }

        if( $icon_type == 'image' ) {
            $image_url = wp_get_attachment_url( $image );
            $css_style .= $css_gen->css( ".image", array(
                'background-image' => "url('{$image_url}')",
            ) );
        }

        $output = "<div class='cmo-button-wrapper clearfix align-{$align}'>";
		if( $css_style != '' ) {
            $output .= "<style scoped>{$css_style}</style>";
        }

        $target = "";
        if ( $link_target != '')
            $target = "target='{$link_target}'";
        $output .= "<a class='{$css_class}' id='{$id}' href='{$link}' {$target}>";

        if( $icon_type != '' ) {
            $icon_html = "";
            if( $icon_type == 'image' ) {
                $icon_html = "<div class='image'></div>";
            } else {
                $icon = selected_icon( $icon_type, $icon_fa, $icon_etline, $icon_linecons );
                $icon_html = "<i class='{$icon}'></i>";
            }

            if ($icon_alignment == 'icon-left') {
                $output .= $icon_html . " <span>{$caption}</span>";
            } else if ($icon_alignment == 'icon-right') {
                $output .= "<span>{$caption}</span> " . $icon_html;
            } else if ($icon_alignment == 'icon-top') {
                $icon_html = "<div class='icon-wrapper'>{$icon_html}</div>";
                $output .= $icon_html . " <span>{$caption}</span>";
            } else { //icon-bottom
                $icon_html = "<div class='icon-wrapper'>{$icon_html}</div>";
                $output .= "<span>{$caption}</span> " . $icon_html ;
            }
        } else {
            $output .= "<span>{$caption}</span>";
        }

        $output .= "</a>\n";

        $output .= "</div>\n";
		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "Button", 'cumulo_plugin' ),
    "base" => "cmo_button",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_button.png', dirname( __FILE__ ) ),
    "params" => array (
        array (
            "type" => "textfield",
            "heading" => __ ( "Caption", 'cumulo_plugin' ),
            "param_name" => "caption",
            "value" => __ ( "Button", 'cumulo_plugin' ),
            "admin_label" => true,
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Link", 'cumulo_plugin' ),
            "param_name" => "link",
            "value" => '',
        ),
        array (
            "type" => "dropdown",
            "heading" => __ ( "Link Target", 'cumulo_plugin' ),
            "param_name" => "link_target",
            "value" => array (
                __ ( "_self (same window)", 'cumulo_plugin' ) => '_self',
                __ ( "_blank (new window)", 'cumulo_plugin' ) => '_blank'
            ),
        ),
        array (
            "type" => "dropdown",
            "heading" => __ ( "Link Type", 'cumulo_plugin' ),
            "param_name" => "link_type",
            "value" => array (
                __ ( "Default", 'cumulo_plugin' ) => '',
                __ ( "Fancybox Link", 'cumulo_plugin' ) => 'fancybox-link',
                __ ( "Fancybox Image", 'cumulo_plugin' ) => 'fancybox-image',
                __ ( "Fancybox Video", 'cumulo_plugin' ) => 'fancybox-media'
            ),
        ),
        array (
            "type" => "dropdown",
            "heading" => __ ( "Size", 'cumulo_plugin' ),
            "param_name" => "size",
            "value" => array (
                __ ( "Medium", 'cumulo_plugin' ) => 'medium',
                __ ( "Small", 'cumulo_plugin' ) => 'small',
                __ ( "Large", 'cumulo_plugin' ) => 'large',
            ),
            "admin_label" => true,
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Shape', 'cumulo_plugin' ),
            'value' => array(
                __( 'Default', 'cumulo_plugin' ) => '',
                __( 'Round', 'cumulo_plugin' ) => 'shape-round',
                __( 'Pill', 'cumulo_plugin' ) => 'shape-pill',
            ),
            'param_name' => 'shape',
            'description' => __( 'Select button shape.', 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Border Width", 'cumulo_plugin' ),
            "param_name" => "border_width",
            "value" => "2",
            "description" => "Put only the number in pixels."
        ),
        array (
            "type" => "dropdown",
            "heading" => __ ( "Align", 'cumulo_plugin' ),
            "param_name" => "align",
            "value" => array (
                __ ( "Default", 'cumulo_plugin' ) => '',
                __ ( "Left", 'cumulo_plugin' ) => 'left',
                __ ( "Center", 'cumulo_plugin' ) => 'center',
                __ ( "Right", 'cumulo_plugin' ) => 'right',
            )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Margin", 'cumulo_plugin' ),
            "param_name" => "margin",
            "value" => "",
            "description" => "Put margin in format: 0px 10px 0px 0px."
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
            'heading' => __( 'Icon Size', 'cumulo_plugin' ),
            'value' => array(
                __( 'Default', 'cumulo_plugin' ) => '',
                __( 'Large', 'cumulo_plugin' ) => 'icon-large',
                __( 'Larger', 'cumulo_plugin' ) => 'icon-larger',
                __( 'X-Large', 'cumulo_plugin' ) => 'icon-xlarge',
            ),
            'param_name' => 'icon_size',
            'dependency' => array(
                'element' => 'icon_type',
                'not_empty' => true,
            ),
            'group' => __( 'Icon', 'cumulo_plugin' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Alignment', 'cumulo_plugin' ),
            'value' => array(
                __( 'Left', 'cumulo_plugin' ) => 'icon-left',
                __( 'Right', 'cumulo_plugin' ) => 'icon-right',
                __( 'Top', 'cumulo_plugin' ) => 'icon-top',
                __( 'Bottom', 'cumulo_plugin' ) => 'icon-bottom',
            ),
            'param_name' => 'icon_alignment',
            'dependency' => array(
                'element' => 'icon_type',
                'not_empty' => true,
            ),
            'group' => __( 'Icon', 'cumulo_plugin' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Color Style', 'cumulo_plugin' ),
            'value' => array(
                __( 'Default', 'cumulo_plugin' ) => '',
                __( 'Transparent', 'cumulo_plugin' ) => 'transparent',
            ),
            'param_name' => 'color_style',
            'group' => __( 'Colors', 'cumulo_plugin' ),
            'description' => __( 'This will be overwritten by the following color options.', 'cumulo_plugin' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Color',
            'param_name' => 'color',
            'value' => '',
            'description' => __( 'Color for text and icon. Clear to use theme\'s default color.', 'cumulo_plugin' ),
            'group' => __( 'Colors', 'cumulo_plugin' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Border Color',
            'param_name' => 'border_color',
            'value' => '',
            'description' => __( 'Color for border. Clear to use theme\'s default color.', 'cumulo_plugin' ),
            'group' => __( 'Colors', 'cumulo_plugin' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Background Color',
            'param_name' => 'background_color',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Color On Hover',
            'param_name' => 'color_on_hover',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Border Color On Hover',
            'param_name' => 'border_color_on_hover',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Background Color On Hover',
            'param_name' => 'background_color_on_hover',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' )
        )
    )
) );
