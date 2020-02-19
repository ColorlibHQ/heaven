<?php
namespace Heavenelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Heaven elementor few words section widget.
 *
 * @since 1.0
 */

class Heaven_Blog extends Widget_Base {

	public function get_name() {
		return 'heaven-blog';
	}

	public function get_title() {
		return __( 'Blog', 'heaven' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'heaven-elements' ];
    }
    
    public function heaven_featured_post_cat(){
        $post_cat_array = [];
        $cat_args = [
            'orderby' => 'name',
            'order'   => 'ASC'
        ];
        $categories = get_categories($cat_args);
        foreach($categories as $category) {
            $args = array(
                'showposts' => 2,
                'category_name' => $category->slug,
                'ignore_sticky_posts'=> 1
            );
            $posts = get_posts($args);
            if ($posts) {
                $post_cat_array[ $category->slug ] = $category->name;
            } else {
                return __( 'Select a different category, because this category have not enough posts.', 'heaven' );
            }
        }
    
        return $post_cat_array;

             
    }

	protected function _register_controls() {

        // Section Heading
        $this->start_controls_section(
            'section_heading',
            [
                'label' => __( 'Section Heading', 'heaven' ),
            ]
        );

        $this->add_control(
            'sec_heading',
            [
                'label'         => esc_html__( 'Heading Text', 'heaven' ),
                'type'          => Controls_Manager::WYSIWYG,
                'default'       => __( '<h2>Blog Post</h2><p>According to the research firm Frost & Sullivan, the estimated size of the orth American used test and measurement equipment market was $446.4</p>', 'heaven' )
            ]
        );
        $this->end_controls_section(); 


        // Blog post settings
        $this->start_controls_section(
            'blog_post_sec',
            [
                'label' => __( 'Blog Post Settings', 'heaven' ),
            ]
        );
        $this->add_control(
            'post_cat',
            [
                'label'         => esc_html__( 'Select Category', 'heaven' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
                'default'       => ['inspiration', 'modern-technology'],
                'options'       => $this->heaven_featured_post_cat()
            ]
        );
		$this->add_control(
			'post_num',
			[
				'label'         => esc_html__( 'Post Item', 'heaven' ),
				'type'          => Controls_Manager::NUMBER,
				'label_block'   => false,
                'default'       => absint(2),
                'min'           => 1,
                'max'           => 6,
			]
		);
		$this->add_control(
			'post_order',
			[
				'label'         => esc_html__( 'Post Order', 'heaven' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_block'   => false,
				'label_on'      => 'ASC',
				'label_off'     => 'DESC',
                'default'       => 'yes',
                'options'       => [
                    'no'        => 'ASC',
                    'yes'       => 'DESC'
                ]
			]
        );
        $this->add_control(
			'post_excerpt',
			[
				'label'         => esc_html__( 'Post Excerpt', 'heaven' ),
				'type'          => Controls_Manager::NUMBER,
				'label_block'   => false,
                'default'       => absint(40),
                'min'           => 30,
                'max'           => 60,
			]
		);

        $this->end_controls_section(); // End few words content


        /**
         * Style Tab
         * ------------------------------ Background Style ------------------------------
         *
         */

        // Heading Style ==============================
        $this->start_controls_section(
            'color_sect', [
                'label' => __( 'Color Settings', 'heaven' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_secttitle', [
                'label'     => __( 'Section Title Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog_part .section_tittle h2' => 'color: {{VALUE}};',
                ],
            ]
        );  
        $this->add_control(
            'color_sec_sub_title', [
                'label'     => __( 'Section Sub Title Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog_part .section_tittle p' => 'color: {{VALUE}};',
                ],
            ]
        );  

        $this->add_control(
            'item_color_sett_sep',
            [
                'label'     => __( 'Items Color Settings', 'heaven' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'blog_btn_bg_color', [
                'label'     => __( 'Blog button bg color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog_part .owl-next' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );  
        $this->add_control(
            'blog_date_color', [
                'label'     => __( 'Blog date color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog_part .single_project_text .single_project_tittle span' => 'color: {{VALUE}};',
                ],
            ]
        );  

        $this->end_controls_section();


        // Background Style ==============================
        $this->start_controls_section(
            'section_bg', [
                'label' => __( 'Style Background', 'heaven' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'section_bgheading',
            [
                'label'     => __( 'Background Settings', 'heaven' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'sectionbg',
                'label' => __( 'Background', 'heaven' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .blog_part',
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        
    // call load widget script
    $this->load_widget_script();

    $settings      = $this->get_settings();
    $sec_heading   = !empty( $settings['sec_heading'] ) ? $settings['sec_heading'] : '';
    $post_num      = !empty( $settings['post_num'] ) ? $settings['post_num'] : '';
    $excerpt_limit = !empty( $settings['post_excerpt'] ) ? $settings['post_excerpt'] : '';
    $post_cat      = !empty( $settings['post_cat'] ) ? $settings['post_cat'] : '';
    $post_order    = !empty( $settings['post_order'] ) ? $settings['post_order'] : '';
    $post_order    = $post_order == 'yes' ? 'DESC' : 'ASC';
    ?>

    <!-- blog part start-->
    <section class="blog_part">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7">
                    <div class="section_tittle">
                        <?php
                            //Heading ==============
                            if( $sec_heading ){
                                echo wp_kses_post( wpautop( $sec_heading ) );
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog_post_slider owl-carousel">
                        <?php
                            if( function_exists( 'heaven_latest_blog' ) ) {
                                heaven_latest_blog( $post_num, $post_cat, $post_order, $excerpt_limit );
                            }
                        ?>
                    </div>
                    <div class="slider-counter"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog part end-->
    <?php
    }
    
    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            $(document).ready(function() {
                // blog_slider js code
                var single_page = $('.single_page_special_item');
                if (single_page.length) {
                single_page.owlCarousel({
                    items: 4,
                    loop: true,
                    dots: false,
                    autoplay: true,
                    autoplayHoverPause: true,
                    autoplayTimeout: 5000,
                    nav: true,
                    smartSpeed: 2000,
                    navText: [
                    '<i class="flaticon-left-arrow"></i>',
                    '<i class="flaticon-right-arrow"></i>'

                    ],
                    responsive: {
                    0: {
                        nav: false,
                        items: 1
                    },
                    576:{
                        items: 1
                    },
                    768: {
                        nav: true,
                        items: 2
                    },
                    992: {
                        nav: true,
                        items: 3
                    },
                    1200: {
                        nav: true,
                        items: 3
                    }
                    }
                });
                }


                $('.blog_post_slider').on('initialized.owl.carousel changed.owl.carousel', function (e) {
                if (!e.namespace) {
                    return;
                }
                var carousel = e.relatedTarget;
                $('.slider-counter').text(carousel.relative(carousel.current()) + 1 + '/' + carousel.items().length);
                }).owlCarousel({
                items: 1,
                loop: true,
                dots: false,
                autoplay: true,
                autoplayHoverPause: true,
                autoplayTimeout: 5000,
                nav: true,
                smartSpeed: 2000,
                navText: [
                    '',
                    'NEXT'


                ]
                });
            });
        })(jQuery);
        </script>
        <?php 
        }
    }
}