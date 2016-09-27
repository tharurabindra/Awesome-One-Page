<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Awesome_One_Page
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function awesome_one_page_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class site layout style.
	if ( get_theme_mod ( 'awesome_one_page_website_layout', 'wide' ) == 'wide' ) {
		$classes[] = 'wide';
	} else {
		$classes[] = 'box';
	}

    // Menu style.
    if ( get_theme_mod ( 'awesome_one_page_menu_display_style', 'inline' ) == 'inline' ) {
        $classes[] = 'inline';
    } else {
        $classes[] = 'centered';
    }

    // Activate sticky menu
    if ( get_theme_mod( 'awesome_one_page_sticky_menu_activate', '' ) == 1 ) {
        $classes[] = 'stick';
    }
	$classes[] = awesome_one_page_sidebar_layout_class();

	return $classes;
}
add_filter( 'body_class', 'awesome_one_page_body_classes' );

/*--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'awesome_one_page_sidebar_layout_class' ) ) :
/**
 * Generate layout class for sidebar based on customizer and post meta settings.
 */
function awesome_one_page_sidebar_layout_class() {
    global $post;
    $layout = get_theme_mod( 'aop_archive_sidebar', 'right_sidebar' );
    // Front page displays in Reading Settings
    $page_for_posts = get_option('page_for_posts');
    // Get Layout meta
    if($post) {
        $layout_meta = get_post_meta( $post->ID, 'aop_page_specific_layout', true );
    }
    // Home page if Posts page is assigned
    if( is_home() && !( is_front_page() ) ) {
        $queried_id = get_option( 'page_for_posts' );
        $layout_meta = get_post_meta( $queried_id, 'aop_page_specific_layout', true );

        if( $layout_meta != 'default_layout' && $layout_meta != '' ) {
            $layout = get_post_meta( $queried_id, 'aop_page_specific_layout', true );
        }
    }
    elseif( is_page() ) {
        if( $layout_meta != 'default_layout' && $layout_meta != '' ) {
            $layout = get_post_meta( $post->ID, 'aop_page_specific_layout', true );
        }
    }
    elseif( is_single() ) {
        $layout = get_theme_mod( 'awesome_one_page_post_global_sidebar', 'right_sidebar' );
        if( $layout_meta != 'default_layout' && $layout_meta != '' ) {
            $layout = get_post_meta( $post->ID, 'aop_page_specific_layout', true );
        }
    }
    return $layout;
}
endif;

/*--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'awesome_one_page_sidebar_select' ) ) :
/**
 * Select and show sidebar based on post meta and customizer default settings
 */
function awesome_one_page_sidebar_select() {
    $layout = awesome_one_page_sidebar_layout_class();
    if( $layout != "no_sidebar_full_width" &&  $layout != "no_sidebar_content_centered" ) {
        if ( $layout == "right_sidebar" ) {
            get_sidebar();
        } else {
            get_sidebar('left');
        }
    }
}
endif;

/*--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'awesome_one_page_navigation' ) ) :
/**
 * Return the navigations.
 */
function awesome_one_page_navigation() {
    if( is_archive() || is_home() || is_search() ) {
    /**
     * Checking WP-PageNaviplugin exist
     */
    if ( function_exists('wp_pagenavi' ) ) :
        wp_pagenavi();
    else:
      global $wp_query;
      if ( $wp_query->max_num_pages > 1 ) :
      ?>
        <nav class="navigation post-navigation" role="navigation">
            <div class="nav-links">
                <?php if ( get_adjacent_post( false, '', true ) ): // if there are older posts ?>
                    <div class="nav-previous">
                        <?php next_posts_link( esc_html__( '&larr; Previous', 'awesome-one-page' ) ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( get_adjacent_post( false, '', false ) ): // if there are newer posts ?>
                    <div class="nav-next">
                        <?php previous_posts_link( esc_html__( 'Next &rarr;', 'awesome-one-page' ) ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
      <?php
      endif;
    endif;
  }

  if ( is_single() ) {
    if( is_attachment() ) {
    ?>
    <nav class="navigation post-navigation" role="navigation">
        <div class="nav-links">
            <?php if ( get_adjacent_post( false, '', true ) ): // if there are older posts ?>
                <div class="nav-previous">
                    <?php previous_image_link( false, esc_html__( '&larr; Previous', 'awesome-one-page' ) ); ?>
                </div>
            <?php endif; ?>

            <?php if ( get_adjacent_post( false, '', false ) ): // if there are newer posts ?>
                <div class="nav-next">
                    <?php next_image_link( false, esc_html__( 'Next &rarr;', 'awesome-one-page' ) ); ?>
                </div>
            <?php endif; ?>
        </div>
    </nav>
    <?php
    }
    else {
    ?>
    <nav class="navigation post-navigation" role="navigation">
        <div class="nav-links">
            <?php if ( get_adjacent_post( false, '', true ) ): // if there are older posts ?>
                <div class="nav-previous">
                    <?php previous_post_link( '%link', '<span class="meta-nav">' . esc_html_x( '&larr; Previous Post', 'Previous post link', 'awesome-one-page' ) . '</span>' ); ?>
                </div>
            <?php endif; ?>

            <?php if ( get_adjacent_post( false, '', false ) ): // if there are newer posts ?>
                <div class="nav-next">
                    <?php next_post_link( '%link', '<span class="meta-nav">' . esc_html_x( 'Next Post &rarr;', 'Next post link', 'awesome-one-page' ) . '</span>' ); ?>
                </div>
            <?php endif; ?>                
        </div>
    </nav>
    <?php
    }
  } 
}
endif;
