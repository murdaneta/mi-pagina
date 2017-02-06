<?php

class WPBakeryShortCode_cmo_feature_box extends WPBakeryShortCode {
	function content($atts, $content = null) {
		extract ( shortcode_atts ( array (
            'style' => 'style1',
            'title' => '',
            'title_tag' => 'h3',
            'alt' => '',
            'image' => '',
            'link' => '',
            'button_caption' => '',
            'css_animation' => '',
            'el_class' => '',
        ), $atts ) );
		
		$css_class = "cmo-feature-box wpb_content_element ";
		$css_class .= $style;
        $css_class .= " " . get_css_animation( $css_animation );
		$css_class .= $this->getExtraClass ( $el_class );

		$css_style = '';
        $id = shortcode_unique_id( "cmo-feature-box" );
        $css_gen = new CUMULO_CSS_Generator( "cmo-feature-box", $id );

        $output = '';
		$output .= "<div class='{$css_class}' id='{$id}'>";
		if( $css_style != '' ) {
			$output .= "<style scoped>{$css_style}</style>";
		}

        $image_url = wp_get_attachment_url( $image );
        if( $title ) {
            if ($title_tag == '') $title_tag = 'h3';
            $output .= "<{$title_tag} class='title'>{$title}</{$title_tag}>";
        }
        $output .= "<div class='content-wrapper'>";
        $output .= "<div class='img-wrapper'><img src='{$image_url}' alt='{$alt}'>";
        $output .= "</div>"; //img-wrapper

        if( $content ) {
            $output .= "<div class='content'>{$content}</div>";
        }
        if( $button_caption ) {
            $output .= do_shortcode("[cmo_button caption='{$button_caption}' link='{$link}' align='center' border_width=1 link_target='_self' color_style='transparent' ]");
        }
        $output .= "</div>"; //content-wrapper

		$output .= "</div>\n";
		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "Feature Box", 'cumulo_plugin' ),
    "base" => "cmo_feature_box",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_featurebox.png', dirname( __FILE__ ) ),
    "params" => array (
        array(
            'type' => 'dropdown',
            'heading' => __( 'Style', 'cumulo_plugin' ),
            'param_name' => 'style',
            'value' => array(
                __( "Style 1", 'cumulo_plugin' ) => 'style1',
                __( "Style 2", 'cumulo_plugin' ) => 'style2',
            ),
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
            "type" => "attach_image",
            "heading" => __ ( "Image", 'cumulo_plugin' ),
            "param_name" => "image",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Alt", 'cumulo_plugin' ),
            "param_name" => "alt",
            "value" => '',
        ),
        array (
            "type" => "textarea",
            "heading" => __ ( "Content", 'cumulo_plugin' ),
            "param_name" => "content",
            "value" => __ ( "", 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Button Caption", 'cumulo_plugin' ),
            "param_name" => "button_caption",
            "value" => '',
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Link", 'cumulo_plugin' ),
            "param_name" => "link",
            "value" => '',
        ),
        css_animation_class(),
        extra_class(),
    )
) );
