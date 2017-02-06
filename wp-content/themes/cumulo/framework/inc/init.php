<?php
if (is_admin ()) {
	/*
	 * TGM Plugin Activation
	 */
	add_action ( 'tgmpa_register', 'register_required_plugins' );
	function register_required_plugins() {
		
		/**
		 * Array of plugin arrays.
		 * Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array (
				array (
						'name' 		=> 'Cumulo Extension',
						'slug' 		=> 'cumulo-extension',
						'source' 	=> get_stylesheet_directory() . '/framework/plugins/cumulo-extension.zip',
						'required' 	=> true,
						'version' 	=> '1.1',
						'force_activation' 	=> true,
						'external_url' 		=> '' 
				),
				array (
						'name' 		=> 'Visual Composer',
						'slug' 		=> 'js_composer',
						'source' 	=> get_stylesheet_directory() . '/framework/plugins/js_composer.zip',
						'required' 	=> true,
						'version' 	=> '4.7.4',
						'external_url' 	=> '' 
				),
				array (
						'name' 		=> 'Revolution Slider',
						'slug' 		=> 'revslider',
						'source' 	=> get_stylesheet_directory() . '/framework/plugins/revslider.zip',
						'required' 	=> true,
						'version' 	=> '5.0.6',
						'external_url' 	=> '' 
				),
				array (
						'name' 		=> 'Layer Slider',
						'slug' 		=> 'LayerSlider',
						'source' 	=> get_stylesheet_directory() . '/framework/plugins/layerslider.zip',
						'required' 	=> false,
						'version' 	=> '5.6.2',
						'external_url' 	=> '' 
				),
				array (
						'name'		=> 'Woocommerce',
						'slug'		=> 'woocommerce',
						'required'	=> false,
						'version'	=>	'2.4.5'
				), 
				array (
						'name'		=> 'Contact Form 7',
						'slug'		=> 'contact-form-7',
						'required'	=> false,
						'version'	=>	'4.2.2'
				),
				array (
						'name'		=> 'YITH WooCommerce Quick View',
						'slug'		=> 'yith-woocommerce-quick-view',
						'required'	=> false,
						'version'	=>	'1.0.8'
				),
				array (
						'name'		=> 'Easy Property Listings',
						'slug'		=> 'easy-property-listings',
						'required'	=> false,
						'version'	=>	'2.2.6'
				)
		);
		/**
		 * Array of configuration settings.
		 * Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array (
				'default_path' => '', // Default absolute path to pre-packaged plugins.
				'menu' => 'tgmpa-install-plugins', // Menu slug.
				'has_notices' => true, // Show admin notices or not.
				'dismissable' => true, // If false, a user cannot dismiss the nag message.
				'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
				'is_automatic' => false, // Automatically activate plugins after installation or not.
				'message' => '', // Message to output right before the plugins table.
				'strings' => array (
						'page_title' => __ ( 'Install Required Plugins', 'tgmpa' ),
						'menu_title' => __ ( 'Install Plugins', 'tgmpa' ),
						'installing' => __ ( 'Installing Plugin: %s', 'tgmpa' ),
						'oops' => __ ( 'Something went wrong with the plugin API.', 'tgmpa' ),
						'notice_can_install_required' => _n_noop ( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'cumulo' ), // %1$s = plugin name(s).
						'notice_can_install_recommended' => _n_noop ( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'cumulo' ), // %1$s = plugin name(s).
						'notice_cannot_install' => _n_noop ( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'cumulo' ), // %1$s = plugin name(s).
						'notice_can_activate_required' => _n_noop ( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'cumulo' ), // %1$s = plugin name(s).
						'notice_can_activate_recommended' => _n_noop ( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'cumulo' ), // %1$s = plugin name(s).
						'notice_cannot_activate' => _n_noop ( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'cumulo' ), // %1$s = plugin name(s).
						'notice_ask_to_update' => _n_noop ( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'cumulo' ), // %1$s = plugin name(s).
						'notice_cannot_update' => _n_noop ( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'cumulo' ), // %1$s = plugin name(s).
						'install_link' => _n_noop ( 'Begin installing plugin', 'Begin installing plugins', 'cumulo' ),
						'activate_link' => _n_noop ( 'Begin activating plugin', 'Begin activating plugins', 'cumulo' ),
						'return' => __ ( 'Return to Required Plugins Installer', 'tgmpa' ),
						'plugin_activated' => __ ( 'Plugin activated successfully.', 'tgmpa' ),
						'complete' => __ ( 'All plugins installed and activated successfully. %s', 'tgmpa' ),
						'nag_type' => 'updated' 
				) 
		);
		
		tgmpa ( $plugins, $config );
	}
	
	/* Theme admin css */
	if( !function_exists( 'cmo_admin_css' ) ) {
		add_action( 'admin_enqueue_scripts', 'cmo_admin_css' );
		function cmo_admin_css() {
			wp_enqueue_style( 'cmo-admin', CMO_FRAMEWORK_URI . '/assets/css/admin.css' );
		}
	}
}

/*
 * Theme Initialization
 */
function cmo_init() {
	register_nav_menu ( 'main-menu', __ ( 'Main Navigation Menu', 'cumulo' ) );
	register_nav_menu ( 'secondary-menu', __ ( 'Secondary Menu', 'cumulo' ) );
}
add_action ( 'init', 'cmo_init' );
