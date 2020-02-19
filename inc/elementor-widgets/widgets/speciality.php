<?php
namespace Heavenelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
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
 * Heaven elementor section widget.
 *
 * @since 1.0
 */
class Heaven_Speciality extends Widget_Base {

	public function get_name() {
		return 'heaven-speciality';
	}

	public function get_title() {
		return __( 'Speciality', 'heaven' );
	}

	public function get_icon() {
		return 'eicon-gallery-group';
	}

	public function get_categories() {
		return [ 'heaven-elements' ];
	}

	protected function _register_controls() {

        
		// ----------------------------------------  Speciality content ------------------------------
		$this->start_controls_section(
			'speciality_block',
			[
				'label' => __( 'Speciality', 'heaven' ),
			]
        );
        
        $this->add_control(
            'speciality_type',
            [
                'label'         => esc_html__( 'Select Style', 'heaven' ),
                'type'          => Controls_Manager::SELECT,
                'label_block'   => true,
                'default'       => 'style1',
                'options'       => [
                    'style1'    => 'Style 1',
                    'style2'    => 'Style 2',
                ]
            ]
        );

        $this->add_control(
            'style1_note',
            [
                'label'     => __( 'NOTE: For the "Style 1" item will not show more than 3.', 'heaven' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'speciality_content', [
                'label' => __( 'Create New', 'heaven' ),
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name'  => 'icon',
                        'label' => __( 'Icon', 'heaven' ),
                        'type'  => Controls_Manager::SELECT,
                        'label_block' => false,
                        'default' => 'icon1',
                        'options'   => [
                            'icon1' => 'Icon 1',
                            'icon2' => 'Icon 2',
                            'icon3' => 'Icon 3',
                        ]
                    ],
                    [
                        'name'  => 'title',
                        'label' => __( 'Title', 'heaven' ),
                        'type'  => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => __( 'Inovative', 'heaven' )
                    ],
                    [
                        'name'      => 'short_des',
                        'label'     => __( 'Short Description', 'heaven' ),
                        'type'      => Controls_Manager::TEXTAREA,
                        'default'   => __( 'Living Over He god living Creature that appear place', 'heaven' )
                    ],
                ],
            ]
        );

		$this->end_controls_section(); // End Case Study content
        

        /**
         * Style Tab
         * ------------------------------ About Settings ------------------------------
         *
         */

        // Color Settings ==============================
        $this->start_controls_section(
            'color_sect', [
                'label' => __( 'Color Settings', 'heaven' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'icon_color', [
				'label'     => __( 'Icon Color', 'heaven' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .our_speciality .single_special_part svg path' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .single_page_special_item .single_slide_item svg path' => 'fill: {{VALUE}};',
				],
			]
        );
		$this->add_control(
			'title_color', [
				'label'     => __( 'Title Color', 'heaven' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .our_speciality .single_special_part .single_special_text h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .single_page_special .single_page_special_item h3' => 'color: {{VALUE}};',
				],
			]
        );
		$this->add_control(
			'txt_color', [
				'label'     => __( 'Text Color', 'heaven' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .our_speciality .single_special_part .single_special_text p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .single_page_special .single_page_special_item p' => 'color: {{VALUE}};',
				],
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
		$this->add_control(
			'item_bg_color', [
				'label'     => __( 'Item BG Color', 'heaven' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .our_speciality .single_special_part' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .single_page_special .single_page_special_item .single_slide_item' => 'background-color: {{VALUE}};',
				],
			]
		);
        $this->end_controls_section();


	}

	protected function render() {
        $settings        = $this->get_settings();
        $specialities    = !empty( $settings['speciality_content'] ) ? $settings['speciality_content'] : '';
        $speciality_type = !empty( $settings['speciality_type'] ) ? $settings['speciality_type'] : '';
        if ( $speciality_type == 'style1' ) {
    ?>

    <!-- banner part start-->
    <div class="our_speciality">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if( is_array( $specialities ) && count( $specialities ) > 0 ){
                        $count = 0;
                        foreach ( $specialities as $speciality ) {
                            $icon        = !empty( $speciality['icon'] ) ? $speciality['icon'] : '';
                            $title       = !empty( $speciality['title'] ) ? $speciality['title'] : '';
                            $short_des   = !empty( $speciality['short_des'] ) ? $speciality['short_des'] : '';
                            $count++;
                    ?>
                    <div class="single_special_part border_left">
                        <?php echo get_heaven_svg_icon( $icon )?>
                        <div class="single_special_text">
                            <h3><?php echo esc_html( $title )?></h3>
                            <p><?php echo esc_html( $short_des )?></p>
                        </div>
                    </div>
                    <?php
                            // We'll not show more than 3 items
                            if ( $count >= 3 ) {
                                break;
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- banner part start-->

    <?php
        } else {
            // call load widget script
            $this->load_widget_script();
    ?>

    <!-- single special page item start -->
    <section class="single_page_special">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single_page_special_item owl-carousel">
                        <?php
                        if( is_array( $specialities ) && count( $specialities ) > 0 ){
                            foreach ( $specialities as $speciality ) {
                                $icon        = !empty( $speciality['icon'] ) ? $speciality['icon'] : '';
                                $title       = !empty( $speciality['title'] ) ? $speciality['title'] : '';
                                $short_des   = !empty( $speciality['short_des'] ) ? $speciality['short_des'] : '';
                        ?>
                        <div class="single_slide_item">
                            <?php echo get_heaven_svg_icon( $icon )?>
                            <div class="single_special_text">
                                <h3><?php echo esc_html( $title )?></h3>
                                <p><?php echo esc_html( $short_des )?></p>
                            </div>
                        </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- single special page item end -->

    <?php
        }
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
            });
        })(jQuery);
        </script>
        <?php 
        }
    }

}
