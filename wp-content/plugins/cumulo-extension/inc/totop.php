<?php 
define( 'CUMULO_TOTOP', 1 );

add_action('wp_footer', 'include_totop' );
function include_totop() {
	echo "<div class='cmo-to-top'><a href='javascript:void(0);' class='cmo-to-top-anchor'><i class='fa fa-chevron-up'></i></a></div>";
}