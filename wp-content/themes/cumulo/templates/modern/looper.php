<?php 
if ( have_posts() ) {
	echo "<div class='cmo-article-start-border'></div>";
	while ( have_posts() ) : the_post();
		get_template_part( 'templates/modern/content', get_post_format() );
	endwhile;
	echo "<div class='cmo-article-end-border'></div>";

	get_template_part( 'templates/content', 'pagination' );
	
}
else {
	get_template_part( 'templates/content', 'none' );
}
?>