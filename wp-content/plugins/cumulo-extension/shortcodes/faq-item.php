<?php
class WPBakeryShortCode_cmo_faq_item extends WPBakeryShortCode {

	function content($atts, $content = null) {
		extract ( shortcode_atts ( array (
            'title' => '',
            'el_class' => '',
        ), $atts ) );

        $content = wpb_js_remove_wpautop( $content, true );

        global $cmo_faq_id;
        global $cmo_faq_titles;

        if ( empty( $cmo_faq_id ) ) return "";
        if ( ! is_array( $cmo_faq_titles ) ) return "";

		$css_class = "cmo-faq-item";
        $css_class .= $this->getExtraClass( $el_class );

        $output = "";

        $fi_id = uniqid( "cmo-faq-item-");
        array_push( $cmo_faq_titles, array( 
            "id" => $fi_id, 
            "title" => $title 
        ) );

        $output .= '<div id="' . esc_attr( $fi_id ) . '" class="' . esc_attr( $css_class ) . '">';
            $output .= '<h2>' . esc_html( $title ) . '</h2>';
            $output .= cmo_do_kses( $content ) ;
            $output .= '<div class="text-right"><a href="#' . esc_attr( $cmo_faq_id ) . '" class="cmo-faq-back">' . __( "Back To Top" ) . ' <i class="fa fa-angle-up"></i></a></div>';
        $output .= '</div>';

		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "FAQ Item", 'cumulo_plugin' ),
    "base" => "cmo_faq_item",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "as_child" => array( 'only' => 'cmo_faq' ),
    "icon" => plugins_url( '/assets/images/icon_faq.png', dirname( __FILE__ ) ),
    "params" => array (
        array (
            "type" => "textfield",
            "heading" => __ ( "Question", 'cumulo_plugin' ),
            "param_name" => "title",
            "value" => 'Question',
            "admin_label" => true,
        ),
        array (
            "type" => "textarea_html",
            "heading" => __ ( "Answer", 'cumulo_plugin' ),
            "param_name" => "content",
            "value" => __ ( "Hey! Here we have a perfect answer for your question.", 'cumulo_plugin' ),
        ),
        extra_class ()
    )
) );
