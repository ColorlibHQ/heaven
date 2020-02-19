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
class Heaven_Featured_Overlay extends Widget_Base {

	public function get_name() {
		return 'heaven-featured-overlay';
	}

	public function get_title() {
		return __( 'Featured Overlay', 'heaven' );
	}

	public function get_icon() {
		return 'eicon-image-rollover';
	}

	public function get_categories() {
		return [ 'heaven-elements' ];
	}

	protected function _register_controls() {
       

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

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'sectionbg',
                'label' => __( 'Background', 'heaven' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .overlay_section',
            ]
        );
        
        $this->add_control(
            'section_bg_overlay_heading',
            [
                'label'     => __( 'Background Overy Image Settings', 'heaven' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'section_bg_overlay',
                'label' => __( 'Background', 'heaven' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .overlay_section:after',
            ]
        );

        $this->end_controls_section();


	}

	protected function render() {
        $settings = $this->get_settings();
        ?>

        <div class="overlay_section">

        </div>
    <?php

    }

}
