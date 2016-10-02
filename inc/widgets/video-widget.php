<?php

/**
 * Video Widget section.
 */
class aop_video_widget extends WP_Widget {
  function __construct() {
      $widget_ops = array( 'classname' => 'widget_video_block', 'description' => esc_html__( 'Display video from Youtube,Vimeo etc.', 'awesome-one-page' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
        parent::__construct( false, $name = esc_html__( 'AOP: Video', 'awesome-one-page' ), $widget_ops, $control_ops);
    }

    function form( $instance ) {
      $instance = wp_parse_args(
        (array) $instance, array(
          'title'             => '',
          'video_url'         => '',
          'section_id'        => '',
          'widget_title_color' => ''
        )
      ); ?>

      <div class="aop-video">
        <div class="aop-admin-input-wrap">
          <p><em><?php esc_html_e('This widget displays videos related to Youtube, Video etc.', 'awesome-one-page'); ?></em></p>
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'awesome-one-page' ); ?></label>
          <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance[ 'title'] ); ?>" placeholder="<?php esc_attr_e( 'Title', 'awesome-one-page' ); ?>">
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <label for="<?php echo $this->get_field_id( 'video_url' ); ?>"><?php esc_html_e( 'Paste the complete video URL', 'awesome-one-page' ); ?></label>
          <input type="text" id="<?php echo $this->get_field_id( 'video_url' ); ?>" name="<?php echo $this->get_field_name( 'video_url' ); ?>" value="<?php echo esc_attr( $instance[ 'video_url' ] ); ?>">
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
                  <p><em><?php esc_html_e('Tip: Enter the Video Section ID and use same for Menu item. Only used for One Page Menu.', 'awesome-one-page'); ?></em></p>
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'section_id' ); ?>"><?php esc_html_e( 'Section ID', 'awesome-one-page' ); ?></label>
                  <input type="text" id="<?php echo $this->get_field_id( 'section_id' ); ?>" name="<?php echo $this->get_field_name( 'section_id' ); ?>" value="<?php echo esc_attr( $instance[ 'section_id'] ); ?>" placeholder="<?php esc_attr_e( 'video', 'awesome-one-page' ); ?>">
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'widget_title_color' ); ?>"><?php esc_html_e( 'Widget Title Color', 'awesome-one-page' ); ?></label>
                  <input type="text" id="<?php echo $this->get_field_id( 'widget_title_color' ); ?>" class="aop-color-picker" name="<?php echo $this->get_field_name( 'widget_title_color' ); ?>" value="<?php echo esc_attr( $instance[ 'widget_title_color' ] ); ?>" >
                </div><!-- .aop-admin-input-wrap -->
                
              </div><!-- .accordion-content -->
            </li><!-- .aop-widget-accordion-item -->
          </ul><!-- .aop-widget-repetable-field-items -->
        </div><!-- .accordion-sortables -->

      </div><!-- .aop-video -->
    <?php }

    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      
      $instance[ 'title' ]              = sanitize_text_field( $new_instance[ 'title' ] );
      $instance[ 'video_url' ]          = esc_url_raw( $new_instance[ 'video_url' ] );
      $instance[ 'section_id' ]         = sanitize_text_field( $new_instance[ 'section_id' ] );
      $instance[ 'widget_title_color' ] = sanitize_text_field( $new_instance[ 'widget_title_color' ] );
      $alloptions = wp_cache_get( 'alloptions', 'options' );
      if ( isset($alloptions['widget_video_block']) )
        delete_option('widget_video_block');
        return $instance;
      }

    function widget( $args, $instance ) {
      ob_start();      
      extract( $args );

      $title              = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $video_url          = isset( $instance[ 'video_url' ] ) ? $instance[ 'video_url' ] : '';
      $section_id         = isset( $instance[ 'section_id' ] ) ? $instance[ 'section_id' ] : '';
      $widget_title_color = isset( $instance[ 'widget_title_color' ] ) ? $instance[ 'widget_title_color' ] : null;

      if ($section_id) {
        $id =  ' id="' . $section_id . '"';
      } else {
        $id = '';
      }

      echo $args['before_widget'] = str_replace('<section', '<section' . esc_attr( $id ), $args['before_widget']); ?>

        <div class="widget aop-video-pages">
          <div class="aop-section-title-wrapper">
            <?php if ( !empty( $title ) ) : ?> 
              <h2 class="widget-title" style="color: <?php echo esc_attr( $widget_title_color );?>"><?php echo esc_attr( $title ); ?></h2> 
            <?php endif; ?>
          </div><!-- .aop-section-title-wrapper -->

          <div class="aop-section-content-wrapper">
            <div class="entry-content">
              <?php if( !empty( $video_url ) ) {
                echo wp_oembed_get( $video_url );
              } ?>
            </div><!-- .entry-content -->
          </div><!-- .aop-section-title-wrapper -->
        </div><!-- .aop-video-pages -->

      <?php echo $args['after_widget'];
      ob_end_flush();
    }
}