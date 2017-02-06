<?php

if( isset( $_POST['import'] ) ) {
	if( check_admin_referer( 'cmo-customizer-import-settings' ) ) {
		cmo_import_customizer_settings();
		function cmo_imported_notice() {
			$class = "updated";
			$message = __( "Customizer settings successfully imported.", 'cumulo' );
			echo "<div class=\"$class\"><p>$message</p></div>";
		}
		add_action( 'admin_notices', 'cmo_imported_notice', 11 );
	}
}
if( isset( $_POST['export'] ) ) {
	if( check_admin_referer( 'cmo-customizer-export-settings' ) ) {
		cmo_export_customizer_settings();
	}
}
if( isset( $_POST['reset'] ) ) {
	if( check_admin_referer( 'cmo-customizer-reset-settings' ) ) {
		cmo_reset_customizer_settings();
		function cmo_imported_notice() {
			$class = "updated";
			$message = __( "Customizer settings successfully reseted to defaults.", 'cumulo' );
			echo "<div class=\"$class\"><p>$message</p></div>";
		}
		add_action( 'admin_notices', 'cmo_imported_notice', 11 );
	}
}

add_action( 'admin_menu', 'cmo_customizer_menu', 11 );
function cmo_customizer_menu() {
	add_theme_page( 
		__( 'Settings Manager', 'cumulo' ), 
		__( 'Settings Manager', 'cumulo' ), 
		'manage_options', 
		CMO_THEME_SLUG . '-customizer',
		'cmo_customizer_admin'
	);
}

function cmo_customizer_admin() {
?>
<h1 class='cmo-pagetitle'><?php echo CMO_THEME_NAME . ' ' . __( 'Theme Settings Manager', 'cumulo' ) ?></h1>
<p class='cmo-subtitle'><?php _e( 'You can manage your customizer settings here.', 'cumulo' ) ?></p>
<div class="metabox-holder cmo-admin-section clear">
	<div class='cmo-customizer-admin postbox col-one-third'>
		<h3 class='hndle ui-sortable-handle'>
			<span class="dashicons dashicons-upload"></span>
			<span><?php _e( 'Import Settings', 'cumulo' ) ?></span>
		</h3>
		<div class='inside'>
			<p><?php _e( 'Upload your customizer settings file here, and we\'ll import the options into this site.', 'cumulo' ) ?></p>
			<p><?php _e( 'Choose a JSON file that was exported in this customizer manager, and then click "Upload and Import."', 'cumulo' ) ?></p>
			<form method="post" enctype="multipart/form-data" id="import-form">
				<?php wp_nonce_field( 'cmo-customizer-import-settings' ); ?>
				<input type="file" id="tc_settings_file" name="tc_settings_file">
				<input type="submit" name="import" class="button button-primary smaller button-import-tc-settings" value="<?php _e( 'Upload and Import', 'cumulo' ) ?>">
			</form>
		</div>
	</div>
	<div class='cmo-customizer-admin postbox col-one-third'>
		<h3 class='hndle ui-sortable-handle'>
			<span class="dashicons dashicons-download"></span>
			<span><?php _e( 'Export Settings', 'cumulo' ) ?></span>
		</h3>
		<div class='inside'>
			<p><?php _e( 'Click the button below to export your customizer settings to JSON file and save it on your computer.', 'cumulo' ) ?></p>
			<p><?php _e( 'Once you\'ve saved the downloaded file, you can import it in Import Settings section later.', 'cumulo' ) ?></p>
			<form method="post">
				<?php wp_nonce_field( 'cmo-customizer-export-settings' ); ?>
				<input type="submit" name="export" class="button button-primary smaller button-export-tc-settings" value="<?php _e( 'Download Export File', 'cumulo' ) ?>">
			</form>
		</div>
	</div>
	<div class='cmo-customizer-admin postbox col-one-third'>
		<h3 class='hndle ui-sortable-handle'>
			<span class="dashicons dashicons-update"></span>
			<span><?php _e( 'Reset Settings', 'cumulo' ) ?></span>
		</h3>
		<div class='inside'>
			<p><?php _e( 'If you click the button below, all customizer settings will be resetted to default values.', 'cumulo' ) ?></p>
			<form method="post" id="reset-form">
				<?php wp_nonce_field( 'cmo-customizer-reset-settings' ); ?>
				<input type="submit" name="reset" class="button button-primary smaller button-reset-tc-settings" value="<?php _e( 'Reset Customizer Settings', 'cumulo' ) ?>">
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery('#import-form').on( 'submit', function() {
	if( !confirm( '<?php _e( 'Do you really want to import customizer settings from file?', 'cumulo' ) ?>' ) ) {
		return false;
	}
} );
jQuery('#reset-form').on( 'submit', function() {
	if( !confirm( '<?php _e( 'Do you really want to reset your customizer settings?', 'cumulo' ) ?>' ) ) {
		return false;
	}
} );
</script>
<?php
}

function cmo_import_tc_settings( $file ) {
	remove_theme_mods();
	$options_json = file_get_contents( $file );
	$options = json_decode( $options_json );
	foreach( $options as $key => $value ) {
		if( $key != "0" && ( is_string( $value ) || is_numeric( $value ) ) ) {
			set_theme_mod( $key, $value );
		}
	}
}

function cmo_import_customizer_settings() {
	if( $_FILES['tc_settings_file']['error'] > 0 ) {
		wp_die( 'An import error occured. Please try again.' );
	} else {
		cmo_import_tc_settings( $_FILES['tc_settings_file']['tmp_name'] );
	}
}

function cmo_export_customizer_settings() {
	$blogname  = strtolower( str_replace( ' ', '-', get_option( 'blogname' ) ) );
	$file_name = $blogname . '-tc.json';
	
	ob_clean();
	$options = get_theme_mods();
	header( 'Content-Type: text/json; charset=' . get_option( 'blog_charset' ) );
	header( 'Content-Disposition: attachment; filename="' . $file_name );
    echo json_encode( $options );
	exit();
}
function cmo_reset_customizer_settings() {
	remove_theme_mods();
}
