<?php
/**
 * Plugin Name: GFX Features
 * Description: 
 * Version:     1.0.0
 * Author:      dev bucks
 * Author URI: 
 * Text Domain: gfx
 */


/**
 * Require All CSS, JS Files Here
 */
function gfx_enqueue_scripts() {

    // css file 
    wp_enqueue_style('customd-style', plugin_dir_url(__FILE__) . 'assets/css/custom.css', false, time(), '');

    // js file 
    wp_enqueue_script('masonry-script', plugin_dir_url(__FILE__) . 'assets/js/masonry.pkgd.min.js', array('jquery'), time(), true);
    wp_enqueue_script('beforeafter-script', plugin_dir_url(__FILE__) . 'assets/js/beforeafter.jquery-1.0.0.min.js', array('jquery'), time(), true);
    wp_enqueue_script('isotope-script', 'https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js', array('jquery'), time(), true);
    wp_enqueue_script('swiper-script', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array('jquery'), time(), true);
    wp_enqueue_script('custom-script', plugin_dir_url(__FILE__) . 'assets/js/custom.js', array('jquery'), time(), true);

    // Ajax Request URL
    wp_localize_script('custom-script', 'formAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'gfx_enqueue_scripts');



// register elementor widgets 
function register_gfx_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/masonary_post_layout.php' );
	require_once( __DIR__ . '/widgets/single_post_layout.php' );
    require_once( __DIR__ . '/widgets/category_slide.php' );

	$widgets_manager->register( new \Elementor_masonary_post_layout() );
	$widgets_manager->register( new \Elementor_single_post_layout() );
    $widgets_manager->register( new \Elementor_category_slide() );

}
add_action( 'elementor/widgets/register', 'register_gfx_widget' );


/**
 * prev_next_post_request
 */
add_action('wp_ajax_prev_next_post_request', 'prev_next_post_request_callback');
add_action('wp_ajax_nopriv_prev_next_post_request', 'prev_next_post_request_callback');

function prev_next_post_request_callback() { 
    if(isset($_POST['popup_next_post_id'])) {
        $post_id = intval($_POST['popup_next_post_id']);
        
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 1,
            'post__in' => array($post_id),
        );
        $query = new WP_Query($args);
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $before_image_url = '';
                if( !empty(get_post_meta($post_id, 'before_image_upload_url', true)) ) {
                    $before_image_url = get_post_meta($post_id, 'before_image_upload_url', true);
                } else if( !empty(wp_get_attachment_url(get_post_meta($post_id, 'before_image', true))) ) {
                    $before_image_url = wp_get_attachment_url(get_post_meta($post_id, 'before_image', true));
                }

                $after_image_url = '';
                if( !empty(get_post_meta($post_id, 'after_image_upload_url', true)) ) {
                    $after_image_url = get_post_meta($post_id, 'after_image_upload_url', true);
                } else if( !empty(wp_get_attachment_url(get_post_meta($post_id, 'after_image', true))) ) {
                    $after_image_url = wp_get_attachment_url(get_post_meta($post_id, 'after_image', true));
                }
                
                // Previous post information
                $previous_post = get_previous_post();
                $previous_post_id = $previous_post ? $previous_post->ID : '';

                // Next post information
                $next_post = get_next_post();
                $next_post_id = $next_post ? $next_post->ID : '';

                $response = array(
                    'before_image_url' => $before_image_url,
                    'after_image_url' => $after_image_url,
                    'previous_post_id' => $next_post_id,
                    'next_post_id' => $previous_post_id,
                    'post_link' => get_the_permalink(),
                );

                echo json_encode($response);
            }
            wp_reset_postdata();
        }
    }
    
    wp_die();
}



/**
 * related_post_request
 */
add_action('wp_ajax_related_post_request', 'related_post_request_callback');
add_action('wp_ajax_nopriv_related_post_request', 'related_post_request_callback');

function related_post_request_callback() { 
    if( isset($_POST['main_post_id']) ) {

        $main_post_id = $_POST['main_post_id'];
    
        // Get category slug from the main post ID
        $categories = get_the_category($main_post_id);
        $category_slugs = array();
        foreach ($categories as $category) {
            $category_slugs[] = $category->slug;
        }
    
        // Query posts by category slug
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'category_name' => implode(',', $category_slugs),
        );
        $query = new WP_Query($args);
    
        $response = array(); // Initialize response array
    
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
    
                if( get_the_ID() == $main_post_id ) {
                    continue;
                }

                $post_author_id = get_post_field( 'post_author', get_the_ID() );
                $author_name = get_the_author_meta( 'first_name', $post_author_id ) . ' ' .get_the_author_meta( 'last_name', $post_author_id );
                $user_profile_image = wp_get_attachment_url( get_the_author_meta( 'user_profile_image', $post_author_id ) );

                $before_image = '';
                if( get_field('before_image_upload_url') ) {
                    $before_image = get_field('before_image_upload_url');
                } else if( !empty(get_field('before_image')) ) {
                    $before_image = get_field('before_image')['url'];
                }
                
                $after_image = '';
                if( get_field('after_image_upload_url') ) {
                    $after_image = get_field('after_image_upload_url');
                } else if( !empty(get_field('after_image')))  {
                    $after_image = get_field('after_image')['url'];
                }
                
                // Add post data to response array
                $response[] = array(
                    'before_image' => $before_image,
                    'after_image' => $after_image,
                    'author_name' => $author_name,
                    'user_profile_image' => $user_profile_image,
                    'post_link' => get_the_permalink(),
                );
            }
            wp_reset_postdata();
        }

        // Encode response array as JSON and send
        echo json_encode($response);
    }    

    wp_die();
}