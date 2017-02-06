<article id="<?php the_ID() ?>" <?php post_class()?>>
	<div class="row">
		<div class="col-md-6">
			<div class="cmo-portfolio-image-wrapper">
				<?php 
				$ids = get_post_gallery_ids ( get_the_ID() );
				$ids = array_filter( $ids );

				if ( $ids && count($ids) > 0 ) {
					echo '<div class="owl-gallery-carousel">';
				}

				if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				} 	

				if ( $ids && count($ids) > 0 ) {
					foreach ($ids as $gid ) {
						echo wp_get_attachment_image( $gid, "full");
					}
					echo '</div>';
				}
				?> 
			</div>
		</div>
		<div class="col-md-6">
			<div class="cmo-portfolio-detail-wrapper">
				<div class="cmo-portfolio-meta-wrapper">
					<div class="cmo-portfolio-meta cmo-portfolio-name">
						<label><?php esc_html_e("Product Name", 'cumulo') ?>:</label>
						<div><?php the_title() ?></div>
					</div>
					<?php $str = cmo_get_page_theme_option( "portfolio_duration", null );
					if ( !empty ($str ) ) {	?>
					<div class="cmo-portfolio-meta cmo-portfolio-duration">
						<label><?php esc_html_e("Duration", 'cumulo') ?>:</label>
						<div><?php echo esc_html( $str ); ?></div>
					</div>
					<?php } ?>
					<div class="cmo-portfolio-meta cmo-portfolio-category">
						<label><?php esc_html_e("Product Category", 'cumulo') ?>:</label>
						<div><?php the_terms( get_the_ID() , 'portfolio_category', '', ', ', ' ' ); ?></div>
					</div>
					<div class="cmo-portfolio-meta cmo-portfolio-tag">
						<label><?php esc_html_e("Product Tags", 'cumulo') ?>:</label>
						<div><?php the_terms( get_the_ID() , 'portfolio_tags', '', ', ', ' ' ); ?></div>
					</div>
					<?php $str = cmo_get_page_theme_option( "portfolio_type", null );
					if ( !empty ($str ) ) {	?>
					<div class="cmo-portfolio-meta cmo-portfolio-type">
						<label><?php esc_html_e("Product Type", 'cumulo') ?>:</label>
						<div><?php echo esc_html( $str ); ?></div>
					</div>
					<?php } ?>
					<?php $str = cmo_get_page_theme_option( "portfolio_client", null );
					if ( !empty ($str ) ) {	?>
					<div class="cmo-portfolio-meta cmo-portfolio-client">
						<label><?php esc_html_e("Client", 'cumulo') ?>:</label>
						<div><?php echo esc_html( $str ); ?></div>
					</div>
					<?php } ?>
					<?php $str = cmo_get_page_theme_option( "portfolio_demo", null );
					if ( !empty ($str ) ) {	?>
					<div class="cmo-portfolio-meta cmo-portfolio-demo">
						<label><?php esc_html_e("Demo", 'cumulo') ?>:</label>
						<div><a href="<?php echo esc_url( $str ); ?>" target="_blank"><?php echo esc_html( $str ); ?></a></div>
					</div>
					<?php } ?>
				</div>

				<div class="cmo-portfolio-desc">
					<label><?php esc_html_e("Product Description", 'cumulo') ?>:</label>
					<div><?php the_content() ?></div>
				</div>
			</div>
		</div>
	</div>

	<?php if ( cmo_get_page_theme_option( "portfolio_show_related", null ) == 'yes' ) { ?>
	<div class="cmo-portfolio-similar">
		<h2><?php esc_html_e('Similar Items', 'cumulo'); ?>:</h2>
		<div class="row">
		<?php
			$posts = cmo_get_similar_portfolios ( 4 );

			while ( $posts->have_posts () ) {
				$posts->the_post();
				echo "<div class='col-md-3'>";
				get_template_part( 'templates/portfolio/portfolio', 'item' );
				echo "</div>";
			}

			wp_reset_postdata();
		?>
		</div>
	</div>
	<?php } ?>
</article>
