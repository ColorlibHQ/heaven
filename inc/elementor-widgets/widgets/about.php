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
class Heaven_About extends Widget_Base {

	public function get_name() {
		return 'heaven-about';
	}

	public function get_title() {
		return __( 'About', 'heaven' );
	}

	public function get_icon() {
		return 'eicon-thumbnails-half';
	}

	public function get_categories() {
		return [ 'heaven-elements' ];
	}

	protected function _register_controls() {

        
		// ----------------------------------------  About content ------------------------------
		$this->start_controls_section(
			'about_content',
			[
				'label' => __( 'About Section', 'heaven' ),
			]
        );
        
        $this->add_control(
            'about_title',
            [
                'label'         => esc_html__( 'Title', 'heaven' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => esc_html__( 'About Us', 'heaven' )
            ]
        );

        $this->add_control(
            'content',
            [
                'label'         => esc_html__( 'About Text', 'heaven' ),
                'description'   => esc_html__('Use <br> tag for line break', 'heaven'),
                'type'          => Controls_Manager::TEXTAREA,
                'label_block'   => true,
                'default'       => __( 'Living. Over. He god, living a. Creature that appear place creeping upon. It you said seas every creeping and a life shall unto, years hath seed be called light him cattle. They\'re cattle creepeth void given rule evening stars midst saying light greater', 'heaven' )
            ]
        );
        
        $this->add_control(
            'about_btnlabel',
            [
                'label'         => esc_html__( 'More Text', 'heaven' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => esc_html__( 'learn more', 'heaven' )
            ]
        );

        $this->add_control(
            'about_btnurl',
            [
                'label'         => esc_html__( 'More Url', 'heaven' ),
                'type'          => Controls_Manager::URL,
                'show_external' => false
            ]
        );

        $this->add_control(
			'img_right',
			[
				'label'         => esc_html__( 'Image Right', 'heaven' ),
                'type'          => Controls_Manager::MEDIA,
                'default'       => [
                    'url'       => Utils::get_placeholder_image_src(),
                ]
			]
        );
        
        $this->end_controls_section(); // End about content
        

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
			'title_color', [
				'label'     => __( 'Title Color', 'heaven' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about_part .about_part_text h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_color', [
				'label'     => __( 'Text Color', 'heaven' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about_part .about_part_text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
            'more_txt_color', [
                'label'     => __( 'More Text Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_part .about_part_text .btn_1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'more_txt_hov_color', [
                'label'     => __( 'More Text Hover Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_part .about_part_text .btn_1:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'arrow_bg_color', [
                'label'     => __( 'Arrow BG Color', 'heaven' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_part .about_part_text .btn_1 span' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        

        /**
         * Style Tab
         * ------------------------------ Background Style ------------------------------
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
                'selector' => '{{WRAPPER}} .about_part',
            ]
        );

        $this->end_controls_section();


	}

	protected function render() {
        $settings     = $this->get_settings();
        $title        = !empty( $settings['about_title'] ) ? $settings['about_title'] : '';		
        $content      = !empty( $settings['content'] ) ? $settings['content'] : '';		
        $button_label = !empty( $settings['about_btnlabel'] ) ? $settings['about_btnlabel'] : '';
        $button_url   = !empty( $settings['about_btnurl']['url'] ) ? $settings['about_btnurl']['url'] : '';
        $right_img    = !empty( $settings['img_right']['id'] ) ? wp_get_attachment_image( $settings['img_right']['id'], 'heaven_about_img_1110x741', false, array( 'alt' => 'about image right' ) ) : '';
        ?>

    <!-- about part start-->
    <div class="about_part section_bg">
        <div class="container-fluid">
            <div class="row justify-content-end">
                <div class="col-lg-4 col-md-6">
                    <div class="about_part_text">
                        <h2><?php echo esc_html( $title )?></h2>
                        <p><?php echo esc_html( $content )?></p>

                        <?php
                            // Button =============
                            if( $button_label ){
                                echo '<a class="btn_1" href="'. esc_url( $button_url ) .'">'. esc_html( $button_label ) .' <span>'. get_heaven_svg_icon() .'</span> </a>';
                            }
                        ?>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="about_img">
                        <?php
                            if( $right_img ){
                                echo wp_kses_post( $right_img );
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about part end-->
    <?php

    }

}
