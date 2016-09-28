<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Awesome_One_Page
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php awesome_one_page_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<?php awesome_one_page_post_thumbnail(); ?>

	<?php if ( is_singular() ) : ?>

		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->

	<?php else: ?>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<?php if ( get_theme_mod( 'awesome_one_page_blog_show_read_more', '1' ) == 1 ) : ?>
			<div class="read-more clearfix">
				<a class="button post-button" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php esc_html_e( get_theme_mod( 'awesome_one_page_blog_read_more_text', esc_html__('Read More', 'awesome-one-page') ) ); ?></a>
			</div>
		<?php endif; ?>

	<?php endif; ?>

	<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'awesome-one-page' ),
			'after'  => '</div>',
		) );
	?>

	<footer class="entry-footer">
		<?php awesome_one_page_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
