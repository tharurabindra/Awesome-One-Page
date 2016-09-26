<?php
/**
 * Awesome One Page Theme Widgets.
 *
 * @package Awesome_One_Page
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function awesome_one_page_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Right', 'awesome-one-page' ),
		'id'            => 'aop_sidebar_right',
		'description'   => esc_html__( 'Add widgets in your right sidebar of  theme.', 'awesome-one-page' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>'
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Left', 'awesome-one-page' ),
		'id'            => 'aop_sidebar_left',
		'description'   => esc_html__( 'Add widgets in your left sidebar of  theme.', 'awesome-one-page' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>'
	) );

  //Register widget areas for the Awesome One page template
  $pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-templates/template-awesome-one-page.php',
  ));

  foreach($pages as $page){
    register_sidebar( array(
      'name'          => esc_html__( 'Page - ', 'awesome-one-page' ) . $page->post_title,
      'id'            => 'aop_widget_area_' . strtolower($page->post_name),
      'description'   => esc_html__( 'Drag and drop our all custom widgets to build content awesome for the page: ', 'awesome-one-page' ) . $page->post_title,
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>'
    ) );
  }

	register_widget( "aop_service_widget" );
  register_widget( "aop_team_widget" );
  register_widget( "aop_testimonial_widget" );
  register_widget( "aop_portfolio_widget" );
  register_widget( "aop_featured_posts_widget" );
  register_widget( "aop_video_widget" );
  register_widget( "aop_fun_facts_widget" );
  register_widget( "aop_social_icons_widget" );
  register_widget( "aop_post_slider_widget" );
  register_widget( "aop_page_slider_widget" );
}
add_action( 'widgets_init', 'awesome_one_page_widgets_init' );

/**************************************************************************************/
require get_template_directory() . '/inc/widgets/services-widget.php';
require get_template_directory() . '/inc/widgets/teams-widget.php';
require get_template_directory() . '/inc/widgets/testimonials-widget.php';
require get_template_directory() . '/inc/widgets/portfolio-widget.php';
require get_template_directory() . '/inc/widgets/featured-posts-widget.php';
require get_template_directory() . '/inc/widgets/video-widget.php';
require get_template_directory() . '/inc/widgets/fun-facts-widget.php';
require get_template_directory() . '/inc/widgets/social-icons-widget.php';
require get_template_directory() . '/inc/widgets/post-slider-widget.php';
require get_template_directory() . '/inc/widgets/page-slider-widget.php';
