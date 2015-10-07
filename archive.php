<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Skeleton
 */

get_header(); ?>

<?php single_tag_title( '<h1>', '</h1>' ); ?>

<?php 
    if ( have_posts() ) :

        while ( have_posts() ) : the_post();
                
            get_template_part( 'template-parts/content', get_post_format() );

        endwhile;

        // Previous/next page navigation.
        the_posts_pagination( array(
            'prev_text' => __( 'Previous page', 'skeleton' ),
            'next_text' => __( 'Next page', 'skeleton' )
        ) );

    else :

        // Nothing found on this tag
        get_template_part( 'template-parts/content', 'none' );

    endif;
?>

<?php get_footer(); ?>