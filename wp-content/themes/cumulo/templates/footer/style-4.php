	<div class='footer-widgets'>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php 
					echo wp_kses(
						do_shortcode( "[cmo_contact_info type='phone'][/cmo_contact_info]"), 
						array(
							'i' => array(
						        'class' => array()
						    ),
							'span' => array(
						        'class' => array()
						    ),
							'div' => array(
						        'class' => array(),
						        'id' => array()
						    )
						)
					) ?>
					<?php 
					echo wp_kses(
						do_shortcode( "[cmo_contact_info type='email'][/cmo_contact_info]"), 
						array(
							'i' => array(
						        'class' => array()
						    ),
							'span' => array(
						        'class' => array()
						    ),
							'div' => array(
						        'class' => array(),
						        'id' => array()
						    )
						)
					) ?>
					<?php 
					echo wp_kses(
						do_shortcode( "[cmo_contact_info type='address'][/cmo_contact_info]"), 
						array(
							'i' => array(
						        'class' => array()
						    ),
							'span' => array(
						        'class' => array()
						    ),
							'div' => array(
						        'class' => array(),
						        'id' => array()
						    )
						)
					) ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<?php
					echo wp_kses(
						do_shortcode( "[cmo_footer_social][/cmo_footer_social]" ),
						array(
								'ul' => array (
										'class' => array()
								),
								'i' => array (
										'class' => array()
								),
								'li' => array ( ),
								'a' => array (
										'class' => array(),
										'href' => array()
								)
						)
					);
					?>
				</div>
			</div>
		</div>
	</div>
	<?php if ( cmo_is_yes_or_one( cmo_get_page_theme_option( 'footer_show_copyright', 'footer-show-copyright' ) ) ) { ?>
	<div id="footer-copyright-bar">
		<div class="container">
			<nav id="footer-nav" class="pull-right">
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

			<div id="footer-copyright-text" class="pull-left">
				<?php echo esc_html( cmo_get_theme_mod_value( "footer-copyright-text" ) ); ?>
			</div>
		</div>
	</div>
	<?php } ?>