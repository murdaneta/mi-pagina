<!DOCTYPE html>
<html <?php language_attributes( 'html' ) ?> xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />
<meta name="tagline" content="<?php echo get_bloginfo('description') ?>" />

<meta name="format-detection" content="telephone=no" />

<?php
global $CUMULO_PAGE_OPTIONS;
$CUMULO_PAGE_OPTIONS = get_post_meta ( get_the_ID () );
$cmo_is_responsive_enabled = cmo_is_yes_or_one( cmo_get_page_theme_option( 'enable_responsive', 'enable-responsive' ) );
$cmo_wide_boxed = cmo_get_page_theme_option( 'content_layout', 'content-layout' ) == "boxed" ? "layout-boxed" : "layout-wide";
?>

<!--[if lte IE 8]>
<script type="text/javascript" src="<?php echo CMO_THEME_URI; ?>/js/html5shiv.js"></script>
<script src="<?php echo CMO_THEME_URI; ?>/js/excanvas.js"></script>
<![endif]-->

<?php
	add_action( 'wp_enqueue_scripts', 'cmo_theme_css' );
	add_action( 'wp_head', 'cmo_theme_dynamic_css' ); 
?>
<?php wp_head(); ?>
</head>
<body
	<?php body_class( array( 
			( cmo_get_theme_mod_value( "content-preloader") == "enable" ) ? "loading" : "",
			$cmo_wide_boxed,
			$cmo_is_responsive_enabled ? "responsive" : "",
		) );  ?>>

	<?php if ( cmo_get_theme_mod_value( "content-preloader") == "enable" ): ?>	
	<div class="cmo-loader-wrapper">
		<div class="cmo-loader">
			<div class="loader-inner"></div>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( $cmo_wide_boxed == "layout-boxed" ) { ?>
	<div class="topmost-page-container">
	<?php } ?>
<?php
	if ( cmo_is_yes_or_one( cmo_get_page_theme_option( 'header_show_header', 'header-show-header' ) ) ) {
		$cmo_header_style = cmo_get_page_theme_option( 'header_style', 'header-style' ); 
?>
<?php if ( $cmo_is_responsive_enabled && has_nav_menu('main-menu') ) { ?>
	<div id="mobile-menu-container">
		<button type="button" id="toggle-mobile-menu" class="toggle-button" data-target="main-menu-wrapper">
			<span class="sr-only">Toggle navigation</span> 
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<div class="mobile-menu-triangle"></div>
	<?php 
	$cmo_pmenu = cmo_get_page_theme_option( 'header_menu', null );
	if ( $cmo_pmenu !== "secondary-menu" ) {
		$cmo_pmenu = "main-menu";
	}

	add_filter('wp_nav_menu_items','cmo_add_search_box_to_mobile_nav');
	wp_nav_menu( 
		array( 
			'theme_location' => $cmo_pmenu,
			'container_id'	=>	'mobile-menu-wrapper',
			'container_class' => 'mobile-menu', 
			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'walker' => new Cumulo_Nav_Walker()
		)
	);
	remove_filter( 'wp_nav_menu_items', 'cmo_add_search_box_to_mobile_nav');
	?>
	</div>
<?php } 
get_template_part ( "templates/header/{$cmo_header_style}" );
} ?>