<?php
/**
 * Template Name: Single Service
 *
 * Displays the Service Template of the theme.
 *
 * @package Awesome_One_Page
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php awesome_one_page_display_breadcrumbs(); //breadcrumbs ?>

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php awesome_one_page_sidebar_select(); ?>

<?php get_footer();
