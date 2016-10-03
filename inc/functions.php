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

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'awesome-one-page-fonts', awesome_one_page_fonts_url(), array(), null );

    // Enqueue Bootstrap Grid
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false, '3.3.5', '' );

    // Enqueue FontAwesome
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', false, '4.6.3' );

    // Enqueue Animate.css
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.min.css', false, '4.4.0', '' );

    // Enqueue Swiper.css
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper.css', false, '3.3.1' );

    wp_enqueue_style( 'awesome-one-page-style', get_stylesheet_uri() );

    // Enqueue Swiper
    wp_enqueue_script( 'swiper', get_template_directory_uri() .'/js/swiper.js', array( 'jquery' ), '3.3.1', true );

    // Enqueue Fitvids
    wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() .'/js/jquery.fitvids.js', array( 'jquery' ), '1.1', true );

    // Enqueue PageScroll2id
    wp_enqueue_script( 'jquery-malihu-PageScroll2id', get_template_directory_uri() .'/js/jquery.malihu.PageScroll2id.js', array( 'jquery' ), '1.5.5', true );

    // Enqueue Counterup
    wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() .'/js/jquery.counterup.js', array( 'jquery' ), '1.0', true );

    // Enqueue Waypoints
    wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() .'/js/jquery.waypoints.js', array( 'jquery' ), '4.0.1', true );

    // Enqueue custom
    wp_enqueue_script( 'awesome-one-page-custom-scripts', get_template_directory_uri() .'/js/custom.js', array( 'jquery' ), '', true );

    // Enqueue navigation
    wp_enqueue_script( 'awesome-one-page-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

    // Enqueue link foucus fix
    wp_enqueue_script( 'awesome-one-page-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'awesome_one_page_scripts' );

/*--------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'awesome_one_page_fonts_url' ) ) :
/**
 * Register Google fonts for Flash.
 *
 * Create your own awesome_one_page_fonts_url() function to override in a child theme.
 *
 * @return string Google fonts URL for the theme.
 */
function awesome_one_page_fonts_url() {
    $fonts_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';

    /* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
    if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'awesome-one-page' ) ) {
        $fonts[] = 'Montserrat:400,700';
    }

    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $fonts ) ),
            'subset' => urlencode( $subsets ),
        ), 'https://fonts.googleapis.com/css' );
    }

    return $fonts_url;
}
endif;

/*--------------------------------------------------------------------------------------------------*/

function aop_admin_scripts() {
    global $aop_version;

    // Enqueue Custom Admin Style
    wp_enqueue_style( 'awesome-one-page-admin-style', get_template_directory_uri() . '/inc/assets/css/admin-style.css', $aop_version );

    // Enqueue Custom Admin Script
    wp_enqueue_script( 'awesome-one-page-admin-script', get_template_directory_uri() .'/inc/assets/js/admin-scripts.js', array( 'jquery' ), $aop_version, true );

}
add_action( 'admin_enqueue_scripts', 'aop_admin_scripts' );

/*--------------------------------------------------------------------------------------------------*/
/**
 * Added customizer scripts
 */
function awesome_one_page_customizer_script( $hook ) {
    global $aop_version;
    if ( ( 'customize.php' != $hook ) && ( 'widgets.php' != $hook ) ) {
        return;
    }

    // Enqueue customizer style
    wp_enqueue_style( 'awesome-one-page-customizer-style', get_template_directory_uri() .'/inc/assets/css/customizer-style.css', $aop_version );

    // Enqueue custom media-uploader
    wp_enqueue_media();
    wp_enqueue_script( 'awesome-one-page-media-uploader', get_template_directory_uri() . '/inc/assets/js/media-uploader.js', array( 'jquery' ), $aop_version, true );

    // Enqueue custom color-picker
    wp_enqueue_style( 'wp-color-picker' );     
    wp_enqueue_script( 'awesome-one-page-color-picker', get_template_directory_uri() . '/inc/assets/js/color-picker.js', array( 'wp-color-picker' ), $aop_version, true ); 

    wp_enqueue_script( 'awesome-one-page-customizer-script', get_template_directory_uri() .'/inc/assets/js/customizer-scripts.js', array('jquery', 'backbone', 'underscore'), $aop_version, true  );   
}
add_action('admin_enqueue_scripts', 'awesome_one_page_customizer_script');


/*--------------------------------------------------------------------------------------------------*/

/**
* Footer credits
*/
function awesome_one_page_footer_credits() {
    echo '<a href="' . esc_url( __( 'https://wordpress.org/', 'awesome-one-page' ) ) . '">';
        printf( __( 'Powered by %s', 'awesome-one-page' ), 'WordPress' );
    echo '</a>';
    echo '<span class="sep"> | </span>';
    printf( __( 'Theme: %2$s by %1$s.', 'awesome-one-page' ), esc_html__('Awesome One Page','awesome-one-page'), '<a href="'.esc_url( __('http://precisethemes.com/','awesome-one-page' ) ) .'" rel="designer">Precise Themes</a>' );
}
add_action( 'awesome_one_page_footer', 'awesome_one_page_footer_credits' );

/*--------------------------------------------------------------------------------------------------*/

/**
 * Excerpt length
 */
function awesome_one_page_excerpt_length( $length ) {
  $excerpt = get_theme_mod('awesome_one_page_blog_post_excerpt_length', '40');
  return absint($excerpt);
}
add_filter( 'excerpt_length', 'awesome_one_page_excerpt_length', 99 );

/*--------------------------------------------------------------------------------------------------*/
/**
 * Excerpt String .
 */
function awesome_one_page_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'awesome_one_page_excerpt_more' );

/*--------------------------------------------------------------------------------------------------*/


