<?php
/**
 * Template Name: Awesome One Page
 *
 * @package Awesome_One_Page
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php global $post; ?>
			<?php $slug = $post->post_name; ?>
			<?php if ( is_active_sidebar( 'aop_widget_area_' . $slug ) ) : ?>
		 		<?php dynamic_sidebar( 'aop_widget_area_' . $slug ); ?>
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
