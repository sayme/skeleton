<?php
/**
 * Skeleton functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link https://codex.wordpress.org/Plugin_API
 *
 * @package Skeleton
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function theme_setup() {
 
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain( 'skeleton', get_template_directory() . '/languages' );
 
    // Register nav menues to use wp_nav_menu()
    register_nav_menus( array(
        'primary' => __( 'Primary menu', 'skeleton' ),
        'secondary' => __( 'Secondary menu', 'skeleton' ),
        'footer' => __( 'Footer menu', 'skeleton' )
    ) );
 
    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );
    // Add thumb sizes below
    add_image_size( 'rectangle-thumb', 375, 220, true );

    /*
     * Enable support for Post Formats.
     * See https://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
    ) );
 
    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'theme_setup' );

/**
 * Register custom post type
 * 
 * See: https://codex.wordpress.org/Function_Reference/register_post_type
 */
function custom_post_type() {
    register_post_type( 'cpt',
        array(
            'labels' => array(
                'name' => __( 'Custom posts', 'skeleton' ),
                'singular_name' => __( 'Custom post', 'skeleton' )
            ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array( 'slug' => 'cpt' ),
            'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( 'post_tag' )
        )
    );
}
add_action( 'init', 'custom_post_type' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'skeleton' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'widgets_init' );

/**
 * Replace the ugly excerpt ending.
 *
 * @param string the_excerpt_rss output
 * @return string
 */
function replace_excerpt_rss( $output ) {
    return preg_replace( '/\[([^\pL])+\]/', '...', $output );
}
add_filter( 'the_excerpt_rss', 'replace_excerpt_rss' );

/**
 * Add all the scripts here.
 */
function register_global_template_scripts() {
    wp_enqueue_style( 'default-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'register_global_template_scripts' );

// Custom template tags
require get_template_directory() . '/inc/template-tags.php';