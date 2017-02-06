<?php

require_once vc_path_dir( 'SHORTCODES_DIR', 'vc-tab.php' );
class WPBakeryShortCode_cmo_tab extends WPBakeryShortCode_VC_Tab {
    function content($atts, $content = null) {

        $output = '';
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        extract( $atts );

        $css_class = 'cmo_tab ui-tabs-panel cmo_ui-tabs-hide clearfix ';
        $icon_type = isset($atts['icon_type']) ? $atts['icon_type'] : '';

        if ( $icon_type == 'image')
            $css_class .= ' ' . 'no-padding';

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->settings['base'], $atts );
        $output .= "\n\t\t\t" . '<div id="tab-' . ( empty( $tab_id ) ? sanitize_title( $title ) : esc_attr( $tab_id ) ) . '" class="' . esc_attr( $css_class ) . '">';
        $output .= ( '' === trim( $content ) ) ? __( 'Empty tab. Edit page to add content here.', 'js_composer' ) : "\n\t\t\t\t" . wpb_js_remove_wpautop( $content );
        $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment( $this->getShortcode() );

        return $output;

    }
}

vc_map( array(
    'name' => __( 'Tab', 'cumulo_plugin' ),
    'base' => 'cmo_tab',
    'allowed_container_element' => 'vc_row',
    'is_container' => true,
    'content_element' => false,
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __( 'Title', 'cumulo_plugin' ),
            'param_name' => 'title',
            'description' => __( 'Enter title of tab.', 'cumulo_plugin' )
        ),
        array(
            'type' => 'tab_id',
            'heading' => __( 'Tab ID', 'cumulo_plugin' ),
            'param_name' => "tab_id"
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Type', 'cumulo_plugin' ),
            'value' => array(
                __( 'None', 'cumulo_plugin' ) => '',
                __( 'Font Awesome', 'cumulo_plugin' ) => 'fa',
                __( 'ET-Line', 'cumulo_plugin' ) => 'etline',
                __( 'Linecons', 'cumulo_plugin' ) => 'linecons',
                __( 'Custom Image', 'cumulo_plugin' ) => 'image',
            ),
            'param_name' => 'icon_type',
            'description' => __( 'Select icon library.', 'cumulo_plugin' ),
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'cumulo_plugin' ),
            'param_name' => 'icon_fa',
            'value' => '',
            'settings' => array(
                'emptyIcon' => false,
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'fa',
            ),
            'description' => __( 'Choose from FontAwesome icons.', 'cumulo_plugin' ),
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'cumulo_plugin' ),
            'param_name' => 'icon_etline',
            'value' => '',
            'settings' => array(
                'emptyIcon' => false,
                'type'  =>  'etline',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'etline',
            ),
            'description' => __( 'Select icon from ET-Line icons.', 'cumulo_plugin' ),
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'cumulo_plugin' ),
            'param_name' => 'icon_linecons',
            'value' => '',
            'settings' => array(
                'emptyIcon' => false,
                'type' => 'linecons',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'linecons',
            ),
            'description' => __( 'Choose one from Linecons icons.', 'cumulo_plugin' ),
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array (
            "type" => "attach_image",
            "heading" => __ ( "Image", 'cumulo_plugin' ),
            "param_name" => "image",
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'image',
            ),
            'description' => __( 'Select image.', 'cumulo_plugin' ),
            'group' => __( 'Icon', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Position', 'cumulo_plugin' ),
            'value' => array(
                __( 'Left', 'cumulo_plugin' ) => 'icon-left',
                __( 'Right', 'cumulo_plugin' ) => 'icon-right',
                __( 'Top', 'cumulo_plugin' ) => 'icon-top',
                __( 'Bottom', 'cumulo_plugin' ) => 'icon-bottom',
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => array( 'fa', 'etline', 'linecons' ),
            ),
            'param_name' => 'icon_position',
            'group' => __( 'Icon', 'cumulo_plugin' ),
        )

    ),
    'js_view' => 'CMOTabView'
) );

