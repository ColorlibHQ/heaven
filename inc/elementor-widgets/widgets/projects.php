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
 * elementor projects section widget.
 *
 * @since 1.0
 */
class Heaven_Projects extends Widget_Base {

	public function get_name() {
		return 'heaven-projects';
	}

	public function get_title() {
		return __( 'Our Project', 'heaven' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'heaven-elements' ];
	}

	protected function _register_controls() {

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
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'our project', 'heaven' )
            ]
        );
		$this->end_controls_section(); 


        // ----------------------------------------  Projects Content ------------------------------
        $this->start_controls_section(
            'menu_tab_sec',
            [
                'label' => __( 'Projects', 'heaven' ),
            ]
        );
		$this->add_control(
			'excerpt_limit', [
				'label'         => esc_html__( 'Excerpt Limit', 'heaven' ),
				'type'          => Controls_Manager::NUMBER,
				'min'           => 4,
                'default'       => 9,
                'max'           => 15
			]
		);
		$this->add_control(
			'portfolio_number', [
				'label'         => esc_html__( 'Project Number', 'heaven' ),
				'type'          => Controls_Manager::NUMBER,
				'min'           => 2,
				'step'          => 2,
				'default'       => 4

			]
		);
		$this->add_control(
			'read_more_txt', [
				'label'         => esc_html__( 'Learn More Text', 'heaven' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'learn more', 'heaven' )

			]
		);

        $this->end_controls_section(); // End projects content

        //------------------------------ Color Settings ------------------------------
        $this->start_controls_section(
            'color_settings', [
                'label' => __( 'Color Settings', 'heaven' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'sec_title_color', [
                'label'     => __( 'Section Title Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project_part .section_tittle h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'client_name_color', [
                'label'     => __( 'Client Name Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project_part .single_project_text .admin_name' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'proj_cat_color', [
                'label'     => __( 'Project Category Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project_part .single_project_text span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'proj_txt_color', [
                'label'     => __( 'Project Text Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project_part .single_project_text p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'proj_more_txt_color', [
                'label'     => __( 'Project More Text Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project_part .single_project_text .btn_1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'proj_more_txt_hov_color', [
                'label'     => __( 'Project More Text Hover Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project_part .single_project_text .btn_1:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'proj_arrow_bg_color', [
                'label'     => __( 'Project Arrow Icon BG Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project_part .single_project_text .btn_1 span' => 'background-color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .project_part',
            ]
        );

        $this->end_controls_section();

	}

	protected function render() {

    // call load widget script
    $this->load_widget_script();

    $settings       = $this->get_settings();
    $sec_heading    = !empty( $settings['sec_heading'] ) ? $settings['sec_heading'] : '';
    $excerpt_limit  = $settings['excerpt_limit'];
    $pNumber        = $settings['portfolio_number'];
    $read_more_txt  = !empty( $settings['read_more_txt'] ) ? $settings['read_more_txt'] : '';
    ?>

    <!-- project_part part start-->
    <section class="project_part padding_bottom">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-4">
                    <div class="section_tittle">
                        <h2><?php echo esc_html($sec_heading)?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="project_slider owl-carousel">
                        <?php
                            //Load Portfolios ==============
                            heaven_portfolio_section( $pNumber, $excerpt_limit, $read_more_txt );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- project_part part end-->
    <?php

    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            $(document).ready(function() {
                // project_slider js code
                var project = $('.project_slider');
                if (project.length) {
                project.owlCarousel({
                    items: 1,
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
                    },
                    768: {
                        nav: true,
                    },
                    992: {
                        nav: true,
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