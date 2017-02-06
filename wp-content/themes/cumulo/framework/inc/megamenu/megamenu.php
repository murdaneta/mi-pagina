<?php
if( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( is_admin() ) {
	require_once dirname( __FILE__ ) . '/megamenu/menu-item-custom-fields.php';
	add_action( 'admin_enqueue_scripts', 'add_admin_style_script_4megamenu' );

	function add_admin_style_script_4megamenu() {
		wp_enqueue_script( 'select2js-for-cmo-megamenu', CMO_FRAMEWORK_URI . '/assets/js/jquery.select2/js/select2.min.js' );
		wp_enqueue_style( 'select2css-for-cmo-megamenu', CMO_FRAMEWORK_URI . '/assets/js/jquery.select2/css/select2.min.css' );

		wp_enqueue_style( 'cmo-megamenu', CMO_FRAMEWORK_URI . '/assets/css/megamenu.css' );
		wp_enqueue_script( 'cmo-megamenu-script', CMO_FRAMEWORK_URI . '/assets/js/megamenu.js' );
		wp_enqueue_style( 'cmo-fontawesome', CMO_FRAMEWORK_URI . '/assets/fonts/fontawesome/font-awesome.min.css' );
	}
}

if ( ! class_exists('Cumulo_Nav_Walker') ) { 
	class Cumulo_Nav_Walker extends Walker_Nav_Menu {
		protected $isMegaMenuItem = 0;
		protected $megaBackground = "";
		
		function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( isset( $args[0] ) && is_object( $args[0] ) )
			{
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
			}

			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);

			if( $this->isMegaMenuItem == '1' ) {
				if( $depth == 0 ) {
				    $mbg = "";
				    if ( !empty( $this->megaBackground ) ) {
				        $mbg = "style=\"background-image: url( " . esc_url( $this->megaBackground ) . " ); background-repeat: no-repeat; background-position: right bottom;\"";
				    }
					$output .= "\n$indent<ul class=\"cmo-megamenu-wrapper\" {$mbg}>\n";
				} else if( $depth == 1 ) {
					$output .= "\n$indent<ul class=\"cmo-megamenu-sub-menu sub-menu\">\n";
				} else {
					$output .= "\n$indent<ul class=\"cmo-megamenu-sub-menu deeper-sub-menu\">\n";
				}
			} else {
				$output .= "\n$indent<ul class=\"sub-menu\">\n";
			}
		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			if ( $depth == 0 ) { 
				$this->isMegaMenuItem = get_post_meta( $item->ID, 'menu-item-cmo_enable_megamenu', true );
				$this->megaBackground = get_post_meta( $item->ID, 'menu-item-cmo_mega_background', true );
			}

				$mega_icon = get_post_meta( $item->ID, 'menu-item-cmo_fa_icons', true );
			
			if ( $this->isMegaMenuItem == '1' ) {
				$mega_disableCaption = get_post_meta( $item->ID, 'menu-item-cmo_disable_caption', true );
			}

			if ( is_object($args) )
			{
				$link_after = $args->link_after;
				$link_before = $args->link_before;
				$before = $args->before;
				$after = $args->after;

				$args->link_before = str_repeat("<span class='resp-nav-gap'></span>", $depth);

				if ( !empty( $mega_icon ) ) {
					$args->link_before .= "<i class='fa {$mega_icon}'></i> ";
				}

				if ( $this->isMegaMenuItem == '1' ) {
					if ( $depth == 0 ) {
						$item->classes[] = 'cmo-megamenu';
					}
					else if ( $depth == 1 ) {
						if ( ! empty( $mega_disableCaption ) )
							$item->classes[] = 'cmo-megamenu-disablecaption';

						$item->classes[] = 'cmo-megamenu-column';
					}
				}

				if ( $args->has_children ) {
					$args->link_after = "<span class=\"caret\"></span>";
				}
			}

			parent::start_el($output, $item, $depth, $args, $id);

			if ( is_object($args) ) {
				$args->link_after = $link_after;
				$args->link_before = $link_before;
				$args->before = $before;
				$args->after = $after;
			}
		}
	}
}

if ( is_admin() ) {
	class Cumulo_MegaMenu_Custom_Fields {
		protected static $fields = array();

		public static function init() {
			add_action( 'wp_nav_menu_item_custom_fields', array( __CLASS__, '_fields' ), 10, 4 );
			add_action( 'wp_update_nav_menu_item', array( __CLASS__, '_save' ), 10, 3 );
			
			global $wp_customize;
			if ( ! isset( $wp_customize ) ) {
				add_filter( 'manage_nav-menus_columns', array( __CLASS__, '_columns' ), 99 );
			}

			$faicons = self::getAllFontAwesomeIcons ();

			self::$fields = array(
					'cmo_enable_megamenu' 	=> array (
							'type' 	=> 'checkbox',
							'label'	=> __( 'Enable Mega Menu', 'cumulo' ),
					),
					'cmo_disable_caption'	=> array (
							'type' 	=> 'checkbox',
							'label'	=> __( 'Disable Caption', 'cumulo' ),
					),
					'cmo_fa_icons'	=> array (
							'type'	=>	'select',
							'label'	=>	__( 'Fontawesome Icons', 'cumulo' ),
							'values'	=>	$faicons,
					),
				    'cmo_mega_background'	=> array (
				    		'type'	=>	'upload',
				    		'label'	=>	__( 'Background on Megamenu ( Bottom Right Corner )', 'cumulo' ),
					)
			);
		}

		public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				return;
			}

			foreach ( self::$fields as $_key => $label ) {
				$key = sprintf( 'menu-item-%s', $_key );

				if ( ! empty( $_POST[ $key ][ $menu_item_db_id ] ) ) {
					$value = $_POST[ $key ][ $menu_item_db_id ];
				}
				else {
					$value = null;
				}

				if ( ! is_null( $value ) ) {
					update_post_meta( $menu_item_db_id, $key, $value );
				}
				else {
					delete_post_meta( $menu_item_db_id, $key );
				}
			}
		}

		public static function _fields( $id, $item, $depth, $args ) {
			echo "<p style=''>&nbsp;</p>";

			foreach ( self::$fields as $_key => $label ) :
				$key   = sprintf( 'menu-item-%s', $_key );
				$id    = sprintf( 'edit-%s-%s', $key, $item->ID );
				$name  = sprintf( '%s[%s]', $key, $item->ID );
				$value = get_post_meta( $item->ID, $key, true );

				$class = sprintf( 'field-%s', $_key );
				?>
					<p class="description description-wide <?php echo esc_attr( $class ) ?> megamenu-item">
					<?php
						if ( $label['type'] == 'checkbox' ) {
							printf( 
								'<label for="%1$s"><input type="checkbox" id="%1$s" class="widefat %1$s" name="%3$s" value="1" %4$s/>%2$s</label>',
								esc_attr( $id ),
								esc_html( $label['label'] ),
								esc_attr( $name ),
								($value==1)?"checked":""
							);
						}
						else if ( $label['type'] == 'select' ) {
							printf(
								'<label for="%1$s">%2$s<br /><select id="%1$s" class="widefat %1$s" name="%3$s">',
								esc_attr( $id ),
								esc_html( $label['label'] ),
								esc_attr( $name )
							);

							foreach ( $label['values'] as $key=>$val ) {
								printf( '<option value="%s" data-icon="%s" %s>%s</option>',
									esc_attr($key),
									$key,
									$value==$key?"selected":"",
									$val
								);
							}
							echo "</select></label>";
						} 
						else if ( $label['type'] == 'upload' ) {
						    printf(
							    '<label for="%1$s">%2$s<br /><input type="text" id="%1$s" class="widefat %1$s megam-file-upload-path" name="%3$s" value="%4$s" /><input class="megam-file-upload" type="button" value="Select" /></label>',
							    esc_attr( $id ),
							    esc_html( $label['label'] ),
							    esc_attr( $name ),
							    esc_attr( $value )
						    );
						}
						else {
							printf(
								'<label for="%1$s">%2$s<br /><input type="text" id="%1$s" class="widefat %1$s" name="%3$s" value="%4$s" /></label>',
								esc_attr( $id ),
								esc_html( $label['label'] ),
								esc_attr( $name ),
								esc_attr( $value )
							); 
						} ?>
					</p>
				<?php
			endforeach;
		}

		public static function _columns( $columns ) {
			$extra_columns = array();
			foreach ( self::$fields as $key=>$field ) {
				$extra_columns[$key] = $field['label'];
			}

			$columns = array_merge( $columns, $extra_columns );
			return $columns;
		}

		public static function getAllFontAwesomeIcons() {
			$str = file_get_contents( CMO_FRAMEWORK_PATH . '/assets/fonts/fontawesome/font-awesome.min.css' );
			preg_match_all( '/\.(fa\-(?:(?:\w+(?:\-)?)+)):before\s*{content:"\\\\(\w+)"/i', $str, $matches);
			// (?: ) disable back referencing e.g. cannot do \1, \2 ( doesn't include in search result )

			$retarr = array();

			asort( $matches[1] );
			$retarr[ 0 ] = 'No Icon';

			foreach ( $matches[1] as $idx => $fa ) {
				// $retarr[ $fa ] = "&#x{$matches[2][$idx]} $fa";
				$retarr[ $fa ] = "$fa";
			}

			return $retarr;
		}
	}
	Cumulo_MegaMenu_Custom_Fields::init();
}