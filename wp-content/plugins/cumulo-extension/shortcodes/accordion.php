<?php

require_once vc_path_dir( 'SHORTCODES_DIR', 'vc-accordion.php' );
class WPBakeryShortCode_cmo_accordion extends WPBakeryShortCode_VC_Accordion {
    function content($atts, $content = null) {

        wp_enqueue_script( 'jquery-ui-accordion' );
        $output = $title = $interval = $el_class = $collapsible = $disable_keyboard = $active_tab = $active_color = $icon_position = '';

        extract( shortcode_atts( array(
            'title' => '',
            'interval' => 0,
            'el_class' => '',
            'collapsible' => 'no',
            'disable_keyboard' => 'no',
            'active_color' => '',
            'icon_position' => 'icon-right',
            'accordion_margin' => '-1',
            'active_tab' => '1'
        ), $atts ) );

        $el_class = $this->getExtraClass( $el_class );
        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion cmo_accordion wpb_content_element ' . $el_class . ' not-column-inherit', $this->settings['base'], $atts );

        $css_class .= " " . $icon_position;

        $id = shortcode_unique_id( "cmo_accordion" );
        $css_gen = new CUMULO_CSS_Generator( "cmo_accordion", $id );
        $css_style = '';

        if ( $active_color != '') {
            $css_style .= $css_gen->css( ".ui-accordion-header-active a", array( 'background-color' => $active_color) );
            $css_style .= $css_gen->css( ".wpb_accordion_header:not(.ui-accordion-header-active)  a:hover", array( 'color' => $active_color) );
        }
        if ( $accordion_margin != '') {
            $css_style .= $css_gen->css( ".wpb_accordion_section:not(:last-child)", array( 'margin-bottom' => $accordion_margin . 'px' ) );
        }

        $output .= "\n\t" . '<div class="' . $css_class . '" id="' . $id . '" data-collapsible="' . $collapsible . '" data-vc-disable-keydown="' . ( esc_attr( ( 'yes' == $disable_keyboard ? 'true' : 'false' ) ) ) . '" data-active-tab="' . $active_tab . '">'; //data-interval="'.$interval.'"
        if( $css_style != '' ) {
            $output .= "<style scoped>{$css_style}</style>";
        }
        $output .= "\n\t\t" . '<div class="wpb_wrapper wpb_accordion_wrapper ui-accordion">';
        $output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_accordion_heading' ) );

        $output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
        $output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
        $output .= "\n\t" . '</div> ' . $this->endBlockComment( '.wpb_accordion' );

        return $output;



    }
}

vc_map( array(
    'name' => __( 'Accordion', 'cumulo_plugin' ),
    'base' => 'cmo_accordion',
    'show_settings_on_create' => false,
    'is_container' => true,
    "icon" => plugins_url( '/assets/images/icon_accordions.png', dirname( __FILE__ ) ),
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    'description' => __( 'Collapsible content panels', 'cumulo_plugin' ),
    'params' =>
        array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Widget title', 'cumulo_plugin' ),
                'param_name' => 'title',
                'description' => __( 'Enter text used as widget title (Note: located above content element).', 'cumulo_plugin' )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Active section', 'cumulo_plugin' ),
                'param_name' => 'active_tab',
                'description' => __( 'Enter section number to be active on load or enter "false" to collapse all sections.', 'cumulo_plugin' )
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Allow collapse all sections?', 'cumulo_plugin' ),
                'param_name' => 'collapsible',
                'description' => __( 'If checked, it is allowed to collapse all sections.', 'cumulo_plugin' ),
                'value' => array( __( 'Yes', 'cumulo_plugin' ) => 'yes' )
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Disable keyboard interactions?', 'cumulo_plugin' ),
                'param_name' => 'disable_keyboard',
                'description' => __( 'If checked, disables keyboard arrow interactions (Keys: Left, Up, Right, Down, Space).', 'cumulo_plugin' ),
                'value' => array( __( 'Yes', 'cumulo_plugin' ) => 'yes' )
            ),
            extra_class(),
            array (
                'type' => 'colorpicker',
                'heading' => __ ( 'Active Color', 'cumulo_plugin' ),
                'param_name' => 'active_color',
                'value' => '',
                'description' => __ ( 'Leave blank for page default color.', 'cumulo_plugin' ),
                'group' => __( 'Styles', 'cumulo_plugin' )
            ),
            array (
                'type' => 'dropdown',
                'heading' => __( 'Icon Position', 'cumulo_plugin' ),
                'param_name' => 'icon_position',
                'value' => array(
                    __( "Right", 'cumulo_plugin' ) => 'icon-right',
                    __( "Left", 'cumulo_plugin' ) => 'icon-left'
                ),
                'group' => __( 'Styles', 'cumulo_plugin' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Spacing between accordions', 'cumulo_plugin' ),
                'param_name' => 'accordion_margin',
                'description' => __( 'Put spacing between accordions in pixels, default value is 0.', 'cumulo_plugin' ),
                'group' => __( 'Styles', 'cumulo_plugin' ),
            ),
        ),

    'custom_markup' => '
<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
%content%
</div>
<div class="tab_controls">
    <a class="add_tab" title="' . __( 'Add section', 'cumulo_plugin' ) . '"><span class="vc_icon"></span> <span class="tab-label">' . __( 'Add section', 'cumulo_plugin' ) . '</span></a>
</div>
',
    'default_content' => '
    [cmo_accordion_tab title="' . __( 'Section 1', 'cumulo_plugin' ) . '"][/cmo_accordion_tab]
    [cmo_accordion_tab title="' . __( 'Section 2', 'cumulo_plugin' ) . '"][/cmo_accordion_tab]
',
    'js_view' => 'CMOAccordionView'
) );

