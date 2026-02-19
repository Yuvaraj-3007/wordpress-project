<?php
/**
 * Yuvaraj Theme Functions
 *
 * @package Yuvaraj_Theme
 */

/**
 * Theme setup: register support for features.
 *
 * @return void
 */
function yuvaraj_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );
}
add_action( 'after_setup_theme', 'yuvaraj_theme_setup' );

/**
 * Enqueue theme stylesheets.
 *
 * @return void
 */
function yuvaraj_theme_styles() {
	wp_enqueue_style( 'main-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'yuvaraj_theme_styles' );
