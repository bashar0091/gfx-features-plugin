<?php
class Elementor_single_post_layout extends \Elementor\Widget_Base {

	public function get_name() {
		return 'Elementor_single_post_layout';
	}

	public function get_title() {
		return esc_html__( 'Single Post', 'gfx' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'single', 'post' ];
	}

	protected function register_controls() {

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        
        $post_id = get_the_ID();

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
        

        $post_author_id = get_post_field( 'post_author', $post_id );
        $author_name = get_the_author_meta( 'first_name', $post_author_id ) . ' ' .get_the_author_meta( 'last_name', $post_author_id );
        $user_profile_image = wp_get_attachment_url( get_the_author_meta( 'user_profile_image', $post_author_id ) );
		
        // Previous post information
        $previous_post = get_previous_post();
        $previous_post_url = $previous_post ? get_permalink($previous_post) : '';

        // Next post information
        $next_post = get_next_post();
        $next_post_url = $next_post ? get_permalink($next_post) : '';
        ?>
        
        <div class="post_popup post_popup_single">

            <a href="<?= $next_post_url;?>" class="prev_popup single_popup_icon">
                <svg class="__HN4" width="24" height="24" viewBox="0 0 24 24" version="1.1" aria-hidden="false">
                    <desc lang="en-US">Chevron left</desc>
                    <path d="M15.5 18.5 14 20l-8-8 8-8 1.5 1.5L9 12l6.5 6.5Z"></path>
                </svg>
            </a>

            <a href="<?= $previous_post_url;?>" class="next_popup single_popup_icon">
                <svg class="__HN4" width="24" height="24" viewBox="0 0 24 24" version="1.1" aria-hidden="false">
                    <desc lang="en-US">Chevron right</desc>
                    <path d="M8.5 5.5 10 4l8 8-8 8-1.5-1.5L15 12 8.5 5.5Z"></path>
                </svg>
            </a>

            <div class="popup_wrap">
                
                <div class="popup_head">
                    <div class="popup_author author_info">
                        <div class="fz0">
                            <img class="popup_author_img_2" src="<?= $user_profile_image;?>" alt="author">
                        </div>
                        <div>
                            <p class="author_name popup_author_name_2"><?= $author_name;?></p>
                            <p class="author_available">
                                Available For Hire 
                                <svg class="nD8iJ" width="15" height="15" viewBox="0 0 24 24" version="1.1" aria-hidden="false">
                                    <desc lang="en-US">A checkmark inside of a circle</desc>
                                    <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm-1.9 14.7L6 12.6l1.5-1.5 2.6 2.6 6-6.1 1.5 1.5-7.5 7.6z"></path>
                                </svg>
                            </p>
                        </div>
                    </div>

                    <div>
                        <a href="#elementor-action%3Aaction%3Dpopup%3Aopen%26settings%3DeyJpZCI6IjI0MiIsInRvZ2dsZSI6ZmFsc2V9" class="custom_btn1">Contact Me</a>
                    </div>
                </div>

                <div class="beforeAfter beforeAfter_single">
                    <img class="single_before_image" src="<?= $before_image_url;?>" />
                    <img class="single_after_image" src="<?= $after_image_url;?>" />
                </div>

                <div class="popup_view_share">
                    <div>
                        <p>Views</p>
                        <p><?php echo do_shortcode('[epvc_views id="'.$post_id.'"]'); ?></p>
                    </div>

                    <div class="share_wrap">
                        <a href="#!" class="custom_btn2 share_btn">
                            <svg class="XzKLz" width="24" height="24" viewBox="0 0 24 24" version="1.1" aria-hidden="false">
                                <desc lang="en-US">A forward-right arrow</desc>
                                <path d="M13 20v-5.5c-5.556 0-8.222 1-11 5.5C2 13.25 5.222 8.625 13 7.5V2l9 9-9 9Z"></path>
                            </svg>
                            Share
                        </a>

                        <div class="share_container_2">
                            <div class="share-btn">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%2Fgfx%2Fbengal-cat-image-color-change%2F" target="_blank">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-square" class="svg-inline--fa fa-facebook-square" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path
                                            fill="currentColor"
                                            d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.3V327.7h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0 -48-48z"
                                        ></path>
                                    </svg>
                                </a>
                                <a href="https://twitter.com/home?status=Bengal%20cat%20image%20Color%20change%20http%3A%2F%2Flocalhost%2Fgfx%2Fbengal-cat-image-color-change%2F" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
<path d="M 11 4 C 7.134 4 4 7.134 4 11 L 4 39 C 4 42.866 7.134 46 11 46 L 39 46 C 42.866 46 46 42.866 46 39 L 46 11 C 46 7.134 42.866 4 39 4 L 11 4 z M 13.085938 13 L 21.023438 13 L 26.660156 21.009766 L 33.5 13 L 36 13 L 27.789062 22.613281 L 37.914062 37 L 29.978516 37 L 23.4375 27.707031 L 15.5 37 L 13 37 L 22.308594 26.103516 L 13.085938 13 z M 16.914062 15 L 31.021484 35 L 34.085938 35 L 19.978516 15 L 16.914062 15 z"></path>
</svg>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A%2F%2Flocalhost%2Fgfx%2Fbengal-cat-image-color-change%2F&amp;title=Bengal+cat+image+Color+change&amp;summary=Bengal+cat+image+Color+change" target="_blank">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin" class="svg-inline--fa fa-linkedin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path
                                            fill="currentColor"
                                            d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"
                                        ></path>
                                    </svg>
                                </a>
                                <a href="" class="permalink_href" target="_blank">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="link" class="svg-inline--fa fa-link" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path
                                            fill="currentColor"
                                            d="M598.6 41.41C570.1 13.8 534.8 0 498.6 0s-72.36 13.8-99.96 41.41l-43.36 43.36c15.11 8.012 29.47 17.58 41.91 30.02c3.146 3.146 5.898 6.518 8.742 9.838l37.96-37.96C458.5 72.05 477.1 64 498.6 64c20.67 0 40.1 8.047 54.71 22.66c14.61 14.61 22.66 34.04 22.66 54.71s-8.049 40.1-22.66 54.71l-133.3 133.3C405.5 343.1 386 352 365.4 352s-40.1-8.048-54.71-22.66C296 314.7 287.1 295.3 287.1 274.6s8.047-40.1 22.66-54.71L314.2 216.4C312.1 212.5 309.9 208.5 306.7 205.3C298.1 196.7 286.8 192 274.6 192c-11.93 0-23.1 4.664-31.61 12.97c-30.71 53.96-23.63 123.6 22.39 169.6C293 402.2 329.2 416 365.4 416c36.18 0 72.36-13.8 99.96-41.41L598.6 241.3c28.45-28.45 42.24-66.01 41.37-103.3C639.1 102.1 625.4 68.16 598.6 41.41zM234 387.4L196.1 425.3C181.5 439.1 162 448 141.4 448c-20.67 0-40.1-8.047-54.71-22.66c-14.61-14.61-22.66-34.04-22.66-54.71s8.049-40.1 22.66-54.71l133.3-133.3C234.5 168 253.1 160 274.6 160s40.1 8.048 54.71 22.66c14.62 14.61 22.66 34.04 22.66 54.71s-8.047 40.1-22.66 54.71L325.8 295.6c2.094 3.939 4.219 7.895 7.465 11.15C341.9 315.3 353.3 320 365.4 320c11.93 0 23.1-4.664 31.61-12.97c30.71-53.96 23.63-123.6-22.39-169.6C346.1 109.8 310.8 96 274.6 96C238.4 96 202.3 109.8 174.7 137.4L41.41 270.7c-27.6 27.6-41.41 63.78-41.41 99.96c-.0001 36.18 13.8 72.36 41.41 99.97C69.01 498.2 105.2 512 141.4 512c36.18 0 72.36-13.8 99.96-41.41l43.36-43.36c-15.11-8.012-29.47-17.58-41.91-30.02C239.6 394.1 236.9 390.7 234 387.4z"
                                        ></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="popup_related_photo">

                <h3 class="related_title">Related Photos</h3>

                <div class="related_post_wrap_2">
                    <div class="post_grid_wrapper">
                        <?php
                            $main_post_id = $post_id;
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

                            if ($query->have_posts()) {
                                while ($query->have_posts()) {
                                    $query->the_post();

                                    if( get_the_ID() == $main_post_id ) {
                                        continue;
                                    }

                                    $post_author_id = get_post_field( 'post_author', get_the_ID() );
                                    $author_name = get_the_author_meta( 'first_name', $post_author_id ) . ' ' .get_the_author_meta( 'last_name', $post_author_id );
                                    $user_profile_image = wp_get_attachment_url( get_the_author_meta( 'user_profile_image', $post_author_id ) );

                                    // Previous post information
                                    $previous_post = get_previous_post();
                                    $previous_post_id = $previous_post ? $previous_post->ID : '';

                                    // Next post information
                                    $next_post = get_next_post();
                                    $next_post_id = $next_post ? $next_post->ID : '';
                        ?>
                                    <article class="post_grid_item related_grid_item">
                                        <div class="post_grid_cols">

                                        <span class="post_vieew">
                                            <?php echo do_shortcode('[epvc_views id="'.get_the_ID().'"]'); ?>
                                        </span>

                                        <input type="hidden" class="post_link" value="<?= get_the_permalink();?>">

                                        <input type="hidden" class="main_post_id" value="<?= get_the_ID();?>">

                                        <!--  -->
                                        <input type="hidden" class="previous_post_id" value="<?= $next_post_id;?>">
                                        <input type="hidden" class="next_post_id" value="<?= $previous_post_id;?>">

                                            <?php 
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
                                            ?>

                                            <!--  -->
                                            <input type="hidden" class="before_img_url" value="<?= $before_image?>">
                                            <input type="hidden" class="after_img_url" value="<?= $after_image?>">

                                            <!--  -->
                                            <input type="hidden" class="author_img_url" value="<?= $user_profile_image;?>">
                                            <input type="hidden" class="author_name_val" value="<?= $author_name;?>">

                                            <!--  -->
                                            <img class="featured_image" src="<?= $before_image?>" alt="image">
                                                    
                                            <div class="author_info">
                                                <div class="fz0">
                                                    <img src="<?= $user_profile_image;?>" alt="author">
                                                </div>
                                                <div>
                                                    <p class="author_name"><?= $author_name;?></p>
                                                    <p class="author_available">
                                                        Available For Hire 
                                                        <svg class="nD8iJ" width="15" height="15" viewBox="0 0 24 24" version="1.1" aria-hidden="false">
                                                            <desc lang="en-US">A checkmark inside of a circle</desc>
                                                            <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm-1.9 14.7L6 12.6l1.5-1.5 2.6 2.6 6-6.1 1.5 1.5-7.5 7.6z"></path>
                                                        </svg>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>       
                        <?php
                                    wp_reset_postdata();
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>

        </div>


        <div class="post_popup">

            <a href="#!" class="popup_close">
                <svg class="FsJPV" width="24" height="24" viewBox="0 0 24 24" version="1.1" aria-hidden="false">
                    <desc lang="en-US">An X shape</desc>
                    <path d="M19 6.41 17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41Z"></path>
                </svg>
            </a>

            <a href="#!" class="prev_popup">
                <input type="hidden" class="popup_prev_post_id" val="">
                <svg class="__HN4" width="24" height="24" viewBox="0 0 24 24" version="1.1" aria-hidden="false">
                    <desc lang="en-US">Chevron left</desc>
                    <path d="M15.5 18.5 14 20l-8-8 8-8 1.5 1.5L9 12l6.5 6.5Z"></path>
                </svg>
            </a>

            <a href="#!" class="next_popup">
                <input type="hidden" class="popup_next_post_id" val="">
                <svg class="__HN4" width="24" height="24" viewBox="0 0 24 24" version="1.1" aria-hidden="false">
                    <desc lang="en-US">Chevron right</desc>
                    <path d="M8.5 5.5 10 4l8 8-8 8-1.5-1.5L15 12 8.5 5.5Z"></path>
                </svg>
            </a>

            <div class="popup_wrap">
                
                <div class="popup_head">
                    <div class="popup_author author_info">
                        <div class="fz0">
                            <img class="popup_author_img" src="" alt="author">
                        </div>
                        <div>
                            <p class="author_name popup_author_name"></p>
                            <p class="author_available">
                                Available For Hire 
                                <svg class="nD8iJ" width="15" height="15" viewBox="0 0 24 24" version="1.1" aria-hidden="false">
                                    <desc lang="en-US">A checkmark inside of a circle</desc>
                                    <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm-1.9 14.7L6 12.6l1.5-1.5 2.6 2.6 6-6.1 1.5 1.5-7.5 7.6z"></path>
                                </svg>
                            </p>
                        </div>
                    </div>

                    <div>
                        <a href="#elementor-action%3Aaction%3Dpopup%3Aopen%26settings%3DeyJpZCI6IjI0MiIsInRvZ2dsZSI6ZmFsc2V9" class="custom_btn1">Contact Me</a>
                    </div>
                </div>

                <div class="beforeAfter">
                    <img class="before_image" src="" />
                    <img class="after_image" src="" />
                </div>

                <div class="popup_view_share">
                    <div>
                        <p>Views</p>
                        <p class="views"></p>
                    </div>

                    <div class="share_wrap">
                        <a href="#!" class="custom_btn2 share_btn">
                            <svg class="XzKLz" width="24" height="24" viewBox="0 0 24 24" version="1.1" aria-hidden="false">
                                <desc lang="en-US">A forward-right arrow</desc>
                                <path d="M13 20v-5.5c-5.556 0-8.222 1-11 5.5C2 13.25 5.222 8.625 13 7.5V2l9 9-9 9Z"></path>
                            </svg>
                            Share
                        </a>

                        <div class="share-container">
                            <div class="share-btn">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%2Fgfx%2Fbengal-cat-image-color-change%2F" target="_blank">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-square" class="svg-inline--fa fa-facebook-square" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path
                                            fill="currentColor"
                                            d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.3V327.7h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0 -48-48z"
                                        ></path>
                                    </svg>
                                </a>
                                <a href="https://twitter.com/home?status=Bengal%20cat%20image%20Color%20change%20http%3A%2F%2Flocalhost%2Fgfx%2Fbengal-cat-image-color-change%2F" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
<path d="M 11 4 C 7.134 4 4 7.134 4 11 L 4 39 C 4 42.866 7.134 46 11 46 L 39 46 C 42.866 46 46 42.866 46 39 L 46 11 C 46 7.134 42.866 4 39 4 L 11 4 z M 13.085938 13 L 21.023438 13 L 26.660156 21.009766 L 33.5 13 L 36 13 L 27.789062 22.613281 L 37.914062 37 L 29.978516 37 L 23.4375 27.707031 L 15.5 37 L 13 37 L 22.308594 26.103516 L 13.085938 13 z M 16.914062 15 L 31.021484 35 L 34.085938 35 L 19.978516 15 L 16.914062 15 z"></path>
</svg>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A%2F%2Flocalhost%2Fgfx%2Fbengal-cat-image-color-change%2F&amp;title=Bengal+cat+image+Color+change&amp;summary=Bengal+cat+image+Color+change" target="_blank">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin" class="svg-inline--fa fa-linkedin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path
                                            fill="currentColor"
                                            d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"
                                        ></path>
                                    </svg>
                                </a>
                                <a href="" class="permalink_href" target="_blank">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="link" class="svg-inline--fa fa-link" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path
                                            fill="currentColor"
                                            d="M598.6 41.41C570.1 13.8 534.8 0 498.6 0s-72.36 13.8-99.96 41.41l-43.36 43.36c15.11 8.012 29.47 17.58 41.91 30.02c3.146 3.146 5.898 6.518 8.742 9.838l37.96-37.96C458.5 72.05 477.1 64 498.6 64c20.67 0 40.1 8.047 54.71 22.66c14.61 14.61 22.66 34.04 22.66 54.71s-8.049 40.1-22.66 54.71l-133.3 133.3C405.5 343.1 386 352 365.4 352s-40.1-8.048-54.71-22.66C296 314.7 287.1 295.3 287.1 274.6s8.047-40.1 22.66-54.71L314.2 216.4C312.1 212.5 309.9 208.5 306.7 205.3C298.1 196.7 286.8 192 274.6 192c-11.93 0-23.1 4.664-31.61 12.97c-30.71 53.96-23.63 123.6 22.39 169.6C293 402.2 329.2 416 365.4 416c36.18 0 72.36-13.8 99.96-41.41L598.6 241.3c28.45-28.45 42.24-66.01 41.37-103.3C639.1 102.1 625.4 68.16 598.6 41.41zM234 387.4L196.1 425.3C181.5 439.1 162 448 141.4 448c-20.67 0-40.1-8.047-54.71-22.66c-14.61-14.61-22.66-34.04-22.66-54.71s8.049-40.1 22.66-54.71l133.3-133.3C234.5 168 253.1 160 274.6 160s40.1 8.048 54.71 22.66c14.62 14.61 22.66 34.04 22.66 54.71s-8.047 40.1-22.66 54.71L325.8 295.6c2.094 3.939 4.219 7.895 7.465 11.15C341.9 315.3 353.3 320 365.4 320c11.93 0 23.1-4.664 31.61-12.97c30.71-53.96 23.63-123.6-22.39-169.6C346.1 109.8 310.8 96 274.6 96C238.4 96 202.3 109.8 174.7 137.4L41.41 270.7c-27.6 27.6-41.41 63.78-41.41 99.96c-.0001 36.18 13.8 72.36 41.41 99.97C69.01 498.2 105.2 512 141.4 512c36.18 0 72.36-13.8 99.96-41.41l43.36-43.36c-15.11-8.012-29.47-17.58-41.91-30.02C239.6 394.1 236.9 390.7 234 387.4z"
                                        ></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="popup_related_photo">
                    <h3 class="related_title">Related Photos</h3>
                    <div class="related_post_wrap"></div>
                </div>
            </div>

        </div>
        
		<?php
	}
}