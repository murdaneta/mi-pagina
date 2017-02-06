<?php

class WPBakeryShortCode_cmo_image_carousel extends WPBakeryShortCode {
	function content($atts, $content = null) {
		extract ( shortcode_atts ( array (
            'images' => '',
            'items' => '4',
            'navcontrol' => '',
            'navcontrol_color' => '',
            'el_class' => '',
		), $atts ) );
		
		$css_class = "cmo-image-carousel wpb_content_element";
//		if( $navcontrol ) {
//			$css_class .= " navcontrol-" . $navcontrol;
//		}
		$css_class .= $this->getExtraClass ( $el_class );
		$id = shortcode_unique_id( "cmo-image-carousel" );
		
		$image_ids = explode( ',', $images );
		
		$output = '';
		$output .= "<div class='{$css_class}' id='{$id}' data-items='{$items}'>";
		$output .= "<div class='owl-carousel'>";
		foreach( $image_ids as $image_id ) {
			$image = wp_get_attachment_url( $image_id );
			$output .= "<div class='item'>";
			$output .= "<img src='{$image}' alt='Carousel Image'>";
			$output .= "</div>";
		}
		$output .= "</div>";
		
		$output .= "<div class='carousel-controls'>";
		$output .= "<a class='carousel-control prev' href='#'><i class='fa fa-angle-left'></i></a>";
		$output .= "<a class='carousel-control next' href='#'><i class='fa fa-angle-right'></i></a>";
		$output .= "</div>";
		
		$output .= "</div>\n";
		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "Image Carousel", 'cumulo_plugin' ),
    "base" => "cmo_image_carousel",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_imagecarousel.png', dirname( __FILE__ ) ),
    "params" => array (
        array (
            "type" => "attach_images",
            "heading" => __ ( "Images", 'cumulo_plugin' ),
            "param_name" => "images",
            "admin_label" => true
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Items", 'cumulo_plugin' ),
            "param_name" => "items",
            "value" => '4',
            "admin_label" => true
        ),
        extra_class ()
    )
) );
