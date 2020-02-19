<?php 
/**
 * @Packge     : Heaven
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 * Customizer section fields
 *
 */

/***********************************
 * General Section Fields
 ***********************************/

 // Theme color field
Epsilon_Customizer::add_field(
    'heaven_theme_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Theme Color', 'heaven' ),
        'description' => esc_html__( 'Select the theme color.', 'heaven' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'heaven_general_section',
        'default'     => '#ff7e00',
    )
);
 
// Sticky Header background color field
Epsilon_Customizer::add_field(
    'heaven_header_bg_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Sticky Header BG Color', 'heaven' ),
        'description' => esc_html__( 'Select the header background color.', 'heaven' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'heaven_header_section',
        'default'     => '#161f23',
    )
);
 
// Menu background color field
Epsilon_Customizer::add_field(
    'heaven_menu_bg_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Menu BG Color', 'heaven' ),
        'description' => esc_html__( 'Select the menu background color.', 'heaven' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'heaven_header_section',
        'default'     => '#fff',
    )
);

// Header nav menu color field
Epsilon_Customizer::add_field(
    'heaven_header_menu_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Header menu color', 'heaven' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'heaven_header_section',
        'default'     => '#100060',
    )
);

// Header nav menu hover color field
Epsilon_Customizer::add_field(
    'heaven_header_menu_hover_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Header menu hover color', 'heaven' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'heaven_header_section',
        'default'     => '#ff7e00',
    )
);



/***********************************
 * Blog Section Fields
 ***********************************/
 
// Post excerpt length field
Epsilon_Customizer::add_field(
    'heaven_excerpt_length',
    array(
        'type'        => 'text',
        'label'       => esc_html__( 'Set post excerpt length', 'heaven' ),
        'description' => esc_html__( 'Set post excerpt length.', 'heaven' ),
        'section'     => 'heaven_blog_section',
        'sanitize_callback' => 'sanitize_text_field',
        'default'     => '30',
    )
);

// Blog single page social share icon
Epsilon_Customizer::add_field(
    'heaven_blog_meta',
    array(
        'type'        => 'epsilon-toggle',
        'label'       => esc_html__( 'Blog page post meta show/hide', 'heaven' ),
        'section'     => 'heaven_blog_section',
        'default'     => true
    )
);
Epsilon_Customizer::add_field(
    'heaven_like_btn',
    array(
        'type'        => 'epsilon-toggle',
        'label'       => esc_html__( 'Blog Single Page Like Button show/hide', 'heaven' ),
        'section'     => 'heaven_blog_section',
        'default'     => true
    )
);
Epsilon_Customizer::add_field(
    'heaven_blog_share',
    array(
        'type'        => 'epsilon-toggle',
        'label'       => esc_html__( 'Blog Single Page Share show/hide', 'heaven' ),
        'section'     => 'heaven_blog_section',
        'default'     => true
    )
);



/***********************************
 * Portfolio Fields
 ***********************************/

Epsilon_Customizer::add_field(
	'portfolio_project_des_title',
	array(
		'type'              => 'text',
		'label'             => esc_html__( 'Project Description Title ', 'heaven' ),
        'section'           => 'heaven_portfolio_section',
        'sanitize_callback' => 'sanitize_text_field',
		'default'           => esc_html__( 'Project Description', 'heaven' ),
	)
);
Epsilon_Customizer::add_field(
	'portfolio_client_details',
	array(
		'type'              => 'text',
		'label'             => esc_html__( 'Client details ', 'heaven' ),
        'section'           => 'heaven_portfolio_section',
        'sanitize_callback' => 'sanitize_text_field',
		'default'           => esc_html__( 'Client details', 'heaven' ),
	)
);
Epsilon_Customizer::add_field(
    'portfolio_gallery_toggle',
    array(
        'type'        => 'epsilon-toggle',
        'label'       => esc_html__( 'Project Gallery show/hide', 'heaven' ),
        'section'     => 'heaven_portfolio_section',
        'default'     => true
    )
);
Epsilon_Customizer::add_field(
	'portfolio_gallery_title',
	array(
		'type'              => 'text',
		'label'             => esc_html__( 'Portfolio Gallery Title', 'heaven' ),
        'section'           => 'heaven_portfolio_section',
        'sanitize_callback' => 'sanitize_text_field',
		'default'           => esc_html__( 'Gallery', 'heaven' ),
	)
);



/***********************************
 * 404 Page Section Fields
 ***********************************/

// 404 text #1 field
Epsilon_Customizer::add_field(
    'heaven_fof_titleone',
    array(
        'type'              => 'text',
        'label'             => esc_html__( '404 Text #1', 'heaven' ),
        'section'           => 'heaven_fof_section',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'Say Hello.'
    )
);
// 404 text #2 field
Epsilon_Customizer::add_field(
    'heaven_fof_titletwo',
    array(
        'type'              => 'text',
        'label'             => esc_html__( '404 Text #2', 'heaven' ),
        'section'           => 'heaven_fof_section',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'Say Hello.'
    )
);
// 404 text #1 color field
Epsilon_Customizer::add_field(
    'heaven_fof_textone_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( '404 Text #1 Color', 'heaven' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'heaven_fof_section',
        'default'     => '#000000',
    )
);
// 404 text #2 color field
Epsilon_Customizer::add_field(
    'heaven_fof_texttwo_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( '404 Text #2 Color', 'heaven' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'heaven_fof_section',
        'default'     => '#656565',
    )
);
// 404 background color field
Epsilon_Customizer::add_field(
    'heaven_fof_bg_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( '404 Page Background Color', 'heaven' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'heaven_fof_section',
        'default'     => '#fff',
    )
);

/***********************************
 * Footer Section Fields
 ***********************************/

// Footer Widget section
Epsilon_Customizer::add_field(
    'footer_widget_separator',
    array(
        'type'        => 'epsilon-separator',
        'label'       => esc_html__( 'Footer Widget Section', 'heaven' ),
        'section'     => 'heaven_footer_section',

    )
);

// Footer widget toggle field
Epsilon_Customizer::add_field(
    'heaven_footer_widget_toggle',
    array(
        'type'        => 'epsilon-toggle',
        'label'       => esc_html__( 'Footer widget show/hide', 'heaven' ),
        'description' => esc_html__( 'Toggle to display footer widgets.', 'heaven' ),
        'section'     => 'heaven_footer_section',
        'default'     => true,
    )
);

// Footer Copyright section
Epsilon_Customizer::add_field(
    'heaven_footer_copyright_separator',
    array(
        'type'        => 'epsilon-separator',
        'label'       => esc_html__( 'Footer Copyright Section', 'heaven' ),
        'section'     => 'heaven_footer_section',
        'default'     => true,

    )
);

// Footer copyright text field
// Copy right text
$url = 'https://colorlib.com/';
$copyText = sprintf( __( 'Theme by %s colorlib %s Copyright &copy; %s  |  All rights reserved.', 'heaven' ), '<a target="_blank" href="' . esc_url( $url ) . '">', '</a>', date( 'Y' ) );
Epsilon_Customizer::add_field(
    'heaven_footer_copyright_text',
    array(
        'type'        => 'epsilon-text-editor',
        'label'       => esc_html__( 'Footer copyright text', 'heaven' ),
        'section'     => 'heaven_footer_section',
        'default'     => wp_kses_post( $copyText ),
    )
);

// Footer widget background color field
Epsilon_Customizer::add_field(
    'heaven_footer_bg_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Footer Background Color', 'heaven' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'heaven_footer_section',
        'default'     => '#161f23',
    )
);

// Footer widget text color field
Epsilon_Customizer::add_field(
    'heaven_footer_widget_text_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Footer Text Color', 'heaven' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'heaven_footer_section',
        'default'     => '#777',
    )
);

// Footer widget title color field
Epsilon_Customizer::add_field(
    'heaven_footer_widget_title_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Footer Widget Title Color', 'heaven' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'heaven_footer_section',
        'default'     => '#ffffff',
    )
);

// Footer widget anchor color field
Epsilon_Customizer::add_field(
    'heaven_footer_widget_anchor_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Footer Anchor Color', 'heaven' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'heaven_footer_section',
        'default'     => '#ff7e00',
    )
);

// Footer widget anchor hover color field
Epsilon_Customizer::add_field(
    'heaven_footer_widget_anchor_hover_color',
    array(
        'type'        => 'epsilon-color-picker',
        'label'       => esc_html__( 'Footer Anchor Hover Color', 'heaven' ),
        'sanitize_callback' => 'sanitize_text_field',
        'section'     => 'heaven_footer_section',
        'default'     => '#ff7e00',
    )
);

