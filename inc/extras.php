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
    $layout = get_theme_mod( 'awesome_one_page_blog_global_sidebar', 'right_sidebar' );
    // Front page displays in Reading Settings
    $page_for_posts = get_option('page_for_posts');
    // Get Layout meta
    if($post) {
        $layout_meta = get_post_meta( $post->ID, 'awesome_one_page_spacific_layout', true );
    }
    // Home page if Posts page is assigned
    if( is_home() && !( is_front_page() ) ) {
        $queried_id = get_option( 'page_for_posts' );
        $layout_meta = get_post_meta( $queried_id, 'awesome_one_page_spacific_layout', true );

        if( $layout_meta != 'default_layout' && $layout_meta != '' ) {
            $layout = get_post_meta( $queried_id, 'awesome_one_page_spacific_layout', true );
        }
    }
    elseif( is_page() ) {
        if( $layout_meta != 'default_layout' && $layout_meta != '' ) {
            $layout = get_post_meta( $post->ID, 'awesome_one_page_spacific_layout', true );
        }
    }
    elseif( is_single() ) {
        $layout = get_theme_mod( 'awesome_one_page_post_global_sidebar', 'right_sidebar' );
        if( $layout_meta != 'default_layout' && $layout_meta != '' ) {
            $layout = get_post_meta( $post->ID, 'awesome_one_page_spacific_layout', true );
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
    $show_post_nex_prev_article = get_theme_mod( 'awesome_one_page_post_nex_prev_article' , 1 ); 
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

  if ( is_single() && $show_post_nex_prev_article == 1 ) {
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

/*--------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'awesome_one_page_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 */
function awesome_one_page_post_thumbnail() {
    global $post;
    $show_post_thumbnail_image = get_theme_mod( 'awesome_one_page_post_featured_image', '1' );
    $show_blog_post_thumbnail_image = get_theme_mod( 'awesome_one_page_blog_post_thumb_image', '1' );

    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
        return;
    }

    if ( is_single() ) : ?>

        <?php if ( has_post_thumbnail () && $show_post_thumbnail_image != '' ) :
        $title_attribute  = the_title_attribute( 'echo=0' );
        $image_id         = get_post_thumbnail_id();
        $image_path       = wp_get_attachment_image_src( $image_id, 'full', true );
        $image_alt        = get_post_meta( $image_id, '_wp_attachment_image_alt', true ); ?>
        <div class="single-thumb">
            <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php echo esc_attr( $title_attribute ); ?>"/>
        </div><!-- .post-thumbnail -->

        <?php endif; ?>

    <?php else : ?>

        <?php if ( has_post_thumbnail () && $show_blog_post_thumbnail_image == 1 ) :
        $title_attribute  = the_title_attribute( 'echo=0' );
        $image_id         = get_post_thumbnail_id();
        $image_path       = wp_get_attachment_image_src( $image_id, 'medium', true );
        $image_alt        = get_post_meta( $image_id, '_wp_attachment_image_alt', true ); ?>
        <div class="entry-thumb">
            <a href="<?php the_permalink(); ?>" aria-hidden="true"><img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php echo esc_attr( $title_attribute ); ?>" /></a>
        </div><!-- .post-thumbnail -->

        <?php endif; ?>

    <?php endif; // End is_singular()
}
endif;

/*--------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'aop_the_custom_logo' ) ) :
    /**
     * Displays the optional custom logo.
     *
     * Does nothing if the custom logo is not available.
     */
    function aop_the_custom_logo() {
        if ( function_exists( 'the_custom_logo' ) ) { 
            the_custom_logo();
        }
    }
endif;

/*--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'awesome_one_page_breadcrumbs' ) ) :
/**
 * Breadcrumbs
 */
    function awesome_one_page_breadcrumbs() {

        // Get the query & post information
        global $post,$wp_query;

        $delimiter = get_theme_mod( 'awesome_one_page_breadcrumbs_sep' );
        if ( $delimiter == '' ) {
            $delimiter    = '/'; // delimiter between crumbs
        }
        $home_title         = esc_html__('Home', 'awesome-one-page');

        // Do not display on the homepage
        if ( !is_front_page() ) {

            // Build the breadcrums
            echo '<ul class="trail-items">';

            // Home page
            echo '<li class="trail-item trail-begin"><a class="trail-home" href="' . esc_html( get_home_url() ) . '" title="' . $home_title . '"><span>' . $home_title . '</span></a></li>';
            echo '<li class="delimiter">'.esc_html( $delimiter ).'</li>';

            if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

                // If post is a custom post type
                $post_type = get_post_type();

                // If it is a custom post type display name and link
                if($post_type != 'post') {

                    $post_type_object       = get_post_type_object($post_type);
                    $post_type_archive_link = get_post_type_archive_link($post_type);

                    echo '<li class="trail-item"><a class="item-taxonomy" href="' . esc_url( $post_type_archive ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '"><span>' . esc_html( $post_type_object->labels->name ) . '</span></a></li>';
                    echo '<li class="delimiter">'.esc_html( $delimiter ).'</li>';
                }

                $custom_taxonomy = get_queried_object()->name;
                echo '<li class="trail-item"><span>' . esc_html( $custom_taxonomy ) . '</span></li>';
                echo '<li class="delimiter">'.esc_html( $delimiter ).'</li>';

            } elseif ( is_single() ) {

                // If post is a custom post type
                $post_type = get_post_type();

                // If it is a custom post type display name and link
                if($post_type != 'post') {

                    $post_type_object = get_post_type_object($post_type);
                    $post_type_archive = get_post_type_archive_link($post_type);

                    echo '<li class="trail-item"><a class="item-custom-post-type" href="' . esc_url( $post_type_archive_link ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '"><span>' . esc_html( $post_type_object->labels->name ) . '</span></a></li>';
                    echo '<li class="delimiter">'.esc_html( $delimiter ).'</li>';
                }

                // Get post category info
                $category = get_the_category();

                if(!empty($category)) {

                    // Get last category post is in
                    $slice_array   = array_slice($category, -1);
                    $last_category = array_pop($slice_array);

                    // Get parent any categories and create array
                    $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                    $cat_parents     = explode(',',$get_cat_parents);

                    // Loop through parent categories and store in variable $cat_display
                    $cat_display = '';
                    foreach($cat_parents as $parents) {
                        $cat_display .= '<li class="trail-item item-category"><span>'. $parents .'</span></li>';
                        $cat_display .= '<li class="delimiter">'.esc_html( $delimiter ).'</li>';
                    }

                }

                // Check if the post is in a category
                if(!empty($last_category)) {
                    echo $cat_display;
                    echo '<li class="trail-item"><span>' . esc_html( get_the_title() ) . '</span></li>';

                } else {

                    echo '<li class="trail-item"><span>' . esc_html( get_the_title() ) . '</span></li>';

                }

            } elseif ( is_category() ) {

                // Category page
                echo '<li class="trail-item"><span>' . single_cat_title('', false) . '</span></li>';

            } elseif ( is_page() ) {

                // Standard page
                if( $post->post_parent ){

                    // If child page, get parents
                    $anc = get_post_ancestors( $post->ID );

                    // Get parents in the right order
                    $anc = array_reverse($anc);

                    // Parent page loop
                    foreach ( $anc as $ancestor ) {
                        $parents .= '<li class="trail-item"><a class="item-parent" href="' . esc_url ( get_permalink($ancestor) ) . '" title="' . esc_attr( get_the_title($ancestor) ) . '"><span>' . esc_html( get_the_title($ancestor) ) . '</span></a></li>';
                    }

                    // Display parent pages
                    echo $parents;

                    // Current page
                    echo '<li class="trail-item"><span>' . esc_html( get_the_title() ) . '</span></li>';

                } else {

                    // Just display current page if not parents
                    echo '<li class="trail-item"><span>' . esc_html( get_the_title() ) . '</span></li>';
                }

            } elseif ( is_tag() ) {

                // Get tag information
                $term_id        = get_query_var('tag_id');
                $taxonomy       = 'post_tag';
                $args           = 'include=' . $term_id;
                $terms          = get_terms( $taxonomy, $args );
                $get_term_id    = $terms[0]->term_id;
                $get_term_slug  = $terms[0]->slug;
                $get_term_name  = $terms[0]->name;

                // Display the tag name
                echo '<li class="trail-item"><span>' . esc_html( $get_term_name ) . '</span></li>';

            } elseif ( is_day() ) {

                // Year link
                echo '<li class="trail-item"><a class="item-year" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '" title="' . esc_attr( get_the_time('Y') ). '"><span>' . esc_html( get_the_time('Y') ) . '</span></a></li>';
                echo '<li class="delimiter">'.esc_html( $delimiter ).'</li>';

                // Month link
                echo '<li class="trail-item"><a class="item-month" href="' . esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ) . '" title="' . esc_attr( get_the_time('M') ) . '"><span>' . esc_html( get_the_time('M') ) . '</span></a></li>';
                echo '<li class="delimiter">'.esc_html( $delimiter ).'</li>';

                // Day display
                echo '<li class="trail-item"><span>' . esc_html( get_the_time('jS') ) .'</span></li>';

            } elseif ( is_month() ) {

                // Year link
                echo '<li class="trail-item"><a class="item-year" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '" title="' . esc_attr( get_the_time('Y') ). '"><span>' . esc_html( get_the_time('Y') ) . '</span></a></li>';
                echo '<li class="delimiter">'.esc_html( $delimiter ).'</li>';

                // Month link
                echo '<li class="trail-item"><span>' . esc_html( get_the_time('M') ) . '</span></li>';

            } elseif ( is_year() ) {

                // Display year archive
                echo '<li class="trail-item"><span>' . esc_html( get_the_time('Y') ). '</span></li>';

            } elseif ( is_author() ) {

                // Get the author information
                global $author;
                $userdata = get_userdata( $author );

                // Display author name
                echo '<li class="trail-item"><span>' . esc_html( $userdata->display_name ). '</span></li>';

            } elseif ( get_query_var('paged') ) {

                // Paginated archives
                echo '<li class="trail-item"><span>'.esc_html__( 'Page', 'awesome-one-page' ) . esc_html( get_query_var('paged') ) . '</span></li>';

            } elseif ( is_search() ) {

                // Search results page
                echo '<li class="trail-item><span>' .esc_html__( 'Search results for: ', 'awesome-one-page' ) . esc_html( get_search_query() ) . '</span></li>';

            } elseif ( is_404() ) {

                // 404 page
                echo '<li class="trail-item"><span>'.esc_html__('404 Error', 'awesome-one-page').'</span></li>';
            }

            echo '</ul>';

        }
    }
endif;

/*--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'awesome_one_page_display_breadcrumbs' ) ) :
    /**
     * Displays the optional to show the breadcrumbs in innerpages.
     */
    function awesome_one_page_display_breadcrumbs() {
        if ( get_theme_mod( 'awesome_one_page_breadcrumbs_activate', '1') !== '' ) {
            awesome_one_page_breadcrumbs(); 
        }
    }
endif;


