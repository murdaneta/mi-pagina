<?php

class WPBakeryShortCode_cmo_callout extends WPBakeryShortCode {
	function content($atts, $content = null) {
		extract ( shortcode_atts ( array (
            'color' => '',
            'icon_type' => '',
            'icon_fa' => 'fa fa-star',
            'icon_etline' => 'et-line icon-lightbulb',
            'icon_linecons' => 'vc_li li-heart',
            'image' => '',
            'image_width' => '',
            'image_height' => '',
            'button1' => '',
            'button1_caption' => '',
            'button1_link' => '',
            'button1_target' => '',
            'button1_border_width' => '2',
            'button1_shape' => '',
            'button1_style' => '',
            'button1_color' => '',
            'button1_bg_color' => '',
            'button1_border_color' => '',
            'button1_color_on_hover' => '',
            'button1_bg_color_on_hover' => '',
            'button1_border_color_on_hover' => '',
            'button2' => '',
            'button2_caption' => '',
            'button2_link' => '',
            'button2_target' => '',
            'button2_border_width' => '2',
            'button2_shape' => '',
            'button2_style' => '',
            'button2_color' => '',
            'button2_bg_color' => '',
            'button2_border_color' => '',
            'button2_color_on_hover' => '',
            'button2_bg_color_on_hover' => '',
            'button2_border_color_on_hover' => '',
            'css_animation' => '',
            'el_class' => '',
		), $atts ) );

        $css_class = "cmo-callout wpb_content_element clearfix";
		$css_class .= get_css_animation( $css_animation );
		$css_class .= $this->getExtraClass ( $el_class );

        $id = shortcode_unique_id( "cmo-callout" );

        $icon = selected_icon( $icon_type, $icon_fa, $icon_etline, $icon_linecons );
        $css_style = '';
        $css_gen = new CUMULO_CSS_Generator( "cmo-callout", $id );
        if( $icon_type == 'image' ) {
            $image_url = wp_get_attachment_url( $image );
            $css_style .= $css_gen->css( ".featured-icon", array(
                'background-image' => "url('{$image_url}')",
                'background-size' => "cover",
            ) );

            if ($image_width != '') {
                $css_style .= $css_gen->css( ".featured-icon", array( 'width' => $image_width . 'px' ) );
            }
            if ($image_height != '') {
                $css_style .= $css_gen->css( ".featured-icon", array( 'height' => $image_height . 'px' ) );
            }
        }
        
        if ($color != '') {
        	$css_style .= $css_gen->css( ".content", array( 'color' => $color ) );
        }

		$output = '';
		$output .= "<div class='{$css_class}' id='{$id}'>";

        if( $css_style != '' ) {
            $output .= "<style scoped>{$css_style}</style>";
        }

        $output .= '<p class="content">';
        if ($icon_type != '') {
            if( $icon_type == 'image' ) {
                $output .= "<span class='featured-icon image '></span>";
            } else {
                 $output .= "<i class='featured-icon {$icon} '></i>";
            }
        }

		$output .= " {$content}</p>";
		$output .= "<div class='buttons-wrapper'>";
        if ( $button1 == 'yes') {
            $output .= do_shortcode("[cmo_button caption='{$button1_caption}' link='{$button1_link}' link_target='{$button1_target}' color_style='{$button1_style}' color='{$button1_color}' border_color='{$button1_border_color}' background_color='{$button1_bg_color}' color_on_hover='{$button1_color_on_hover}' border_color_on_hover='{$button1_border_color_on_hover}' background_color_on_hover='{$button1_bg_color_on_hover}' shape='{$button1_shape}' border_width='{$button1_border_width}']");
        }
        if ( $button2 == 'yes') {
            $output .= do_shortcode("[cmo_button caption='{$button2_caption}' link='{$button2_link}' link_target='{$button2_target}' color_style='{$button2_style}' color='{$button2_color}' border_color='{$button2_border_color}' background_color='{$button2_bg_color}' color_on_hover='{$button2_color_on_hover}' border_color_on_hover='{$button2_border_color_on_hover}' background_color_on_hover='{$button2_bg_color_on_hover}' shape='{$button2_shape}' border_width='{$button2_border_width}']");
        }
		$output .= "</div></div>\n";
		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "Callout", 'cumulo_plugin' ),
    "base" => "cmo_callout",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_callout.png', dirname( __FILE__ ) ),
    "params" => array (
        array (
            "type" => "textarea",
            "heading" => __ ( "Text", 'cumulo_plugin' ),
            "param_name" => "content",
            "value" => __ ( "This is a callout. Feel free to put any text here.", 'cumulo_plugin' ),
            "admin_label" => true
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Color (Text, Icon)',
            'param_name' => 'color',
            'value' => '',
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
        array (
            "type" => "textfield",
            "heading" => __ ( "Image Width (px)", 'cumulo_plugin' ),
            "param_name" => "image_width",
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'image',
            ),
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Image Height (px)", 'cumulo_plugin' ),
            "param_name" => "image_height",
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'image',
            ),
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Show', 'cumulo_plugin' ),
            'value' => array(
                __( 'No', 'cumulo_plugin' ) => '',
                __( 'Yes', 'cumulo_plugin' ) => 'yes',
            ),
            'param_name' => 'button1',
            'group' => __( 'Button 1', 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Caption", 'cumulo_plugin' ),
            "param_name" => "button1_caption",
            "value" => '',
            'dependency' => array(
                'element' => 'button1',
                'not_empty' => true,
            ),
            'admin_label' => true,
            'group' => __( 'Button 1', 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Link", 'cumulo_plugin' ),
            "param_name" => "button1_link",
            "value" => '',
            'dependency' => array(
                'element' => 'button1',
                'not_empty' => true,
            ),
            'group' => __( 'Button 1', 'cumulo_plugin' ),
        ),
        array (
            "type" => "dropdown",
            "heading" => __ ( "Link Target", 'cumulo_plugin' ),
            "param_name" => "button1_target",
            "value" => array (
                __ ( "_self (same window)", 'cumulo_plugin' ) => '_self',
                __ ( "_blank (new window)", 'cumulo_plugin' ) => '_blank'
            ),
            'dependency' => array(
                'element' => 'button1',
                'not_empty' => true,
            ),
            'group' => __( 'Button 1', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Shape', 'cumulo_plugin' ),
            'value' => array(
                __( 'Default', 'cumulo_plugin' ) => '',
                __( 'Round', 'cumulo_plugin' ) => 'shape-round',
                __( 'Pill', 'cumulo_plugin' ) => 'shape-pill',
            ),
            "param_name" => "button1_shape",
            'dependency' => array(
                'element' => 'button1',
                'not_empty' => true,
            ),
            'description' => __( 'Select button shape.', 'cumulo_plugin' ),
            'group' => __( 'Button 1', 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Border Width (px)", 'cumulo_plugin' ),
            "param_name" => "button1_border_width",
            "value" => "2",
            'dependency' => array(
                'element' => 'button1',
                'not_empty' => true,
            ),
            'group' => __( 'Button 1', 'cumulo_plugin' ),
        ),
        array (
            'type' => 'dropdown',
            'heading' => __( 'Color Style', 'cumulo_plugin' ),
            'value' => array(
                __( 'Default', 'cumulo_plugin' ) => '',
                __( 'Transparent', 'cumulo_plugin' ) => 'transparent'
            ),
            'param_name' => 'button1_style',
            'group' => __( 'Button 1', 'cumulo_plugin' ),
            'dependency' => array(
                'element' => 'button1',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Text Color',
            'param_name' => 'button1_color',
            'value' => '',
            'group' => __( 'Button 1', 'cumulo_plugin' ),
            'dependency' => array(
                'element' => 'button1',
                'not_empty' => true,
            ),

        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Background Color',
            'param_name' => 'button1_bg_color',
            'value' => '',
            'group' => __( 'Button 1', 'cumulo_plugin' ),
            'dependency' => array(
                'element' => 'button1',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Border Color',
            'param_name' => 'button1_border_color',
            'value' => '',
            'group' => __( 'Button 1', 'cumulo_plugin' ),
            'dependency' => array(
                'element' => 'button1',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Color On Hover',
            'param_name' => 'button1_color_on_hover',
            'value' => '',
            'group' => __( 'Button 1', 'cumulo_plugin' ),
            'dependency' => array(
                'element' => 'button1',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Background Color on Hover',
            'param_name' => 'button1_bg_color_on_hover',
            'value' => '',
            'group' => __( 'Button 1', 'cumulo_plugin' ),
            'dependency' => array(
                'element' => 'button1',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Border Color on Hover',
            'param_name' => 'button1_border_color_on_hover',
            'value' => '',
            'group' => __( 'Button 1', 'cumulo_plugin' ),
            'dependency' => array(
                'element' => 'button1',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Show', 'cumulo_plugin' ),
            'value' => array(
                __( 'No', 'cumulo_plugin' ) => '',
                __( 'Yes', 'cumulo_plugin' ) => 'yes',
            ),
            'param_name' => 'button2',
            'group' => __( 'Button 2 ', 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Caption", 'cumulo_plugin' ),
            "param_name" => "button2_caption",
            "value" => '',
            'dependency' => array(
                'element' => 'button2',
                'not_empty' => true,
            ),
            'admin_label' => true,
            'group' => __( 'Button 2 ', 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Link", 'cumulo_plugin' ),
            "param_name" => "button2_link",
            "value" => '',
            'dependency' => array(
                'element' => 'button2',
                'not_empty' => true,
            ),
            'group' => __( 'Button 2 ', 'cumulo_plugin' ),
        ),
        array (
            "type" => "dropdown",
            "heading" => __ ( "Link Target", 'cumulo_plugin' ),
            "param_name" => "button2_target",
            "value" => array (
                __ ( "_self (same window)", 'cumulo_plugin' ) => '_self',
                __ ( "_blank (new window)", 'cumulo_plugin' ) => '_blank'
            ),
            'dependency' => array(
                'element' => 'button2',
                'not_empty' => true,
            ),
            'group' => __( 'Button 2 ', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Shape', 'cumulo_plugin' ),
            'value' => array(
                __( 'Default', 'cumulo_plugin' ) => '',
                __( 'Round', 'cumulo_plugin' ) => 'shape-round',
                __( 'Pill', 'cumulo_plugin' ) => 'shape-pill',
            ),
            "param_name" => "button2_shape",
            'dependency' => array(
                'element' => 'button2',
                'not_empty' => true,
            ),
            'description' => __( 'Select button shape.', 'cumulo_plugin' ),
            'group' => __( 'Button 2 ', 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Border Width (px)", 'cumulo_plugin' ),
            "param_name" => "button2_border_width",
            "value" => "2",
            'dependency' => array(
                'element' => 'button2',
                'not_empty' => true,
            ),
            'group' => __( 'Button 2 ', 'cumulo_plugin' ),
        ),
        array (
            'type' => 'dropdown',
            'heading' => __( 'Color Style', 'cumulo_plugin' ),
            'value' => array(
                __( 'Default', 'cumulo_plugin' ) => '',
                __( 'Transparent', 'cumulo_plugin' ) => 'transparent'
            ),
            'param_name' => 'button2_style',
            'group' => __( 'Button 2 ', 'cumulo_plugin' ),
            'dependency' => array(
                'element' => 'button2',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Text Color',
            'param_name' => 'button2_color',
            'value' => '',
            'dependency' => array(
                'element' => 'button2',
                'not_empty' => true,
            ),
            'group' => __( 'Button 2 ', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Background Color',
            'param_name' => 'button2_bg_color',
            'value' => '',
            'group' => __( 'Button 2 ', 'cumulo_plugin' ),
            'dependency' => array(
                'element' => 'button2',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Border Color',
            'param_name' => 'button2_border_color',
            'value' => '',
            'group' => __( 'Button 2 ', 'cumulo_plugin' ),
            'dependency' => array(
                'element' => 'button2',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Color On Hover',
            'param_name' => 'button2_color_on_hover',
            'value' => '',
            'group' => __( 'Button 2 ', 'cumulo_plugin' ),
            'dependency' => array(
                'element' => 'button2',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Background Color on Hover',
            'param_name' => 'button2_bg_color_on_hover',
            'value' => '',
            'group' => __( 'Button 2 ', 'cumulo_plugin' ),
            'dependency' => array(
                'element' => 'button2',
                'not_empty' => true,
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Border Color on Hover',
            'param_name' => 'button2_border_color_on_hover',
            'value' => '',
            'group' => __( 'Button 2 ', 'cumulo_plugin' ),
            'dependency' => array(
                'element' => 'button2',
                'not_empty' => true,
            ),
        ),

    )
) );
