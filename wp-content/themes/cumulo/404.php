<?php get_header(); ?>
<div id="main-container">
	<div class="page-content container page-404">
		<div class="row">
			<div class="col-md-4 col-md-offset-1 ">
				<h1><?php _e("Sorry this page does not exist", 'cumulo' ); ?></h1>
				<p>The link you clicked might be corrupted, or the page may have been removed.</p>

				<div class="large-404">404</div>
			</div>
			<div class="col-md-3">
				<h3><?php _e("Here are a few useful links", 'cumulo'); ?></h3>

				<div class="">
					<?php echo do_shortcode( '[cmo_link href="business" target="_blank" icon="fa-angle-right"]Business[/cmo_link]
					[cmo_link href="about-us" target="_blank" icon="fa-angle-right"]About Us[/cmo_link]
					[cmo_link href="services" target="_blank" icon="fa-angle-right"]Services[/cmo_link]
					[cmo_link href="pricing" target="_blank" icon="fa-angle-right"]Pricing[/cmo_link]
					[cmo_link href="faq" target="_blank" icon="fa-angle-right"]Faq[/cmo_link]
					[cmo_link href="portfolio" target="_blank" icon="fa-angle-right"]Portfolio[/cmo_link]' ); ?>
				</div>
			</div>
			<div class="col-md-3">
				<h3><?php _e("Search our site", 'cumulo'); ?></h3>
				<p><?php _e("Can't you find what you need? Do a search below!", 'cumulo'); ?><p>
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>