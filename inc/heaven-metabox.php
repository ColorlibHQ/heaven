<?php
function heaven_portfolio_metabox( $meta_boxes ) {

	$heaven_prefix = '_heaven_';
	$meta_boxes[] = array(
		'id'        => 'portfolio_single_metaboxs',
		'title'     => esc_html__( 'Portfolio Single Metabox', 'heaven' ),
		'post_types'=> array( 'portfolio' ),
		'context'   => 'side',
		'priority'  => 'high',
		'autosave'  => 'false',
		'fields'    => array(
			array(
				'id'         => $heaven_prefix . 'client_name',
				'type'       => 'text',
				'name'       => esc_html__( 'Client Name', 'heaven' ),
				'placeholder' => esc_html__( 'Client Name', 'heaven' ),
			),
			array(
				'id'    => $heaven_prefix . 'client_img',
				'type'  => 'image_advanced',
				'max_file_uploads'	=> 1,
				'max_status'	=> false,
				'max_file_size'	=> '100kb',
				'name'  => esc_html__( 'Client Image', 'heaven' ),
				'placeholder' => esc_html__( 'Client Image', 'heaven' ),
			),
			array(
				'id'    => $heaven_prefix . 'project_start_date',
				'type'  => 'date',
				'name'  => esc_html__( 'Project Start Date', 'heaven' ),
				'placeholder'  => esc_html__( 'Project Start Date', 'heaven' ),
				'js_options' => array(
					'dateFormat'      => 'd M yy   ',
					'showButtonPanel' => false,
				),
			),
			array(
				'id'    => $heaven_prefix . 'project_end_date',
				'type'  => 'date',
				'name'  => esc_html__( 'Project End Date', 'heaven' ),
				'placeholder'  => esc_html__( 'Project End Date', 'heaven' ),
				'js_options' => array(
					'dateFormat'      => 'd M yy   ',
					'showButtonPanel' => false,
				),
			),
			array(
				'id'    => $heaven_prefix . 'project_location',
				'type'  => 'text',
				'name'  => esc_html__( 'Project Location', 'heaven' ),
				'placeholder' => esc_html__( 'Project Location', 'heaven' ),
			),
			array(
				'id'    => $heaven_prefix . 'project_architect',
				'type'  => 'text',
				'name'  => esc_html__( 'Project Architect', 'heaven' ),
				'placeholder' => esc_html__( 'Project Architect', 'heaven' ),
			),
			array(
				'id'    => $heaven_prefix . 'project_url',
				'type'  => 'text',
				'name'  => esc_html__( 'Project URL', 'heaven' ),
				'placeholder' => esc_html__( 'Project URL', 'heaven' ),
			),
			array(
				'type' => 'divider',
			),
			array(
				'id'    => $heaven_prefix . 'project_gallery',
				'type'  => 'image_advanced',
				'name'  => esc_html__( 'Project Gallery', 'heaven' ),
				'placeholder' => esc_html__( 'Project Gallery', 'heaven' ),
			),
		),
	);


	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'heaven_portfolio_metabox' );