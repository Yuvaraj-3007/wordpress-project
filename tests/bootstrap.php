<?php
/**
 * Bootstrap file for PHPUnit tests
 * Author: Yuvaraj Pandian
 *
 * This file runs BEFORE all tests.
 * It loads WordPress test environment so our tests
 * can use WordPress functions like get_option(), wp_insert_post() etc.
 */

// Load WordPress test library
$wp_tests_dir = getenv('WP_TESTS_DIR') ?: '/tmp/wordpress-tests-lib';

// Load WordPress test functions
require_once $wp_tests_dir . '/includes/functions.php';

/**
 * Load our theme before WordPress loads
 */
function _manually_load_theme() {
    // Tell WordPress to use our custom theme
    add_filter( 'stylesheet', function() { return 'yuvaraj-theme'; } );
    add_filter( 'template',   function() { return 'yuvaraj-theme'; } );

    // Load theme functions.php
    require dirname( __DIR__ ) . '/wp-content/themes/yuvaraj-theme/functions.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_theme' );

// Start WordPress test environment
require $wp_tests_dir . '/includes/bootstrap.php';
