<?php
global $wp_query;
$params = serialize( $wp_query->query_vars );
$params = str_replace("'", "%27", $params);
$ppp = get_option('posts_per_page');

global $cmo_shortcode_options;
$pagiStyle = cmo_get_theme_mod_value( "portfolio-list-pagination" );

if ( isset ( $cmo_shortcode_options ) && isset( $cmo_shortcode_options['query_vars'] ) )
{
	$params = serialize( $cmo_shortcode_options['query_vars'] );
	$params = str_replace("'", "%27", $params);
}

if ( isset ( $cmo_shortcode_options ) && isset( $cmo_shortcode_options['pagination'] ) ) {
	$pagiStyle = $cmo_shortcode_options['pagination'];
}

if ( $pagiStyle == "classic" ) {
	// Previous/next page navigation.
	the_posts_pagination( array(
		'prev_text'          => "<i class='fa fa-chevron-left'></i>",
		'next_text'          => "<i class='fa fa-chevron-right'></i>",
		'before_page_number' => '' ) );
}
else if ( $pagiStyle == "load-more" ) {
	echo "<nav class='navigation pagination'><a class='cmo-button cmo-btn-load-more' href='#' data-posts-per-page='$ppp' data-query_vars='" . $params . "'><i class='fa fa-rotate-left'></i>" . __( "Load More", 'cumulo' ) . "</a>";
	echo '<div class="ajax-loader">Loading...</div></nav>';
}
else if ( $pagiStyle == "infinite-scroll" ) {
	echo "<div class='infinite-scroll-placeholder' data-posts-per-page='$ppp' data-query_vars='".$params."'><div class='ajax-loader'>Loading...</div></div>";
}