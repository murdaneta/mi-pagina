<?php
/*
Plugin Name: Cumulo Extension
Plugin URI: http://themeforest.net/user/Theme-Paradise
Description: Plugin to contain shortcodes and custom post types of Cumulo theme.
Author: Theme-Paradise
Author URI: http://themeforest.net/user/Theme-Paradise
Version: 1.1
Text Domain: cumulo-extension
*/

define( 'CMO_PLUGIN_PATH', ABSPATH . 'wp-content/plugins/cumulo-extension' );

// Plugin URL
define( 'CMO_PLUGIN_URL', plugins_url( '', __FILE__ ) );

/* Declare Custom Post Type: Portfolio */
require_once( 'inc/portfolio.php' );
// require_once( 'inc/property.php' );
require_once( 'inc/likepost.php' );
require_once( 'inc/totop.php' );

/* Shortcodes */
require_once( 'shortcodes/shortcodes.php' );

add_action( 'after_setup_theme', 'cmo_load_plugin_textdomain' );
function cmo_load_plugin_textdomain() {
	load_plugin_textdomain( 'cumulo_plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
}

function cmo_admin_enqueue_scripts_styles() {
    wp_enqueue_style(
        'cmo-ext-admin-css',
        CMO_PLUGIN_URL . '/assets/css/admin.css'
    );

    wp_enqueue_script(
        'cmo-composer-functions',
        CMO_PLUGIN_URL . '/assets/js/backend/composer-custom-views.js',
        array( 'jquery', 'wpb_js_composer_js_custom_views' ),
        false,
        true
    );

    wp_register_style( 'et-line-font', get_template_directory_uri() . '/assets/vendor/et-line-font/style.css', false, '1.0.0' );
    wp_enqueue_style( 'et-line-font' );
}
add_action( 'admin_enqueue_scripts', 'cmo_admin_enqueue_scripts_styles' );

/* adding et-line to visual composer */
add_filter( 'vc_iconpicker-type-etline', 'vc_iconpicker_type_etline' );
function vc_iconpicker_type_etline( $icons ) {
    $etline_icons = array(
        array( "et-line icon-mobile"        => __( "Mobile", 'cumulo_plugin' ) ),
        array( "et-line icon-laptop"        => __( "Laptop", 'cumulo_plugin' ) ),
        array( "et-line icon-desktop"       => __( "Desktop", 'cumulo_plugin' ) ),
        array( "et-line icon-tablet"        => __( "Tablet", 'cumulo_plugin' ) ),
        array( "et-line icon-phone"         => __( "Phone", 'cumulo_plugin' ) ),
        array( "et-line icon-document"      => __( "Document", 'cumulo_plugin' ) ),
        array( "et-line icon-documents"     => __( "Documents", 'cumulo_plugin' ) ),
        array( "et-line icon-search"        => __( "Search", 'cumulo_plugin' ) ),
        array( "et-line icon-clipboard"     => __( "Clipboard", 'cumulo_plugin' ) ),
        array( "et-line icon-newspaper"     => __( "Newspaper", 'cumulo_plugin' ) ),
        array( "et-line icon-notebook"      => __( "Notebook", 'cumulo_plugin' ) ),
        array( "et-line icon-book-open"     => __( "Book Open", 'cumulo_plugin' ) ),
        array( "et-line icon-browser"       => __( "Browser", 'cumulo_plugin' ) ),
        array( "et-line icon-calendar"      => __( "Calendar", 'cumulo_plugin' ) ),
        array( "et-line icon-presentation"  => __( "Presentation", 'cumulo_plugin' ) ),
        array( "et-line icon-picture"       => __( "Picture", 'cumulo_plugin' ) ),
        array( "et-line icon-pictures"      => __( "Pictures", 'cumulo_plugin' ) ),
        array( "et-line icon-video"         => __( "Video", 'cumulo_plugin' ) ),
        array( "et-line icon-camera"        => __( "Camera", 'cumulo_plugin' ) ),
        array( "et-line icon-printer"       => __( "Printer", 'cumulo_plugin' ) ),
        array( "et-line icon-toolbox"       => __( "Toolbox", 'cumulo_plugin' ) ),
        array( "et-line icon-briefcase"     => __( "Briefcase", 'cumulo_plugin' ) ),
        array( "et-line icon-wallet"        => __( "Wallet", 'cumulo_plugin' ) ),
        array( "et-line icon-gift"          => __( "Gift", 'cumulo_plugin' ) ),
        array( "et-line icon-bargraph"      => __( "Bargraph", 'cumulo_plugin' ) ),
        array( "et-line icon-grid"          => __( "Grid", 'cumulo_plugin' ) ),
        array( "et-line icon-expand"        => __( "Expand", 'cumulo_plugin' ) ),
        array( "et-line icon-focus"         => __( "Focus", 'cumulo_plugin' ) ),
        array( "et-line icon-edit"          => __( "Edit", 'cumulo_plugin' ) ),
        array( "et-line icon-adjustments"   => __( "Adjustments", 'cumulo_plugin' ) ),
        array( "et-line icon-ribbon"        => __( "Ribbon", 'cumulo_plugin' ) ),
        array( "et-line icon-hourglass"     => __( "Hourglass", 'cumulo_plugin' ) ),
        array( "et-line icon-lock"          => __( "Lock", 'cumulo_plugin' ) ),
        array( "et-line icon-megaphone"     => __( "Megaphone", 'cumulo_plugin' ) ),
        array( "et-line icon-shield"        => __( "Shield", 'cumulo_plugin' ) ),
        array( "et-line icon-trophy"        => __( "Trophy", 'cumulo_plugin' ) ),
        array( "et-line icon-flag"          => __( "Flag", 'cumulo_plugin' ) ),
        array( "et-line icon-map"           => __( "Map", 'cumulo_plugin' ) ),
        array( "et-line icon-puzzle"        => __( "Puzzle", 'cumulo_plugin' ) ),
        array( "et-line icon-basket"        => __( "Basket", 'cumulo_plugin' ) ),
        array( "et-line icon-envelope"      => __( "Envelope", 'cumulo_plugin' ) ),
        array( "et-line icon-streetsign"    => __( "Street Sign", 'cumulo_plugin' ) ),
        array( "et-line icon-telescope"     => __( "Telescope", 'cumulo_plugin' ) ),
        array( "et-line icon-gears"         => __( "Gears", 'cumulo_plugin' ) ),
        array( "et-line icon-key"           => __( "Key", 'cumulo_plugin' ) ),
        array( "et-line icon-paperclip"     => __( "Paper Clip", 'cumulo_plugin' ) ),
        array( "et-line icon-attachment"    => __( "Attachment", 'cumulo_plugin' ) ),
        array( "et-line icon-pricetags"     => __( "Pricetags", 'cumulo_plugin' ) ),
        array( "et-line icon-lightbulb"     => __( "Lightbulb", 'cumulo_plugin' ) ),
        array( "et-line icon-layers"        => __( "Layers", 'cumulo_plugin' ) ),
        array( "et-line icon-pencil"        => __( "Lightbulb", 'cumulo_plugin' ) ),
        array( "et-line icon-tools"         => __( "Tools", 'cumulo_plugin' ) ),
        array( "et-line icon-tools-2"       => __( "Tools 2", 'cumulo_plugin' ) ),
        array( "et-line icon-scissors"      => __( "Scissors", 'cumulo_plugin' ) ),
        array( "et-line icon-paintbrush"    => __( "Paintbrush", 'cumulo_plugin' ) ),
        array( "et-line icon-magnifying-glass"  => __( "Magnifying Glass", 'cumulo_plugin' ) ),
        array( "et-line icon-circle-compass"     => __( "Circle Compass", 'cumulo_plugin' ) ),
        array( "et-line icon-linegraph"     => __( "Linegraph", 'cumulo_plugin' ) ),
        array( "et-line icon-mic"           => __( "Mic", 'cumulo_plugin' ) ),
        array( "et-line icon-strategy"      => __( "Strategy", 'cumulo_plugin' ) ),
        array( "et-line icon-beaker"        => __( "Beaker", 'cumulo_plugin' ) ),
        array( "et-line icon-caution"       => __( "Caution", 'cumulo_plugin' ) ),
        array( "et-line icon-recycle"       => __( "Recycle", 'cumulo_plugin' ) ),
        array( "et-line icon-anchor"        => __( "Anchor", 'cumulo_plugin' ) ),
        array( "et-line icon-profile-male"  => __( "Profile Male", 'cumulo_plugin' ) ),
        array( "et-line icon-profile-female"    => __( "Profile Female", 'cumulo_plugin' ) ),
        array( "et-line icon-bike"          => __( "Biker", 'cumulo_plugin' ) ),
        array( "et-line icon-wine"          => __( "Wine", 'cumulo_plugin' ) ),
        array( "et-line icon-hotairballoon" => __( "Hot Air Balloon", 'cumulo_plugin' ) ),
        array( "et-line icon-globe"         => __( "Globe", 'cumulo_plugin' ) ),
        array( "et-line icon-genius"        => __( "Genius", 'cumulo_plugin' ) ),
        array( "et-line icon-map-pin"       => __( "Map Pin", 'cumulo_plugin' ) ),
        array( "et-line icon-dial"          => __( "Dial", 'cumulo_plugin' ) ),
        array( "et-line icon-chat"          => __( "Chat", 'cumulo_plugin' ) ),
        array( "et-line icon-heart"         => __( "Heart", 'cumulo_plugin' ) ),
        array( "et-line icon-cloud"         => __( "Cloud", 'cumulo_plugin' ) ),
        array( "et-line icon-upload"        => __( "Upload", 'cumulo_plugin' ) ),
        array( "et-line icon-download"      => __( "Download", 'cumulo_plugin' ) ),
        array( "et-line icon-target"        => __( "Target", 'cumulo_plugin' ) ),
        array( "et-line icon-hazardous"     => __( "Hazardous", 'cumulo_plugin' ) ),
        array( "et-line icon-piechart"      => __( "Piechart", 'cumulo_plugin' ) ),
        array( "et-line icon-speedometer"   => __( "Speedometer", 'cumulo_plugin' ) ),
        array( "et-line icon-global"        => __( "Global", 'cumulo_plugin' ) ),
        array( "et-line icon-compass"       => __( "Compass", 'cumulo_plugin' ) ),
        array( "et-line icon-lifesaver"     => __( "Lifesaver", 'cumulo_plugin' ) ),
        array( "et-line icon-clock"         => __( "Clock", 'cumulo_plugin' ) ),
        array( "et-line icon-aperture"      => __( "Aperture", 'cumulo_plugin' ) ),
        array( "et-line icon-quote"         => __( "Quote", 'cumulo_plugin' ) ),
        array( "et-line icon-scope"         => __( "Scope", 'cumulo_plugin' ) ),
        array( "et-line icon-alarmclock"    => __( "Alarm Clock", 'cumulo_plugin' ) ),
        array( "et-line icon-refresh"       => __( "Refresh", 'cumulo_plugin' ) ),
        array( "et-line icon-happy"         => __( "Happy", 'cumulo_plugin' ) ),
        array( "et-line icon-sad"           => __( "Sad", 'cumulo_plugin' ) ),
        array( "et-line icon-facebook"      => __( "Facebook", 'cumulo_plugin' ) ),
        array( "et-line icon-twitter"       => __( "Twitter", 'cumulo_plugin' ) ),
        array( "et-line icon-googleplus"    => __( "Google Plus", 'cumulo_plugin' ) ),
        array( "et-line icon-rss"           => __( "RSS", 'cumulo_plugin' ) ),
        array( "et-line icon-tumblr"        => __( "Tumblr", 'cumulo_plugin' ) ),
        array( "et-line icon-linkedin"      => __( "Linkedin", 'cumulo_plugin' ) ),
        array( "et-line icon-dribbble"      => __( "Dribble", 'cumulo_plugin' ) ),
    );

    return array_merge( $icons, $etline_icons );
}
    
function add_css_animation_css( $class, $tag, $atts = null ) {
   	if( $atts != null ) {
   		if( $tag == 'vc_column_text' && !empty( $atts['cmo_css_animation'] ) ) {
   			$class = str_replace( ' wpb_animate_when_almost_visible', '', $class );
   			$class .= get_css_animation( $atts['cmo_css_animation'] );
   		}
   	}
 	return $class;
}