<?php


global $vc_add_css_animation;

class WPBakeryShortCode_cmo_icon extends WPBakeryShortCode {
    function content($atts, $content = null) {

        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        extract( $atts );

        $color = 'custom';
        $background_color = 'custom';

        if ( !isset($custom_color) ) $custom_color = '#000000';
        if ( !isset($background_color) ) $custom_background_color = 'transparent';

        $css_style = '';
        $id = shortcode_unique_id( "cmo-icon" );
        $css_gen = new CUMULO_CSS_Generator( "cmo-icon", $id );

        $class = $this->getExtraClass( $el_class );
        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );
        $css_class .= " " . get_css_animation( $css_animation );
        // Enqueue needed icon font.
        vc_icon_element_fonts_enqueue( $type );

        $url = vc_build_link( $link );
        $has_style = false;
        if ( strlen( $background_style ) > 0 ) {
            $has_style = true;
            if ( strpos( $background_style, 'outline' ) !== false ) {
                $background_style .= ' vc_icon_element-outline'; // if we use outline style it is border in css
            } else {
                $background_style .= ' vc_icon_element-background';
            }
        }

        $iconClass = isset( ${"icon_" . $type} ) ? esc_attr( ${"icon_" . $type} ) : 'fa fa-adjust';

        if ( $custom_color != '' )
            $css_style .= $css_gen->css( ".vc_icon_element-inner", array( 'color' => $custom_color )  );
        if ( $hover_color != '' )
            $css_style .= $css_gen->css( ".vc_icon_element-inner:hover .vc_icon_element-icon", array( 'color' => $hover_color ) );
        if ( $hover_background_color != '' ) {
            if ( false !== strpos( $background_style, 'outline' ) )
                $css_style .= $css_gen->css( ".vc_icon_element-inner:hover", array( 'border-color' => $hover_background_color ) );
            else
                $css_style .= $css_gen->css( ".vc_icon_element-inner:hover ", array( 'background-color' => $hover_background_color ) );
        }

        if ( 'custom' === $background_color ) {
            if ( false !== strpos( $background_style, 'outline' ) )
                $css_style .= $css_gen->css( ".vc_icon_element-inner", array( 'border-color' => $custom_background_color ) );
            else
                $css_style .= $css_gen->css( ".vc_icon_element-inner", array( 'background-color' => $custom_background_color ) );
        }

        $output = "<div id='{$id}' class='cmo-icon vc_icon_element vc_icon_element-outer";
        $output .= strlen( $css_class ) > 0 ? ' ' . trim( esc_attr( $css_class ) ) : "";
        $output .= " vc_icon_element-align-" . esc_attr( $align );
        if ( $has_style )
        $output .= " vc_icon_element-have-style";
        $output .= "'>";
            if( $css_style != '' ) {
                $output .= "<style scoped>{$css_style}</style>";
            }
            $output .= "<div class='vc_icon_element-inner ";
            $output .= " vc_icon_element-color-" . esc_attr( $color );
            if ( $has_style )
                $output .= " vc_icon_element-have-style-inner";
            $output .= " vc_icon_element-size-" . esc_attr( $size );
            $output .= " vc_icon_element-style-" . esc_attr( $background_style );
            $output .= " vc_icon_element-background-color-" . esc_attr( $background_color );
            $output .= "'>";
            $output .= "<span class='vc_icon_element-icon " . $iconClass . "'></span>";
            if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 )
            $output .= "<a class='vc_icon_element-link' href='" . esc_attr( $url['url'] ) . "' title='" . esc_attr( $url['title'] ) . "' target='" . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . "'></a>";
            $output .= "</div>";
        $output .= "</div>";
        $output .= $this->endBlockComment( $this->getShortcode() );

        return $output;

    }
}


vc_map( array(
    'name' => __( 'Icon', 'js_composer' ),
    'base' => 'cmo_icon',
    "icon" => plugins_url( '/assets/images/icon_icon.png', dirname( __FILE__ ) ),
    'category' => __( 'Content', 'js_composer' ),
    'description' => __( 'Eye catching icons from libraries', 'js_composer' ),
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon library', 'js_composer' ),
            'value' => array(
                __( 'Font Awesome', 'js_composer' ) => 'fontawesome',
                __( 'ET-Line', 'cumulo_plugin' ) => 'etline',
                __( 'Open Iconic', 'js_composer' ) => 'openiconic',
                __( 'Typicons', 'js_composer' ) => 'typicons',
                __( 'Entypo', 'js_composer' ) => 'entypo',
                __( 'Linecons', 'js_composer' ) => 'linecons',
            ),
            'admin_label' => true,
            'param_name' => 'type',
            'description' => __( 'Select icon library.', 'js_composer' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-adjust', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'fontawesome',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'cumulo_plugin' ),
            'param_name' => 'icon_etline',
            'value' => 'et-line icon-lightbulb',
            'settings' => array(
                'emptyIcon' => false,
                'type'  =>  'etline',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'etline',
            ),
            'description' => __( 'Select icon from library.', 'cumulo_plugin' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_openiconic',
            'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'openiconic',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'openiconic',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_typicons',
            'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'typicons',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'typicons',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_entypo',
            'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'entypo',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'entypo',
            ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'js_composer' ),
            'param_name' => 'icon_linecons',
            'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'linecons',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'linecons',
            ),
            'description' => __( 'Select icon from library.', 'js_composer' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __( 'Color', 'js_composer' ),
            'param_name' => 'custom_color',
            'description' => __( 'Select icon color.', 'js_composer' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __( 'Hover color', 'js_composer' ),
            'param_name' => 'hover_color',
            'description' => __( 'Select color when the mouse is over the icon.', 'js_composer' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Background shape', 'js_composer' ),
            'param_name' => 'background_style',
            'value' => array(
                __( 'None', 'js_composer' ) => '',
                __( 'Circle', 'js_composer' ) => 'rounded',
                __( 'Square', 'js_composer' ) => 'boxed',
                __( 'Rounded', 'js_composer' ) => 'rounded-less',
                __( 'Outline Circle', 'js_composer' ) => 'rounded-outline',
                __( 'Outline Square', 'js_composer' ) => 'boxed-outline',
                __( 'Outline Rounded', 'js_composer' ) => 'rounded-less-outline',
            ),
            'description' => __( 'Select background shape and style for icon.', 'js_composer' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __( 'Background color', 'js_composer' ),
            'param_name' => 'custom_background_color',
            'description' => __( 'Select custom icon background color.', 'js_composer' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __( 'Hover background color', 'js_composer' ),
            'param_name' => 'hover_background_color',
            'description' => __( 'Select hover background color.', 'js_composer' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Size', 'js_composer' ),
            'param_name' => 'size',
            'value' => array(
                'Mini' => 'xs',
                'Small' => 'sm',
                'Normal' => 'md',
                'Large' => 'lg',
                'Extra Large' => 'xl'
            ),
            'std' => 'md',
            'description' => __( 'Icon size.', 'js_composer' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon alignment', 'js_composer' ),
            'param_name' => 'align',
            'value' => array(
                __( 'Left', 'js_composer' ) => 'left',
                __( 'Right', 'js_composer' ) => 'right',
                __( 'Center', 'js_composer' ) => 'center',
            ),
            'description' => __( 'Select icon alignment.', 'js_composer' ),
        ),
        array(
            'type' => 'vc_link',
            'heading' => __( 'URL (Link)', 'js_composer' ),
            'param_name' => 'link',
            'description' => __( 'Add link to icon.', 'js_composer' )
        ),
        css_animation_class(),
        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'js_composer' ),
            'param_name' => 'el_class',
            'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
        ),

    ),
    'js_view' => 'VcIconElementView_Backend',
) );
