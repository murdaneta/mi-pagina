<?php

class WPBakeryShortCode_cmo_content_box extends WPBakeryShortCode {
	function content($atts, $content = null) {
		extract ( shortcode_atts ( array (
            'title' => 'Title',
            'title_tag' => 'h3',
            'text_alignment' => 'text-left',
            'box_padding' => '',
            'icon_type' => 'none',
            'icon_fa' => 'fa fa-star',
            'icon_etline' => 'et-line icon-lightbulb',
            'icon_linecons' => 'vc_li vc_li-heart',
            'image' => '',
            'icon_style' => 'icon-inline',
            'separator' => '',
            'icon_size' => '',
            'icon_border' => '',
            'css_animation' => '',
            'el_class' => '',
            'background_color' => '',
            'background_style' => '',
            'title_color' => '',
            'desc_color' => '',
            'icon_color' => '',
            'icon_background_color' => '',
            'icon_border_color' => '',
            'icon_border_radius' => '',
            'no_hover' => '',
            'button_caption' => '',
            'button_link' => '',
            'button_style' => ''
        ), $atts ) );
		

		$icon = selected_icon( $icon_type, $icon_fa, $icon_etline, $icon_linecons );
        if ( $icon == '' && $image == '' )  $icon_style = 'icon-block';

        $css_class = "cmo-content-box wpb_content_element clearfix";
        $css_class .= " " . $text_alignment;
        $css_class .= " " . $icon_style;
        $css_class .= " " . $icon_size;
        $css_class .= " " . $box_padding;
        $css_class .= " " . $background_style;
        $css_class .= " " . $separator;
        $css_class .= " " . $no_hover;
        $css_class .= " " . get_css_animation( $css_animation );
        $css_class .= $this->getExtraClass ( $el_class );

        $css_style = '';
        $id = shortcode_unique_id( "cmo-content-box" );
        $css_gen = new CUMULO_CSS_Generator( "cmo-content-box", $id );

		if( $background_color != '' ) {
            if ( $no_hover == 'no-hover' )
                $css_style .= $css_gen->css( "", array( 'background-color' => $background_color ) );
            else
                $css_style .= $css_gen->css_with_self_condition( ":not(:hover)", "", array( 'background-color' => $background_color ) );
		}

		if( $title_color != '' ) {
			$css_style .= $css_gen->css( ".title", array( 'color' => $title_color ) );
		}
		if( $desc_color != '' ) {
			$css_style .= $css_gen->css( ".content", array( 'color' => $desc_color ) );
		}
        if( $icon_color != '' ) {
            $css_style .= $css_gen->css( ".featured-icon", array( 'color' => $icon_color ) );
        }
        if( $icon_background_color != '' ) {
            $css_style .= $css_gen->css( ".icon i", array( 'background-color' => $icon_background_color ) );
        }
        if( $icon_border_color != '' ) {
            $css_style .= $css_gen->css( ".icon", array( 'border-color' => $icon_border_color ) );
            if ( $icon_background_color != '' )
                $css_style .= $css_gen->css( ".icon", array( 'background-color' => $icon_border_color ) );
        }
        if( $icon_border_radius != '' ) {
            $css_style .= $css_gen->css( ".featured-icon", array( 'border-radius' => $icon_border_radius . 'px' ) );
            $css_style .= $css_gen->css( ".icon", array( 'border-radius' => $icon_border_radius . 'px' ) );
        }

		if( $icon_type == 'image' ) {
			$image_url = wp_get_attachment_url( $image );
			$css_style .= $css_gen->css( ".featured-icon.image", array(
					'background-image' => "url('{$image_url}')",
			) );
		}

        $output = '';
		$output .= "<div class='{$css_class}' id='{$id}'>";
		if( $css_style != '' ) {
			$output .= "<style scoped>{$css_style}</style>";
		}
		if( $icon_type == 'image' ) {
			$output .= "<div class='icon {$icon_border}' ><div class='featured-icon image '></div></div>";
		} else if ( $icon != '' ) {
            $output .= "<div class='icon {$icon_border}' ><i class='featured-icon {$icon} '></i></div>";
		}

        if ($title_tag == '') $title_tag = 'h3';
		if( $title ) {
			$output .= "<{$title_tag} class='title'>{$title}</{$title_tag}>";
		}
        $output .= "<div class='content-container'>";
		if( $content ) {
			$output .= "<div class='content'>{$content}</div>";
		}
        if ($button_caption) {
            $output .= do_shortcode("[cmo_button caption='{$button_caption}' size='medium' link='{$button_link}' link_target='_self' color_style='{$button_style}' border_width='1']");
        }
		$output .= "</div></div>\n";
		
		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "Content Box", 'cumulo_plugin' ),
    "base" => "cmo_content_box",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_iconbox.png', dirname( __FILE__ ) ),
    "params" => array (
        array (
            "type" => "textfield",
            "heading" => __ ( "Title", 'cumulo_plugin' ),
            "param_name" => "title",
            "value" => 'Title',
            "admin_label" => true,
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Title Tag', 'cumulo_plugin' ),
            'param_name' => 'title_tag',
            'value' => array(
                __( "Default", 'cumulo_plugin' ) => '',
                __( "H1", 'cumulo_plugin' ) => 'h1',
                __( "H2", 'cumulo_plugin' ) => 'h2',
                __( "H3", 'cumulo_plugin' ) => 'h3',
                __( "H4", 'cumulo_plugin' ) => 'h4',
                __( "H5", 'cumulo_plugin' ) => 'h5',
                __( "H6", 'cumulo_plugin' ) => 'h6',
            ),
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
        array(
            'type' => 'dropdown',
            'heading' => __( 'Box Padding', 'cumulo_plugin' ),
            'param_name' => 'box_padding',
            'value' => array(
                __( "Default", 'cumulo_plugin' ) => '',
                __( "None", 'cumulo_plugin' ) => 'padding-none',
                __( "Wide", 'cumulo_plugin' ) => 'padding-wide',
            ),
        ),
        array (
            "type" => "textarea_html",
            "heading" => __ ( "Content", 'cumulo_plugin' ),
            "param_name" => "content",
            "value" => __ ( "Hey! This is content text. Feel free to put any text here.", 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Button Caption", 'cumulo_plugin' ),
            "param_name" => "button_caption",
            "value" => '',
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Button Link", 'cumulo_plugin' ),
            "param_name" => "button_link",
            "value" => '',
        ),
        array (
            'type' => 'dropdown',
            'heading' => __( 'Button Style', 'cumulo_plugin' ),
            'value' => array(
                __( 'Default', 'cumulo_plugin' ) => '',
                __( 'Transparent', 'cumulo_plugin' ) => 'transparent'
            ),
            'param_name' => 'button_style'
        ),
        css_animation_class( 'css_animation', __( "CSS Animation", 'cumulo_plugin' ) ),
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
            'heading' => __( 'Icon Style', 'cumulo_plugin' ),
            'param_name' => 'icon_style',
            'value' => array(
                __( "Inline with title", 'cumulo_plugin' ) => 'icon-inline',
                __( "Block", 'cumulo_plugin' ) => 'icon-block',
                __( "On Side", 'cumulo_plugin' ) => 'icon-onside'
            ),
            'description' => __( 'Inline works only with left or right text alignment option.', 'cumulo_plugin' ),
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Separator', 'cumulo_plugin' ),
            'param_name' => 'separator',
            'dependency' => array(
                'element' => 'icon_style',
                'value' => 'icon-onside',
            ),
            'value' => array(
                __( "No", 'cumulo_plugin' ) => '',
                __( "Yes", 'cumulo_plugin' ) => 'separator'
            ),
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Size', 'cumulo_plugin' ),
            'value' => array(
                __( 'Default', 'cumulo_plugin' ) => '',
                __( 'Large', 'cumulo_plugin' ) => 'icon-large',
                __( 'X-Large', 'cumulo_plugin' ) => 'icon-x-large',
            ),
            'param_name' => 'icon_size',
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Border', 'cumulo_plugin' ),
            'value' => array(
                __( 'None', 'cumulo_plugin' ) => '',
                __( 'Thin', 'cumulo_plugin' ) => 'icon-border-thin',
                __( 'Thick', 'cumulo_plugin' ) => 'icon-border-thick',
            ),
            'param_name' => 'icon_border',
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'textfield',
            'heading' => 'Border Radius (px)',
            'param_name' => 'icon_border_radius',
            'value' => '',
            'dependency' => array(
                'element' => 'icon_border',
                'not_empty' => true,
            ),
            'group' => __( 'Icon', 'cumulo_plugin' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Background Style',
            'param_name' => 'background_style',
            'value' => array(
                __( "Default", 'cumulo_plugin' ) => '',
                __( "Diamond", 'cumulo_plugin' ) => 'background-diamond'
            ),
            'group' => __( 'Icon', 'cumulo_plugin' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Background Color',
            'param_name' => 'background_color',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' ),
            'description' => __( 'Leave blank for transparent background.', 'cumulo_plugin' ),
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
            'heading' => 'Content Color',
            'param_name' => 'desc_color',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Icon Color',
            'param_name' => 'icon_color',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Icon Background Color',
            'param_name' => 'icon_background_color',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Icon Border Color',
            'param_name' => 'icon_border_color',
            'value' => '',
            'dependency' => array(
                'element' => 'icon_border',
                'not_empty' => true,
            ),
            'group' => __( 'Colors', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Enable hover transition',
            'param_name' => 'no_hover',
            'value' => array(
                __( "Yes", 'cumulo_plugin' ) => '',
                __( "No", 'cumulo_plugin' ) => 'no-hover'
            ),
            'group' => __( 'Colors', 'cumulo_plugin' ),
            'description' => __( 'Switch hover transition effect.', 'cumulo_plugin' ),
        ),

    )
) );
