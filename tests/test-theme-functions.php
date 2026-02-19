<?php
/**
 * Theme Functions Tests
 * Author: Yuvaraj Pandian
 * Tool: PHPUnit + WP_UnitTestCase
 *
 * Tests for yuvaraj-theme functions.php
 * Like app.test.js but for WordPress PHP code
 */

class ThemeFunctionsTest extends WP_UnitTestCase {

    // ─────────────────────────────────────────
    // TEST 1: Theme is Active
    // ─────────────────────────────────────────
    public function test_theme_is_active() {
        // Check our custom theme is loaded
        $theme = wp_get_theme();
        $this->assertEquals( 'Yuvaraj Theme', $theme->get('Name') );
    }

    // ─────────────────────────────────────────
    // TEST 2: Theme Supports Title Tag
    // ─────────────────────────────────────────
    public function test_theme_supports_title_tag() {
        // Check theme has title-tag support enabled
        $this->assertTrue( current_theme_supports('title-tag') );
    }

    // ─────────────────────────────────────────
    // TEST 3: Theme Supports Post Thumbnails
    // ─────────────────────────────────────────
    public function test_theme_supports_thumbnails() {
        // Check theme supports featured images
        $this->assertTrue( current_theme_supports('post-thumbnails') );
    }

    // ─────────────────────────────────────────
    // TEST 4: Theme Supports Menus
    // ─────────────────────────────────────────
    public function test_theme_supports_menus() {
        // Check theme supports navigation menus
        $this->assertTrue( current_theme_supports('menus') );
    }

    // ─────────────────────────────────────────
    // TEST 5: Create a Post and Retrieve it
    // ─────────────────────────────────────────
    public function test_create_and_get_post() {
        // Create a test post
        $post_id = wp_insert_post([
            'post_title'   => 'DevOps Test Post',
            'post_content' => 'This is a test post by Yuvaraj',
            'post_status'  => 'publish',
            'post_type'    => 'post',
        ]);

        // Check post was created
        $this->assertGreaterThan( 0, $post_id );

        // Retrieve the post and check title
        $post = get_post( $post_id );
        $this->assertEquals( 'DevOps Test Post', $post->post_title );
    }

    // ─────────────────────────────────────────
    // TEST 6: Post Has Correct Content
    // ─────────────────────────────────────────
    public function test_post_content() {
        // Create post with content
        $post_id = wp_insert_post([
            'post_title'   => 'Content Test',
            'post_content' => 'Hello from Yuvaraj Pandian',
            'post_status'  => 'publish',
        ]);

        $post = get_post( $post_id );
        $this->assertEquals( 'Hello from Yuvaraj Pandian', $post->post_content );
    }

    // ─────────────────────────────────────────
    // TEST 7: WordPress Options Work
    // ─────────────────────────────────────────
    public function test_wordpress_options() {
        // Save a value to WordPress options table
        update_option( 'yuvaraj_test_option', 'devops2024' );

        // Retrieve and check
        $value = get_option( 'yuvaraj_test_option' );
        $this->assertEquals( 'devops2024', $value );
    }

    // ─────────────────────────────────────────
    // TEST 8: Delete Post Works
    // ─────────────────────────────────────────
    public function test_delete_post() {
        // Create a post
        $post_id = wp_insert_post([
            'post_title'  => 'Delete Me',
            'post_status' => 'publish',
        ]);

        // Delete the post
        wp_delete_post( $post_id, true );

        // Check post no longer exists
        $post = get_post( $post_id );
        $this->assertNull( $post );
    }

    // ─────────────────────────────────────────
    // TEST 9: User Creation Works
    // ─────────────────────────────────────────
    public function test_create_user() {
        // Create a test user
        $user_id = wp_create_user(
            'testuser',
            'testpass123',
            'testuser@yuvaraj.com'
        );

        // Check user was created
        $this->assertGreaterThan( 0, $user_id );

        // Check user data
        $user = get_user_by( 'id', $user_id );
        $this->assertEquals( 'testuser', $user->user_login );
    }

    // ─────────────────────────────────────────
    // TEST 10: Stylesheet is Enqueued
    // ─────────────────────────────────────────
    public function test_stylesheet_enqueued() {
        // Run the wp_enqueue_scripts action
        do_action( 'wp_enqueue_scripts' );

        // Check our main stylesheet is registered
        $this->assertTrue( wp_style_is( 'main-style', 'registered' ) );
    }
}
