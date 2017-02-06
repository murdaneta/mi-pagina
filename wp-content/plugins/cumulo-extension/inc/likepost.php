<?php
/**
 * Like Any Post
 * 
 * Usage:
 * do_action( "cmo_get_post_likes_html" ); ?>
 * 
 * for before icon : add_filter( 'cmo_lp_like_icon_before', ICON )
 * for after icon : add_filter( 'cmo_lp_like_icon_after', ICON )
 * 
 * Structure
 * .lp-meta-likes ( a / div )
 * 		span.lp-meta-likes-icon
 * 		span.lp-meta-likes-count
 **/

define( 'CUMULO_LIKEPOST', 1 );

add_action('wp_footer', 'include_likepost_js' );
function include_likepost_js() {
	wp_enqueue_script( 'like-post', plugins_url( 'cumulo-extension/assets/js/likepost.js' ) );
}

add_action('wp_ajax_cmo_like_post', 'cmo_lp_like_post');
function cmo_lp_like_post () {
	$params = $_POST['params'];

	if ( isset( $params['post_id'] ) && isset( $params['user_id'] ) ) {
		if ( cmo_lp_do_like_post( $params['user_id'], $params['post_id'] ) ) 
			echo wp_json_encode( array( 
			    cmo_lp_get_post_likes( $params['post_id'] ), 
			    apply_filters( 'cmo_lp_like_icon_before', "fa fa-heart-o" ), 
			    apply_filters( 'cmo_lp_like_icon_after', "fa fa-heart" )
			) );
		else 
			echo "fail" ;
	}
	die();
}

function cmo_lp_do_like_post ( $user_id, $post_id ) {
	if ( empty($user_id) || empty($post_id) ) return false;

	$count = get_post_meta($post_id, '_lp_likes_count' , true);

	if ( cmo_lp_did_I_liked_post($user_id, $post_id) ) {
		return true;
	}

	if($count)
		$count++;
	else
		$count = 1;

	if( update_post_meta($post_id, '_lp_likes_count', $count) ) {
		$liked = get_user_meta( $user_id, '_lp_I_liked', true );

		if ( is_array($liked) ) {
			if ( in_array( $post_id, $liked ) ) return true;
			$liked[] = $post_id;
		}
		else {
			$liked = array( $post_id );
		}

		if ( update_user_meta( $user_id, '_lp_I_liked', $liked ) ) {
			return true;
		}
		/* no roll back for post meta */
		return false;
	}
	return false;
}

function cmo_lp_get_post_likes ( $post_id ) {
	return get_post_meta($post_id, '_lp_likes_count' , true);
}

function cmo_lp_did_I_liked_post ( $user_id, $post_id ) {
	$liked = get_user_meta( $user_id, '_lp_I_liked', true );

	if ( is_array($liked ) ) {
		return in_array($post_id, $liked);
	} else {
		return $liked == $post_id;
	}
}

function cmo_get_post_likes ( ) {
	$attr = array( 'user_id'=> get_current_user_id(), 'post_id' => get_the_ID() );

	if ( isset( $attr['post_id'] ) ) {
		$icon = apply_filters( 'cmo_lp_like_icon_before', "fa fa-heart-o" );
		$count = "";
		
		$iLikedPost = true;
		if ( ! empty( $attr['user_id'] ) ) {
			$iLikedPost = cmo_lp_did_I_liked_post($attr['user_id'], $attr['post_id']);

			if ( $iLikedPost ) {
				$icon = apply_filters( 'cmo_lp_like_icon_after', "fa fa-heart" );
			}
		}

		$count = cmo_lp_get_post_likes( $attr['post_id'] );
		if ( empty($count) ) $count = 0;

		$output = "";
		if ( ! $iLikedPost ) {
			$output = "<a class='lp-meta-likes' data-user_id='{$attr['user_id']}' data-post_id='{$attr['post_id']}' href='#'>";
			$output .= "<span class='lp-meta-likes-icon $icon'></span>";
			$output .= "<span class='lp-meta-likes-count'>$count</span>";
			$output .= "</a>";
		}
		else {
			$output = "<div class='lp-meta-likes'>";
			$output .= "<span class='lp-meta-likes-icon $icon'></span>";
			$output .= "<span class='lp-meta-likes-count'>$count</span>";
			$output .= "</div>";
		}

		echo $output;
	}
	echo "";
}

add_action ( 'cmo_get_post_likes_html', 'cmo_get_post_likes', 10 );