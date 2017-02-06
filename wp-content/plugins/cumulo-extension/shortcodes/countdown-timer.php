<?php
class WPBakeryShortCode_cmo_countdown_timer extends WPBakeryShortCode {

	function content($atts, $content = null) {
        add_action('wp_footer', 'include_momentjs' );

		extract ( shortcode_atts ( array (
            'end' => '',
            'show' => 'mdhis',
            'margin'    => '30',
            'size' => '100',
            'track_size' => '5',
            'fill_color' => cmo_get_theme_mod_value('primary-color'),
            'track_color' => cmo_get_theme_mod_value('border-color'),
            'inner_color' => cmo_get_theme_mod_value('bg-color'),
            'number_color' => cmo_get_theme_mod_value('heading-color'),
            'caption_color' => cmo_get_theme_mod_value('text-color'),
            'el_class' => '',
        ), $atts ) );

        $style = "";
        $id = uniqid( "countdown_timer_" );
        $classes = "cmo-timer-wrapper" . $this->getExtraClass( $el_class );

        $captions = array ( 
            "Months"    =>  5,
            "Days"      =>  4,
            "Hours"     =>  3,
            "Minutes"   =>  2,
            "Seconds"   =>  1
        );
        $track = $size / 2 - $track_size;
        
        $style = '<style scoped>';
        ob_start(); ?>
#<?php echo esc_attr( $id )?>.cmo-timer-wrapper .cmo-timer-el .svg-wrapper:after {
	color: <?php echo esc_attr( $number_color ); ?>;
}
#<?php echo esc_attr( $id )?>.cmo-timer-wrapper .cmo-timer-el .cmo-timer-caption {
	color: <?php echo esc_attr( $caption_color ); ?>;
}
#<?php echo esc_attr( $id )?>.cmo-timer-wrapper .cmo-timer-el {
	margin-right: <?php echo esc_attr( $margin ); ?>px;
}
<?php
		$style .= ob_get_clean();
		$style .= '</style>';

        $output = $style . '<div id="' . esc_attr($id) . '" class="' . esc_attr($classes) . '" data-ending="' .  strtotime( $end ) . '" data-show="' . strlen($show) . '">';
        foreach ( $captions as $caption=>$count ) {
        	if ( strlen($show) >= $count ) {
        		$output .= sprintf( "<div class='cmo-timer-el cmo-timer-el-%s'><div class='svg-wrapper' data-pct='' data-rel=''>", esc_attr( $caption ) );
        		$output .= sprintf( '<svg width="%s" height="%s" version="1.1" xmlns="http://www.w3.org/2000/svg" data-radius="%s" data-ctx="%s" data-cty="%s">
<circle class="cmo-timer-innerfill" r="%s" cx="%s" cy="%s" fill="%s" stroke-width="0" stroke="transparent" />
<path class="cmo-timer-track" d="" fill="transparent" stroke="%s" stroke-width="%s" />
<path class="cmo-timer-fill" d="" fill="transparent" stroke="%s" stroke-width="%s" />
<circle class="cmo-timer-zero" r="%s" cx="%s" cy="%s" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0" stroke-width="%s" stroke="%s" />
</svg>',
        				esc_attr( $size ), esc_attr( $size ),
        				esc_attr( $size / 2 - $track_size ), esc_attr( $size / 2 ), esc_attr( $size / 2 ),
        				
        				esc_attr( $size / 2 - $track_size ), esc_attr( $size / 2 ), esc_attr( $size / 2), esc_attr( $inner_color ),
        				esc_attr( $fill_color ), esc_attr( $track_size ),
        				esc_attr( $track_color ), esc_attr( $track_size ),
        				esc_attr( $size / 2 - $track_size ), esc_attr( $size / 2 ), esc_attr( $size / 2), esc_attr( $track_size ), esc_attr( $track_color )  
        		);
        		$output .= "</div>";
        		$output .= "<div class='cmo-timer-caption'>" . esc_html( $caption ) . "</div>";
        		$output .= "</div>";
        	}
        }

        $output .= '</div>';
		return $output;
	}
}

function include_momentjs () {
    wp_enqueue_script( 'momentjs', plugins_url( 'cumulo-extension/assets/js/moment.js' ) );
}

vc_map ( array (
    "name" => __ ( "Countdown Timer", 'cumulo_plugin' ),
    "base" => "cmo_countdown_timer",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_countdown.png', dirname( __FILE__ ) ),
    "params" => array (
        array (
            "type" => "textfield",
            "heading" => __ ( "Ending DateTime", 'cumulo_plugin' ),
            "param_name" => "end",
            "value" => '',
            'description' => __( 'Format: YYYY-MM-DD HH:mm:ss. ex: ' , 'cumulo_plugin' ) . date("Y-m-d H:i:s", strtotime("+3 months") ),
            "admin_label" => true,
        ),
        array (
            'type' => 'dropdown',
            'heading' => __( 'Show', 'cumulo_plugin' ),
            'param_name' => 'show',
            'value' => array(
                __( "MM DD HH mm ss", 'cumulo_plugin' ) => 'mdhis',
                __( "DD HH mm ss", 'cumulo_plugin' ) => 'dhms',
            ),
            'description' => __( 'Hidding Year, Month or Days is just hiding without extra calculation of months or days')
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Size In Pixel", 'cumulo_plugin' ),
            "param_name" => "size",
            "value" => 100,
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Track Size In Pixel", 'cumulo_plugin' ),
            "param_name" => "track_size",
            "value" => 5,
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Margin In Pixel", 'cumulo_plugin' ),
            "param_name" => "margin",
            "value" => 30,
        ),
        array (
            'type' => 'colorpicker',
            'heading' => 'Fill Color',
            'param_name' => 'fill_color',
            'value' => '',
            'description' => __( 'Leave it empty for theme primary color', 'cumulo_plugin' ),
        ),
        array (
            'type' => 'colorpicker',
            'heading' => 'Track Color',
            'param_name' => 'track_color',
            'value' => '',
            'description' => __( 'Leave it empty for theme border color', 'cumulo_plugin' ),
        ),
        array (
            'type' => 'colorpicker',
            'heading' => 'Background Color',
            'param_name' => 'inner_color',
            'value' => '',
            'description' => __( 'Leave it empty for theme primary background color', 'cumulo_plugin' ),
        ),
        array (
            'type' => 'colorpicker',
            'heading' => 'Numbers Color',
            'param_name' => 'number_color',
            'value' => '',
            'description' => __( 'Leave it empty for theme heading color', 'cumulo_plugin' ),
        ),
        array (
            'type' => 'colorpicker',
            'heading' => 'Caption Color',
            'param_name' => 'caption_color',
            'value' => '',
            'description' => __( 'Leave it empty for theme text color', 'cumulo_plugin' ),
        ),
        extra_class ()
    )
) );