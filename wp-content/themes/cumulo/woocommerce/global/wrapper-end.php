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

echo '</section>';

$woo_sidebar = cmo_get_page_sidebar( "woocommerce-select-sidebar", "woocommerce-sidebar-position" );

if( !empty( $woo_sidebar[0] ) && is_active_sidebar( $woo_sidebar[0] ) ) {
		echo "<aside class='cmo-sidebar'>";
	dynamic_sidebar( $woo_sidebar[0] );
		echo "</aside>";
	}

echo '</div></div>';