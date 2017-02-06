<?php get_header(); ?>
<?php cmo_insert_slider() ?>
<div id="main-container">
	<?php 
	$cmo_sidebar = cmo_get_page_sidebar(); 
	if ( have_posts () ) {
		the_post ();
	?>
	<div class="page-content container page-single <?php echo esc_attr( $cmo_sidebar[1] ); ?>">
		<section class="cmo-mainbar cmo-single">
			<h2 class="hidden">Blog - <?php the_title() ?></h2>
			<?php if ( !is_attachment() ) { ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php 
				$cmo_post_format = get_post_format(); ?>
				<div class="cmo-article-featured-wrapper">
				<?php 
				if ( $cmo_post_format == false || $cmo_post_format == 'image' ) {
					if ( has_post_thumbnail() ) {
						the_post_thumbnail();
					} 
				}
				else if ( $cmo_post_format == 'gallery' ) { 
					$cmo_gallery_ids = get_post_gallery_ids ( get_the_ID() );
					$cmo_gallery_ids = array_filter( $cmo_gallery_ids );

					if ( $cmo_gallery_ids && count($cmo_gallery_ids) > 0 ) {
						echo '<div class="owl-gallery-carousel">';
						foreach ($cmo_gallery_ids as $cmo_gallery_id ) {
							echo wp_get_attachment_image( $cmo_gallery_id, "full");
						}
						echo '</div>';
					}
				}
				else if ( $cmo_post_format == 'video' ) {
					$video_source = get_post_meta( get_the_ID(), "cmo_video_source", true );
					$cmo_videourl = "";

					if ( $video_source == "file" ) {
						$cmo_videourl = get_post_meta( get_the_ID(), "cmo_video_file", true );
					}
					else {
						$cmo_videourl = cmo_get_src_from_embed ( get_post_meta( get_the_ID(), "cmo_video", true ) );
					}
					
					if ( !empty($cmo_videourl) ) {
						echo '<div class="video-wrapper-16by9">';
						if ( $video_source == "file" ) {
							if ( preg_match( '/.mp4$/', $cmo_videourl ) ) {
								echo do_shortcode( "[video mp4=\"$cmo_videourl\" width=\"1200px\"][/video]" );
							}
							else if ( preg_match( '/.flv$/', $cmo_videourl ) ) {
								echo do_shortcode( "[video flv=\"$cmo_videourl\" width=\"1200px\"][/video]" );
							}
							else if ( preg_match( '/.ogv$/', $cmo_videourl ) ) {
								echo do_shortcode( "[video ogv=\"$cmo_videourl\" width=\"1200px\"][/video]" );
							}
							else if ( preg_match( '/.webm$/', $cmo_videourl ) ) {
								echo do_shortcode( "[video webm=\"$cmo_videourl\" width=\"1200px\"][/video]" );
							}
							else if ( preg_match( '/.wmv$/', $cmo_videourl ) ) {
								echo do_shortcode( "[video wmv=\"$cmo_videourl\" width=\"1200px\"][/video]" );
							}
							else if ( preg_match( '/.m4v$/', $cmo_videourl ) ) {
								echo do_shortcode( "[video m4v=\"$cmo_videourl\" width=\"1200px\"][/video]" );
							}
						} else {
							echo "<iframe src=\"" . esc_url( $cmo_videourl ) . "\"></iframe>";
						}
						echo '</div>';
					}
				}
				else if ( $cmo_post_format == 'audio' ) {
					if ( has_post_thumbnail() ) {
						the_post_thumbnail();
					}
					
					$video_source = get_post_meta( get_the_ID(), "cmo_video_source", true );
					$cmo_audiourl = "";
					if ( $video_source == "file" ) {
						$cmo_audiourl = get_post_meta( get_the_ID(), "cmo_video_file", true );
					}
					else {
						$cmo_audiourl = cmo_get_src_from_embed ( get_post_meta( get_the_ID(), "cmo_video", true ) );
					}
					
					if ( !empty($cmo_audiourl) ) {
						echo "<div class=\"audio-wrapper\">";
						if ( $video_source == "file" ) {
							if ( preg_match( '/.mp3$/', $cmo_audiourl ) ) {
								echo do_shortcode( "[audio mp3=\"$cmo_audiourl\"][/audio]" );
							}
							else if ( preg_match( '/.ogg$/', $cmo_audiourl ) ) {
								echo do_shortcode( "[audio ogg=\"$cmo_audiourl\"][/audio]" );
							}
							else if ( preg_match( '/.wma$/', $cmo_audiourl ) ) {
								echo do_shortcode( "[audio wma=\"$cmo_audiourl\"][/audio]" );
							}
							else if ( preg_match( '/.wav$/', $cmo_audiourl ) ) {
								echo do_shortcode( "[audio wav=\"$cmo_audiourl\"][/audio]" );
							}
						} else {
							echo '<iframe src="' . esc_url( $cmo_audiourl ) . '" ></iframe>';
						}
						echo "</div>";
					}
				} else if ( $cmo_post_format == 'link' ) { ?>
					<?php $cmo_first_anchor = cmo_extract_first_anchor( get_the_content() );
					if ( $cmo_first_anchor ) { ?>
					<div class="cmo-article-link-wrapper">
						<div class="cmo-article-link-title"><?php echo cmo_do_kses( $cmo_first_anchor[0] ) ?></div>
						<div class="cmo-article-icon"><i class="fa fa-link"></i></div>
					</div>
					<div class="cmo-article-link-href"><?php echo esc_url( $cmo_first_anchor[1] ) ?></div>
					<?php } 
				} else if ( $cmo_post_format == 'quote' ) { ?>
					<?php 
					$cmo_first_quote = cmo_extract_first_blockquote( get_the_content() );
					if ( $cmo_first_quote ) { 
					?>
					<div class="cmo-article-quote-wrapper">
						<?php 
						echo cmo_do_kses($cmo_first_quote); 
						?>
						<div class="cmo-article-icon"><i class="fa fa-quote-right"></i></div>
					</div>
					<?php } 
				} ?>
				</div>
				<div class="cmo-article-contents">
					<div class="cmo-article-meta-wrapper">
						<div class="cmo-article-meta-date">
							<time datetime="<?php the_time("c"); ?>">
								<span class="time-day"><?php the_time("j"); ?></span>
								<span class="time-month"><?php the_time("M"); ?></span>
							</time>
						</div>

						<h1><?php the_title(); ?></h1>

						<div class="cmo-article-meta-author">
							<i class="et-line icon-profile-male"></i> Written by <?php the_author_posts_link() ?>
						</div>
						<div class="cmo-article-meta-tags">
							<i class="et-line icon-ribbon"></i> Tagged As <?php cmo_the_tags() ?>
						</div>
					</div>
					<div class="cmo-article-excerpt">
						<?php
							the_content();
						?>
						<?php wp_link_pages(
							array(
									'before'           => '<nav class="navigation pagination"><div class="nav-links">',
									'after'            => '</div></nav>',
									'link_before'      => '<span class="page-numbers">',
									'link_after'       => '</span>',
									'next_or_number'   => 'number',
									'separator'        => ' ',
									'nextpagelink'     => '<i class="fa fa-angle-right"></i>',
									'previouspagelink' => '<i class="fa fa-angle-left"></i>',
									'pagelink'         => '%',
									'echo'             => 1
							) ); ?>
						
						<div class="cmo-page-social-share">
							<ul class="cmo-page-social-links">
								<?php $cmo_slink = get_the_permalink(); ?>
								<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( $cmo_slink ) ?>" target="_blank" class="social-facebook"><span class='et-line icon-facebook'></span></a></li>
								<li><a href="https://twitter.com/home?status=<?php echo urlencode( get_the_title() . $cmo_slink ) ?>" target="_blank" class="social-twitter"><span class='et-line icon-twitter'></span></a></li>
								<li><a href="https://plus.google.com/share?url=<?php echo urlencode( $cmo_slink ) ?>" target="_blank" class="social-google-plus"><span class='et-line icon-googleplus'></span></a></li>
							</ul>
						</div>
					</div>
				</div>	
			</article>

			<div class="cmo-article-author">
				<div class="cmo-article-author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 150 )?>
				</div>
				<div class="cmo-article-author-info">
					<div class="cmo-article-author-name h4">
					<?php 
						_e("Author - ", 'cumulo'); 
						the_author_posts_link();
						if ( is_super_admin( get_the_author_meta( 'ID' ) ) ) {
							echo "<span class='is-admin'>";
							_e( "Admin", "cumulo" );
							echo "</span>";
						} ?>
					</div>
				<?php 
					$cmo_desc = get_the_author_meta("description");
					if ( !empty($cmo_desc) )
						echo "<p>" . cmo_do_kses( $cmo_desc ) . "</p>";
					else
						echo "<p>" . __("No Description", 'cumulo') . "</p>";
					?>
				</div>
			</div>

			<?php 
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
			
			<?php } else { ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
			</article>
			<?php } ?>
		</section>
		<?php 
		if( !empty( $cmo_sidebar[0] ) && is_active_sidebar( $cmo_sidebar[0] ) ) : ?> 
		<aside class="cmo-sidebar">
			<?php dynamic_sidebar( $cmo_sidebar[0] ); ?>
		</aside>
		<?php endif; ?>	
	</div>
	<?php } ?>
</div>
<?php
get_footer();