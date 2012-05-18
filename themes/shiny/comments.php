<?php
/**
 * The template for displaying Comments.
 *
 */
?>
		<div id="comments">
<?php if ( post_password_required() ) : ?>
			<p class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'shiny'); ?></p>
		</div>
<?php
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
		<h3 id="comments-title"><?php
		printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number() , 'shiny'),
		number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
		?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'shiny') ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'shiny') ); ?></div>
		</div>
<?php endif; ?>

		<ol class="commentlist">
			<?php
				wp_list_comments( array( 'callback' => 'e404_comment' ) );
			?>
		</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'shiny') ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'shiny') ); ?></div>
		</div>
<?php endif; ?>

<?php else :
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'shiny'); ?></p>
<?php endif; ?>

<?php endif; ?>

<?php
$comment_form_fields = array(
    'autor' => '<div class="one_third"><p>' . '<label for="author">' . __('Name' , 'shiny') . ( $req ? ' (required)' : '' ) . '</label> ' .
	           '<input id="author" name="author" type="text" tabindex="1" value="' . esc_attr( $commenter['comment_author'] ) . '" size="22" aria-required="true" /></p></div>',
    'email'  => '<div class="one_third"><p>' . '<label for="email">' . __('Email' , 'shiny') . ( $req ? ' (required)' : '' ) . '</label> ' .
	            '<input id="email" name="email" type="text" tabindex="2" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="22" aria-required="true" /></p></div>',
    'url'  => '<div class="one_third last"><p>' . '<label for="url">' . __('Website' , 'shiny') . '</label> ' .
	            '<input id="url" name="url" type="text" tabindex="3" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="22" /></p></div>',
);
$comment_field = '<p class="textarea-box"><textarea id="comment" name="comment" cols="70" rows="10" tabindex="4" aria-required="true"></textarea></p>';
$comment_notes_before = '<p>' . __( 'Your email address will not be published.' , 'shiny') . '</p>';
comment_form(array('fields' => $comment_form_fields, 'comment_field' => $comment_field, 'comment_notes_before' => $comment_notes_before, 'comment_notes_after' => '')); ?>

</div>
