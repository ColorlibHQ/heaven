<?php 
/**
 * @Packge     : Heaven
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit( 'Direct script access denied.' );
    }

/*=========================================================
	Theme option callback
=========================================================*/
function heaven_opt( $id = null, $default = '' ) {
	
	$opt = get_theme_mod( $id, $default );
	
	$data = '';
	
	if( $opt ) {
		$data = $opt;
	}
	
	return $data;
}


/*=========================================================
	Site icon callback
=========================================================*/

function heaven_site_icon(){
	if ( ! has_site_icon() ) {
		$html = '';
		$icon_path = HEAVEN_DIR_ASSETS_URI . 'img/favicon.png';
		$html .= '<link rel="icon" href="' . esc_url ( $icon_path ) . '" sizes="32x32">';
		$html .= '<link rel="icon" href="' . esc_url ( $icon_path ) . '" sizes="192x192">';
		$html .= '<link rel="apple-touch-icon-precomposed" href="' . esc_url ( $icon_path ) . '">';
		$html .= '<meta name="msapplication-TileImage" content="' . esc_url ( $icon_path ) . '">';

		return $html;
	} else {
		return;
	}
}


/*=========================================================
	Custom meta id callback
=========================================================*/
function heaven_meta( $id = '' ){
    
    $value = get_post_meta( get_the_ID(), '_heaven_'.$id, true );
    
    return $value;
}


/*=========================================================
	Blog Date Permalink
=========================================================*/
function heaven_blog_date_permalink(){
	
	$year  = get_the_time('Y'); 
    $month_link = get_the_time('m');
    $day   = get_the_time('d');

    $link = get_day_link( $year, $month_link, $day);
    
    return $link; 
}



/*========================================================
	Blog Excerpt Length
========================================================*/
if ( ! function_exists( 'heaven_excerpt_length' ) ) {
	function heaven_excerpt_length( $limit = 30 ) {

		$excerpt = explode( ' ', get_the_excerpt() );
		
		// $limit null check
		if( !null == $limit ){
			$limit = $limit;
		}else{
			$limit = 30;
		}
        
        
		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$exc_slice = array_slice( $excerpt, 0, $limit );
			$excerpt = implode( " ", $exc_slice ).' ...';
		} else {
			$exc_slice = array_slice( $excerpt, 0, $limit );
			$excerpt = implode( " ", $exc_slice );
		}
		
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $excerpt;

	}
}


/*==========================================================
	Comment number and Link
==========================================================*/
if ( ! function_exists( 'heaven_posted_comments' ) ) {
    function heaven_posted_comments(){
        
        $comments_num = get_comments_number();
        if( comments_open() ){
            if( $comments_num == 0 ){
                $comments = esc_html__('No Comments','heaven');
            } elseif ( $comments_num > 1 ){
                $comments= $comments_num . esc_html__(' Comments','heaven');
            } else {
                $comments = esc_html__( '1 Comment','heaven' );
            }
            $comments = '<i class="ti-comments"></i>'. $comments;
        } else {
            $comments = esc_html__( 'Comments are closed', 'heaven' );
        }
        
        return $comments;
    }
}


/*===================================================
	Post embedded media
===================================================*/
function heaven_embedded_media( $type = array() ){
    
    $content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
    $embed   = get_media_embedded_in_content( $content, $type );
        
    if( in_array( 'audio' , $type) ){
    
        if( count( $embed ) > 0 ){
            $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
        }else{
           $output = '';
        }
        
    }else{
        
        if( count( $embed ) > 0 ){

            $output = $embed[0];
        }else{
           $output = ''; 
        }
        
    }
    
    return $output;
}


/*===================================================
	WP post link pages
====================================================*/
function heaven_link_pages(){
    wp_link_pages( array(
    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'heaven' ) . '</span>',
    'after'       => '</div>',
    'link_before' => '<span>',
    'link_after'  => '</span>',
    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'heaven' ) . ' </span>%',
    'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
}


/*====================================================
	Specific Social icons overwritten by flaticon
====================================================*/

function heaven_social_icon_overwrite_by_flaticon( $social_icon ){
	switch ( $social_icon ) {
		case ($social_icon == 'fa fa-facebook' || $social_icon == 'fa fa-facebook-f'):
			$social_icon = 'flaticon-facebook';
			break;
		case ($social_icon == 'fa fa-twitter'):
			$social_icon = 'flaticon-twitter';
			break;
		case ($social_icon == 'fa fa-skype'):
			$social_icon = 'flaticon-skype';
			break;
		case ($social_icon == 'fa fa-instagram'):
			$social_icon = 'flaticon-instagram';
			break;
		
		default:
			$social_icon = $social_icon;
			break;
	}

	return $social_icon;
}

/*====================================================
	Theme logo
====================================================*/
function heaven_theme_logo( $class = '' ) {

    $siteUrl = home_url('/');
    // site logo
		
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$imageUrl = wp_get_attachment_image_src( $custom_logo_id , 'heaven_logo_127x21' );
	
	if( !empty( $imageUrl[0] ) ){
		$siteLogo = '<a class="'.esc_attr( $class ).'" href="'.esc_url( $siteUrl ).'"><img src="'.esc_url( $imageUrl[0] ).'" alt="heaven logo"></a>';
	}else{
		$siteLogo = '<h2><a class="'.esc_attr( $class ).'" href="'.esc_url( $siteUrl ).'">'.esc_html( get_bloginfo('name') ).'</a><span>'. esc_html( get_bloginfo('description') ) .'</span></h2>';
	}
	
	return wp_kses_post( $siteLogo );
	
}


/*================================================
    Page Title Bar
================================================*/
function heaven_page_titlebar() {
	if ( ! is_page_template( 'template-builder.php' ) ) {
		?>
        <section class="hero-banner">
            <div class="container">
				<h2>
				<?php
				if ( is_category() ) {
					single_cat_title( __('Category: ', 'heaven') );

				} elseif ( is_tag() ) {
					single_tag_title( __('Tag Archive for - ', 'heaven') );

				} elseif ( is_archive() ) {
					echo get_the_archive_title();

				} elseif ( is_page() ) {
					echo get_the_title();

				} elseif ( is_search() ) {
					echo esc_html__( 'Search for: ', 'heaven' ) . get_search_query();

				} elseif ( ! ( is_404() ) && ( is_single() ) || ( is_page() ) ) {
					echo  get_the_title();

				} elseif ( is_home() ) {
					echo esc_html__( 'Blog', 'heaven' );

				} elseif ( is_404() ) {
					echo esc_html__( '404 error', 'heaven' );

				}
				?>
				</h2>
            </div>
        </section>
		<?php
	}
}



/*================================================
	Blog pull right class callback
=================================================*/
function heaven_pull_right( $id = '', $condation ){
    
    if( $id == $condation ){
        return ' '.'order-last';
    }else{
        return;
    }
    
}



/*======================================================
	Inline Background
======================================================*/
function heaven_inline_bg_img( $bgUrl ){
    $bg = '';

    if( $bgUrl ){
        $bg = 'style="background-image:url('.esc_url( $bgUrl ).')"'; 
    }

    return $bg;
}


/*======================================================
	Blog Category
======================================================*/
function heaven_featured_post_cat(){

	$categories = get_the_category(); 
	
	if( is_array( $categories ) && count( $categories ) > 0 ){
		$getCat = [];
		foreach ( $categories as $value ) {

			if( $value->slug != 'featured' && ! is_front_page() ){
				$getCat[] = '<a href="'.esc_url( get_category_link( $value->term_id ) ).'"> <i class="ti-bookmark"></i> '.esc_html( $value->name ).'</a>';
			}else{
				$getCat[] = '<i class="ti-bookmark"></i>'.esc_html( $value->name );
			}
		}

		return implode( ', ', $getCat );
	}
         
}


/*=======================================================
	Customize Sidebar Option Value Return
========================================================*/
function heaven_sidebar_opt(){

    $sidebarOpt = heaven_opt( 'heaven_blog_layout' );
    $sidebar = '1';
    // Blog Sidebar layout  opt
    if( is_array( $sidebarOpt ) ){
        $sidebarOpt =  $sidebarOpt;
    }else{
        $sidebarOpt =  json_decode( $sidebarOpt, true );
    }
    
    
    if( !empty( $sidebarOpt['columnsCount'] ) ){
        $sidebar = $sidebarOpt['columnsCount'];
    }


    return $sidebar;
}


/**================================================
	Heaven SVG Icon
 =================================================*/

 function get_heaven_svg_icon( $icon = 'icon_left' ){
	if( $icon == 'icon1' ){
		$icon = '<svg 
		xmlns="http://www.w3.org/2000/svg"
		xmlns:xlink="http://www.w3.org/1999/xlink"
		width="61px" height="61px">
	   <path fill-rule="evenodd"  fill="rgb(255, 126, 0)"
		d="M59.958,31.500 L53.958,31.500 C53.406,31.500 52.958,31.052 52.958,30.500 C52.958,29.948 53.406,29.500 53.958,29.500 L59.958,29.500 C60.510,29.500 60.958,29.948 60.958,30.500 C60.958,31.052 60.510,31.500 59.958,31.500 ZM51.464,52.006 C51.208,52.006 50.953,51.908 50.758,51.713 L46.515,47.471 C46.124,47.080 46.124,46.448 46.515,46.057 C46.906,45.666 47.539,45.666 47.929,46.057 L52.172,50.299 C52.562,50.690 52.562,51.322 52.172,51.713 C51.977,51.908 51.720,52.006 51.464,52.006 ZM47.929,14.943 C47.734,15.139 47.478,15.236 47.222,15.236 C46.966,15.236 46.710,15.138 46.515,14.943 C46.124,14.552 46.124,13.920 46.515,13.529 L50.758,9.287 C51.148,8.896 51.780,8.896 52.172,9.287 C52.562,9.678 52.562,10.310 52.172,10.701 L47.929,14.943 ZM30.958,50.500 C19.930,50.500 10.958,41.528 10.958,30.500 C10.958,19.471 19.930,10.500 30.958,10.500 C41.987,10.500 50.959,19.471 50.959,30.500 C50.959,41.528 41.987,50.500 30.958,50.500 ZM30.958,12.500 C21.034,12.500 12.958,20.575 12.958,30.500 C12.958,40.425 21.034,48.500 30.958,48.500 C40.883,48.500 48.958,40.425 48.958,30.500 C48.958,20.575 40.883,12.500 30.958,12.500 ZM26.714,45.154 C26.519,45.380 26.242,45.500 25.958,45.500 C25.804,45.500 25.649,45.465 25.505,45.392 C25.096,45.184 24.882,44.723 24.985,44.275 L27.701,32.500 L22.958,32.500 C22.566,32.500 22.211,32.271 22.048,31.916 C21.885,31.560 21.945,31.142 22.202,30.846 L35.202,15.846 C35.503,15.498 36.002,15.401 36.411,15.609 C36.821,15.817 37.037,16.278 36.932,16.726 L34.215,28.500 L38.958,28.500 C39.351,28.500 39.705,28.729 39.868,29.084 C40.031,29.440 39.971,29.858 39.714,30.154 L26.714,45.154 ZM32.958,30.500 C32.653,30.500 32.365,30.361 32.176,30.123 C31.986,29.885 31.916,29.573 31.983,29.275 L34.079,20.195 L25.148,30.500 L28.958,30.500 C29.263,30.500 29.551,30.639 29.740,30.877 C29.930,31.115 30.000,31.427 29.932,31.725 L27.837,40.805 L36.768,30.500 L32.958,30.500 ZM30.958,8.500 C30.406,8.500 29.958,8.052 29.958,7.500 L29.958,1.500 C29.958,0.948 30.406,0.500 30.958,0.500 C31.510,0.500 31.959,0.948 31.959,1.500 L31.959,7.500 C31.959,8.052 31.510,8.500 30.958,8.500 ZM14.695,15.236 C14.439,15.236 14.183,15.138 13.988,14.943 L9.745,10.701 C9.354,10.310 9.354,9.678 9.745,9.287 C10.135,8.896 10.768,8.896 11.159,9.287 L15.402,13.529 C15.794,13.920 15.794,14.552 15.402,14.943 C15.207,15.139 14.950,15.236 14.695,15.236 ZM7.958,31.500 L1.959,31.500 C1.406,31.500 0.958,31.052 0.958,30.500 C0.958,29.948 1.406,29.500 1.959,29.500 L7.958,29.500 C8.511,29.500 8.958,29.948 8.958,30.500 C8.958,31.052 8.511,31.500 7.958,31.500 ZM13.988,46.057 C14.379,45.666 15.012,45.666 15.402,46.057 C15.794,46.448 15.794,47.080 15.402,47.471 L11.159,51.713 C10.964,51.908 10.708,52.006 10.452,52.006 C10.196,52.006 9.940,51.908 9.745,51.713 C9.354,51.322 9.354,50.690 9.745,50.299 L13.988,46.057 ZM30.958,52.500 C31.510,52.500 31.959,52.948 31.959,53.500 L31.959,59.500 C31.959,60.052 31.510,60.500 30.958,60.500 C30.406,60.500 29.958,60.052 29.958,59.500 L29.958,53.500 C29.958,52.948 30.406,52.500 30.958,52.500 Z"/>
	   </svg>';
	} elseif( $icon == 'icon2' ){
		$icon = '<svg 
		xmlns="http://www.w3.org/2000/svg"
		xmlns:xlink="http://www.w3.org/1999/xlink"
		width="49px" height="61px">
	   <path fill-rule="evenodd"  fill="rgb(255, 126, 0)"
		d="M21.249,13.554 C22.316,13.158 23.473,13.203 24.506,13.681 C26.639,14.666 27.575,17.210 26.592,19.351 C25.875,20.915 24.330,21.837 22.718,21.837 C22.123,21.837 21.519,21.712 20.943,21.446 C19.910,20.968 19.124,20.115 18.730,19.044 C18.336,17.973 18.381,16.812 18.857,15.776 C19.332,14.738 20.182,13.949 21.249,13.554 ZM20.373,18.435 C20.605,19.066 21.068,19.568 21.676,19.849 C22.931,20.430 24.424,19.876 25.002,18.616 C25.580,17.355 25.029,15.858 23.773,15.277 C23.439,15.123 23.083,15.045 22.726,15.045 C22.433,15.045 22.139,15.098 21.856,15.202 C21.228,15.435 20.728,15.900 20.448,16.510 C20.167,17.121 20.141,17.805 20.373,18.435 ZM48.915,13.184 L47.893,16.324 C47.414,17.798 46.281,18.971 44.854,19.518 C44.840,20.030 44.753,20.538 44.592,21.035 C44.592,21.035 44.592,21.035 44.591,21.035 L43.835,23.357 C43.114,25.576 41.066,27.067 38.740,27.067 C38.173,27.067 37.612,26.977 37.073,26.799 C34.676,26.013 33.205,23.679 33.396,21.259 C32.597,22.833 31.533,24.645 30.254,26.614 C31.838,25.432 34.071,25.368 35.737,26.605 C36.903,27.473 37.600,28.861 37.600,30.319 C37.600,31.311 37.287,32.260 36.696,33.063 L31.332,40.335 L36.641,43.557 C37.893,44.316 38.480,45.831 38.069,47.239 L34.534,59.859 C34.471,60.085 34.320,60.276 34.116,60.390 C33.985,60.463 33.839,60.500 33.692,60.500 C33.609,60.500 33.526,60.488 33.446,60.465 L28.932,59.138 C28.472,59.003 28.206,58.522 28.335,58.058 L30.744,49.394 L22.675,44.392 C21.941,43.937 21.393,43.296 21.055,42.565 L20.069,44.340 L14.052,55.169 L16.674,56.776 L23.520,47.796 C23.814,47.410 24.364,47.337 24.748,47.632 C25.132,47.927 25.205,48.478 24.911,48.864 L17.586,58.472 C17.415,58.697 17.155,58.817 16.891,58.817 C16.734,58.817 16.577,58.776 16.435,58.689 L12.421,56.230 C12.020,55.984 11.883,55.464 12.113,55.052 L21.192,38.710 C21.195,38.706 21.197,38.701 21.199,38.696 L21.471,38.208 C21.472,38.206 21.474,38.203 21.475,38.201 L21.476,38.200 C21.494,38.165 21.515,38.131 21.538,38.099 C21.541,38.095 21.543,38.091 21.546,38.087 L22.952,36.181 C22.953,36.180 22.954,36.178 22.955,36.177 L25.797,32.325 L18.129,31.465 C18.044,31.457 17.960,31.444 17.878,31.428 C17.872,31.427 17.867,31.426 17.861,31.425 C17.785,31.409 17.710,31.390 17.637,31.369 C17.624,31.365 17.610,31.361 17.597,31.357 C17.531,31.337 17.467,31.313 17.404,31.288 C17.379,31.278 17.355,31.268 17.330,31.258 C17.279,31.235 17.228,31.211 17.178,31.185 C17.144,31.168 17.109,31.150 17.076,31.131 C17.036,31.108 16.997,31.084 16.959,31.060 C16.921,31.036 16.883,31.011 16.847,30.985 C16.812,30.960 16.779,30.935 16.746,30.910 C16.711,30.882 16.677,30.854 16.644,30.826 C16.609,30.795 16.575,30.764 16.542,30.733 C16.514,30.706 16.486,30.678 16.459,30.650 C16.422,30.612 16.387,30.573 16.353,30.533 C16.341,30.519 16.328,30.506 16.316,30.492 C15.920,30.008 15.707,29.415 15.703,28.798 C15.703,28.794 15.703,28.790 15.703,28.787 C15.702,28.753 15.703,28.719 15.705,28.684 C15.705,28.672 15.705,28.660 15.705,28.648 C15.707,28.620 15.709,28.592 15.711,28.563 C15.713,28.546 15.714,28.529 15.715,28.512 C15.859,27.027 17.178,25.936 18.658,26.081 C18.662,26.082 18.666,26.082 18.671,26.083 L27.821,27.109 C29.833,24.140 31.396,21.481 32.350,19.400 C33.041,17.894 33.338,16.288 33.372,14.684 L17.985,7.571 C16.791,8.640 15.768,9.909 15.077,11.414 L14.938,11.722 C14.739,12.165 14.221,12.362 13.780,12.162 C13.339,11.963 13.142,11.443 13.341,11.000 L13.485,10.682 C14.289,8.930 15.541,7.336 17.196,5.938 C17.222,5.910 17.249,5.883 17.279,5.859 C22.317,1.664 29.433,0.591 30.005,0.510 C30.018,0.509 30.028,0.507 30.033,0.507 C30.047,0.505 30.060,0.505 30.074,0.504 C30.396,0.476 30.709,0.626 30.886,0.901 C31.055,1.163 35.023,7.405 35.125,14.109 C35.126,14.147 35.124,14.185 35.119,14.223 C35.123,14.702 35.106,15.171 35.070,15.632 L35.437,14.507 C36.201,12.158 38.726,10.871 41.067,11.639 L44.384,12.728 C44.426,12.742 44.471,12.744 44.515,12.735 L47.910,12.050 C48.215,11.988 48.530,12.094 48.737,12.328 C48.944,12.561 49.011,12.887 48.915,13.184 ZM22.991,39.082 L22.726,39.560 C22.080,40.729 22.461,42.194 23.595,42.897 L32.225,48.246 C32.557,48.452 32.713,48.853 32.608,49.230 L30.254,57.696 L33.088,58.528 L36.385,46.754 C36.576,46.101 36.307,45.409 35.735,45.062 C35.735,45.062 35.735,45.062 35.735,45.062 L26.872,39.683 L23.885,37.871 L22.991,39.082 ZM24.932,36.452 L27.866,38.232 L29.827,39.422 L35.288,32.018 C35.655,31.520 35.849,30.933 35.849,30.319 C35.849,29.403 35.428,28.564 34.695,28.018 C33.934,27.453 32.983,27.327 32.142,27.593 L32.701,27.655 C33.415,27.727 34.059,28.072 34.515,28.629 C34.972,29.187 35.185,29.890 35.116,30.609 C35.046,31.328 34.701,31.977 34.145,32.436 C33.659,32.838 33.061,33.053 32.438,33.053 C32.350,33.053 32.262,33.048 32.173,33.040 C32.168,33.039 32.164,33.039 32.160,33.038 L27.809,32.551 L24.932,36.452 ZM18.789,27.865 L18.483,27.831 C18.453,27.828 18.422,27.826 18.392,27.827 C18.377,27.827 18.361,27.828 18.346,27.829 C18.331,27.830 18.316,27.830 18.302,27.831 C18.284,27.833 18.267,27.836 18.249,27.839 C18.237,27.841 18.225,27.843 18.214,27.845 C18.195,27.848 18.177,27.853 18.159,27.858 C18.148,27.861 18.138,27.863 18.128,27.866 C18.109,27.872 18.091,27.878 18.073,27.885 C18.064,27.888 18.054,27.891 18.045,27.895 C18.027,27.902 18.009,27.911 17.991,27.919 C17.983,27.924 17.975,27.927 17.966,27.932 C17.949,27.941 17.931,27.950 17.914,27.961 C17.906,27.966 17.899,27.970 17.891,27.975 C17.874,27.986 17.858,27.997 17.842,28.009 C17.835,28.014 17.827,28.020 17.820,28.025 C17.804,28.037 17.789,28.050 17.774,28.063 C17.767,28.069 17.761,28.076 17.754,28.082 C17.739,28.095 17.726,28.109 17.712,28.123 C17.705,28.130 17.699,28.138 17.692,28.145 C17.680,28.159 17.667,28.174 17.656,28.188 C17.649,28.197 17.643,28.206 17.636,28.215 C17.625,28.229 17.615,28.244 17.605,28.260 C17.599,28.269 17.593,28.280 17.587,28.290 C17.578,28.305 17.569,28.320 17.561,28.335 C17.555,28.347 17.549,28.359 17.544,28.371 C17.537,28.386 17.530,28.400 17.524,28.416 C17.518,28.429 17.513,28.443 17.509,28.457 C17.503,28.472 17.498,28.486 17.494,28.501 C17.489,28.517 17.485,28.534 17.481,28.551 C17.478,28.564 17.474,28.576 17.471,28.590 C17.467,28.614 17.463,28.639 17.460,28.664 C17.460,28.670 17.459,28.676 17.458,28.682 C17.457,28.691 17.457,28.700 17.457,28.710 C17.455,28.732 17.453,28.755 17.453,28.778 C17.454,28.786 17.455,28.795 17.455,28.803 C17.455,28.826 17.456,28.850 17.459,28.873 C17.459,28.876 17.460,28.880 17.460,28.884 C17.506,29.282 17.803,29.615 18.200,29.700 C18.204,29.701 18.207,29.702 18.211,29.702 C18.242,29.709 18.274,29.714 18.306,29.716 C18.310,29.717 18.314,29.717 18.318,29.718 L19.056,29.800 L19.311,27.923 L18.789,27.865 ZM29.784,29.097 L21.052,28.118 L20.797,29.996 L32.347,31.291 C32.596,31.313 32.840,31.238 33.033,31.079 C33.228,30.918 33.348,30.691 33.373,30.439 C33.423,29.919 33.043,29.455 32.525,29.404 C32.520,29.404 32.516,29.404 32.512,29.403 L29.794,29.098 C29.791,29.098 29.788,29.098 29.784,29.097 ZM33.211,12.067 C33.206,12.034 33.202,12.000 33.197,11.966 C33.185,11.882 33.172,11.798 33.159,11.714 C33.154,11.679 33.148,11.644 33.142,11.609 C33.099,11.342 33.050,11.076 32.997,10.812 C32.988,10.770 32.980,10.727 32.971,10.684 C32.955,10.610 32.940,10.535 32.923,10.461 C32.913,10.412 32.902,10.364 32.891,10.316 C32.866,10.207 32.841,10.098 32.814,9.989 C32.798,9.923 32.783,9.857 32.766,9.791 C32.751,9.731 32.735,9.671 32.720,9.611 C32.703,9.548 32.687,9.485 32.670,9.422 C32.655,9.367 32.640,9.311 32.625,9.257 C32.603,9.176 32.580,9.095 32.557,9.014 C32.547,8.979 32.537,8.943 32.527,8.908 C32.493,8.793 32.459,8.680 32.425,8.567 C32.414,8.532 32.403,8.497 32.392,8.462 C32.364,8.373 32.336,8.283 32.308,8.195 C32.298,8.165 32.289,8.137 32.280,8.107 C32.201,7.866 32.120,7.629 32.038,7.397 C32.034,7.387 32.031,7.378 32.027,7.368 C31.194,5.033 30.194,3.182 29.708,2.343 C28.104,2.639 23.368,3.692 19.535,6.353 L33.288,12.710 C33.266,12.495 33.240,12.280 33.211,12.067 ZM35.308,20.559 C34.690,22.458 35.726,24.508 37.618,25.129 C37.982,25.249 38.359,25.309 38.740,25.309 C40.306,25.309 41.685,24.305 42.171,22.811 L42.927,20.489 C42.995,20.280 43.044,20.068 43.073,19.855 C42.986,19.855 42.898,19.853 42.811,19.849 C42.799,19.848 42.787,19.847 42.775,19.847 C42.563,19.836 42.352,19.811 42.143,19.773 C42.131,19.771 42.118,19.769 42.106,19.767 C42.006,19.748 41.907,19.726 41.808,19.701 C41.791,19.697 41.774,19.692 41.758,19.688 C41.658,19.661 41.558,19.633 41.459,19.601 L39.854,19.073 C39.819,19.062 39.784,19.053 39.749,19.045 C39.738,19.042 39.727,19.041 39.716,19.039 C39.691,19.034 39.667,19.030 39.643,19.027 C39.635,19.026 39.627,19.026 39.619,19.025 C39.591,19.022 39.563,19.020 39.535,19.020 C39.533,19.020 39.529,19.020 39.527,19.020 C39.143,19.018 38.780,19.224 38.586,19.562 C38.586,19.563 38.585,19.564 38.584,19.565 C38.569,19.592 38.556,19.619 38.543,19.647 C38.540,19.652 38.538,19.658 38.535,19.663 C38.521,19.696 38.508,19.730 38.496,19.765 L38.448,19.910 C38.435,19.951 38.418,19.990 38.399,20.028 C38.395,20.036 38.391,20.044 38.387,20.051 C38.367,20.087 38.346,20.122 38.322,20.154 C38.318,20.159 38.314,20.165 38.310,20.170 C38.287,20.199 38.263,20.227 38.237,20.254 C38.233,20.257 38.229,20.262 38.225,20.266 C38.196,20.294 38.165,20.319 38.133,20.343 C38.127,20.347 38.121,20.352 38.114,20.356 C38.081,20.379 38.046,20.401 38.010,20.419 C38.010,20.419 38.010,20.419 38.010,20.419 C37.973,20.437 37.935,20.453 37.897,20.465 C37.890,20.468 37.883,20.470 37.876,20.473 C37.838,20.484 37.799,20.494 37.760,20.501 C37.754,20.501 37.748,20.502 37.742,20.503 C37.704,20.508 37.666,20.511 37.628,20.512 C37.624,20.512 37.621,20.513 37.617,20.513 C37.616,20.513 37.615,20.512 37.613,20.512 C37.574,20.512 37.534,20.509 37.493,20.503 C37.485,20.501 37.476,20.500 37.467,20.498 C37.427,20.491 37.386,20.482 37.345,20.469 L35.531,19.874 L35.308,20.559 ZM44.860,14.459 C44.521,14.527 44.168,14.507 43.840,14.399 L40.523,13.310 C39.100,12.844 37.565,13.626 37.101,15.053 L36.075,18.203 L36.078,18.204 L37.146,18.554 C37.188,18.490 37.233,18.428 37.280,18.367 C37.282,18.364 37.284,18.361 37.286,18.359 C37.331,18.301 37.378,18.246 37.427,18.191 C37.429,18.188 37.432,18.185 37.435,18.182 C37.636,17.962 37.873,17.774 38.139,17.625 C38.145,17.622 38.150,17.619 38.156,17.615 C38.184,17.600 38.211,17.584 38.240,17.569 C38.766,17.302 39.348,17.207 39.920,17.291 C39.926,17.291 39.932,17.292 39.937,17.293 C40.010,17.304 40.082,17.318 40.154,17.335 C40.163,17.337 40.172,17.339 40.181,17.341 C40.254,17.359 40.326,17.379 40.398,17.403 L42.004,17.930 C42.574,18.117 43.183,18.148 43.765,18.017 C44.919,17.760 45.863,16.902 46.229,15.778 L46.784,14.070 L44.860,14.459 ZM13.696,14.922 C11.600,20.989 9.728,29.692 9.077,36.338 L11.275,37.354 L12.382,33.614 C12.394,33.573 12.409,33.534 12.426,33.496 C12.729,32.835 13.271,32.333 13.951,32.080 C14.631,31.828 15.368,31.857 16.027,32.161 C16.686,32.466 17.187,33.009 17.438,33.692 C17.689,34.375 17.661,35.115 17.357,35.776 C17.340,35.814 17.320,35.851 17.297,35.886 L15.185,39.162 L17.946,40.438 C18.385,40.641 18.577,41.163 18.375,41.604 C18.228,41.926 17.911,42.116 17.579,42.116 C17.457,42.116 17.332,42.090 17.214,42.035 L14.224,40.653 L12.218,43.764 C11.953,44.175 11.514,44.404 11.057,44.404 C10.861,44.404 10.661,44.362 10.470,44.273 C9.836,43.981 9.521,43.281 9.719,42.609 L10.771,39.056 L7.782,37.674 C7.446,37.519 7.243,37.168 7.276,36.798 C7.878,29.955 9.838,20.723 12.042,14.346 C12.200,13.888 12.699,13.645 13.156,13.804 C13.613,13.963 13.855,14.464 13.696,14.922 ZM15.788,34.992 C15.875,34.770 15.878,34.527 15.795,34.301 C15.706,34.059 15.529,33.866 15.295,33.758 C15.061,33.650 14.799,33.640 14.558,33.729 C14.333,33.813 14.151,33.973 14.040,34.184 L12.115,40.690 L15.788,34.992 ZM7.948,46.646 L10.535,46.646 C11.018,46.646 11.410,47.039 11.410,47.525 C11.410,48.010 11.018,48.403 10.535,48.403 L7.948,48.403 C7.464,48.403 7.072,48.010 7.072,47.525 C7.072,47.039 7.464,46.646 7.948,46.646 ZM11.410,52.570 C11.410,53.055 11.018,53.449 10.535,53.449 L4.420,53.449 C3.937,53.449 3.545,53.055 3.545,52.570 C3.545,52.084 3.937,51.691 4.420,51.691 L10.535,51.691 C11.018,51.691 11.410,52.084 11.410,52.570 ZM11.410,57.615 C11.410,58.101 11.018,58.494 10.535,58.494 L1.834,58.494 C1.350,58.494 0.958,58.101 0.958,57.615 C0.958,57.130 1.350,56.736 1.834,56.736 L10.535,56.736 C11.018,56.736 11.410,57.130 11.410,57.615 Z"/>
	   </svg>';
	} elseif( $icon == 'icon3' ){
		$icon = '<svg 
		xmlns="http://www.w3.org/2000/svg"
		xmlns:xlink="http://www.w3.org/1999/xlink"
		width="55px" height="61px">
	   <path fill-rule="evenodd"  fill="rgb(255, 126, 0)"
		d="M27.958,60.500 C27.105,60.500 26.255,60.250 25.500,59.779 L2.350,45.290 C1.491,44.752 0.958,43.672 0.959,42.470 C0.959,41.270 1.492,40.191 2.350,39.654 L7.412,36.486 L2.350,33.318 C1.492,32.780 0.959,31.700 0.959,30.500 C0.959,29.300 1.491,28.220 2.349,27.683 L7.412,24.514 L2.349,21.345 C1.492,20.808 0.959,19.728 0.959,18.528 C0.959,17.327 1.492,16.248 2.349,15.711 L25.499,1.222 C26.254,0.750 27.105,0.500 27.958,0.500 C28.812,0.500 29.662,0.750 30.417,1.222 L53.567,15.710 C54.425,16.248 54.958,17.327 54.958,18.528 C54.958,19.711 54.440,20.778 53.603,21.322 L53.520,21.355 L53.489,21.394 L48.504,24.514 L53.567,27.683 C54.425,28.220 54.958,29.300 54.958,30.500 C54.958,31.700 54.425,32.780 53.567,33.318 L48.504,36.486 L53.567,39.655 C54.425,40.191 54.958,41.270 54.958,42.471 C54.958,43.672 54.425,44.752 53.567,45.290 L30.417,59.779 C29.662,60.250 28.812,60.500 27.958,60.500 ZM3.001,41.285 C2.634,41.514 2.415,41.958 2.415,42.471 C2.415,42.985 2.634,43.429 3.001,43.659 L26.151,58.148 C26.706,58.495 27.331,58.679 27.958,58.679 C28.585,58.679 29.210,58.495 29.766,58.148 L52.916,43.659 C53.283,43.429 53.502,42.985 53.502,42.471 C53.502,41.958 53.283,41.515 52.916,41.285 L46.876,37.505 L30.417,47.806 C29.662,48.278 28.812,48.528 27.958,48.528 C27.105,48.528 26.255,48.278 25.500,47.806 L9.041,37.505 L3.001,41.285 ZM3.001,29.313 C2.634,29.543 2.415,29.987 2.415,30.500 C2.415,31.013 2.634,31.457 3.001,31.687 L26.151,46.175 C26.706,46.523 27.331,46.707 27.958,46.707 C28.585,46.707 29.210,46.523 29.766,46.175 L52.916,31.687 C53.283,31.457 53.502,31.013 53.502,30.500 C53.502,29.987 53.283,29.543 52.916,29.313 L46.876,25.533 L30.417,35.834 C29.662,36.306 28.812,36.556 27.958,36.556 C27.104,36.556 26.254,36.306 25.500,35.834 L9.041,25.533 L3.001,29.313 ZM27.959,2.321 C27.331,2.321 26.706,2.505 26.150,2.852 L3.001,17.341 C2.634,17.571 2.415,18.015 2.415,18.528 C2.415,19.041 2.634,19.485 3.001,19.715 L26.151,34.204 C26.707,34.551 27.332,34.735 27.958,34.735 C28.585,34.735 29.210,34.551 29.766,34.204 L52.915,19.715 C53.283,19.485 53.502,19.041 53.502,18.528 C53.502,18.014 53.283,17.571 52.916,17.341 L29.766,2.852 C29.210,2.505 28.585,2.321 27.959,2.321 Z"/>
	   </svg>';
	} else {
		$icon = '<svg 
		xmlns="http://www.w3.org/2000/svg"
		xmlns:xlink="http://www.w3.org/1999/xlink"
		width="16px" height="9px">
		<path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
		d="M10.814,8.345 L11.570,9.001 L16.000,4.828 L16.000,4.171 L11.570,-0.002 L10.849,0.654 L14.346,4.035 L-0.000,4.035 L-0.000,4.963 L14.346,4.963 L10.814,8.345 Z"/>
		</svg>';
	}

	return $icon;
}



/**================================================
	Themify Icon
 =================================================*/
function heaven_themify_icon(){
    return[
        'flaticon-chip'     => __('Flaticon Chip', 'heaven'),
        'flaticon-cap'      => __('Flaticon Cap', 'heaven'),
        'flaticon-wallet'   => __('Flaticon Wallet', 'heaven'),
        'flaticon-audio'    => __('Flaticon Audio', 'heaven'),
    ];
}


/*===========================================================
	Set contact form 7 default form template
============================================================*/
function heaven_contact7_form_content( $template, $prop ) {
    
    if ( 'form' == $prop ) {

        $template =
            '<div class="row"><div class="col-12"><div class="form-group">[textarea* your-message id:message class:form-control class:w-100 rows:9 cols:30 placeholder "Message"]</div></div><div class="col-sm-6"><div class="form-group">[text* your-name id:name class:form-control placeholder "Enter your  name"]</div></div><div class="col-sm-6"><div class="form-group">[email* your-email id:email class:form-control placeholder "Enter your email"]</div></div><div class="col-12"><div class="form-group">[text your-subject id:subject class:form-control placeholder "Subject"]</div></div></div><div class="form-group mt-3">[submit class:button class:button-contactForm class:btn_4 "Send Message"]</div>';

        return $template;

    } else {
    return $template;
    } 
}
add_filter( 'wpcf7_default_template', 'heaven_contact7_form_content', 10, 2 );



/*============================================================
	Pagination
=============================================================*/
function heaven_blog_pagination(){
	echo '<nav class="blog-pagination justify-content-center d-flex">';
        the_posts_pagination(
            array(
                'mid_size'  => 2,
                'prev_text' => __( '<span class="ti-angle-left"></span>', 'heaven' ),
                'next_text' => __( '<span class="ti-angle-right"></span>', 'heaven' ),
                'screen_reader_text' => ' '
            )
        );
	echo '</nav>';
}


/*=============================================================
	Blog Single Post Navigation
=============================================================*/
if( ! function_exists('heaven_blog_single_post_navigation') ) {
	function heaven_blog_single_post_navigation() {

		// Start nav Area
		if( get_next_post_link() || get_previous_post_link()   ):
			?>
			<div class="navigation-area">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
						<?php
						if( get_next_post_link() ){
							$nextPost = get_next_post();

							if( has_post_thumbnail() ){
								?>
								<div class="thumb">
									<a href="<?php the_permalink(  absint( $nextPost->ID )  ) ?>">
										<?php echo get_the_post_thumbnail( absint( $nextPost->ID ), 'heaven_np_thumb', array( 'class' => 'img-fluid' ) ) ?>
									</a>
								</div>
								<?php
							} ?>
							<div class="arrow">
								<a href="<?php the_permalink(  absint( $nextPost->ID )  ) ?>">
									<span class="ti-arrow-left text-white"></span>
								</a>
							</div>
							<div class="detials">
								<p><?php echo esc_html__( 'Prev Post', 'heaven' ); ?></p>
								<a href="<?php the_permalink(  absint( $nextPost->ID )  ) ?>">
									<h4><?php echo wp_trim_words( get_the_title( $nextPost->ID ), 4, ' ...' ); ?></h4>
								</a>
							</div>
							<?php
						} ?>
					</div>
					<div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
						<?php
						if( get_previous_post_link() ){
							$prevPost = get_previous_post();
							?>
							<div class="detials">
								<p><?php echo esc_html__( 'Next Post', 'heaven' ); ?></p>
								<a href="<?php the_permalink(  absint( $prevPost->ID )  ) ?>">
									<h4><?php echo wp_trim_words( get_the_title( $prevPost->ID ), 4, ' ...' ); ?></h4>
								</a>
							</div>
							<div class="arrow">
								<a href="<?php the_permalink(  absint( $prevPost->ID )  ) ?>">
									<span class="ti-arrow-right text-white"></span>
								</a>
							</div>
							<div class="thumb">
								<a href="<?php the_permalink(  absint( $prevPost->ID )  ) ?>">
									<?php echo get_the_post_thumbnail( absint( $prevPost->ID ), 'heaven_np_thumb', array( 'class' => 'img-fluid' ) ) ?>
								</a>
							</div>
							<?php
						} ?>
					</div>
				</div>
			</div>
		<?php
		endif;

	}
}


/*=======================================================
	Author Bio
=======================================================*/
function heaven_author_bio(){
	$avatar = get_avatar( absint( get_the_author_meta( 'ID' ) ), 90 );
	?>
	<div class="blog-author">
		<div class="media align-items-center">
			<?php
			if( $avatar  ) {
				echo wp_kses_post( $avatar );
			}
			?>
			<div class="media-body">
				<a href="<?php echo esc_url( get_author_posts_url( absint( get_the_author_meta( 'ID' ) ) ) ); ?>"><h4><?php echo esc_html( get_the_author() ); ?></h4></a>
				<p><?php echo esc_html( get_the_author_meta('description') ); ?></p>
			</div>
		</div>
	</div>
	<?php
}


/*===================================================
 Heaven Comment Template Callback
 ====================================================*/
function heaven_comment_callback( $comment, $args, $depth ) {

	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
	?>
	<<?php echo esc_attr( $tag ); ?> <?php comment_class( ( empty( $args['has_children'] ) ? '' : 'parent').' comment-list' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-list">
	<?php endif; ?>
		<div class="single-comment">
			<div class="user d-flex">
				<div class="thumb">
					<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</div>
				<div class="desc">
					<div class="comment">
						<?php comment_text(); ?>
					</div>

					<div class="d-flex justify-content-between">
						<div class="d-flex align-items-center">
							<h5 class="comment_author"><?php printf( __( '<span class="comment-author-name">%s</span> ', 'heaven' ), get_comment_author_link() ); ?></h5>
							<p class="date"><?php printf( __('%1$s at %2$s', 'heaven'), get_comment_date(),  get_comment_time() ); ?><?php edit_comment_link( esc_html__( '(Edit)', 'heaven' ), '  ', '' ); ?> </p>
							<?php if ( $comment->comment_approved == '0' ) : ?>
								<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'heaven' ); ?></em>
								<br>
							<?php endif; ?>
						</div>

						<div class="reply-btn">
							<?php comment_reply_link(array_merge( $args, array( 'add_below' => $add_below, 'depth' => 1, 'max_depth' => 5, 'reply_text' => 'Reply' ) ) ); ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	<?php if ( 'div' != $args['style'] ) : ?>
		</div>
	<?php endif; ?>
	<?php
}
// add class comment reply link
add_filter('comment_reply_link', 'heaven_replace_reply_link_class');
function heaven_replace_reply_link_class( $class ) {
	$class = str_replace("class='comment-reply-link", "class='btn-reply comment-reply-link text-uppercase", $class);
	return $class;
}



/*=========================================================
    Latest Blog Post For Elementor Section
===========================================================*/
function heaven_latest_blog( $pNumber = 3, $post_cat = ['inspiration', 'modern-technology'], $post_order = 'DESC', $excerpt_limit = 40 ){
	
	$lBlog = new WP_Query( array(
		'post_type'      => 'post',
		'category_name'	 => implode(', ', $post_cat),
		'posts_per_page' => $pNumber,
		'order'			 => $post_order
    ) );

    if( $lBlog->have_posts() ){
        while( $lBlog->have_posts() ){
			$lBlog->the_post();
			$categories = get_the_category();
	?>
			
		<div class="single_blog_post">
			<div class="row">
				<div class="col-lg-7">
					<div class="single_img">
						<a href="<?php the_permalink(); ?>">
							<?php
								if( has_post_thumbnail() ){
									the_post_thumbnail( 'heaven_latest_blog_712x421', ['alt' => get_the_title() ] );
								}
							?>
						</a>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="single_project_text">
						<div class="single_project_tittle">
							<h4> <a href="<?php the_permalink(); ?>"><?php echo get_the_author_meta('display_name') ?></a></h4>
							<p><?php echo esc_html($categories[0]->name) ?></p>
							<span><?php the_time('M j, Y') ?></span>
						</div>
						<p><?php echo heaven_excerpt_length( $excerpt_limit ) ?></p>
					</div>
				</div>
			</div>
		</div>
        <?php
        }

    }

}



/*=========================================================
    Share Button Code
===========================================================*/
function heaven_social_sharing_buttons( $ulClass = '', $tagLine = '' ) {

	// Get page URL
	$URL = get_permalink();
	$Sitetitle = get_bloginfo('name');

	// Get page title
	$Title = str_replace( ' ', '%20', get_the_title());

	// Construct sharing URL without using any script
	$twitterURL = 'https://twitter.com/intent/tweet?text='.esc_html( $Title ).'&amp;url='.esc_url( $URL ).'&amp;via='.esc_html( $Sitetitle );
	$facebookURL= 'https://www.facebook.com/sharer/sharer.php?u='.esc_url( $URL );
	$linkedin   = 'https://www.linkedin.com/shareArticle?mini=true&url='.esc_url( $URL ).'&title='.esc_html( $Title );
	$pinterest  = 'http://pinterest.com/pin/create/button/?url='.esc_url( $URL ).'&description='.esc_html( $Title );;

	// Add sharing button at the end of page/page content
	$content = '';
	$content  .= '<ul class="'.esc_attr( $ulClass ).'">';
	$content .= $tagLine;
	$content .= '<li><a href="' . esc_url( $facebookURL ) . '" target="_blank"><i class="ti-facebook"></i></a></li>';
	$content .= '<li><a href="' . esc_url( $twitterURL ) . '" target="_blank"><i class="ti-twitter-alt"></i></a></li>';
	$content .= '<li><a href="' . esc_url( $pinterest ) . '" target="_blank"><i class="ti-pinterest"></i></a></li>';
	$content .= '<li><a href="' . esc_url( $linkedin ) . '" target="_blank"><i class="ti-linkedin"></i></a></li>';
	$content .= '</ul>';

	return $content;

}




/*================================================
    Heaven Custom Posts
================================================*/
function heaven_custom_posts() {
	
	// Portfolio Custom Post
	
	$labels = array(
		'name'               => _x( 'Portfolios', 'post type general name', 'heaven' ),
		'singular_name'      => _x( 'Portfolio', 'post type singular name', 'heaven' ),
		'menu_name'          => _x( 'Portfolios', 'admin menu', 'heaven' ),
		'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'heaven' ),
		'add_new'            => _x( 'Add New', 'portfolio', 'heaven' ),
		'add_new_item'       => __( 'Add New Portfolio', 'heaven' ),
		'new_item'           => __( 'New Portfolio', 'heaven' ),
		'edit_item'          => __( 'Edit Portfolio', 'heaven' ),
		'view_item'          => __( 'View Portfolio', 'heaven' ),
		'all_items'          => __( 'All Portfolios', 'heaven' ),
		'search_items'       => __( 'Search Portfolios', 'heaven' ),
		'parent_item_colon'  => __( 'Parent Portfolios:', 'heaven' ),
		'not_found'          => __( 'No portfolios found.', 'heaven' ),
		'not_found_in_trash' => __( 'No portfolios found in Trash.', 'heaven' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'heaven' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'portfolio' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'portfolio', $args );

	$labels = array(
		'name'              => _x( 'Portfolio Category', 'taxonomy general name', 'heaven' ),
		'singular_name'     => _x( 'Portfolio Categories', 'taxonomy singular name', 'heaven' ),
		'search_items'      => __( 'Search Portfolio Categories', 'heaven' ),
		'all_items'         => __( 'All Portfolio Categories', 'heaven' ),
		'parent_item'       => __( 'Parent Portfolio Category', 'heaven' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:', 'heaven' ),
		'edit_item'         => __( 'Edit Portfolio Category', 'heaven' ),
		'update_item'       => __( 'Update Portfolio Category', 'heaven' ),
		'add_new_item'      => __( 'Add New Portfolio Category', 'heaven' ),
		'new_item_name'     => __( 'New Portfolio Category Name', 'heaven' ),
		'menu_name'         => __( 'Portfolio Category', 'heaven' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'portfolio-cat' ),
	);

	register_taxonomy( 'portfolio-cat', array( 'portfolio' ), $args );

}
add_action( 'init', 'heaven_custom_posts' );




/*=========================================================
    Portfolio Section
========================================================*/
function heaven_portfolio_section( $pNumber, $excerpt_limit, $read_more_txt ){

	$portfolios = new WP_Query( array(
		'post_type' => 'portfolio',
		'order'		=> 'ASC',
		'posts_per_page'=> $pNumber,

	) );
	$count = 0;
	
	$taxonomy = get_terms('portfolio-cat');
	if( $portfolios->have_posts() ) {
		while ( $portfolios->have_posts() ) {
			$portfolios->the_post();
			$client_name    = heaven_meta( 'client_name' );
			$client_img     = heaven_meta( 'client_img' );
			$client_img_src = wp_get_attachment_image( $client_img, 'heaven_widget_post_thumb', false, array( 'class' => 'client_img', 'alt' => 'client image' ) );
			$count++;
			?>
			<?php if ( $count % 2 != 0 ) { ?>
			<div class="single_project_slide">
				<div class="row">
				
					<div class="col-lg-6 col-md-6">
						<?php the_post_thumbnail( 'heaven_portfolio_image_540x516', ['alt' => get_the_title() ] );?>
						<div class="single_project_text">
							<?php echo $client_img_src?>
							<a href="<?php the_permalink(); ?>" class="admin_name"><?php echo $client_name?></a>
							<span><?php echo $taxonomy[0]->name?></span>
							<p><?php echo heaven_excerpt_length( $excerpt_limit ) ?></p>
							<a href="<?php the_permalink(); ?>" class="btn_1"><?php echo $read_more_txt ?> <span><?php echo get_heaven_svg_icon()?></span> </a>
						</div>
					</div>
				<?php } else { ?>
					<div class="col-lg-6 col-md-6">
						<?php the_post_thumbnail( 'heaven_portfolio_image_540x516', ['alt' => get_the_title() ] );?>
						<div class="single_project_text">
							<?php echo $client_img_src?>
							<a href="<?php the_permalink(); ?>" class="admin_name"><?php echo $client_name?></a>
							<span><?php echo $taxonomy[0]->name?></span>
							<p><?php echo heaven_excerpt_length( $excerpt_limit ) ?></p>
							<a href="<?php the_permalink(); ?>" class="btn_1"><?php echo $read_more_txt ?> <span><?php echo get_heaven_svg_icon()?></span> </a>
						</div>
					</div>
				</div>
			</div>
			<?php }
		}
	}
}
