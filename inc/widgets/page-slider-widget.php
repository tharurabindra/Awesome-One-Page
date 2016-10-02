<?php

/**
 * Page Slider Widget section.
 */
class aop_page_slider_widget extends WP_Widget {
  function __construct() {
      $widget_ops = array( 'classname' => 'widget_page_slider_block', 'description' => esc_html__( 'Pages Slider with featured image, title, short description and custom button.', 'awesome-one-page' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
        parent::__construct( false, $name = esc_html__( 'AOP: Slider', 'awesome-one-page' ), $widget_ops, $control_ops);
    }

    function form( $instance ) {
      $defaults             = array();
      $defaults[ 'title' ]  = '';
      for ($i=0; $i<4 ; $i++) {
        $defaults[ 'page_id_'. $i ] = '';
        $defaults[ 'button_text_'. $i ]    = '';
        $defaults[ 'button_url_'. $i ]   = '';
      }
      $defaults[ 'section_id' ]         = '';
      $defaults[ 'widget_title_color' ] = '';
      $defaults[ 'text_color' ]         = '';
      $defaults[ 'image_link' ]         = '0';
      $defaults[ 'show_navigation' ]         = '1';
      $defaults[ 'navigation_type' ]         = 'arrow';
      $instance = wp_parse_args( (array) $instance, $defaults );
      $image_link = $instance[ 'image_link' ] ? 'checked="checked"' : '';
      $show_navigation = $instance[ 'show_navigation' ] ? 'checked="checked"' : ''; ?>

      <div class="aop-fun-facts">
        <div class="aop-admin-input-wrap">
          <p><em><?php esc_html_e('Only pages having thumbnail will display in Slider.', 'awesome-one-page'); ?></em></p>
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'awesome-one-page' ); ?></label>
          <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance[ 'title'] ); ?>" placeholder="<?php esc_attr_e( 'Title', 'awesome-one-page' ); ?>">
        </div><!-- .aop-admin-input-wrap -->

        <?php for ( $i=0; $i<4 ; $i++ ) : ?>

          <div class="aop-admin-input-wrap">
            <label for="<?php echo $this->get_field_id( 'page_id_'. $i ); ?>"><?php esc_html_e( 'Page', 'awesome-one-page' ); ?></label>
            <?php wp_dropdown_pages( array( 'class' => 'widefat','show_option_none' =>' ','name' => $this->get_field_name( 'page_id_'.$i ), 'selected' => $instance['page_id_'.$i] ) ); ?>
          </div><!-- .aop-admin-input-wrap -->

          <div class="aop-admin-input-wrap">
            <label for="<?php echo $this->get_field_id( 'button_text_'. $i ); ?>"><?php esc_html_e( 'Button Text ', 'awesome-one-page' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'button_text_'. $i ); ?>" name="<?php echo $this->get_field_name( 'button_text_'. $i ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'button_text_'. $i ] ); ?>" placeholder="<?php esc_attr_e( 'Get in Touch', 'awesome-one-page' ); ?>"/>
          </div><!-- .aop-admin-input-wrap -->

          <div class="aop-admin-input-wrap">
            <label for="<?php echo $this->get_field_id( 'button_url_'. $i ); ?>"><?php esc_html_e( 'Icon Class:', 'awesome-one-page' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'button_url_'. $i ); ?>" name="<?php echo $this->get_field_name( 'button_url_'. $i ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'button_url_'. $i ] ); ?>" placeholder="<?php esc_attr_e( 'http://url.com/', 'awesome-one-page' ); ?>"/>
          </div><!-- .aop-admin-input-wrap -->
          <hr/>

        <?php endfor;?>

        <div class="accordion-sortables ui-droppable ui-sortable">
          <ul class="aop-widget-repetable-field-items">
            <li class="aop-widget-accordion-item">
              <div class="aop-design-options-title accordion-title ui-sortable-handle">
                <?php esc_html_e( 'Design Options', 'awesome-one-page' ); ?>
                <span class="dashicons dashicons-arrow-up"></span>
              </div><!-- .aop-design-options-title -->
              <div class="accordion-content">

                <div class="aop-admin-input-wrap">
                  <p><em><?php esc_html_e('Tip: Enter the Slider Section ID and use same for Menu item. Only used for One Page Menu.', 'awesome-one-page'); ?></em></p>
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'section_id' ); ?>"><?php esc_html_e( 'Section ID', 'awesome-one-page' ); ?></label>
                  <input type="text" id="<?php echo $this->get_field_id( 'section_id' ); ?>" name="<?php echo $this->get_field_name( 'section_id' ); ?>" value="<?php echo esc_attr( $instance[ 'section_id'] ); ?>" placeholder="<?php esc_attr_e( 'home', 'awesome-one-page' ); ?>">
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'widget_title_color' ); ?>"><?php esc_html_e( 'Widget Title Color', 'awesome-one-page' ); ?></label>
                  <input type="text" id="<?php echo $this->get_field_id( 'widget_title_color' ); ?>" class="aop-color-picker" name="<?php echo $this->get_field_name( 'widget_title_color' ); ?>" value="<?php echo esc_attr( $instance[ 'widget_title_color' ] ); ?>" >
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'text_color' ); ?>"><?php esc_html_e( 'Text Color', 'awesome-one-page' ); ?></label>
                  <input type="text" id="<?php echo $this->get_field_id( 'text_color' ); ?>" class="aop-color-picker" name="<?php echo $this->get_field_name( 'text_color' ); ?>" value="<?php echo esc_attr( $instance[ 'text_color' ] ); ?>" >
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'image_link' ); ?>"><?php esc_html_e( 'Check to enable link in Slider Image.', 'awesome-one-page' ); ?></label>
                  <input type="checkbox" <?php echo $image_link; ?> id="<?php echo $this->get_field_id( 'image_link' ); ?>" name="<?php echo $this->get_field_name( 'image_link' ); ?>" >
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'show_navigation' ); ?>"><?php esc_html_e( 'Show Navigation', 'awesome-one-page' ); ?></label>
                  <input type="checkbox" <?php echo $show_navigation; ?> id="<?php echo $this->get_field_id( 'show_navigation' ); ?>" name="<?php echo $this->get_field_name( 'show_navigation' ); ?>" >
                </div><!-- .aop-admin-input-wrap -->

                
                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'navigation_type' ); ?>"><?php esc_html_e( 'Navigation Type', 'awesome-one-page' ); ?></label>
                  <select id="<?php echo $this->get_field_id( 'navigation_type' ); ?>" name="<?php echo $this->get_field_name( 'navigation_type' ); ?>">
                    <option value="arrow" <?php selected( $instance['navigation_type'], 'arrow' ); ?>><?php esc_html_e( 'Arrow', 'awesome-one-page' ); ?></option>
                    <option value="pagination" <?php selected( $instance['navigation_type'], 'pagination' );?>><?php esc_html_e( 'Pagination', 'awesome-one-page' ); ?></option>
                  </select>
                </div><!-- .aop-admin-input-wrap -->
                

              </div><!-- .accordion-content -->
            </li><!-- .aop-widget-accordion-item -->
          </ul><!-- .aop-widget-repetable-field-items -->
        </div><!-- .accordion-sortables -->    

      </div><!-- .aop-page-slider -->
    <?php }

    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      
      $instance[ 'title' ]              = sanitize_text_field( $new_instance[ 'title' ] );
      $instance[ 'section_id' ]         = sanitize_text_field( $new_instance[ 'section_id' ] );
      $instance[ 'widget_title_color' ] = sanitize_text_field( $new_instance[ 'widget_title_color' ] );
      $instance[ 'text_color' ]         = sanitize_text_field( $new_instance[ 'text_color' ] );
      $instance[ 'image_link' ] = isset( $new_instance[ 'image_link' ] ) ? 1 : 0;
      $instance[ 'show_navigation' ] = isset( $new_instance[ 'show_navigation' ] ) ? 1 : 0;
      $instance[ 'navigation_type' ]        = sanitize_text_field( $new_instance[ 'navigation_type' ] );

      for( $i=0; $i<4; $i++ ) {
        $instance[ 'page_id_'. $i ] = absint( $new_instance[ 'page_id_'. $i ] );
        $instance[ 'button_text_'. $i ]    = sanitize_text_field( $new_instance[ 'button_text_'. $i ] );
        $instance[ 'button_url_'. $i ]   = esc_url_raw( $new_instance[ 'button_url_'. $i ] );
      }
      return $instance;
    }

    function widget( $args, $instance ) {
      ob_start();
      extract( $args );

      $title              = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $section_id         = isset( $instance[ 'section_id' ] ) ? $instance[ 'section_id' ] : '';
      $text_color         = isset( $instance[ 'text_color' ] ) ? $instance[ 'text_color' ] : null;
      $widget_title_color = isset( $instance[ 'widget_title_color' ] ) ? $instance[ 'widget_title_color' ] : null;
      $image_link = !empty( $instance[ 'image_link' ] ) ? 'true' : 'false';
      $show_navigation = !empty( $instance[ 'show_navigation' ] ) ? 'true' : 'false';
      $navigation_type = isset( $instance[ 'navigation_type' ] ) ? $instance[ 'navigation_type' ] : 'arrow';

      $page_id    = array();
      $button_text = array();
      $button_url   =array();
      for( $i=0; $i<4; $i++ ) {
        $page_id[]    = isset( $instance[ 'page_id_'. $i ] ) ? $instance[ 'page_id_'. $i ] : '';
        $button_text[] = isset( $instance[ 'button_text_'. $i ] ) ? $instance[ 'button_text_'. $i ] : '';
        $button_url[]   = isset( $instance[ 'button_url_'. $i ] ) ? $instance[ 'button_url_'. $i ] : '';
      }

      $get_pages = new WP_Query( array(
         'posts_per_page'        => count( $page_id ),
         'post_type'             =>  array( 'page' ),
         'post__in'              => $page_id,
         'orderby'               => 'post__in'
      ) );
      if ( $text_color ) {
        $inherit = 'inherit';
      } else {
        $inherit = 'noinherit';
      }

      if ($section_id) {
        $id =  ' id="' . esc_attr( $section_id ) . '"';
      } else {
        $id = '';
      }

      echo $args['before_widget'] = str_replace('<section', '<section' . $id . ' data-color="' . esc_attr( $inherit ) . '" style="color:' . esc_attr( $text_color ) . ';"', $args['before_widget']); ?>

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
    .aop-page-slider-container {
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

        <div class="widget aop-page-slider">
          <div class="aop-section-title-wrapper">
            <?php if ( !empty( $title ) ) : ?> 
              <h2 class="widget-title" style="color: <?php echo esc_attr( $widget_title_color );?>"><?php echo esc_attr( $title ); ?></h2> 
            <?php endif; ?>
          </div><!-- .aop-section-title-wrapper -->

          <?php if ( $get_pages->have_posts() ) : $slider_count = 0; ?>
            <!-- Swiper -->
            <div class="aop-page-slider-container">
              <div class="swiper-wrapper">
                <?php while( $get_pages->have_posts() ):$get_pages->the_post();
                $title_attribute  = the_title_attribute( 'echo=0' );
                $image_id         = get_post_thumbnail_id();
                $image_path       = wp_get_attachment_image_src( $image_id, 'full', true );
                $image_alt        = get_post_meta( $image_id, '_wp_attachment_image_alt', true );?>
                <?php if( has_post_thumbnail() ) : ?>
                  <div class="swiper-slide">
                    <div class="sldier-image">
                      <?php if ( $image_link == 'true' ) : ?>
                        <a title="<?php esc_attr( $title_attribute ); ?>" href="<?php the_permalink(); ?>" alt="<?php esc_attr( $image_alt ); ?>" ><img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php echo esc_attr( $title_attribute ); ?>" ></a>
                      <?php else : ?>
                        <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php echo esc_attr( $title_attribute ); ?>" >                        
                      <?php endif; ?>
                    </div><!-- .slider-image -->  

                    <h2 class="slider-title">
                      <a title="<?php esc_attr( $title_attribute ); ?>" href="<?php the_permalink(); ?>" alt="<?php esc_attr( $title_attribute ); ?>"> <?php the_title(); ?></a>                    
                    </h2><!-- .slider-title -->

                    <div class="slider-content">
                      <?php the_excerpt(); ?>
                    </div><!-- .slider-content -->

                    <?php if ( !empty( $button_text[ $slider_count ] ) ) : ?>
                      <div class="slider-button">
                        <a href="<?php echo esc_url( $button_url[ $slider_count ] ); ?>" alt="<?php echo esc_attr( $button_text[ $slider_count ] ); ?>"><?php echo esc_html( $button_text[ $slider_count ] ); ?></a>                      
                      </div><!-- .slider-button -->
                    <?php endif; ?>

                  </div>
                <?php endif; ?>
                <?php $slider_count++;
                endwhile; 
                // Reset Post Data
                wp_reset_postdata();
                ?>
              </div>
              <?php if ( $show_navigation == 'true' ) : ?>
                <div class="aop-slider-controller">
                  <?php if ( $navigation_type == 'arrow' ) : ?>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>

                  <?php else : ?>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                  <?php endif; ?>
                </div><!-- .aop-slider-controller -->
                
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div><!-- .aop-page-slider -->

      <?php echo $args['after_widget'];
      ob_end_flush();
    }
}