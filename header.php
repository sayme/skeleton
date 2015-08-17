<?php
/**
 * The template for displaying the header
 *
 * @package Skeleton
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title( ' - ', true, 'right' ); ?></title>

    <?php og_meta_tags(); ?>

    <?php wp_head(); ?>
</head>
<body>
    
    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => '' ) ); ?>