<?php

function fg_register_metabox() {

	$post_types	= apply_filters( 'fg_post_types', array( 'post', 'cmo_portfolio' ) );
	$context	= apply_filters( 'fg_context', 'side' );
	$priority	= apply_filters( 'fg_priority', 'default' );

	foreach ( $post_types as $post_type ) {

		add_meta_box( 'featuredgallerydiv', __( 'Featured Gallery', 'cumulo' ), 'fg_display_metabox', $post_type, $context, $priority );

	}

}

function fg_display_metabox() {

	global $post;

	// Get the Information data if its already been entered
	$galleryHTML = '';
	$oldfix = '';
	if ( get_bloginfo( 'version' ) >= 3.8 ) {
		$button = '<button>&#xf335;</button>';
	} else {
		$button = '<button class="media-modal-icon"></button>';
		$oldfix = ' premp6';
	}
	$selectText    = __( 'Select Images', 'cumulo' );
	$visible       = ''; //SHOULD WE SHOW THE REMOVE ALL BUTTON? THIS WILL BE APPLIED AS A CLASS, AND IS BLANK BY DEFAULT.
	$galleryArray  = get_post_gallery_ids( $post->ID );
	$galleryString = get_post_gallery_ids( $post->ID, 'string' );
	if ( ! empty( $galleryString ) ) {
		foreach ( $galleryArray as &$id ) {
			$galleryHTML .= '<li>'.$button.'<img id="'.$id.'" src="' . cmo_get_val_from_array( wp_get_attachment_image_src( $id ) ) . '"></li> ';
		}
		$selectText = __( 'Edit Selection', 'cumulo' );
		$visible    = " visible";
	} 
	update_post_meta( $post->ID, 'fg_temp_metadata', $galleryString ); // Overwrite the temporary featured gallery data with the permanent data. This is a precaution in case someone clicks Preview Changes, then exits withing saving. ?>

	<input type="hidden" name="fg_temp_noncedata" id="fg_temp_noncedata" value="<?php echo wp_create_nonce( 'fg_temp_noncevalue' ); ?>" />

	<input type="hidden" name="fg_perm_noncedata" id="fg_perm_noncedata" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />

	<input type="hidden" name="fg_perm_metadata" id="fg_perm_metadata" value="<?php echo esc_attr( $galleryString ); ?>" data-post_id="<?php echo esc_attr( $post->ID ); ?>" />

	<button class="button" id="fg_select"><?php echo esc_html( $selectText ); ?></button>

	<button class="button<?php echo esc_attr( $visible ) . esc_attr( $oldfix ); ?>" id="fg_removeall"><?php _e( 'Remove All', 'cumulo' ); ?></button>

	<ul><?php echo ( $galleryHTML ); ?></ul>

	<div style="clear:both;"></div><?php

}

function fg_save_perm_metadata( $post_id, $post ) {

	//Only run the call when updating a Featured Gallery.
	if ( empty( $_POST['fg_perm_noncedata'] ) ) {
		return;
	}
	// Noncename
	if ( ! wp_verify_nonce( $_POST['fg_perm_noncedata'], plugin_basename( __FILE__ ) ) ) {
		return;
	}
	// Verification of User
	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return;
	}
	// OK, we're authenticated: we need to find and save the data
	$events_meta['fg_perm_metadata'] = $_POST['fg_perm_metadata'];
	// Add values of $events_meta as custom fields
	foreach ( $events_meta as $key => $value ) {
		if ( $post->post_type == 'revision' ) {
			return;
		}
		$value = implode( ',', (array)$value );
		if ( get_post_meta( $post->ID, $key, FALSE ) ) {
			update_post_meta( $post->ID, $key, $value );
		} else {
			add_post_meta( $post->ID, $key, $value );
		}
		if ( ! $value ) {
			delete_post_meta( $post->ID, $key );
		}
	}

}