<?php $cmo_footer_style = cmo_get_page_theme_option( 'footer_style', 'footer-style' ); ?>
<?php if ( cmo_is_yes_or_one( cmo_get_page_theme_option( 'footer_show_footer', 'footer-show-footer' ) ) ) { ?>
<footer id="cmo-footer" class="footer-<?php echo esc_attr( $cmo_footer_style ) ?>">
<?php get_template_part( "templates/footer/{$cmo_footer_style}"); ?>
</footer>
<?php } ?>

<?php if ( cmo_get_page_theme_option( 'content_layout', 'content-layout' ) == "boxed" ) { ?>
</div><!-- topmost-page-container -->
<?php } ?>

<?php
add_action( "wp_footer", "cmo_include_js" );
add_action( "wp_footer", "cmo_localize_script" );

wp_footer();
?>
</body>
</html>