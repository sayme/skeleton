<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package Skeleton
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'template-parts/content', get_post_format() ); ?>

    <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
            comments_template();
        endif; 

        // The post pagination
        the_post_navigation( array(
                'next_text' => '%title',
                'prev_text' => '%title'
            ) );
    ?>

<?php endwhile; ?>

<?php get_footer(); ?>