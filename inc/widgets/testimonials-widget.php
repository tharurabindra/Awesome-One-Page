<?php

/**
 * Testimonials Widget section.
 */
class aop_testimonial_widget extends WP_Widget {
  function __construct() {
      $widget_ops = array( 'classname' => 'widget_testimonial_block', 'description' => esc_html__( 'Display some pages as testimonial.', 'awesome-one-page' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
        parent::__construct( false, $name = esc_html__( 'AOP: Testimonials', 'awesome-one-page' ), $widget_ops, $control_ops);
    }

    function form( $instance ) {
      $instance = wp_parse_args(
        (array) $instance, array(
            'title'             => '',
            'no_of_posts'       => '4',
            'exclude_page_ids'  => '',
            'section_id'        => '',
            'background_color'  => '',
            'text_color'        => '',
            'widget_title_color'=> '',
            'background_image'  => ''  
        )
      ); ?>

      <div class="aop-testimonial">
        <div class="aop-admin-input-wrap">
          <p><?php esc_html_e('This widget displays all pages related to Single Testimonial Template.', 'awesome-one-page'); ?></p>
          <p><em><?php esc_html_e('Tip: to rearrange the testimonial order, edit each testimonial page and add a value in Page Attributes > Order', 'awesome-one-page'); ?></em></p>
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'awesome-one-page' ); ?></label>
          <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance[ 'title'] ); ?>" placeholder="<?php esc_attr_e( 'Title', 'awesome-one-page' ); ?>">
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php esc_html_e( 'Number of pages to display', 'awesome-one-page' ); ?></label>
          <input type="number" id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo esc_attr( $instance[ 'no_of_posts' ] ); ?>">
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <label for="<?php echo $this->get_field_id( 'exclude_page_ids' ); ?>"><?php esc_html_e( 'Exclude Page IDs', 'awesome-one-page' ); ?></label>
          <input type="text" id="<?php echo $this->get_field_id( 'exclude_page_ids' ); ?>" name="<?php echo $this->get_field_name( 'exclude_page_ids' ); ?>" value="<?php echo esc_attr( $instance[ 'exclude_page_ids'] ); ?>" placeholder="<?php esc_attr_e( '11,43,50', 'awesome-one-page' ); ?>">
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
                  <p><em><?php esc_html_e('Tip: Enter the Testimonial Section ID and use same for Menu item. Only used for One Page Menu.', 'awesome-one-page'); ?></em></p>
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'section_id' ); ?>"><?php esc_html_e( 'Section ID', 'awesome-one-page' ); ?></label>
                  <input type="text" id="<?php echo $this->get_field_id( 'section_id' ); ?>" name="<?php echo $this->get_field_name( 'section_id' ); ?>" value="<?php echo esc_attr( $instance[ 'section_id'] ); ?>" placeholder="<?php esc_attr_e( 'testimonial', 'awesome-one-page' ); ?>">
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

      </div><!-- .aop-testimonial -->
    <?php }

    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      
      $instance[ 'title' ]              = sanitize_text_field( $new_instance[ 'title' ] );
      $instance[ 'no_of_posts' ]        = absint( $new_instance[ 'no_of_posts' ] );
      $instance[ 'exclude_page_ids' ]   = sanitize_text_field( $new_instance[ 'exclude_page_ids' ] );
      $instance[ 'section_id' ]         = sanitize_text_field( $new_instance[ 'section_id' ] );
      $instance[ 'background_color' ]   = sanitize_text_field( $new_instance[ 'background_color' ] );
      $instance[ 'text_color' ]         = sanitize_text_field( $new_instance[ 'text_color' ] );
      $instance[ 'widget_title_color' ] = sanitize_text_field( $new_instance[ 'widget_title_color' ] );
      $instance[ 'background_image' ]   = esc_url_raw( $new_instance[ 'background_image' ] );
      return $instance;
    }

    function widget( $args, $instance ) {
      ob_start();
      extract( $args );
      global $post;
      
      $title              = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $no_of_posts        = empty( $instance[ 'no_of_posts' ] ) ? 4 : intval( $instance[ 'no_of_posts' ] );
      $exclude_page_ids   = isset( $instance[ 'exclude_page_ids' ] ) ? $instance[ 'exclude_page_ids' ] : '';
      $section_id         = isset( $instance[ 'section_id' ] ) ? $instance[ 'section_id' ] : '';
      $background_color   = isset( $instance[ 'background_color' ] ) ? $instance[ 'background_color' ] : null;
      $text_color         = isset( $instance[ 'text_color' ] ) ? $instance[ 'text_color' ] : null;
      $widget_title_color = isset( $instance[ 'widget_title_color' ] ) ? $instance[ 'widget_title_color' ] : null;
      $background_image   = isset( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';

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

      if ( $exclude_page_ids ) {
        $ids = explode(',', $exclude_page_ids);
      } else {
        $ids = '';
      } 

      $get_featured_pages = new WP_Query( array(
        'no_found_rows'   => true,
        'post_status'     => 'publish',
        'posts_per_page'  => intval( $no_of_posts ),
        'post_type'       =>  array( 'page' ),
        'post__not_in'    => $ids,
        'orderby'         => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
        'meta_query' => array(
            array(
              'key' => '_wp_page_template',
              'value' => 'page-templates/template-testimonial.php'
            )
          )
      ) );

      echo $args['before_widget'] = str_replace('<section', '<section' . esc_attr( $id ) . ' data-color="' . esc_attr( $inherit ) . '" style="color:' . esc_attr( $text_color ) . ';background-color:' . esc_attr( $background_color ) . ';background-image:url(' . esc_url( $background_image ) . ');"', $args['before_widget']); ?>

        <div class="widget aop-testimonial-pages">
          <div class="aop-section-title-wrapper">
            <?php if ( !empty( $title ) ) : ?> 
              <h2 class="widget-title" style="color: <?php echo esc_attr( $widget_title_color );?>"><?php echo esc_attr( $title ); ?></h2> 
            <?php endif; ?>
          </div><!-- .aop-section-title-wrapper -->

          <div class="aop-section-content-wrapper">
            <?php if ( $get_featured_pages->have_posts() ) : ?>
              <div class="entry-content">
                <?php while( $get_featured_pages->have_posts() ) : $get_featured_pages->the_post(); 
                  $title_attribute          = the_title_attribute( 'echo=0' );
                  $image_id                 = get_post_thumbnail_id();
                  $image_path               = wp_get_attachment_image_src( $image_id, 'thumbnail', true );
                  $image_alt                = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                  $testimonial_designation  = get_post_meta( $post->ID, 'awesome_one_page_testimonial_designation', true );
                  if( has_post_thumbnail() ) {
                    $testimonial_image_holder = '<figure><img src="'.esc_url( $image_path[0] ).'" alt="'.esc_attr( $image_alt ).'" title="'.esc_attr( $title_attribute ).'" /></figure>';
                  } ?>
                  <div class="testimonial-column-3">
                    <?php if( has_post_thumbnail() || !empty( $testimonial_icon ) ) : ?>
                      <div class="testimonial-thumbnail">
                        <?php echo $testimonial_image_holder; ?>
                      </div><!-- .thumbnail -->
                    <?php endif; ?>

                    <h2 class="testimonial-title">
                      <a title="<?php esc_attr( $title_attribute ); ?>" href="<?php the_permalink(); ?>" alt="<?php esc_attr( $title_attribute ); ?>"> <?php the_title(); ?></a>                    
                    </h2><!-- .testimonial-title -->

                    <?php if ( $testimonial_designation ) : ?>
                      <div class="testimonial-designation">
                        <?php echo esc_html( $testimonial_designation ); ?>
                      </div><!-- .testimonial-designation -->
                    <?php endif; ?>

                    <div class="testimonial-content">
                       <?php the_excerpt(); ?>
                    </div><!-- .testimonial-content -->

                  </div><!-- .testimonial-column-3 -->
                <?php endwhile; 
                // Reset Post Data
                wp_reset_postdata();?>
              </div><!-- .entry-content -->
            <?php endif; ?>
          </div><!-- .aop-section-title-wrapper -->
        </div><!-- .aop-testimonial-pages -->

      <?php echo $args['after_widget'];
      ob_end_flush();
    }
}