<?php

class CUMULO_CSS_Generator {
	private $class;
	private $id;
	
	public function __construct( $class, $id ) {
		$this->class = $class;
		$this->id = $id;
	}
	public function css( $selector, $params ) {
		$css = ".{$this->class}#{$this->id} {$selector}{";
		if( is_array( $params ) ) {
			foreach( $params as $param_key => $param_value ) {
				$css .= "{$param_key}:{$param_value};";
			}
		}
		$css .= "}";
		return $css;
	}
	public function css_with_self_condition( $self_condition, $selector, $params ) {
		$css = ".{$this->class}#{$this->id}{$self_condition} {$selector}{";
		if( is_array( $params ) ) {
			foreach( $params as $param_key => $param_value ) {
				$css .= "{$param_key}:{$param_value};";
			}
		}
		$css .= "}";
		return $css;
	} 
}

function cmo_render_view($template_name, $view_variables = array(), $return = true) {
    extract($view_variables, EXTR_REFS);

    $file_path = SHORTCODE_TEMPLATE_PATH . $template_name . '.php';

    unset($view_variables);

    if ($return) {
        ob_start();

        require $file_path;

        return ob_get_clean();
    } else {
        require $file_path;
    }
}

/* Helper Functions */
function icon_input($heading, $default_value, $param_name = "icon") {
	return array (
			"type" => "textfield",
			"heading" => $heading,
			"param_name" => $param_name,
			"value" => $default_value,
			"description" => __ ( "Enter CSS class name of Font Awesome icon font, ex: fa-plus. You can get it <a href='http://fortawesome.github.io/Font-Awesome/icons/'>here</a>.", 'cumulo_plugin' )
	);
}
function icon_input_with_admin_label($heading, $default_value, $param_name = "icon") {
	return array (
			"type" => "textfield",
			"heading" => $heading,
			"param_name" => $param_name,
			"value" => $default_value,
			"admin_label" => true,
			"description" => __ ( "Enter CSS class name of Font Awesome icon font, ex: fa-plus. You can get it <a href='http://fortawesome.github.io/Font-Awesome/icons/'>here</a>.", 'cumulo_plugin' )
	);
}
function css_animation_class( $param_name = 'css_animation', $heading = '', $group = '' ) {
	if( $heading == '' ) {
		$heading = __ ( 'CSS Animation', 'cumulo_plugin' );
	}
	return array (
			'type' => 'dropdown',
			'heading' => $heading,
			'param_name' => $param_name,
			'admin_label' => true,
			'value' => array (
					__ ( 'None', 'cumulo_plugin' ) => '',
					__( "bounce", 'cumulo_plugin' ) => "bounce",
					__( "flash", 'cumulo_plugin' ) => "flash",
					__( "pulse", 'cumulo_plugin' ) => "pulse",
					__( "rubberBand", 'cumulo_plugin' ) => "rubberBand",
					__( "shake", 'cumulo_plugin' ) => "shake",
					__( "swing", 'cumulo_plugin' ) => "swing",
					__( "tada", 'cumulo_plugin' ) => "tada",
					__( "wobble", 'cumulo_plugin' ) => "wobble",
					__( "jello", 'cumulo_plugin' ) => "jello",
					__( "bounceIn", 'cumulo_plugin' ) => "bounceIn",
					__( "bounceInDown", 'cumulo_plugin' ) => "bounceInDown",
					__( "bounceInLeft", 'cumulo_plugin' ) => "bounceInLeft",
					__( "bounceInRight", 'cumulo_plugin' ) => "bounceInRight",
					__( "bounceInUp", 'cumulo_plugin' ) => "bounceInUp",
					__( "bounceOut", 'cumulo_plugin' ) => "bounceOut",
					__( "bounceOutDown", 'cumulo_plugin' ) => "bounceOutDown",
					__( "bounceOutLeft", 'cumulo_plugin' ) => "bounceOutLeft",
					__( "bounceOutRight", 'cumulo_plugin' ) => "bounceOutRight",
					__( "bounceOutUp", 'cumulo_plugin' ) => "bounceOutUp",
					__( "fadeIn", 'cumulo_plugin' ) => "fadeIn",
					__( "fadeInDown", 'cumulo_plugin' ) => "fadeInDown",
					__( "fadeInDownBig", 'cumulo_plugin' ) => "fadeInDownBig",
					__( "fadeInLeft", 'cumulo_plugin' ) => "fadeInLeft",
					__( "fadeInLeftBig", 'cumulo_plugin' ) => "fadeInLeftBig",
					__( "fadeInRight", 'cumulo_plugin' ) => "fadeInRight",
					__( "fadeInRightBig", 'cumulo_plugin' ) => "fadeInRightBig",
					__( "fadeInUp", 'cumulo_plugin' ) => "fadeInUp",
					__( "fadeInUpBig", 'cumulo_plugin' ) => "fadeInUpBig",
					__( "fadeOut", 'cumulo_plugin' ) => "fadeOut",
					__( "fadeOutDown", 'cumulo_plugin' ) => "fadeOutDown",
					__( "fadeOutDownBig", 'cumulo_plugin' ) => "fadeOutDownBig",
					__( "fadeOutLeft", 'cumulo_plugin' ) => "fadeOutLeft",
					__( "fadeOutLeftBig", 'cumulo_plugin' ) => "fadeOutLeftBig",
					__( "fadeOutRight", 'cumulo_plugin' ) => "fadeOutRight",
					__( "fadeOutRightBig", 'cumulo_plugin' ) => "fadeOutRightBig",
					__( "fadeOutUp", 'cumulo_plugin' ) => "fadeOutUp",
					__( "fadeOutUpBig", 'cumulo_plugin' ) => "fadeOutUpBig",
					__( "flip", 'cumulo_plugin' ) => "flip",
					__( "flipInX", 'cumulo_plugin' ) => "flipInX",
					__( "flipInY", 'cumulo_plugin' ) => "flipInY",
					__( "flipOutX", 'cumulo_plugin' ) => "flipOutX",
					__( "flipOutY", 'cumulo_plugin' ) => "flipOutY",
					__( "lightSpeedIn", 'cumulo_plugin' ) => "lightSpeedIn",
					__( "lightSpeedOut", 'cumulo_plugin' ) => "lightSpeedOut",
					__( "rotateIn", 'cumulo_plugin' ) => "rotateIn",
					__( "rotateInDownLeft", 'cumulo_plugin' ) => "rotateInDownLeft",
					__( "rotateInDownRight", 'cumulo_plugin' ) => "rotateInDownRight",
					__( "rotateInUpLeft", 'cumulo_plugin' ) => "rotateInUpLeft",
					__( "rotateInUpRight", 'cumulo_plugin' ) => "rotateInUpRight",
					__( "rotateOut", 'cumulo_plugin' ) => "rotateOut",
					__( "rotateOutDownLeft", 'cumulo_plugin' ) => "rotateOutDownLeft",
					__( "rotateOutDownRight", 'cumulo_plugin' ) => "rotateOutDownRight",
					__( "rotateOutUpLeft", 'cumulo_plugin' ) => "rotateOutUpLeft",
					__( "rotateOutUpRight", 'cumulo_plugin' ) => "rotateOutUpRight",
					__( "slideInUp", 'cumulo_plugin' ) => "slideInUp",
					__( "slideInDown", 'cumulo_plugin' ) => "slideInDown",
					__( "slideInLeft", 'cumulo_plugin' ) => "slideInLeft",
					__( "slideInRight", 'cumulo_plugin' ) => "slideInRight",
					__( "slideOutUp", 'cumulo_plugin' ) => "slideOutUp",
					__( "slideOutDown", 'cumulo_plugin' ) => "slideOutDown",
					__( "slideOutLeft", 'cumulo_plugin' ) => "slideOutLeft",
					__( "slideOutRight", 'cumulo_plugin' ) => "slideOutRight",
					__( "zoomIn", 'cumulo_plugin' ) => "zoomIn",
					__( "zoomInDown", 'cumulo_plugin' ) => "zoomInDown",
					__( "zoomInLeft", 'cumulo_plugin' ) => "zoomInLeft",
					__( "zoomInRight", 'cumulo_plugin' ) => "zoomInRight",
					__( "zoomInUp", 'cumulo_plugin' ) => "zoomInUp",
					__( "zoomOut", 'cumulo_plugin' ) => "zoomOut",
					__( "zoomOutDown", 'cumulo_plugin' ) => "zoomOutDown",
					__( "zoomOutLeft", 'cumulo_plugin' ) => "zoomOutLeft",
					__( "zoomOutRight", 'cumulo_plugin' ) => "zoomOutRight",
					__( "zoomOutUp", 'cumulo_plugin' ) => "zoomOutUp",
					__( "hinge", 'cumulo_plugin' ) => "hinge",
					__( "rollIn", 'cumulo_plugin' ) => "rollIn",
					__( "rollOut", 'cumulo_plugin' ) => "rollOut",
			),
			'description' => __ ( 'Select type of animation from if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'cumulo_plugin' ),
            'group' => __( $group, 'cumulo_plugin' )
	);
}
function get_css_animation( $css_animation ) {
	if( $css_animation != '' ) {
		return " wow " . $css_animation;
	} else {
		return "";
	}
}
function extra_class($group = false) {
	$extra = array (
			'type' => 'textfield',
			'heading' => __ ( 'Extra class name', 'cumulo_plugin' ),
			'param_name' => 'el_class',
			'description' => __ ( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'cumulo_plugin' )
	);
	if ($group) {
		$extra ['group'] = $group;
	}
	return $extra;
}
function colors_array() {
	return array(
		__( 'Grey', 'cumulo_plugin' ) => 'wpb_button',
		__( 'Blue', 'cumulo_plugin' ) => 'btn-primary',
		__( 'Turquoise', 'cumulo_plugin' ) => 'btn-info',
		__( 'Green', 'cumulo_plugin' ) => 'btn-success',
		__( 'Orange', 'cumulo_plugin' ) => 'btn-warning',
		__( 'Red', 'cumulo_plugin' ) => 'btn-danger',
		__( 'Black', 'cumulo_plugin' ) => "btn-inverse"
	);
}
function selected_icon( $icon_type, $icon_fa, $icon_etline, $icon_linecons ) {
    if( $icon_type == 'etline' ) {
        return $icon_etline;
    } else if( $icon_type == 'fa' ) {
        return $icon_fa;
    } else if( $icon_type == 'linecons' ) {
        $icon = str_ireplace( 'vc_', '', $icon_linecons );
        $icon = str_ireplace( 'li ', '', $icon );
        return $icon;
    } else {
        return '';
    }

}
function add_style( $style, $css_to_add ) {
	if( $style == '' ) {
		$style = ' style=""';
	}
	$len = strlen( $style );
	return substr( $style, 0, $len - 1 ) . $css_to_add . '"';
}
function shortcode_unique_id( $shortcode_name ) {
	if (empty ( $GLOBALS ['cmo_shortcode_counter'] ))
		$GLOBALS ['cmo_shortcode_counter'] = 0;
	$GLOBALS ['cmo_shortcode_counter'] ++;
	$id = $shortcode_name . "-" . $GLOBALS ['cmo_shortcode_counter'];
	return $id;
}

/* Initialization of Shortcodes */
function init_shortcodes() {
	if( class_exists( 'Vc_Manager' ) ) {

		vc_disable_frontend ();

		if( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
			vc_set_shortcodes_templates_dir ( dirname(  __FILE__ ) . '/vc_templates' );
		}

		if (!function_exists('add_css_animation_css')) { add_filter ( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'add_css_animation_css', 10, 3 ) ; } 

        vc_remove_element ( 'vc_btn' );
        vc_remove_element ( 'vc_cta' );
//        vc_remove_element ( 'vc_icon' );
        vc_remove_element ( 'vc_single_image' );
//        vc_remove_element ( 'vc_message' );
        vc_remove_element ( 'vc_gallery' );
        vc_remove_element ( 'vc_images_carousel' );
        vc_remove_element ( 'vc_carousel' );
        vc_remove_element ( 'vc_progress_bar' );
        vc_remove_element ( 'vc_posts_slider' );
        vc_remove_element ( 'vc_basic_grid' );
        vc_remove_element ( 'vc_masonry_grid' );
        vc_remove_element ( 'vc_wp_search' );
        vc_remove_element ( 'vc_wp_meta' );
        vc_remove_element ( 'vc_wp_recentcomments' );
        vc_remove_element ( 'vc_wp_calendar' );
        vc_remove_element ( 'vc_wp_pages' );
        vc_remove_element ( 'vc_wp_tagcloud' );
        vc_remove_element ( 'vc_wp_custommenu' );
        vc_remove_element ( 'vc_wp_text' );
        vc_remove_element ( 'vc_wp_posts' );
        vc_remove_element ( 'vc_wp_categories' );
        vc_remove_element ( 'vc_wp_archives' );
        vc_remove_element ( 'vc_wp_rss' );

        require_once( __DIR__ . '/vc_column.php' );
        require_once( __DIR__ . '/vc_row.php' );
        require_once( __DIR__ . '/vc_separator.php' );

        require_once( __DIR__ . '/accordion-tab.php' );
        require_once( __DIR__ . '/accordion.php' );
        require_once( __DIR__ . '/button.php' );
        require_once( __DIR__ . '/callout.php' );
        require_once( __DIR__ . '/content-box.php' );
        require_once( __DIR__ . '/data-counter.php' );
        require_once( __DIR__ . '/dropcap.php' );
        require_once( __DIR__ . '/feature-box.php' );
        require_once( __DIR__ . '/icon.php' );
        require_once( __DIR__ . '/icon-list.php' );
        require_once( __DIR__ . '/icon-list-item.php' );
        require_once( __DIR__ . '/image-box.php' );
        require_once( __DIR__ . '/image-carousel.php' );
        require_once( __DIR__ . '/pricing-column.php' );
        require_once( __DIR__ . '/progress-bar.php' );
        require_once( __DIR__ . '/section-header.php' );
        require_once( __DIR__ . '/single-image.php' );
        require_once( __DIR__ . '/social-links.php' );
        require_once( __DIR__ . '/tab.php' );
        require_once( __DIR__ . '/tabs.php' );
        require_once( __DIR__ . '/table_data.php' );
        require_once( __DIR__ . '/team-member.php' );
        require_once( __DIR__ . '/testimonial-slider-item.php' );
        require_once( __DIR__ . '/testimonial-slider.php' );
        require_once( __DIR__ . '/vertical-tabs.php' );

        require_once( __DIR__ . '/bloglist.php' );
        require_once( __DIR__ . '/posts-carousel.php' );
        require_once( __DIR__ . '/woo-carousel.php' );
        require_once( __DIR__ . '/faq.php' );
        require_once( __DIR__ . '/faq-item.php' );
        require_once( __DIR__ . '/countdown-timer.php' );
        require_once( __DIR__ . '/portfolio.php' );
        
        require_once( __DIR__ . '/google-map.php' );

        require_once( __DIR__ . '/typing.php' );
        require_once( __DIR__ . '/contact-info.php' );
        require_once( __DIR__ . '/link.php' );
        require_once( __DIR__ . '/footer-social.php' );
        require_once( __DIR__ . '/footer-logo.php' );
        require_once( __DIR__ . '/restaurant-menu-item.php' );
	}
}
add_action( 'vc_before_init', 'init_shortcodes' );