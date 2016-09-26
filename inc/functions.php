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

    wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() .'/js/jquery.waypoints.js', array( 'jquery' ), '4.0.1', true );
    
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

    wp_enqueue_script( 'awesome-one-page-admin-script', get_template_directory_uri() .'/inc/assets/js/admin-scripts.js', array( 'jquery' ), $aop_version, true );

    wp_enqueue_style( 'awesome-one-page-admin-style', get_template_directory_uri() . '/inc/assets/css/admin-style.css', $aop_version );
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

    wp_enqueue_script( 'awesome-one-page-customizer-script', get_template_directory_uri() .'/inc/assets/js/customizer-scripts.js', array('jquery', 'backbone', 'underscore'), $aop_version, true  );

    wp_enqueue_style( 'awesome-one-page-customizer-style', get_template_directory_uri() .'/inc/assets/css/customizer-style.css', $aop_version );   
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
if ( ! function_exists( 'awesome_one_page_display_breadcrumbs' ) ) :
    /**
     * Displays the optional to show the breadcrumbs in innerpages.
     */
    function awesome_one_page_display_breadcrumbs() {
        if ( get_theme_mod( 'awesome_one_page_breadcrumbs_activate', '1') !== '' ) {
            awesome_one_page_breadcrumbs(); 
        }
    }
endif;

/*--------------------------------------------------------------------------------------------------*/


