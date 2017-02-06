	<div class='footer-widgets'>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<?php 
					echo wp_kses(
						do_shortcode( "[cmo_contact_info type='phone' icon='et-line icon-phone'][/cmo_contact_info]"), 
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
				<div class="col-md-4">
					<?php 
					echo wp_kses(
						do_shortcode( "[cmo_contact_info type='email' icon='et-line icon-envelope'][/cmo_contact_info]"), 
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
				<div class="col-md-4">
					<?php 
					echo wp_kses(
						do_shortcode( "[cmo_contact_info type='address' icon='et-line icon-map'][/cmo_contact_info]"), 
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
			<div id="footer-copyright-text" class="text-center">
				<?php echo esc_html( cmo_get_theme_mod_value( "footer-copyright-text" ) ); ?>
			</div>
		</div>
	</div>
	<?php } ?>