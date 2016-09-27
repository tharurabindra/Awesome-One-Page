<?php
/**
 * The sidebar containing the main footer widgets area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Awesome_One_Page
 */
?>

<?php 
//Set widget areas classes based on user choice
   $widget_areas = get_theme_mod('awesome_one_page_footer_widgets_area', '3');
   if ($widget_areas == '4') {
      $cols = 'col-md-3';
   } elseif ($widget_areas == '3') {
      $cols = 'col-md-4';
   } elseif ($widget_areas == '2') {
      $cols = 'col-md-6';
   } else {
      $cols = 'col-md-12';
   }
?>

<aside id="footer-widgets" class="footer-widgets" role="complementary">
	<?php do_action( 'aop_before_footer_sidebar' ); ?>
      <div class="container">
         <?php if ( is_active_sidebar( 'awesome_one_page_footer_sidebar_1' ) ) : ?>
            <div class="sidebar-column <?php echo esc_attr( $cols ); ?>">
               <?php dynamic_sidebar( 'awesome_one_page_footer_sidebar_1'); ?>
            </div>
         <?php endif; ?>   
         <?php if ( is_active_sidebar( 'awesome_one_page_footer_sidebar_2' ) ) : ?>
            <div class="sidebar-column <?php echo esc_attr( $cols ); ?>">
               <?php dynamic_sidebar( 'awesome_one_page_footer_sidebar_2'); ?>
            </div>
         <?php endif; ?>   
         <?php if ( is_active_sidebar( 'awesome_one_page_footer_sidebar_3' ) ) : ?>
            <div class="sidebar-column <?php echo esc_attr( $cols ); ?>">
               <?php dynamic_sidebar( 'awesome_one_page_footer_sidebar_3'); ?>
            </div>
         <?php endif; ?>
         <?php if ( is_active_sidebar( 'awesome_one_page_footer_sidebar_4' ) ) : ?>
            <div class="sidebar-column <?php echo esc_attr( $cols ); ?>">
               <?php dynamic_sidebar( 'awesome_one_page_footer_sidebar_4'); ?>
            </div>
         <?php endif; ?>
      </div>      
   <?php do_action( 'aop_after_footer_sidebar' ); ?>
</aside><!-- #secondary -->
