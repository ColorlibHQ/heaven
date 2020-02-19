<?php 
/**
 * @Packge     : Heaven
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */

if( !defined( 'WPINC' ) ){
    die;
}

// demo import file
function heaven_import_files() {
	
	$demoImg = '<img src="'. HEAVEN_DIR_INC . 'demo/screen-image.png' .' " alt="'.esc_attr__( 'Demo Preview Imgae', 'heaven' ).'" />';
	
  return array(
    array(
      'import_file_name'             => 'Heaven Demo',
      'local_import_file'            => HEAVEN_DIR_PATH_INC .'demo/heaven-demo.xml',
      'local_import_widget_file'     => HEAVEN_DIR_PATH_INC .'demo/heaven-widgets.wie',
      'import_customizer_file_url'   => HEAVEN_DIR_INC . 'demo/heaven-customizer.dat',
      'import_notice' => $demoImg,
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'heaven_import_files' );
	
// demo import setup
function heaven_after_import_setup() {
	// Assign menus to their locations.
    $main_menu    	  = get_term_by( 'name', 'Main Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
            'primary-menu' => $main_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Homepage' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );
	update_option( 'heaven_demodata_import', 'yes' );

}
add_action( 'pt-ocdi/after_import', 'heaven_after_import_setup' );

//disable the branding notice after successful demo import
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

//change the location, title and other parameters of the plugin page
function heaven_import_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'heaven' );
	$default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'heaven' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'heaven-demo-import';

	return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'heaven_import_plugin_page_setup' );

// Enqueue scripts
function heaven_demo_import_custom_scripts(){
	
	
	if( isset( $_GET['page'] ) && $_GET['page'] == 'heaven-demo-import' ){
		// style
		wp_enqueue_style( 'heaven-demo-import', HEAVEN_DIR_INC . 'demo/css/demo-import.css', array(), '1.0', false );
	}
	
	
}
add_action( 'admin_enqueue_scripts', 'heaven_demo_import_custom_scripts' );



?>