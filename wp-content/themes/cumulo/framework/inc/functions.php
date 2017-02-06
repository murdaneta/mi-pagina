<?php
function cmo_get_theme_mod_value( $id ) {
	global $default_options;
	$default_value = '';
	if( !empty( $default_options[$id] ) ) {
		$default_value = $default_options[$id];
	}
	return get_theme_mod( $id, $default_value );
}

function cmo_get_all_sidebars ( $default, $nothing = '' ) {
	global $wp_registered_sidebars;

	$list = array( "0" => $default );

	if ( !empty($nothing) ) {
		$list["-1"] = $nothing;
	}

	foreach ($wp_registered_sidebars as $sidebar) {
		$list[ $sidebar['id'] ] = $sidebar['name'];
	}

	return $list;
}

function cmo_get_font_weights( $detailed = false ) {
    if ( $detailed ) {
        return array(
        		"100"	=> __( "Hair Line", 'cumulo' ),
        		"300"	=> __( "Light", 'cumulo' ),
        		"400"	=> __( "Normal", 'cumulo' ),
        		"600"	=> __( "Semi Bold", 'cumulo' ),
        		"700"	=> __( "Bold", 'cumulo' ),
            	"800"	=> __( "Extra Bold", 'cumulo' ),
        		"900"	=> __( "Black", 'cumulo' ),
		);
    }

	return array(
			"100"	=> __( "Hair Line", 'cumulo' ),
			"300"	=> __( "Light", 'cumulo' ),
			"400"	=> __( "Normal", 'cumulo' ),
			"700"	=> __( "Bold", 'cumulo' ),
			"900"	=> __( "Black", 'cumulo' ),
	);
}

function cmo_posts_pagination_on_secondary_loop( $query, $args ) {
	$total = intval( $query->max_num_pages );
	$current = intval( $query->query_vars['paged'] );
	$current = $current ? $current : 1;

	$mid = 2;
	$dots = false;

	if ( $total < 2 ) return;

	$output = "<nav class=\"navigation pagination\" role=\"navigation\"><div class=\"nav-links\">";

	if ( $current > 1 ) {
		$prev_index = $current - 1;
		$output .= "<a class=\"prev page-numbers\" href=\"".get_permalink()."page/{$prev_index}/\">{$args['prev_text']}</a>\n";
	}

	for ( $i = 1; $i<=$total; $i++ ) {
		if ( $i == $current ) {
			$output .= "<span class=\"page-numbers current\">{$i}</span>\n";
			$dots = true;
		}
		else {
			if ( ( $i == 1 || $i == $total ) || ( ( $i > $current-$mid ) && ( $i < $current + $mid ) ) ) {
				$output .= "<a class=\"page-numbers\" href=\"" . get_permalink() . "page/{$i}/\">{$i}</a>\n";
				$dots = true;
			}
			else if ( $dots == true ) {
				$output .= "<span class=\"page-numbers dots\">&hellip;</span>\n";
				$dots = false;
			}
		}
	}

	if ( $current < $total ) {
		$next_index = $current + 1;
		$output .= "<a class=\"next page-numbers\" href=\"" . get_permalink() . "page/{$next_index}/\">{$args['next_text']}</a>\n";
	}

	$output .= "</div></nav>";

	echo wp_kses( $output, array(
		'nav' => array(
	        'class' => array(),
	        'role' => array()
	    ),
	    'div' => array(
	        'class' => array()
	    ),
	    'a' => array(
	        'class' => array(),
	        'href' => array()
	    ),
	    'span' => array(
	        'class' => array()
	    ),
	    'i' => array(
	        'class' => array()
	    )
	) );
}

/* get woocommerce mini cart */
function cmo_get_wc_mini_cart( $cart_style = 1 ) {
	global $woocommerce;

	$str = '<div id="nav-shopping-cart-wrapper"><a id="nav-link-cart" href="' . esc_url( $woocommerce->cart->get_cart_url() ) . '">';
	if ( $cart_style === 1 ) {
		$str .= '<span class="img-cart-icon">';
	}
	else {
		$str .= esc_html__( "In the Cart", 'cumulo' ) . '<span class="et-line icon-basket"></span>';
	}

	if ( $woocommerce->cart->cart_contents_count > 0 ) {
		$str .= '<span class="cart-items-count">' . intval( $woocommerce->cart->cart_contents_count ) . '</span>';
		if ( $cart_style === 1 ) $str .= "</span>";

		$str .= '</a><ul class="sub-menu right-aligned">';

		foreach ( $woocommerce->cart->get_cart() as $cart_item_key=>$item ) {
			$_product = $item['data']->post;
			$_price = get_post_meta ( $item['product_id'], '_price', true );
			$_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $item['product_id'] ), 'thumbnail' );
				
			$thumburl = $_thumb[0];
			if ( empty($_thumb) || empty($_thumb[0] ) ) {
				$thumburl = wc_placeholder_img_src();
			}

			$str .= "<li>";

			$str .= "<a href=" . get_permalink( $_product->ID ) . " class='cart-item-thumb'><img src='". esc_url( $thumburl ) . "' class='cart-item-thumb' alt='image-thumb' /></a>";
			$str .= "<a href=" . get_permalink( $_product->ID ) . " class='cart-item-title'>" . cmo_do_kses( $_product->post_title ) . "</a>";
			$str .= "<span class='cart-item-desc'><span class='cart-item-qty'>" . intval( $item['quantity'] ) . "</span>x<span class='cart-item-price'>" . wc_price($_price) . "</span></span>";
			$str .= sprintf( '<a href="%s" class="nav-remove-item" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'cumulo' ) );

			$str .= "</li>";
		}

		$str .= "<li class='cart-other-pages'><a href='" . esc_url( $woocommerce->cart->get_cart_url() ) . "' class='nav-woo-view-cart'>View Cart</a><a href='" . esc_url( $woocommerce->cart->get_checkout_url() ) . "' class='nav-woo-checkout'>Checkout</a></li>";
		$str .= '</ul></div>';
	}
	else {
		if ( $cart_style === 1 ) $str .= "</span>";
		$str .= '</a></div>';
	}

	return $str;
}

/**
 * Get All Pages with id and ppage name
 *
 *
 */
function cmo_get_all_pages() {
	$pages = get_pages();
 
 	$ret = array();

	foreach ( $pages as $page ) {
		$ret[ $page->ID ] = get_the_title( $page->ID );
	}

	return $ret;
}

/**
 * Get Absolute URL
 * 
 * @param string $rel
 * @return string
 */
function cmo_get_absolute_url ( $rel ) {
	return CMO_THEME_URI . "/" . $rel;
}

/** 
 * Simple CSS Minification function
 * Removes Commens, space after colons and white spaces
 * 
 * returns string
 */
function cmo_minify_css ( $buffer ) {
	// Remove comments
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

	// Remove space after colons
	$buffer = str_replace(': ', ':', $buffer);

    // Remove whitespace

	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}

function cmo_insert_slider() {
	global $CUMULO_PAGE_OPTIONS;

	if ( isset( $CUMULO_PAGE_OPTIONS['cmo_slider_type'] ) && 
		is_array( $CUMULO_PAGE_OPTIONS['cmo_slider_type'] ) &&
		count( $CUMULO_PAGE_OPTIONS['cmo_slider_type'] ) > 0) {
		switch( @$CUMULO_PAGE_OPTIONS['cmo_slider_type'][0] ) {
			case 'rev':
				if( function_exists('putRevSlider') ) {
					echo '<div id="cmo-header-slider" class="cmo-rev-slider">';
					putRevSlider( $CUMULO_PAGE_OPTIONS['cmo_revslider'][0] );
					echo '</div>';
				}
				break;
			case 'layer':
				$id = $CUMULO_PAGE_OPTIONS['cmo_layerslider'][0];
				if( $id ) {
					echo '<div id="cmo-header-slider" class="cmo-layer-slider">';
					echo do_shortcode( "[layerslider id='{$id}']" );
					echo '</div>';
				}
				break;
			case 'custom':
				$shortcode = $CUMULO_PAGE_OPTIONS['cmo_custom_slider'][0];
				if( $shortcode ) {
					echo '<div id="cmo-header-slider" class="cmo-custom-slider">';
					echo do_shortcode( $shortcode );
					echo '</div>';
				}
				break;
		}
	}
}

/* General Color Operation */
function cmo_hex2rgb( $hex ) {
	$hex = str_replace( "#", "", $hex );

	if( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1).substr($hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1).substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1).substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) ) ;
		$b = hexdec( substr( $hex, 4, 2 ) );
	}

	return array( $r, $g, $b );
}

function cmo_color_add ( $hex1, $hex2 ) {
	$rgb1 = cmo_hex2rgb( $hex1 );
	$rgb2 = cmo_hex2rgb( $hex2 );
	$rgb = array();

	for ( $i=0; $i<3; $i++ )
	{
		$rgb[$i] = $rgb1[$i] + $rgb2[$i];
		if ( $rgb[$i] > 255 ) $rgb[$i] = 255; 
	}

	return sprintf( '#%02x%02x%02x', $rgb[0], $rgb[1], $rgb[2]);
}

function cmo_color_minus ( $hex1, $hex2 ) {
	$rgb1 = cmo_hex2rgb( $hex1 );
	$rgb2 = cmo_hex2rgb( $hex2 );
	$rgb = array();

	for ( $i=0; $i<3; $i++ )
	{
		$rgb[$i] = $rgb1[$i] - $rgb2[$i];
		if ( $rgb[$i] < 0 ) $rgb[$i] = 0;
	}

	return sprintf( '#%02x%02x%02x', $rgb[0], $rgb[1], $rgb[2]);
}

function cmo_get_val_from_array( $mixed, $idx = 0 ) {
	if ( is_array( $mixed ) ) {
		if ( isset($mixed[$idx] ) ) 
			return $mixed[$idx];
		else
			return "";
	}
	else {
		return "";
	}
}