<?php
function cmo_register_post_type_portfolio() {
	register_post_type ( 'cmo_portfolio', array (
			'labels' => array (
					'name' => __ ( 'Portfolio', 'cumulo_plugin' ),
					'singular_name' => __ ( 'Portfolio', 'cumulo_plugin' ) 
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array (
					'slug' => 'portfolio-items', 
			),
			'supports' => array (
					'title',
					'editor',
//					'excerpt',
//					'author',
					'thumbnail',
//					'comments',
					'revisions',
//					'custom-fields',
//					'page-attributes',
//					'post-formats' 
			),
			'can_export' => true 
	) );
	
	register_taxonomy ( 'portfolio_category', 'cmo_portfolio', array (
			'hierarchical' => false,
			'label' => __ ( 'Portfolio Categories', 'cumulo_plugin' ),
			'query_var' => true,
			'rewrite' => true 
	) );
	register_taxonomy ( 'portfolio_tags', 'cmo_portfolio', array (
			'hierarchical' => false,
			'label' => __ ( 'Portfolio Tags', 'cumulo_plugin' ),
			'query_var' => true,
			'rewrite' => true 
	) );
}

add_action( 'init', 'cmo_register_post_type_portfolio' );