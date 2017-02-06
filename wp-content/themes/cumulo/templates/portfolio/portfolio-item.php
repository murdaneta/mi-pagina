<?php
$cmo_featured_images = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
$cmo_featured_image = "";
if ( sizeof($cmo_featured_images) > 0 )
	$cmo_featured_image = $cmo_featured_images[0];

if ( empty( $cmo_featured_image ) ) {
	$ids = get_post_gallery_ids ( get_the_ID() );
	$ids = array_filter( $ids );
	if ( $ids && count($ids) > 0 ) {
		$cmo_featured_image = cmo_get_val_from_array( wp_get_attachment_image_src( $ids[0], "full") );
	}
}

$sizes = array( 'x', 'x' );
$sizeMeta = get_post_meta( get_the_ID(), "cmo_featured_image_masonry_size" );
if ( $sizeMeta ) {
	$sizes = explode( '_', $sizeMeta[0] );
}

$ext_link = "";
$extlinkMeta = get_post_meta( get_the_ID(), "cmo_portfolio_demo" );

if ( $extlinkMeta ) {
	$ext_link = trim( $extlinkMeta[0] );
}
?>
<article id="<?php the_ID()?>" <?php post_class( array( "cmo-portfolio-item", "cmo-post-in-list", "cmo-portfolio-width-" . $sizes[0], "cmo-portfolio-height-" . $sizes[1] ) ) ?>>
	<div class="cmo-portfolio-featured-image-wrapper">
		<div class="cmo-portfolio-featured-image-bg" style="background-image: url('<?php echo esc_url( $cmo_featured_image ) ?>')" >
			<div class="cmo-pfi-hover">
				<div class="cmo-pfi-hover-inner">
					<?php if ( !empty( $ext_link) ) { ?>
					<a class="cmo-pfi-external-link" href="<?php echo esc_url( $ext_link ) ?>" target="_blank">
						<i class="fa fa-link"></i>
					</a>
					<?php } ?>
					
					<?php if ( !empty( $cmo_featured_image ) ) { ?>
					<a href="<?php echo esc_url( $cmo_featured_image ) ?>" title="<?php the_title() ?>" data-fancybox-group="portfolio" class="cmo-pfi-external-link fancybox-image">
						<i class="fa fa-search-plus"></i>
					</a>
					<?php } ?>
					<h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
					<div><?php the_terms( get_the_ID() , 'portfolio_tags', '', ', ', ' ' ); ?></div>
				</div>
			</div>
		</div>
	</div>
</article>