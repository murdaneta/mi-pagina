<?php
if( !defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

define ( 'CMO_THEME_URI', get_template_directory_uri () );

define ( 'CMO_FRAMEWORK_PATH', get_template_directory () . '/framework' );
define ( 'CMO_FRAMEWORK_URI', get_template_directory_uri () . '/framework' );

define ( 'CMO_THEME_NAME', 'Cumulo' );
define ( 'CMO_THEME_SLUG', 'cumulo' );
define ( 'CMO_THEME_VERSION', '1.2.3' );
define ( 'CMO_THEME_ADMIN_MENU_SLUG', CMO_THEME_SLUG . '-customizer' );

/* Component - Breadcrumb */
require_once( CMO_FRAMEWORK_PATH . '/inc/breadcrumb.php' );

/* Component - TGMPA */
require_once( CMO_FRAMEWORK_PATH . '/inc/class-tgm-plugin-activation.php' );

/* Component - Megamenu */
require_once( CMO_FRAMEWORK_PATH . '/inc/megamenu/megamenu.php' );

/* Component - Sidebar generator */
require_once( CMO_FRAMEWORK_PATH . '/inc/sidebar_generator.php' );

/* Component - Featured Galleries */
require_once( CMO_FRAMEWORK_PATH . '/inc/featured-galleries/featured-galleries.php' );

/* Component - Metaboxes */
require_once( CMO_FRAMEWORK_PATH . '/inc/metaboxes/metaboxes.php' );

/* Component - WP Customizer */
require_once( CMO_FRAMEWORK_PATH . '/inc/customizer/customizer.php' );

/* Component - Demo Importer */
require_once( CMO_FRAMEWORK_PATH . '/inc/demo-importer/demo-importer.php' );


/* Declare Widget Areas */
require_once( CMO_FRAMEWORK_PATH . '/inc/widgets.php' );

/* Framework Functions */
require_once( CMO_FRAMEWORK_PATH . '/inc/functions.php' );

/* Framework Init */
require_once( CMO_FRAMEWORK_PATH . '/inc/init.php' );
