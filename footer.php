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
	
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'awesome-one-page' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'awesome-one-page' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'awesome-one-page' ), 'awesome-one-page', '<a href="http://precisethemes.com" rel="designer">Precise Themes</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
