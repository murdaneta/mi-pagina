<?php
class CMO_Metaboxes {
	
	public function __construct() {
		add_action('add_meta_boxes', array($this, 'add_custom_meta_boxes'));
		add_action('save_post', array($this, 'save_meta_data'));
		add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
	}
	
	public function add_custom_meta_boxes () {
		$post_types = get_post_types( array( 'public' => true ) );
		foreach ( $post_types as $post_type ) {
			
			if ( $post_type == 'post' ) {
				add_meta_box( 'cmo_post_options', __('Post Options', 'cumulo'), array($this, 'post_options'), $post_type );
			}
			else if ( $post_type == 'page' ) {
				add_meta_box( 'cmo_page_options', __('Page Options', 'cumulo'), array($this, 'page_options'), $post_type );
			}
			else if ( $post_type == 'cmo_portfolio' ) {
				add_meta_box( 'cmo_portfolio_options', __('Portfolio Options', 'cumulo'), array($this, 'portfolio_options'), $post_type );
			}
			else {
				add_meta_box( 'cmo_default_options', __('Default Options', 'cumulo'), array($this, 'default_options'), $post_type );
			}
			
		}
	}
	
	public function save_meta_data( $post_id ) {
		
		if(defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}
		
		foreach($_POST as $key => $value) {
			if(strstr($key, 'cmo_')) {
				update_post_meta($post_id, $key, $value);
			}
		}
	}
	
	public function admin_scripts () {
		wp_enqueue_style( 'wp-color-picker' );

		wp_register_script('metabox_script', CMO_FRAMEWORK_URI . '/assets/js/metaboxes.js', array( 'wp-color-picker'), false, true );
		wp_enqueue_script('metabox_script');
		
		wp_register_style('metabox_style', CMO_FRAMEWORK_URI . '/assets/css/metaboxes.css');
		wp_enqueue_style('metabox_style');
	}
	
	public function post_options () {
		include __DIR__ . '/views/metaboxes/post_options.php';
	}
	
	public function page_options () {
		include __DIR__ . '/views/metaboxes/page_options.php';
	}
	
	public function portfolio_options () {
		include __DIR__ . '/views/metaboxes/portfolio_options.php';
	}
	
	public function default_options () {
		include __DIR__ . '/views/metaboxes/default_options.php';
	}
	
	// --------------------------------
	
	public function text($id, $label, $desc = '')
	{
		global $post;
	
		$html = '';
		$html .= '<div class="cmo_metabox_field">';
		$html .= '<div class="cmo_desc">';
		$html .= '<label for="cmo_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="cmo_field">';
		$html .= '<input type="text" id="cmo_' . $id . '" name="cmo_' . $id . '" value="' . get_post_meta($post->ID, 'cmo_' . $id, true) . '" />';
		$html .= '</div>';
		$html .= '</div>';
	
		echo ( $html );
	}
	
	public function select($id, $label, $options, $desc = '')
	{
		global $post;
	
		$html = '';
		$html .= '<div class="cmo_metabox_field">';
		$html .= '<div class="cmo_desc">';
		$html .= '<label for="cmo_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="cmo_field">';
		$html .= '<select id="cmo_' . $id . '" name="cmo_' . $id . '">';
		foreach($options as $key => $option) {
			if(get_post_meta($post->ID, 'cmo_' . $id, true) == $key) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}
	
			$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
		}
		$html .= '</select>';
		$html .= '</div>';
		$html .= '</div>';
	
		echo ( $html );
	}
	
	public function multiple($id, $label, $options, $desc = '')
	{
		global $post;
	
		$html = '';
		$html .= '<div class="cmo_metabox_field">';
		$html .= '<div class="cmo_desc">';
		$html .= '<label for="cmo_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="cmo_field">';
		$html .= '<select multiple="multiple" id="cmo_' . $id . '" name="cmo_' . $id . '[]">';
		foreach($options as $key => $option) {
			if(is_array(get_post_meta($post->ID, 'cmo_' . $id, true)) && in_array($key, get_post_meta($post->ID, 'cmo_' . $id, true))) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}
	
			$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
		}
		$html .= '</select>';
		$html .= '</div>';
		$html .= '</div>';
	
		echo ( $html );
	}
	
	public function textarea($id, $label, $desc = '', $default = '' )
	{
		global $post;
	
		$db_value = get_post_meta($post->ID, 'cmo_' . $id, true);
	
		if( metadata_exists( 'post', $post->ID, 'cmo_'. $id ) ) {
			$value = $db_value;
		} else {
			$value = $default;
		}
	
		$html = '';
		$html = '';
		$html .= '<div class="cmo_metabox_field">';
		$html .= '<div class="cmo_desc">';
		$html .= '<label for="cmo_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="cmo_field">';
		$html .= '<textarea cols="120" rows="10" id="cmo_' . $id . '" name="cmo_' . $id . '">' . $value . '</textarea>';
		$html .= '</div>';
		$html .= '</div>';
	
		echo ( $html );
	}
	
	public function upload($id, $label, $desc = '')
	{
		global $post;
	
		$html = '';
		$html = '';
		$html .= '<div class="cmo_metabox_field">';
		$html .= '<div class="cmo_desc">';
		$html .= '<label for="cmo_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="cmo_field">';
		$html .= '<div class="cmo_upload">';
		$html .= '<div><input name="cmo_' . $id . '" class="upload_field" id="cmo_' . $id . '" type="text" value="' . get_post_meta($post->ID, 'cmo_' . $id, true) . '" /></div>';
		$html .= '<div class="cmo_upload_button_container"><input class="cmo_upload_button" type="button" value="Browse" /></div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';

		echo ( $html );
	}
	
	public function multiple_images($id, $label, $desc = '')
	{
		global $post;
	
		$html = '';
		$html = '';
		$html .= '<div class="cmo_metabox_field">';
		$html .= '<div class="cmo_desc">';
		$html .= '<label for="cmo_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="cmo_field">';
		
		$html .= '<div class="cmo_multiple_images" data-formid="' . $id . '">';
		$html .= '<div class="cmo_multiple_image_button_container"><input class="cmo_multiple_upload_button" type="button" value="' . __( 'Add Images', 'cumulo' ) . '" /></div>';
		$html .= '<div class="cmo_uploaded_images clearfix">';
		$html .= '<input type="hidden" id="cmo_' . $id . '_first" name="cmo_' . $id . '[]" value="__">';
		$selected_image = cmo_get_val_from_array( get_post_meta( $post->ID, 'cmo_' . $id, false ) );
		$i = 0;
		if( is_array( $selected_image ) ) {
			foreach( $selected_image as $image_id ) {
				$i++;
				if( $i == 1 )
					continue;
				$image = cmo_get_val_from_array( wp_get_attachment_image_src( $image_id ) );
				$html .= '<div class="image">';
		        $html .= '<img src="' . $image . '">';
		        $html .= '<input type="hidden" id="cmo_' . $id . '" name="cmo_' . $id . '[]" value="' . $image_id . '">';
		        $html .= '<i class="remove fa fa-close"></i>';
		        $html .= '</div>';
			}
		}
		$html .= '</div>';
		$html .= '</div>';
		
		$html .= '</div>';
		$html .= '</div>';
	
		echo ( $html );
	}

	public function color($id, $label, $desc = '')
	{
		global $post;
	
		$html = '';
		$html .= '<div class="cmo_metabox_field">';
		$html .= '<div class="cmo_desc">';
		$html .= '<label for="cmo_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="cmo_field">';
		$html .= '<input type="text" id="cmo_' . $id . '" name="cmo_' . $id . '" value="' . get_post_meta($post->ID, 'cmo_' . $id, true) . '" class="cmo-metabox-color-picker"/>';
		$html .= '</div>';
		$html .= '</div>';
	
		echo ( $html );
	}
}

$metaboxes = new CMO_Metaboxes();