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
 * Heaven elementor Team Member section widget.
 *
 * @since 1.0
 */
class Heaven_Services extends Widget_Base {

	public function get_name() {
		return 'heaven-services';
	}

	public function get_title() {
		return __( 'Services', 'heaven' );
	}

	public function get_icon() {
		return 'eicon-info-box';
	}

	public function get_categories() {
		return [ 'heaven-elements' ];
	}

	protected function _register_controls() {
        
		// ----------------------------------------   Services content ------------------------------
		$this->start_controls_section(
			'services_block',
			[
				'label' => __( 'Services', 'heaven' ),
			]
        );

        $this->add_control(
			'section_title', [
				'label'         => esc_html__( 'Section Title', 'heaven' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'our service', 'heaven' )
			]
		);
        
		$this->add_control(
            'services_content', [
                'label' => __( 'Create Service', 'heaven' ),
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ serv_title }}}',
                'fields' => [
                    [
                        'name'  => 'serv_title',
                        'label' => __( 'Service Title', 'heaven' ),
                        'type'  => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => __( 'Home Decor', 'heaven' )
                    ],
                    [
                        'name'      => 'serv_desc',
                        'label'     => __( 'Service Text', 'heaven' ),
                        'type'      => Controls_Manager::TEXTAREA,
                        'default'   => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum', 'heaven' )
                    ],
                    [
                        'name'      => 'serv_img',
                        'label'     => __( 'Service Image', 'heaven' ),
                        'type'      => Controls_Manager::MEDIA,
                    ]
                ],
            ]
        );

		$this->end_controls_section(); // End Services content

        /**
         * Style Tab
         * ------------------------------ Style Tab Content ------------------------------
         *
         */

        // Single Service Color Settings ==============================
        $this->start_controls_section(
            'serv_color_sett', [
                'label' => __( 'Service Color Settings', 'heaven' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_title_color', [
                'label'     => __( 'Section Title Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service_part .section_tittle h2' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        $this->add_control(
            'sing_item_title_color', [
                'label'     => __( 'Single Item Title Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service_part .service_text h3' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        $this->add_control(
            'sing_item_txt_color', [
                'label'     => __( 'Single Item Text Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service_part .service_text p' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        $this->add_control(
            'sing_item_border_color', [
                'label'     => __( 'Single Item Border Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service_part .service_text' => 'border-color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .service_part',
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {

    // call load widget script
    $this->load_widget_script();
    
    $settings    = $this->get_settings();
    $section_title = !empty( $settings['section_title'] ) ? $settings['section_title'] : '';
    $services  = !empty( $settings['services_content'] ) ? $settings['services_content'] : '';
    ?>

    <!-- service part start-->
    <section class="service_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section_tittle">
                        <h2><?php echo esc_html( $section_title )?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="service_slider owl-carousel">
                    <?php
                        if( is_array( $services ) && count( $services ) > 0 ){
                            $count = 0;
                            foreach ( $services as $service ) {
                                $service_title = !empty( $service['serv_title'] ) ? $service['serv_title'] : '';
                                $service_desc  = !empty( $service['serv_desc'] ) ? $service['serv_desc'] : '';
                                $serv_img      = !empty( $service['serv_img']['id'] ) ? wp_get_attachment_image( $service['serv_img']['id'], 'heaven_service_image_540x628', false, array( 'alt' => 'service image' ) ) : '';
                                $count++;
                        ?>
                        
                        <?php if ( $count % 2 != 0 ) { ?>
                            <div class="single_service_slide">
                                <div class="row justify-content-end align-items-center single_service">
                                    <div class="col-lg-6 col-md-6">
                                        <?php
                                            if( $serv_img ){
                                                echo wp_kses_post( $serv_img );
                                            }
                                        ?>
                                    </div>
                                    <div class="col-lg-5 col-md-6">
                                        <div class="service_text">
                                            <h3><?php echo esc_html( $service_title )?></h3>
                                            <p><?php echo esc_html( $service_desc )?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="row align-items-center mt_less_115 single_service">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="service_text">
                                            <h3><?php echo esc_html( $service_title )?></h3>
                                            <p><?php echo esc_html( $service_desc )?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <?php
                                            if( $serv_img ){
                                                echo wp_kses_post( $serv_img );
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service part end-->
    <?php
    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            $(document).ready(function() {
                // service_slider js code
                var service = $('.service_slider');
                if (service.length) {
                service.owlCarousel({
                    items: 1,
                    loop: true,
                    dots: false,
                    autoplay: true,
                    autoplayHoverPause: true,
                    autoplayTimeout: 5000,
                    nav: true,
                    smartSpeed: 2000,
                    navText: [
                    '<i class="ti-angle-left"></i>',
                    '<i class="ti-angle-right"></i>'
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


