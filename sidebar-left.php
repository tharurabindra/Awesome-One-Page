<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Awesome_One_Page
 */
if ( ! is_active_sidebar( 'awesome_one_page_left_sidebar' ) ) {
   return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
   <?php dynamic_sidebar( 'awesome_one_page_left_sidebar' ); ?>
</aside><!-- #secondary -->
