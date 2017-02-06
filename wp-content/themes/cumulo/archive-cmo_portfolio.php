<?php 
get_header(); 
$cmo_list_style = cmo_get_theme_mod_value( "portfolio-list-style" );
$cmo_is_full = cmo_get_theme_mod_value( "portfolio-list-full" ) == 'yes';

$cmo_sidebar = cmo_get_page_sidebar();
?>
<div id="main-container">
	<div class="page-content <?php if ( !$cmo_is_full ) echo "container"; ?> page-archive-cmo_portfolio portfolio-list-style-<?php echo esc_attr( $cmo_list_style ) ?> <?php if ( !$cmo_is_full ) echo esc_attr( $cmo_sidebar[1] ); ?>">
		<?php get_template_part( "templates/portfolio/layout", $cmo_list_style ); ?>
	</div>
</div>
<?php
get_footer();