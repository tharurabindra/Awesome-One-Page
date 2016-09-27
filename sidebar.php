<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Awesome_One_Page
 */
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php do_action( 'aop_before_sidebar' ); ?>
      <?php if ( ! dynamic_sidebar( 'awesome_one_page_right_sidebar' ) ) :
         the_widget( 'WP_Widget_Text',
            array(
               'title'  => esc_html__( 'Example Widget', 'awesome-one-page' ),
               'text'   => sprintf( __( 'This is an example widget to show how the Right Sidebar looks by default. You can add custom widgets from the %swidgets screen%s in the admin. If custom widgets is added than this will be replaced by those widgets.', 'awesome-one-page' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ),
               'filter' => true,
            ),
            array(
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>'
            )
         );
      endif; ?>
   	<?php do_action( 'aop_after_sidebar' ); ?>
</aside><!-- #secondary -->
