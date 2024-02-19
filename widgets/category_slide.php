<?php
class Elementor_category_slide extends \Elementor\Widget_Base {

	public function get_name() {
		return 'Elementor_category_slide';
	}

	public function get_title() {
		return esc_html__( 'Category Slide', 'gfx' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'Category', 'Slide' ];
	}

	protected function register_controls() {

		

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'order' => 'DESC',
            's' => isset($_GET['s']) ? $_GET['s'] : '',
        );
        $query = new WP_Query($args);

		?>

        <div class="swiper category_wrap">
            <div class="swiper-wrapper">

                <a href="<?= home_url('/');?>" class="swiper-slide">All</a>

                <?php
                    $categories = get_categories();

                    if ($categories) {
                        foreach ($categories as $category) {
                            ?>
                                <a href="<?= home_url('/?category='.$category->slug)?>" class="swiper-slide"><?=  $category->name;?></a>
                            <?php
                        }
                    }
                ?>
            </div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        
        
		<?php
	}
}