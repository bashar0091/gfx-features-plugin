<?php
class Elementor_masonary_post_layout extends \Elementor\Widget_Base {

	public function get_name() {
		return 'Elementor_masonary_post_layout';
	}

	public function get_title() {
		return esc_html__( 'Masonary Post', 'gfx' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'masonary', 'post' ];
	}

	protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'gfx' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'gfx' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Hello world', 'gfx' ),
			]
		);

		$this->end_controls_section();

		// Content Tab End

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'order' => 'DESC',
        );
        $query = new WP_Query($args);

        require('partials/post_layout.php');

		?>

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

                <div class="beforeAfter">
                    <img class="before_image" src="" />
                    <img class="after_image" src="" />
                </div>

                <div class="popup_related_photo">
                    <h3 class="related_title">Related Photos</h3>
                    <?php require('partials/post_layout.php');?>
                </div>
            </div>

        </div>
        
		<?php
	}
}