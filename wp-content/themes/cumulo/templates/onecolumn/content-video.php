<article id="post-<?php the_ID(); ?>" <?php post_class( "cmo-post-in-list" ); ?>>
	<div class="cmo-article-featured-wrapper">
	<?php 
	$video_source = get_post_meta( get_the_ID(), "cmo_video_source", true );
	$cmo_videourl = "";
	if ( $video_source == "file" ) {
		$cmo_videourl = get_post_meta( get_the_ID(), "cmo_video_file", true );
	}
	else {
		$cmo_videourl = cmo_get_src_from_embed ( get_post_meta( get_the_ID(), "cmo_video", true ) );
	}

	if ( !empty($cmo_videourl) ) { 
	?>
	<div class="video-wrapper-16by9">
		<?php if ( $video_source == "file" ) {
			if ( preg_match( '/.mp4$/', $cmo_videourl ) ) {
				echo do_shortcode( "[video mp4=\"$cmo_videourl\" width=\"1200px\" height=\"675px\"][/video]" );
			}
			else if ( preg_match( '/.flv$/', $cmo_videourl ) ) {
				echo do_shortcode( "[video flv=\"$cmo_videourl\" width=\"1200px\" height=\"675px\"][/video]" );
			}
			else if ( preg_match( '/.ogv$/', $cmo_videourl ) ) {
				echo do_shortcode( "[video ogv=\"$cmo_videourl\" width=\"1200px\" height=\"675px\"][/video]" );
			}
			else if ( preg_match( '/.webm$/', $cmo_videourl ) ) {
				echo do_shortcode( "[video webm=\"$cmo_videourl\" width=\"1200px\" height=\"675px\"][/video]" );
			}
			else if ( preg_match( '/.wmv$/', $cmo_videourl ) ) {
				echo do_shortcode( "[video wmv=\"$cmo_videourl\" width=\"1200px\" height=\"675px\"][/video]" );
			}
			else if ( preg_match( '/.m4v$/', $cmo_videourl ) ) {
				echo do_shortcode( "[video m4v=\"$cmo_videourl\" width=\"1200px\" height=\"675px\"][/video]" );
			}
		} else { ?>
			<iframe src="<?php echo esc_url( $cmo_videourl ); ?>" ></iframe>
		<?php } ?>
	</div>
	<?php } ?>

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
