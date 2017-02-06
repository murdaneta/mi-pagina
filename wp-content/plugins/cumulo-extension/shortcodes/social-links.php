<?php

class WPBakeryShortCode_cmo_social_links extends WPBakeryShortCode {
	function content($atts, $content = null) {
		extract ( shortcode_atts ( array (
            'alignment' => 'text-left',
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
            'css_animation' => '',
            'el_class' => '',
		), $atts ) );
		
		$css_class = "cmo-social-links wpb_content_element {$alignment} ";
		$css_class .= get_css_animation( $css_animation );
		$css_class .= $this->getExtraClass ( $el_class );

		$output = '';
		$css_style = '';

        $social_links_div = "<div class='{$css_class}'{$css_style}>";

        $social_links = array( $facebook, $twitter, $google_plus, $instagram, $dribbble, $linkedin, $tumblr, $reddit, $yahoo, $deviantart, $vimeo, $youtube, $pinterest, $flickr, $paypal, $dropbox, $soundcloud, $skype, $rss, $email );
        $social_icons = array( 'fa fa-facebook', 'fa fa-twitter', 'fa fa-google-plus', 'fa fa-instagram', 'fa fa-dribbble', 'fa fa-linkedin', 'fa fa-tumblr', 'fa fa-reddit', 'fa fa-yahoo', 'fa fa-deviantart', 'fa fa-vimeo-square', 'fa fa-youtube', 'fa fa-pinterest-p', 'fa fa-flickr', 'fa fa-paypal', 'fa fa-dropbox', 'fa fa-soundcloud', 'fa fa-skype', 'fa fa-rss', 'fa fa-envelope' );
        $i = 0;
        foreach( $social_links as $social_link ) {
            if( $social_link ) {
                $social_links_div .= "<a class='social-link' href='{$social_link}'><i class='{$social_icons[$i]}'></i></a>";
            }
            $i++;
        }
        $social_links_div .= "</div>\n";    // social-links

        $output .= $social_links_div;
		return $output;
	}
}

vc_map ( array (
    "name" => __ ( "Social Links", 'cumulo_plugin' ),
    "base" => "cmo_social_links",
    "category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
    "icon" => plugins_url( '/assets/images/icon_sociallinks.png', dirname( __FILE__ ) ),
    "params" => array (
        array (
            "type" => "dropdown",
            "heading" => __ ( "Alignment", 'cumulo_plugin' ),
            "param_name" => "alignment",
            "value" => array (
                __ ( "Left", 'cumulo_plugin' ) => 'text-left',
                __ ( "Center", 'cumulo_plugin' ) => 'text-center',
                __ ( "Right", 'cumulo_plugin' ) => 'text-right',
            ),
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Facebook", 'cumulo_plugin' ),
            "param_name" => "facebook",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Twitter", 'cumulo_plugin' ),
            "param_name" => "twitter",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Google+", 'cumulo_plugin' ),
            "param_name" => "google_plus",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Instagram", 'cumulo_plugin' ),
            "param_name" => "instagram",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Dribbble", 'cumulo_plugin' ),
            "param_name" => "dribbble",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "LinkedIn", 'cumulo_plugin' ),
            "param_name" => "linkedin",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Tumblr", 'cumulo_plugin' ),
            "param_name" => "tumblr",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Reddit", 'cumulo_plugin' ),
            "param_name" => "reddit",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Yahoo", 'cumulo_plugin' ),
            "param_name" => "yahoo",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Deviantart", 'cumulo_plugin' ),
            "param_name" => "deviantart",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Vimeo", 'cumulo_plugin' ),
            "param_name" => "vimeo",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Youtube", 'cumulo_plugin' ),
            "param_name" => "youtube",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Pinterest", 'cumulo_plugin' ),
            "param_name" => "pinterest",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Flickr", 'cumulo_plugin' ),
            "param_name" => "flickr",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "PayPal", 'cumulo_plugin' ),
            "param_name" => "paypal",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Dropbox", 'cumulo_plugin' ),
            "param_name" => "dropbox",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Soundcloud", 'cumulo_plugin' ),
            "param_name" => "soundcloud",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Skype", 'cumulo_plugin' ),
            "param_name" => "skype",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "RSS", 'cumulo_plugin' ),
            "param_name" => "rss",
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( "Email", 'cumulo_plugin' ),
            "param_name" => "email",
        ),
        css_animation_class(),
        extra_class ()
    )
) );
