<?php

/****************************************************
 *				WP Theme Customizer					*
 ****************************************************/

require_once( 'customizer-library/customizer-library.php' );
require_once( 'customizer-admin.php' );
require_once( 'default-options.php' );

function cmo_remove_default_sections( $wp_customize ) {
	//$wp_customize->remove_section( 'nav' );
	$wp_customize->remove_section( 'themes' );
	// $wp_customize->remove_control( 'title_tagline' );
	// $wp_customize->remove_section( 'static_front_page' );
	// $wp_customize->remove_control( 'blogname' );
	// $wp_customize->remove_control( 'blogdescription' );
	// $wp_customize->remove_panel( 'widgets' );
}
add_action( 'customize_register', 'cmo_remove_default_sections' );

function customizer_library_options() {
	global $default_options;

	// Stores all the controls that will be added
	$options = array();
	// Stores all the sections to be added
	$sections = array();
	// Stores all the panels to be added
	$panels = array();
	// Adds the sections to the $options array
	$options['sections'] = $sections;
	
	/* --- header options --- */
	$panels[] = array(
			'id' => "panel-header",
			'title' => __( 'Header', 'cumulo' ),
			'priority' => '80'
	);
	
	$sections[] = array(
			'id' => "section-header-style",
			'title' => __( 'Style', 'cumulo' ),
			'priority' => '80',
			'panel' => "panel-header"
	);
	$options['header-show-header'] = array(
			'id' => 'header-show-header',
			'label'   => __( 'Show Header', 'cumulo' ),
			'section' => "section-header-style",
			'type'    => 'checkbox',
			'default' => $default_options['header-show-header']
	);
	$options['header-style'] = array(
			'id' => 'header-style',
			'label'   => __( 'Header Style', 'cumulo' ),
			'section' => "section-header-style",
			'type'    => 'select',
			'choices' => array( 
					"style-1"	=>	__( "Style 1", 'cumulo' ), 
					"style-2"	=>	__( "Style 2 ( Image Background )", 'cumulo' ), 
					"style-3"	=>	__( "Style 3", 'cumulo' ), 
					"style-4"	=>	__( "Style 4", 'cumulo' ), 
					"style-5"	=>	__( "Style 5", 'cumulo' ), 
					"style-6"	=>	__( "Style 6", 'cumulo' ) 
			),
			'default' => $default_options['header-style']
	);
	$options['header-background-image'] = array(
			'id' 				=> 'header-background-image',
			'label'   			=> __( 'Header Background Image', 'cumulo' ),
			'section' 			=> "section-header-style",
			'type'    			=> 'image',
			'default' 			=> $default_options['header-background-image'],
			'description'		=>	__( 'This option works with header style 2 only.', 'cumulo' ),
			'active_callback'	=>	cmo_handle_customizer_dependancy( 'header-style', 'style-2' )
	);

	$options['header-background-repeat'] = array(
			'id' 				=> 'header-background-repeat',
			'label'   			=> __( 'Header Background Repeat', 'cumulo' ),
			'section' 			=> "section-header-style",
			'type'    			=> 'radio',
			'choices' 			=> array (
					'cover'		=>  __( 'Cover', 'cumulo' ),
					'repeat' 	=>	__( 'Tile', 'cumulo' ),
					'repeat-x'	=>	__( 'Tile Horizontally', 'cumulo' ),
					'repeat-y'	=>	__( 'Tile Vertically', 'cumulo' ),
					'no-repeat'	=>	__( 'No Repeat', 'cumulo' )
			),
			'default' 			=> $default_options['header-background-repeat'],
			'active_callback'	=> cmo_handle_customizer_dependancy( 'header-style', 'style-2' )
	);

	$options['header-transparent-header'] = array(
			'id' => 'header-transparent-header',
			'label'   => __( 'Enable Transparent Header', 'cumulo' ),
			'section' => "section-header-style",
			'type'    => 'checkbox',
			'default' => $default_options['header-transparent-header']
	);

	$sections[] = array(
			'id' => "section-header-logo",
			'title' => __( 'Logo', 'cumulo' ),
			'priority' => '80',
			'panel' => "panel-header"
	);
	$options['header-logo'] = array(
			'id' => 'header-logo',
			'label'   => __( 'Header Logo', 'cumulo' ),
			'section' => "section-header-logo",
			'type'    => 'image',
			'default' => $default_options['header-logo']
	);
	$options['header-logo-margin-top'] = array(
			'id' => 'header-logo-margin-top',
			'label'   => __( 'Logo Top Margin', 'cumulo' ),
			'section' => "section-header-logo",
			'type'    => 'text',
			'default'	=> $default_options['header-logo-margin-top'],
			'transport' => 'postMessage'
	);
	$options['header-transparent-header-logo'] = array(
	    'id' 				=> 'header-transparent-header-logo',
	    'label'   			=> __( 'Logo on Transparent Header', 'cumulo' ),
	    'section' 			=> "section-header-logo",
	    'type'    			=> 'image',
	    'default' 			=> $default_options['header-transparent-header-logo'],
	    'description'		=>	__( 'Leave it empty for default logo', 'cumulo' ),
	    // 'active_callback'	=>	cmo_handle_customizer_dependancy( 'header-transparent-header', '1' )
	);
	
	$sections[] = array(
			'id' => "section-header-infobar",
			'title' => __( 'Information Bar', 'cumulo' ),
			'priority' => '80',
			'panel' => "panel-header"
	);
	$options['header-infobar-visible'] = array(
			'id' => 'header-infobar-visible',
			'label'   => __( 'Show Infomation Bar', 'cumulo' ),
			'section' => "section-header-infobar",
			'type'    => 'checkbox',
			'default' => $default_options['header-infobar-visible']
	);
	$options['header-infobar-phone'] = array(
			'id' => 'header-infobar-phone',
			'label'   => __( 'Phone NO', 'cumulo' ),
			'section' => "section-header-infobar",
			'type'    => 'text',
			'default' => $default_options['header-infobar-phone'],
			'transport' => 'postMessage'
	);
	$options['header-infobar-email'] = array(
			'id' => 'header-infobar-email',
			'label'   => __( 'Email', 'cumulo' ),
			'section' => "section-header-infobar",
			'type'    => 'text',
			'default' => $default_options['header-infobar-email'],
			'transport' => 'postMessage'
	);
	$options['header-social-twitter'] = array(
			'id' => 'header-social-twitter',
			'label'   => __( 'Twitter', 'cumulo' ),
			'section' => "section-header-infobar",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['header-social-linkedin'] = array(
			'id' => 'header-social-linkedin',
			'label'   => __( 'LinkedIn', 'cumulo' ),
			'section' => "section-header-infobar",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['header-social-facebook'] = array(
			'id' => 'header-social-facebook',
			'label'   => __( 'Facebook', 'cumulo' ),
			'section' => "section-header-infobar",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['header-social-skype'] = array(
			'id' => 'header-social-skype',
			'label'   => __( 'Skype', 'cumulo' ),
			'section' => "section-header-infobar",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['header-social-google-plus'] = array(
			'id' => 'header-social-google-plus',
			'label'   => __( 'Google+', 'cumulo' ),
			'section' => "section-header-infobar",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['header-social-dribbble'] = array(
			'id' => 'header-social-dribbble',
			'label'   => __( 'Dribbble', 'cumulo' ),
			'section' => "section-header-infobar",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['header-social-pinterest'] = array(
			'id' => 'header-social-pinterest',
			'label'   => __( 'Pinterest', 'cumulo' ),
			'section' => "section-header-infobar",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['header-social-apple'] = array(
			'id' => 'header-social-apple',
			'label'   => __( 'Apple', 'cumulo' ),
			'section' => "section-header-infobar",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['header-social-instagram'] = array(
			'id' => 'header-social-instagram',
			'label'   => __( 'Instagram', 'cumulo' ),
			'section' => "section-header-infobar",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['header-social-youtube'] = array(
			'id' => 'header-social-youtube',
			'label'   => __( 'Youtube', 'cumulo' ),
			'section' => "section-header-infobar",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['header-social-vimeo-square'] = array(
			'id' => 'header-social-vimeo-square',
			'label'   => __( 'Vimeo', 'cumulo' ),
			'section' => "section-header-infobar",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['header-social-rss'] = array(
			'id' => 'header-social-rss',
			'label'   => __( 'RSS', 'cumulo' ),
			'section' => "section-header-infobar",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);

	$sections[] = array(
			'id' => "section-header-menu",
			'title' => __( 'Menu', 'cumulo' ),
			'priority' => '80',
			'panel' => "panel-header"
	);
	$options['header-show-menu'] = array(
			'id' => 'header-show-menu',
			'label'   => __( 'Show Menu', 'cumulo' ),
			'section' => "section-header-menu",
			'type'    => 'checkbox',
			'default' => $default_options['header-show-menu']
	);
	$options['header-menu-sticky'] = array(
			'id' => 'header-menu-sticky',
			'label'   => __( 'Enable Sticky Menu', 'cumulo' ),
			'section' => "section-header-menu",
			'type'    => 'checkbox',
			'default' => $default_options['header-menu-sticky']
	);
	$options['header-menu-show-cart'] = array(
			'id' => 'header-menu-show-cart',
			'label'   => __( 'Show WooCommerce Cart Icon on Header', 'cumulo' ),
			'section' => "section-header-menu",
			'type'    => 'checkbox',
			'default' => $default_options['header-menu-show-cart'],
			'description'	=> __("Cart icon may not be visible in header style 4", 'cumulo')
	);
	$options['header-menu-show-search'] = array(
			'id' => 'header-menu-show-search',
			'label'   => __( 'Show Search Icon', 'cumulo' ),
			'section' => "section-header-menu",
			'type'    => 'checkbox',
			'default' => $default_options['header-menu-show-search'],
			'description'	=> __("Search icon may not be visible in header style 4", 'cumulo')
	);

	$sections[] = array(
			'id' => "section-header-breadcrumb",
			'title' => __( 'Breadcrumb', 'cumulo' ),
			'priority' => '80',
			'panel' => "panel-header"
	);
	$options['header-breadcrumb-show'] = array(
			'id' => 'header-breadcrumb-show',
			'label'   => __( 'Show Breadcrumb', 'cumulo' ),
			'section' => "section-header-breadcrumb",
			'type'    => 'checkbox',
			'default' => $default_options['header-breadcrumb-show'],
			'description'	=>	__( 'Breadcrumb is not visible on homepage by default', 'cumulo')
	);

	$options['breadcrumb-background-image-enable'] = array(
			'id' 		=> 'breadcrumb-background-image-enable',
			'label'   	=> __( 'Breadcrumb Background Image', 'cumulo' ),
			'section' 	=> "section-header-breadcrumb",
			'type'    	=> 'checkbox',
			'default' 	=> $default_options['breadcrumb-background-image-enable'],
			'description'	=>	__( 'Check this to use background image for breadcrumb.', 'cumulo')
	);

	$options['header-breadcrumb-image'] = array(
			'id' => 'header-breadcrumb-image',
			'label'   => __( 'Select Breadcrumb Background Image', 'cumulo' ),
			'section' => "section-header-breadcrumb",
			'type'    => 'image',
			'default' => '',
			'description'	=>	__( 'Default Image will be used if not set.', 'cumulo'),
			'active_callback'	=> cmo_handle_customizer_dependancy( 'breadcrumb-background-image-enable', 1 )
	);

	$options['breadcrumb-background-repeat'] = array(
			'id' 				=> 'breadcrumb-background-repeat',
			'label'   			=> __( 'Breadcrumb Background Repeat', 'cumulo' ),
			'section' 			=> "section-header-breadcrumb",
			'type'    			=> 'radio',
			'choices' 			=> array (
					'cover'		=>  __( 'Cover', 'cumulo' ),
					'repeat' 	=>	__( 'Tile', 'cumulo' ),
					'repeat-x'	=>	__( 'Tile Horizontally', 'cumulo' ),
					'repeat-y'	=>	__( 'Tile Vertically', 'cumulo' ),
					'no-repeat'	=>	__( 'No Repeat', 'cumulo' )
			),
			'default' 			=> $default_options['breadcrumb-background-repeat'],
			'active_callback'	=> cmo_handle_customizer_dependancy( 'breadcrumb-background-image-enable', 1 )
	);

	$options['breadcrumb-background-overlay'] = array(
			'id' 		=> 'breadcrumb-background-overlay',
			'label'   	=> __( 'Enable Breadcrumb Background Overlay', 'cumulo' ),
			'section' 	=> "section-header-breadcrumb",
			'type'    	=> 'checkbox',
			'default' 	=> $default_options['breadcrumb-background-overlay'],
			'description'	=>	__( 'Check this to use background overlay for breadcrumb.', 'cumulo')
	);

	/* --- end of header options --- */
	
	/* --- footer options --- */
	$panels[] = array(
			'id' => "panel-footer",
			'title' => __( 'Footer', 'cumulo' ),
			'priority' => '81'
	);
	
	$sections[] = array(
			'id' => "section-footer-style",
			'title' => __( 'Style', 'cumulo' ),
			'priority' => '80',
			'panel' => "panel-footer"
	);
	$options['footer-style'] = array(
			'id' => 'footer-style',
			'label'   => __( 'Footer Style', 'cumulo' ),
			'section' => "section-footer-style",
			'type'    => 'select',
			'choices' => array(
					"style-1"		=>	"Style 1",
					"style-2"		=>	"Style 2",
					"style-3"		=>	"Style 3",
					"style-4"		=>	"Style 4",
			),
			'default' => $default_options['footer-style']
	);
	$options['footer-show-footer'] = array(
			'id' => 'footer-show-footer',
			'label'   => __( 'Show Footer', 'cumulo' ),
			'section' => "section-footer-style",
			'type'    => 'checkbox',
			'default' => $default_options['footer-show-footer']
	);
	$options['footer-show-copyright'] = array(
			'id' => 'footer-show-copyright',
			'label'   => __( 'Show Footer Copyright Bar', 'cumulo' ),
			'section' => "section-footer-style",
			'type'    => 'checkbox',
			'default' => $default_options['footer-show-footer']
	);
	
	$sections[] = array(
			'id' => "section-footer-logo",
			'title' => __( 'Logo', 'cumulo' ),
			'priority' => '80',
			'panel' => "panel-footer"
	);
	$options['footer-logo'] = array(
			'id' => 'footer-logo',
			'label'   => __( 'Footer Logo', 'cumulo' ),
			'section' => "section-footer-logo",
			'type'    => 'image',
			'default' => $default_options['footer-logo'],
			'description' => __( 'Footer Logo works with shortcode [cmo_footer_logo]. Default is same with Header Logo', 'cumulo' )
	);
	
	$sections[] = array(
			'id' => "section-footer-social",
			'title' => __( 'Social Links', 'cumulo' ),
			'priority' => '80',
			'panel' => "panel-footer",
			'description'	=>	__('Footer Social works with [cmo_footer_social] shortcode', 'cumulo')
	);
	$options['footer-social-twitter'] = array(
			'id' => 'footer-social-twitter',
			'label'   => __( 'Twitter', 'cumulo' ),
			'section' => "section-footer-social",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['footer-social-linkedin-square'] = array(
			'id' => 'footer-social-linkedin-square',
			'label'   => __( 'LinkedIn', 'cumulo' ),
			'section' => "section-footer-social",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['footer-social-facebook-square'] = array(
			'id' => 'footer-social-facebook-square',
			'label'   => __( 'Facebook', 'cumulo' ),
			'section' => "section-footer-social",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['footer-social-skype'] = array(
			'id' => 'footer-social-skype',
			'label'   => __( 'Skype', 'cumulo' ),
			'section' => "section-footer-social",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['footer-social-google-plus'] = array(
			'id' => 'footer-social-google-plus',
			'label'   => __( 'Google+', 'cumulo' ),
			'section' => "section-footer-social",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['footer-social-dribbble'] = array(
			'id' => 'footer-social-dribbble',
			'label'   => __( 'Dribbble', 'cumulo' ),
			'section' => "section-footer-social",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['footer-social-pinterest'] = array(
			'id' => 'footer-social-pinterest',
			'label'   => __( 'Pinterest', 'cumulo' ),
			'section' => "section-footer-social",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['footer-social-apple'] = array(
			'id' => 'footer-social-apple',
			'label'   => __( 'Apple', 'cumulo' ),
			'section' => "section-footer-social",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['footer-social-instagram'] = array(
			'id' => 'footer-social-instagram',
			'label'   => __( 'Instagram', 'cumulo' ),
			'section' => "section-footer-social",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['footer-social-youtube'] = array(
			'id' => 'footer-social-youtube',
			'label'   => __( 'Youtube', 'cumulo' ),
			'section' => "section-footer-social",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['footer-social-vimeo-square'] = array(
			'id' => 'footer-social-vimeo-square',
			'label'   => __( 'Vimeo', 'cumulo' ),
			'section' => "section-footer-social",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	$options['footer-social-rss'] = array(
			'id' => 'footer-social-rss',
			'label'   => __( 'RSS', 'cumulo' ),
			'section' => "section-footer-social",
			'type'    => 'text',
			'default' => '',
			'transport' => 'postMessage'
	);
	
	$sections[] = array(
			'id' => "section-footer-extra-info",
			'title' => __( 'Extra Information', 'cumulo' ),
			'priority' => '80',
			'panel' => "panel-footer",
			'description' => __('Phone Numbers, Email, Address will be used in footer style 3, 4 by default, For use in other places, use shortcode [cmo_contact_info type="phone|email|address" icon="Override Icon"]Override Information[/cmo_contact_info] in text widget', 'cumulo' )
	);
	$options['footer-copyright-text'] = array(
			'id' => 'footer-copyright-text',
			'label'   => __( 'Copyright', 'cumulo' ),
			'section' => "section-footer-extra-info",
			'type'    => 'text',
			'default' => $default_options['footer-copyright-text'],
			'transport' => 'postMessage'
	);
	$options['footer-extra-phone'] = array(
			'id' => 'footer-extra-phone',
			'label'   => __( 'Phone Numbers', 'cumulo' ),
			'section' => "section-footer-extra-info",
			'type'    => 'text',
			'default' => $default_options['footer-extra-phone'],
			'description' => __( 'For multiple numbers, separate with | sign', 'cumulo' )
	);
	$options['footer-extra-email'] = array(
			'id' => 'footer-extra-email',
			'label'   => __( 'Email Addresses', 'cumulo' ),
			'section' => "section-footer-extra-info",
			'type'    => 'text',
			'default' => $default_options['footer-extra-email'],
			'description' => __( 'For multiple email, separate with | sign', 'cumulo' )
	);
	$options['footer-extra-address'] = array(
			'id' => 'footer-extra-address',
			'label'   => __( 'Address', 'cumulo' ),
			'section' => "section-footer-extra-info",
			'type'    => 'text',
			'default' => $default_options['footer-extra-address'],
			'description' => __( 'For line break, use | sign', 'cumulo' )
	);
	
	$sections[] = array(
			'id' => "section-footer-widgets",
			'title' => __( 'Footer Widgets', 'cumulo' ),
			'priority' => '80',
			'panel' => "panel-footer"
	);
	$options['footer-widget-1'] = array(
			'id' => 'footer-widget-1',
			'label'   => __( 'Select Sidebar for Footer Column 1', 'cumulo' ),
			'section' => "section-footer-widgets",
			'type'    => 'select',
			'choices' => cmo_get_all_sidebars( __("None", 'cumulo') ),
			'default' =>  $default_options['footer-widget-1'],
			'description' => __( 'Following 4 options works with Footer Style 1 and 2', 'cumulo' )
	);
	$options['footer-widget-2'] = array(
			'id' => 'footer-widget-2',
			'label'   => __( 'Select Sidebar for Footer Column 2', 'cumulo' ),
			'section' => "section-footer-widgets",
			'type'    => 'select',
			'choices' => cmo_get_all_sidebars( __("None", 'cumulo') ),
			'default' =>  $default_options['footer-widget-2']
	);
	$options['footer-widget-3'] = array(
			'id' => 'footer-widget-3',
			'label'   => __( 'Select Sidebar for Footer Column 3', 'cumulo' ),
			'section' => "section-footer-widgets",
			'type'    => 'select',
			'choices' => cmo_get_all_sidebars( __("None", 'cumulo') ),
			'default' => $default_options['footer-widget-3']
	);
	$options['footer-widget-4'] = array(
			'id' => 'footer-widget-4',
			'label'   => __( 'Select Sidebar for Footer Column 4', 'cumulo' ),
			'section' => "section-footer-widgets",
			'type'    => 'select',
			'choices' => cmo_get_all_sidebars( __("None", 'cumulo') ),
			'default' =>  $default_options['footer-widget-4']
	);
	/* --- end of footer options --- */

	/* Color options */
	$section = 'colors';
	$sections[] = array(
			'id' => $section,
			'title' => __( 'Colors', 'cumulo' ),
			'priority' => '90',
			'description' => __( 'Change overall color settings here. These settings will be applied to all elements, but specific color settings such as shortcode color options will have higher priority.', 'cumulo' ),
	);

	$options['primary-color'] = array(
			'id' => 'primary-color',
			'label'   => __( 'Primary Color', 'cumulo' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $default_options['primary-color'],
	);

	$options['text-color'] = array(
			'id' => 'text-color',
			'label'   => __( 'Text Color', 'cumulo' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $default_options['text-color'],
	);
	$options['heading-color'] = array(
			'id' => 'heading-color',
			'label'   => __( 'Heading Color', 'cumulo' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $default_options['heading-color'],
	);
	$options['bg-color'] = array(
			'id' => 'bg-color',
			'label'   => __( 'Primary Background Color', 'cumulo' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $default_options['bg-color'],
	);
	$options['bg-color2'] = array(
			'id' => 'bg-color2',
			'label'   => __( 'Secondary Background Color', 'cumulo' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $default_options['bg-color2'],
	);
	$options['dark-bg-color'] = array(
			'id' => 'dark-bg-color',
			'label'   => __( 'Dark Background Color', 'cumulo' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $default_options['dark-bg-color'],
			'description' => __( 'Dark Background Color will be used as overlay or background color on hover', 'cumulo' )
	);
	$options['menu-color'] = array(
			'id' => 'menu-color',
			'label'   => __( 'Menu Item Color', 'cumulo' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $default_options['menu-color'],
	);
	$options['header-bg-color'] = array(
			'id' => 'header-bg-color',
			'label'   => __( 'Header Background Color', 'cumulo' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $default_options['header-bg-color'],
	);
	$options['breadcrumb-bg-color'] = array(
			'id' => 'breadcrumb-bg-color',
			'label'   => __( 'Breadcrumb Background Color', 'cumulo' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $default_options['breadcrumb-bg-color'],
	);

	$options['border-color'] = array(
			'id' => 'border-color',
			'label'   => __( 'Border Color', 'cumulo' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $default_options['border-color'],
	);
	
	$options['transparent-header-nav-alt-color'] = array(
			'id' => 'transparent-header-nav-alt-color',
			'label'   => __( 'Enable Alternative Main Navigation Color', 'cumulo' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => $default_options['transparent-header-nav-alt-color'],
			'description' => __( "Enable Alternative Color for Transparent Header", 'cumulo' ),
	);
	
	$options['transparent-header-main-nav-color'] = array(
			'id' => 'transparent-header-main-nav-color',
			'label'   => __( 'Color for Transparent Header', 'cumulo' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $default_options['transparent-header-main-nav-color'],
			'description' => __( 'Main Navigation Color on Transparent Header. It work with transparent header enabled', 'cumulo' ),
			'active_callback'	=>	cmo_handle_customizer_dependancy( 'transparent-header-nav-alt-color', '1' )
	);
	/* End of Color options */
	
	/* Typography */
	$section = 'typography';
	$font_choices = customizer_library_get_font_choices();
	$sections[] = array(
			'id' => $section,
			'title' => __( 'Typography', 'cumulo' ),
			'priority' => '90',
			'description' => __( 'Change global font options. If you select google fonts from the list, they will be automatically loaded from Google Fonts.' , 'cumulo' ),
	);
	$options['heading-font'] = array(
			'id' => 'heading-font',
			'label'   => __( 'Heading Font', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => $default_options['heading-font'],
	);
	$options['heading-font-weight'] = array(
			'id' => 'heading-font-weight',
			'label'   => __( 'Heading Font Weight', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => cmo_get_font_weights( true ),
			'default' => $default_options['heading-font-weight'],
	);

	$options['sub-heading-font'] = array(
			'id' => 'sub-heading-font',
			'label'   => __( 'Sub Heading Font', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => $default_options['heading-font'],
	);
	$options['sub-heading-font-weight'] = array(
			'id' => 'sub-heading-font-weight',
			'label'   => __( 'Sub Heading Font Weight', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => cmo_get_font_weights( true ),
			'default' => $default_options['heading-font-weight'],
	);


	$options['h1-font-size'] = array(
			'id' => 'h1-font-size',
			'label'   => __( 'H1 Tag Font Size', 'cumulo' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $default_options['h1-font-size'],
	);
	$options['h2-font-size'] = array(
			'id' => 'h2-font-size',
			'label'   => __( 'H2 Tag Font Size', 'cumulo' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $default_options['h2-font-size'],
	);
	$options['h3-font-size'] = array(
			'id' => 'h3-font-size',
			'label'   => __( 'H3 Tag Font Size', 'cumulo' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $default_options['h3-font-size'],
	);
	$options['h4-font-size'] = array(
			'id' => 'h4-font-size',
			'label'   => __( 'H4 Tag Font Size', 'cumulo' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $default_options['h4-font-size'],
	);
	$options['h5-font-size'] = array(
			'id' => 'h5-font-size',
			'label'   => __( 'H5 Tag Font Size', 'cumulo' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $default_options['h5-font-size'],
	);
	$options['h6-font-size'] = array(
			'id' => 'h6-font-size',
			'label'   => __( 'H6 Tag Font Size', 'cumulo' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $default_options['h6-font-size'],
	);
	$options['text-font'] = array(
			'id' => 'text-font',
			'label'   => __( 'Text Font', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => $default_options['text-font'],
	);
	$options['text-font-weight'] = array(
			'id' => 'text-font-weight',
			'label'   => __( 'Text Font Weight', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => cmo_get_font_weights(),
			'default' => $default_options['text-font-weight'],
	);
	$options['text-font-size'] = array(
			'id' => 'text-font-size',
			'label'   => __( 'Text Font Size', 'cumulo' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $default_options['text-font-size'],
	);

	$options['menu-font'] = array(
			'id' => 'menu-font',
			'label'   => __( 'Menu Font', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => $font_choices,
			'default' => $default_options['menu-font'],
	);
	$options['menu-font-weight'] = array(
			'id' => 'menu-font-weight',
			'label'   => __( 'Menu Font Weight', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => cmo_get_font_weights(),
			'default' => $default_options['menu-font-weight'],
	);

	/* background image */
	$section = 'content-layout';
	$sections[] = array(
			'id' => $section,
			'title' => __( 'Layout', 'cumulo' ),
			'priority' => '90',
	);
	
	$options['content-preloader'] = array(
			'id' 				=> 'content-preloader',
			'label'   			=> __( 'Preloader', 'cumulo' ),
			'section' 			=> $section,
			'type'    			=> 'select',
			'choices' 			=> array (
					'enable' 	=>	__( 'Enable', 'cumulo' ),
					'disable'	=>	__( 'Disable', 'cumulo' ),
			),
			'default' 			=> $default_options['content-preloader'],
	);

	$options['content-layout'] = array(
			'id' 				=> 'content-layout',
			'label'   			=> __( 'Content Layout', 'cumulo' ),
			'section' 			=> $section,
			'type'    			=> 'select',
			'choices' 			=> array (
					'wide' 	=>	__( 'Wide', 'cumulo' ),
					'boxed'	=>	__( 'Boxed', 'cumulo' ),
			),
			'default' 			=> $default_options['content-layout'],
	);

	$options['content-boxed-width'] = array(
			'id' => 'content-boxed-width',
			'label'   => __( 'Boxed Width', 'cumulo' ),
			'section' => $section,
			'type'    => 'slider',
			'input_attrs' => array(
					'min'   => 1200,
					'max'   => 1400,
					'step'  => 10
			),
			'default' => $default_options['content-boxed-width'],
			'active_callback'	=> cmo_handle_customizer_dependancy( 'content-layout', 'boxed' )
	);
	
	$options['content-boxed-margin-top-bottom'] = array(
			'id' => 'content-boxed-margin-top-bottom',
			'label'   => __( 'Margin Top Bottom', 'cumulo' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $default_options['content-boxed-margin-top-bottom'],
			'active_callback'	=> cmo_handle_customizer_dependancy( 'content-layout', 'boxed' )
	);

	$options['content-background-color'] = array(
			'id' => 'content-background-color',
			'label'   => __( 'Background Color in Boxed Layout', 'cumulo' ),
			'section' => $section,
			'type'    => 'color',
			'default' => $default_options['content-background-color'],
	    	'active_callback'	=> cmo_handle_customizer_dependancy( 'content-layout', 'boxed' )
	);

	$options['content-background-image'] = array(
			'id' 	=> 'content-background-image',
			'label'   => __( 'Background Image', 'cumulo' ),
			'section' => $section,
			'type'    => 'image',
			'default' => $default_options['content-background-image']
	);
	$options['content-background-repeat'] = array(
			'id' 				=> 'content-background-repeat',
			'label'   			=> __( 'Background Repeat', 'cumulo' ),
			'section' 			=> $section,
			'type'    			=> 'radio',
			'choices' 			=> array (
					'repeat' 	=>	__( 'Tile', 'cumulo' ),
					'repeat-x'	=>	__( 'Tile Horizontally', 'cumulo' ),
					'repeat-y'	=>	__( 'Tile Vertically', 'cumulo' ),
					'no-repeat'	=>	__( 'No Repeat', 'cumulo' )
			),
			'default' 			=> $default_options['content-background-repeat'],
			'active_callback'	=> cmo_handle_customizer_dependancy( 'content-background-image', '', '!=' )
	);
	$options['content-background-position'] = array(
			'id' 				=> 'content-background-position',
			'label'   			=> __( 'Background Position', 'cumulo' ),
			'section' 			=> $section,
			'type'    			=> 'radio',
			'choices'			=>	array(
					'left'		=>	__( 'Left', 'cumulo' ),
					'center'	=>	__( 'Center', 'cumulo' ),
					'right'		=>	__( 'Right', 'cumulo' )
			),
			'default' => $default_options['content-background-position'],
			'active_callback'	=> cmo_handle_customizer_dependancy( 'content-background-image', '', '!=' )
	);
	$options['content-background-attachment'] = array(
			'id' 				=> 'content-background-attachment',
			'label'   			=> __( 'Background Attachment', 'cumulo' ),
			'section' 			=> $section,
			'type'    			=> 'radio',
			'choices'			=>	array(
					'scroll'	=>	__( 'Scroll', 'cumulo' ),
					'fixed'		=>	__( 'Fixed', 'cumulo' )
			),
			'default' => $default_options['content-background-attachment'],
			'active_callback'	=> cmo_handle_customizer_dependancy( 'content-background-image', '', '!=' )
	);
	
	/* Side bar Options */
	$section = 'sidebar';
	$sections[] = array(
			'id' => $section,
			'title' => __( 'Sidebar', 'cumulo' ),
			'priority' => '90',
			'description' => __( "Select Default sidebar for blogs, portfolios and woocommerce. Sidebar for page needs be specifically set through page option. Sidebar for each posts and portfolios can be overriden through post/portfolio options.", 'cumulo' ),
	);
	$options['sidebar-width'] = array(
			'id' => 'sidebar-width',
			'label'   => __( 'Sidebar Width', 'cumulo' ),
			'section' => $section,
			'type'	  => "slider",
			'input_attrs' => array(
					'min'   => 25,
					'max'   => 50,
					'step'  => 1
			),
			'default' => $default_options['sidebar-width'],
			'description' => __( "In Percent ( Min: 25%, Max: 50% ). Default is 25%", 'cumulo' ),
	);
	$options['sidebar-sidebar'] = array(
			'id' => 'sidebar-sidebar',
			'label'   => __( 'Select Sidebar', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => cmo_get_all_sidebars( __('No Sidebar', 'cumulo') ),
			'default' => $default_options['sidebar-sidebar'],
	);
	$options['sidebar-position'] = array(
			'id' => 'sidebar-position',
			'label'   => __( 'Sidebar Position', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array(
					"left"		=>	__( "Left", 'cumulo' ),
					"right"		=>	__( "Right", 'cumulo' )
			),
			'default' => $default_options['sidebar-position'],
			'active_callback'	=>	cmo_handle_customizer_dependancy( 'sidebar-sidebar', '0', '!=')
	);

	$options['woocommerce-select-sidebar'] = array(
			'id' => 'woocommerce-select-sidebar',
			'label'   => __( 'Select Sidebar for Woocommerce', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => cmo_get_all_sidebars( __('No Sidebar', 'cumulo') ),
			'default' => $default_options['woocommerce-select-sidebar'],
	);
	$options['woocommerce-sidebar-position'] = array(
			'id' => 'woocommerce-sidebar-position',
			'label'   => __( 'Woocommerce Sidebar Position', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array( 
					'left'	=> __( 'Left', 'cumulo' ),
					'right'	=> __( 'Right', 'cumulo' )
			),
			'active_callback'	=>	cmo_handle_customizer_dependancy( 'woocommerce-select-sidebar', '0', '!=')
	);
	/* ------------- */
	
	/* --- Blog Style --- */
	$section = 'blog-list';
	$sections[] = array(
			'id' => $section,
			'title' => __( 'Blog', 'cumulo' ),
			'priority' => '90',
			'description' => __( "Change blog archive page options here. These options will be applied to only archive pages, not pages built with shortcodes.", 'cumulo' ),
	);
	$options['blog-list-style'] = array(
			'id' => 'blog-list-style',
			'label'   => __( 'Default Blog List Style', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array (
				"onecolumn"			=>	__( "One Column", 'cumulo' ),
				"masonry"			=>	__( "Masonry", 'cumulo' ),
				"modern"			=>	__( "Modern", 'cumulo' )
			),
			'default' => $default_options['blog-list-style']
	);
	$options['blog-list-masonry-columns'] = array(
			'id' => 'blog-list-masonry-columns',
			'label'   => __( 'Masonry Columns', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array (
				"2"			=>	__( "2 Columns", 'cumulo' ),
				"3"			=>	__( "3 Columns", 'cumulo' ),
				"4"			=>	__( "4 Columns", 'cumulo' )
			),
			'default' => $default_options['blog-list-masonry-columns'],
			'description' => __( 'This option will work only with masonry blog list style', 'cumulo'),
			'active_callback'	=>	cmo_handle_customizer_dependancy( 'blog-list-style', 'masonry' )
	);
	$options['blog-list-modern-full'] = array(
			'id' => 'blog-list-modern-full',
			'label'   => __( 'Full width for modern style', 'cumulo' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => $default_options['blog-list-modern-full'],
			'description' => __( 'This option will work only with modern blog list style', 'cumulo'),
			'active_callback'	=>	cmo_handle_customizer_dependancy( 'blog-list-style', 'modern' )
	);

	$options['blog-list-pagination'] = array(
			'id' => 'blog-list-pagination',
			'label'   => __( 'Default Blog List Pagination', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array(
					"classic"			=>	__( "Classic", 'cumulo' ),
					"load-more"			=>	__( "Load More Button", 'cumulo' ),
					"infinite-scroll"	=>	__( "Load On Scroll", 'cumulo' )
			),
			'default' => $default_options['blog-list-pagination']
	);
	/* --- Blog Style --- */
	
	/* --- Portfolio Options --- */
	$section = 'portfolio';
	$sections[] = array(
			'id' => $section,
			'title' => __( 'Portfolio', 'cumulo' ),
			'priority' => '90',
			'description' => __( "Change portfolio archive/category page options here. These options will be applied to only archive pages, not pages built with shortcodes.", 'cumulo' ),
	);

	$options['portfolio-list-style'] = array(
			'id' => 'portfolio-list-style',
			'label'   => __( 'Default Portfolio List Style', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array( 
					"grid"			=>	__( "Grid", 'cumulo' ),
					"masonry"		=>	__( "Masonry", 'cumulo' ),
					// "fitcolumns"	=>	__( "Masonry - Fit Columns", 'cumulo' ),
			),
			'default' => $default_options['portfolio-list-style'],
	);
	$options['portfolio-list-full'] = array(
			'id' => 'portfolio-list-full',
			'label'   => __( 'Full Width', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array(
					"yes"		=>	__( "Yes", 'cumulo' ),
					"no"		=>	__( "No", 'cumulo' )
			),
			'default' => $default_options['portfolio-list-full'],
			'description' => __( "Sidebar will not work on full page", 'cumulo' )
	);
	$options['portfolio-list-columns-grid'] = array(
			'id' => 'portfolio-list-columns-grid',
			'label'   => __( 'Columns (Grid Style)', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array( 
					'2' => '2',
					'3' => '3',
					'4' => '4'
			),
			'default' => $default_options['portfolio-list-columns-grid'],
			'active_callback'	=>	cmo_handle_customizer_dependancy( 'portfolio-list-style', 'grid' )
	);
	$options['portfolio-list-columns-masonry'] = array(
			'id' => 'portfolio-list-columns-masonry',
			'label'   => __( 'Columns (Masonry Style)', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
			),
			'default' => $default_options['portfolio-list-columns-masonry'],
			'active_callback'	=>	cmo_handle_customizer_dependancy( 'portfolio-list-style', 'masonry' )
	);
	$options['portfolio-list-margin'] = array(
			'id' => 'portfolio-list-margin',
			'label'   => __( 'Margin Between List Items', 'cumulo' ),
			'section' => $section,
			'type'    => 'text',
			'default' => $default_options['portfolio-list-margin'],
	);
	$options['portfolio-list-pagination'] = array(
			'id' => 'portfolio-list-pagination',
			'label'   => __( 'Default Portfolio List Pagination', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array(
					"classic"			=>	__( "Classic", 'cumulo' ),
					"load-more"			=>	__( "Load More Button", 'cumulo' ),
					"infinite-scroll"	=>	__( "Load On Scroll", 'cumulo' )
			),
			'default' => $default_options['portfolio-list-pagination']
	);
	
	$options['portfolio-single-style'] = array(
			'id' => 'portfolio-single-style',
			'label'   => __( 'Default Portfolio Single Item Style', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array(
					"style-1"		=>	__( "Style 1", 'cumulo' ),
					"style-2"		=>	__( "Style 2", 'cumulo' ),
					"style-3"		=>	__( "Style 3", 'cumulo' ),
					"style-4"		=>	__( "Style 4", 'cumulo' ),
			),
			'default' => $default_options['portfolio-single-style']
	);
	
	/* --- Portfolio Options --- */
	$section = 'woocommerce';
	$sections[] = array(
			'id' => $section,
			'title' => __( 'Woocommerce', 'cumulo' ),
			'priority' => '90',
			'description' => __( "Select Woocommerce Product List Style", 'cumulo' ),
	);
	
	$options['woo-list-style'] = array(
			'id' => 'woo-list-style',
			'label'   => __( 'Default Woocommerce Product List Style', 'cumulo' ),
			'section' => $section,
			'type'    => 'select',
			'choices' => array(
					"style-1"		=>	__( "Style - 1", 'cumulo' ),
					"style-2"		=>	__( "Style - 2", 'cumulo' ),
					"style-3"		=>	__( "Style - 3", 'cumulo' ),
			),
			'default' => $default_options['woo-list-style'],
	);
	
	/* --- End of Portfolio Options --- */

	/* Custom Code options */
	$section = 'custom-code';
	$sections[] = array(
			'id' => $section,
			'title' => __( 'Custom Code', 'cumulo' ),
			'priority' => '90',
			'description' => esc_html( __( "Enter your custom CSS and JS code here. You can use custom codes to quickly make small changes or put analytics js code. Do not place any <script> or <style> tags as they're already added.", 'cumulo' ) ),
	);
	$options['custom-css'] = array(
			'id' => 'custom-css',
			'label'   => __( 'Custom CSS', 'cumulo' ),
			'section' => $section,
			'type'    => 'textarea',
			'default' => $default_options['custom-css'],
	);
	$options['custom-js'] = array(
			'id' => 'custom-js',
			'label'   => __( 'Custom JS', 'cumulo' ),
			'section' => $section,
			'type'    => 'textarea',
			'default' => $default_options['custom-js'],
	);

	// Adds the sections to the $options array
	$options['sections'] = $sections;
	// Adds the panels to the $options array
	$options['panels'] = $panels;
	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );
}
add_action( 'init', 'customizer_library_options' );


function cmo_handle_customizer_dependancy( $dep_option, $dep_value, $operator = "==" ) {
	if ( in_array( $operator, array('==', '>', '>=', '<', '<=', '!=' ) ) ) {
		return create_function( '$control',
				'$option = $control->manager->get_setting("'.$dep_option.'"); return $option->value() '.$operator.' "'.$dep_value.'";' 
		);
	}
	else if ( $operator == 'in' && is_array( $dep_value ) ) {
		if ( count( $dep_value ) > 0 ) {
			return create_function( '$control',
					'$option = $control->manager->get_setting("'.$dep_option.'"); return in_array( $option->value(), array( "' . implode( "\",\"", $dep_value ) . '" ) )'
			);
		}
	}
	else {
		trigger_error( "Invalid Operator" );
	}
}