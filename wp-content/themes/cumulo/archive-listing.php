<?php
get_header(); 
?>
<div id="main-container">
	<div class="page-content container page-property-archive">
		<section id="property-primary" class="site-content content epl-archive-default <?php echo epl_get_active_theme_name(); ?>">
			<div>
			<?php
			if ( have_posts() ) : ?>
				<div class="loop pad">
					<div class="entry-content loop-content">
						<?php do_action( 'epl_property_loop_start' ); ?>
						<?php while ( have_posts() ) : // The Loop
								the_post();
								do_action('epl_property_blog');
							endwhile; // end of one post
						?>
						<?php do_action( 'epl_property_loop_end' ); ?>
					</div>
					
					<div class="loop-footer">
						<div class="loop-utility clearfix">
							<?php do_action('epl_pagination'); ?>
						</div>
					</div>
				</div>
			<?php else : ?>
				<div class="hentry">
					<div class="entry-header clearfix">
						<h3 class="entry-title"><?php _e('Listing not Found', 'epl'); ?></h3>
					</div>
					
					<div class="entry-content clearfix">
						<p><?php _e('Listing not found, expand your search criteria and try again.', 'epl'); ?></p>
					</div>
				</div>
			<?php endif; ?>
			</div>
		</section>
	</div>
</div>
<?php
get_footer(); 
