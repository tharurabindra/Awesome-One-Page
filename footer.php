<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Awesome_One_Page
 */

?>

	</div><!-- #content -->
	
	<?php do_action( 'aop_before_footer' ); ?>

	<div class="footer-wrapper">
		<?php if ( is_active_sidebar( 'awesome_one_page_footer_sidebar_1' ) || is_active_sidebar( 'awesome_one_page_footer_sidebar_2' ) || is_active_sidebar( 'awesome_one_page_footer_sidebar_3' ) || is_active_sidebar( 'awesome_one_page_footer_sidebar_4' ) ) : ?>
			<?php get_sidebar('footer'); ?>
		<?php endif; ?>

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info">
				<?php do_action( 'awesome_one_page_footer' );?>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
		
	</div>
	
</div><!-- #page -->

<?php wp_footer(); ?>

<?php if ( get_theme_mod( 'awesome_one_page_footer_go_to_top', '1') == 1 ) : ?>
	<a id="scroll-up" href="#masthead" style="display: inline;">
		<i class="fa fa-long-arrow-up"></i>
	</a>
<?php endif; ?>

</body>
</html>
