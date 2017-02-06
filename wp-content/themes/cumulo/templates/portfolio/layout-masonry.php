<?php
$isFull = cmo_get_theme_mod_value( "portfolio-list-full" ) == 'yes';
$columns = cmo_get_theme_mod_value( "portfolio-list-columns-masonry" );
$margin = floatval( cmo_get_theme_mod_value( "portfolio-list-margin" ) );
$cmo_sidebar = cmo_get_page_sidebar();
?>
<style scoped>
	.cmo-portfolio-items-wrapper {
		margin: -<?php echo esc_attr( $margin / 2 ); ?>px;
	}

	.cmo-portfolio-items-wrapper .cmo-portfolio-item {
		padding: <?php echo esc_attr( $margin / 2 ); ?>px;
	}
	
	#main-container .page-content.portfolio-list-style-masonry .cmo-portfolio-masonry-wrapper[data-columns="2"] .cmo-portfolio-item.cmo-portfolio-width-dx.cmo-portfolio-height-x .cmo-portfolio-featured-image-bg,
	#main-container .page-content.portfolio-list-style-masonry .cmo-portfolio-masonry-wrapper[data-columns="3"] .cmo-portfolio-item.cmo-portfolio-width-dx.cmo-portfolio-height-x .cmo-portfolio-featured-image-bg,
	#main-container .page-content.portfolio-list-style-masonry .cmo-portfolio-masonry-wrapper[data-columns="4"] .cmo-portfolio-item.cmo-portfolio-width-dx.cmo-portfolio-height-x .cmo-portfolio-featured-image-bg {
		padding-top: 50%;
		padding-top: -webkit-calc( 50% - <?php echo esc_attr( $margin / 2 ); ?>px );
		padding-top: -moz-calc( 50% - <?php echo esc_attr( $margin / 2 ); ?>px );
		padding-top: calc( 50% - <?php echo esc_attr( $margin / 2 ); ?>px );
	}
	#main-container .page-content.portfolio-list-style-masonry .cmo-portfolio-masonry-wrapper[data-columns="2"] .cmo-portfolio-item.cmo-portfolio-width-x.cmo-portfolio-height-dx .cmo-portfolio-featured-image-bg,
	#main-container .page-content.portfolio-list-style-masonry .cmo-portfolio-masonry-wrapper[data-columns="3"] .cmo-portfolio-item.cmo-portfolio-width-x.cmo-portfolio-height-dx .cmo-portfolio-featured-image-bg,
	#main-container .page-content.portfolio-list-style-masonry .cmo-portfolio-masonry-wrapper[data-columns="4"] .cmo-portfolio-item.cmo-portfolio-width-x.cmo-portfolio-height-dx .cmo-portfolio-featured-image-bg {
		padding-top: 200%;
		padding-top: -webkit-calc( 200% + <?php echo esc_attr( $margin ); ?>px );
		padding-top: -moz-calc( 200% + <?php echo esc_attr( $margin ); ?>px );
		padding-top: calc( 200% + <?php echo esc_attr( $margin ); ?>px );
	}
	
</style>
<section class="cmo-portfolio-masonry-wrapper cmo-mainbar" data-columns="<?php echo esc_attr( $columns ); ?>" data-margin="<?php echo esc_attr( $margin ) ?>">
	<h2 class="hidden">Portfolios</h2>
	<div class="cmo-portfolio-categories-wrapper">
		<ul class="filters">
			<li class="active"><a href="#" data-filter="*"><?php echo esc_html__( 'All', 'cumulo' )?></a></li>
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
	<div class="cmo-portfolio-items-wrapper">
	<?php
		while ( have_posts () ) {
			the_post();
			get_template_part( 'templates/portfolio/portfolio', 'item' );
		}
	?>
	</div>
	<div class="cmo-portfolio-pagination-wrapper">
		<?php get_template_part( 'templates/portfolio/portfolio', 'pagination' )?>
	</div>
</section>
<?php if ( !$isFull && !empty( $cmo_sidebar[0] ) ) : ?> 
<aside class="cmo-sidebar">
	<?php dynamic_sidebar( $cmo_sidebar[0] ); ?>
</aside>
<?php endif; ?>