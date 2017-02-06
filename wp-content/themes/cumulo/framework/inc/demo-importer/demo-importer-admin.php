<?php

add_action( 'admin_menu', 'cmo_demo_importer_menu', 11 );
function cmo_demo_importer_menu() {
	add_theme_page(
		__( 'Demo Import', 'cumulo' ),
		__( 'Demo Import', 'cumulo' ),
		'manage_options',
		CMO_THEME_SLUG . '-demo-content',
		'cmo_demo_importer_admin'
	);
}
function cmo_demo_importer_admin() {
?>
<h1 class='cmo-pagetitle'><?php echo CMO_THEME_NAME . ' ' . __( 'Demo Content Importer', 'cumulo' ) ?></h1>
<div class="metabox-holder">
	<div class='cmo-demo-importer-admin postbox cmo-admin-section'>
		<div class="handlediv" title="Click to toggle"><br></div>
		<h3 class='hndle ui-sortable-handle'>
			<span><?php _e( 'Demo Content Importer', 'cumulo' ); ?></span>
		</h3>
		<div class='content inside import-form'>
			<div class='section'>
				<?php _e( 'Click the button below to load demo content.', 'cumulo' ) ?>
			</div>
			<a class="button button-primary button-demo-import" href="#"><?php _e( 'Import Demo Content', 'cumulo' ) ?></a>
			<div class='clear'></div>
			<div class='note'>
				<strong><?php _e( 'Important Notes', 'cumulo' ) ?></strong>
				<ul>
					<li><?php _e( 'All customizer settings will be overwritten.', 'cumulo' ) ?></li>
					<li><?php _e( 'Please install all required plugins before loading demo content.', 'cumulo' ) ?></li>
					<li><?php _e( 'It will take a few minutes to download all attachments from demo website.', 'cumulo' ) ?></li>
				</ul>
			</div>
			<div class='clear'></div>
		</div>
		<div class='content inside progress'>
		</div>
	</div>
</div>
<?php

$ajax_nonce = wp_create_nonce( DEMO_IMPORTER_NONCE );
?>
<script type="text/javascript">
"use strict";

( function( $, window, undefined ) {
	var admin_ajax_url = '<?php echo admin_url( 'admin-ajax.php' ) ?>';
	var demo = '';
	function import_one_type( name, slug, complete_handler ) {
		$('.progress').append( '<p><?php echo __( 'Importing', 'cumulo' ) ?> ' + name + '...' + '</p>' );
		$.ajax( {
			url: admin_ajax_url,
			type: 'post',
			data: {
				action: 'cmo_demo_import_' + slug,
				demo: demo,
				security: '<?php echo esc_js( $ajax_nonce ); ?>'
			},
			success: function( data ) {
				if( data == -1 ) {
					return;
				}
				if( data != "done" ) {
					$('.progress').append( '<p><?php _e( 'Errors occurred while importing', 'cumulo' ) ?> ' + name + ': ' + data + '</p>' );
				}
				complete_handler();
			},
			error: function( data ) {
				$('.progress').append( '<p><?php _e( 'Error occurred.', 'cumulo' ) ?></p>' );
			}
		} );
	}

	function import_posts() {
		import_one_type( '<?php echo __( 'Posts', 'cumulo' ) ?>', 'posts', import_pages );
	}
	function import_pages() {
		import_one_type( '<?php echo __( 'Pages', 'cumulo' ) ?>', 'pages', import_portfolio );
	}
	function import_portfolio() {
		import_one_type( '<?php echo __( 'Portfolio', 'cumulo' ) ?>', 'portfolio', import_menu );
	}
	function import_menu() {
		import_one_type( '<?php echo __( 'Menu', 'cumulo' ) ?>', 'menu', import_cf );
	}
	function import_cf() {
		import_one_type( '<?php echo __( 'Contact Forms', 'cumulo' ) ?>', 'cf', import_products );
	}
	function import_products() {
		import_one_type( '<?php echo __( 'Products', 'cumulo' ) ?>', 'products', import_properties );
	}
    function import_properties() {
        import_one_type( '<?php echo __( 'Properties', 'cumulo' ) ?>', 'properties', import_attachments );
    }
	function import_attachments() {
		import_one_type( '<?php echo __( 'Attachments', 'cumulo' ) ?>', 'attachments', widget_import );
	}
	function widget_import() {
		$('.progress').append( '<p><?php _e( 'Importing Widgets...', 'cumulo' ) ?></p>' );
		$.ajax( {
			url: admin_ajax_url,
			type: 'post',
			data: {
				action: 'cmo_demo_widgets_import',
				demo: demo,
				security: '<?php echo esc_js( $ajax_nonce ); ?>'
			},
			success: function( data ) {
				if( data == -1 ) {
					return;
				}
				if( data != "done" ) {
					$('.progress').append( '<p><?php _e( 'Errors occurred while importing widgets:', 'cumulo' ) ?> ' + data + '</p>' );
				}
				import_tc_settings();
			},
			error: function( data ) {
				$('.progress').append( '<p><?php _e( 'Error occurred.', 'cumulo' ) ?></p>' );
			}
		} );
	}
	function import_tc_settings() {
		$('.progress').append( '<p><?php _e( 'Importing Customizer Settings...', 'cumulo' ) ?></p>' );
		$.ajax( {
			url: admin_ajax_url,
			type: 'post',
			data: {
				action: 'cmo_demo_import_tc_settings',
				demo: demo,
				security: '<?php echo esc_js( $ajax_nonce ); ?>'
			},
			success: function( data ) {
				if( data == -1 ) {
					return;
				}
				if( data != "done" ) {
					$('.progress').append( '<p><?php _e( 'Errors occurred while importing customizer settings:', 'cumulo' ) ?> ' + data + '</p>' );
				}
				import_sliders();
			},
			error: function( data ) {
				$('.progress').append( '<p><?php _e( 'Error occurred.', 'cumulo' ) ?></p>' );
			}
		} );
	}
	function import_sliders() {
		$('.progress').append( '<p><?php _e( 'Importing Sliders...', 'cumulo' ) ?></p>' );
		$.ajax( {
			url: admin_ajax_url,
			type: 'post',
			data: {
				action: 'cmo_demo_import_sliders',
				demo: demo,
				security: '<?php echo esc_js( $ajax_nonce ); ?>'
			},
			success: function( data ) {
				if( data == -1 ) {
					return;
				}
				if( data != "done" ) {
					$('.progress').append( '<p><?php _e( 'Errors occurred while importing sliders:', 'cumulo' ) ?> ' + data + '</p>' );
				} else {
					$('.progress').append( '<p><?php _e( 'Import finished. Please do not forget to set main navigation menu and front page.', 'cumulo' ) ?></p>' );
				}
			},
			error: function( data ) {
				$('.progress').append( '<p><?php _e( 'Error occurred.', 'cumulo' ) ?></p>' );
			}
		} );
	}
	function start_import() {
		import_posts();
	}
	$(window).load( function() {
		$('.button-demo-import').on( 'click', function() {
			demo = $('#demo').val();
			$('.import-form').fadeOut( 600, function() {
				$('.progress').fadeIn( 300 );
				start_import();
			} );
			return false;
		} );
	} );
} )( jQuery, window );
</script>
<?php
}