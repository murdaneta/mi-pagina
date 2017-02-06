<?php 
if ( have_posts() ) {
	$columns = cmo_get_theme_mod_value( "blog-list-masonry-columns" );

	echo "<div class='blog-list-isotope-container masonry-{$columns}-columns'>";
	while ( have_posts() ) : the_post();
		get_template_part( 'templates/masonry/content', get_post_format() );
	endwhile;
	echo "</div>";

	get_template_part( 'templates/content', 'pagination' );
}
else {
	get_template_part( 'templates/content', 'none' );
}
?>