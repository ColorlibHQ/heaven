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
class Heaven_Contact_Popup extends Widget_Base {

	public function get_name() {
		return 'heaven-contact-popup';
	}

	public function get_title() {
		return __( 'Contact Popup', 'heaven' );
	}

	public function get_icon() {
		return 'eicon-email-field';
	}

	public function get_categories() {
		return [ 'heaven-elements' ];
	}

	protected function _register_controls() {

        
		// ----------------------------------------  Contact Popup content ------------------------------
		$this->start_controls_section(
			'contact_popup_sec',
			[
				'label' => __( 'Contact Popup Section', 'heaven' ),
			]
        );
        
        $this->add_control(
            'contact_left_txt',
            [
                'label'         => esc_html__( 'Contact Left Text', 'heaven' ),
                'description'   => esc_html__('Use <br> tag or press Enter for line break', 'heaven'),
                'type'          => Controls_Manager::WYSIWYG,
                'label_block'   => true,
                'default'       => __( '<h4>Melbourne</h4><p class="right-state">Australia</p><p>324 King Heaven tower, House no, 15 King building Melbourne ,VIC-222, Australia</p><p>Email: infoheaven@gmail.com <br>Phone no: 23113 6456 888</p>', 'heaven' )
            ]
        );
        
        $this->add_control(
            'contact_right_txt',
            [
                'label'         => esc_html__( 'Contact Right Text', 'heaven' ),
                'description'   => esc_html__('Use <br> tag or press Enter for line break', 'heaven'),
                'type'          => Controls_Manager::WYSIWYG,
                'label_block'   => true,
                'default'       => __( '<h5>Call Directly;</h5><h2>(23131 65465 54)</h2><h5>Brand Office</h5><span>324 King Heaven tower, House no, 15 King Melbourne ,VIC-222, Australia</span><br><h5>Working Hours:</h5><p>Monday - Friday / 9.00 PM - 5.00 AM</p>', 'heaven' )
            ]
        );
        
        $this->end_controls_section(); // End about content
        

        /**
         * Style Tab
         * ------------------------------ About Settings ------------------------------
         *
         */        
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
                'selector' => '{{WRAPPER}} .contact_us .contact_us_iner',
            ]
        );

        $this->end_controls_section();


	}

	protected function render() {
        $settings          = $this->get_settings();
        $contact_left_txt  = !empty( $settings['contact_left_txt'] ) ? $settings['contact_left_txt'] : '';	
        $contact_right_txt = !empty( $settings['contact_right_txt'] ) ? $settings['contact_right_txt'] : '';	
        ?>

    <!-- contact us part start-->
    <section class="contact_us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact_us_iner">
                        <div class="row justify-content-around">
                            <div class="col-lg-4">
                                <div class="contact_us_left_text">
                                    <?php
                                        //Heading ==============
                                        if( $contact_left_txt ){
                                            echo wp_kses_post( wpautop( $contact_left_txt ) );
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="contact_us_right_text">
                                    <?php
                                        //Right Text ==============
                                        if( $contact_right_txt ){
                                            echo wp_kses_post( wpautop( $contact_right_txt ) );
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact us part end-->
    <?php

    }

}
