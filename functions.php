<?php 
/**
 * @Packge 	   : Colorlib
 * @Version    : 1.0
 * @Author 	   : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit( 'Direct script access denied.' );
	}

	/**
	 *
	 * Define constant
	 *
	 */
	
	 
	// Base URI
	if( !defined( 'HEAVEN_DIR_URI' ) )
		define( 'HEAVEN_DIR_URI', get_template_directory_uri().'/' );
	
	// assets URI
	if( !defined( 'HEAVEN_DIR_ASSETS_URI' ) )
		define( 'HEAVEN_DIR_ASSETS_URI', HEAVEN_DIR_URI.'assets/' );
	
	// Css File URI
	if( !defined( 'HEAVEN_DIR_CSS_URI' ) )
		define( 'HEAVEN_DIR_CSS_URI', HEAVEN_DIR_ASSETS_URI .'css/' );
	
	// Js File URI
	if( !defined( 'HEAVEN_DIR_JS_URI' ) )
		define( 'HEAVEN_DIR_JS_URI', HEAVEN_DIR_ASSETS_URI .'js/' );
	
	// Icon Images
	if( !defined('HEAVEN_DIR_ICON_IMG_URI') )
		define( 'HEAVEN_DIR_ICON_IMG_URI', HEAVEN_DIR_ASSETS_URI.'img/icon/' );
	
	//DIR inc
	if( !defined( 'HEAVEN_DIR_INC' ) )
		define( 'HEAVEN_DIR_INC', HEAVEN_DIR_URI.'inc/' );

	//Elementor Widgets Folder Directory
	if( !defined( 'HEAVEN_DIR_ELEMENTOR' ) )
		define( 'HEAVEN_DIR_ELEMENTOR', HEAVEN_DIR_INC.'elementor-widgets/' );

	// Base Directory
	if( !defined( 'HEAVEN_DIR_PATH' ) )
		define( 'HEAVEN_DIR_PATH', get_parent_theme_file_path().'/' );
	
	//Inc Folder Directory
	if( !defined( 'HEAVEN_DIR_PATH_INC' ) )
		define( 'HEAVEN_DIR_PATH_INC', HEAVEN_DIR_PATH.'inc/' );
	
	//Colorlib framework Folder Directory
	if( !defined( 'HEAVEN_DIR_PATH_LIB' ) )
		define( 'HEAVEN_DIR_PATH_LIB', HEAVEN_DIR_PATH_INC.'libraries/' );
	
	//Classes Folder Directory
	if( !defined( 'HEAVEN_DIR_PATH_CLASSES' ) )
		define( 'HEAVEN_DIR_PATH_CLASSES', HEAVEN_DIR_PATH_INC.'classes/' );

	
	//Widgets Folder Directory
	if( !defined( 'HEAVEN_DIR_PATH_WIDGET' ) )
		define( 'HEAVEN_DIR_PATH_WIDGET', HEAVEN_DIR_PATH_INC.'widgets/' );
		
	//Elementor Widgets Folder Directory
	if( !defined( 'HEAVEN_DIR_PATH_ELEMENTOR_WIDGETS' ) )
		define( 'HEAVEN_DIR_PATH_ELEMENTOR_WIDGETS', HEAVEN_DIR_PATH_INC.'elementor-widgets/' );
	

		
	/**
	 * Include File
	 *
	 */
	
	// Breadcrumbs file include
	require_once( HEAVEN_DIR_PATH_INC . 'heaven-breadcrumbs.php' );
	// Sidebar register file include
	require_once( HEAVEN_DIR_PATH_INC . 'widgets/heaven-widgets-reg.php' );
	// Post widget file include
	require_once( HEAVEN_DIR_PATH_INC . 'widgets/heaven-recent-post-thumb.php' );
	// News letter widget file include
	require_once( HEAVEN_DIR_PATH_INC . 'widgets/heaven-newsletter-widget.php' );
	//Social Links
	require_once( HEAVEN_DIR_PATH_INC . 'widgets/heaven-social-links.php' );
	// Instagram Widget
	require_once( HEAVEN_DIR_PATH_INC . 'widgets/heaven-instagram.php' );
	// Nav walker file include
	require_once( HEAVEN_DIR_PATH_INC . 'wp_bootstrap_navwalker.php' );
	// Theme function file include
	require_once( HEAVEN_DIR_PATH_INC . 'heaven-functions.php' );

	// Theme Demo file include
	require_once( HEAVEN_DIR_PATH_INC . 'demo/demo-import.php' );

	// Post Like
	require_once( HEAVEN_DIR_PATH_INC . 'post-like.php' );
	// Theme support function file include
	require_once( HEAVEN_DIR_PATH_INC . 'support-functions.php' );
	// Html helper file include
	require_once( HEAVEN_DIR_PATH_INC . 'wp-html-helper.php' );
	// Pagination file include
	require_once( HEAVEN_DIR_PATH_INC . 'wp_bootstrap_pagination.php' );
	// Elementor Widgets
	require_once( HEAVEN_DIR_PATH_ELEMENTOR_WIDGETS . 'elementor-widget.php' );
	//
	require_once( HEAVEN_DIR_PATH_CLASSES . 'Class-Enqueue.php' );
	
	require_once( HEAVEN_DIR_PATH_CLASSES . 'Class-Config.php' );
	// Customizer
	require_once( HEAVEN_DIR_PATH_INC . 'customizer/customizer.php' );
	// Class autoloader
	require_once( HEAVEN_DIR_PATH_INC . 'class-epsilon-dashboard-autoloader.php' );
	// Class heaven dashboard
	require_once( HEAVEN_DIR_PATH_INC . 'class-epsilon-init-dashboard.php' );
	// Common css
	require_once( HEAVEN_DIR_PATH_INC . 'heaven-commoncss.php' );


	if( class_exists( 'RW_Meta_Box' ) ){
		// Metabox Function
		require_once( HEAVEN_DIR_PATH_INC . 'heaven-metabox.php' );
	}


	// Admin Enqueue Script
	function heaven_admin_script(){
		wp_enqueue_style( 'heaven-admin', get_template_directory_uri().'/assets/css/heaven_admin.css', false, '1.0.0' );
		wp_enqueue_script( 'heaven_admin', get_template_directory_uri().'/assets/js/heaven_admin.js', false, '1.0.0' );
	}
	add_action( 'admin_enqueue_scripts', 'heaven_admin_script' );

	 
	// WooCommerce style desable
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );


	/**
	 * Instantiate Heaven object
	 *
	 * Inside this object:
	 * Enqueue scripts, Google font, Theme support features, Heaven Dashboard .
	 *
	 */
	
	$Heaven = new Heaven();
	
