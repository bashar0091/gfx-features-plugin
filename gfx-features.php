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
    wp_enqueue_style('customd-style', plugin_dir_url(__FILE__) . 'assets/css/custom.css', '', '1.0.0', '');

    // js file 
    wp_enqueue_script('masonry-script', plugin_dir_url(__FILE__) . 'assets/js/masonry.pkgd.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('beforeafter-script', plugin_dir_url(__FILE__) . 'assets/js/beforeafter.jquery-1.0.0.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('custom-script', plugin_dir_url(__FILE__) . 'assets/js/custom.js', array('jquery'), '1.0.0', true);

    // Ajax Request URL
    wp_localize_script('custom-script', 'formAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'gfx_enqueue_scripts');



// register elementor widgets 
function register_gfx_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/masonary_post_layout.php' );

	$widgets_manager->register( new \Elementor_masonary_post_layout() );

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

                $before_image_url = wp_get_attachment_url(get_post_meta($post_id, 'before_image', true));
                $after_image_url = wp_get_attachment_url(get_post_meta($post_id, 'after_image', true));
                
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
                );

                echo json_encode($response);
            }
            wp_reset_postdata();
        }
    }
    
    wp_die();
}