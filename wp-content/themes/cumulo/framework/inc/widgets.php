<?php

function cmo_register_sidebars() {
	/* Sidebars */
	register_sidebar ( array (
			'name' => __ ( 'Main Sidebar', 'cumulo' ),
			'id' => 'cmo-main-sidebar',
			'before_widget' => '<div id="%1$s" class="cmo-main-sidebar clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>' 
	) );
	register_sidebar ( array (
			'name' => __ ( 'Shop Sidebar', 'cumulo' ),
			'id' => 'cmo-shop-sidebar',
			'before_widget' => '<div id="%1$s" class="cmo-shop-sidebar clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>' 
	) );
	
	/* Footer widget columns */
	register_sidebar ( array (
			'name' => __ ( 'Footer Widget Area 1', 'cumulo' ),
			'id' => 'cmo-footer-sidebar-1',
			'before_widget' => '<div id="%1$s" class="cmo-footer-sidebar-1 clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>' 
	) );
	register_sidebar ( array (
			'name' => __ ( 'Footer Widget Area 2', 'cumulo' ),
			'id' => 'cmo-footer-sidebar-2',
			'before_widget' => '<div id="%1$s" class="cmo-footer-sidebar-2 clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>' 
	) );
	register_sidebar ( array (
			'name' => __ ( 'Footer Widget Area 3', 'cumulo' ),
			'id' => 'cmo-footer-sidebar-3',
			'before_widget' => '<div id="%1$s" class="cmo-footer-sidebar-3 clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>' 
	) );
	register_sidebar ( array (
			'name' => __ ( 'Footer Widget Area 4', 'cumulo' ),
			'id' => 'cmo-footer-sidebar-4',
			'before_widget' => '<div id="%1$s" class="cmo-footer-sidebar-4 clearfix %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>' 
	) );
}