<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Skeleton
 */
?>

<?php
    if ( is_single() || is_page() ) :
        the_title( '<h1>', '</h1>' );
    else :
        the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
    endif;
?>

<?php the_content(); ?>