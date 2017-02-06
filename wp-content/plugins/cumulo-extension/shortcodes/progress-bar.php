<?php

class WPBakeryShortCode_cmo_progress_bar extends WPBakeryShortCode {
	function content($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'title' => '',
            'value' => '50',
            'value_position' => '',
            'show_symbol' => 'yes',
            'value_over_bar' => '',
            'value_position_vertical' => 'value_top',
            'value_background' => '',
            'value_background_color' => '',
            'bar_height' => '3',
//            'css_animation' => '',
            'el_class' => '',
            'title_color' => '',
            'bar_color' => '',
        ), $atts));

        $css_class = "cmo-progress-bar wpb_content_element ";
        $css_class .= " " . $value_position;
        $css_class .= " " . $value_over_bar;
//        $css_class .= get_css_animation($css_animation);
        $css_class .= $this->getExtraClass($el_class);

        $css_style = '';
        $id = shortcode_unique_id( "cmo-progress-bar" );
        $css_gen = new CUMULO_CSS_Generator( "cmo-progress-bar", $id );
        $css_style .= $css_gen->css( ".meter", array( 'height' => $bar_height . 'px') );
        $css_style .= $css_gen->css( ".gauge", array( 'height' => $bar_height . 'px') );

        if( $title_color != '' ) {
            $css_style .= $css_gen->css( ".title", array( 'color' => $title_color ) );
        }
        if( $bar_color != '' ) {
            $css_style .= $css_gen->css( ".meter", array( 'color' => $bar_color ) );
            $css_style .= $css_gen->css( ".gauge", array( 'background-color' => $bar_color ) );
        }

        if ( $value_background == 'bar-color' ) {
            $css_style .= $css_gen->css( ".value.background-set", array( 'background-color' => $bar_color) );
            $css_style .= $css_gen->css( ".value.background-set", array( 'background-color' => $bar_color) );
            $css_style .= $css_gen->css( ".value.background-set:after", array( 'border-color' => $bar_color) );
        } else if ( $value_background == 'custom' ) {
            if ($value_background_color != '') {
                $css_style .= $css_gen->css( ".value.background-set", array( 'background-color' => $value_background_color) );
                $css_style .= $css_gen->css( ".value.background-set:after", array( 'border-color' => $value_background_color) );
            }
        }

        $output = '';
        $output .= "<div class='{$css_class}' id='{$id}' data-value='{$value}'>";
        if( $css_style != '' ) {
            $output .= "<style scoped>{$css_style}</style>";
        }
        $output .= "<h4 class='title'>{$title}</h4>";
        $output .= "<div class='meter'>";

        $background_set = $value_background == '' ? '' : 'background-set';
        $symbol = $show_symbol == 'yes' ? '%' : '';
        if ($value_position == 'value-right')  { // default
            $output .= "<div class='gauge'>";
            $output .= "</div>";
            $output .= "<div class='value {$background_set}'><span>{$value}</span>{$symbol}</div>";
        } else {
            $output .= "<div class='gauge'>";
            $output .= "<div class='value {$background_set}'><span>{$value}</span>{$symbol}</div>";
            $output .= "</div>";
        }
		$output .= "</div>";
		$output .= "</div>\n";
		
		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "Progress Bar", 'cumulo_plugin' ),
    "base" => "cmo_progress_bar",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_progressbar.png', dirname( __FILE__ ) ),
    "params" => array (
        array (
            "type" => "textfield",
            "heading" => __ ( "Title", 'cumulo_plugin' ),
            "param_name" => "title",
            "value" => __ ( "Title", 'cumulo_plugin' ),
            "admin_label" => true,
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Percentage Value", 'cumulo_plugin' ),
            "param_name" => "value",
            "value" => "50",
            "admin_label" => true,
        ),
        array (
            'type' => 'dropdown',
            'heading' => __( 'Show percent (%) symbol', 'cumulo_plugin' ),
            'param_name' => 'show_symbol',
            'value' => array(
                __( "Show", 'cumulo_plugin' ) => 'yes',
                __( "Hide", 'cumulo_plugin' ) => 'no',
            ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Progress Bar Thickness", 'cumulo_plugin' ),
            "param_name" => "bar_height",
            "value" => "3"
        ),
        array (
            'type' => 'dropdown',
            'heading' => __( 'Value Position', 'cumulo_plugin' ),
            'param_name' => 'value_position',
            'value' => array(
                __( "Default", 'cumulo_plugin' ) => '',
                __( "Pull Right", 'cumulo_plugin' ) => 'value-right',
            )
        ),
        array (
            'type' => 'dropdown',
            'heading' => __( 'Value Over Bar', 'cumulo_plugin' ),
            'param_name' => 'value_over_bar',
            'value' => array(
                __( "Over", 'cumulo_plugin' ) => '',
                __( "Below", 'cumulo_plugin' ) => 'value-below-bar',
            )
        ),
//        css_animation_class(),
        extra_class (),
        array(
            'type' => 'colorpicker',
            'heading' => 'Title Color',
            'param_name' => 'title_color',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' ),
            'description' => __( 'Leave blank to use default text color.', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Bar Color',
            'param_name' => 'bar_color',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' ),
            'description' => __( 'Leave blank to use primary color.', 'cumulo_plugin' ),
        ),
        array (
            'type' => 'dropdown',
            'heading' => __( 'Gauge Value Background Color', 'cumulo_plugin' ),
            'param_name' => 'value_background',
            'value' => array(
                __( "Not set", 'cumulo_plugin' ) => '',
                __( "Same as bar color", 'cumulo_plugin' ) => 'bar-color',
                __( "Custom", 'cumulo_plugin' ) => 'custom',
            ),
            'group' => __( 'Colors', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => 'Value Background Color',
            'param_name' => 'value_background_color',
            'value' => '',
            'dependency' => array(
                'element' => 'value_background',
                'value' => 'custom',
            ),
            'group' => __( 'Colors', 'cumulo_plugin' ),
            'description' => __( 'Leave blank to use primary color.', 'cumulo_plugin' ),
        ),
    )
) );
