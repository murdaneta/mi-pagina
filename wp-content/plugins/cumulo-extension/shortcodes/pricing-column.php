<?php

class WPBakeryShortCode_cmo_pricing_column extends WPBakeryShortCode {
	function content($atts, $content = null) {
		extract ( shortcode_atts ( array (
            'style' => 'style1',
            'title' => '',
            'price' => '',
            'price_currency' => '',
            'period' => '',
            'button_caption' => '',
            'button_link' => '',
            'featured' => '',
            'color' => '',
            'css_animation' => '',
            'el_class' => '',
		), $atts ) );
		
		$css_class = "cmo-pricing-column ";
        $css_class .= " " . $style;
        $css_class .= " " . $featured;

        if( $featured == 'yes' ) {
            $css_class .= " doption-primary-color-as-background";
        }
        $css_class .= get_css_animation( $css_animation );
		$css_class .= $this->getExtraClass ( $el_class );

        $css_style = '';
        $id = shortcode_unique_id( "cmo-content-box" );
        $css_gen = new CUMULO_CSS_Generator( "cmo-pricing-column", $id );

        if( $color != '' ) {
            if ($style == 'style1') {
                $css_style .= $css_gen->css_with_self_condition( ":hover", "", array( 'background-color' => $color ) );
                $css_style .= $css_gen->css_with_self_condition( ".featured", "", array( 'background-color' => $color ) );
                $css_style .= $css_gen->css_with_self_condition( ":not(:hover):not(.featured)", ".cmo-button", array( 'background-color' => $color ) );

            } else if ($style == 'style2') {
                $css_style .= $css_gen->css_with_self_condition( ":hover", "", array( 'border-color' => $color ) );
                $css_style .= $css_gen->css_with_self_condition( ".featured", "", array( 'border-color' => $color ) );
                $css_style .= $css_gen->css_with_self_condition( ":hover", ".price", array( 'color' => $color ) );
                $css_style .= $css_gen->css_with_self_condition( ".featured", ".price", array( 'color' => $color ) );
                $css_style .= $css_gen->css_with_self_condition( ":hover", ".cmo-button", array( 'background-color' => $color ) );
                $css_style .= $css_gen->css_with_self_condition( ".featured", ".cmo-button", array( 'background-color' => $color ) );
            }
        }

		$output = '';
        $output .= "<div class='{$css_class}' id='{$id}'>";
        if( $css_style != '' ) {
            $output .= "<style scoped>{$css_style}</style>";
        }

		if( $title ) {
			$output .= "<div class='title'><h3>{$title}</h3></div>";
		}

        $features_html = "<div class='features'>";
        $items = ( !empty ( $content ) ) ? explode ( "\n", trim ( $content ) ) : array ();
        foreach ( $items as $item ) {
            $features_html .= "<div class='feature'>{$item}</div>";
        }
        $features_html .= "</div>";

        $price_html = "";
		if( $price ) {
            $price_html .= "<div class='price'>";
            if ($style == 'style1')
                $price_html .= "<span class='number'><sup>{$price_currency}</sup>{$price}</span>";
            else if ($style == 'style2')
                $price_html .= "<span class='number'>{$price_currency}{$price}</span>";
            if( $period ) {
                $price_html .= "<span class='period'> / {$period}</span>";
            }
            $price_html .= "</div>";
		}

        if ($style == 'style1') {
            $output .= $features_html;
            $output .= $price_html;
        } else if ($style == 'style2') {
            $output .= $price_html;
            $output .= $features_html;
        }
		$output .= "<div class='footer'>";

//        if ($style == 'style1') {
            $output .= do_shortcode( "[cmo_button caption='{$button_caption}'  size='medium' link='{$button_link}' border_width='0'] " );
//        } else if ($style == 'style2') {
//            $output .= do_shortcode("[cmo_button caption='{$button_caption}' color='#ffffff' background_color='#dadada' size='medium' link='{$button_link}' border_width='0'] ");
//        }

//		$output .= "<a class='cmo-button' href='{$button_link}'><span>{$button_caption}</span></a>";

		$output .= "</div>";
		$output .= "</div>\n";
		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "Pricing Column", 'cumulo_plugin' ),
    "base" => "cmo_pricing_column",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_pricingcolumn.png', dirname( __FILE__ ) ),
    "content_element" => true,
    "params" => array (
        array (
            "type" => "dropdown",
            "heading" => __ ( "style", 'cumulo_plugin' ),
            "param_name" => "style",
            "value" => array (
                __ ( "Style 1 (Colored background)", 'cumulo_plugin' ) => 'style1',
                __ ( "Style 2 (Colored border)", 'cumulo_plugin' ) => 'style2',
            ),
            "description" => esc_html( __( "Enter the price, e.g: 39.99, 3 credits.", 'cumulo_plugin' ) ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Title", 'cumulo_plugin' ),
            "param_name" => "title",
            "value" => '',
            "admin_label" => true
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Price Text", 'cumulo_plugin' ),
            "param_name" => "price",
            "value" => '',
            "description" => esc_html( __( "Enter the price, e.g: 39.99, 3 credits.", 'cumulo_plugin' ) ),
            "admin_label" => true
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Price Currency", 'cumulo_plugin' ),
            "param_name" => "price_currency",
            "value" => '$',
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Period", 'cumulo_plugin' ),
            "param_name" => "period",
            "value" => '',
        ),
        array (
            "type" => "textarea",
            "heading" => __ ( "Features", 'cumulo_plugin' ),
            "param_name" => "content",
            "value" => '',
            "description" => esc_html( __( "Put each feature in new line. Simple HTML tags such as <strong>,<em> are allowed.", 'cumulo_plugin' ) ),
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
            "type" => "dropdown",
            "heading" => __ ( "Featured", 'cumulo_plugin' ),
            "param_name" => "featured",
            "value" => array(
                    __( "No", 'cumulo_plugin' ) => '',
                    __( "Yes", 'cumulo_plugin' ) => 'featured',
            ),
            "admin_label" => true,
        ),
        css_animation_class(),
        extra_class (),
        array(
            'type' => 'colorpicker',
            'heading' => 'Color',
            'param_name' => 'color',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' ),
            'description' => __( 'Leave blank to use page\'s primary color.', 'cumulo_plugin' ),
        ),
    )
) );
