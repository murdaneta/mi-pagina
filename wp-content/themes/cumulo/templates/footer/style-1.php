	<div class='footer-widgets'>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<aside class="cmo-sidebar">
						<?php
							$cmo_sidebar = cmo_get_page_theme_option( 'footer_widget_1', 'footer-widget-1', '0' );  
							if ( !empty($cmo_sidebar) ) dynamic_sidebar( $cmo_sidebar ); ?>
					</aside>
				</div>
				<div class="col-md-3">
					<aside class="cmo-sidebar">
						<?php
							$cmo_sidebar = cmo_get_page_theme_option( 'footer_widget_2', 'footer-widget-2', '0');  
							if ( !empty($cmo_sidebar) ) dynamic_sidebar( $cmo_sidebar ); ?>
					</aside>
				</div>
				<div class="col-md-3">
					<aside class="cmo-sidebar">
						<?php
							$cmo_sidebar = cmo_get_page_theme_option( 'footer_widget_3', 'footer-widget-3', '0' );  
							if ( !empty($cmo_sidebar) ) dynamic_sidebar( $cmo_sidebar ); ?>
					</aside>
				</div>
				<div class="col-md-3">
					<aside class="cmo-sidebar">
						<?php
							$cmo_sidebar = cmo_get_page_theme_option( 'footer_widget_4', 'footer-widget-4', '0' );  
							if ( !empty($cmo_sidebar) ) dynamic_sidebar( $cmo_sidebar ); ?>
					</aside>
				</div>
			</div>
		</div>
	</div>

	<?php if ( cmo_is_yes_or_one( cmo_get_page_theme_option( 'footer_show_copyright', 'footer-show-copyright' ) ) ) { ?>
	<div id="footer-copyright-bar">
		<div class="container">
			<nav id="footer-nav" class="pull-left">
				<?php
					if ( has_nav_menu( 'main-menu' ) ) {
					wp_nav_menu( 
						array( 
							'theme_location' 	=> 'main-menu',
							'container_id'		=>	'footer-menu-wrapper',
							'container_class' 	=> 'main-menu', 
							'items_wrap' 		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'				=>	'1',
							'walker' 			=> new Cumulo_Nav_Walker()
						)
					);
					}
				?>
			</nav>

			<div id="footer-copyright-text" class="pull-right">
				<?php echo esc_html( cmo_get_theme_mod_value( 'footer-copyright-text', '' ) ); ?>
			</div>
		</div>
	</div>
	<?php } ?>