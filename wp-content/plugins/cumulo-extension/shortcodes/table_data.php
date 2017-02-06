<?php

class WPBakeryShortCode_cmo_table extends WPBakeryShortCode {
    function content($atts, $content = null) {
        extract ( shortcode_atts ( array (
            'caption' => '',
            'values' => '',
            'title_width' => '',
            'css_animation' => '',
            'el_class' => '',
        ), $atts ) );

        $css_class = "cmo-table ";
        $css_class .= " " . get_css_animation( $css_animation );
        $css_class .= $this->getExtraClass ( $el_class );

        $css_style = '';
        $id = shortcode_unique_id( "cmo-table" );
        $css_gen = new CUMULO_CSS_Generator( "cmo-table", $id );

        if ( $title_width != '') {
            $css_style .= $css_gen->css( ".table_row .title", array( 'width' => $title_width) );
        }

        $output = '';
        $output .= "<div class='{$css_class}' id='{$id}'>";
        if( $css_style != '' ) {
            $output .= "<style scoped>{$css_style}</style>";
        }

        $values = json_decode( urldecode( $values ), true );
        $rows_html = "";
        foreach ($values as $value => $row ) {
            if ( !isset($row['title']) ) continue;
            $rows_html .= "<div class='table_row'>";
            $rows_html .= "<span class='title'>" . $row['title'] . "</span>";
            $rows_html .= "<span class='text'>" . $row['text'] . "</span>";
            $rows_html .= "</div>";
        }

        $output .= $rows_html;
        $output .= "</div>\n";
        return $output;
    }
}

vc_map ( array (
    "name" => __ ( "Table", 'cumulo_plugin' ),
    "base" => "cmo_table",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_table.png', dirname( __FILE__ ) ),
    "params" => array (
        array (
            "type" => "textfield",
            "heading" => __ ( "Caption", 'cumulo_plugin' ),
            "param_name" => "caption",
            "value" => '',
            "admin_label" => true,
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Title width", 'cumulo_plugin' ),
            "param_name" => "title_width",
            "value" => '',
            "description" => __( 'Put title field width, example: 30%, 100px', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'param_group',
            'heading' => __( 'Rows', 'cumulo_plugin' ),
            'param_name' => 'values',
            'value' => urlencode( json_encode( array(
                array(
                    'title' => __( 'Title One', 'cumulo_plugin' ),
                    'text' => 'Enter some text here.',
                ),
                array(
                    'title' => __( 'Title Two', 'cumulo_plugin' ),
                    'text' => 'Enter some text here.',
                )
            ) ) ),

            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Title', 'cumulo_plugin' ),
                    'param_name' => 'title',
                    'description' => __( 'Enter title here.', 'cumulo_plugin' ),
                    'admin_label' => true
                ),
                array(
                    'type' => 'textarea',
                    'heading' => __( 'Text', 'cumulo_plugin' ),
                    'param_name' => 'text',
                    'description' => __( 'Enter some text here.', 'cumulo_plugin' ),
                )
            ),
        ),
        css_animation_class(),
        extra_class ()

    )
) );


