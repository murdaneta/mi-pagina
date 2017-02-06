<?php
function cmo_register_post_type_property() {
	register_post_type ( 'cmo_property', array (
			'labels' => array (
					'name' => __ ( 'Property', 'cumulo_plugin' ),
					'singular_name' => __ ( 'Property', 'cumulo_plugin' ) 
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array (
					'slug' => 'property-listing', 
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
	
	register_taxonomy ( 'property_category', 'cmo_property', array (
			'hierarchical' => false,
			'label' => __ ( 'Property Categories', 'cumulo_plugin' ),
			'query_var' => true,
			'rewrite' => true 
	) );
	register_taxonomy ( 'property_tags', 'cmo_property', array (
			'hierarchical' => false,
			'label' => __ ( 'Property Tags', 'cumulo_plugin' ),
			'query_var' => true,
			'rewrite' => true 
	) );
}

add_action( 'init', 'cmo_register_post_type_property' );