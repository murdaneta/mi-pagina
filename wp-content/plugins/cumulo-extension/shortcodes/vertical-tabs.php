<?php

	class WPBakeryShortCode_cmo_vtabs extends WPBakeryShortCode_cmo_tabs {

		function content($atts, $content = null) {

            $output = $interval = $title = $nav_buttons_visible = $border_style = $active_color = $inactive_header_bg_color = $active_style = $active_header_color = $inactive_header_color = $content_bg_color = $content_text_color = $el_class = '';
            extract( shortcode_atts( array(
                'title' => '',
                'interval' => 0,
                'nav_buttons_visible' => 'hidden',
                'active_color' => '',
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

            $element = 'cmo_vtabs';

            $id = shortcode_unique_id( $element );
            $css_gen = new CUMULO_CSS_Generator( $element, $id );
            $css_style = '';

            if ( $active_color != '' ) {
                $css_style .= $css_gen->css( "li.ui-tabs-active", array( 'background-color' => $active_color ) );
                $css_style .= $css_gen->css( "li:not(.ui-tabs-active) a", array( 'color' => $active_color ) );
                $css_style .= $css_gen->css( ".cmo_tab", array( 'border-color' => $active_color ) );
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
            if ( $nav_buttons_visible == 'visible' ) {
                $css_style .= $css_gen->css( ".cmo_next_prev_nav", array( 'display' => 'block' ) );
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

                        $icon_html = "<img src='{$image_url}' class='image' {$tab_title} alt = '" . $tab_atts['title'] . "' ></img> ";
                    } else {
                        $icon = selected_icon( $icon_type, $icon_fa, $icon_etline, $icon_linecons );
                        $icon_html = "<i class='{$icon} '></i>";
                    }
                }

                if ( $image != '' ) {
                    $tabs_nav .= '<li class="with-image"><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : '' ) . '">' . $icon_html . '</a></li>';
                } else {
                    $tab_title = $tab_atts['title'];

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

            $output .= "\n\t" . '<div class="' . $css_class . '" id="' . $id . '" data-interval="' . $interval . '">';
            if( $css_style != '' ) {
                $output .= "<style scoped>{$css_style}</style>";
            }

            $output .= "\n\t\t" . '<div class="cmo_wrapper cmo_tabs_wrapper ui-tabs clearfix">';
            $output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => $element . '_heading' ) );
            $output .= "\n\t\t\t" . $tabs_nav;
            $output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );

            $output .= "\n\t\t\t" . '<div class="cmo_next_prev_nav vc_clearfix"> <span class="cmo_prev_slide"><a href="#prev" title="' . __( 'Previous tab', 'js_composer' ) . '">' . __( 'Previous tab', 'js_composer' ) . '</a></span> <span class="cmo_next_slide"><a href="#next" title="' . __( 'Next tab', 'js_composer' ) . '">' . __( 'Next tab', 'js_composer' ) . '</a></span></div>';

            $output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.cmo_wrapper' );
            $output .= "\n\t" . '</div> ' . $this->endBlockComment( $element );

            return $output;

		}
	}

	$tab_id_1 = ''; // 'def' . time() . '-1-' . rand( 0, 100 );
	$tab_id_2 = ''; // 'def' . time() . '-2-' . rand( 0, 100 );

vc_map( array(
    'name' => __( 'Vertical Tabs', 'cumulo_plugin' ),
    'base' => 'cmo_vtabs',
    'show_settings_on_create' => false,
    'is_container' => true,
    "icon" => plugins_url( '/assets/images/icon_verticaltabs.png', dirname( __FILE__ ) ),
    'category' => __( 'Content', 'cumulo_plugin' ),
    'wrapper_class' => 'vc_clearfix',
    'description' => __( 'Vertical tabbed content', 'cumulo_plugin' ),
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
                'description' => __( 'Auto rotate vtabs each X seconds.', 'cumulo_plugin' )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Show navigation buttons.', 'cumulo_plugin' ),
                'param_name' => 'nav_buttons_visible',
                'value' => array(
                        __( 'Hidden', 'cumulo_plugin' ) => 'hidden',
                        __( 'Visible', 'cumulo_plugin' ) => 'visible',
                    ),
                'description' => __( 'Show previous and next tab buttons.', 'cumulo_plugin' )
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
        <div class="wpb_tabs_holder wpb_holder vc_clearfix vc_container_for_children">
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

