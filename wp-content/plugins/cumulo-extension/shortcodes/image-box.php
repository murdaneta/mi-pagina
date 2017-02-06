<?php

class WPBakeryShortCode_cmo_image_box extends WPBakeryShortCode {
	function content($atts, $content = null) {
		extract ( shortcode_atts ( array (
            'title' => '',
            'title_tag' => 'h3',
            'alt' => '',
            'image' => '',
            'grey_hover_enabled' => '',
            'overlay_enabled' => '',
            'overlay_text_alignment' => 'text-left',
            'overlay_color' => '',
            'overlay_text_color' => '',
            'overlay_title' => '',
            'overlay_subtitle' => '',
            'overlay_link' => '',
            'overlay_link_target' => '_self',
            'overlay_width' => '90%',
            'overlay_margin_left' => '0px',
            'css_animation' => '',
            'el_class' => '',
        ), $atts ) );
		
		$css_class = "cmo-image-box wpb_content_element";
        $css_class .= " " . get_css_animation( $css_animation );
		$css_class .= " " . $grey_hover_enabled;
		$css_class .= $this->getExtraClass ( $el_class );

		$css_style = '';
        $id = shortcode_unique_id( "cmo-image-box" );
        $css_gen = new CUMULO_CSS_Generator( "cmo-image-box", $id );

        if( $overlay_color != '' ) {
            $css_style .= $css_gen->css( ".overlay-wrapper", array( 'background-color' => $overlay_color ) );
        }
        if( $overlay_text_color != '' ) {
            $css_style .= $css_gen->css( ".overlay-wrapper", array( 'color' => $overlay_text_color ) );
        }
        if( $overlay_width != '' ) {
            $css_style .= $css_gen->css( ".overlay-wrapper", array( 'width' => $overlay_width ) );
        }
        if( $overlay_margin_left != '' ) {
            $css_style .= $css_gen->css( ".overlay-wrapper", array( 'left' => $overlay_margin_left ) );
        }

        $output = '';
		$output .= "<div class='{$css_class}' id='{$id}'>";
		if( $css_style != '' ) {
			$output .= "<style scoped>{$css_style}</style>";
		}

        $image_url = wp_get_attachment_url( $image );

        $output .= "<div class='img-wrapper'><img src='{$image_url}' alt='{$alt}'>";
        if ( $overlay_enabled == 'yes' ) {
            if ( $overlay_link != '' ) $output .= "<a href='{$overlay_link}' target='{$overlay_link_target}'>";
            $output .= "<div class='overlay-wrapper {$overlay_text_alignment}'>";
                $output .= "<div class='title'>{$overlay_title}</div>";
                $output .= "<div class='subtitle'>{$overlay_subtitle}</div>";
            $output .= "</div>";
            if ( $overlay_link != '' ) $output .= "</a>";
        }

        $output .= "</div>"; //img-wrapper

        if ( $title != '' || $content != '' ) {
            $output .= "<div class='content-wrapper'>";
            if ($title_tag == '') $title_tag = 'h3';
            if( $title ) {
                $output .= "<{$title_tag} class='title'>{$title}</{$title_tag}>";
            }
            if( $content ) {
                $output .= "<div class='content'>{$content}</div>";
            }
            $output .= "</div>";
        }

		$output .= "</div>\n";
		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "Image Box", 'cumulo_plugin' ),
    "base" => "cmo_image_box",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_imagebox.png', dirname( __FILE__ ) ),
    "params" => array (
        array (
            "type" => "textfield",
            "heading" => __ ( "Title", 'cumulo_plugin' ),
            "param_name" => "title",
            "value" => '',
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
        array (
            "type" => "textarea",
            "heading" => __ ( "Content", 'cumulo_plugin' ),
            "param_name" => "content",
            "value" => __ ( "", 'cumulo_plugin' ),
        ),
        array (
            "type" => "attach_image",
            "heading" => __ ( "Image", 'cumulo_plugin' ),
            "param_name" => "image",
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Image Hover Effect', 'cumulo_plugin' ),
            'param_name' => 'grey_hover_enabled',
            'value' => array(
                __( "None", 'cumulo_plugin' ) => 'grey_none',
                __( "Grey 40%", 'cumulo_plugin' ) => 'grey_40',
                __( "Grey 80%", 'cumulo_plugin' ) => 'grey_80'
            ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Alt", 'cumulo_plugin' ),
            "param_name" => "alt",
            "value" => '',
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Enable Overlay', 'cumulo_plugin' ),
            'param_name' => 'overlay_enabled',
            'value' => array(
                __( "No", 'cumulo_plugin' ) => '',
                __( "Yes", 'cumulo_plugin' ) => 'yes'
            ),
            'group' => __( 'Overlay', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Text Alignment', 'cumulo_plugin' ),
            'param_name' => 'overlay_text_alignment',
            'value' => array(
                __( "Left", 'cumulo_plugin' ) => 'text-left',
                __( "Center", 'cumulo_plugin' ) => 'text-center',
                __( "Right", 'cumulo_plugin' ) => 'text-right',
            ),
            'dependency' => array(
                'element' => 'overlay_enabled',
                'value' => 'yes',
            ),
            'group' => __( 'Overlay', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Background Color',
            'param_name' => 'overlay_color',
            'value' => '',
            'dependency' => array(
                'element' => 'overlay_enabled',
                'value' => 'yes',
            ),
            'description' => __( 'Leave blank for transparent overlay.', 'cumulo_plugin' ),
            'group' => __( 'Overlay', 'cumulo_plugin' ),
        ),

        array(
            'type' => 'colorpicker',
            'heading' => 'Text Color',
            'param_name' => 'overlay_text_color',
            'value' => '',
            'dependency' => array(
                'element' => 'overlay_enabled',
                'value' => 'yes',
            ),
            'description' => __( 'Leave blank for default color.', 'cumulo_plugin' ),
            'group' => __( 'Overlay', 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Overlay Title", 'cumulo_plugin' ),
            "param_name" => "overlay_title",
            "value" => '',
            'dependency' => array(
                'element' => 'overlay_enabled',
                'value' => 'yes',
            ),
            'group' => __( 'Overlay', 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Overlay Subtitle", 'cumulo_plugin' ),
            "param_name" => "overlay_subtitle",
            "value" => '',
            'dependency' => array(
                'element' => 'overlay_enabled',
                'value' => 'yes',
            ),
            'group' => __( 'Overlay', 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Link", 'cumulo_plugin' ),
            "param_name" => "overlay_link",
            "value" => '',
            'dependency' => array(
                'element' => 'overlay_enabled',
                'value' => 'yes',
            ),
            'group' => __( 'Overlay', 'cumulo_plugin' ),
        ),
        array (
            "type" => "dropdown",
            "heading" => __ ( "Link Target", 'cumulo_plugin' ),
            "param_name" => "overlay_link_target",
            "value" => array (
                __ ( "_self (same window)", 'cumulo_plugin' ) => '_self',
                __ ( "_blank (new window)", 'cumulo_plugin' ) => '_blank'
            ),
            'dependency' => array(
                'element' => 'overlay_enabled',
                'value' => 'yes',
            ),
            'group' => __( 'Overlay', 'cumulo_plugin' ),
        ),

        array (
            "type" => "textfield",
            "heading" => __ ( "Overlay Width", 'cumulo_plugin' ),
            "param_name" => "overlay_width",
            "value" => '90%',
            'dependency' => array(
                'element' => 'overlay_enabled',
                'value' => 'yes',
            ),
            'description' => __( 'Put width of the overlay panel, example: 90%, 200px.', 'cumulo_plugin' ),
            'group' => __( 'Overlay', 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Left Margin", 'cumulo_plugin' ),
            "param_name" => "overlay_margin_left",
            "value" => '0px',
            'dependency' => array(
                'element' => 'overlay_enabled',
                'value' => 'yes',
            ),
            'description' => __( 'Put margin of the overlay panel, example: 5%, 10px.', 'cumulo_plugin' ),
            'group' => __( 'Overlay', 'cumulo_plugin' ),
        ),

        css_animation_class(),
        extra_class(),
    )
) );
