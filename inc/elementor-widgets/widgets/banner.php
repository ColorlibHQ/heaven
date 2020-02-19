<?php
namespace Heavenelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;  
}


/**
 *
 * Heaven elementor about us section widget.
 *
 * @since 1.0
 */
class Heaven_Banner extends Widget_Base {

	public function get_name() {
		return 'heaven-banner';
	}

	public function get_title() {
		return __( 'Banner', 'heaven' );
	}

	public function get_icon() {
		return 'eicon-banner';
	}

	public function get_categories() {
		return [ 'heaven-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  content ------------------------------
        $this->start_controls_section(
			'slides_block',
			[
				'label' => __( 'Sliders', 'heaven' ),
			]
		);
		$this->add_control(
            'slides_content', [
                'label' => __( 'Create New', 'heaven' ),
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name'  => 'title',
                        'label' => __( 'Slide Title', 'heaven' ),
                        'type'  => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => __( 'ARCHITECTURE + DESIGN', 'heaven' )
                    ],
                    [
                        'name'      => 'slide_big_title',
                        'label'     => __( 'Slide Big Title', 'heaven' ),
                        'type'      => Controls_Manager::TEXTAREA,
                        'default'   => __( 'HEAVEN X LEATEST PROJECT', 'heaven' )
                    ],
                    [
                        'name'      => 'slide_short_brief',
                        'label'     => __( 'Slide Short Brief', 'heaven' ),
                        'type'      => Controls_Manager::TEXTAREA,
                        'default'   => __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'heaven' )
                    ],
                    [
                        'name'      => 'slide_more_txt',
                        'label'     => __( 'Slide More Text', 'heaven' ),
                        'type'      => Controls_Manager::TEXT,
                        'default'   => __( 'learn more', 'heaven' )
                    ],
                    [
                        'name'      => 'slide_more_url',
                        'label'     => __( 'Slide More URL', 'heaven' ),
                        'type'      => Controls_Manager::URL,
                        'show_external' => false,
                        'default'   => [
                            'url'   => '#',
                        ]
                    ],
                ],
            ]
        );

		$this->end_controls_section(); // End Case Study content


        /**
         * Style Tab
         * ------------------------------ Banner Style ------------------------------
         *
         */

        // Heading Style ==============================
        $this->start_controls_section(
            'color_sect', [
                'label' => __( 'Banner Text Style', 'heaven' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ban_title_color', [
                'label'     => __( 'Banner Title Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner_part .banner_text h5' => 'color: {{VALUE}};',
                ],
            ]
        );    
        $this->add_control(
            'ban_big_title_color', [
                'label'     => __( 'Banner Big Title Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner_part .banner_text h1' => 'color: {{VALUE}};',
                ],
            ]
        );    
        $this->add_control(
            'ban_txt_color', [
                'label'     => __( 'Banner Text Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner_part .banner_text p' => 'color: {{VALUE}};',
                ],
            ]
        );    
        $this->add_control(
            'more_txt_color', [
                'label'     => __( 'More Text Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner_part .banner_text .btn_1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'more_txt_hov_color', [
                'label'     => __( 'More Text Hover Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner_part .banner_text .btn_1:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'arrow_bg_color', [
                'label'     => __( 'Arrow BG Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_1 span' => 'background-color: {{VALUE}};',
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
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'sectionbg',
                'label' => __( 'Background', 'heaven' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .banner_part',
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings();

        // call load widget script
        $this->load_widget_script();
        
        $slides = !empty( $settings['slides_content'] ) ? $settings['slides_content'] : '';
    ?>

    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="banner_text">
                        <?php
                        if( is_array( $slides ) && count( $slides ) > 0 ){
                            foreach ( $slides as $slide ) {
                                $title        = !empty( $slide['title'] ) ? $slide['title'] : '';
                                $big_title    = !empty( $slide['slide_big_title'] ) ? $slide['slide_big_title'] : '';
                                $short_brief  = !empty( $slide['slide_short_brief'] ) ? $slide['slide_short_brief'] : '';
                                $more_txt     = !empty( $slide['slide_more_txt'] ) ? $slide['slide_more_txt'] : '';
                                $more_link    = !empty( $slide['slide_more_link']['url'] ) ? $slide['slide_more_link']['url'] : '';
                        ?>
                        <div class="banner_text_iner">
                            <h5><?php echo esc_html( $title )?></h5>
                            <h1><?php echo esc_html( $big_title )?></h1>
                            <p><?php echo esc_html( $short_brief )?></p>
                            <div class="banner_btn">
                                <a href="<?php echo esc_url( $more_link )?>" class="btn_1"><?php echo esc_html( $more_txt )?> 
                                    <span><?php echo get_heaven_svg_icon()?></span>
                                </a>
                            </div>
                        </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="nav next"><a href="#"><span class="flaticon-left-arrow"></span></a></div>
                    <div class="nav prev"><a href="#"><span class="flaticon-right-arrow"></span></a></div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->   
    <?php
    }
	
    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            $(document).ready(function() {
                var banner_slides = $('.banner_text');
                if (banner_slides.length) {
                    $('.banner_text').slick({
                        vertical:true,
                        verticalSwiping:true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: true,
                        arrows: true,
                        autoplaySpeed: 3000,
                        pauseOnHover: true,
                        pauseOnHover: true,
                        touchMove: true,
                        verticalSwiping: true,
                        prevArrow: $('.prev'),
                        nextArrow: $('.next'),
                    });
                }
            });
        })(jQuery);
        </script>
        <?php 
        }
    }
	
}


