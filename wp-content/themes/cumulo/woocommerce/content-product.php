<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>

<?php $cmo_woo_style = cmo_get_page_theme_option( "woo_list_style", "woo-list-style" );
$classes[] = "woo-listing-" . $cmo_woo_style;
?>

<li <?php post_class( $classes ); ?>>
<?php if ( $cmo_woo_style == 'style-1' ) { ?>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<div class="cmo-product-thumb-wrapper">
		<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
		<div class="cmo-product-thumb-hover">
			<div class="cmo-add-cart-wrapper">
				<?php
					/* loop add cart */
					do_action( 'woocommerce_after_shop_loop_item' );
				?>
				<i class="fa fa-spin fa-spinner adding_to_cart"></i>
				<i class="fa fa-check added_to_cart"></i>
			</div>
			<div class="cmo-more-buttons-wrapper">
				<?php
				if ( defined( 'YITH_WCQV' ) ) {
					$label = esc_html( get_option( 'yith-wcqv-button-label' ) );
					echo '<a href="#" class="yith-wcqv-button" data-product_id="' . esc_attr( $product->id ) . '"><span class="et-line icon-scope"></span></a>';
				}
				?>
				<a href="mailto:share@your-domain.com?subject=<?php echo urlencode( esc_attr( $product->get_title() ) ) ?>&amp;body=<?php echo urlencode( esc_url( $product->get_permalink() ) ) ?>"><span class="et-line icon-envelope"></span></a>
				<?php do_action( "cmo_get_post_likes_html" ); ?>
			</div>
		</div>
	</div>
	<div class="cmo-product-detail-wrapper">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="cmo-product-meta-wrapper">
			<?php
				/* rating, price */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</div>
	</div>
<?php } else if ( $cmo_woo_style == 'style-2' ) { ?>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<div class="cmo-product-thumb-wrapper">
		<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
		<div class="cmo-product-thumb-hover">
			<div class="cmo-add-cart-wrapper">
				<?php
					$product_type = $product->product_type; 
					if ( $product_type == 'simple' && $product->is_purchasable() && $product->is_in_stock() ) {
				?>
				<div class='cmo-add-to-cart'>
				<?php	
					echo '<a href="/cumulo2/shop/?add-to-cart=4091" rel="nofollow" data-product_id="<?php the_ID() ?>" data-product_sku="<?php $product->sku ?>" data-quantity="1" class="add_to_cart_button product_type_simple"><span class="fa fa-shopping-cart"></span></a>';
					/* loop add cart */
					// do_action( 'woocommerce_after_shop_loop_item' );
				?>
				<i class="fa fa-spin fa-spinner adding_to_cart"></i>
				<i class="fa fa-check added_to_cart"></i>
				</div>
				<?php } ?>
				<?php
				if ( defined( 'YITH_WCQV' ) ) {
					$label = esc_html( get_option( 'yith-wcqv-button-label' ) );
					echo '<a href="#" class="yith-wcqv-button" data-product_id="' . esc_attr( $product->id ) . '"><i class="fa fa-search"></i></a>';
				}
				?>
				<?php do_action( "cmo_get_post_likes_html" ); ?>
			</div>
		</div>
	</div>
	<div class="cmo-product-detail-wrapper">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="cmo-product-meta-wrapper">
			<?php
				/* rating, price */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</div>
	</div>
<?php } else if ( $cmo_woo_style == 'style-3' ) { ?>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<div class="cmo-product-thumb-wrapper">
		<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
		<div class="cmo-product-thumb-hover">
			<div class="cmo-more-buttons-wrapper">
				<?php
				if ( defined( 'YITH_WCQV' ) ) {
					$label = esc_html( get_option( 'yith-wcqv-button-label' ) );
					echo '<a href="#" class="yith-wcqv-button" data-product_id="' . esc_attr( $product->id ) . '"><i class="fa fa-link"></i></a>';
				}

				$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
				if ( empty($image_link) ) {
					$attachment_ids = $product->get_gallery_attachment_ids();
					if ( count( $attachment_ids ) > 0 ) {
						$image_link = wp_get_attachment_url( $attachment_ids[0] );
					}
				}
				?>
				<a href="<?php echo esc_url( $image_link ); ?>" class="fancybox-image" data-fancybox-group="product" title="<?php the_title(); ?>"><i class="fa fa-expand"></i></a>
				<?php do_action( "cmo_get_post_likes_html" ); ?>
			</div>

			<div class="cmo-add-cart-wrapper">
				<div class="cmo-add-to-cart">
				<?php
					/* loop add cart */
					do_action( 'woocommerce_after_shop_loop_item' );
				?>
				<i class="fa fa-spin fa-spinner adding_to_cart"></i>
				<i class="fa fa-check added_to_cart"></i>
				</div>
				<div class="cmo-fav-product">
					<a href="mailto:share@your-domain.com?subject=<?php echo urlencode( esc_attr( $product->get_title() ) ) ?>&amp;body=<?php echo urlencode( esc_url( $product->get_permalink() ) ) ?>"><i class="fa fa-envelope-o"></i></a>
				</div>
			</div>
		</div>
	</div>
	<div class="cmo-product-detail-wrapper">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="cmo-product-meta-wrapper">
			<?php
				/* rating, price */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</div>
	</div>
<?php } ?>
</li>