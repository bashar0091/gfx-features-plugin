jQuery(document).ready(function($){

     // grid layout js 
    $('.post_grid_wrapper').masonry({
        itemSelector: '.post_grid_item',
        percentPosition: true
    })

    // beforeAfter js 
    $('.beforeAfter').beforeAfter({
        movable: true,
        clickMove: true,
        position: 50,
        separatorColor: '#fafafa',
        bulletColor: '#fafafa',
    });

    // popup open
    $('.post_grid_item .post_grid_cols').on('click', function(){

        $post_link = $(this).find('.post_link').val();
        $('.post_popup').find('.permalink_href').attr('href',$post_link);

        // 
        $before_img_url = $(this).find('.before_img_url').val();
        $after_img_url = $(this).find('.after_img_url').val();
        $('.post_popup').find('.before_image').attr('src',$before_img_url);
        $('.post_popup').find('.after_image').attr('src',$after_img_url);
        
        // 
        $author_img_url = $(this).find('.author_img_url').val();
        $author_name_val = $(this).find('.author_name_val').val();
        $('.post_popup').find('.popup_author_img').attr('src',$author_img_url);
        $('.post_popup').find('.popup_author_name').text($author_name_val);

        // 
        $previous_post_id = $(this).find('.previous_post_id').val();
        $next_post_id = $(this).find('.next_post_id').val();
        if( $previous_post_id.length <= 0 ) {
            $('.prev_popup').hide();
        }
        if( $next_post_id.length <= 0 ) {
            $('.next_popup').hide();
        }
        $('.post_popup').find('.popup_prev_post_id').val($previous_post_id);
        $('.post_popup').find('.popup_next_post_id').val($next_post_id);

        $('body').addClass('fridge');
        $('.post_popup').addClass('show');

        $post_vieew = $(this).find('.epvc-count').text();
        $('.post_popup').find('.views').text($post_vieew);

        
        // ajax request 
        var main_post_id = $(this).find('.main_post_id').val();
        $.ajax({
            type: 'POST',
            url: formAjax.ajaxurl,
            data: {
                action: 'related_post_request',
                'main_post_id' : main_post_id,
            },
            beforeSend: function() {
               
            },
            success: function(response) {
                try {
                    var posts = JSON.parse(response);
                    
                    $('.related_post_wrap .post_grid_wrapper').remove();
                    // Example of iterating through each post
                    var postHtml = '<div class="post_grid_wrapper">';
                        posts.forEach(function(post) {
                            postHtml += `
                                <article class="post_grid_item related_grid_item">
                                    <div class="post_grid_cols">

                                        <input type="hidden" class="post_link" value="${post.post_link}">

                                        <!--  -->
                                        <input type="hidden" class="before_img_url" value="${post.before_image.url}">
                                        <input type="hidden" class="after_img_url" value="${post.after_image.url}">

                                        <!--  -->
                                        <input type="hidden" class="author_img_url" value="${post.user_profile_image}">
                                        <input type="hidden" class="author_name_val" value="${post.author_name}">

                                        <!--  -->
                                        <img class="featured_image" src="${post.before_image.url}" alt="image">
                                                
                                        <div class="author_info">
                                            <div class="fz0">
                                                <img src="${post.user_profile_image}" alt="author">
                                            </div>
                                            <div>
                                                <p class="author_name">${post.author_name}</p>
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
                            `;
                        });
                    postHtml += '</div>';

                    $('.related_post_wrap').append(postHtml);

                    $('.post_grid_wrapper').masonry({
                        itemSelector: '.post_grid_item',
                        percentPosition: true
                    })

                    // 
                    $('.related_grid_item .post_grid_cols').on('click', function(){

                        $post_link = $(this).find('.post_link').val();
                        $('.post_popup').find('.permalink_href').attr('href',$post_link);

                        // 
                        $before_img_url = $(this).find('.before_img_url').val();
                        $after_img_url = $(this).find('.after_img_url').val();
                        $('.post_popup').find('.before_image').attr('src',$before_img_url);
                        $('.post_popup').find('.after_image').attr('src',$after_img_url);
                        
                        // 
                        $author_img_url = $(this).find('.author_img_url').val();
                        $author_name_val = $(this).find('.author_name_val').val();
                        $('.post_popup').find('.popup_author_img').attr('src',$author_img_url);
                        $('.post_popup').find('.popup_author_name').text($author_name_val);
                    });

                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    }); 

    // next popup
    $('.next_popup').on('click', function(){

        var get_this = $(this);
        
        var popup_next_post_id = get_this.find('.popup_next_post_id').val();

        $.ajax({
            type: 'POST',
            url: formAjax.ajaxurl,
            data: {
                action: 'prev_next_post_request',
                popup_next_post_id : popup_next_post_id,
            },
            beforeSend: function() {
               
            },
            success: function(response) {
                var data = JSON.parse(response);

                $('.post_popup').find('.permalink_href').attr('href',data.post_link);

                $('.post_popup').find('.before_image').attr('src',data.before_image_url);
                $('.post_popup').find('.after_image').attr('src',data.after_image_url);
               
                $('.post_popup').find('.popup_prev_post_id').val(data.previous_post_id);
                $('.post_popup').find('.popup_next_post_id').val(data.next_post_id);
                
                if( $('.popup_prev_post_id').val().length > 0 ) {
                    $('.prev_popup').show();
                } else if( $('.popup_prev_post_id').val().length <= 0 ) {
                    $('.prev_popup').hide();
                }
                if( $('.popup_next_post_id').val().length > 0 ) {
                    $('.next_popup').show();
                } else if( $('.popup_next_post_id').val().length <= 0 ) {
                    $('.next_popup').hide();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });

    });

    // prev popup
    $('.prev_popup').on('click', function(){

        var get_this = $(this);
        
        var popup_next_post_id = get_this.find('.popup_prev_post_id').val();

        $.ajax({
            type: 'POST',
            url: formAjax.ajaxurl,
            data: {
                action: 'prev_next_post_request',
                popup_next_post_id : popup_next_post_id,
            },
            beforeSend: function() {
               
            },
            success: function(response) {
                var data = JSON.parse(response);

                $('.post_popup').find('.permalink_href').attr('href',data.post_link);

                $('.post_popup').find('.before_image').attr('src',data.before_image_url);
                $('.post_popup').find('.after_image').attr('src',data.after_image_url);
               
                $('.post_popup').find('.popup_prev_post_id').val(data.previous_post_id);
                $('.post_popup').find('.popup_next_post_id').val(data.next_post_id);

                if( $('.popup_prev_post_id').val().length > 0 ) {
                    $('.prev_popup').show();
                } else if( $('.popup_prev_post_id').val().length <= 0 ) {
                    $('.prev_popup').hide();
                }
                if( $('.popup_next_post_id').val().length > 0 ) {
                    $('.next_popup').show();
                } else if( $('.popup_next_post_id').val().length <= 0 ) {
                    $('.next_popup').hide();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });

    });

    // popup close
    $('.popup_close').on('click', function(){

        $('.post_popup').find('.before_image').attr('src','');
        $('.post_popup').find('.after_image').attr('src','');

        $('.post_popup').find('.popup_author_img').attr('src','');
        $('.post_popup').find('.popup_author_name').text('');

        $('.related_post_wrap .post_grid_wrapper').remove();

        $('.share-container').removeClass('show');

        $('.prev_popup').show();
        $('.next_popup').show();

        $('body').removeClass('fridge');
        $('.post_popup').removeClass('show');
    }); 

   

    // share button
    $('.share_btn').on('click', function(){
        $(this).parent().find('.share_container_2').toggleClass('show');
        $(this).parent().find('.share-container').toggleClass('show');
    });


    // isotop setup 
    $('.post_grid_wrapper').isotope({
        itemSelector: '.post_grid_item',
        layoutMode: 'masonry'
    });

    $('.category_wrap .swiper-slide').click(function () {
        $('.category_wrap .swiper-slide').removeClass('active');
        $(this).addClass('active');

        var selector = $(this).attr('data-filter');
        $('.post_grid_wrapper').isotope({
            filter: selector
        });
        return false;
    })

});



// swipper js 
const swiper = new Swiper('.swiper', {
slidesPerView: 10,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        1490: {
            slidesPerView: 10,
        },
        1200: {
            slidesPerView: 8,
        },
        915: {
            slidesPerView: 6,
        },
        625: {
            slidesPerView: 4,
        },
        360: {
            slidesPerView: 2,
        },
        1: {
            slidesPerView: 1,
        },
      },
});