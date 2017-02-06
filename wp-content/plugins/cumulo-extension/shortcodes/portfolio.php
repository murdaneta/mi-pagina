<?php
class WPBakeryShortCode_cmo_portfolio extends WPBakeryShortCode {
	private $havePost = false;
	private $wp_query;

	function content($atts, $content = null) {
		global $cmo_shortcode_options;
		$cmo_shortcode_options = shortcode_atts ( array (
				'style' 			=> 'grid',
				'grid_columns' 		=> '2',
				'masonry_columns' 	=> '2',
				'margin' 			=> 'default',
				'pagination' 		=> 'default',
				'show_filter' 		=> 'yes',
				'limit' 			=> '10',
				'category' 			=> '',
				'tag' 				=> '',
				'el_class' 			=> '', 
		), $atts );

		add_filter( 'post_class', array( $this, "cmo_secondary_loop_post_class" ) );

		$cmo_shortcode_options['style'] 			= cmo_get_sc_attr_theme_option( $cmo_shortcode_options, 'style', '_', 'portfolio-list-style' );
		$cmo_shortcode_options['grid_columns'] 		= cmo_get_sc_attr_theme_option( $cmo_shortcode_options, 'grid_columns', '_', 'portfolio-list-columns-grid' );
		$cmo_shortcode_options['masonry_columns'] 	= cmo_get_sc_attr_theme_option( $cmo_shortcode_options, 'masonry_columns', '_', 'portfolio-list-columns-masonry' );
		$cmo_shortcode_options['margin'] 			= cmo_get_sc_attr_theme_option( $cmo_shortcode_options, 'margin', '_', 'portfolio-list-margin' );
		$cmo_shortcode_options['pagination'] 		= cmo_get_sc_attr_theme_option( $cmo_shortcode_options, 'pagination', '_', 'portfolio-list-pagination' );

		$scid = uniqid( "cmosc-portfolio-" );
		$cmo_shortcode_options['wp_query'] = null;

		ob_start();

		if ( $cmo_shortcode_options['style'] == "grid" ) { ?>
<style scoped>
#<?php echo esc_html($scid); ?> .cmo-portfolio-items-wrapper {
	margin-left: -<?php echo esc_attr( floatval($cmo_shortcode_options['margin']) / 2 ); ?>px;
	margin-right: -<?php echo esc_attr( floatval($cmo_shortcode_options['margin']) / 2 ); ?>px;
}
#<?php echo esc_html($scid); ?> .cmo-portfolio-items-wrapper .cmo-portfolio-item {
	padding: <?php echo esc_attr( floatval($cmo_shortcode_options['margin']) / 2 ); ?>px;
}
</style>
		<?php echo '<div id="' . $scid . '" class="cmo-portfolio ' . esc_attr( $cmo_shortcode_options['el_class'] ) . '">';
		?>
<div class="cmo-portfolio-grid-list-wrapper" data-columns="<?php echo esc_attr( $cmo_shortcode_options['grid_columns'] ); ?>" data-margin="<?php echo esc_attr( $cmo_shortcode_options['margin'] ) ?>">
	<?php if ( $cmo_shortcode_options['show_filter'] == 'yes' ) { ?>
	<div class="cmo-portfolio-categories-wrapper">
		<ul class="filters">
			<li class="active"><a href="#" data-filter="*"><?php echo esc_html__( 'All', 'cumulo_plugin' )?></a></li>
			<?php
			$cmo_portfolio_category = get_terms( 'portfolio_category', array(
				'hide_empty' => false
			) );
			foreach( $cmo_portfolio_category as $cate ) {
				printf( '<li><a href="#" data-filter="%s">%s</a></li>', $cate->slug, $cate->name );
			}
			?>
		</ul>
	</div>
	<?php } ?>
	<div class="cmo-portfolio-items-wrapper">
		<?php $this->query_looper( ); ?>
	</div>
	<?php if ( $cmo_shortcode_options['pagination'] != 'none' ) { ?>
	<div class="cmo-portfolio-pagination-wrapper">
		<?php $this->do_pagination( ); ?>
	</div>
	<?php } ?>
</div>
		<?php }
		else if ( $cmo_shortcode_options['style'] == "fitcolumns") { ?>
<style scoped>
#<?php echo esc_html($scid); ?> .cmo-portfolio-items-wrapper {
	margin-left: -<?php echo esc_attr( floatval($cmo_shortcode_options['margin']) / 2 ); ?>px;
	margin-right: -<?php echo esc_attr( floatval($cmo_shortcode_options['margin']) / 2 ); ?>px;
}
#<?php echo esc_html($scid); ?> .cmo-portfolio-items-wrapper .cmo-portfolio-item {
	padding: <?php echo esc_attr( floatval($cmo_shortcode_options['margin']) / 2 ); ?>px;
}
</style>
		<?php echo '<div id="' . $scid . '" class="cmo-portfolio ' . esc_attr( $cmo_shortcode_options['el_class'] ) . '">';
		?>
<div class="cmo-portfolio-masonry-wrapper" data-columns="<?php echo esc_attr( $cmo_shortcode_options['masonry_columns'] ); ?>" data-margin="<?php echo esc_attr( $cmo_shortcode_options['margin'] ) ?>">
	<?php if ( $cmo_shortcode_options['show_filter'] == 'yes' ) { ?>
	<div class="cmo-portfolio-categories-wrapper">
		<ul class="filters">
			<li class="active"><a href="#" data-filter="*"><?php echo esc_html__( 'All', 'cumulo_plugin' )?></a></li>
			<?php
			$cmo_portfolio_category = get_terms( 'portfolio_category', array(
				'hide_empty' => false
			) );
			foreach( $cmo_portfolio_category as $cate ) {
				printf( '<li><a href="#" data-filter="%s">%s</a></li>', $cate->slug, $cate->name );
			}
			?>
		</ul>
	</div>
	<?php } ?>
	<div class="cmo-portfolio-items-wrapper cmo-portfolio-fit-columns">
		<?php $this->query_looper( ); ?>
	</div>
	<?php if ( $cmo_shortcode_options['pagination'] != 'none' ) { ?>
	<div class="cmo-portfolio-pagination-wrapper">
		<?php $this->do_pagination( ); ?>
	</div>
	<?php } ?>
</div>
		<?php }
		else if ( $cmo_shortcode_options['style'] == "masonry") { ?>
<style scoped>
#<?php echo esc_html($scid); ?> .cmo-portfolio-items-wrapper {
	margin-left: -<?php echo esc_attr( floatval($cmo_shortcode_options['margin']) / 2 ); ?>px;
	margin-right: -<?php echo esc_attr( floatval($cmo_shortcode_options['margin']) / 2 ); ?>px;
}
#<?php echo esc_html($scid); ?> .cmo-portfolio-items-wrapper .cmo-portfolio-item {
	padding: <?php echo esc_attr( floatval($cmo_shortcode_options['margin']) / 2 ); ?>px;
}

#<?php echo esc_html($scid); ?> .cmo-portfolio-masonry-wrapper[data-columns="2"] .cmo-portfolio-item.cmo-portfolio-width-dx.cmo-portfolio-height-x .cmo-portfolio-featured-image-bg,
#<?php echo esc_html($scid); ?> .cmo-portfolio-masonry-wrapper[data-columns="3"] .cmo-portfolio-item.cmo-portfolio-width-dx.cmo-portfolio-height-x .cmo-portfolio-featured-image-bg,
#<?php echo esc_html($scid); ?> .cmo-portfolio-masonry-wrapper[data-columns="4"] .cmo-portfolio-item.cmo-portfolio-width-dx.cmo-portfolio-height-x .cmo-portfolio-featured-image-bg {
	padding-top: 50%;
	padding-top: -webkit-calc( 50% - <?php echo esc_attr( floatval($cmo_shortcode_options['margin']) / 2 ); ?>px );
	padding-top: -moz-calc( 50% - <?php echo esc_attr( floatval($cmo_shortcode_options['margin']) / 2 ); ?>px );
	padding-top: calc( 50% - <?php echo esc_attr( floatval($cmo_shortcode_options['margin']) / 2 ); ?>px );

}
#<?php echo esc_html($scid); ?> .cmo-portfolio-masonry-wrapper[data-columns="2"] .cmo-portfolio-item.cmo-portfolio-width-x.cmo-portfolio-height-dx .cmo-portfolio-featured-image-bg,
#<?php echo esc_html($scid); ?> .cmo-portfolio-masonry-wrapper[data-columns="3"] .cmo-portfolio-item.cmo-portfolio-width-x.cmo-portfolio-height-dx .cmo-portfolio-featured-image-bg,
#<?php echo esc_html($scid); ?> .cmo-portfolio-masonry-wrapper[data-columns="4"] .cmo-portfolio-item.cmo-portfolio-width-x.cmo-portfolio-height-dx .cmo-portfolio-featured-image-bg {
	padding-top: 200%;
	padding-top: -webkit-calc( 200% + <?php echo esc_attr( floatval($cmo_shortcode_options['margin']) ); ?>px );
	padding-top: -moz-calc( 200% + <?php echo esc_attr( floatval($cmo_shortcode_options['margin']) ); ?>px );
	padding-top: calc( 200% + <?php echo esc_attr( floatval($cmo_shortcode_options['margin']) ); ?>px );
}
</style>
		<?php echo '<div id="' . $scid . '" class="cmo-portfolio ' . esc_attr( $cmo_shortcode_options['el_class'] ) . '">';
		?>
<div class="cmo-portfolio-masonry-wrapper" data-columns="<?php echo esc_attr( $cmo_shortcode_options['masonry_columns'] ); ?>" data-margin="<?php echo esc_attr( $cmo_shortcode_options['margin'] ) ?>">
	<?php if ( $cmo_shortcode_options['show_filter'] == 'yes' ) { ?>
	<div class="cmo-portfolio-categories-wrapper">
		<ul class="filters">
			<li class="active"><a href="#" data-filter="*"><?php echo esc_html__( 'All', 'cumulo_plugin' )?></a></li>
			<?php
			$cmo_portfolio_category = get_terms( 'portfolio_category', array( 
				'hide_empty' => false
			) );
			foreach( $cmo_portfolio_category as $cate ) {
				printf( '<li><a href="#" data-filter="%s">%s</a></li>', $cate->slug, $cate->name );
			}
			?>
		</ul>
	</div>
	<?php } ?>
	<div class="cmo-portfolio-items-wrapper">
		<?php $this->query_looper( ); ?>
	</div>
	<?php if ( $cmo_shortcode_options['pagination'] != 'none' ) { ?> 
	<div class="cmo-portfolio-pagination-wrapper">
		<?php $this->do_pagination( ); ?>
	</div>
	<?php } ?>
</div>
		<?php }

		echo "</div>";

		$output = ob_get_clean();
		remove_filter( 'post_class', "cmo_secondary_loop_post_class" );

		unset( $cmo_shortcode_options );

		return $output;
	}

	function query_looper( ) {
		global $cmo_shortcode_options;
		global $post;

		$query_vars = array();
		$query_vars['post_status'] = array('publish', 'private');
		$query_vars['post_type'] = 'cmo_portfolio';

		$category_terms = array_filter( explode( ",", preg_replace('/\s+/', ',', $cmo_shortcode_options['category']) ) );
		$tags_terms = array_filter( explode( ",", preg_replace('/\s+/', ',', $cmo_shortcode_options['tag']) ) );

		$query_vars['tax_query'] = array(
				'relation' => 'OR',
		);

		if ( !empty( $category_terms ) ) {
			array_push($query_vars['tax_query'], array(
						'taxonomy' => 'portfolio_category',
						'field'    => 'slug',
						'terms'    => $category_terms
				)
			);
		}

		if ( !empty( $tags_terms ) ) {
			array_push( $query_vars['tax_query'], array(
						'taxonomy' => 'portfolio_tags',
						'field'    => 'slug',
						'terms'    => $tags_terms
				)
			);
		}
		
		if ( count( $query_vars['tax_query'] ) <= 1 ) {
			unset( $query_vars['tax_query'] );
		}

		if ( $cmo_shortcode_options['pagination'] == 'none' ) {
			$query_vars['posts_per_page'] = $cmo_shortcode_options['limit'];
			$query_vars['paged'] = 1;
		}
		else {
			$query_vars['posts_per_page'] = get_option( "posts_per_page" );
			$query_vars['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		}

		$posts = new WP_Query ( $query_vars );
		$cmo_shortcode_options ['query_vars'] = $query_vars;

		$this->havePost = false;

		if ( $posts->have_posts() ) {
			$cmo_shortcode_options['is_paged'] = $posts->is_paged;

			while ( $posts->have_posts() ) {
				$posts->the_post();
				if ( $cmo_shortcode_options['style'] == 'fitcolumns' ) {
					get_template_part( "templates/portfolio/portfolio", "item2" );
				}
				else {
					get_template_part( "templates/portfolio/portfolio", "item" );
				}
			}
			$this->havePost = true;
		}
		else {
			// get_template_part( 'templates/portfolio/portfolio', 'none' );
			echo "No Portfolio Item";
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
				get_template_part( 'templates/portfolio/portfolio', 'pagination' );
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
		"name" => __ ( "Portfolio", 'cumulo_plugin' ),
		"base" => "cmo_portfolio",
		"category" => __ ( "by Theme-Paradise", 'cumulo_plugin' ),
		"icon" => plugins_url( '/assets/images/icon_portfoliolist.png', dirname( __FILE__ ) ),
		"params" => array (
				array (
						"type" => "dropdown",
						"heading" => __ ( "Portfolio List Style", 'cumulo_plugin' ),
						"param_name" => "style",
						"value" => array (
								__ ( "Grid", 'cumulo_plugin' ) 		=> 'grid',
								__ ( "Masonry", 'cumulo_plugin' ) 	=> 'masonry',
								__ ( "Masonry - Fit Columns", 'cumulo_plugin' ) 	=> 'fitcolumns',
						),
						"admin_label" => true
				),
				array (
						"type" => "dropdown",
						"heading" => __ ( "Grid Columns", 'cumulo_plugin' ),
						"param_name" => "grid_columns",
						"value" => array (
								__ ( "Theme Default", 'cumulo_plugin' ) => 'default',
								'2'  => '2',
								'3'  => '3',
								'4'  => '4'
						),
						'dependency' => array (
                			'element' => 'style',
                			'value' => 'grid',
            			)
				),
				array (
						"type" => "dropdown",
						"heading" => __ ( "Masonry Columns", 'cumulo_plugin' ),
						"param_name" => "masonry_columns",
						"value" => array (
								__ ( "Theme Default", 'cumulo_plugin' ) => 'default',
								'2'  => '2',
								'3'  => '3',
								'4'  => '4'
						),
						'dependency' => array(
                			'element' => 'style',
                			'value' => array( 'masonry', 'fitcolumns' )
            			)
				),
				array (
						"type" => "textfield",
						"heading" => __ ( "Margin", 'cumulo_plugin' ),
						"param_name" => "margin",
						"description" => __( "Margin between items", 'cumulo_plugin' )
				),
				array (
						"type" => "dropdown",
						"heading" => __ ( "Pagination", 'cumulo_plugin' ),
						"param_name" => "pagination",
						"value" => array (
								__ ( "Theme Default", 'cumulo_plugin' ) => 'default',
								__ ( "No Pagination", 'cumulo_plugin' ) => 'none',
								__ ( "Classic Pagination", 'cumulo_plugin' ) => 'classic',
								__ ( "Load on Button Click", 'cumulo_plugin' ) => 'load-more',
								__ ( "Load on Scroll", 'cumulo_plugin' ) => 'infinite-scroll'
						) 
				),
				array (
						"type" => "textfield",
						"heading" => __ ( "Maximum Number of Portfolios", 'cumulo_plugin' ),
						"param_name" => "limit",
						'dependency' => array(
								'element' => 'pagination',
								'value' => 'none',
						),
						'value' => '10'
				),
				array (
						"type" => "dropdown",
						"heading" => __ ( "Show Filter", 'cumulo_plugin' ),
						"param_name" => "show_filter",
						"value" => array (
								__ ( "Yes", 'cumulo_plugin' ) => 'yes',
								__ ( "No", 'cumulo_plugin' ) => 'no'
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