<?php

class WPBakeryShortCode_cmo_posts_carousel extends WPBakeryShortCode {
	function content($atts, $content = null) {
		extract ( shortcode_atts ( array (
				'count' 			=> 	4,
				'view_on_screen'	=>	2,
				'category'			=>	'',
				'tag'				=>	'',
				'el_class' 			=> 	'' 
		), $atts ) );

		$query_vars = array();
		$query_vars['post_status'] = array('publish', 'private');
		$query_vars['posts_per_page'] = $count;
		$query_vars['offset'] = 0;
		$query_vars['ignore_sticky_posts'] = true;
		
		$query_vars['ignore_sticky_posts'] = true;
		
		$query_vars['category_name'] = preg_replace('/(\s+,)|(,\s+)/', ',', trim($category));
		$query_vars['tag'] = preg_replace('/(\s+,)|(,\s+)/', ',', trim($tag));

		unset( $query_vars['paged'] );
		unset( $query_vars['pagename'] );
		unset( $query_vars['name'] );

		$output = "<div class='cmosc-post-carousel " . esc_attr( $el_class ) . "'>";

		global $post;
		$posts = new WP_Query( $query_vars );

		if( !$posts->have_posts() ) {
			$output .= "<div class='no-posts'>";
			$output .= __("No posts", 'cumulo_plugin');
			$output .= "</div>";
		}
		else 
		{ 
			$output .= "<div class='cmo-post-carousel-container' data-view-count='".esc_attr( $view_on_screen ) . "'>";

			while ( $posts->have_posts() ) {
				$posts->the_post();
				ob_start();
				get_template_part( "templates/onecolumn/content", get_post_format() );
				$output .= ob_get_clean();
			}
			$output .= "</div>";
		}

		wp_reset_postdata();

		$output .= "</div>";
		return $output;
	}
}

vc_map ( array (
		"name" => __ ( "Recent Posts Carousel", 'cumulo_plugin' ),
		"base" => "cmo_posts_carousel",
		"category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
		"icon" => plugins_url( '/assets/images/icon_postscarousel.png', dirname( __FILE__ ) ),
		"params" => array (
				array (
						"type" => "textfield",
						"heading" => __ ( "Total posts", 'cumulo_plugin' ),
						"param_name" => "count",
						"value" => "4",
						"admin_label" => true,
				),
				array (
						"type" => "textfield",
						"heading" => __ ( "Count visible", 'cumulo_plugin' ),
						"param_name" => "view_on_screen",
						"value" => "2"
				),
				array (
						"type" => "textfield",
						"heading" => __ ( "Categories", 'cumulo_plugin' ),
						"param_name" => "category",
						"description" => __( "Separate with comma for multiple categories", 'cumulo_plugin' )
				),
				array (
						"type" => "textfield",
						"heading" => __ ( "Tags", 'cumulo_plugin' ),
						"param_name" => "tag",
						"description" => __( "Use tag slugs, not tag name. Separate with comma for multiple tags", 'cumulo_plugin' )
				),
				extra_class () 
		) 
) );
