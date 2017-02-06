<?php

class WPBakeryShortCode_cmo_testimonial_item extends WPBakeryShortCode {
	function content($atts, $content = null) {
		extract ( shortcode_atts ( array (
            'style' => 'style1',
            'name' => '',
            'position' => '',
            'name_style' => 'single',
            'avatar' => '',
            'el_class' => ''
		), $atts ) );

		$css_class = "cmo-testimonial-item";
		$css_class .= $this->getExtraClass ( $el_class );

        $output = '';
        $output .= "<div class=\"{$css_class}\">";

        $avatar_html = '';
        if ($avatar != '') {
            $image = wp_get_attachment_url( $avatar );
            $avatar_html = "<div class='avatar-wrapper'>";
            $avatar_html .= "<img class='avatar' src='{$image}' alt='Testimonial Avatar'>";
            $avatar_html .= "</div>";
        }

        $name_html = "";
        if ( $name_style == 'single' ) {
            $name_html .= "<p class='single-line'>";
            if ( $name != '' )
                $name_html .= "<span class='name'>{$name}</span>";
            if ( $position != '' )
                $name_html .= "<span class='position'>&nbsp;&nbsp;-&nbsp;&nbsp;{$position}</span>";
            $name_html .= "</p>";
        } else {
            if( $name != '' ) {
                $name_html .= "<p><span class='name'>{$name}</span></p>";
            }
            if( $position != '' ) {
                $name_html .= "<p><span class='position'>{$position}</span></p>";
            }
        }

        if ( $style == 'style1') {
            $output .= $avatar_html . $name_html;
            $output .= "<p class='testimonial'>{$content}</p>";
        } else {
            $output .= "<p class='testimonial'>{$content}</p>";
            $output .= $avatar_html . $name_html;
        }

		$output .= "</div>\n";
		
		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "Testimonial Item", 'cumulo_plugin' ),
    "base" => "cmo_testimonial_item",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_testimonial.png', dirname( __FILE__ ) ),
    "as_child" => array( 'only' => 'cmo_testimonial_slider' ),
    "content_element" => true,
    "params" => array (
        array (
            "type" => "attach_image",
            "heading" => __ ( "Avatar", 'cumulo_plugin' ),
            "param_name" => "avatar",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Name", 'cumulo_plugin' ),
            "param_name" => "name",
            "value" => '',
            "admin_label" => true
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Position", 'cumulo_plugin' ),
            "param_name" => "position",
            "value" => '',
            "admin_label" => true
        ),
        array (
            "type" => "textarea",
            "heading" => __ ( "Testimonial Text", 'cumulo_plugin' ),
            "param_name" => "content",
            "value" => '',
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Style', 'cumulo_plugin' ),
            'value' => array(
                __( 'Profile before testimonial', 'cumulo_plugin' ) => 'style1',
                __( 'Profile after testimonial', 'cumulo_plugin' ) => 'style2'
            ),
            'param_name' => 'style',
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Name / Position style', 'cumulo_plugin' ),
            'value' => array(
                __( 'Single line', 'cumulo_plugin' ) => 'single',
                __( 'Separate lines', 'cumulo_plugin' ) => 'separate',
            ),
            'param_name' => 'name_style',
        ),
        extra_class ()
    )
) );
