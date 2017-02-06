<?php
$display_header 	= cmo_is_yes_or_one( cmo_get_page_theme_option( "header_show_header", "header-show-header" ) );
$header_style 		= cmo_get_page_theme_option( "header_style", "header-style" );
$display_top_bar 	= cmo_is_yes_or_one( cmo_get_page_theme_option( "header_infobar_visible", "header-infobar-visible" ) );
$topbar_phone 		= cmo_get_theme_mod_value( "header-infobar-phone" );
$topbar_email 		= cmo_get_theme_mod_value( "header-infobar-email" );

$show_search 		= cmo_is_yes_or_one( cmo_get_page_theme_option( 'header_menu_show_search', 'header-menu-show-search' ) );
$show_menu 			= cmo_is_yes_or_one( cmo_get_page_theme_option( 'header_show_menu', 'header-show-menu' ) );
$show_cart 			= cmo_is_yes_or_one( cmo_get_page_theme_option( 'header_menu_show_cart', 'header-menu-show-cart' ) );
$enable_sticky 		= cmo_is_yes_or_one( cmo_get_page_theme_option( 'header_menu_sticky', 'header-menu-sticky' ) );
$display_breadcrumb = cmo_is_yes_or_one( cmo_get_page_theme_option( 'header_breadcrumb_show', 'header-breadcrumb-show' ) );
$transparent_header = cmo_is_yes_or_one( cmo_get_page_theme_option( "header_transparent_header", "header-transparent-header" ) );


$slider_type 		= cmo_get_page_theme_option( "slider_type", null );

$slider = "";
if ( $slider_type == "layer" ) {
	$slider 		= cmo_get_page_theme_option( "layerslider", null );
}
else if ( $slider_type == "rev" ) {
	$slider 		= cmo_get_page_theme_option( "revslider", null );
}
else if ( $slider_type == "custom" ) {
	$slider 		= cmo_get_page_theme_option( "custom_slider", null );
}

$slider_nav = false;

if ( ( is_page() || is_single() ) && $transparent_header ) {
	$slider_nav = true;
}
?>

<?php if ( $display_header ) { ?>
<header id="cmo-header" class="<?php echo "header-" . esc_attr( $header_style ); ?> <?php if ( $slider_nav ) echo "slider-nav"; ?> <?php if ( $enable_sticky ) echo "enable-sticky"; ?>">
	<?php if ( $display_top_bar ) { ?>
	<div id="header-info-bar">
		<div class="container">
			<?php if ( $topbar_email ) { ?>
			<span class="info-email"><span class="info-icon-wrapper"><i class="fa fa-envelope-o"></i></span><span><?php echo esc_html( $topbar_email ); ?></span></span>
			<?php } ?>
			<?php if ( $topbar_phone ) { ?>
			<span class="info-phone"><span class="info-icon-wrapper"><i class="fa fa-phone"></i></span><span><?php echo esc_html( $topbar_phone ) ?></span></span>
			<?php } ?>

			<ul class="header-social">
			<?php 
			$social_links = array( "twitter", "linkedin", "facebook", "skype", "google-plus", "dribbble", "pinterest", "apple", "instagram", "youtube", "vimeo-square", "rss" );
			foreach( $social_links as $social_link ) {
				$val = cmo_get_theme_mod_value("header-social-" . $social_link);
				if ( !empty($val) ) { ?><li><a href="<?php echo esc_url( $val ) ?>" class="social-<?php echo esc_attr( $social_link ) ?>"><i class="fa fa-<?php echo esc_attr( $social_link ) ?>"></i></a></li><?php }
			}
			?></ul>
		</div>
	</div>
	<?php } ?>

	<nav class="container">
		<div class="mobile-nav">
			<button type="button" id="navbar-toggle" class="toggle-button" data-target="mobile-menu-container">
				<span class="sr-only">Toggle navigation</span> 
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>

		<div id="logo-header">
			<a class="logo" href="<?php echo esc_url( get_home_url() ) ?>">
			<?php 
                $logo_main = cmo_get_theme_mod_value("header-logo");
                if ( empty($logo_main) ) {
                    $logo_img = cmo_get_absolute_url( "assets/images/logo.png" );
                }
                else {
                    $logo_img = $logo_main;
                }
                ?>
                <span><img src="<?php echo esc_url( $logo_img ) ?>" alt="Logo" /></span>
                <?php
                $logo_light = cmo_get_theme_mod_value("header-transparent-header-logo");
                
                if ( empty( $logo_light ) ) {
                	if ( empty( $logo_main ) ) { ?>
                		<span><img src="<?php echo esc_url( cmo_get_absolute_url( "assets/images/logo-light.png" ) ) ?>" alt="Default Logo Light" /></span>
                	<?php } else { ?>
                		<span><img src="<?php echo esc_url( $logo_img ) ?>" alt="Logo Light " /></span>
                <?php } 
                } else { ?>
					<span><img src="<?php echo esc_url( $logo_light ) ?>" alt="Logo Light" /></span>
                <?php } ?>
			</a>
		</div>

		<div class="nav-wrapper">
		<?php
			if ( $show_menu ) {
				$cmo_pmenu = cmo_get_page_theme_option( 'header_menu', null );
				if ( $cmo_pmenu !== "secondary-menu" ) {
					$cmo_pmenu = "main-menu";
				}

				if ( has_nav_menu( $cmo_pmenu ) ) {
					if ( $show_search ) { ?>
						<div id="nav-link-search"><i class="fa fa-search"></i>
							<form role="search" class="searchform" method="get" action="<?php echo esc_url( get_site_url() ); ?>">
								<span id="nav-search-container">
									<input type="text" placeholder="<?php esc_html_e( 'Type here and hit enter...', 'cumulo' ) ?>" name="s" autocomplete="off" spellcheck="false" />
									<input type="submit" class="hidden" />
								</span>
							</form>
						</div>
					<?php }
					// --- include shopping cart icon for wooCommerce ---
					if ( $show_cart ) {
						if( class_exists('Woocommerce') ) {
							echo cmo_get_wc_mini_cart();
						}
					}

					wp_nav_menu( 
						array( 
							'theme_location' => $cmo_pmenu,
							'container_id'	=>	'main-menu-wrapper',
							'container_class' => 'main-menu', 
							'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'walker' => new Cumulo_Nav_Walker()
						)
					);
				} else {
					echo '<div id="menu-not-assigned">Assign a menu</div>';
				}
			}
		?>
		</div>
	</nav>
</header>
<?php } /* end of display header condition check */ ?>

<?php if ( !is_home() && $display_breadcrumb ) { ?>
<div class="cmo-page-title"><div class="vcenter">
	<div class="container">
		<div class="pull-left page-title-container">
			<?php echo cmo_get_custom_title();?>
		</div>
		<div class="pull-right breadcrumbs-container">
			<?php cmo_breadcrumb(); ?>
		</div>
	</div>
</div></div>
<?php } ?>