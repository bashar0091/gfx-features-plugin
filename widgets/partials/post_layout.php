<div class="post_grid_wrapper">
        <?php
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    
                    $query->the_post();

                    $before_image = get_field('before_image');
                    $after_image = get_field('after_image');

                    $post_author_id = get_post_field( 'post_author', get_the_ID() );
                    $author_first_name = get_the_author_meta( 'first_name', $post_author_id );
                    $author_last_name = get_the_author_meta( 'last_name', $post_author_id );
                    $user_profile_image = get_the_author_meta( 'user_profile_image', $post_author_id );

                    
                    // Previous post information
                    $previous_post = get_previous_post();
                    $previous_post_id = $previous_post ? $previous_post->ID : '';

                    // Next post information
                    $next_post = get_next_post();
                    $next_post_id = $next_post ? $next_post->ID : '';
                    
                ?>
                    <article class="post_grid_item">
                        <div class="post_grid_cols">

                            <input type="hidden" class="previous_post_id" value="<?= $next_post_id;?>">
                            <input type="hidden" class="next_post_id" value="<?= $previous_post_id;?>">
                            
                            <!--  -->
                            <input type="hidden" class="before_img_url" value="<?= esc_url($before_image['url']);?>">
                            <input type="hidden" class="after_img_url" value="<?= esc_url($after_image['url']);?>">

                            <!--  -->
                            <input type="hidden" class="author_img_url" value="<?= wp_get_attachment_url($user_profile_image);?>">
                            <input type="hidden" class="author_name_val" value="<?=  $author_first_name . " " . $author_last_name;?>">

                            <!--  -->
                            <img class="featured_image" src="<?= esc_url($before_image['url']);?>" alt="image">
                                    
                            <div class="author_info">
                                <div class="fz0">
                                    <img src="<?= wp_get_attachment_url($user_profile_image);?>" alt="author">
                                </div>
                                <div>
                                    <p class="author_name"><?=  $author_first_name . " " . $author_last_name;?></p>
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
                }
                wp_reset_postdata();
            } else {
            ?>
                <h2 class="no_found">No Image is Found</h2>
            <?php
            }
        ?>
    </div>