<?php

function ajax_finish( $result, $message ) {
	echo esc_html( $message );
	die();
}
function get_file_path( $filename ) {
	$path = CMO_FRAMEWORK_PATH . '/demo/';
	if( !empty( $_POST['demo'] ) ) {
		if( $_POST['demo'] != 'default' ) {
			$path .= $_POST['demo'] . '/';
		}
	}
	$path .= $filename;
	return $path;
}

function cmo_import_xml( $demo_xml_file ) {
	if( function_exists( 'check_ajax_referer' ) ) {
		check_ajax_referer( DEMO_IMPORTER_NONCE, 'security' );
	}
	
	header( 'Content-type: text/html; charset=utf-8' );
	
	define( 'WP_LOAD_IMPORTERS', true );

	require_once( ABSPATH . 'wp-admin/includes/import.php' );
	$import_error = false;
	
	if( !class_exists( 'WP_Importer' ) ) {
		$wp_importer_file = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
		if( file_exists( $wp_importer_file ) ) {
			require_once( $wp_importer_file );
		} else {
			$import_error = true;
		}
	}
	if( !class_exists( 'WP_Import' ) ) {
		require_once( 'wordpress-importer/wordpress-importer.php' );
	}
	
	if( $import_error || !class_exists( 'WP_Import' ) ) {
		ajax_finish( false, __( 'Failed to load importer php files. Use WordPress Importer plugin to manually load demo content xml file.', 'cumulo' ) );
	}
	if( !is_file( $demo_xml_file ) ) {
		ajax_finish( true, "done" );
	}
	
	$wp_import = new WP_Import();
	$wp_import->fetch_attachments = true;
	set_time_limit( 0 );
	ob_start();
	$wp_import->import( $demo_xml_file );
	ob_get_clean();
	
	ajax_finish( true, "done" );
}

add_action( 'wp_ajax_cmo_demo_import_posts', 'cmo_import_posts' );
function cmo_import_posts() {
	cmo_import_xml( get_file_path( 'posts.xml' ) );
}
add_action( 'wp_ajax_cmo_demo_import_pages', 'cmo_import_pages' );
function cmo_import_pages() {
	cmo_import_xml( get_file_path( 'pages.xml' ) );
}
add_action( 'wp_ajax_cmo_demo_import_portfolio', 'cmo_import_portfolio' );
function cmo_import_portfolio() {
	cmo_import_xml( get_file_path( 'portfolio.xml' ) );
}
add_action( 'wp_ajax_cmo_demo_import_menu', 'cmo_import_menu' );
function cmo_import_menu() {
	cmo_import_xml( get_file_path( 'menu.xml' ) );
}
add_action( 'wp_ajax_cmo_demo_import_cf', 'cmo_import_cf' );
function cmo_import_cf() {
	cmo_import_xml( get_file_path( 'contact-forms.xml' ) );
}
add_action( 'wp_ajax_cmo_demo_import_products', 'cmo_import_products' );
function cmo_import_products() {
	cmo_import_xml( get_file_path( 'products.xml' ) );
}
add_action( 'wp_ajax_cmo_demo_import_properties', 'cmo_import_properties' );
function cmo_import_properties() {
    cmo_import_xml( get_file_path( 'properties.xml' ) );
}
add_action( 'wp_ajax_cmo_demo_import_attachments', 'cmo_import_attachments' );
function cmo_import_attachments() {
	cmo_import_xml( get_file_path( 'attachments.xml' ) );
}

add_action( 'wp_ajax_cmo_demo_widgets_import', 'cmo_demo_widgets_import' );
function cmo_demo_widgets_import() {
	if( !function_exists( 'wie_process_import_file' ) ) {
		require_once( 'widget-importer/widget-importer.php' );
	}
	$widget_file = get_file_path( 'widgets.wie' );
	if( !is_file( $widget_file ) ) {
		ajax_finish( true, "done" );
	}
	set_time_limit( 0 );
	ob_start();
	wie_process_import_file( $widget_file );
	ob_get_clean();
	ajax_finish( true, "done" );
}

add_action( 'wp_ajax_cmo_demo_import_tc_settings', 'cmo_import_tc_settings_ajax' );
function cmo_import_tc_settings_ajax() {
	cmo_import_tc_settings( get_file_path( 'tc-settings.json' ) );
	ajax_finish( true, "done" );
}

add_action( 'wp_ajax_cmo_demo_import_sliders', 'cmo_import_sliders_ajax' );
function cmo_import_sliders_ajax() {
	global $wpdb;

	if( !class_exists('UniteFunctionsRev') ) {
		ajax_finish( false, __( 'Revolution Slider plugin is not installed or activated.', 'cumulo' ) );
	} else {
		$rev_directory = CMO_FRAMEWORK_PATH . '/demo/sliders/';
		if( !empty( $_POST['demo'] ) ) {
			if( $_POST['demo'] != 'default' ) {
				$rev_directory .= $_POST['demo'] . '/';
			}
		}

		foreach( glob( $rev_directory . '*.zip' ) as $filename ) {
			$filename = basename($filename);
			$rev_files[] = $rev_directory . $filename ;
		}

		foreach( $rev_files as $rev_file ) {
			$filepath = $rev_file;

			$zip = new ZipArchive;
			$importZip = $zip->open($filepath, ZIPARCHIVE::CREATE);

			if($importZip === true) {

				$slider_export = $zip->getStream('slider_export.txt');
				$custom_animations = $zip->getStream('custom_animations.txt');
				$dynamic_captions = $zip->getStream('dynamic-captions.css');
				$static_captions = $zip->getStream('static-captions.css');

				$content = '';
				$animations = '';
				$dynamic = '';
				$static = '';

				while (!feof($slider_export)) $content .= fread($slider_export, 1024);

				if($custom_animations) {
					while (!feof($custom_animations)) $animations .= fread($custom_animations, 1024);
				}

				if($dynamic_captions) {
					while (!feof($dynamic_captions)) $dynamic .= fread($dynamic_captions, 1024);
				}

				if($static_captions) {
					while (!feof($static_captions)) $static .= fread($static_captions, 1024);
				}

				fclose($slider_export);

				if($custom_animations){ fclose($custom_animations); }
				if($dynamic_captions){ fclose($dynamic_captions); }
				if($static_captions){ fclose($static_captions); }
				//check for images!

			} else {
				$content = @file_get_contents($filepath);
			}

			if( $importZip === true ){ //we have a zip
				$db = new UniteDBRev();

				//update/insert custom animations
				$animations = @unserialize($animations);
				if(!empty($animations)) {
					foreach($animations as $key => $animation)
					{
						$exist = $db->fetch(GlobalsRevSlider::$table_layer_anims, "handle = '".$animation['handle']."'");
						if(!empty($exist)) {
							if($updateAnim == "true") {
								$arrUpdate = array();
								$arrUpdate['params'] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));
								$db->update(GlobalsRevSlider::$table_layer_anims, $arrUpdate, array('handle' => $animation['handle']));
								$id = $exist['0']['id'];
							} else {
								$arrInsert = array();
								$arrInsert["handle"] = 'copy_'.$animation['handle'];
								$arrInsert["params"] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));
	
								$id = $db->insert(GlobalsRevSlider::$table_layer_anims, $arrInsert);
							}
						} else {
							$arrInsert = array();
							$arrInsert["handle"] = $animation['handle'];
							$arrInsert["params"] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));
							$id = $db->insert(GlobalsRevSlider::$table_layer_anims, $arrInsert);
						}

						$content = str_replace(array('customin-'.$animation['id'], 'customout-'.$animation['id']), array('customin-'.$id, 'customout-'.$id), $content);
					}
				} else {

				}

				//overwrite/append static-captions.css
				if(!empty($static)) {
					if(isset( $updateStatic ) && $updateStatic == "true") {
						RevOperations::updateStaticCss($static);
					} else { //append
						$static_cur = RevOperations::getStaticCss();
						$static = $static_cur."\n".$static;
						RevOperations::updateStaticCss($static);
					}
				}

				$dynamicCss = UniteCssParserRev::parseCssToArray($dynamic);

				if(is_array($dynamicCss) && $dynamicCss !== false && count($dynamicCss) > 0) {
					foreach($dynamicCss as $class => $styles) {
						$class = trim($class);
						if( (strpos($class, ':hover') === false && strpos($class, ':') !== false ) || //before, after
						strpos($class," ") !== false || // .tp-caption.imageclass img or .tp-caption .imageclass or .tp-caption.imageclass .img
						strpos($class,".tp-caption") === false || // everything that is not tp-caption
						(strpos($class,".") === false || strpos($class,"#") !== false) || // no class -> #ID or img
						strpos($class,">") !== false) { //.tp-caption>.imageclass or .tp-caption.imageclass>img or .tp-caption.imageclass .img
							continue;
						}
	
						//is a dynamic style
						if(strpos($class, ':hover') !== false) {
							$class = trim(str_replace(':hover', '', $class));
							$arrInsert = array();
							$arrInsert["hover"] = json_encode($styles);
							$arrInsert["settings"] = json_encode(array('hover' => 'true'));
						} else {
							$arrInsert = array();
							$arrInsert["params"] = json_encode($styles);
						}
	
						//check if class exists
						$result = $db->fetch(GlobalsRevSlider::$table_css, "handle = '".$class."'");
	
						if(!empty($result)) { //update
							$db->update(GlobalsRevSlider::$table_css, $arrInsert, array('handle' => $class));
						} else { //insert
							$arrInsert["handle"] = $class;
							$db->insert(GlobalsRevSlider::$table_css, $arrInsert);
						}
					}
				} else {
					
				}
			}
	
			$content = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $content); //clear errors in string
	
			$arrSlider = @unserialize($content);
			$sliderParams = $arrSlider["params"];
	
			if( isset($sliderParams["background_image"]) )
				$sliderParams["background_image"] = UniteFunctionsWPRev::getImageUrlFromPath($sliderParams["background_image"]);
			$json_params = json_encode($sliderParams);
				
			$arrInsert = array();
			$arrInsert["params"] = $json_params;
			$arrInsert["title"] = UniteFunctionsRev::getVal($sliderParams, "title","Slider1");
			$arrInsert["alias"] = UniteFunctionsRev::getVal($sliderParams, "alias","slider1");
			$sliderID = $wpdb->insert(GlobalsRevSlider::$table_sliders,$arrInsert);
			$sliderID = $wpdb->insert_id;
				
			$arrSlides = $arrSlider["slides"];
			$alreadyImported = array();
	
			foreach($arrSlides as $slide) {
				$params = $slide["params"];
				$layers = $slide["layers"];
					
				if(isset($params["image"])) {
					if(trim($params["image"]) !== '') {
						if($importZip === true) {
							$image = $zip->getStream('images/'.$params["image"]);
							if(!$image) {
								echo esc_html( $params["image"] ).' not found!<br>';
							} else {
								if(!isset($alreadyImported['zip://'.$filepath."#".'images/'.$params["image"]])) {
									$importImage = UniteFunctionsWPRev::import_media('zip://'.$filepath."#".'images/'.$params["image"], $sliderParams["alias"].'/');
										
									if($importImage !== false) {
										$alreadyImported['zip://'.$filepath."#".'images/'.$params["image"]] = $importImage['path'];
										$params["image"] = $importImage['path'];
									}
								} else {
									$params["image"] = $alreadyImported['zip://'.$filepath."#".'images/'.$params["image"]];
								}
							}
						}
					}
					$params["image"] = UniteFunctionsWPRev::getImageUrlFromPath($params["image"]);
				}
					
				//convert layers images:
				foreach($layers as $key=>$layer) {
					if(isset($layer["image_url"])) {
						//import if exists in zip folder
						if(trim($layer["image_url"]) !== '') {
							if($importZip === true) { //we have a zip, check if exists
								$image_url = $zip->getStream('images/'.$layer["image_url"]);
								if(!$image_url){
									echo esc_html($layer["image_url"]).' not found!<br>';
								} else {
									if(!isset($alreadyImported['zip://'.$filepath."#".'images/'.$layer["image_url"]])) {
										$importImage = UniteFunctionsWPRev::import_media('zip://'.$filepath."#".'images/'.$layer["image_url"], $sliderParams["alias"].'/');
										if($importImage !== false){
											$alreadyImported['zip://'.$filepath."#".'images/'.$layer["image_url"]] = $importImage['path'];
											$layer["image_url"] = $importImage['path'];
										}
									} else {
										$layer["image_url"] = $alreadyImported['zip://'.$filepath."#".'images/'.$layer["image_url"]];
									}
								}
							}
						}
						$layer["image_url"] = UniteFunctionsWPRev::getImageUrlFromPath($layer["image_url"]);
						$layers[$key] = $layer;
					}
				}

				//	create new slide
				$arrCreate = array();
				$arrCreate["slider_id"] = $sliderID;
				$arrCreate["slide_order"] = $slide["slide_order"];
				$arrCreate["layers"] = json_encode($layers);
				$arrCreate["params"] = json_encode($params);

				$wpdb->insert(GlobalsRevSlider::$table_slides,$arrCreate);
			}
		}
		ajax_finish( true, "done" );
	}
}