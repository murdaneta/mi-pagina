<?php
$cmo_modern_full = cmo_get_theme_mod_value('blog-list-modern-full') == 1;
?>
<section class="cmo-mainbar cmo-blogs-list-container <?php echo ($cmo_modern_full)?"cmo-modern-full":"" ?>" data-posts-per-page="<?php echo get_option('posts_per_page'); ?>" data-style="modern">
	<h2 class="hidden">Blogs</h2>
	<?php get_template_part( 'templates/modern/looper' ); ?>
</section>
<?php
$cmo_sidebar = cmo_get_page_sidebar(); 
if ( !$cmo_modern_full && !empty( $cmo_sidebar[0] ) ) : ?> 
<aside class="cmo-sidebar">
	<?php dynamic_sidebar( $cmo_sidebar[0] ); ?>
</aside>
<?php endif; ?>