<?php

class WPBakeryShortCode_cmo_single_image extends WPBakeryShortCode {
	function content($atts, $content = null) {
		extract ( shortcode_atts ( array (
            'image' => '',
            'title' => '',
            'alt' => '',
            'image_height' => '',
            'lightbox' => 'no',
            'lightbox_image' => '',
            'lightbox_video' => '',
            'lightbox_id' => '',
            'link' => '',
            'link_target' => '_self',
            'border_width' => '',
            'border_color' => '',
            'align' => 'center',
            'css_animation' => '',
            'el_class' => '',
            'icon_type' => '',
            'icon_fa' => 'fa fa-star',
            'icon_etline' => 'et-line icon-lightbulb',
            'icon_linecons' => 'vc_li vc_li-heart',
            'overlay_color' => '',
            'overlay_image' => '',
            'hover_text' => '',
            'icon_position' => 'icon-left'

		), $atts ) );

        $css_class = "cmo-single-image clearfix";
        if ($image_height != '') $css_class .= ' fixed-height';
		$css_class .= ' ' . $align;
		$css_class .= get_css_animation( $css_animation );
		$css_class .= $this->getExtraClass ( $el_class );

		$image_url = wp_get_attachment_url( $image );
		$lightbox_image_url = $image_url;
		if( $lightbox == 'image' && $lightbox_image != '' ) {
			$lightbox_image_url = wp_get_attachment_url( $lightbox_image );
		}

        $id = shortcode_unique_id( "cmo-single-image" );
        $css_style = '';
        $css_gen = new CUMULO_CSS_Generator( "cmo-single-image", $id );
        if( $image_height != '' ) {
            $css_style .= $css_gen->css( "", array( 'height' => $image_height . 'px' ) );
        }
        if( $border_width != '' ) {
            $css_style .= $css_gen->css( "", array( 'border-width' => $border_width . 'px' ) );
        }
        if( $border_color != '' ) {
            $css_style .= $css_gen->css( "", array( 'border-color' => $border_color ) );
        }
        if( $overlay_color != '' ) {
            $css_style .= $css_gen->css( "a:after", array( 'background' => $overlay_color ) );
        }

        $output = '';
		$output .= "<div class='{$css_class}' id='{$id}'>";
        if( $css_style != '' ) {
            $output .= "<style scoped>{$css_style}</style>";
        }

		if( $lightbox == 'image' ) {
			$output .= "<a href='{$lightbox_image_url}' class='fancybox-image' data-fancybox-group='{$lightbox_id}'>";
		} else if( $lightbox == 'video-embed' ) {
			$output .= "<a href='{$lightbox_video}' class='fancybox-media'>";
		} else if ( $lightbox == 'no' ) {
            $target = '';
            if ( $link == '' )
                $link = 'javascript:void(0);';
            else
                $target = " target={$link_target}";
            $output .= "<a href='{$link}' {$target}>";
        }
		$output .= "<div class='wrapper'><img src='{$image_url}' title='{$title}' alt='{$alt}'>";

        $icon = selected_icon( $icon_type, $icon_fa, $icon_etline, $icon_linecons );
        if( $icon_type == 'image' ) {
            $image_url = wp_get_attachment_url( $overlay_image );
        }

        $icon_html = "";
        if( $icon_type == 'image' ) {
            if ( $overlay_image != '' ) $icon_html = "<img src='{$image_url}' class='image' alt='overlay_image' > ";
        } else {
            if ( $icon != '' ) $icon_html = "<i class='{$icon}'></i>";
        }

        if ( $icon_html != '' || $hover_text  != '' ) {
            $output .= "<div class='overlay'><div class='overlay-content {$icon_position}'>";
            if ( $icon_position == 'icon-left' || $icon_position == 'icon-top' )
                $output .= $icon_html . $hover_text;
            else
                $output .= $hover_text . $icon_html ;
            $output .= "</div></div>"; //overlay-content overlay

        }

        $output .= "</div>";

		if( $lightbox != 'no' || ( $lightbox == 'no' && $link != '' ) ) {
			$output .= "</a>";
		}
		$output .= "</div>";
		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "Single Image", 'cumulo_plugin' ),
    "base" => "cmo_single_image",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_singleimage.png', dirname( __FILE__ ) ),
    "params" => array (
        array (
            "type" => "attach_image",
            "heading" => __ ( "Image", 'cumulo_plugin' ),
            "param_name" => "image",
            "admin_label" => true,
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Title", 'cumulo_plugin' ),
            "param_name" => "title",
            "value" => '',
            "admin_label" => true,
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Alt", 'cumulo_plugin' ),
            "param_name" => "alt",
            "value" => '',
            "admin_label" => true,
        ),
        array (
            "type" => "dropdown",
            "heading" => __ ( "Use Lightbox", 'cumulo_plugin' ),
            "param_name" => "lightbox",
            "value" => array (
                __ ( "No", 'cumulo_plugin' ) => 'no',
                __ ( "Image", 'cumulo_plugin' ) => 'image',
                __ ( "Youtube/Vimeo Video", 'cumulo_plugin' ) => 'video-embed',
            ),
        ),
        array (
            "type" => "attach_image",
            "heading" => __ ( "Lightbox Image", 'cumulo_plugin' ),
            "param_name" => "lightbox_image",
            'dependency' => array(
                'element' => 'lightbox',
                'value' => 'image',
            ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Lightbox Youtube/Vimeo URL", 'cumulo_plugin' ),
            "param_name" => "lightbox_video",
            'dependency' => array(
                'element' => 'lightbox',
                'value' => 'video-embed',
            ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Lightbox ID", 'cumulo_plugin' ),
            "param_name" => "lightbox_id",
            'dependency' => array(
                'element' => 'lightbox',
                'value' => array( 'image', 'video-embed' )
            ),
            "description" => __( "This field is only used when lightbox is used.", 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Open Link", 'cumulo_plugin' ),
            "param_name" => "link",
            "value" => '',
            "dependency" => array(
                'element' => 'lightbox',
                'value' => 'no',
            ),
        ),
        array (
            "type" => "dropdown",
            "heading" => __ ( "Link Target", 'cumulo_plugin' ),
            "param_name" => "link_target",
            "value" => array (
                __ ( "_self (same window)", 'cumulo_plugin' ) => '_self',
                __ ( "_blank (new window)", 'cumulo_plugin' ) => '_blank'
            ),
            "dependency" => array(
                'element' => 'lightbox',
                'value' => 'no',
            ),
        ),
        array (
            "type" => "dropdown",
            "heading" => __ ( "Align", 'cumulo_plugin' ),
            "param_name" => "align",
            "value" => array (
                __ ( "Center", 'cumulo_plugin' ) => 'center',
                __ ( "Left", 'cumulo_plugin' ) => 'left',
                __ ( "Right", 'cumulo_plugin' ) => 'right',
                __ ( "Full Width (Scales up image)", 'cumulo_plugin' ) => 'full',
            ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Border Width (px)", 'cumulo_plugin' ),
            "param_name" => "border_width",
        ),
        array (
            'type' => 'colorpicker',
            "heading" => __ ( "Border Color", 'cumulo_plugin' ),
            "param_name" => "border_color",
            "description" => __( "This field works only when border width is set.", 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Height", 'cumulo_plugin' ),
            "param_name" => "image_height",
            "value" => '',
            "description" => __( "Put in fixed height in pixels or leave blank to use the image height.", 'cumulo_plugin' ),
        ),
        css_animation_class(),
        extra_class (),
        array (
            'type' => 'colorpicker',
            "heading" => __ ( "Overlay Color", 'cumulo_plugin' ),
            "param_name" => "overlay_color",
            "group" => "Overlay",
        ),
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
            'group' => __( 'Overlay', 'cumulo_plugin' ),
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
            'group' => __( 'Overlay', 'cumulo_plugin' ),
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
            'group' => __( 'Overlay', 'cumulo_plugin' ),
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
            'group' => __( 'Overlay', 'cumulo_plugin' ),
        ),
        array (
            "type" => "attach_image",
            "heading" => __ ( "Image", 'cumulo_plugin' ),
            "param_name" => "overlay_image",
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'image',
            ),
            'description' => __( 'Select image.', 'cumulo_plugin' ),
            'group' => __( 'Overlay', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Position', 'cumulo_plugin' ),
            'value' => array(
                __( 'Left', 'cumulo_plugin' ) => 'icon-left',
                __( 'Right', 'cumulo_plugin' ) => 'icon-right',
                __( 'Top', 'cumulo_plugin' ) => 'icon-top',
                __( 'Bottom', 'cumulo_plugin' ) => 'icon-bottom',
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'not_empty' => true,
            ),
            'param_name' => 'icon_position',
            'group' => __( 'Overlay', 'cumulo_plugin' ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Text", 'cumulo_plugin' ),
            "param_name" => "hover_text",
            'group' => __( 'Overlay', 'cumulo_plugin' ),
        ),
    )
) );
