<?php get_header(); ?>
<?php $cmo_sidebar = cmo_get_page_sidebar(); ?>
<?php cmo_insert_slider() ?>
<div id="main-container">
	<div class="page-content container page-property-single <?php echo esc_attr( $cmo_sidebar[1] ); ?>">
		<div id="property-primary-single" class="site-content content-area epl-single-default <?php echo epl_get_active_theme_name(); ?> cmo-mainbar">
			<section class="content">
				<div id="content" class="pad" role="main">
					<?php
					if ( have_posts() ) : ?>
						<div class="loop">
							<div class="loop-content">
								<?php
									while ( have_posts() ) : // The Loop
										the_post();
										do_action('epl_property_single');
										comments_template(); // include comments template
									endwhile; // end of one post
								?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</section>
		</div>	
		<?php 
		if( !empty( $cmo_sidebar[0] ) && is_active_sidebar( $cmo_sidebar[0] ) ) : ?> 
		<aside class="cmo-sidebar">
			<?php dynamic_sidebar( $cmo_sidebar[0] ); ?>
		</aside>
		<?php endif; ?>	
	</div>
</div>
<?php get_footer(); ?>
