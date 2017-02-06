<?php $cmo_sidebar = cmo_get_page_sidebar(); ?>
<section class="cmo-mainbar cmo-blogs-list-container" data-posts-per-page="<?php echo get_option('posts_per_page'); ?>" data-style="masonry">
	<h2 class="hidden">Blogs</h2>
	<?php get_template_part( 'templates/masonry/looper' ); ?>
</section>
<?php 
if ( !empty( $cmo_sidebar[0] ) ) : ?> 
<aside class="cmo-sidebar">
	<?php dynamic_sidebar( $cmo_sidebar[0] ); ?>
</aside>
<?php endif; ?>