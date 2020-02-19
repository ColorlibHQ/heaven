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
class Heaven_Service_About extends Widget_Base {

	public function get_name() {
		return 'heaven-service-about';
	}

	public function get_title() {
		return __( 'Service About', 'heaven' );
	}

	public function get_icon() {
		return 'eicon-sitemap';
	}

	public function get_categories() {
		return [ 'heaven-elements' ];
	}

	protected function _register_controls() {

        
		// ----------------------------------------  Service About content ------------------------------
		$this->start_controls_section(
			'service_about_sec',
			[
				'label' => __( 'Service About Content Section', 'heaven' ),
			]
        );
        
        $this->add_control(
            'ser_about_title',
            [
                'label'         => esc_html__( 'Service About Title', 'heaven' ),
                'description'   => esc_html__('Use <br> tag or press Enter for line break', 'heaven'),
                'type'          => Controls_Manager::WYSIWYG,
                'label_block'   => true,
                'default'       => __( '<h1>Home Decor Tips</h1><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo</p>', 'heaven' )
            ]
        );
        
        $this->add_control(
			'placehold_img',
			[
				'label'         => esc_html__( 'Video Placeholder Image', 'heaven' ),
                'type'          => Controls_Manager::MEDIA,
                'default'       => [
                    'url'       => Utils::get_placeholder_image_src(),
                ]
			]
        );

        $this->add_control(
			'vid_url',
			[
				'label'         => esc_html__( 'Popup Video URL', 'heaven' ),
                'type'          => Controls_Manager::URL,
                'default'       => [
                    'url'       => 'https://www.youtube.com/watch?v=pBFQdxA-apI'
                ]
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
			'title_color', [
				'label'     => __( 'Title Color', 'heaven' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .home_tips h1' => 'color: {{VALUE}};',
				],
			]
        );

        $this->add_control(
			'txt_color', [
				'label'     => __( 'Text Color', 'heaven' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .home_tips p' => 'color: {{VALUE}};',
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
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'sectionbg',
                'label' => __( 'Background', 'heaven' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .home_tips',
            ]
        );

        $this->end_controls_section();


	}

	protected function render() {
        $settings      = $this->get_settings();
        $sec_title     = !empty( $settings['ser_about_title'] ) ? $settings['ser_about_title'] : '';	
        $vid_url       = !empty( $settings['vid_url']['url'] ) ? $settings['vid_url']['url'] : '';
        $placehold_img = !empty( $settings['placehold_img']['id'] ) ? wp_get_attachment_image( $settings['placehold_img']['id'], 'heaven_about_service_img_750x447', false, array( 'alt' => 'popup video placeholder image' ) ) : '';
        ?>

    <!-- home tips start-->
    <section class="home_tips padding_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="home_tips_text text-center">
                        <?php
                            //Heading ==============
                            if( $sec_title ){
                                echo wp_kses_post( wpautop( $sec_title ) );
                            }
                        ?>
                    </div>
                    <div class="home_tips_video_popup">
                        <?php
                            if( $placehold_img ){
                                echo wp_kses_post( $placehold_img );
                            }
                        ?>
                        <div class="extends_video">
                            <div class="intro_video_iner text-center d-flex align-items-center">
                                <div class="intro_video_icon">
                                    <a id="play-video_1" class="video-play-button popup-youtube"
                                        href="<?php echo esc_url( $vid_url )?>">
                                        <i class="fa fa-caret-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- home tips start-->
    <?php

    }

}
