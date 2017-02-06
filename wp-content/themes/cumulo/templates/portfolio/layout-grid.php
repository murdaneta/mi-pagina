<?php
$isFull = cmo_get_theme_mod_value( "portfolio-list-full" ) == 'yes';
$columns = cmo_get_theme_mod_value( "portfolio-list-columns-grid" );
$margin = cmo_get_theme_mod_value( "portfolio-list-margin" );
$cmo_sidebar = cmo_get_page_sidebar();
?>
<style scoped>
	.cmo-portfolio-items-wrapper {
		margin: -<?php echo esc_attr( $margin / 2 ); ?>px;
	}

	.cmo-portfolio-items-wrapper .cmo-portfolio-item {
		padding: <?php echo esc_attr( $margin / 2 ); ?>px;
	}
</style>
<section class="cmo-portfolio-grid-list-wrapper cmo-mainbar" data-columns="<?php echo esc_attr( $columns ); ?>" data-margin="<?php echo esc_attr( $margin ) ?>">
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