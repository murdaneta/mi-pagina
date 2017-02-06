<?php get_header(); ?>
<?php cmo_insert_slider() ?>
<div id="main-container">
	<?php 
	$cmo_sidebar = cmo_get_page_sidebar(); 
	if ( have_posts () ) {
		the_post ();
		$cmo_pstyle = cmo_get_page_theme_option( "portfolio_style", "portfolio-single-style" );
		?>
		<div class="page-content container page-single <?php echo esc_attr( $cmo_sidebar[1] ); ?>">
		<section class="cmo-mainbar cmo-single-portfolio <?php echo "cmo-single-portfolio-" . esc_attr($cmo_pstyle); ?>">
			<h2 class="hidden">Portfolio</h2>
			<?php
			get_template_part( "/templates/portfolio/single-{$cmo_pstyle}");
			?>
		</section>
		<?php 
		if( !empty( $cmo_sidebar[0] ) && is_active_sidebar( $cmo_sidebar[0] ) ) : ?> 
		<aside class="cmo-sidebar">
			<?php dynamic_sidebar( $cmo_sidebar[0] ); ?>
		</aside>
		<?php endif; ?>	
	</div>
	<?php } ?>
</div>
<?php
get_footer();