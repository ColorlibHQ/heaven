<?php 
/**
 * @Packge     : Heaven
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 * Customizer panels and sections
 *
 */

/***********************************
 * Register customizer panels
 ***********************************/

$panels = array(
    /**
     * Theme Options Panel
     */
    array(
        'id'   => 'heaven_theme_options_panel',
        'args' => array(
            'priority'       => 0,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => esc_html__( 'Theme Options', 'heaven' ),
        ),
    )
);


/***********************************
 * Register customizer sections
 ***********************************/


$sections = array(

    /**
     * General Section
     */
    array(
        'id'   => 'heaven_general_section',
        'args' => array(
            'title'    => esc_html__( 'General', 'heaven' ),
            'panel'    => 'heaven_theme_options_panel',
            'priority' => 1,
        ),
    ),
    
    /**
     * Header Section
     */
    array(
        'id'   => 'heaven_header_section',
        'args' => array(
            'title'    => esc_html__( 'Header', 'heaven' ),
            'panel'    => 'heaven_theme_options_panel',
            'priority' => 2,
        ),
    ),

    /**
     * Blog Section
     */
    array(
        'id'   => 'heaven_blog_section',
        'args' => array(
            'title'    => esc_html__( 'Blog', 'heaven' ),
            'panel'    => 'heaven_theme_options_panel',
            'priority' => 3,
        ),
    ),

    /**
     * Blog Section
     */
    array(
        'id'   => 'heaven_portfolio_section',
        'args' => array(
            'title'    => esc_html__( 'Portfolio', 'heaven' ),
            'panel'    => 'heaven_theme_options_panel',
            'priority' => 4,
        ),
    ),


    /**
     * 404 Page Section
     */
    array(
        'id'   => 'heaven_fof_section',
        'args' => array(
            'title'    => esc_html__( '404 Page', 'heaven' ),
            'panel'    => 'heaven_theme_options_panel',
            'priority' => 6,
        ),
    ),

    /**
     * Footer Section
     */
    array(
        'id'   => 'heaven_footer_section',
        'args' => array(
            'title'    => esc_html__( 'Footer Page', 'heaven' ),
            'panel'    => 'heaven_theme_options_panel',
            'priority' => 7,
        ),
    ),



);


/***********************************
 * Add customizer elements
 ***********************************/
$collection = array(
    'panel'   => $panels,
    'section' => $sections,
);

Epsilon_Customizer::add_multiple( $collection );

?>