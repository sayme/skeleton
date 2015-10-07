<?php
/**
 * Custom template tags
 *
 * @package Skeleton
 */
 
if ( ! function_exists( 'skeleton_current_url' ) ) :
/**
 * Get the current url
 */
function skeleton_current_url() {
    global $wp;
    return home_url( add_query_arg( array(), $wp->request ) );
}
endif;

if ( ! function_exists( 'skeleton_get_thumbnail_src' ) ) :
/**
 * Get thumbnail src url
 *
 * @param int $post_thumbnail_id ( WP-function: get_post_thumbnail_id() )
 * @param string|array $size Thumb size
 * @return string
 */
function skeleton_get_thumbnail_src( $post_thumbnail_id, $size = 'full' ) {
    $thumbnail = wp_get_attachment_image_src( $post_thumbnail_id, $size );
    return @$thumbnail[0];
}
endif;

if ( ! function_exists( 'skeleton_og_meta_tags' ) ) :
/**
 * Display the Open Graph meta tags.
 * Add more to this if needed.
 *
 * See: https://developers.facebook.com/docs/sharing/webmasters and http://ogp.me/
 */
function skeleton_og_meta_tags() {
    if ( is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post();
    ?>
        <meta name="og:description" content="<?php the_excerpt_rss(); ?>">
        <meta name="og:image" content="<?php echo skeleton_get_thumbnail_src( get_post_thumbnail_id() ); ?>">
    <?php endwhile; endif; elseif ( is_home() ) : ?>
        <meta name="og:description" content="<?php bloginfo( 'description' ); ?>">
    <?php endif;
}
endif;