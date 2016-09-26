<?php
/**
 *  Define custom or extra function which needed for Aop
 *
 * @package Aop
 */

$aop_theme = wp_get_theme();
$aop_version = $aop_theme->get( 'Version' );

/**
 * Enqueue scripts and styles.
 */
function awesome_one_page_scripts() {
    global $aop_version;
    $aop_font_args = array(
        'family' => 'Open+Sans:400,600,700,400italic,300|Roboto:400,500,700,300,400italic',
    );
    wp_enqueue_style( 'aop-google-fonts', add_query_arg( $aop_font_args, "//fonts.googleapis.com/css" ) );

    //Register font-awesome style
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.css', false, '4.6.3' );

    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper.css', false, '3.3.1' );

    wp_enqueue_style( 'awesome-one-page-style', get_stylesheet_uri() );

    wp_enqueue_script( 'swiper', get_template_directory_uri() .'/js/swiper.js', array( 'jquery' ), '3.3.1', true );

    wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() .'/js/jquery.fitvids.js', array( 'jquery' ), '1.1', true );

    wp_enqueue_script( 'jquery-malihu-PageScroll2id', get_template_directory_uri() .'/js/jquery.malihu.PageScroll2id.js', array( 'jquery' ), '1.5.5', true );

    wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() .'/js/jquery.counterup.js', array( 'jquery' ), '1.0', true );

    wp_enqueue_script( 'waypoints', get_template_directory_uri() .'/js/jquery.waypoints.js', array( 'jquery' ), '4.0.1', true );
    
    wp_enqueue_script( 'awesome-one-page-custom-scripts', get_template_directory_uri() .'/js/custom.js', array( 'jquery' ), '', true );

    wp_enqueue_script( 'awesome-one-page-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

    wp_enqueue_script( 'awesome-one-page-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'awesome_one_page_scripts' );



function aop_admin_scripts() {
    global $aop_version;

    wp_enqueue_script( 'awesome-one-page-admin-script', get_template_directory_uri() .'/inc/assets/js/aop-admin-scripts.js', array( 'jquery' ), $aop_version, true );

    wp_enqueue_style( 'awesome-one-page-admin-style', get_template_directory_uri() . '/inc/assets/css/aop-admin-style.css', $aop_version );
}
add_action( 'admin_enqueue_scripts', 'aop_admin_scripts' );

/**
 * Added customizer scripts
 */
function awesome_one_page_customizer_script( $hook ) {
    global $aop_version;
    if ( ( 'customize.php' != $hook ) && ( 'widgets.php' != $hook ) ) {
        return;
    }

    //For image uploader
    wp_enqueue_media();
    wp_enqueue_script( 'awesome-one-page-media-uploader', get_template_directory_uri() . '/inc/assets/js/media-uploader.js', array( 'jquery' ), $aop_version, true );

    //For color
    wp_enqueue_style( 'wp-color-picker' );     
    wp_enqueue_script( 'awesome-one-page-color-picker', get_template_directory_uri() . '/inc/assets/js/color-picker.js', array( 'wp-color-picker' ), $aop_version, true ); 

    wp_enqueue_script( 'awesome-one-page-customizer-script', get_template_directory_uri() .'/inc/assets/js/aop-customizer-scripts.js', array('jquery', 'backbone', 'underscore'), $aop_version, true  );

    wp_enqueue_style( 'awesome-one-page-customizer-style', get_template_directory_uri() .'/inc/assets/css/aop-customizer-style.css', $aop_version );   
}
add_action('admin_enqueue_scripts', 'awesome_one_page_customizer_script');


/*--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'aop_the_custom_logo' ) ) :
    /**
     * Displays the optional custom logo.
     *
     * Does nothing if the custom logo is not available.
     */
    function aop_the_custom_logo() {
        if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo();
        }
    }
endif;

/*--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'aop_show_hide_breadcrumbs' ) ) :
    /**
     * Displays the optional to show the breadcrumbs in innerpages.
     */
    function aop_show_hide_breadcrumbs() {
        if ( get_theme_mod( 'aop_breadcrumbs_option', '1') !== '' ) {
            aop_breadcrumbs(); 
        }
    }
endif;

/*--------------------------------------------------------------------------------------------------*/
if( ! function_exists( 'aop_header_slider_hook' ) ):
    /**
     * Dispaly header slider
     */
    function aop_header_slider_hook() {
        $page_array = array();
        for ( $i=1; $i<=4; $i++ ) {
            $page_id = get_theme_mod( 'aop_slider_'.$i );
            if ( !empty ( $page_id ) )
                array_push( $page_array, $page_id );
        }
        $get_featured_posts = new WP_Query(
          array(
            'posts_per_page'     => -1,
            'post_type'          =>  array( 'page' ),
            'post__in'           => $page_array,
            'orderby'            => 'post__in'
        ) );

        if ( ! empty( $page_array ) ) : ?>
            <section id="home" class="banner-slider">
                <div class="owl-carousel">
                    <?php while( $get_featured_posts->have_posts() ) : $get_featured_posts->the_post(); 
                        $image_id = get_post_thumbnail_id();
                        $image_path = wp_get_attachment_image_src( $image_id, 'full', true );
                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );?>
                        <?php if ( has_post_thumbnail() ) : ?>
                        <div class="item slider">
                            <figure>
                                <?php if( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                    </a>
                                <?php endif; ?>                               
                            </figure>
                        </div>     
                        <div class="caption">
                          <div class="outer">
                            <div class="inner">
                              <h2><?php the_title(); ?></h2> 
                              <?php the_excerpt(); ?>
                              <a href="<?php the_permalink(); ?>"><?php echo esc_html( 'Read More', 'awesome-one-page' ); ?></a>
                            </div> 
                          </div> 
                        </div> 
                        </div>
                        <?php endif; ?>
                    <?php endwhile;
                    // Reset Post Data
                    wp_reset_postdata(); ?>
                </div>
            </section>
        <?php endif; 
    }
endif;
add_action( 'aop_header_slider', 'aop_header_slider_hook' );


