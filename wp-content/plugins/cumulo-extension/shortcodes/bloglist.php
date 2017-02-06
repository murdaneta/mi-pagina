<?php

class WPBakeryShortCode_cmo_bloglist extends WPBakeryShortCode {
	private $havePost = false;
	private $wp_query;

	function content($atts, $content = null) {
		global $cmo_shortcode_options;
		$cmo_shortcode_options = shortcode_atts ( array (
				'style' => 'default',
				'masonry_columns' => 'default',
				'modern_full'	=> 'default',
				'pagination' => 'default',
				'category' => '',
				'tag' => '',
				'el_class' => '', 
		), $atts );

		add_filter( 'post_class', array( $this, "cmo_secondary_loop_post_class" ) );

		$cmo_shortcode_options['style'] = cmo_get_sc_attr_theme_option( $cmo_shortcode_options, 'style', '_', 'blog-list-style' );
		$cmo_shortcode_options['masonry_columns'] = cmo_get_sc_attr_theme_option( $cmo_shortcode_options, 'masonry_columns', '_', 'blog-list-masonry-columns' );
		$cmo_shortcode_options['modern_full'] = cmo_get_sc_attr_theme_option( $cmo_shortcode_options, 'modern_full', '_', 'blog-list-modern-full' );
		$cmo_shortcode_options['pagination'] = cmo_get_sc_attr_theme_option( $cmo_shortcode_options, 'pagination', '_', 'blog-list-pagination' );

		$cmo_shortcode_options['wp_query'] = null;

		ob_start();
		echo "<div class='blog-list-style-" . esc_attr( $cmo_shortcode_options['style'] ) . " " . esc_attr( $cmo_shortcode_options['el_class'] ) . "'>";

		if ( $cmo_shortcode_options['style'] == "onecolumn" ) { ?>
<div class="cmo-blogs-list-container" data-posts-per-page="<?php echo esc_attr( get_option('posts_per_page') ); ?>" data-style="onecolumn" >
	<?php 
	$this->query_looper( ); 
	$this->do_pagination();
	?>
</div>
		<?php }
		else if ( $cmo_shortcode_options['style'] == "modern") { ?>
<div class="cmo-blogs-list-container container" data-posts-per-page="<?php echo esc_attr( get_option('posts_per_page') ); ?>" data-style="modern">
<div class='cmo-article-start-border'></div>
	<?php $this->query_looper( ); ?>
<div class='cmo-article-end-border'></div>
	<?php $this->do_pagination(); ?>
</div>
		<?php }
		else if ( $cmo_shortcode_options['style'] == "masonry") { ?>
<div class="cmo-blogs-list-container" data-posts-per-page="<?php echo esc_attr( get_option('posts_per_page') ); ?>" data-style="masonry">
<div class='blog-list-isotope-container masonry-<?php echo esc_attr( $cmo_shortcode_options['masonry_columns'] ) ?>-columns'>
	<?php $this->query_looper( ); ?>
</div>
	<?php $this->do_pagination(); ?>
</div>
		<?php }

		echo "</div>";
		$output = ob_get_clean();
		remove_filter( 'post_class', "cmo_secondary_loop_post_class" );
		return $output;
	}

	function query_looper( ) {
		global $cmo_shortcode_options;
		global $post;

		// $orderby = @$_GET['orderby'];
		// $order = @$_GET['order'];

		$query_vars = array();
		$query_vars['post_status'] = array('publish', 'private');

		$query_vars['category_name'] = preg_replace('/(\s+,)|(,\s+)/', ',', trim($cmo_shortcode_options['category']));
		$query_vars['tag'] = preg_replace('/(\s+,)|(,\s+)/', ',', trim($cmo_shortcode_options['tag']));

		// $query_vars['orderby'] = empty($orderby) ? "date" : $orderby;
		// $query_vars['order'] = empty($order) ? "DESC" : $order;

		$query_vars['posts_per_page'] = get_option( "posts_per_page" );
		$query_vars['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		$posts = new WP_Query ( $query_vars );

		$this->havePost = false;

		if ( $posts->have_posts() ) {
			$cmo_shortcode_options['is_paged'] = $posts->is_paged;

			while ( $posts->have_posts() ) {
				$posts->the_post();
				get_template_part( "templates/{$cmo_shortcode_options['style']}/content", get_post_format() );
			}
			$this->havePost = true;
		}
		else {
			get_template_part( 'templates/content', 'none' );
		}

		$this->wp_query = $posts;
		wp_reset_postdata();
	}

	function do_pagination() {
		global $cmo_shortcode_options;

		if ( $this->havePost ) {
			if ( $cmo_shortcode_options['pagination'] == 'classic' ) {
				cmo_posts_pagination_on_secondary_loop( $this->wp_query, array(
					'prev_text'          => "<i class='fa fa-chevron-left'></i>",
					'next_text'          => "<i class='fa fa-chevron-right'></i>"
				) );

			}
			else {
				get_template_part( 'templates/content', 'pagination' );
			}
		}
	}

	function cmo_secondary_loop_post_class( $classes ) {
		global $post;
		global $cmo_shortcode_options;

		if ( is_sticky( $post->ID ) ) {
			if ( ! $cmo_shortcode_options['is_paged'] ) {
				array_push( $classes, 'sticky' );
			}
		}

		return $classes;
	}
}

vc_map ( array (
		"name" => __ ( "Blog List", 'cumulo_plugin' ),
		"base" => "cmo_bloglist",
		"category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
		"icon" => plugins_url( '/assets/images/icon_bloglist.png', dirname( __FILE__ ) ),
		"params" => array (
				array (
						"type" => "dropdown",
						"heading" => __ ( "Blog List Style", 'cumulo_plugin' ),
						"param_name" => "style",
						"value" => array (
								__ ( "Theme Default", 'cumulo_plugin' ) => 'default',
								__ ( "One Column", 'cumulo_plugin' ) => 'onecolumn',
								__ ( "Modern", 'cumulo_plugin' ) => 'modern',
								__ ( "Masonry", 'cumulo_plugin' ) => 'masonry',
						),
						"admin_label" => true
				),
				array (
						"type" => "dropdown",
						"heading" => __ ( "Masonry Columns", 'cumulo_plugin' ),
						"param_name" => "masonry_columns",
						"value" => array (
								__ ( "Theme Default", 'cumulo_plugin' ) => 'default',
								__ ( "Two Columns", 'cumulo_plugin' )  => '2',
								__ ( "Three Columns", 'cumulo_plugin' )  => '3',
								__ ( "Four Columns", 'cumulo_plugin' )  => '4'
						),
						'dependency' => array(
                			'element' => 'style',
                			'value' => 'masonry',
            			)
				),
				array (
						"type" => "dropdown",
						"heading" => __ ( "Full Width for Modern Style", 'cumulo_plugin' ),
						"param_name" => "modern_full",
						"value" => array (
								__ ( "Theme Default", 'cumulo_plugin' ) => 'default',
								__ ( "Yes", 'cumulo_plugin' ) => '1',
								__ ( "No", 'cumulo_plugin' ) => '0'
						),
						"description" => __ ( "To make full width, you must set container's Row Stretch property as 'Stretch row and content(no paddings)'", 'cumulo_plugin' ),
						'dependency' => array(
                			'element' => 'style',
                			'value' => 'modern',
            			)
				),
				array (
						"type" => "dropdown",
						"heading" => __ ( "Pagination", 'cumulo_plugin' ),
						"param_name" => "pagination",
						"value" => array (
								__ ( "Theme Default", 'cumulo_plugin' ) => 'default',
								__ ( "Classic Pagination", 'cumulo_plugin' ) => 'classic',
								__ ( "Load on Button Click", 'cumulo_plugin' ) => 'load-more',
								__ ( "Load on Scroll", 'cumulo_plugin' ) => 'infinite-scroll'
						) 
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