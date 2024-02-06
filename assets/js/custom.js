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

        $('.prev_popup').show();
        $('.next_popup').show();

        $('body').removeClass('fridge');
        $('.post_popup').removeClass('show');
    }); 

});