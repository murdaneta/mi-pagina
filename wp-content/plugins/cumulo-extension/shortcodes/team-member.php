<?php

class WPBakeryShortCode_cmo_team_member extends WPBakeryShortCode {
	function content($atts, $content = null) {
		extract ( shortcode_atts ( array (
            'style' => 'style1',
            'photo' => '',
            'name' => '',
            'title' => '',
            'intro' => '',
            'info_bg_color' => '',
            'twitter' => '',
            'facebook' => '',
            'google_plus' => '',
            'instagram' => '',
            'dribbble' => '',
            'linkedin' => '',
            'tumblr' => '',
            'reddit' => '',
            'yahoo' => '',
            'deviantart' => '',
            'vimeo' => '',
            'youtube' => '',
            'pinterest' => '',
            'flickr' => '',
            'paypal' => '',
            'dropbox' => '',
            'soundcloud' => '',
            'skype' => '',
            'rss' => '',
            'email' => '',
            'link' => '',
            'css_animation' => '',
            'el_class' => '',
		), $atts ) );
		
		$css_class = "cmo-team-member wpb_content_element {$style} ";
		$css_class .= get_css_animation( $css_animation );
		$css_class .= $this->getExtraClass ( $el_class );

		$output = '';
		$image = wp_get_attachment_image_src( $photo, 'full' );

        $css_style = '';
        $id = shortcode_unique_id( "cmo-team-member" );
        $css_gen = new CUMULO_CSS_Generator( "cmo-team-member", $id );

        if ( $info_bg_color != '') {
            $css_style .= $css_gen->css( ".info", array( 'background-color' => $info_bg_color ) );
        }

        $output .= "<div class='{$css_class}' id='{$id}'>";
        if( $css_style != '' ) {
            $output .= "<style scoped>{$css_style}</style>";
        }
        $social_links_div = "<div class='cmo-social-links'>";
        $social_links = array( $facebook, $twitter, $google_plus, $instagram, $dribbble, $linkedin, $tumblr, $reddit, $yahoo, $deviantart, $vimeo, $youtube, $pinterest, $flickr, $paypal, $dropbox, $soundcloud, $skype, $rss, $email, $link );
        $social_icons = array( 'fa fa-facebook', 'fa fa-twitter', 'fa fa-google-plus', 'fa fa-instagram', 'fa fa-dribbble', 'fa fa-linkedin', 'fa fa-tumblr', 'fa fa-reddit', 'fa fa-yahoo', 'fa fa-deviantart', 'fa fa-vimeo-square', 'fa fa-youtube', 'fa fa-pinterest-p', 'fa fa-flickr', 'fa fa-paypal', 'fa fa-dropbox', 'fa fa-soundcloud', 'fa fa-skype', 'fa fa-rss', 'fa fa-envelope', 'fa fa-link' );
        $i = 0; $links = 0;
        foreach( $social_links as $social_link ) {
            if( $social_link ) {
                $links ++;
                $social_links_div .= "<a class='social-link' href='{$social_link}'><i class='{$social_icons[$i]}'></i></a>";
            }
            $i++;
        }
        $social_links_div .= "</div>";    // social-links

        if ( $links == 0 ) $social_links_div = '';

        if ($style == '' || $style == 'style1') {
            $output .= "<div class='img-wrapper'>";
            $output .= "<img src='{$image[0]}' alt='{$name}'>";
            $output .= $social_links_div;
            $output .= "</div>";

            $output .= "<div class='info'>";
            if( $name ) {
                $output .= "<h5 class='name'>{$name}</h5>";
            }
            if( $title ) {
                $output .= "<div class='title'>{$title}</div>";
            }
            $output .= "</div>";    // info
        } else if ($style == 'style2') {
            $output .= "<div class='img-wrapper'>";
            $output .= "<img src='{$image[0]}' alt='{$name}'>";
            $output .= "</div>";

            $output .= "<div class='info'>";
            if ( $name ) {
                $output .= "<h5 class='name'>{$name}";
            }
            if ( $title ) {
                $output .= "<span class='title'> - {$title}</span>";
            }
            $output .= "</h5>";
            $output .= $social_links_div;

            $output .= "</div>";    // info
        } else if ($style == 'style3') {
            $output .= "<div class='img-wrapper'>";
            $output .= "<img src='{$image[0]}' alt='{$name}'>";
            $output .= $social_links_div;
            $output .= "</div>";

            $output .= "<div class='info'>";
            if( $name ) {
                $output .= "<h5 class='name'>{$name}</h5>";
            }
            if( $title ) {
                $output .= "<div class='title'>{$title}</div>";
            }
            $output .= "</div>";    // info
        } else if ($style == 'style4') {
            $output .= "<div class='img-wrapper'>";
            $output .= "<img src='{$image[0]}' alt='{$name}'>";
            $output .= $social_links_div;
            $output .= "</div>";

            $output .= "<div class='info'>";
            if( $name ) {
                $output .= "<h5 class='name'>{$name}</h5>";
            }
            if( $title ) {
                $output .= "<div class='title'>{$title}</div>";
            }
            $output .= "</div>";    // info
        } else if ($style == 'style5') {
            $output .= "<div class='img-wrapper'>";
            $output .= "<img src='{$image[0]}' alt='{$name}'>";
            $output .= "</div>";
            $output .= "<div class='info'>";
            if( $name ) {
                $output .= "<h5 class='name'>{$name}</h5>";
            }
            if( $title ) {
                $output .= "<div class='title'>{$title}</div>";
            }
            if( $intro ) {
                $output .= "<div class='intro'>{$intro}</div>";
            }
            $output .= $social_links_div;
            $output .= "</div>";    // info
        } else if ($style == 'style6') {
            $output .= "<div class='img-wrapper'>";
            $output .= "<img src='{$image[0]}' alt='{$name}'>";
            $output .= "</div>";
            $output .= "<div class='info'>";
            if( $name ) {
                $output .= "<h5 class='name'>{$name}</h5>";
            }
            if( $title ) {
                $output .= "<div class='title'>{$title}</div>";
            }
            $output .= $social_links_div;
            $output .= "</div>";    // info
        } else if ($style == 'style7') {
            $output .= "<div class='img-wrapper'>";
            $output .= "<img src='{$image[0]}' alt='{$name}'>";
            $output .= "<div class='info'>";
            if( $name ) {
                $output .= "<h5 class='name'>{$name}</h5>";
            }
            if( $title ) {
                $output .= "<div class='title'>{$title}</div>";
            }
            $output .= $social_links_div;
            $output .= "</div>";
            $output .= "</div>";    // info
        }
        $output .= "</div>\n";
		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "Team Member", 'cumulo_plugin' ),
    "base" => "cmo_team_member",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_teammember.png', dirname( __FILE__ ) ),
    "params" => array (
        array(
            'type' => 'dropdown',
            'heading' => __( 'Style', 'cumulo_plugin' ),
            'value' => array(
                __( 'Style1', 'cumulo_plugin' ) => 'style1',
                __( 'Style2', 'cumulo_plugin' ) => 'style2',
                __( 'Style3', 'cumulo_plugin' ) => 'style3',
                __( 'Style4', 'cumulo_plugin' ) => 'style4',
                __( 'Style5 (Bride/Groom)', 'cumulo_plugin' ) => 'style5',
                __( 'Style6', 'cumulo_plugin' ) => 'style6',
                __( 'Style7', 'cumulo_plugin' ) => 'style7',
            ),
            'param_name' => 'style'
        ),
        array(
            'type' => 'attach_image',
            'heading' => __( 'Photo', 'cumulo_plugin' ),
            'param_name' => 'photo',
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Name", 'cumulo_plugin' ),
            "param_name" => "name",
            "value" => '',
            "admin_label" => true,
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Title", 'cumulo_plugin' ),
            "param_name" => "title",
            "value" => '',
            "admin_label" => true,
        ),
        array (
            "type" => "textarea",
            "heading" => __ ( "Introduction", 'cumulo_plugin' ),
            "param_name" => "intro",
            'dependency' => array(
                'element' => 'style',
                'value' => 'style5',
            ),
            "value" => '',
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Facebook", 'cumulo_plugin' ),
            "param_name" => "facebook",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Twitter", 'cumulo_plugin' ),
            "param_name" => "twitter",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Google+", 'cumulo_plugin' ),
            "param_name" => "google_plus",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Instagram", 'cumulo_plugin' ),
            "param_name" => "instagram",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Dribbble", 'cumulo_plugin' ),
            "param_name" => "dribbble",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "LinkedIn", 'cumulo_plugin' ),
            "param_name" => "linkedin",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Tumblr", 'cumulo_plugin' ),
            "param_name" => "tumblr",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Reddit", 'cumulo_plugin' ),
            "param_name" => "reddit",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Yahoo", 'cumulo_plugin' ),
            "param_name" => "yahoo",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Deviantart", 'cumulo_plugin' ),
            "param_name" => "deviantart",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Vimeo", 'cumulo_plugin' ),
            "param_name" => "vimeo",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Youtube", 'cumulo_plugin' ),
            "param_name" => "youtube",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Pinterest", 'cumulo_plugin' ),
            "param_name" => "pinterest",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Flickr", 'cumulo_plugin' ),
            "param_name" => "flickr",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "PayPal", 'cumulo_plugin' ),
            "param_name" => "paypal",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Dropbox", 'cumulo_plugin' ),
            "param_name" => "dropbox",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Soundcloud", 'cumulo_plugin' ),
            "param_name" => "soundcloud",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Skype", 'cumulo_plugin' ),
            "param_name" => "skype",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "RSS", 'cumulo_plugin' ),
            "param_name" => "rss",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Email", 'cumulo_plugin' ),
            "param_name" => "email",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Link", 'cumulo_plugin' ),
            "param_name" => "link",
            "group" => __( "Social Links", 'cumulo_plugin' )
        ),
        css_animation_class(),
        extra_class (),
        array(
            'type' => 'colorpicker',
            'heading' => 'Profile Background Color',
            'param_name' => 'info_bg_color',
            'value' => '',
            'group' => __( 'Colors', 'cumulo_plugin' )
        ),
    )
) );
