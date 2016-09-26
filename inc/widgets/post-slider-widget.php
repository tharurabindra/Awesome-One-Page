<?php

/**
 * Post Slider Widget section.
 */
class aop_post_slider_widget extends WP_Widget {
  function __construct() {
      $widget_ops = array( 'classname' => 'widget_post_slider_block', 'description' => esc_html__( 'Display latest posts thumbnail or posts of specific category thumbnail in slide.', 'awesome-one-page' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
        parent::__construct( false, $name = esc_html__( 'AOP: Post Slider', 'awesome-one-page' ), $widget_ops, $control_ops);
    }

    function form( $instance ) {
      $instance = wp_parse_args(
        (array) $instance, array(
          'no_of_posts'       => '4',
          'type'              => 'latest',
          'category'          => '',
          'exclude_posts_ids' => '',
          'random_posts'      => '0',
          'text_color'        => '',
          'widget_title_color'=> ''
        )
      );
      $type         = $instance['type'];
      $category     = $instance['category'];
      $random_posts = $instance[ 'random_posts' ] ? 'checked="checked"' : ''; ?>

      <div class="aop-post-slider">

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
          <input type="text" id="<?php echo $this->get_field_id( 'exclude_posts_ids' ); ?>" name="<?php echo $this->get_field_name( 'exclude_posts_ids' ); ?>" value="<?php echo esc_attr( $instance[ 'exclude_posts_ids'] ); ?>" placeholder="<?php esc_html_e( '11,43,50', 'awesome-one-page' ); ?>">
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
                  <label for="<?php echo $this->get_field_id( 'widget_title_color' ); ?>"><?php esc_html_e( 'Widget Title Color', 'awesome-one-page' ); ?></label>
                  <input type="text" id="<?php echo $this->get_field_id( 'widget_title_color' ); ?>" class="aop-color-picker" name="<?php echo $this->get_field_name( 'widget_title_color' ); ?>" value="<?php echo esc_attr( $instance[ 'widget_title_color' ] ); ?>" >
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'text_color' ); ?>"><?php esc_html_e( 'Text Color', 'awesome-one-page' ); ?></label>
                  <input type="text" id="<?php echo $this->get_field_id( 'text_color' ); ?>" class="aop-color-picker" name="<?php echo $this->get_field_name( 'text_color' ); ?>" value="<?php echo esc_attr( $instance[ 'text_color' ] ); ?>" >
                </div><!-- .aop-admin-input-wrap -->
                
              </div><!-- .accordion-content -->
            </li><!-- .aop-widget-accordion-item -->
          </ul><!-- .aop-widget-repetable-field-items -->
        </div><!-- .accordion-sortables -->     

      </div><!-- .aop-post-slider -->
    <?php }

    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      
      $instance[ 'no_of_posts' ]        = absint( $new_instance[ 'no_of_posts' ] );
      $instance[ 'exclude_posts_ids' ]  = sanitize_text_field( $new_instance[ 'exclude_posts_ids' ] );
      $instance[ 'type' ]               = $new_instance[ 'type' ];
      $instance[ 'category' ]           = $new_instance[ 'category' ];
      $instance[ 'random_posts' ]       = isset( $new_instance[ 'random_posts' ] ) ? 1 : 0;
      $instance[ 'text_color' ]         = sanitize_text_field( $new_instance[ 'text_color' ] );
      $instance[ 'widget_title_color' ] = sanitize_text_field( $new_instance[ 'widget_title_color' ] );
      return $instance;
    }

    function widget( $args, $instance ) {
      ob_start();
      extract( $args );

      $no_of_posts        = empty( $instance[ 'no_of_posts' ] ) ? 4 : intval( $instance[ 'no_of_posts' ] );
      $exclude_posts_ids  = isset( $instance[ 'exclude_posts_ids' ] ) ? $instance[ 'exclude_posts_ids' ] : '' ;
      $type               = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category           = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
      $random_posts       = !empty( $instance[ 'random_posts' ] ) ? 'true' : 'false';
      $text_color         = isset( $instance[ 'text_color' ] ) ? $instance[ 'text_color' ] : null;
      $widget_title_color = isset( $instance[ 'widget_title_color' ] ) ? $instance[ 'widget_title_color' ] : null;

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
      } else {
        $get_featured_posts = new WP_Query( array(
          'posts_per_page'        => $no_of_posts,
          'post_type'             => 'post',
          'category__in'          => $category,
          'no_found_rows'         => true,
          'orderby'               => 'rand',
          'post__not_in'          => $ids
        ) );
      }

      echo $args['before_widget']; ?>
      <!-- Demo styles -->
    <style>
      html, body {
          position: relative;
          height: 100%;
      }
      body {
          background: #eee;
          font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
          font-size: 14px;
          color:#000;
          margin: 0;
          padding: 0;
      }
      .aop-posts-swiper-container {
          width: 100%;
          height: 100%;
          
      }
      .swiper-slide {
          text-align: center;
          font-size: 18px;
          background: #fff;
          
          /* Center slide text vertically */
          display: -webkit-box;
          display: -ms-flexbox;
          display: -webkit-flex;
          display: flex;
          -webkit-box-pack: center;
          -ms-flex-pack: center;
          -webkit-justify-content: center;
          justify-content: center;
          -webkit-box-align: center;
          -ms-flex-align: center;
          -webkit-align-items: center;
          align-items: center;
      }
    </style>

      <div class="widget aop-posts-slider">

      <?php if ( $get_featured_posts->have_posts() ) : ?>
        <!-- Swiper -->
        <div class="aop-posts-swiper-container">
            <div class="swiper-wrapper">
            <?php while( $get_featured_posts->have_posts() ) : $get_featured_posts->the_post(); 
            $title_attribute  = the_title_attribute( 'echo=0' );
            $image_id         = get_post_thumbnail_id();
            $image_path       = wp_get_attachment_image_src( $image_id, 'full', true );
            $image_alt        = get_post_meta( $image_id, '_wp_attachment_image_alt', true );?>
            <?php if( has_post_thumbnail() ) : ?>
              <div class="swiper-slide">
                <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php echo esc_attr( $title_attribute ); ?>" >

                <h2 class="slider-title">
                  <a title="<?php esc_attr( $title_attribute ); ?>" href="<?php the_permalink(); ?>" alt="<?php esc_attr( $title_attribute ); ?>" style="color: <?php echo esc_attr( $inherit );?>"> <?php the_title(); ?></a>                    
                </h2><!-- .slider-title -->

                <div class="slider-content">
                  <?php the_excerpt(); ?>
                </div><!-- .slider-content -->

                <a class="slider-read-more" title="<?php echo esc_attr( $title_attribute ); ?>" href="<?php the_permalink(); ?>" alt="<?php echo esc_attr( $title_attribute ); ?>" style="color: <?php echo esc_attr( $inherit );?>"><?php esc_html_e( 'Read More', 'awesome-one-page' ); ?></a>

              </div>
            <?php endif; ?>

            <?php endwhile; 
            // Reset Post Data
            wp_reset_postdata();?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div><!-- .aop-posts-swiper-container -->
      <?php endif; ?>

      </div><!-- .aop-posts-slider -->


      <?php echo $args['after_widget'];
      ob_end_flush();
    }
}