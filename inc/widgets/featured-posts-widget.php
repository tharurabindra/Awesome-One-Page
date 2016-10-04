<?php

/**
 * Featured Posts Widget section.
 */
class aop_featured_posts_widget extends WP_Widget {
  function __construct() {
      $widget_ops = array( 'classname' => 'widget_featured_posts_block', 'description' => esc_html__( 'Display latest posts or posts of specific category.', 'awesome-one-page' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
        parent::__construct( false, $name = esc_html__( 'AOP: Featured Posts', 'awesome-one-page' ), $widget_ops, $control_ops);
    }

    function form( $instance ) {
      $instance = wp_parse_args(
        (array) $instance, array(
          'title'             => '',
          'no_of_posts'       => '4',
          'type'              => 'latest',
          'category'          => '',
          'exclude_posts_ids' => '',
          'random_posts'      => '0',
          'section_id'        => '',
          'background_color'  => '',
          'text_color'        => '',
          'title_color'       => '',
          'background_image'  => ''  
        )
      );
      $type         = $instance['type'];
      $category     = $instance['category'];
      $random_posts = $instance[ 'random_posts' ] ? 'checked="checked"' : ''; ?>

      <div class="aop-portfolio">
        
        <div class="aop-admin-input-wrap">
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'awesome-one-page' ); ?></label>
          <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance[ 'title'] ); ?>" placeholder="<?php esc_attr_e( 'Title', 'awesome-one-page' ); ?>">
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php esc_html_e( 'Show latest Posts', 'awesome-one-page' ); ?><br />
          <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php esc_html_e( 'Show posts from a category', 'awesome-one-page' ); ?><br />
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Select category', 'awesome-one-page' ); ?></label>
          <?php wp_dropdown_categories( array( 'show_option_none' =>'','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php esc_html_e( 'Number of pages to display', 'awesome-one-page' ); ?></label>
          <input type="number" id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo esc_attr( $instance[ 'no_of_posts' ] ); ?>">
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <label for="<?php echo $this->get_field_id( 'exclude_posts_ids' ); ?>"><?php esc_html_e( 'Exclude Posts IDs', 'awesome-one-page' ); ?></label>
          <input type="text" id="<?php echo $this->get_field_id( 'exclude_posts_ids' ); ?>" name="<?php echo $this->get_field_name( 'exclude_posts_ids' ); ?>" value="<?php echo esc_attr( $instance[ 'exclude_posts_ids'] ); ?>" placeholder="<?php esc_attr_e( '11,43,50', 'awesome-one-page' ); ?>">
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <input type="checkbox" <?php echo $random_posts; ?> id="<?php echo $this->get_field_id( 'random_posts' ); ?>" name="<?php echo $this->get_field_name( 'random_posts' ); ?>" value="<?php echo esc_attr( $instance[ 'random_posts'] ); ?>">
          <label for="<?php echo $this->get_field_id( 'random_posts' ); ?>"><?php esc_html_e( 'Check to display the random post from either the chosen category or from latest post.', 'awesome-one-page' ); ?></label>
        </div><!-- .aop-admin-input-wrap -->

        <div class="accordion-sortables ui-droppable ui-sortable">
          <ul class="aop-widget-repetable-field-items">
            <li class="aop-widget-accordion-item">
              <div class="aop-design-options-title accordion-title ui-sortable-handle">
                <?php esc_html_e( 'Design Options', 'awesome-one-page' ); ?>
                <span class="dashicons dashicons-arrow-up"></span>
              </div><!-- .aop-design-options-title -->
              <div class="accordion-content">

                <div class="aop-admin-input-wrap">
                  <p><em><?php esc_html_e('Tip: Enter the Featured Posts Section ID and use same for Menu item. Only used for One Page Menu.', 'awesome-one-page'); ?></em></p>
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'section_id' ); ?>"><?php esc_html_e( 'Section ID', 'awesome-one-page' ); ?></label>
                  <input type="text" id="<?php echo $this->get_field_id( 'section_id' ); ?>" name="<?php echo $this->get_field_name( 'section_id' ); ?>" value="<?php echo esc_attr( $instance[ 'section_id'] ); ?>" placeholder="<?php esc_attr_e( 'Blog', 'awesome-one-page' ); ?>">
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'title_color' ); ?>"><?php esc_html_e( 'Widget Title Color', 'awesome-one-page' ); ?></label>
                  <input type="text" id="<?php echo $this->get_field_id( 'title_color' ); ?>" class="aop-color-picker" name="<?php echo $this->get_field_name( 'title_color' ); ?>" value="<?php echo esc_attr( $instance[ 'title_color' ] ); ?>" >
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'text_color' ); ?>"><?php esc_html_e( 'Text Color', 'awesome-one-page' ); ?></label>
                  <input type="text" id="<?php echo $this->get_field_id( 'text_color' ); ?>" class="aop-color-picker" name="<?php echo $this->get_field_name( 'text_color' ); ?>" value="<?php echo esc_attr( $instance[ 'text_color' ] ); ?>" >
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php esc_html_e( 'Background Color', 'awesome-one-page' ); ?></label>
                  <input type="text" id="<?php echo $this->get_field_id( 'background_color' ); ?>" class="aop-color-picker" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo esc_attr( $instance[ 'background_color' ] ); ?>" >
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'background_image' ); ?>"><?php esc_html_e( 'Background Image', 'awesome-one-page' ); ?></label> <br/>
                  <div class="media-uploader" id="<?php echo $this->get_field_id( 'background_image' ); ?>">
                    <div class="custom_media_preview">
                       <?php if ( $instance['background_image'] != '' ) : ?>
                          <img class="custom_media_preview_default" src="<?php echo esc_url( $instance['background_image'] ); ?>" style="max-width:100%;" />
                       <?php endif; ?>
                    </div><!-- .custom_media_preview -->
                    <input type="text" class="custom_media_input" id="<?php echo $this->get_field_id( 'background_image' ); ?>" name="<?php echo $this->get_field_name( 'background_image' ); ?>" value="<?php echo esc_url( $instance[ 'background_image' ] ); ?>" style="margin-top:5px;" />
                    <button class="custom_media_upload button button-secondary button-large" id="<?php echo $this->get_field_id( 'background_image' ); ?>" data-choose="<?php esc_attr_e( 'Choose an image', 'awesome-one-page' ); ?>" data-update="<?php esc_attr_e( 'Use image', 'awesome-one-page' ); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select an Image', 'awesome-one-page' ); ?></button>
                  </div><!-- .media-uploader -->
                </div><!-- .aop-admin-input-wrap -->
                
              </div><!-- .accordion-content -->
            </li><!-- .aop-widget-accordion-item -->
          </ul><!-- .aop-widget-repetable-field-items -->
        </div><!-- .accordion-sortables -->     

      </div><!-- .aop-portfolio -->
    <?php }

    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      
      $instance[ 'title' ]              = sanitize_text_field( $new_instance[ 'title' ] );
      $instance[ 'no_of_posts' ]        = absint( $new_instance[ 'no_of_posts' ] );
      $instance[ 'exclude_posts_ids' ]  = sanitize_text_field( $new_instance[ 'exclude_posts_ids' ] );
      $instance[ 'type' ]               = $new_instance[ 'type' ];
      $instance[ 'category' ]           = $new_instance[ 'category' ];
      $instance[ 'random_posts' ]       = isset( $new_instance[ 'random_posts' ] ) ? 1 : 0;
      $instance[ 'section_id' ]         = sanitize_text_field( $new_instance[ 'section_id' ] );
      $instance[ 'background_color' ]   = sanitize_text_field( $new_instance[ 'background_color' ] );
      $instance[ 'text_color' ]         = sanitize_text_field( $new_instance[ 'text_color' ] );
      $instance[ 'title_color' ]        = sanitize_text_field( $new_instance[ 'title_color' ] );
      $instance[ 'background_image' ]   = esc_url_raw( $new_instance[ 'background_image' ] );
      return $instance;
    }

    function widget( $args, $instance ) {
      ob_start();
      extract( $args );

      $title              = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $no_of_posts        = empty( $instance[ 'no_of_posts' ] ) ? 4 : intval( $instance[ 'no_of_posts' ] );
      $exclude_posts_ids  = isset( $instance[ 'exclude_posts_ids' ] ) ? $instance[ 'exclude_posts_ids' ] : '' ;
      $type               = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category           = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
      $random_posts       = !empty( $instance[ 'random_posts' ] ) ? 'true' : 'false';
      $section_id         = isset( $instance[ 'section_id' ] ) ? esc_attr( $instance[ 'section_id' ] ) : '';
      $background_color   = isset( $instance[ 'background_color' ] ) ? $instance[ 'background_color' ] : null;
      $text_color         = isset( $instance[ 'text_color' ] ) ? esc_attr( $instance[ 'text_color' ] ) : null;
      $title_color = isset( $instance[ 'title_color' ] ) ? $instance[ 'title_color' ] : null;
      $background_image   = isset( $instance[ 'background_image' ] ) ? esc_url( $instance[ 'background_image' ] ) : '';

      if ( $text_color ) {
        $inherit = 'inherit';
      } else {
        $inherit = 'noinherit';
      }

      if ($section_id) {
        $id =  ' id="' . $section_id . '"';
      } else {
        $id = '';
      }

      if ( $exclude_posts_ids ) {
        $ids = explode(',', $exclude_posts_ids);
      } else {
        $ids = '';
      }
      if( $type == 'latest' && $random_posts == 'false' ) {
        $get_featured_posts = new WP_Query( array(
          'posts_per_page'        => $no_of_posts,
          'post_type'             => 'post',
          'ignore_sticky_posts'   => true,
          'no_found_rows'         => true,
          'post__not_in'          => $ids
        ) );
      } elseif ( $type == 'latest' && $random_posts == 'true' ) {
        $get_featured_posts = new WP_Query( array(
          'posts_per_page'        => $no_of_posts,
          'post_type'             => 'post',
          'ignore_sticky_posts'   => true,
          'no_found_rows'         => true,
          'orderby'               => 'rand',
          'post__not_in'          => $ids
        ) );
      } elseif ( $type == 'category' && $random_posts == 'false' ) {
        $get_featured_posts = new WP_Query( array(
          'posts_per_page'        => $no_of_posts,
          'post_type'             => 'post',
          'category__in'          => $category,
          'no_found_rows'         => true,
          'post__not_in'          => $ids
        ) );
      } elseif ( $type == 'category' && $random_posts == 'true' ) {
        $get_featured_posts = new WP_Query( array(
          'posts_per_page'        => $no_of_posts,
          'post_type'             => 'post',
          'category__in'          => $category,
          'no_found_rows'         => true,
          'orderby'               => 'rand',
          'post__not_in'          => $ids
        ) );
      }

      echo $args['before_widget'] = str_replace('<section', '<section' . $id . ' data-color="' . $inherit . '" style="color:' . $text_color . ';background-color:' . $background_color . ';background-image:url(' . $background_image . ');"', $args['before_widget']); ?>

        <div class="widget aop-portfolio-pages">
          <div class="aop-section-title-wrapper">
            <?php if ( !empty( $title ) ) : ?> 
              <h2 class="widget-title" style="color: <?php echo esc_attr( $title_color );?>"><?php echo esc_attr( $title ); ?></h2> 
            <?php endif; ?>
          </div><!-- .aop-section-title-wrapper -->

          <div class="aop-section-content-wrapper">
            <?php if ( $get_featured_posts->have_posts() ) : ?>
              <div class="entry-content">
                <?php while( $get_featured_posts->have_posts() ) : $get_featured_posts->the_post(); 
                  $title_attribute  = the_title_attribute( 'echo=0' );
                  $image_id         = get_post_thumbnail_id();
                  $image_path       = wp_get_attachment_image_src( $image_id, 'thumbnail', true );
                  $image_alt        = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                  if( has_post_thumbnail() ) {
                    $portfolio_image_holder = '<figure><img src="'.esc_url( $image_path[0] ).'" alt="'.esc_attr( $image_alt ).'" title="'.esc_attr( $title_attribute ).'" /></figure>';
                  } ?>
                  <div class="featured-posts-column-3">
                    <?php if( has_post_thumbnail() || !empty( $portfolio_icon ) ) : ?>
                      <div class="featured-posts-thumbnail">
                        <?php echo $portfolio_image_holder; ?>
                      </div><!-- .thumbnail -->
                    <?php endif; ?>

                    <h2 class="featured-posts-title">
                      <a title="<?php esc_attr( $title_attribute ); ?>" href="<?php the_permalink(); ?>" alt="<?php esc_attr( $title_attribute ); ?>"> <?php the_title(); ?></a>                    
                    </h2><!-- .featured-posts-title -->

                    <div class="featured-posts-content">
                       <?php the_excerpt(); ?>
                    </div><!-- .featured-posts-content -->

                      <div class="read-more clearfix">
                        <a class="button post-button" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php esc_html_e( get_theme_mod( 'awesome_one_page_blog_read_more_text', esc_html__('Read More', 'awesome-one-page') ) ); ?></a>
                      </div>
                  </div><!-- .featured-posts-column-3 -->
                <?php endwhile; 
                // Reset Post Data
                wp_reset_postdata();?>
              </div><!-- .entry-content -->
            <?php endif; ?>
          </div><!-- .aop-section-title-wrapper -->
        </div><!-- .aop-featured-posts-pages -->
      <?php echo $args['after_widget'];
      ob_end_flush();
    }
}