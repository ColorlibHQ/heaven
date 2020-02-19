<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit( 'Direct script access denied.' );
} 
/**
 * @Packge     : HEAVEN
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
 
// enqueue css
function heaven_common_custom_css(){
    
    wp_enqueue_style( 'heaven-common', get_template_directory_uri().'/assets/css/dynamic.css' );
		$header_bg         		  = esc_url( get_header_image() );
		$header_bg_img 			  = !empty( $header_bg ) ? 'background-image: url('.esc_url( $header_bg ).')' : '';

		$themeColor     		  = heaven_opt( 'heaven_theme_color' );

		$headerBg          		  = heaven_opt( 'heaven_header_bg_color');
		$menuBgColor          	  = heaven_opt( 'heaven_menu_bg_color' );
		$menuColor          	  = heaven_opt( 'heaven_header_menu_color' );
		$menuHoverColor           = heaven_opt( 'heaven_header_menu_hover_color' ) != '#fe5c24' ? heaven_opt('heaven_header_menu_hover_color') : $themeColor;

		$footerwbgColor     	  = heaven_opt('heaven_footer_bg_color') != '#161f23' ? heaven_opt('heaven_footer_bg_color') : '';
		$footerwTextColor   	  = heaven_opt('heaven_footer_widget_text_color');
		$widgettitlecolor  		  = heaven_opt('heaven_footer_widget_title_color');
		$footerwanchorcolor 	  = heaven_opt('heaven_footer_widget_anchor_color') != '#ff7e00' ? heaven_opt('heaven_footer_widget_anchor_color') : '';
		$footerwanchorhovcolor    = heaven_opt('heaven_footer_widget_anchor_hover_color');
		
		$fofbg					  = heaven_opt('heaven_fof_bg_color');
		$foftonecolor			  = heaven_opt('heaven_fof_textone_color');
		$fofttwocolor			  = heaven_opt('heaven_fof_texttwo_color');

		$gradientBgColor 		  = $themeColor != '#ab7636' ? $themeColor : '';
		$footerAncDefColor 		  = heaven_opt('heaven_footer_widget_anchor_color') != '#ff7e00' ? heaven_opt('heaven_footer_widget_anchor_color') : $themeColor;
		$footerAncDefHovColor 	  = $footerwanchorhovcolor != '#ff7e00' ? $footerwanchorhovcolor : $themeColor;

		$customcss ="
			.hero-banner{
				{$header_bg_img}
			}

			.banner_part .banner_text h5, .cta_part .cta_part_iner .cta_part_text p, .about_part .about_text h5, .our_latest_work .single_work_demo h5, .blog_part .single-home-blog .card h5:hover, .blog_part .single-home-blog .card ul li i, .review_part .slick_right:hover, .review_part .slick_left:hover, .blog_part .single-home-blog a, .blog_part .single-home-blog .time, .blog_part .single-home-blog li span, .single_single_service span.fa, section.cta_area a.cta_btn:hover, .sub_menu .sub_menu_right_content i, .sub_menu .sub_menu_social_icon a:hover, .banner-breadcrumb .breadcrumb-item a, .banner_part .banner_text h5 span, .banner_part .banner_text .btn_1:hover, .service_part .single_service_part i, .about_part .about_text h4, .our_industries .single_industries h3 a:hover, .portfolio_part .card-columns .portfolio_btn, .see_more_project .btn_1:hover, .post_2 .post_text_1 h3:hover, .post_2 .category_post_img .category_btn, .footer-area .copyright_part_text a, .subscribe_area .subscribe_iner .btn_2:hover, .sl-button span:hover, .blog_right_sidebar .widget_heaven_recent_widget .post_item .media-body h3:hover, .project_details .project_details_widget .single_project_details_widget span, .blog_right_sidebar .widget_heaven_newsletter .btn_1, .blog_right_sidebar .single_sidebar_widget.widget_heaven_newsletter .btn:hover, .btn_1:hover, .blog_part .single_project_text .single_project_tittle span, .project_details_sidebar i
			{
				color: {$themeColor}
			}			
			.portfolio_part .card-columns .portfolio_btn path, .our_speciality .single_special_part svg path, .single_page_special .single_page_special_item .single_slide_item svg path{
				fill: {$themeColor}
			}
			.our_latest_work .single_work_demo .btn_3:hover, .team_member_section .single_team_member .single_team_text h3 a:hover, .team_member_section .single_team_member .team_member_social_icon a:hover, .blog_part .single-home-blog .card .card-body a:hover, .pre_icon a:hover, .next_icon a:hover, .review_part .section_tittle p, .banner-breadcrumb > ol > li.breadcrumb-item > a.bread-link:hover, .review_part .section_tittle p, .banner-breadcrumb .breadcrumb-item a:hover, .blog_details a:hover, .blog_right_sidebar .widget_categories ul li:hover, .blog_right_sidebar .widget_categories ul li:hover a, .blog_right_sidebar .widget_categories ul li a:hover, .blog_area a h2:hover, .main_menu .main-menu-item ul li a:not(.dropdown-item):hover, .post_2 .category_post_img .category_btn:hover, .button:hover, .banner_part .banner_text .btn_1:hover, .main_menu .off-canven-menu ul li a:hover{
				color: {$themeColor}!important;
			}

			.review_part .intro_video_bg .video-play-button, .review_part .owl-prev span:after, .review_part .owl-next span:after, .review_part .intro_video_bg .video-play-button:after, .review_part .intro_video_bg .video-play-button:before, .review_part .intro_video_bg .video-play-button:hover:after, .blog_item_img .blog_item_date, .single_sidebar_widget .tagcloud a:hover, .blog_right_sidebar .single_sidebar_widget.widget_heaven_newsletter .btn, .pre_icon :after, .next_icon :after, section.cta_area, .service_part .single_service_part .line:after, .service_part .single_service_part:hover, .about_part .about_text .btn_2:hover, .section_tittle h2:after, .our_industries .single_industries h3:after, .faq_part .faq_content .active .accordion-header h2:before, .portfolio_part .card-columns .blockquote h2:after, .see_more_project .btn_1, .contact-section .btn_2:hover, .btn_1 span, .contact_us .contact_us_iner, .single_page_special .single_page_special_item .single_slide_item:hover, .btn_4
			{
				background: {$themeColor}
			}

			.our_Professional .single_industries_text:hover{
				border-color: {$themeColor};
				background-color: {$themeColor};
			}
			.btn_4:hover{
				color: {$themeColor}!important;
			}

			.service_part .single_service_part:hover .single_service_part_iner span, .service_part .owl-prev:hover, .service_part .owl-next:hover, .project_part .owl-prev:hover, .project_part .owl-next:hover, .blog_part .owl-next, .single_page_special .owl-prev:hover, .single_page_special .owl-next:hover
			{
				background: {$themeColor}!important;
			}

			.btn_4, .about_part .about_img h2:after, .copyright_part .footer-social a, .service_part .service_text
			{
				border-color: {$themeColor}
			}

			.main_menu.menu_fixed
			{
				background: {$headerBg};
			}
			.main_menu .off-canven-menu{
				background: {$menuBgColor};
			}
			.main_menu .off-canven-menu ul li a
			{
			   color: {$menuColor};
			}
			.main_menu .off-canven-menu ul li a:hover
			{
			   color: {$menuHoverColor};
			}

			.footer-area {
				background: {$footerwbgColor};
			}

			.footer-area .single-footer-widget p, .footer-area .widget_heaven_newsletter .input-group input, .footer-area .copyright_part_text p, .footer-area .footer_2 .social_icon a, .footer-area p.footer-text
			{
				color: {$footerwTextColor}
			}
			.footer-area .widget_heaven_newsletter .input-group, .footer-area .copyright_part_text, .footer-area p.footer-text {
				border-color: {$footerwTextColor}
			}
			.footer-area .single-footer-widget h4, .footer-area .contact_info p span
			{
				color: {$widgettitlecolor}
			}

			.footer-area .copyright_part_text a, .footer-area .social_icon a, .footer-area .single-footer-widget ul li a
			{
			   color: {$footerwanchorcolor};
			}
			.footer-area .copyright_part_text .footer-text > a
			{
			   color: {$footerAncDefColor};
			}

			.copyright_part a{
				color: {$footerAncDefColor};
			}

			.footer-area .btn{
				background-color: {$footerAncDefColor};
			}
			.footer-area .btn{
				border-color: {$footerwanchorcolor};
			}
			.footer-area .social_icon a:hover, .footer-area .single-footer-widget ul li a:hover
			{
			   color: {$footerAncDefHovColor};
			}
			.footer-area .copyright_part_text a:hover, .footer-area .footer_2 .social_icon a:hover
			{
			   color: {$footerwanchorhovcolor}!important;
			}

			#f0f {
				background-color: {$fofbg};
			}
			.f0f-content .h1 {
				color: {$foftonecolor};
			}
			.f0f-content p {
				color: {$fofttwocolor};
			}

			.blog_right_sidebar .single_sidebar_widget .btn_1:hover, .comment_form .btn_1.button:hover, .search-page .button.button-contactForm:hover, .f0f-content .button.button-contactForm:hover{
				background: #fff;
			}

			.footer-area .btn:hover{
				color: #fff !important;
			}

        ";
       
    wp_add_inline_style( 'heaven-common', $customcss );
    
}
add_action( 'wp_enqueue_scripts', 'heaven_common_custom_css', 50 );