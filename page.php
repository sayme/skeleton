<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package Skeleton
 */

get_header(); ?>

<div style="width:500px; border: 1px solid grey; padding: 10px">
    <?php while ( have_posts() ) : the_post(); ?>

        <?php the_post_thumbnail(); ?>

        <?php get_template_part( 'template-parts/content', get_post_format() ); ?>

    <?php endwhile; ?>
</div>

<?php get_footer(); ?>