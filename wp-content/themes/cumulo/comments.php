<?php
if ( post_password_required() ) {
	return;
}

$show_comments = cmo_get_page_theme_option( "show_comments", null );
if ( is_page() && !comments_open() ) {
    $show_comments = "no";
}

if ( is_null( $show_comments ) || $show_comments === "yes" ) {
if ( have_comments() ) {
?>
<section id="comments" class="comments-area">
	<h3 class="comments-title"><?php 
		echo sprintf( _n("%d Comment", "%d Comments", get_comments_number(), 'cumulo' ), get_comments_number() );
	?></h3>
	<ul class="comment-list"><?php
			wp_list_comments( array(
				'style'       => 'ul',
				'short_ping'  => true,
				'avatar_size' => 72,
				'callback'	  => 'cmo_comments'
			) );
	?></ul>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
	<nav class="navigation comment-navigation clearfix">
		<div class="nav-previous pull-left"><?php previous_comments_link( __( '<i class="fa fa-long-arrow-left"></i> Older Comments', 'twentythirteen' ) ); ?></div>
		<div class="nav-next  pull-right"><?php next_comments_link( __( 'Newer Comments <i class="fa fa-long-arrow-right"></i>', 'twentythirteen' ) ); ?></div>
	</nav>
	<?php } ?>
</section>
<?php } // have_comments() ?>

<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'cumulo' ); ?></p>
<?php endif; ?>

<?php 
	global $userdata, $user_identity; 
	get_currentuserinfo();

 	if ( $userdata )
		$current_user_avatar = get_avatar( $userdata->ID, 72);
 	else {
 		$current_user_avatar = "";
 	}

	comment_form( array(
	"comment_field"			=> '<p class="comment-form-comment">' . $current_user_avatar . '<textarea id="comment" name="comment" cols="45" rows="3" aria-required="true" placeholder="Enter your comment and click post comment..."></textarea></p>',
	"logged_in_as"			=> '<p class="logged-in-as">' . $user_identity . '</p>',
	"comment_notes_before"	=> '',
	"comment_notes_after"	=> '',
	"title_reply" 			=>	__( 'Leave a Comment', 'cumulo' ),
	"title_reply_to" 		=>	__( 'Leave a reply to %s', 'cumulo' ),
	"cancel_reply_link" 	=>	__( 'Cancel', 'cumulo' )
)); ?>	
<?php } ?>

<?php 
function cmo_comments( $comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo esc_attr($tag) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
		<div class="comment-author-avatar">
		<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		</div>
	
		<div class="comment-meta">
			<div class="comment-author-name h6">
				<?php echo get_comment_author_link(); ?>
			</div>
	
			<div class="comment-meta-date">
				<time datetime="<?php echo get_comment_date("c"); ?>"><?php echo get_comment_date( get_option( "date_format" ) )?></time>
				<?php edit_comment_link( __( '(Edit)', 'cumulo' ), '  ', '' ); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>
			</div>
		</div>

		<?php if ( $comment->comment_approved == '0' ) : ?>
		<div class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'cumulo' ); ?></div>
		<?php endif; ?>

		<?php comment_text(); ?>

	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php 
}
?>