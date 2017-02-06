<?php
$content_width 	= cmo_get_page_theme_option( 'main_width', 'main-width', '' );
$sidebar_width 	= cmo_get_page_theme_option( 'sidebar_width', 'sidebar-width', '' );

if ( $content_width < 768 ) $content_width = 768;
else if ( $content_width > 1400 ) $content_width = 1400;

if ( $sidebar_width > 50 ) $sidebar_width = 50;
else if ( $sidebar_width < 25 ) $sidebar_width = 25;

$primary_color 	= cmo_get_page_theme_option( 'primary_color', 'primary-color', '' );
$text_color		= cmo_get_page_theme_option( 'text_color', 'text-color', '' );
$heading_color	= cmo_get_page_theme_option( 'heading_color', 'heading-color', '' );
$primary_bg_color 	= cmo_get_page_theme_option( 'bg_color', 'bg-color', '' );

$secondary_bg_color = cmo_get_page_theme_option( 'bg_color2', 'bg-color2', '' );
$dark_bg_color 	= cmo_get_page_theme_option( 'dark_bg_color', 'dark-bg-color', '' );
$menu_color 	= cmo_get_page_theme_option( 'menu_color', 'menu-color', '' );
$border_color 	= cmo_get_page_theme_option( 'border_color', 'border-color', '' );

$breadcrumb_bg_color 	= cmo_get_page_theme_option( 'breadcrumb_bg_color', 'breadcrumb-bg-color', '' );
$header_bg_color 		= cmo_get_page_theme_option( 'header_bg_color', 'header-bg-color', '' );

$enable_thnav 	= cmo_get_page_theme_option( 'transparent_header_nav_alt_color', 'transparent-header-nav-alt-color', 'default' );
$thnav_color 	= cmo_get_page_theme_option( 'transparent_header_main_nav_color', 'transparent-header-main-nav-color', '' );

$h1_font_size = cmo_get_theme_mod_value( 'h1-font-size' ) . 'px';
$h2_font_size = cmo_get_theme_mod_value( 'h2-font-size' ) . 'px';
$h3_font_size = cmo_get_theme_mod_value( 'h3-font-size' ) . 'px';
$h4_font_size = cmo_get_theme_mod_value( 'h4-font-size' ) . 'px';
$h5_font_size = cmo_get_theme_mod_value( 'h5-font-size' ) . 'px';
$h6_font_size = cmo_get_theme_mod_value( 'h6-font-size' ) . 'px';
$text_font_size = cmo_get_theme_mod_value( 'text-font-size' ) . 'px';

$bg_img = cmo_get_page_theme_option( 'content_background_image', 'content-background-image', '' );
$bg_repeat = cmo_get_page_theme_option( 'content_background_repeat', 'content-background-repeat' );
$bg_position = cmo_get_page_theme_option( 'content_background_position', 'content-background-position' );
$bg_attach = cmo_get_page_theme_option( 'content_background_attachment', 'content-background-attachment' );

$layout = cmo_get_page_theme_option( 'content_layout', 'content-layout' );
$boxed_width = cmo_get_page_theme_option( 'content_boxed_width', 'content-boxed-width', '' );
if ( $boxed_width < 1200 ) $boxed_width = 1200;
else if ( $boxed_width > 1400 ) $boxed_width = 1400;
?>

body {
	<?php if ( !empty($bg_img) ) { ?>
	background-image: url('<?php echo esc_url( $bg_img ) ?>');
	background-repeat: <?php echo esc_attr( $bg_repeat ) ?>;
	background-position: top <?php echo esc_attr( $bg_position ) ?>;
	background-attachment: <?php echo esc_attr( $bg_attach ) ?>;
	<?php } ?>
	background-color: <?php echo esc_attr( $primary_bg_color ) ?>;
}
/* --- site widths --- */
body:not(.responsive) {
	min-width: <?php echo esc_attr($content_width) . "px" ?>;
	overflow-x: auto;
}
body:not(.responsive) .container {
	width: <?php echo esc_attr( $content_width ) . "px" ?>;
}


@media all and ( min-width: 1200px ) { 
	.topmost-page-container {
		width: <?php echo esc_attr( $boxed_width ) ?>px;
		box-shadow: 0 0 50px 10px rgba(0,0,0,0.3);
		margin: <?php echo esc_attr( cmo_get_page_theme_option( 'content_boxed_margin_top_bottom', 'content-boxed-margin-top-bottom', '' ) ); ?>px auto;
	
		background-color: <?php echo esc_attr( $primary_bg_color ) ?>;
		position: relative;
	}

	body.layout-boxed {
		background-color: <?php echo esc_attr( cmo_get_page_theme_option( 'content_background_color', 'content-background-color', '' ) ); ?>;
	}
	
	.topmost-page-container header#cmo-header.enable-sticky.header-stuck,
	.topmost-page-container header#cmo-header.slider-nav {
		width: <?php echo esc_attr( $boxed_width ); ?>px;
	}
}

.with-sidebar .cmo-mainbar {
	width: <?php echo ( 100 - intval($sidebar_width) ) ?>%;
}

.with-sidebar .cmo-sidebar {
	width: <?php echo intval($sidebar_width) ?>%;
}
/* -- end of site widths --- */

<?php 
$content_padding_top = cmo_get_page_theme_option( 'padding_top' );
$content_padding_bottom = cmo_get_page_theme_option( 'padding_bottom' );
?>
.page-page, .page-single {
	<?php if ( trim( $content_padding_top ) !== '' ) { ?>
	padding-top: <?php echo esc_attr($content_padding_top); ?>px;
	<?php } ?>
	<?php if ( trim( $content_padding_bottom ) !== '' ) { ?>
	padding-bottom: <?php echo esc_attr($content_padding_bottom); ?>px;
	<?php } ?>
}

/* headers */
header#cmo-header {
	background-color: <?php echo esc_attr( $header_bg_color ) ?>;
}
header#cmo-header.header-style-6 nav div.main-menu ul.menu > li.menu-item > a:hover {
	background-color: <?php echo esc_attr( $header_bg_color ) ?>;
}

<?php 
$header_logo_margin_top = cmo_get_page_theme_option( 'header_logo_margin_top', 'header-logo-margin-top', '' );
?>
header#cmo-header nav #logo-header {
	margin-top: <?php echo esc_attr($header_logo_margin_top); ?>px;
}

<?php
$header_breadcrumb_image_enable = cmo_is_yes_or_one( cmo_get_page_theme_option( 'breadcrumb_background_image_enable', 'breadcrumb-background-image-enable' ) );
$header_breadcrumb_image = cmo_get_page_theme_option( 'header_breadcrumb_image', 'header-breadcrumb-image', '' );

if ( ! $header_breadcrumb_image_enable ) { ?>
.cmo-page-title {
 	background-image: none;
}
<?php }
else if ( $header_breadcrumb_image_enable && ! empty( $header_breadcrumb_image ) ) { ?>
.cmo-page-title {
 	background-image: url('<?php echo esc_attr($header_breadcrumb_image) ?>');

	<?php 
	$breadcrumb_bg_repeat = cmo_get_page_theme_option( "breadcrumb_background_repeat", "breadcrumb-background-repeat" );
	if ( $breadcrumb_bg_repeat == "cover" ) {
		echo "background-size: cover;";
	}
	else {
		echo "background-size: auto; background-repeat: " . esc_attr( $breadcrumb_bg_repeat ) . ";";
	}
 	?>
}
<?php } ?>

.cmo-page-title {
	background-color: <?php echo esc_attr( $breadcrumb_bg_color ); ?>;
}

<?php $header_breadcrumb_overlay = cmo_is_yes_or_one( cmo_get_page_theme_option( 'breadcrumb_background_overlay', 'breadcrumb-background-overlay' ) );
if ( !$header_breadcrumb_overlay ) {
?>
.cmo-page-title::before {
	display: none;
}
<?php } ?>
/* end of headers */

/* --- Typography --- */
body {
	font-family: <?php echo esc_attr( cmo_get_theme_mod_value('text-font') ) ?>, "Helvetica Neue", Helvetica, sans-serif;
	font-weight: <?php echo esc_attr( cmo_get_theme_mod_value('text-font-weight') ) ?>;
	font-size: <?php echo esc_attr( $text_font_size ) ?>;
}

#main-container #bbpress-forums {
	font-size: <?php echo esc_attr( $text_font_size ) ?>;
}

h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
	font-family: <?php echo esc_attr( cmo_get_theme_mod_value('heading-font') ) ?>, "Helvetica Neue", Helvetica, sans-serif;
	font-weight: <?php echo esc_attr( cmo_get_theme_mod_value('heading-font-weight') ) ?>;
}
h1, .h1 {
	font-size: <?php echo esc_attr( $h1_font_size ) ?>;
}
h2, .h2 {
	font-size: <?php echo esc_attr( $h2_font_size ) ?>;
}
h3, .h3 {
	font-size: <?php echo esc_attr( $h3_font_size ) ?>;
}
h4, .h4 {
	font-size: <?php echo esc_attr( $h4_font_size ) ?>;
}
h5, .h5 {
	font-size: <?php echo esc_attr( $h5_font_size ) ?>;
}
h6, .h6 {
	font-size: <?php echo esc_attr( $h6_font_size ) ?>;
}

.sub-heading {
	font-family: <?php echo esc_attr( cmo_get_theme_mod_value('sub-heading-font') ) ?>, "Helvetica Neue", Helvetica, sans-serif;
	font-weight: <?php echo esc_attr( cmo_get_theme_mod_value('sub-heading-font-weight') ) ?>;
}

nav {
	font-family: <?php echo esc_attr( cmo_get_theme_mod_value('menu-font') ) ?>, "Helvetica Neue", Helvetica, sans-serif;
	font-weight: <?php echo esc_attr( cmo_get_theme_mod_value('menu-font-weight') ) ?>;
}
/* end of Typography */

/* nav color for transparent header */
<?php if ( $enable_thnav == 'yes' ) { ?> 
header#cmo-header.slider-nav:not(.header-stuck) nav div.main-menu ul.menu > li.menu-item > a,
header#cmo-header.slider-nav:not(.header-stuck) nav #nav-link-search, 
header#cmo-header.slider-nav:not(.header-stuck) nav a#nav-link-cart, 
header#cmo-header.slider-nav:not(.header-stuck) nav a#nav-link-cart span {
	color: <?php echo esc_attr( $thnav_color ); ?> !important;
}

header#cmo-header.header-style-3.slider-nav:not(.header-stuck) #header-info-bar .info-phone, 
header#cmo-header.header-style-3.slider-nav:not(.header-stuck) #header-info-bar .info-email,
header#cmo-header.header-style-3.slider-nav:not(.header-stuck) a#nav-link-cart,
header#cmo-header.header-style-5.slider-nav:not(.header-stuck) #header-info-bar .info-email span.info-before, 
header#cmo-header.header-style-5.slider-nav:not(.header-stuck) #header-info-bar .info-phone span.info-before,
header#cmo-header.header-style-5.slider-nav:not(.header-stuck) #header-info-bar .info-email span.info-before + span, 
header#cmo-header.header-style-5.slider-nav:not(.header-stuck) #header-info-bar .info-phone span.info-before + span
{
	color: <?php echo esc_attr( $thnav_color ); ?> !important;
}

header#cmo-header.slider-nav:not(.header-stuck) nav a#nav-link-cart span {
	border-color: <?php echo esc_attr( $thnav_color ); ?> !important;
}
<?php } ?>

/* styles which cannot use extend functionalities */
header#cmo-header nav div.main-menu ul.menu > li.menu-item > ul.sub-menu {
	-webkit-box-shadow: 0 3px 0 <?php echo esc_attr( $primary_color ) ?>, 0 0 0 1px rgba(0, 0, 0, 0.05), 0 3px 15px rgba(0, 0, 0, 0.05);
	-moz-box-shadow: 0 3px 0 <?php echo esc_attr( $primary_color ) ?>, 0 0 0 1px rgba(0, 0, 0, 0.05), 0 3px 15px rgba(0, 0, 0, 0.05);
	box-shadow: 0 3px 0 <?php echo esc_attr( $primary_color ) ?>, 0 0 0 1px rgba(0, 0, 0, 0.05), 0 3px 15px rgba(0, 0, 0, 0.05);
}
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper {
	-webkit-box-shadow: 0 3px 0 <?php echo esc_attr( $primary_color ) ?>, 0 0 0 1px rgba(0, 0, 0, 0.05), 0 0 10px rgba(0, 0, 0, 0.05);
	-moz-box-shadow: 0 3px 0 <?php echo esc_attr( $primary_color ) ?>, 0 0 0 1px rgba(0, 0, 0, 0.05), 0 0 10px rgba(0, 0, 0, 0.05);
	box-shadow: 0 3px 0 <?php echo esc_attr( $primary_color ) ?>, 0 0 0 1px rgba(0, 0, 0, 0.05), 0 0 10px rgba(0, 0, 0, 0.05);
}
header#cmo-header nav div.main-menu ul.menu > li.menu-item > ul.sub-menu > li.menu-item ul.sub-menu {
	-webkit-box-shadow: 0 3px 0 <?php echo esc_attr( $primary_color ) ?>, 0 0 0 1px rgba(0, 0, 0, 0.05), 0 3px 15px rgba(0, 0, 0, 0.05);
	-moz-box-shadow: 0 3px 0 <?php echo esc_attr( $primary_color ) ?>, 0 0 0 1px rgba(0, 0, 0, 0.05), 0 3px 15px rgba(0, 0, 0, 0.05);
	box-shadow: 0 3px 0 <?php echo esc_attr( $primary_color ) ?>, 0 0 0 1px rgba(0, 0, 0, 0.05), 0 3px 15px rgba(0, 0, 0, 0.05);
}

header#cmo-header nav div.main-menu ul.menu > li.menu-item:hover span.cart-items-count {
  -webkit-box-shadow: 0 0 0 1px <?php echo esc_attr( $primary_color ) ?>;
  -moz-box-shadow: 0 0 0 1px <?php echo esc_attr( $primary_color ) ?>;
  box-shadow: 0 0 0 1px <?php echo esc_attr( $primary_color ) ?>;
}
<?php $darkbg = cmo_hex2rgb($dark_bg_color); ?>
.woocommerce ul.products li.product .cmo-product-thumb-wrapper .cmo-product-thumb-hover {
	background-color: rgba(<?php echo esc_attr( $darkbg[0] ) ?>, <?php echo esc_attr( $darkbg[1] ) ?>, <?php echo esc_attr( $darkbg[2] ) ?>, 0.8);
}
.woocommerce ul.products li.product .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-add-cart-wrapper {
	background-color: rgba(<?php echo esc_attr( $darkbg[0] ) ?>, <?php echo esc_attr( $darkbg[1] ) ?>, <?php echo esc_attr( $darkbg[2] ) ?>, 0.5);
}

.woocommerce a.remove {
	/* !text-color */
	color: <?php echo esc_attr( $text_color ) ?> !important;
}
.woocommerce a.remove:hover {
	color: <?php echo esc_attr( $primary_color ) ?> !important;
}

body.loading .cmo-loader-wrapper {
	background-image: -webkit-radial-gradient(center ,circle cover, <?php echo esc_attr( $primary_color ) ?> 0%, <?php echo esc_attr( cmo_color_minus( $primary_color, "#101010") ) ?> 100%);
	background-image: -moz-radial-gradient(center ,circle cover, <?php echo esc_attr( $primary_color ) ?> 0%, <?php echo esc_attr( cmo_color_minus( $primary_color, "#101010") ) ?> 100%);
	background-image: -o-radial-gradient(center ,circle cover, <?php echo esc_attr( $primary_color ) ?> 0%, <?php echo esc_attr( cmo_color_minus( $primary_color, "#101010") ) ?> 100%);
	background-image: radial-gradient(circle farthest-corner at center, <?php echo esc_attr( $primary_color ) ?> 0%, <?php echo esc_attr( cmo_color_minus( $primary_color, "#101010") ) ?> 100%);
}

/* Dynamic CSS */
/* These values will be used with less "extend" functionality */
.doption-primary-color,
header#cmo-header nav #nav-link-search:hover,
header#cmo-header nav a#nav-link-cart:hover,
header#cmo-header nav div.main-menu ul.menu > li.menu-item > ul.sub-menu > li.menu-item > a:hover,
header#cmo-header nav div.main-menu ul.menu > li.menu-item > ul.sub-menu > li.menu-item:hover.menu-item-has-children > a span.caret,
header#cmo-header nav div.main-menu ul.menu > li.menu-item > ul.sub-menu > li.menu-item ul.sub-menu > li.menu-item > a:hover,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper > li.menu-item ul.cmo-megamenu-sub-menu > li.menu-item > a:hover,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper > li.menu-item ul.cmo-megamenu-sub-menu > li.menu-item > a:focus,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper > li.menu-item ul.cmo-megamenu-sub-menu > li.menu-item > a:active,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cart-items > ul.sub-menu > li > a.cart-item-title:hover,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cart-items > ul.sub-menu > li.cart-other-pages a:hover,
header#cmo-header div#nav-shopping-cart-wrapper ul.sub-menu > li span.cart-item-desc,
header#cmo-header.header-style-1 nav #nav-link-search,
header#cmo-header.header-style-1 nav a#nav-link-cart,
header#cmo-header.header-style-3 nav div.main-menu ul.menu > li.menu-item > a:hover,
header#cmo-header.header-style-4 nav div.main-menu ul.menu > li.menu-item > a:hover,
header#cmo-header.header-style-6 nav div.main-menu ul.menu > li.menu-item > a:hover,
body.responsive #mobile-menu-container ul.menu a:hover,
.cmo-page-title ul.cmo-breadcrumbs li a:hover,
footer#cmo-footer nav#footer-nav li a:hover,
footer#cmo-footer.footer-style-2 .widget_categories ul li.cat-item a:hover,
footer#cmo-footer.footer-style-2 .widget_tag_cloud div.tagcloud a:hover,
.blog-list-style-modern article.type-post > .cmo-article-contents .cmo-article-meta-wrapper .cmo-article-meta-date time,
.blog-list-style-modern article.cmo-post-in-list > .cmo-article-contents .cmo-article-meta-wrapper .cmo-article-meta-date time,
nav.navigation.pagination .page-numbers.current,
nav.navigation.pagination .page-numbers:hover,
nav.navigation.pagination .page-numbers.next:hover,
nav.navigation.pagination .page-numbers.prev:hover,
nav.navigation.pagination div.nav-links > span.page-numbers:not(.dots),
.ajax-loader,
#main-container section.comments-area ul.comment-list > li.comment div.comment-body div.comment-meta .comment-meta-date a.comment-edit-link:hover,
#main-container section.comments-area ul.comment-list > li.pingback div.comment-body div.comment-meta .comment-meta-date a.comment-edit-link:hover,
#main-container section.comments-area ul.comment-list > li.trackback div.comment-body div.comment-meta .comment-meta-date a.comment-edit-link:hover,
#main-container section.comments-area ul.comment-list > li.comment div.comment-body div.comment-meta div.reply a.comment-reply-link:hover,
#main-container section.comments-area ul.comment-list > li.pingback div.comment-body div.comment-meta div.reply a.comment-reply-link:hover,
#main-container section.comments-area ul.comment-list > li.trackback div.comment-body div.comment-meta div.reply a.comment-reply-link:hover,
div.comment-respond h3 > small a:hover,
div.comment-respond h3 > small a.transparent,
nav.comment-navigation a:hover,
.cmosc-link > a:hover,
.cmosc-link > a > i,
.woocommerce #main-container .page-woo div.entry-summary .woocommerce-product-rating,
#main-container .woocommerce div.entry-summary .woocommerce-product-rating,
.woocommerce div.entry-summary .woocommerce-product-rating,
.woocommerce #main-container .page-woo div.entry-summary p.price ins,
#main-container .woocommerce div.entry-summary p.price ins,
.woocommerce div.entry-summary p.price ins,
.woocommerce #main-container .page-woo div.entry-summary p.price > span.amount,
#main-container .woocommerce div.entry-summary p.price > span.amount,
.woocommerce div.entry-summary p.price > span.amount,
.woocommerce #main-container .page-woo div.entry-summary p.price del,
#main-container .woocommerce div.entry-summary p.price del,
.woocommerce div.entry-summary p.price del,
.woocommerce ul.products li.product .cmo-product-detail-wrapper .cmo-product-meta-wrapper span.price ins,
.woocommerce ul.products li.product .cmo-product-detail-wrapper .cmo-product-meta-wrapper span.price > span.amount,
.woocommerce ul.products li.product .cmo-product-detail-wrapper .cmo-product-meta-wrapper span.price del,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li span.page-numbers.current,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers.current,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li span.page-numbers:hover,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers:hover,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers.next:hover,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers.prev:hover,
.woocommerce #respond input#submit:hover,
.woocommerce a.button:hover,
.woocommerce button.button:hover,
.woocommerce input.button:hover,
.woocommerce #respond input#submit.transparent,
.woocommerce a.button.transparent,
.woocommerce button.button.transparent,
.woocommerce input.button.transparent,
.woocommerce #respond input#submit.alt:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover,
.star-rating,
#main-container .widget_product_categories ul.product-categories li.cat-item:hover,
#main-container .widget_product_categories ul.product-categories li.cat-item:hover a,
.woocommerce ul.products li.product.woo-listing-style-2 .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-add-cart-wrapper .cmo-add-to-cart > a:hover,
.woocommerce ul.products li.product.woo-listing-style-2 .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-add-cart-wrapper > a:hover,
.woocommerce ul.products li.product.woo-listing-style-2 .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-add-cart-wrapper > a:hover i.fa,
.woocommerce ul.products li.product.woo-listing-style-2 .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-add-cart-wrapper.adding .cmo-add-to-cart i.fa,
.woocommerce ul.products li.product.woo-listing-style-2 .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-add-cart-wrapper.added .cmo-add-to-cart i.fa,
.woocommerce ul.products li.product.woo-listing-style-3 .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-more-buttons-wrapper > a:hover,
.widget_archive li a:hover,
.widget_nav_menu li a:hover,
.widget_meta li a:hover,
.widget_pages li a:hover,
.widget_categories li a:hover,
#cmo-footer .widget_categories ul li.cat-item a,
#cmo-footer .widget_tag_cloud div.tagcloud a,
#main-container .cmo-sidebar .widget_archive ul li > a:hover,
#main-container .cmo-sidebar .widget_nav_menu ul li > a:hover,
#main-container .cmo-sidebar .widget_meta ul li > a:hover,
#main-container .cmo-sidebar .widget_pages ul li > a:hover,
#main-container .cmo-sidebar .widget_categories ul li > a:hover,
#main-container .widget_categories ul li > a:hover,
#main-container .widget_archive ul li > a:hover,
.page-404 h1,
.page-404 h3,
.large-404,
.woo-listing-style-2 .lp-meta-likes:hover,
.woo-listing-style-3 .lp-meta-likes:hover,
#main-container #buddypress a.button:hover,
#main-container #buddypress input[type=submit]:hover,
#main-container div.loop .loop-content .epl-listing-post.epl-listing-grid-view.epl-property-blog .property-box-right .entry-title:hover,
#main-container div.loop .loop-content .epl-listing-post.epl-listing-grid-view.epl-property-blog .property-box-right div.price,
.cmo_accordion .wpb_accordion_wrapper .wpb_accordion_header a:hover,
.cmo-button:hover,
.cmo-button.transparent,
.cmo-content-box:not(.no-hover):hover .cmo-button,
.cmo-content-box:hover .icon,
.cmo-content-box:hover .title,
.cmo-faq .cmo-faq-titles a.cmo-faq-link:hover,
.cmo-faq .cmo-faq-items-wrapper .cmo-faq-item a.cmo-faq-back:hover,
.cmo-feature-box.style2 .title,
.cmo-icon-list-item i,
.cmo-image-box:hover .content-wrapper .title,
.cmo-image-carousel .carousel-controls .carousel-control:hover,
.cmo-pricing-column.style2.featured .price,
.cmo-pricing-column.style2:hover .price,
.wpb_content_element.cmo_vtabs .cmo_tabs_nav li a,
blockquote:after,
.cmosc-restaurant-menu-item span.cmosc-restaurant-menu-item-price,
a,
h1 a:hover,
h2 a:hover,
h3 a:hover,
h4 a:hover,
h5 a:hover,
h6 a:hover,
.h1 a:hover,
.h2 a:hover,
.h3 a:hover,
.h4 a:hover,
.h5 a:hover,
.h6 a:hover,
input[type=reset]:hover,
input[type=submit]:hover,
button:hover,
input[type=reset].transparent,
input[type=submit].transparent,
button.transparent {
  color: <?php echo esc_attr( $primary_color ) ?>;
}
.doption-primary-color-as-background,
span.icon-bar:before,
header#cmo-header nav div.main-menu ul.menu > li.menu-item > a:hover,
header#cmo-header nav div.main-menu ul.menu > li.menu-item:hover span.cart-items-count,
header#cmo-header div#nav-shopping-cart-wrapper ul.sub-menu > li.cart-other-pages .nav-woo-view-cart,
header#cmo-header div#nav-shopping-cart-wrapper ul.sub-menu > li.cart-other-pages .nav-woo-checkout,
header#cmo-header.header-style-3 a#nav-link-cart:hover span.et-line + span,
header#cmo-header.header-style-5 div.main-menu ul.menu > li.menu-item > a:before,
header#cmo-header.header-style-5 div.main-menu ul.menu > li.menu-item > a:after,
header#cmo-header.header-style-6 nav a#nav-link-cart:hover span.et-line + span,
footer#cmo-footer.footer-style-2 .footer-widgets,
article.type-post .cmo-article-quote-wrapper,
article.cmo-post-in-list .cmo-article-quote-wrapper,
article.type-post .cmo-article-link-wrapper,
article.cmo-post-in-list .cmo-article-link-wrapper,
article.type-post .cmo-article-link-href,
article.cmo-post-in-list .cmo-article-link-href,
article.type-post .cmo-article-contents .cmo-article-meta-wrapper .cmo-article-meta-date,
article.cmo-post-in-list .cmo-article-contents .cmo-article-meta-wrapper .cmo-article-meta-date,
nav.navigation.pagination .page-numbers.next,
nav.navigation.pagination .page-numbers.prev,
.ajax-loader::before,
.ajax-loader::after,
.cmo-single .cmo-article-author .cmo-article-author-info .cmo-article-author-name span.is-admin,
div.comment-respond h3 > small a,
div.comment-respond h3 > small a.transparent:hover,
#main-container .cmo-portfolio-categories-wrapper ul.filters li:hover a,
#main-container .cmo-portfolio-categories-wrapper ul.filters li.active a,
.widget_wysija_cont .wysija-submit,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers.next,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers.prev,
.woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce #respond input#submit.transparent:hover,
.woocommerce a.button.transparent:hover,
.woocommerce button.button.transparent:hover,
.woocommerce input.button.transparent:hover,
.woocommerce div.product div.woocommerce-tabs ul.tabs li.active,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
#main-container .widget_product_categories ul.product-categories li.cat-item:hover span.count,
.widget_tag_cloud a[class^="tag-link"]:hover,
.widget_product_tag_cloud a[class^="tag-link"]:hover,
#cmo-footer .widget_categories ul li.cat-item a:hover,
#main-container .widget_categories ul li > a:hover span.count,
#main-container .widget_archive ul li > a:hover span.count,
.cmo-to-top a.cmo-to-top-anchor,
#main-container .mejs-controls .mejs-time-rail .mejs-time-current,
#main-container #buddypress a.button,
#main-container #buddypress input[type=submit],
#main-container #buddypress div.item-list-tabs ul li.current a,
#main-container #buddypress div.item-list-tabs ul li.selected a,
#main-container .page-property-single .epl-button.epl-external-link,
#main-container .page-property-single span.epl-floor-plan-button-wrapper button,
#main-container .page-property-single span.epl-floor-plan-button-wrapper2 button,
.cmo_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-accordion-header-active a,
.cmo-button,
.cmo-button.transparent:hover,
.cmo-content-box:not(.no-hover):hover,
.cmo-feature-box.style1 .title,
.cmo-feature-box.style1:hover,
.cmo-feature-box.style2:hover .title,
.cmo-feature-box.style2:hover .content-wrapper,
.cmo-icon-list.ordered-list li:before,
.cmo-pricing-column.style1.featured,
.cmo-pricing-column.style1:hover,
.cmo-pricing-column.style2 .cmo-button,
.cmo-progress-bar .gauge,
.cmo-progress-bar .value.background-set,
.wpb_content_element.cmo_tabs .cmo_tabs_nav > li.ui-tabs-active:not(.with-image),
.wpb_content_element.cmo_tabs.active-background .cmo_tabs_nav li.ui-tabs-active,
.wpb_content_element.cmo_tabs.active-background .cmo_tabs_wrapper .cmo_tab,
.wpb_content_element.cmo_vtabs .cmo_tabs_nav li.ui-tabs-active,
.cmo-dropcap:first-letter,
blockquote:before,
.cmo-team-member.style3:hover .info,
.cmo-team-member.style6 .info,
.cmo-team-member.style7 .info,
input[type=reset],
input[type=submit],
button,
input[type=reset].transparent:hover,
input[type=submit].transparent:hover,
button.transparent:hover {
  background-color: <?php echo esc_attr( $primary_color ) ?>;
}
.doption-primary-color-as-border,
header#cmo-header nav a#nav-link-cart:hover span.img-cart-icon,
header#cmo-header.header-style-1 nav a#nav-link-cart span,
.blog-list-style-onecolumn article.type-post.sticky,
.blog-list-style-onecolumn article.cmo-post-in-list.sticky,
.blog-list-style-masonry article.type-post.sticky,
.blog-list-style-masonry article.cmo-post-in-list.sticky,
nav.navigation.pagination .page-numbers.current,
nav.navigation.pagination .page-numbers:hover,
nav.navigation.pagination .page-numbers.next,
nav.navigation.pagination .page-numbers.prev,
nav.navigation.pagination div.nav-links > span.page-numbers:not(.dots),
div.comment-respond h3 > small a,
div.comment-respond h3 > small a.transparent:hover,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li span.page-numbers.current,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers.current,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li span.page-numbers:hover,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers:hover,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers.next,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers.prev,
.woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce #respond input#submit.transparent:hover,
.woocommerce a.button.transparent:hover,
.woocommerce button.button.transparent:hover,
.woocommerce input.button.transparent:hover,
.woocommerce #respond input#submit.alt:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover,
.woocommerce div.product div.woocommerce-tabs ul.tabs:before,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
#main-container .widget_product_categories ul.product-categories li.cat-item span.count,
.woocommerce ul.products li.product.woo-listing-style-3 .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-more-buttons-wrapper > a:hover,
.widget_tag_cloud a[class^="tag-link"]:hover,
.widget_product_tag_cloud a[class^="tag-link"]:hover,
#main-container .widget_categories ul li > a span.count,
#main-container .widget_archive ul li > a span.count,
.woo-listing-style-3 .lp-meta-likes:hover,
#main-container #buddypress .activity-list li.bbp_topic_create .activity-content .activity-inner,
#main-container #buddypress .activity-list li.bbp_reply_create .activity-content .activity-inner,
#main-container #buddypress a.button,
#main-container #buddypress input[type=submit],
.vc_separator.use-custom-color .vc_sep_holder .vc_sep_line,
.cmo-button,
.cmo-button.transparent:hover,
.cmo-pricing-column.style2.featured,
.cmo-pricing-column.style2:hover,
.cmo-progress-bar .gauge .value.background-set:after,
.cmo-progress-bar .value.background-set,
.wpb_content_element.cmo_tabs.active-border-top .cmo_tabs_nav li.ui-tabs-active a,
.wpb_content_element.cmo_vtabs .cmo_tab,
input[type=reset],
input[type=submit],
button,
input[type=reset].transparent:hover,
input[type=submit].transparent:hover,
button.transparent:hover {
  border-color: <?php echo esc_attr( $primary_color ) ?>;
}
.doption-text-color,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cart-items > ul.sub-menu > li.cart-other-pages a,
header#cmo-header.header-style-5 #header-info-bar .info-email span.info-before + span,
header#cmo-header.header-style-5 #header-info-bar .info-phone span.info-before + span,
.owl-gallery-carousel div.owl-controls div.owl-buttons div.owl-prev,
.owl-gallery-carousel div.owl-controls div.owl-buttons div.owl-next,
.blog-list-style-modern article.type-post > .cmo-article-contents .cmo-article-meta-wrapper .cmo-article-meta-date,
.blog-list-style-modern article.cmo-post-in-list > .cmo-article-contents .cmo-article-meta-wrapper .cmo-article-meta-date,
nav.navigation.pagination .page-numbers,
#main-container ul.cmo-page-social-links li a,
#main-container section.comments-area ul.comment-list > li.comment div.comment-body div.comment-meta .comment-meta-date a.comment-edit-link,
#main-container section.comments-area ul.comment-list > li.pingback div.comment-body div.comment-meta .comment-meta-date a.comment-edit-link,
#main-container section.comments-area ul.comment-list > li.trackback div.comment-body div.comment-meta .comment-meta-date a.comment-edit-link,
#main-container section.comments-area ul.comment-list > li.comment div.comment-body div.comment-meta div.reply a.comment-reply-link,
#main-container section.comments-area ul.comment-list > li.pingback div.comment-body div.comment-meta div.reply a.comment-reply-link,
#main-container section.comments-area ul.comment-list > li.trackback div.comment-body div.comment-meta div.reply a.comment-reply-link,
nav.comment-navigation a,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li span.page-numbers,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers,
.woocommerce ul.products li.product.woo-listing-style-2 .cmo-product-detail-wrapper .cmo-product-meta-wrapper span.price del,
#main-container .cmo-sidebar ul > li a,
#main-container .cmo-sidebar ol > li a,
.widget_tag_cloud a[class^="tag-link"],
.widget_product_tag_cloud a[class^="tag-link"],
#main-container div.loop .loop-content .epl-listing-post.epl-listing-grid-view.epl-property-blog .property-box-right .entry-title,
#main-container div.loop .loop-content .epl-listing-post.epl-listing-grid-view.epl-property-blog .property-box-right .property-address a,
.cmo-faq .cmo-faq-items-wrapper .cmo-faq-item a.cmo-faq-back,
.cmo-progress-bar .value,
body,
input[type=text],
input[type=search],
input[type=email],
input[type=url],
input[type=number],
input[type=tel],
input[type=password],
textarea,
select {
  color: <?php echo esc_attr( $text_color ) ?>;
}
.doption-text-color-as-border,
.widget_tag_cloud a[class^="tag-link"],
.widget_product_tag_cloud a[class^="tag-link"] {
  border-color: <?php echo esc_attr( $text_color ) ?>;
}
.doption-text-color-as-background {
  background-color: <?php echo esc_attr( $text_color ) ?>;
}
.doption-primary-bg-color,
header#cmo-header nav div.main-menu ul.menu > li.menu-item > ul.sub-menu,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper,
header#cmo-header div#nav-shopping-cart-wrapper ul.sub-menu,
header#cmo-header.header-style-2 nav button#navbar-toggle .icon-bar,
body.responsive #mobile-menu-container,
body.responsive #mobile-menu-container ul.menu,
body.responsive #mobile-menu-container ul.menu > li.menu-item ul.sub-menu > li > a:hover,
body.responsive #mobile-menu-container ul.menu > li.menu-item ul.cmo-megamenu-wrapper > li > a:hover,
body.responsive #mobile-menu-container ul.menu > li.menu-item ul.cmo-megamenu-sub-menu > li > a:hover,
footer#cmo-footer.footer-style-2 .widget_categories ul li.cat-item a:hover,
footer#cmo-footer.footer-style-2 .widget_tag_cloud div.tagcloud a:hover,
.owl-gallery-carousel div.owl-controls div.owl-buttons div.owl-prev,
.owl-gallery-carousel div.owl-controls div.owl-buttons div.owl-next,
.woocommerce-cart .woocommerce h2:after,
.woocommerce h2:after,
.woocommerce ul.products li.product.woo-listing-style-2,
.woocommerce ul.products li.product.woo-listing-style-3,
#main-container div[class^='widget_'] h3:after,
#main-container div[class*=' widget_'] h3:after,
#main-container #buddypress a.button:hover,
#main-container #buddypress input[type=submit]:hover,
#main-container div.loop .loop-content .epl-listing-post.epl-listing-grid-view.epl-property-blog .property-box-right div.price,
.cmo-box-border:after,
.cmo_accordion,
.cmo_accordion .wpb_accordion_wrapper,
.cmo-content-box:not(.no-hover):hover .cmo-button,
.cmo-feature-box.style2 .content-wrapper,
.cmo-feature-box.style2 .title,
.cmo-pricing-column,
.wpb_content_element.cmo_tabs.active-border-top .cmo_tabs_wrapper .cmo_tab,
.cmo-team-member.style4 .info,
.cmo-team-member.style5 .info {
  background-color: <?php echo esc_attr( $primary_bg_color ) ?>;
}
.doption-primary-bg-color-important {
  background-color: <?php echo esc_attr( $primary_bg_color ) ?> !important;
}
.doption-primary-bg-as-color,
header#cmo-header nav div.main-menu ul.menu > li.menu-item > a:hover,
header#cmo-header div#nav-shopping-cart-wrapper ul.sub-menu > li.cart-other-pages .nav-woo-view-cart,
header#cmo-header div#nav-shopping-cart-wrapper ul.sub-menu > li.cart-other-pages .nav-woo-checkout,
header#cmo-header.header-style-1 #header-info-bar,
header#cmo-header.header-style-2 #header-info-bar,
header#cmo-header.header-style-2 nav #nav-link-search,
header#cmo-header.header-style-2 nav a#nav-link-cart,
header#cmo-header.header-style-2 nav div.main-menu ul.menu > li.menu-item > a,
header#cmo-header.header-style-3 #header-info-bar .info-phone .info-icon-wrapper,
header#cmo-header.header-style-3 #header-info-bar .info-email .info-icon-wrapper,
header#cmo-header.header-style-3 a#nav-link-cart span.et-line + span,
header#cmo-header.header-style-6 #header-info-bar,
header#cmo-header.header-style-6 #header-info-bar a.info-bar-meta-link,
header#cmo-header.header-style-6 nav a#nav-link-cart span.et-line + span,
.cmo-page-title,
.cmo-page-title ul.cmo-breadcrumbs li,
.cmo-page-title ul.cmo-breadcrumbs li a,
footer#cmo-footer.footer-style-2 .footer-widgets,
footer#cmo-footer.footer-style-2 #footer-copyright-bar,
footer#cmo-footer.footer-style-2 #footer-copyright-bar a,
footer#cmo-footer.footer-style-2 .cmosc-link > a,
footer#cmo-footer.footer-style-2 .cmosc-link > a i,
footer#cmo-footer.footer-style-2 .cmosc-contact-info,
footer#cmo-footer.footer-style-2 .cmosc-contact-info i,
footer#cmo-footer.footer-style-2 a,
footer#cmo-footer.footer-style-2 .widget_categories ul li.cat-item a,
footer#cmo-footer.footer-style-2 .widget_tag_cloud div.tagcloud a,
footer#cmo-footer.footer-style-3 ul.cmo-footer-social > li > a:hover,
footer#cmo-footer.footer-style-4 .footer-widgets,
footer#cmo-footer.footer-style-4 .cmosc-contact-info,
footer#cmo-footer.footer-style-4 .cmosc-contact-info i,
footer#cmo-footer.footer-style-4 ul.cmo-footer-social > li > a:hover,
footer#cmo-footer.footer-style-4 #footer-copyright-bar,
footer#cmo-footer.footer-style-4 #footer-copyright-bar a,
article.type-post .cmo-article-quote-wrapper,
article.cmo-post-in-list .cmo-article-quote-wrapper,
article.type-post .cmo-article-link-wrapper,
article.cmo-post-in-list .cmo-article-link-wrapper,
article.type-post .cmo-article-quote-wrapper a,
article.cmo-post-in-list .cmo-article-quote-wrapper a,
article.type-post .cmo-article-link-wrapper a,
article.cmo-post-in-list .cmo-article-link-wrapper a,
article.type-post .cmo-article-link-href,
article.cmo-post-in-list .cmo-article-link-href,
article.type-post .cmo-article-contents .cmo-article-meta-wrapper .cmo-article-meta-date,
article.cmo-post-in-list .cmo-article-contents .cmo-article-meta-wrapper .cmo-article-meta-date,
nav.navigation.pagination .page-numbers.next,
nav.navigation.pagination .page-numbers.prev,
.cmo-single .cmo-article-author .cmo-article-author-info .cmo-article-author-name span.is-admin,
div.comment-respond h3 > small a,
div.comment-respond h3 > small a.transparent:hover,
#main-container .cmo-portfolio-categories-wrapper ul.filters li:hover a,
#main-container .cmo-portfolio-categories-wrapper ul.filters li.active a,
.woocommerce #main-container .page-woo div.images div.thumbnails .owl-controls .owl-buttons .owl-prev,
#main-container .woocommerce div.images div.thumbnails .owl-controls .owl-buttons .owl-prev,
.woocommerce div.images div.thumbnails .owl-controls .owl-buttons .owl-prev,
.woocommerce #main-container .page-woo div.images div.thumbnails .owl-controls .owl-buttons .owl-next,
#main-container .woocommerce div.images div.thumbnails .owl-controls .owl-buttons .owl-next,
.woocommerce div.images div.thumbnails .owl-controls .owl-buttons .owl-next,
.woocommerce ul.products li.product .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-add-cart-wrapper a,
.woocommerce ul.products li.product .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-add-cart-wrapper i.fa,
.woocommerce ul.products li.product .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-more-buttons-wrapper a,
.woocommerce span.ribbon-sale-flash,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers.next,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers.prev,
.woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce #respond input#submit.transparent:hover,
.woocommerce a.button.transparent:hover,
.woocommerce button.button.transparent:hover,
.woocommerce input.button.transparent:hover,
.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce div.product div.woocommerce-tabs ul.tabs li.active,
#main-container .widget_product_categories ul.product-categories li.cat-item:hover span.count,
.widget_tag_cloud a[class^="tag-link"]:hover,
.widget_product_tag_cloud a[class^="tag-link"]:hover,
#cmo-footer .widget_categories ul li.cat-item a:hover,
#cmo-footer .widget_tag_cloud div.tagcloud a:hover,
#main-container .widget_categories ul li > a:hover span.count,
#main-container .widget_archive ul li > a:hover span.count,
.cmo-to-top a.cmo-to-top-anchor,
#main-container #buddypress a.button,
#main-container #buddypress input[type=submit],
#main-container #buddypress div.item-list-tabs ul li.current a,
#main-container #buddypress div.item-list-tabs ul li.selected a,
#main-container .epl-archive-entry-image > .cmo-epl-hover-wrapper .cmo-epl-icons-wrapper .cmo-epl-icon,
.cmo-button,
.cmo-button.transparent:hover,
.cmo-callout,
.cmo-content-box:not(.no-hover):hover,
.cmo-content-box:not(.no-hover):hover .icon,
.cmo-feature-box.style1 .title,
.cmo-feature-box.style1:hover .content,
.cmo-feature-box.style2:hover .title,
.cmo-feature-box.style2:hover .content-wrapper,
.cmo-pricing-column.style2 .cmo-button,
.cmo-team-member.style3:hover .info,
.cmo-team-member.style3:hover .info .name,
input[type=reset],
input[type=submit],
button,
input[type=reset].transparent:hover,
input[type=submit].transparent:hover,
button.transparent:hover {
  color: <?php echo esc_attr( $primary_bg_color ) ?>;
}
.doption-primary-bg-as-border,
header#cmo-header.header-style-2 nav a#nav-link-cart span.img-cart-icon,
article.type-post .cmo-article-link-href,
article.cmo-post-in-list .cmo-article-link-href,
.woocommerce #main-container .page-woo div.images div.thumbnails a,
#main-container .woocommerce div.images div.thumbnails a,
.woocommerce div.images div.thumbnails a,
#main-container .epl-archive-entry-image > .cmo-epl-hover-wrapper .cmo-epl-icons-wrapper .cmo-epl-icon,
.cmo-team-member.style4 .info {
  border-color: <?php echo esc_attr( $primary_bg_color ) ?>;
}
.doption-secondary-bg-color,
header#cmo-header nav div.main-menu ul.menu > li.menu-item > ul.sub-menu > li.menu-item ul.sub-menu,
body.responsive #mobile-menu-container ul.menu > li.menu-item ul.sub-menu > li > a,
body.responsive #mobile-menu-container ul.menu > li.menu-item ul.cmo-megamenu-wrapper > li > a,
body.responsive #mobile-menu-container ul.menu > li.menu-item ul.cmo-megamenu-sub-menu > li > a,
.blog-list-style-modern article.type-post > .cmo-article-featured-wrapper > .cmo-article-stretcher,
.blog-list-style-modern article.cmo-post-in-list > .cmo-article-featured-wrapper > .cmo-article-stretcher,
nav.navigation.pagination .page-numbers,
nav.navigation.pagination .page-numbers.current,
nav.navigation.pagination .page-numbers:hover,
nav.navigation.pagination div.nav-links > span.page-numbers:not(.dots),
.cmo-single .cmo-article-author,
#main-container section.comments-area,
.cmo-single-portfolio .cmo-portfolio-detail-wrapper,
.cmo-single-portfolio .cmo-portfolio-similar .cmo-portfolio-featured-image-bg,
#main-container .cmo-portfolio-categories-wrapper ul.filters li a,
#main-container .cmo-portfolio-items-wrapper .cmo-portfolio-featured-image-bg,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li span.page-numbers,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li span.page-numbers.current,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers.current,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li span.page-numbers:hover,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers:hover,
.woocommerce div.product div.woocommerce-tabs ul.tabs li,
.woocommerce-cart .woocommerce table.shop_table.cart th,
.woocommerce table.shop_table.cart th,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
#main-container .widget_product_categories ul.product-categories li.cat-item:hover,
.widget_archive li a:hover,
.widget_nav_menu li a:hover,
.widget_meta li a:hover,
.widget_pages li a:hover,
.widget_categories li a:hover,
#main-container .widget_categories ul li > a:hover,
#main-container .widget_archive ul li > a:hover,
.cmo-progress-bar .meter,
.cmo-team-member .info {
  background-color: <?php echo esc_attr( $secondary_bg_color ) ?>;
}
.doption-dark-bg-color,
header#cmo-header.header-style-1 #header-info-bar,
header#cmo-header.header-style-6 #header-info-bar,
body.responsive #mobile-menu-container button#toggle-mobile-menu span,
footer#cmo-footer.footer-style-3 .footer-widgets,
footer#cmo-footer.footer-style-3 #footer-copyright-bar,
.woocommerce #main-container .page-woo div.images div.thumbnails .owl-controls .owl-buttons .owl-prev,
#main-container .woocommerce div.images div.thumbnails .owl-controls .owl-buttons .owl-prev,
.woocommerce div.images div.thumbnails .owl-controls .owl-buttons .owl-prev,
.woocommerce #main-container .page-woo div.images div.thumbnails .owl-controls .owl-buttons .owl-next,
#main-container .woocommerce div.images div.thumbnails .owl-controls .owl-buttons .owl-next,
.woocommerce div.images div.thumbnails .owl-controls .owl-buttons .owl-next,
.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.woocommerce ul.products li.product.woo-listing-style-3 .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-add-cart-wrapper,
.cmo-pricing-column.style1.featured .cmo-button,
.cmo-pricing-column.style1:hover .cmo-button {
  background-color: <?php echo esc_attr( $dark_bg_color ) ?>;
}
.doption-dark-bg-as-color,
.woocommerce ul.products li.product.woo-listing-style-3 .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-more-buttons-wrapper > a,
.woo-listing-style-3 .lp-meta-likes {
  color: <?php echo esc_attr( $dark_bg_color ) ?>;
}
.doption-dark-bg-as-border,
.woocommerce ul.products li.product.woo-listing-style-3 .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-more-buttons-wrapper > a,
.woo-listing-style-3 .lp-meta-likes {
  border-color: <?php echo esc_attr( $dark_bg_color ) ?>;
}
.doption-menu-color,
header#cmo-header nav #nav-link-search,
header#cmo-header nav a#nav-link-cart,
header#cmo-header nav div.main-menu ul.menu > li.menu-item > ul.sub-menu > li.menu-item > a,
header#cmo-header nav div.main-menu ul.menu > li.menu-item > ul.sub-menu > li.menu-item ul.sub-menu > li.menu-item > a,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper > li.menu-item > a,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper > li.menu-item > a,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper > li.menu-item > a:hover,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper > li.menu-item > a:focus,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper > li.menu-item > a:active,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper > li.menu-item ul.cmo-megamenu-sub-menu > li.menu-item > a,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper > li.menu-item ul.cmo-megamenu-sub-menu > li.menu-item > a,
header#cmo-header.header-style-3 #header-info-bar .info-phone,
header#cmo-header.header-style-3 #header-info-bar .info-email,
header#cmo-header.header-style-3 nav div.main-menu ul.menu > li.menu-item > a,
header#cmo-header.header-style-3 a#nav-link-cart,
header#cmo-header.header-style-4 nav div.main-menu ul.menu > li.menu-item > a,
header#cmo-header.header-style-5 #header-info-bar .info-email span.info-before,
header#cmo-header.header-style-5 #header-info-bar .info-phone span.info-before,
header#cmo-header.header-style-5 div.main-menu ul.menu > li.menu-item > a,
header#cmo-header.header-style-5 div.main-menu ul.menu > li.menu-item > a:hover,
header#cmo-header.header-style-6 nav div.main-menu ul.menu > li.menu-item > a,
header#cmo-header.header-style-6 nav a#nav-link-cart,
body.responsive #mobile-menu-container ul.menu a {
  color: <?php echo esc_attr( $menu_color ) ?>;
}
.doption-menu-color-as-border,
span.img-cart-icon {
  border-color: <?php echo esc_attr( $menu_color ) ?>;
}
.doption-menu-color-as-background,
button#navbar-toggle .icon-bar {
  background-color: <?php echo esc_attr( $menu_color ) ?>;
}
.doption-border-color,
header#cmo-header nav #nav-link-search ~ div.main-menu > ul.menu > li:last-of-type > a,
header#cmo-header nav div#nav-shopping-cart-wrapper ~ div.main-menu > ul.menu > li:last-of-type > a,
header#cmo-header nav div.main-menu ul.menu > li.menu-item > ul.sub-menu > li.menu-item > a,
header#cmo-header nav div.main-menu ul.menu > li.menu-item > ul.sub-menu > li.menu-item ul.sub-menu > li.menu-item > a,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper > li.menu-item ul.cmo-megamenu-sub-menu > li.menu-item > a,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper > li.menu-item ul.cmo-megamenu-sub-menu > li.menu-item ul.cmo-megamenu-sub-menu.deeper-sub-menu > li.menu-item,
header#cmo-header.header-style-3 #header-info-bar,
header#cmo-header.header-style-5 #header-info-bar,
body.responsive #mobile-menu-container ul.menu > li.menu-item > a,
footer#cmo-footer.footer-style-4 .cmosc-contact-info,
article.type-post,
article.cmo-post-in-list,
nav.navigation.pagination .page-numbers,
.cmo-single .cmo-article-author,
#main-container section.comments-area,
#main-container section.comments-area ul.comment-list > li.comment div.comment-body,
#main-container section.comments-area ul.comment-list > li.pingback div.comment-body,
#main-container section.comments-area ul.comment-list > li.trackback div.comment-body,
#main-container section.comments-area ul.comment-list > li.comment div.comment-body div.comment-meta div.reply,
#main-container section.comments-area ul.comment-list > li.pingback div.comment-body div.comment-meta div.reply,
#main-container section.comments-area ul.comment-list > li.trackback div.comment-body div.comment-meta div.reply,
div.comment-respond,
p.wysija-paragraph input.wysija-input,
.woocommerce #main-container .page-woo div.entry-summary div[itemprop=description],
#main-container .woocommerce div.entry-summary div[itemprop=description],
.woocommerce div.entry-summary div[itemprop=description],
.woocommerce #main-container .page-woo div.entry-summary table.variations,
#main-container .woocommerce div.entry-summary table.variations,
.woocommerce div.entry-summary table.variations,
.woocommerce ul.products li.product,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li span.page-numbers,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers,
.woocommerce-cart .woocommerce table.shop_table.cart,
.woocommerce table.shop_table.cart,
.woocommerce-cart .woocommerce table.shop_table.cart th + th,
.woocommerce table.shop_table.cart th + th,
#main-container div.loop .loop-content .epl-listing-post:not( .epl-listing-grid-view ),
#main-container div.loop .loop-content .epl-listing-post.epl-listing-grid-view.epl-property-blog .property-box-left,
#main-container div.loop .loop-content .epl-listing-post.epl-listing-grid-view.epl-property-blog .property-box-right,
#main-container div.loop .loop-content .epl-listing-post.epl-listing-grid-view.epl-property-blog .property-box-right div.property-feature-icons,
#main-container div.loop .loop-content .epl-listing-post.epl-listing-grid-view.epl-property-blog .property-box-right div.property-feature-icons .cmo-epl-icon-wrapper + .cmo-epl-icon-wrapper,
#main-container .page-property-single .tab-title,
#main-container .page-property-single .epl-listing-single .title-meta-wrapper .property-feature-icons,
.cmo_accordion .wpb_accordion_section,
.wpb_content_element.cmo_tabs .cmo_tabs_wrapper .cmo_tab,
.wpb_content_element.cmo_tabs .cmo_tabs_nav,
.wpb_content_element.cmo_tabs .cmo_tabs_nav > li,
.wpb_content_element.cmo_tabs .cmo_tabs_nav > li:not(:last-child),
.cmo-team-member .info,
hr,
input[type=text],
input[type=search],
input[type=email],
input[type=url],
input[type=number],
input[type=tel],
input[type=password],
textarea,
select,
table tr,
abbr {
  border-color: <?php echo esc_attr( $border_color ) ?>;
}
.doption-border-color-as-color,
.wpb_content_element.cmo_tabs .cmo_tabs_nav > li {
  color: <?php echo esc_attr( $border_color ) ?>;
}
.doption-border-color-as-background,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper > li:after,
.blog-list-style-modern .cmo-article-start-border:before,
.blog-list-style-modern .cmo-article-end-border:before,
.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content {
  background-color: <?php echo esc_attr( $border_color ) ?>;
}
.doption-heading-color,
header#cmo-header div#nav-shopping-cart-wrapper ul.sub-menu > li a.cart-item-title,
#main-container .cmo-portfolio-categories-wrapper ul.filters li a,
.woocommerce div.product div.woocommerce-tabs ul.tabs li,
.woocommerce ul.products li.product.woo-listing-style-2 .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-add-cart-wrapper .cmo-add-to-cart > a,
.woocommerce ul.products li.product.woo-listing-style-2 .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-add-cart-wrapper > a,
.woocommerce ul.products li.product.woo-listing-style-2 .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-add-cart-wrapper > a i.fa,
.woocommerce ul.products li.product.woo-listing-style-3 .cmo-product-detail-wrapper h3 a,
.woocommerce ul.products li.product.woo-listing-style-3 .cmo-product-detail-wrapper .cmo-product-meta-wrapper span.price ins,
.woocommerce ul.products li.product.woo-listing-style-3 .cmo-product-detail-wrapper .cmo-product-meta-wrapper span.price del,
.woocommerce ul.products li.product.woo-listing-style-3 .cmo-product-detail-wrapper .cmo-product-meta-wrapper span.price > span.amount,
.woocommerce ul.products li.product.woo-listing-style-3 .cmo-product-detail-wrapper .star-rating,
#main-container .cmo-sidebar ul > li a:hover,
#main-container .cmo-sidebar ol > li a:hover,
#main-container .cmo-sidebar .widget_recent_comments ul > li a,
#main-container .cmo-sidebar .widget_recent_entries ul > li a,
#main-container .cmo-sidebar .widget_rss ul > li a,
#main-container .cmo-sidebar .widget_recent_comments ol > li a,
#main-container .cmo-sidebar .widget_recent_entries ol > li a,
#main-container .cmo-sidebar .widget_rss ol > li a,
.woo-listing-style-2 .lp-meta-likes,
.cmo-faq .cmo-faq-titles a.cmo-faq-link,
.cmosc-restaurant-menu-item span.cmosc-restaurant-menu-item-title,
h1,
h2,
h3,
h4,
h5,
h6,
.h1,
.h2,
.h3,
.h4,
.h5,
.h6,
h1 a,
h2 a,
h3 a,
h4 a,
h5 a,
h6 a,
.h1 a,
.h2 a,
.h3 a,
.h4 a,
.h5 a,
.h6 a,
dt {
  color: <?php echo esc_attr( $heading_color ) ?>;
}
.doption-heading-color-as-border,
.woocommerce-cart .woocommerce h2:after,
.woocommerce h2:after,
.woocommerce ul.products li.product.woo-listing-style-2 .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-add-cart-wrapper .cmo-add-to-cart,
.woocommerce ul.products li.product.woo-listing-style-2 .cmo-product-thumb-wrapper .cmo-product-thumb-hover .cmo-add-cart-wrapper > a,
#main-container div[class^='widget_'] h3:after,
#main-container div[class*=' widget_'] h3:after,
.woo-listing-style-2 .lp-meta-likes,
.cmo-box-border:after,
.cmo-section-header .separator {
  border-color: <?php echo esc_attr( $heading_color ) ?>;
}
.doption-heading-color-as-background,
.woocommerce-cart .woocommerce h2:before,
.woocommerce h2:before,
#main-container div[class^='widget_'] h3:before,
#main-container div[class*=' widget_'] h3:before,
.cmo-box-border:before,
.cmo-section-header .separator:before,
.cmo-section-header .separator:after,
.cmo-section-header.separator-weightlifting .separator .bar {
  background-color: <?php echo esc_attr( $heading_color ) ?>;
}
.doption-heading-font,
.cmo-page-title .page-title-container,
nav.navigation.pagination .page-numbers,
.cmo-single .cmo-article-author .cmo-article-author-info .cmo-article-author-name,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li span.page-numbers,
.woocommerce nav.woocommerce-pagination ul.page-numbers > li a.page-numbers,
#cmo-footer .widget_categories ul li.cat-item a,
#main-container div.loop .loop-content .epl-listing-post.epl-listing-grid-view.epl-property-blog .property-box-left .epl-archive-entry-image .epl-blog-image .epl-stickers-wrapper,
.cmo-callout .content,
.cmo-callout .buttons-wrapper .cmo-button,
.cmo-data-counter .content-container,
.cmo-faq .cmo-faq-titles a.cmo-faq-link,
h1,
h2,
h3,
h4,
h5,
h6,
.h1,
.h2,
.h3,
.h4,
.h5,
.h6 {
  font-family: <?php echo esc_attr( cmo_get_theme_mod_value("heading-font") ) ?>, "Helvetica Neue", Helvetica, sans-serif;
}
.doption-heading-font-weight,
h1,
h2,
h3,
h4,
h5,
h6,
.h1,
.h2,
.h3,
.h4,
.h5,
.h6 {
  font-weight: <?php echo esc_attr( cmo_get_theme_mod_value("heading-font-weight") ) ?>;
}
.doption-text-font,
header#cmo-header div#nav-shopping-cart-wrapper ul.sub-menu,
header#cmo-header.header-style-1 #header-info-bar,
header#cmo-header.header-style-6 #header-info-bar,
#main-container div.loop .loop-content .epl-listing-post.epl-listing-grid-view.epl-property-blog .property-box-right .entry-title,
body {
  font-family: <?php echo esc_attr( cmo_get_theme_mod_value("text-font") ) ?>, "Helvetica Neue", Helvetica, sans-serif;
}
.doption-text-font-weight,
body {
  font-weight: <?php echo esc_attr( cmo_get_theme_mod_value("text-font-weight") ) ?>;
}
.doption-sub-heading-font,
article.type-post .cmo-article-contents .cmo-article-meta-wrapper h1,
article.cmo-post-in-list .cmo-article-contents .cmo-article-meta-wrapper h1,
article.type-post .cmo-article-contents .cmo-article-meta-wrapper h2,
article.cmo-post-in-list .cmo-article-contents .cmo-article-meta-wrapper h2,
div.comment-respond h3 > small a,
.woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.cmo-button,
.cmo-content-box .title,
input[type=reset],
input[type=submit],
button {
  font-family: <?php echo esc_attr( cmo_get_theme_mod_value("sub-heading-font") ) ?>, "Helvetica Neue", Helvetica, sans-serif;
}
.doption-sub-heading-font-weight,
.cmo-content-box .title {
  font-weight: <?php echo esc_attr( cmo_get_theme_mod_value("sub-heading-font-weight") ) ?>;
}
.doption-menu-font,
footer#cmo-footer.footer-style-3 .cmosc-contact-info,
footer#cmo-footer.footer-style-4 .cmosc-contact-info {
  font-family: <?php echo esc_attr( cmo_get_theme_mod_value("menu-font") ) ?>, "Helvetica Neue", Helvetica, sans-serif;
}
.doption-menu-font-weight,
header#cmo-header nav div.main-menu ul.menu > li.menu-item.cmo-megamenu > ul.cmo-megamenu-wrapper > li.menu-item > a {
  font-weight: <?php echo esc_attr( cmo_get_theme_mod_value("menu-font-weight") ) ?>;
}
.doption-text-font-size,
body {
  font-size: <?php echo esc_attr( $text_font_size ) ?>;
}
