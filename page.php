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
?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'template-parts/content', get_post_format() ); ?>

<?php endwhile; ?>