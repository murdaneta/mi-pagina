<?php
function cmo_breadcrumb() {
	if( class_exists('Woocommerce') && is_woocommerce() ) {
		woocommerce_breadcrumb( array (
			'delimiter'		=>	'',
			'wrap_before'	=>	'<ul class="cmo-breadcrumbs">',
			'wrap_after'	=>	'</ul>',
			'before'		=>	'<li>',
			'after'			=>	'</li>',
			'home'			=>	__( 'Home', 'cumulo' )
		) );
		return;
	}

	if ( function_exists( "is_bbpress" ) && is_bbpress() ) {
		bbp_breadcrumb( array(
			'before'		=>	'<ul class="cmo-breadcrumbs">',
			'after'			=>	'</ul>',

			'crumb_before'	=>	'<li>',
			'crumb_after'	=>	'</li>',

			'sep'			=>	'',
			'pad_sep'       => 0,
			'sep_before'    => '',
			'sep_after'     => '',

			'current_before'  => '',
			'current_after'   => '',
			
		) );
		return;
	}

	global $post;

	echo '<ul class="cmo-breadcrumbs">';

	if( !is_front_page() ) {
		echo '<li><a href="';
		echo home_url();
		echo '">' . __( 'Home', 'cumulo' ) . "</a></li>";
		// echo '"><i class="fa fa-home"></i></a></li>';
	}

	$params['link_none'] = '';
	$separator = '';

	if( is_category() && !is_singular( 'cmo_portfolio' ) ) {
		$category = get_the_category();
		$ID = $category[0]->cat_ID;
		echo is_wp_error( $cat_parents = get_category_parents($ID, TRUE, '', FALSE ) ) ? '' : '<li>'.$cat_parents.'</li>';
	}

	if( is_singular( 'cmo_portfolio' ) ) {
		echo '<li><a href="' . site_url( 'portfolio-items' ) . '">' . esc_html__( 'Portfolio', 'cumulo' ) . '</a></li>';
		echo get_the_term_list($post->ID, 'portfolio_category', '<li>', ',&nbsp;', '</li>');
		echo '<li>'.get_the_title().'</li>';
	}
	
	if ( function_exists( "is_epl_post" ) && is_epl_post() && !is_epl_post_archive() ) {
		echo '<li><a href="' . site_url( 'property' ) . '">' . esc_html__( 'Properties', 'cumulo' ) . '</a></li>';
	}

	if( is_singular( 'event' ) ) {
		$terms = get_the_term_list($post->ID, 'event-categories', '<li>', ',&nbsp;', '</li>');
		if( ! is_wp_error( $terms ) ) {
			echo get_the_term_list($post->ID, 'event-categories', '<li>', ',&nbsp;', '</li>');
		}
		echo '<li>' . get_the_title() . '</li>';
	}

	if( is_tax() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$link = get_term_link( $term );
			
		if ( is_wp_error( $link ) ) {
			echo sprintf( '<li>%s</li>', $term->name );
		} else {
			echo sprintf( '<li><a href="%s" title="%s">%s</a></li>', $link, $term->name, $term->name );
		}
	}

	if( is_home() ) { 
		echo '<li>' . '' . '</li>'; ///$smof_data['blog_page_title']
	}
	
	if( is_page() && !is_front_page() ) {
		$parents = array();
		$parent_id = $post->post_parent;
		while ( $parent_id ) :
		$page = get_page( $parent_id );
		if ( $params["link_none"] )
			$parents[]  = get_the_title( $page->ID );
		else
			$parents[]  = '<li><a href="' . get_permalink( $page->ID ) . '" title="' . get_the_title( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></li>' . $separator;
		$parent_id  = $page->post_parent;
		endwhile;
		$parents = array_reverse( $parents );
		echo join( '', $parents );
		echo '<li>'.get_the_title().'</li>';
	}

	if( is_single() && !is_singular( 'cmo_portfolio' ) 
			&& !is_singular( 'tribe_events' ) 
			&& !is_singular( 'event' ) 
			&& !is_singular( 'wpfc_sermon' ) ) {
		$categories_1 = get_the_category($post->ID);
		if($categories_1):
		foreach($categories_1 as $cat_1):
		$cat_1_ids[] = $cat_1->term_id;
		endforeach;
		$cat_1_line = implode(',', $cat_1_ids);
		endif;
		if( isset( $cat_1_line ) && $cat_1_line ) {
			$categories = get_categories(array(
					'include' => $cat_1_line,
					'orderby' => 'id'
			));
			if ( $categories ) :
			echo '<li>';
			$cats = '';
			foreach ( $categories as $cat ) :
			if( $cats != '' ) {
				$cats .= ', ';
			}
			$cats .= '<a href="' . get_category_link( $cat->term_id ) . '" title="' . $cat->name . '">' . $cat->name . '</a>';
			endforeach;
			echo ( $cats );
			echo '</li>';
			endif;
		}
		echo '<li>'.get_the_title().'</li>';
	}
	if( is_tag() ) {
		echo '<li>'."Tag: ".single_tag_title('',FALSE).'</li>';
	}
	if( is_search() ) {
		echo '<li>'.__("Search", 'cumulo').'</li>';
	}

	if( is_404() ) {
			echo '<li>'.__("404 - Page Not Found", 'cumulo').'</li>';
	}

	if( is_archive() && is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );

		$sermon_settings = get_option('wpfc_options');
		if( is_array( $sermon_settings ) ) {
			$title = $sermon_settings['archive_title'];
		}
		echo '<li>'. $title .'</li>';
	}

	echo "</ul>";
}
