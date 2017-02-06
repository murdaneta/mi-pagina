<?php get_header(); ?>
<?php cmo_insert_slider(); ?>
<div id="main-container">
	<?php $cmo_sidebar = cmo_get_page_sidebar(); ?>
	<div class="page-content container page-page <?php echo esc_attr( $cmo_sidebar[1] ); ?>">
		<section class="cmo-mainbar">
			<h2 class="hidden">Page - <?php the_title() ?></h2>
			<?php if (have_posts ()) : while ( have_posts () ) : the_post (); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
			</article>
			<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
			<?php endwhile; endif; ?>
		</section>

		<?php
		if( !empty( $cmo_sidebar[0] ) && is_active_sidebar( $cmo_sidebar[0] ) ) : ?> 
		<aside class="cmo-sidebar">
			<?php dynamic_sidebar( $cmo_sidebar[0] ); ?>
		</aside>
		<?php endif; ?>
	</div>
</div>
<?php
get_footer();