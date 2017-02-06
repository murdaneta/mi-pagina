<?php
	require_once ( 'framework/index.php' );

	/* --- All Reusable Functions in ./framework/functions.php --- */

	/* --- Theme-Specific Functions --- */

	/**
	 * returns actual page option.
	 * 
	 *  First it finds value for page option and 
	 *  if page option value is theme default then 
	 *  it fetches value from theme option
	 *  
	 * @param string $page_option_name
	 * @param string $theme_option_name
	 * @param string $page_option_default
	 * @return string|NULL
	 */
	function cmo_get_page_theme_option ( $page_option_name, $theme_option_name = null, $page_option_default='default' ) {
		if ( ! is_singular() ) {
			if ( is_null( $theme_option_name ) ) return null;
			return cmo_get_theme_mod_value( $theme_option_name );
		}

		global $CUMULO_PAGE_OPTIONS;
		$pov = null;

		if ( isset ( $CUMULO_PAGE_OPTIONS[ "cmo_" . $page_option_name ] ) )
			$pov = $CUMULO_PAGE_OPTIONS[ "cmo_" . $page_option_name ][0];

		if ( is_null( $theme_option_name ) ) return $pov; // just return page option

		if ( is_null( $pov ) || $pov == $page_option_default ) {
			$pov = cmo_get_theme_mod_value( $theme_option_name );
		}
		return $pov;
	}


	/**
	* returns shortcode attribute or page option value or theme value or default :)
	*
	* @param string $atts : shortcode attributes
	* @param string $sc_attr : shortcode attribute name
	* @param string $page_option_name : theme option name
	* @param string $theme_option_name : theme option name
	* @param string $default : default value
	* return string | int
	*/
	function cmo_get_sc_attr_theme_option( $atts, $sc_attr, $page_option_name, $theme_option_name, $default = 'default' ) {
		if ( $atts[ $sc_attr ] == $default ) {
			return cmo_get_page_theme_option( $page_option_name, $theme_option_name, $default );
		}
		else {
			return $atts[ $sc_attr ];
		}
	}
	
	
	/**
	 * get Sidebar for current page
	 * 
	 * checks for the page option, if not found, returns theme option
	 * 
	 * @return array ( sidebar id, class, sidebar position )
	 */
	function cmo_get_page_sidebar( $theme_sidebar = "sidebar-sidebar", $theme_sidebar_pos = "sidebar-position" ) {
		global $CUMULO_PAGE_OPTIONS;
		$selectedSidebar = null;

		if ( isset ( $CUMULO_PAGE_OPTIONS['sbg_selected_sidebar_replacement'] ) ) {
			$selectedSidebar = unserialize( $CUMULO_PAGE_OPTIONS['sbg_selected_sidebar_replacement'][0] );

			if ( !empty( $selectedSidebar ) && is_array( $selectedSidebar ) )
				$selectedSidebar = $selectedSidebar[0];
		}

		if ( empty( $selectedSidebar ) || $selectedSidebar == "default" ) {
			if ( is_single() || is_archive() || is_home() ) {
				$selectedSidebar = cmo_get_theme_mod_value( $theme_sidebar );
			}
		}

		if ( isset ( $CUMULO_PAGE_OPTIONS['cmo_sidebar_position'] ) ) {
			$sidebarPosition = $CUMULO_PAGE_OPTIONS['cmo_sidebar_position'][0];
		}

		if ( empty( $sidebarPosition ) || $sidebarPosition == "default" ) {
			$sidebarPosition = cmo_get_theme_mod_value( $theme_sidebar_pos );
		}

		if ( $selectedSidebar == "-1" ) $selectedSidebar = "";

		
		$classes = array ();
		if ( !empty($selectedSidebar) ) {
			array_push( $classes, 'with-sidebar' );

			if ( $sidebarPosition == 'left' ) {
				array_push( $classes, 'left-sidebar' );
			}
			else {
				array_push( $classes, 'right-sidebar' );
			}
		}

		return array( $selectedSidebar, implode(' ', $classes), $sidebarPosition );
	}
	
	/**
	 * Get source url from youtube/vimeo/soundcloud embeded iframe string
	 * 
	 * @param unknown $string
	 * @return string | null
	 */
	function cmo_get_src_from_embed( $embed ) {
		if ( empty( $embed ) ) return "";

		preg_match_all("/^<iframe (.* )?src=\"([^\s\"]*)\"/", trim($embed), $arr);
		if ( isset($arr[2] ) ) {
			$embed = str_replace('&', '&amp;', $arr[2][0]);
		}
		else
			return "";
	
		return $embed;
	}
	
	/**
	 * customize the_tags ()
	 */
	function cmo_the_tags() {
		$tags = get_the_tags();
		$output = array();
		
		if ( $tags && count($tags) > 0 ) {
			foreach ( $tags as $tag ) {
				array_push( $output, "<a href=\"" . get_tag_link( $tag ) . "\">" . $tag->name . "</a>" );
			}
		}
		else {
			array_push( $output, "<em>None</em>" );
		}
		
		echo implode ( ', ', $output );
	}
	
	/**
	 * allow some specific html tags from string
	 * 
	 * @param string $string
	 * @return string
	 */
	function cmo_do_kses( $string ) {
		return wp_kses( $string, array(
				'a'				=>	array(
						'href'	=> array(),
						'title' => array()
				),
				'br'			=>	array(),
				'em'			=>	array(),
				'b'				=>	array(),
				'p' 			=>	array(),
				'strong'		=>	array(),
				'cite'			=>	array(),
				'blockquote'	=>	array()
		) );
	}
	
	/**
	 * Fetch first anchor tag from the content of the post and returns first anchor & href value
	 * 
	 * @param string $html
	 * @return array ( first anchor html and href value ) or false
	 */
	function cmo_extract_first_anchor( $html ) {
		$matches = array();
		preg_match("/<a.*href=\"([^\"]+)\".*>([^<]*)<\/a>/iU", $html, $matches);
		if ( sizeof( $matches ) >= 2 ) 
			return array( $matches[0], $matches[1] );
		else {
			$matches = array();
			preg_match("/<a.*href='([^']+)'.*>([^<]*)<\/a>/iU", $html, $matches);

			if ( sizeof( $matches ) >= 2 ) {
				return array( $matches[0], $matches[1] );
			}
		}

		return false;
	}
	
	/**
	 * fetches first blockquote block
	 * 
	 * @param string $html
	 * @return first blockquote html or false
	 */
	function cmo_extract_first_blockquote( $html ) {
		// remove line break;
		$matches = array();
		$html = preg_replace("/\r?\n|\r/", "", $html);
		preg_match("/<blockquote\s*[^>]*>(.*)<\/blockquote>/", $html, $matches);

		if ( sizeof ( $matches ) > 0 ) {
			return $matches[0];
		}
		else return false;
	}

	function cmo_is_yes_or_one( $val ) {
		if ( $val === 'yes' || $val === 1 || $val === '1' )
			return true;
		else
			return false;
	}

	function cmo_get_custom_title ( ) {
		if ( is_404() ) {
			esc_html_e("404", 'cumulo'); 
		}
		else if ( is_search() ) {
			echo __("Search", 'cumulo') . ": " . get_search_query();
		}
		else if ( is_attachment() ) {
			esc_html_e("Attachment", 'cumulo'); 
		}
		else if ( is_author() ) {
			echo __("Author", 'cumulo') . ": " . get_query_var( 'author_name' );
		}
		else if ( is_tax( 'portfolio_category') ) {
			single_cat_title("Portfolio Category: ", true);
		}
		else if ( is_tax( 'portfolio_tags') ) {
			single_cat_title("Portfolio Tag: ", true);
		}
		else if ( is_post_type_archive( 'cmo_portfolio' ) ) {
			esc_html_e("Portfolio", 'cumulo'); 	
		}
		else if ( is_category() ) {
			single_cat_title("Category: ", true);
		}
		else if ( is_tag() ) {
			single_cat_title("Tag: ", true);
		}
		else if ( is_year() || is_month() || is_day() ) {
			echo __("Archive", 'cumulo') . ": ";
			the_archive_title();
		}
		else if ( is_date() ) {
			echo __("Date", 'cumulo');
		}
		else if ( is_archive( ) ) {
			if ( class_exists( "WOOCOMMERCE" ) && is_shop() ) {
				echo __("Shop", 'cumulo');
			}
			else if ( function_exists( "is_epl_post_archive" ) && is_epl_post_archive() ) {
				/* copied from easy-property-listing archive page */
				if ( is_tax() && function_exists( 'epl_is_search' ) && false == epl_is_search() ) { // Tag Archive
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					$title = sprintf( __( 'Property in %s', 'epl' ), $term->name );
				}
				else if ( function_exists( 'epl_is_search' ) && epl_is_search() ) { // Search Result
					$title = __( 'Search Result', 'epl' );
				}
				
				else if ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() && function_exists( 'post_type_archive_title' ) ) { // Post Type Archive
					$title = post_type_archive_title( '', false );
				}
				
				else { // Default catchall just in case
					$title = __( 'Listing', 'epl' );
				}
				
				if ( is_paged() )
					printf( '%s &ndash; Page %d', $title, get_query_var( 'paged' ) );
				else
					echo $title;
				
			}
			else {
				the_archive_title();
			}
		}
		else 
			echo the_title(); 
	}

	function cmo_get_similar_portfolios( $count ) {
		$pcs = get_the_terms( get_the_ID(), 'portfolio_category');
		$pts = get_the_terms( get_the_ID(), 'portfolio_tags');

		$pcsa = array();
		$ptsa = array();

		if ( $pcs ) {
			foreach($pcs as $_pc) {
				$pcsa[] = $_pc->term_id;
			}
			// $pcsa = array_map( function($obj) { return $obj->term_id; }, $pcs );
		}
		if ( $pts ) {
			foreach($pts as $_pt) {
				$ptsa[] = $_pt->term_id;
			}
			// $ptsa = array_map( function($obj) { return $obj->term_id; }, $pts );
		}

		$tax_query_array = array( 'relation' => 'OR' );

		if ( count($pcsa) > 0 ) {
			array_push( $tax_query_array, array(
						'taxonomy' => 'portfolio_category',
						'field'    => 'term_id',
						'terms'    => $pcsa,
			) );
		}
		if ( count($ptsa) > 0 ) {
			array_push( $tax_query_array, array(
						'taxonomy' => 'portfolio_tags',
						'field'    => 'term_id',
						'terms'    => $ptsa,
			) );
		}

		global $post;

		$query_vars = array();
		$query_vars['post_status'] = array('publish', 'private');
		$query_vars['posts_per_page'] = $count;
		$query_vars['post_type'] = array( 'cmo_portfolio' );

		if ( count( $tax_query_array ) > 1 ) 
			$query_vars['tax_query'] = $tax_query_array;

		$query_vars['post__not_in'] = array( get_the_ID() );
		$query_vars['orderby'] = "rand";

		$posts = new WP_Query ( $query_vars );

		return $posts;
	}
	/* --- End of Theme-Specific Functions --- */

	/* --- Filters --- */

	/* this filter will render shortcodes from text widget */
	add_filter( 'wp_title', 'cmo_wp_title_filter', 11 );
	add_filter( 'widget_text', 'do_shortcode' );
	
	/* customize excerpt more as button */
	
	add_filter( 'excerpt_more', 'cmo_excerpt_more' );
	add_filter( 'the_excerpt', 'cmo_excerptFilter' );
	add_filter( 'wp_list_categories', 'cmo_customize_default_wp_categories_widget' );
	add_filter( 'get_archives_link', 'cmo_customize_default_wp_archive_widget' );

	add_filter( 'kses_allowed_protocols', 'cmo_add_skype_protocal', 20 );

	function cmo_excerpt_more ( $output ) {
		$readmore = __( 'Read More', 'cumulo' );
		return '<div class="excerpt-more-wrapper"><a class="cmo-button" href="' . get_permalink( get_the_ID() ) . '">' . $readmore . '</a></div>';		
	}

	function cmo_wp_title_filter ( $title ) {
		if ( is_404() ) {
			return esc_html__("404 - Page Not Found", 'cumulo');
		}
		return $title;
	}

	function cmo_add_search_box_to_mobile_nav($items) {
		$str = "<li id=\"mobile-nav-search-container\" class=\"menu-item\"><form role=\"search\" class=\"searchform\" method=\"get\" action=\"" . esc_url( get_site_url() ) . "\">" .
		        "<input type=\"text\" placeholder=\"Type here and hit enter...\" name=\"s\" autocomplete=\"off\" spellcheck=\"false\" />" .
		        "<input type=\"submit\" class=\"hidden\" /></form></li>";
		$items .= $str;
		return $items;
	}

	function cmo_excerptFilter( $output ) {
		global $post;
		if ( empty( $output ) && ! empty( $post->post_content ) ) {
			
			$strippedPostContent = $post->post_content;
 
			remove_shortcode( "cmo_bloglist" );
			remove_shortcode( "cmo_posts_carousel" );
			remove_shortcode( "cmo_portfolio" );

			ob_start();
			$str = do_shortcode( $strippedPostContent );
			$ds = ob_get_clean();

			/* remove inner style tag and its content*/
			$text = preg_replace( "/<style.*<\/style>/", "", $str );

			$text = strip_tags( $text );
			$excerpt_length = apply_filters( 'excerpt_length', 55 );
			$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[...]' );
			$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );

			return $text;
		}

		if ( has_excerpt() ) {
			$output .= apply_filters( "excerpt_more", $output );
		}

		return $output;
	}
	
	function cmo_customize_default_wp_categories_widget( $html ) {
		$html = preg_replace('/<\/a>\s+\((\d+)\)/', '<span class="count">${1}</span></a>', $html);
		$html = preg_replace('/<span class="count">\((\d+)\)<\/span>/', '<span class="count">${1}</span>', $html);
		return $html;
	}

	function cmo_customize_default_wp_archive_widget( $html ) {
		$html = preg_replace('/<\/a>\s*&nbsp;\s*\((\d+)\)/', '<span class="count">${1}</span></a>', $html);
		return $html;
	}
	
	function cmo_add_skype_protocal( $protocols ) {
	    $protocols[] = 'skype';
	    return $protocols;
	}
	/* --- End of Filters --- */

	/* --- Actions --- */
	add_action( 'after_setup_theme', 'cumulo_language_setup' );
	add_action( 'after_setup_theme', 'cmo_add_theme_supports' );
	add_action( 'widgets_init', 'cmo_register_sidebars' );

	add_action( 'wp_ajax_cmo_load_posts', 'cmo_load_posts_ajax' );
	add_action( 'wp_ajax_nopriv_cmo_load_posts', 'cmo_load_posts_ajax' );

	add_action( 'wp_ajax_cmo_load_portfolio', 'cmo_load_portfolio_ajax' );
	add_action( 'wp_ajax_nopriv_cmo_load_portfolio', 'cmo_load_portfolio_ajax' );
	
	add_action( 'init', 'cmo_slider_init' );
	add_action( 'layerslider_ready', 'cmo_layerslider_overrides' );
	
	function cmo_slider_init() {
		if( function_exists( 'set_revslider_as_theme' ) ) {
			set_revslider_as_theme();
		}
		if( function_exists( 'vc_set_as_theme' ) ) {
			vc_set_as_theme( true );
		}
	}
	function cmo_layerslider_overrides() {
		$GLOBALS['lsAutoUpdateBox'] = false;
	}

	// Customize YITH QUICK VIEW PLUGIN
	if ( class_exists( 'YITH_WCQV_Frontend' ) ) {
		remove_action( 'woocommerce_after_shop_loop_item', array( YITH_WCQV_Frontend::get_instance(), 'yith_add_quick_view_button' ), 15 );
	}

	function cumulo_language_setup() {
		load_theme_textdomain( 'cumulo', get_stylesheet_directory() . '/languages' );
	}

	/*
	 * Theme Supports
	 */
	function cmo_add_theme_supports() {
		/* HTML5 Support */
		add_theme_support( 'html5', array (
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'widgets'
		) );

		/* Post Formats Support */
		add_theme_support( 'post-formats', array (
			'image',
			'audio',
			'video',
			'gallery',
			'quote',
			'link'
		) );

		add_theme_support( 'nav_menus' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'widget-customizer' );
		add_theme_support( 'woocommerce' );
		add_theme_support( "title-tag" );
		// add_theme_support( 'custom-header' );
		// add_theme_support( 'custom-background' );
		add_theme_support( "post-thumbnails" );
	}
	
	function cmo_theme_css() {
		wp_deregister_style('mediaelement');
		wp_register_style('mediaelement', CMO_THEME_URI . '/assets/vendor/mediaelement/mediaelementplayer.min.css', array(), '2.18.1' );
		
		wp_enqueue_style( 'cmo-google-fonts', cmo_google_fonts_url(), array(), null );

        wp_enqueue_style ( 'animate', CMO_THEME_URI . '/assets/vendor/animate-css/animate.min.css' );
        wp_enqueue_style ( 'fontawesome', CMO_THEME_URI . '/assets/vendor/font-awesome-4.3.0/css/font-awesome.min.css' );
		wp_enqueue_style ( 'fancybox', CMO_THEME_URI . '/assets/vendor/fancybox-2.1.5/jquery.fancybox.css' );
		wp_enqueue_style ( 'et-line-font', CMO_THEME_URI . '/assets/vendor/et-line-font/style.css' );
		wp_enqueue_style ( 'owl-carousel', CMO_THEME_URI . '/assets/vendor/owl-carousel/owl.carousel.css' );
		wp_enqueue_style ( 'owl-carousel-theme', CMO_THEME_URI . '/assets/vendor/owl-carousel/owl.theme.css' );
		wp_enqueue_style ( 'linecons', CMO_THEME_URI . '/assets/vendor/linecons/linecons.css' );
	    
		wp_enqueue_style ( 'theme', CMO_THEME_URI . '/assets/styles/css/style.css' );
		wp_enqueue_style ( 'bootstrap-grid', CMO_THEME_URI . '/assets/styles/grid.css' );
		
		wp_enqueue_style( 'theme-default', get_stylesheet_directory_uri() . "/style.css" );
	}

	function cmo_google_fonts_url() {
		$fonts_url = '';
		$font_families = array();

		$fonts = array(
			cmo_get_theme_mod_value( 'text-font' ),
			cmo_get_theme_mod_value( 'heading-font' ),
			cmo_get_theme_mod_value( 'sub-heading-font' ),
			cmo_get_theme_mod_value( 'menu-font' ),
		);
		$fonts = array_unique( $fonts );

		foreach ( $fonts as $fontname ) {
			$font = _x( 'on', $fontname . ": on or off", 'cumulo' );

			if ( 'off' !== $font ) {
				$font_families[] = "{$fontname}:100,100italic,300,300italic,400,400italic,600,600italic,700,700italic,800,800italic,900,900italic";
			}
		}

		if ( count ($font_families) > 0 ) {
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' )
			);
			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}

	function cmo_theme_dynamic_css() {
	    ob_start();
	    echo '<style id="dynamic_css" type="text/css">'; 
		/* Dynamic CSS */
		get_template_part ( "templates/inc/dynamic_css" );

		/* Custom CSS code */
		$custom_css = cmo_get_theme_mod_value ( "custom-css" );

		if ( $custom_css )
		{
			echo ( $custom_css ); // had no choice :(
		}

		$output = ob_get_clean();

		echo "\n";
		echo cmo_minify_css ( $output );
		echo "</style>\n";
	}

	function cmo_include_js() {	
		wp_deregister_script('mediaelement'); // include new version of mediaelement js because of firefox sizing bug 
		wp_register_script( 'mediaelement', CMO_THEME_URI . '/assets/vendor/mediaelement/mediaelement-and-player.min.js', array('jquery'), '2.18.1', 1 );

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-button' );

		wp_enqueue_script( 'fancybox', CMO_THEME_URI . '/assets/vendor/fancybox-2.1.5/jquery.fancybox.pack.js' );
		wp_enqueue_script( 'fancybox-media', CMO_THEME_URI . '/assets/vendor/fancybox-2.1.5/helpers/jquery.fancybox-media.js' );

		wp_dequeue_script( 'waypoints' ); // Doing this because Visual Composer uses old waypoint library. including latest version of waypoints in plugins.js file which contains several 3rd-party libraries in one file
        wp_enqueue_script( 'owl-carousel', CMO_THEME_URI . '/assets/vendor/owl-carousel/owl.carousel.min.js' );

        if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') ) {
        	wp_enqueue_script( 'comment-reply' );
        }

		wp_enqueue_script( 'cmo-theme-plugins', CMO_THEME_URI . '/assets/scripts/plugins.js' );
		wp_enqueue_script( 'cmo-theme-specific', CMO_THEME_URI . '/assets/scripts/theme.js' );

		$cmo_custom_js = cmo_get_theme_mod_value( 'custom-js' );
		if( !empty($cmo_custom_js) ) { ?>
<script type="text/javascript">
<?php printf( $cmo_custom_js ); ?>
</script>
		<?php }
	}
	
	function cmo_localize_script() {
		/* For ajax-loading portfolio posts */
		global $wp_query;
		wp_localize_script( 'cmo-theme-specific', 'ajaxpagination', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		) );
	}

	function cmo_load_posts_ajax() {
		$query_vars = isset( $_POST['params']['query_vars'] ) ? $_POST['params']['query_vars'] : '';
		$query_vars = str_replace( '%27', "'", $query_vars );
		$query_vars = str_replace( '\\', '', $query_vars );
		$query_vars = unserialize( $query_vars );

		$loadedCount = intval( $_POST['params']['count'] );
		$style = $_POST['params']['style'];

		if ( empty($style) ) $style = cmo_get_theme_mod_value( "blog-list-style" );

		unset( $query_vars['paged'] );
		unset( $query_vars['pagename'] );
		unset( $query_vars['name'] );

		$query_vars['offset'] = $loadedCount;
		$query_vars['post_status'] = array('publish', 'private');

		$posts = new WP_Query( $query_vars );

		if( !$posts->have_posts() ) {
			echo '';
			die();
		}

		global $post;
		while( $posts->have_posts() ) {
			$posts->the_post();
			get_template_part( "templates/{$style}/content", get_post_format() );
		}

		wp_reset_postdata();
		die();
	}

	function cmo_load_portfolio_ajax() {
		$query_vars = isset( $_POST['params']['query_vars'] ) ? $_POST['params']['query_vars'] : '';
		$query_vars = str_replace( '%27', "'", $query_vars );
		$query_vars = str_replace( '\\', '', $query_vars );
		$query_vars = unserialize( $query_vars );

		$loadedCount = intval( $_POST['params']['count'] );

		unset( $query_vars['paged'] );
		unset( $query_vars['pagename'] );
		unset( $query_vars['name'] );

		$query_vars['offset'] = $loadedCount;
		$query_vars['post_status'] = array('publish', 'private');
		$query_vars['post_type'] = array('cmo_portfolio');
		
		$posts = new WP_Query( $query_vars );

		if( !$posts->have_posts() ) {
			echo '';
			die();
		}

		global $post;
		while( $posts->have_posts() ) {
			$posts->the_post();
			get_template_part( "templates/portfolio/portfolio", "item" );
		}

		wp_reset_postdata();
		die();
	}
	/* --- End of Actions --- */


	/* customize Woocommerce Plugin */
	if ( class_exists( 'Woocommerce') ) {
		/* remove breadcrom from product-archive */
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

		/* swap rating and price position */
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 15 );

		/* customize sales flash with ribbon */
		add_filter( 'woocommerce_sale_flash', 'cmo_woo_sale_flash', 10, 3 );
		/* customize 'add to cart' button text with icon */
		add_filter( 'woocommerce_product_add_to_cart_text' , 'cmo_woocommerce_product_add_to_cart_text' );
		/* adding ajax 'add to cart' action */
		add_filter( 'add_to_cart_fragments', 'cmo_add_wc_cart_fragments');
		/* actions */

		/* filters */
		function cmo_woo_sale_flash( $str, $post, $product ) {
			if ( get_class( $product ) == 'WC_Product_Variable' ) {
				$price = $product->get_variation_regular_price('max');
				$saleprice = $product->get_variation_sale_price('min');

				if ( $price > 0 )
					$sale = 100 - round( $product->get_price() / $price * 100, 1 );

				$sale = "- " . $sale;
			}
			else if ( get_class( $product ) == 'WC_Product_Simple' ) {
				$price = $product->get_regular_price();
				if ( $price > 0 )
					$sale = 100 - round( $product->get_price() / $price * 100, 1 );
			}
			else
				$sale = __( "Sale", 'cumulo' );

			$output = "";
			$output = '<span class="ribbon-sale-flash">' . esc_attr($sale) . '%</span>';
			return $output;
		}

		function cmo_woocommerce_product_add_to_cart_text ( $txt ) {
			global $product;
			$product_type = $product->product_type;

			switch ( $product_type ) {
				case 'external':
					return __( 'Buy product', 'cumulo' );
					break;
				case 'grouped':
					return __( 'View products', 'cumulo' );
					break;
				case 'simple':
					if ( $product->is_purchasable() && $product->is_in_stock() ) {
						return "<span class='et-line icon-basket'></span> " . __( 'Add to cart', 'cumulo' );
					}
					else
						return __( 'Read more', 'cumulo' );
					break;
				case 'variable':
					return __( 'Select options', 'cumulo' );
					break;
				default:
					return __( 'Read more', 'cumulo' );
			}
		}

		function cmo_add_wc_cart_fragments( $fragments ) {
			$cmo_header_style = cmo_get_page_theme_option( 'header_style', 'header-style' );
			if ( $cmo_header_style == 'style-3' || $cmo_header_style == 'style-6' ) 
				$fragments['cmo_wc_mini_cart'] = cmo_get_wc_mini_cart(2);
			else
				$fragments['cmo_wc_mini_cart'] = cmo_get_wc_mini_cart(1);

			return $fragments;
		}
	}
	
	/* customize easy-property-listings plugin a little bit for icons */
	remove_action('epl_property_icons','epl_property_icons');
	add_action('epl_property_icons','cmo_epl_property_icons');
	function cmo_epl_property_icons() {
		global $property;
		echo cmo_epl_wrap_with_div( $property->get_property_bed() ) .
				cmo_epl_wrap_with_div( $property->get_property_bath() ).
				cmo_epl_wrap_with_div( $property->get_property_parking() ).
				cmo_epl_wrap_with_div( $property->get_property_air_conditioning() ).
				cmo_epl_wrap_with_div( $property->get_property_pool() );
	}

	function cmo_epl_wrap_with_div( $str ) {
		if ( !empty($str) ) {
			$str = '<div class="cmo-epl-icon-wrapper">' . $str . '</div>';
		}

		return $str;
	}
	
	/* Featured Image on archive template now loading through filter */
	function cmo_epl_property_archive_featured_image( $image_size = 'epl-image-medium-crop' , $image_class = 'teaser-left-thumb' ) {
		if($image_size == '') {
			$image_size = 'epl-image-medium-crop';
		}
		
		if ( has_post_thumbnail() ) {
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>
			<div class="epl-archive-entry-image">
				<div class="epl-blog-image">
					<div class="epl-stickers-wrapper">
						<?php echo epl_get_price_sticker(); ?>
					</div>
					<?php the_post_thumbnail( $image_size , array( 'class' => $image_class ) ); ?>
				</div>
				<div class="cmo-epl-hover-wrapper">
					<div class="cmo-epl-icons-wrapper">
						<a class="cmo-epl-icon fancybox-image" href="<?php echo $feat_image; ?>"><i class="fa fa-search"></i></a>
						<a class="cmo-epl-icon" href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
					</div>
				</div>
			</div>
		<?php }
	}
	remove_action( 'epl_property_archive_featured_image' , 'epl_property_archive_featured_image' , 10, 2 );
	add_action( 'epl_property_archive_featured_image' , 'cmo_epl_property_archive_featured_image' , 10, 2 );

	/* Featured Image in widgets */
	function cmo_epl_property_widgets_featured_image( $image_size = 'epl-image-medium-crop' , $image_class = 'teaser-left-thumb' ) { 
		if ( has_post_thumbnail() ) {
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
			<div class="epl-archive-entry-image">
				<div class="epl-blog-image">
					<?php the_post_thumbnail( /* $image_size */ "large", array( 'class' => $image_class ) ); ?>
				</div>
				<div class="cmo-epl-hover-wrapper">
					<div class="cmo-epl-icons-wrapper">
						<a class="cmo-epl-icon fancybox-image" href="<?php echo $feat_image; ?>"><i class="fa fa-search"></i></a>
						<a class="cmo-epl-icon" href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
					</div>
				</div>
			</div>
		<?php }
	}
	remove_action( 'epl_property_widgets_featured_image' , 'epl_property_widgets_featured_image' , 10, 2 );
	add_action( 'epl_property_widgets_featured_image' , 'cmo_epl_property_widgets_featured_image' , 10, 2 );
	
	function epl_load_core_templates_bugfix($template) {
	
		global $epl_settings;
	
		$template_path = epl_get_content_path();
	
		if( isset($epl_settings['epl_feeling_lucky']) && $epl_settings['epl_feeling_lucky'] == 'on') {
			return $template;
		}
	
		$post_tpl	=	'';
	
		$post_type = epl_all_post_types();
		if ( count( $post_type ) == 0 ) return $template;
	
		if ( is_epl_post_single() ) {
	
			$common_tpl		= apply_filters('epl_common_single_template','single-listing.php');
			$post_tpl 		= 'single-'.str_Replace('_','-',get_post_type()).'.php';
			$find[] 		= $post_tpl;
			$find[] 		= epl_template_path() . $post_tpl;
			$find[] 		= $common_tpl;
			$find[] 		= epl_template_path() . $common_tpl;
	
		} elseif ( is_epl_post_archive() ) {
			$common_tpl		= apply_filters('epl_common_archive_template','archive-listing.php');
			$post_tpl 		= 'archive-'.str_Replace('_','-',get_post_type()).'.php';
			$find[] 		=  $post_tpl;
			$find[] 		= epl_template_path() . $post_tpl;
			$find[] 		=  $common_tpl;
			$find[] 		= epl_template_path() . $common_tpl;
		} elseif ( is_tax ( 'location' ) || is_tax ( 'tax_feature' ) ) {
	
			$term   		= get_queried_object();
			$common_tpl		= apply_filters('epl_common_taxonomy_template','archive-listing.php');;
			$post_tpl 		= 'taxonomy-' . $term->taxonomy . '.php';
			$find[] 		= 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
			$find[] 		= epl_template_path() . 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
			$find[] 		= 'taxonomy-' . $term->taxonomy . '.php';
			$find[] 		= epl_template_path() . 'taxonomy-' . $term->taxonomy . '.php';
			$find[] 		= $common_tpl;
			$find[] 		= $post_tpl;
			$find[] 		= epl_template_path() . $common_tpl;
	
		}
		if ( $post_tpl ) {
			$template       = locate_template( array_unique( $find ) );
			if(!$template) {
				$template	=	$template_path . $common_tpl;
			}
		}
		return $template;
	
	}
	
	if ( class_exists( 'Easy_Property_Listings' ) ) {
		remove_filter( 'template_include', 'epl_load_core_templates' );
		add_filter( 'template_include', 'epl_load_core_templates_bugfix' );
	}

/*	function pr( $var ) {
		echo "<pre>";
		echo var_dump($var );
		echo "</pre>";
	} */