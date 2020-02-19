<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package heaven
 */

get_header();
$client_name              = heaven_meta( 'client_name' );
$client_img               = heaven_meta( 'client_img' );
$project_start_date       = heaven_meta( 'project_start_date' );
$project_end_date         = heaven_meta( 'project_end_date' );
$project_location         = heaven_meta( 'project_location' );
$project_architect        = heaven_meta( 'project_architect' );
$project_url              = heaven_meta( 'project_url' );
$client_img_src           = wp_get_attachment_image( $client_img, 'heaven_widget_post_thumb', false, array( 'alt' => 'client image' ) );
$taxonomy                 = get_terms('portfolio-cat');
$portfolio_project_desc   = heaven_opt('portfolio_project_des_title');
$portfolio_client_details = heaven_opt('portfolio_client_details');
$portfolio_gallery_toggl  = heaven_opt('portfolio_gallery_toggle');
$portfolio_gallery_title  = heaven_opt('portfolio_gallery_title');
?>

    <?php
        if( have_posts() ) {
            while( have_posts() ) : the_post();
    ?>
    <!-- project_details start-->
    <section class="project_details section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                        if ( has_post_thumbnail() ) {
                    ?>
                        <div class="project_details_img">
                            <?php
                                the_post_thumbnail( 'heaven_portfolio_single_image_1140x583', array( 'alt' => get_the_title() ) );
                            ?>
                        </div>
                    <?php
                        }
                    ?>
                </div>

                <div class="col-lg-8">
                    <div class="project_details_text">
                        <h2><?php echo esc_html( $portfolio_project_desc );?></h2>
                        <?php the_content()?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="project_details_sidebar">
                        <?php 
                            echo '<h4>'. $portfolio_client_details . '</h4>';
                            
                            if( !empty( $client_name ) ){
                                echo '<p><i class="ti-user"></i>'. esc_html__( 'Client: ', 'heaven' ) . '<span>' . esc_html( $client_name ) . '</span> </p>';
                            }
                            
                            if( count($taxonomy) > 0  ){
                                echo '<p><i class="ti-view-list-alt"></i>'. esc_html__( 'Category: ', 'heaven' ) . '<span>' . $taxonomy[0]->name . '</span> </p>';
                            }
                            
                            if( !empty( $project_start_date ) ){
                                echo '<p><i class="ti-power-off"></i>'. esc_html__( 'Starts on: ', 'heaven' ) . '<span>' . esc_html( $project_start_date ) . '</span> </p>';
                            }
                            
                            if( !empty( $project_end_date ) ){
                                echo '<p><i class="ti-flag-alt"></i>'. esc_html__( 'Ends on: ', 'heaven' ) . '<span>' . esc_html( $project_end_date ) . '</span> </p>';
                            }
                            
                            if( !empty( $project_location ) ){
                                echo '<p><i class="ti-location-pin"></i>'. esc_html__( 'Location: ', 'heaven' ) . '<span>' . esc_html( $project_location ) . '</span> </p>';
                            }
                            
                            if( !empty( $project_architect ) ){
                                echo '<p><i class="ti-pencil"></i>'. esc_html__( 'Architect: ', 'heaven' ) . '<span>' . esc_html( $project_architect ) . '</span> </p>';
                            }
                            
                            if( !empty( $project_url ) ){
                                echo '<p><i class="ti-world"></i>'. esc_html__( 'View project: ', 'heaven' ) . '<span>' . esc_html( $project_url ) . '</span> </p>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- project_details end-->

    <?php if ( $portfolio_gallery_toggl == 1 ) { ?>
    <!-- project details gallery start-->
    <section class="project_gallery padding_bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php 
                        echo '<h2>'. $portfolio_gallery_title . '</h2>';
                    ?>
                    <div class="grid gallery">
                        <div class="grid-sizer"></div>
                        <?php
                        $project_gallery = rwmb_meta( '_heaven_project_gallery', ['size' => 'heaven_portfolio_gallery_img_555x502'] );
                        $count = 1;
                        foreach ( $project_gallery as $image ) { ?>
                            <div class="grid-item<?php echo $count == 1 ? ' big_weight' : '';?>">
                                <a href="<?php echo esc_url($image['full_url'] )?>">
                                    <div class="project_img">
                                        <img src="<?php echo esc_url($image['url'] )?>" alt="gallery image">
                                    </div>
                                </a>
                            </div>
                        <?php $count++; } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- project details gallery start-->
    <?php
    }
        endwhile;
        }

// Footer============
get_footer();