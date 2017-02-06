<article id="post-<?php the_ID(); ?>" <?php post_class( "cmo-post-in-list" ); ?>>
	<div class="cmo-article-featured-wrapper">
	<?php
		$ids = get_post_gallery_ids ( get_the_ID() );
		$ids = array_filter( $ids );

		if ( $ids && count($ids) > 0 ) {
			echo '<div class="owl-gallery-carousel">';
			foreach ($ids as $gid ) {
				echo wp_get_attachment_image( $gid, "full");
			}
			echo '</div>';
		}
	?>
	</div>
	<div class="cmo-article-contents">
		<div class="cmo-article-meta-wrapper">
			<a class="cmo-article-meta-date" href="<?php echo get_permalink( get_the_ID() ) ?>">
				<time datetime="<?php the_time("c"); ?>">
					<span class="time-day"><?php the_time("j"); ?></span>
					<span class="time-month"><?php the_time("M"); ?></span>
				</time>
			</a>

			<h2><a href="<?php echo get_permalink( get_the_ID() ) ?>"><?php the_title(); ?></a></h2>

			<div class="cmo-article-meta-author">
				<i class="et-line icon-profile-male"></i> Written by <?php the_author_posts_link() ?>
			</div>
			<div class="cmo-article-meta-tags">
				<i class="et-line icon-ribbon"></i> Tagged As <?php cmo_the_tags() ?>
			</div>
		</div>
		<div class="cmo-article-excerpt">
			<?php
				the_excerpt();
			?>
		</div>
	</div>
</article>
