<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Skeleton
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<?php if ( have_comments() ) : ?>

    <?php
        wp_list_comments( array(
            'style' => 'ul',
        ) );
    ?>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

            <?php previous_comments_link( __( 'Older Comments', 'skeleton' ) ); ?>
            <?php next_comments_link( __( 'Newer Comments', 'skeleton' ) ); ?>

    <?php endif; // Check for comment navigation ?>

<?php endif; // Check for have_comments() ?>

<?php
    // If comments are closed and there are comments
    if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
        // Comments are closed
    endif; 
?>

<?php comment_form(); ?>