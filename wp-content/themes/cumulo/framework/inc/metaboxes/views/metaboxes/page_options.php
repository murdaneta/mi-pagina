<ul class="cmo_metabox_tabs">
	<li class="active"><a href="#header"><?php echo __( "Header", 'cumulo' ) ?></a></li>
	<li><a href="#sliders"><?php echo __( "Sliders", 'cumulo' ) ?></a></li>
	<li><a href="#layout"><?php echo __( "Layout", 'cumulo' ) ?></a></li>
	<li><a href="#contents"><?php echo __( "Content Area", 'cumulo' ) ?></a></li>
	<li><a href="#sidebars"><?php echo __( "Sidebars", 'cumulo' ) ?></a></li>
	<li><a href="#footer"><?php echo __( "Footer", 'cumulo' ) ?></a></li>
	<li><a href="#colors"><?php echo __( "Colors", 'cumulo' ) ?></a></li>
	<li><a href="#woo"><?php echo __( "Woocommerce", 'cumulo' ) ?></a></li>
</ul>
<div class="cmo_metabox">
	<div class="cmo_metabox_tab" id="cmo_tab_header">
		<?php
		$this->select ( 'header_menu', __ ( 'Select Menu', 'cumulo' ), array (
				'main-menu' 		=> __ ( 'Main Navigation Menu', 'cumulo' ),
				'secondary-menu' 	=> __ ( 'Secondary Menu', 'cumulo' ) 
		), __ ( 'Select Menu Location To Show on header.', 'cumulo' ) );

		$this->select ( 'header_show_header', __ ( 'Show header', 'cumulo' ), array (
				'default' 	=> __ ( 'Theme Setting', 'cumulo' ),
				'yes' 		=> __ ( 'Yes', 'cumulo' ),
				'no' 		=> __ ( 'No', 'cumulo' ) 
		), __ ( 'Choose to show or hide the header.', 'cumulo' ) );
		$this->select ( 'header_style', __ ( 'Header style', 'cumulo' ), array (
				"default"	=>	__( "Theme Setting", 'cumulo' ), 
				"style-1"	=>	__( "Style 1", 'cumulo' ), 
				"style-2"	=>	__( "Style 2 ( Image Background )", 'cumulo' ), 
				"style-3"	=>	__( "Style 3", 'cumulo' ), 
				"style-4"	=>	__( "Style 4", 'cumulo' ), 
				"style-5"	=>	__( "Style 5", 'cumulo' ), 
				"style-6"	=>	__( "Style 6", 'cumulo' ) 
		), __ ( 'Select header style.', 'cumulo' ) );
		$this->upload ( 'header_background_image', 
			__( 'Header background image', 'cumulo' ), 
			__( 'Select an image for the header background. This will work only with header style-2', 'cumulo' ) 
		);

		$this->select ( 'header_background_repeat', __ ( 'Header background repeat', 'cumulo' ), array (
				'default'	=>	__( 'Theme Setting', 'cumulo' ),
				'cover' 	=>	__( 'Cover', 'cumulo' ),
				'repeat' 	=>	__( 'Tile', 'cumulo' ),
				'repeat-x'	=>	__( 'Tile Horizontally', 'cumulo' ),
				'repeat-y'	=>	__( 'Tile Vertically', 'cumulo' ),
				'no-repeat'	=>	__( 'No Repeat', 'cumulo' )
		), __( 'Select header background repeat. This will work only with header style-2', 'cumulo' ) );

		$this->select ( 'header_transparent_header', __ ( 'Enable transparent header', 'cumulo' ), array (
				'default' 	=> __ ( 'Theme Setting', 'cumulo' ),
				'yes' 		=> __ ( 'Yes', 'cumulo' ),
				'no' 		=> __ ( 'No', 'cumulo' ) 
		), __ ( 'Choose to show or hide the header.', 'cumulo' ) );
		$this->select ( 'header_infobar_visible', __ ( 'Show information bar', 'cumulo' ), array (
				'default' 	=> __ ( 'Theme Setting', 'cumulo' ),
				'yes' 		=> __ ( 'Yes', 'cumulo' ),
				'no' 		=> __ ( 'No', 'cumulo' ) 
		), __ ( 'Choose to show or hide information bar.', 'cumulo' ) );
		$this->select ( 'header_show_menu', __ ( 'Show menu', 'cumulo' ), array (
				'default' 	=> __ ( 'Theme Setting', 'cumulo' ),
				'yes' 		=> __ ( 'Yes', 'cumulo' ),
				'no' 		=> __ ( 'No', 'cumulo' ) 
		), __ ( 'Choose to show or hide menu.', 'cumulo' ) );
		$this->select ( 'header_menu_sticky', __ ( 'Enable sticky menu', 'cumulo' ), array (
				'default' 	=> __ ( 'Theme Setting', 'cumulo' ),
				'yes' 		=> __ ( 'Yes', 'cumulo' ),
				'no' 		=> __ ( 'No', 'cumulo' ) 
		), __ ( 'Choose to enable or disable sticky menu.', 'cumulo' ) );
		$this->select ( 'header_menu_show_cart', __ ( 'Show woocommerce cart icon', 'cumulo' ), array (
				'default' 	=> __ ( 'Theme Setting', 'cumulo' ),
				'yes' 		=> __ ( 'Yes', 'cumulo' ),
				'no' 		=> __ ( 'No', 'cumulo' ) 
		), __ ( 'Choose to show or hide woocommerce cart icon ( only works when woocommerce is installed ).', 'cumulo' ) );
		$this->select ( 'header_menu_show_search', __ ( 'Show search icon', 'cumulo' ), array (
				'default' 	=> __ ( 'Theme Setting', 'cumulo' ),
				'yes' 		=> __ ( 'Yes', 'cumulo' ),
				'no' 		=> __ ( 'No', 'cumulo' ) 
		), __ ( 'Choose to show or hide woocommerce cart icon ( only works when woocommerce is installed ).', 'cumulo' ) );
		$this->select ( 'header_breadcrumb_show', __ ( 'Show breadcrumb', 'cumulo' ), array (
				'default' 	=> __ ( 'Theme Setting', 'cumulo' ),
				'yes' 		=> __ ( 'Yes', 'cumulo' ),
				'no' 		=> __ ( 'No', 'cumulo' ) 
		), __ ( 'Choose to show or hide breadcrumb.', 'cumulo' ) );

		$this->select ( 'breadcrumb_background_image_enable', __ ( 'Enable breadcrumb image', 'cumulo' ), array (
				'default' 	=> __ ( 'Theme Setting', 'cumulo' ),
				'yes' 		=> __ ( 'Yes', 'cumulo' ),
				'no' 		=> __ ( 'No', 'cumulo' ) 
		), __ ( 'Choose to enable or disable breadcrumb image.', 'cumulo' ) );
		$this->upload ( 'header_breadcrumb_image', 
			__( 'Breadcrumb background image', 'cumulo' ), 
			__( 'Select an image for the breadcrumb background.', 'cumulo' ) 
		);
		$this->select ( 'breadcrumb_background_repeat', __ ( 'Breadcrumb background repeat', 'cumulo' ), array (
				'default'	=>	__( 'Theme Setting', 'cumulo' ),
				'cover' 	=>	__( 'Cover', 'cumulo' ),
				'repeat' 	=>	__( 'Tile', 'cumulo' ),
				'repeat-x'	=>	__( 'Tile Horizontally', 'cumulo' ),
				'repeat-y'	=>	__( 'Tile Vertically', 'cumulo' ),
				'no-repeat'	=>	__( 'No Repeat', 'cumulo' )
		), __( 'Select breadcrumb background repeat', 'cumulo' ) );
		$this->select ( 'breadcrumb_background_overlay', __ ( 'Enable breadcrumb background overlay', 'cumulo' ), array (
				'default' 	=> __ ( 'Theme Setting', 'cumulo' ),
				'yes' 		=> __ ( 'Yes', 'cumulo' ),
				'no' 		=> __ ( 'No', 'cumulo' ) 
		), __ ( 'Choose to use background overlay for breadcrumb.', 'cumulo' ) );
		?>
	</div>
	<div class="cmo_metabox_tab active" id="cmo_tab_sliders">
		<?php
		$this->select ( 'slider_type', __ ( 'Slider Type', 'cumulo' ), array (
				'no' => __ ( 'No Slider', 'cumulo' ),
				'layer' => __ ( 'LayerSlider', 'cumulo' ),
				'rev' => __ ( 'Revolution Slider', 'cumulo' ),
				'custom' => __( 'Custom Slider', 'cumulo' ), 
		), __ ( 'Select the type of slider that displays.', 'cumulo' ) );
		?>
		<?php
		global $wpdb;
		$slides_array [0] = __ ( 'Select a slider', 'cumulo' );
		if( function_exists( 'layerslider_loaded' ) ) {
			$table_name = $wpdb->prefix . "layerslider";
			$sliders = $wpdb->get_results ( $wpdb->prepare( "SELECT * FROM $table_name
												WHERE flag_hidden = '%d' AND flag_deleted = '%d'
												ORDER BY date_c ASC", 0, 0 ) );
			if (! empty ( $sliders )) :
				foreach ( $sliders as $key => $item ) :
					$slides [$item->id] = '';
				endforeach;
			endif;
		}
		if( isset( $slides ) && $slides ) {
			foreach ( $slides as $key => $val ) {
				$slides_array [$key] = __( 'LayerSlider #', 'cumulo' ) . ($key);
			}
		}
		$this->select ( 'layerslider', __ ( 'Select LayerSlider', 'cumulo' ), $slides_array, __ ( 'Select the unique name of the slider.', 'cumulo' ) );
		?>
		<?php
		global $wpdb;
		$revsliders [0] = __ ( 'Select a slider', 'cumulo' );
		if (function_exists ( 'rev_slider_shortcode' )) {
			$get_sliders = $wpdb->get_results ( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . 'revslider_sliders where 1=%d', 1 ) );
			if ($get_sliders) {
				foreach ( $get_sliders as $slider ) {
					$revsliders [$slider->alias] = $slider->title;
				}
			}
		}
		$this->select ( 'revslider', __ ( 'Select Revolution Slider', 'cumulo' ), $revsliders, __ ( 'Select the unique name of the slider.', 'cumulo' ) );
		?>
		<?php
		$this->text ( 'custom_slider',  __ ( 'Custom Slider Shortcode', 'cumulo' ),  __ ( 'Enter custom slider shortcode here.', 'cumulo' ) );
		?>
	</div>
	<div class="cmo_metabox_tab" id="cmo_tab_layout">
		<?php
		$this->select ( 'content_layout', __( 'Content Layout', 'cumulo' ), array (
				'default' 	=> __ ( 'Theme Setting', 'cumulo' ),
				'wide' 	=>	__( 'Wide', 'cumulo' ),
				'boxed'	=>	__( 'Boxed', 'cumulo' ),
		));

		$this->text ( 'content_boxed_width',
				__ ( 'Boxed Width', 'cumulo' ),
				__ ( 'Leave it empty for default. Value between 1200 ~ 1400.', 'cumulo' ) );
		
		$this->text ( 'content_boxed_margin_top_bottom',
				__ ( 'Margin Top Bottom', 'cumulo' ),
				__ ( 'Leave it empty for default 50px.', 'cumulo' ) );
		
		$this->color (
				'content_background_color',
				__( 'Primary color', 'cumulo' )
		);

		$this->upload ( 'content_background_image', 
			__( 'Background Image', 'cumulo' )			 
		);

		$this->select ( 'content_background_repeat', __( 'Background Repeat', 'cumulo' ), array (
				'default'	=>	__( 'Theme Setting', 'cumulo' ),
				'repeat' 	=>	__( 'Tile', 'cumulo' ),
				'repeat-x'	=>	__( 'Tile Horizontally', 'cumulo' ),
				'repeat-y'	=>	__( 'Tile Vertically', 'cumulo' ),
				'no-repeat'	=>	__( 'No Repeat', 'cumulo' )
		));
		$this->select ( 'content_background_position', __( 'Background Position', 'cumulo' ), array (
				'default'	=>	__( 'Theme Setting', 'cumulo' ),
				'left' 		=>	__( 'Left', 'cumulo' ),
				'center'	=>	__( 'Center', 'cumulo' ),
				'right'		=>	__( 'Right', 'cumulo' ),
		));
		$this->select ( 'content_background_attachment', __( 'Background Attachment', 'cumulo' ), array (
				'default'	=>	__( 'Theme Setting', 'cumulo' ),
				'scroll' 	=>	__( 'Scroll', 'cumulo' ),
				'fixed'		=>	__( 'Fixed', 'cumulo' ),
		));

		?>
	</div>
	<div class="cmo_metabox_tab" id="cmo_tab_contents">
		<?php 
		$this->select ( 'show_comments', __ ( 'Show Comments', 'cumulo' ), array (
				'yes' => __ ( 'Yes', 'cumulo' ),
				'no' => __ ( 'No', 'cumulo' )
		), __ ( 'Choose to show or hide comments.', 'cumulo' ) );

		$this->text ( 'padding_top',  
			__ ( 'Padding Top', 'cumulo' ),  
			__ ( 'Leave it empty for default 50px.', 'cumulo' ) );

		$this->text ( 'padding_bottom',  
			__ ( 'Padding Bottom', 'cumulo' ),  
			__ ( 'Leave it empty for default 50px.', 'cumulo' ) );
		?>
	</div>
	<div class="cmo_metabox_tab" id="cmo_tab_sidebars">
		<?php
		$this->text ( 'sidebar_width',
				__ ( 'Sidebar width in percent', 'cumulo' ),
				__ ( 'Min: 25, Max: 50. Numbers out of the range will be ignored', 'cumulo' ) );
		?>
		<?php
		sidebar_generator::edit_form ();
		?>
		<?php
		$this->select ( 'sidebar_position', __ ( 'Sidebar Position', 'cumulo' ), 
			array (
				'default' => __ ( 'Theme Setting', 'cumulo' ),
				'right' => __ ( 'Right', 'cumulo' ),
				'left' => __ ( 'Left', 'cumulo' ),
		), __ ( 'Select the sidebar position.', 'cumulo' ) );
		?>
	</div>
	<div class="cmo_metabox_tab" id="cmo_tab_footer">
		<?php
		$this->select ( 'footer_style', __ ( 'Footer style', 'cumulo' ), array (
				"default"	=>	__( "Theme Setting", 'cumulo' ),
				"style-1"	=>	__( "Style 1", 'cumulo' ), 
				"style-2"	=>	__( "Style 2", 'cumulo' ), 
				"style-3"	=>	__( "Style 3", 'cumulo' ), 
				"style-4"	=>	__( "Style 4", 'cumulo' ), 
		), __ ( 'Select footer style.', 'cumulo' ) );
		$this->select ( 'footer_show_footer', __( 'Show footer', 'cumulo' ), array (
				'default' => __( 'Theme Setting', 'cumulo' ),
				'yes' => __( 'Yes', 'cumulo' ),
				'no' => __( 'No', 'cumulo' ),
		), __( 'Choose to show or hide the footer.','cumulo' ) );
		$this->select ( 'footer_show_copyright', __( 'Show footer copyright bar', 'cumulo' ), array (
				'default' => __( 'Theme Setting', 'cumulo' ),
				'yes' => __( 'Yes', 'cumulo' ),
				'no' => __( 'No', 'cumulo' ),
		), __( 'Choose to show or hide the footer copyright bar.','cumulo' ) );
		$this->select ( 'footer_widget_1', __( 'Select Sidebar for footer column 1', 'cumulo' ), 
			cmo_get_all_sidebars( __('Theme Setting', 'cumulo'), __('No Sidebar', 'cumulo') ),
			__( 'Select sidebar for footer column 1. This option works with footer style 1 and 2.','cumulo' ) );
		$this->select ( 'footer_widget_2', __( 'Select Sidebar for footer column 2', 'cumulo' ), 
			cmo_get_all_sidebars( __('Theme Setting', 'cumulo'), __('No Sidebar', 'cumulo') ),
			__( 'Select sidebar for footer column 2. This option works with footer style 1 and 2.','cumulo' ) );
		$this->select ( 'footer_widget_3', __( 'Select Sidebar for footer column 3', 'cumulo' ), 
			cmo_get_all_sidebars( __('Theme Setting', 'cumulo'), __('No Sidebar', 'cumulo') ),
			__( 'Select sidebar for footer column 3. This option works with footer style 1 and 2.','cumulo' ) );
		$this->select ( 'footer_widget_4', __( 'Select Sidebar for footer column 4', 'cumulo' ), 
			cmo_get_all_sidebars( __('Theme Setting', 'cumulo'), __('No Sidebar', 'cumulo') ),
			__( 'Select sidebar for footer column 4. This option works with footer style 1 and 2.','cumulo' ) );
		?>
	</div>
	<div class="cmo_metabox_tab" id="cmo_tab_colors">
		<?php
		$this->color ( 
			'primary_color', 
			__( 'Primary color', 'cumulo' )
		);
		$this->color ( 
			'text_color', 
			__( 'Text color', 'cumulo' )
		);
		$this->color ( 
			'heading_color', 
			__( 'Heading color', 'cumulo' )
		);
		$this->color ( 
			'bg_color', 
			__( 'Primary background color', 'cumulo' )
		);
		$this->color ( 
			'bg_color2', 
			__( 'Secondary background color', 'cumulo' )
		);
		$this->color ( 
			'dark_bg_color', 
			__( 'Dark background color', 'cumulo' )
		);
		$this->color ( 
			'menu_color', 
			__( 'Menu item color', 'cumulo' )
		);

		$this->color ( 
			'header_bg_color', 
			__( 'Header background color', 'cumulo' )
		);
		$this->color ( 
			'breadcrumb_bg_color', 
			__( 'Breadcrumb background color', 'cumulo' )
		);

		$this->color ( 
			'border_color', 
			__( 'Border color', 'cumulo' )
		);
		$this->select ( 'transparent_header_nav_alt_color', __( 'Enable Alternative Main Navigation Color', 'cumulo' ), array (
				'default' => __( 'Theme Setting', 'cumulo' ),
				'no' => __( 'No', 'cumulo' ),
				'yes' => __( 'Yes', 'cumulo' )
		), __( 'Enable Alternative Color for Transparent Header.','cumulo' ) );
		$this->color (
				'transparent_header_main_nav_color',
				__( 'Alternative Main Navigation Color for Transparent Header', 'cumulo' )
		);
		?>
	</div>
	<div class="cmo_metabox_tab" id="cmo_tab_woo">
		<?php
		$this->select ( 'woo_list_style', __( 'Woocommerce Product List Style', 'cumulo' ), array (
				'default' => __( 'Theme Setting', 'cumulo' ),
				'style-1' => __( 'Style - 1', 'cumulo' ),
				'style-2' => __( 'Style - 2', 'cumulo' ),
				'style-3' => __( 'Style - 3', 'cumulo' ),
		), __( 'Select Woocommerce Product List Style.','cumulo' ) );
		?>
	</div>
</div>
<div class="clear"></div>