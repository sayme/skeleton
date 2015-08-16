<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package Skeleton
 */
?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'template-parts/content', get_post_format() ); ?>

    <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
            comments_template();
        endif; 
    ?>

<?php endwhile; ?>