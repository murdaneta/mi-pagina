<?php

require_once vc_path_dir( 'SHORTCODES_DIR', 'vc-tabs.php' );

class WPBakeryShortCode_cmo_tabs extends WPBakeryShortCode_VC_Tabs {
    function content($atts, $content = null) {

        $output = $title = $interval = $interval = $border_style = $active_color = $inactive_header_bg_color = $active_style = $active_header_color = $inactive_header_color = $content_bg_color = $content_text_color = $el_class = '';
        extract( shortcode_atts( array(
            'title' => '',
            'interval' => 0,
            'content_in_grid' => 'yes',
            'border_style' => '',
            'active_color' => '',
            'active_style' => '',
            'active_header_color' => '',
            'inactive_header_color' => '',
            'inactive_header_bg_color' => '',
            'content_bg_color' => '',
            'content_text_color' => '',
            'el_class' => ''
        ), $atts ) );

        wp_enqueue_script( 'jquery-ui-tabs' );
        wp_enqueue_script( 'jquery_ui_tabs_rotate' );

        $el_class = $this->getExtraClass( $el_class );
        $element = 'cmo_tabs';

        $id = shortcode_unique_id( $element );
        $css_gen = new CUMULO_CSS_Generator( $element, $id );
        $css_style = '';

        if ( $element == 'cmo_tabs' ) {
            if ( $active_style == 'active-border-top') {
                if ( $active_color != '' )
                    $css_style .= $css_gen->css( "li.ui-tabs-active a", array( 'border-color' => $active_color ) );
            } else if ( $active_style == 'active-background') {
                if ( $active_color != '' )
                    $css_style .= $css_gen->css( "li.ui-state-active", array( 'background-color' => $active_color ) );
            }
            if ( $active_header_color != '' ) {
                $css_style .= $css_gen->css( "li.ui-state-active a", array( 'color' => $active_header_color ) );
            }
            if ( $inactive_header_color != '' ) {
                $css_style .= $css_gen->css( "li:not(.ui-state-active) a", array( 'color' => $inactive_header_color ) );
            }
            if ( $inactive_header_bg_color != '' ) {
                $css_style .= $css_gen->css( "li:not(.ui-state-active)", array( 'background-color' => $inactive_header_bg_color ) );
            }

            if ( $content_bg_color != '' ) {
                $css_style .= $css_gen->css( ".cmo_tab", array( 'background-color' => $content_bg_color ) );
            }
            if ( $content_text_color != '' ) {
                $css_style .= $css_gen->css( ".cmo_tab", array( 'color' => $content_text_color ) );
            }
        }

        // Extract tab titles
        preg_match_all( '/cmo_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
        $tab_titles = array();
        /**
         * vc_tabs
         *
         */
        if ( isset( $matches[1] ) ) {
            $tab_titles = $matches[1];
        }
        $tabs_nav = '';
//            $tabs_nav .= '<ul class="wpb_tabs_nav ui-tabs-nav ">';
        $tabs_nav .= '<ul class="cmo_tabs_nav ui-tabs-nav ">';
        foreach ( $tab_titles as $tab ) {
            $tab_atts = shortcode_parse_atts( $tab[0] );
            $icon_type = isset($tab_atts['icon_type']) ? $tab_atts['icon_type'] : '';
            $icon_position = isset($tab_atts['icon_position']) ? $tab_atts['icon_position'] : 'icon-left';
            $icon_fa = isset($tab_atts['icon_fa']) ? $tab_atts['icon_fa'] : 'fa-star';
            $icon_etline = isset($tab_atts['icon_etline']) ? $tab_atts['icon_etline'] : '';
            $icon_linecons = isset($tab_atts['icon_linecons']) ? $tab_atts['icon_linecons'] : '';
            $image = isset($tab_atts['image']) ? $tab_atts['image'] : '';

            $icon_html = "";
            if ( $icon_type != '' ) {
                if ( $icon_type == 'image' ) {
                    $image_url = wp_get_attachment_url( $image );
                    $tab_title = ( $tab_atts['title'] ) ?  ' title = "' . $tab_atts['title'] . '"' : '';

                    $icon_html = "<img src='{$image_url}' class='image' {$tab_title} alt = '" . $tab_atts['title'] . "' > ";
                } else {
                    $icon = selected_icon( $icon_type, $icon_fa, $icon_etline, $icon_linecons );
                    $icon_html = "<i class='{$icon} '></i>";
                }
            }

            if ( $image != '' ) {
                $tabs_nav .= '<li class="with-image"><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : '' ) . '">' . $icon_html . '</a></li>';
            } else {
                $tab_title = "<span>" . $tab_atts['title'] . "</span>";

                if ( $icon_position == 'icon-left' )
                    $tabs_nav .= '<li><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '">' . $icon_html . " " . $tab_title . '</a></li>';
                else if ( $icon_position == 'icon-right' )
                    $tabs_nav .= '<li><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '">' . $tab_title . " " . $icon_html . '</a></li>';
                else if ( $icon_position == 'icon-top' )
                    $tabs_nav .= '<li class="icon-block"><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '">' . $icon_html . $tab_title . '</a></li>';
                else if ( $icon_position == 'icon-bottom' )
                    $tabs_nav .= '<li class="icon-block"><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '">' . $tab_title . $icon_html . '</a></li>';

            }
        }
        $tabs_nav .= '</ul>' . "\n";

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ), $this->settings['base'], $atts );
        $css_class .= ' ' . $border_style;
        $css_class .= ' ' . $active_style;

        $output .= "\n\t" . '<div class="' . $css_class . '" id="' . $id . '" data-interval="' . $interval . '">';
        if( $css_style != '' ) {
            $output .= "<style scoped>{$css_style}</style>";
        }

        $output .= "\n\t\t" . '<div class="cmo_wrapper cmo_tabs_wrapper ui-tabs clearfix">';
        $output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => $element . '_heading' ) );
        $output .= "\n\t\t\t" . $tabs_nav;
        if ( $content_in_grid != 'no' ) $output .= "\n\t\t\t" . "<div class='container'>";
        $output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
        if ( $content_in_grid != 'no' ) $output .= "\n\t\t\t" . "</div>";
        $output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.cmo_wrapper' );
        $output .= "\n\t" . '</div> ' . $this->endBlockComment( $element );

        return $output;
    }
}


$tab_id_1 = ''; // 'def' . time() . '-1-' . rand( 0, 100 );
$tab_id_2 = ''; // 'def' . time() . '-2-' . rand( 0, 100 );
vc_map( array(
    'name' => __( 'Tabs', 'cumulo_plugin' ),
    'base' => 'cmo_tabs',
    'show_settings_on_create' => false,
    'is_container' => true,
    "icon" => plugins_url( '/assets/images/icon_tabs.png', dirname( __FILE__ ) ),
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    //'deprecated' => '4.5',
    'description' => __( 'Tabbed content', 'cumulo_plugin' ),
    'params' =>
        array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Widget title', 'cumulo_plugin' ),
                'param_name' => 'title',
                'description' => __( 'Enter text used as widget title (Note: located above content element).', 'cumulo_plugin' )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Auto rotate', 'cumulo_plugin' ),
                'param_name' => 'interval',
                'value' => array( __( 'Disable', 'cumulo_plugin' ) => 0, 3, 5, 10, 15 ),
                'std' => 0,
                'description' => __( 'Auto rotate tabs each X seconds.', 'cumulo_plugin' )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Content in Grid', 'cumulo_plugin' ),
                'param_name' => 'content_in_grid',
                'value' => array(
                    __( "Yes", 'cumulo_plugin' ) => '',
                    __( "No", 'cumulo_plugin' ) => 'no'
                ),
                'std' => 0,
            ),
            extra_class(),
            array (
                'type' => 'dropdown',
                'heading' => __( 'Border Style', 'cumulo_plugin' ),
                'param_name' => 'border_style',
                'value' => array(
                    __( "Default", 'cumulo_plugin' ) => '',
                    __( "No Border", 'cumulo_plugin' ) => 'no-border',
                ),
                'group' => __( 'Styles', 'cumulo_plugin' ),
            ),
            array (
                'type' => 'dropdown',
                'heading' => __( 'Active Tab Style', 'cumulo_plugin' ),
                'param_name' => 'active_style',
                'value' => array(
                    __( "None", 'cumulo_plugin' ) => '',
                    __( "Set Background", 'cumulo_plugin' ) => 'active-background',
                    __( "Set Top Border", 'cumulo_plugin' ) => 'active-border-top'
                ),
                'group' => __( 'Styles', 'cumulo_plugin' ),
            ),
            array (
                'type' => 'colorpicker',
                'heading' => __ ( 'Active Color', 'cumulo_plugin' ),
                'param_name' => 'active_color',
                'dependency' => array(
                    'element' => 'active_style',
                    'not_empty' => true,
                ),
                'value' => '',
                'description' => __ ( 'Leave blank for page default color.', 'cumulo_plugin' ),
                'group' => __( 'Styles', 'cumulo_plugin' )
            ),
            array (
                'type' => 'colorpicker',
                'heading' => __ ( 'Inactive Header Background Color', 'cumulo_plugin' ),
                'param_name' => 'inactive_header_bg_color',
                'value' => '',
                'description' => __ ( 'Select color for the inactive header background. Leave blank for page default color.', 'cumulo_plugin' ),
                'group' => __( 'Styles', 'cumulo_plugin' )
            ),
            array (
                'type' => 'colorpicker',
                'heading' => __ ( 'Active Header Text Color', 'cumulo_plugin' ),
                'param_name' => 'active_header_color',
                'value' => '',
                'group' => __( 'Styles', 'cumulo_plugin' )
            ),
            array (
                'type' => 'colorpicker',
                'heading' => __ ( 'Inactive Header Text Color', 'cumulo_plugin' ),
                'param_name' => 'inactive_header_color',
                'value' => '',
                'group' => __( 'Styles', 'cumulo_plugin' )
            ),
            array (
                'type' => 'colorpicker',
                'heading' => __ ( 'Content Background Color', 'cumulo_plugin' ),
                'param_name' => 'content_bg_color',
                'value' => '',
                'group' => __( 'Styles', 'cumulo_plugin' )
            ),
            array (
                'type' => 'colorpicker',
                'heading' => __ ( 'Content Text Color', 'cumulo_plugin' ),
                'param_name' => 'content_text_color',
                'value' => '',
                'group' => __( 'Styles', 'cumulo_plugin' )
            )
        ),
    'custom_markup' => '
        <div class="wpb_tabs_holder wpb_holder vc_container_for_children">
        <ul class="tabs_controls">
        </ul>
        %content%
        </div>',
    'default_content' => '
        [cmo_tab title="' . __( 'Tab 1', 'cumulo_plugin' ) . '" tab_id="' . $tab_id_1 . '"][/cmo_tab]
        [cmo_tab title="' . __( 'Tab 2', 'cumulo_plugin' ) . '" tab_id="' . $tab_id_2 . '"][/cmo_tab]
        ',
    'js_view' => 'CMOTabsView'
) );

