<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$sclass = "";


$woo_sidebar = cmo_get_page_sidebar( "woocommerce-select-sidebar", "woocommerce-sidebar-position" );

if( !empty( $woo_sidebar[0] ) && is_active_sidebar( $woo_sidebar[0] ) ) {
    $sclass = $woo_sidebar[1];
}

echo '<div id="main-container"><div class="page-content container page-woo ' . $sclass . '"><section class="cmo-mainbar"><h2 class="hidden">Products</h2>';