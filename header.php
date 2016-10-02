<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Awesome_One_Page
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'aop_before' ); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'awesome-one-page' ); ?></a>

	<?php do_action( 'aop_before_header' ); ?>
	
	<header id="masthead" class="site-header" role="banner">
		<div class="header-logo">
			<?php aop_the_custom_logo(); ?>
		</div><!-- .header-logo -->
			
		<div class="site-branding">
			<?php
			
			$screen_reader = 'screen-reader-text';
			if ( get_theme_mod( 'awesome_one_page_site_title_activate', '1' ) == 1 ) {
				$screen_reader = '';
			}
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title <?php echo esc_attr( $screen_reader ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title <?php echo esc_attr( $screen_reader ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			if ( get_theme_mod( 'awesome_one_page_site_tagline_activate', '1' ) == 1 ) :
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif;
			endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'awesome-one-page' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	
	<?php if ( get_header_image() ) : ?>
		<div class="header-image-wrap">
			<?php if ( get_theme_mod( 'awesome_one_page_header_image_link_activate', '' ) == 1 ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
				</a>
			<?php else : ?>
				<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
			<?php endif; ?>
		</div><!-- .header-image-wrap -->
	<?php endif; // End header image check. ?>

	<?php do_action( 'aop_after_header' ); ?>

	<?php do_action( 'aop_before_main' ); ?>

	<div id="content" class="site-content">
