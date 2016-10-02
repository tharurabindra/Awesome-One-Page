<?php

/**
 * Social Icons Widget section.
 */
class aop_social_icons_widget extends WP_Widget {
  function __construct() {
    $widget_ops = array( 'classname' => 'aop_social_icons_widget', 'description' => esc_html__( 'Show your Social Icons.', 'awesome-one-page' ) );
    $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false, $name = esc_html__( 'AOP: Social Icons', 'awesome-one-page' ), $widget_ops, $control_ops);
  }

  function form( $instance ) {
    $defaults             = array();
    $defaults[ 'title' ]  = '';
    for ($i=0; $i<12 ; $i++) {
      $defaults[ 'social_icon_'. $i ] = '';
    }
    $defaults[ 'section_id' ]         = '';
    $defaults[ 'background_color' ]   = '';
    $defaults[ 'text_color' ]         = '';
    $defaults[ 'widget_title_color' ] = '';
    $defaults[ 'background_image' ]   = '';
    $instance = wp_parse_args( (array) $instance, $defaults );

    $social_icon = array(
      '0' =>  esc_html__( 'Facebook', 'awesome-one-page' ),
      '1' =>  esc_html__( 'Twitter', 'awesome-one-page' ),
      '2' =>  esc_html__( 'G plus', 'awesome-one-page' ),
      '3' =>  esc_html__( 'Instagram', 'awesome-one-page' ),
      '4' =>  esc_html__( 'Github', 'awesome-one-page' ),
      '5' =>  esc_html__( 'Flickr', 'awesome-one-page' ),
      '6' =>  esc_html__( 'Pinterest', 'awesome-one-page' ),
      '7' =>  esc_html__( 'WordPress', 'awesome-one-page' ),
      '8' =>  esc_html__( 'Youtube', 'awesome-one-page' ),
      '9' =>  esc_html__( 'Video', 'awesome-one-page' ),
      '10'  =>  esc_html__( 'linkedin', 'awesome-one-page' ),
      '11'  =>  esc_html__( 'Behance', 'awesome-one-page' ),
      '12'  =>  esc_html__( 'Dribbble', 'awesome-one-page' )
    );
    $social_url = array(
      '0' =>  esc_url( 'https://www.facebook.com/', 'awesome-one-page' ),
      '1' =>  esc_url( 'https://twitter.com/', 'awesome-one-page' ),
      '2' =>  esc_url( 'https://plus.google.com/', 'awesome-one-page' ),
      '3' =>  esc_url( 'https://instagram.com/', 'awesome-one-page' ),
      '4' =>  esc_url( 'https://github.com/', 'awesome-one-page' ),
      '5' =>  esc_url( 'https://www.flickr.com/', 'awesome-one-page' ),
      '6' =>  esc_url( 'https://www.pinterest.com/', 'awesome-one-page' ),
      '7' =>  esc_url( 'https://wordpress.org/', 'awesome-one-page' ),
      '8' =>  esc_url( 'https://www.youtube.com/', 'awesome-one-page' ),
      '9' =>  esc_url( 'https://vimeo.com/', 'awesome-one-page' ),
      '10'  =>  esc_url( 'https://linkedin.com', 'awesome-one-page' ),
      '11'  =>  esc_url( 'https://www.behance.net/', 'awesome-one-page' ),
      '12'  =>  esc_url( 'https://dribbble.com/', 'awesome-one-page' )
    );

  ?>
    <div class="aop-social-icons">
      <div class="aop-admin-input-wrap">
        <p><em><?php esc_html_e('Show your Social Icons.', 'awesome-one-page'); ?></em></p>
      </div><!-- .aop-admin-input-wrap -->

      <div class="aop-admin-input-wrap">
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'awesome-one-page' ); ?></label>
        <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance[ 'title'] ); ?>" placeholder="<?php esc_attr_e( 'Title', 'awesome-one-page' ); ?>">
      </div><!-- .aop-admin-input-wrap -->

      <?php for ( $i=0; $i<12 ; $i++ ) : ?>

        <div class="aop-admin-input-wrap">
          <label for="<?php echo $this->get_field_id( 'social_icon_'. $i ); ?>"><?php echo esc_html( $social_icon[$i] ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'social_icon_'. $i ); ?>" name="<?php echo $this->get_field_name( 'social_icon_'. $i ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'social_icon_'. $i ] ); ?>" placeholder="<?php echo esc_attr( $social_url[$i] ); ?>"/>
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
                <p><em><?php esc_html_e('Tip: Enter the Social Icons Section ID and use same for Menu item. Only used for One Page Menu.', 'awesome-one-page'); ?></em></p>
              </div><!-- .aop-admin-input-wrap -->

              <div class="aop-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'section_id' ); ?>"><?php esc_html_e( 'Section ID', 'awesome-one-page' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'section_id' ); ?>" name="<?php echo $this->get_field_name( 'section_id' ); ?>" value="<?php echo esc_attr( $instance[ 'section_id'] ); ?>" placeholder="<?php esc_attr_e( 'social', 'awesome-one-page' ); ?>">
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

    </div><!-- .aop-social-icons -->
  <?php }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    
    $instance[ 'title' ]              = sanitize_text_field( $new_instance[ 'title' ] );
    $instance[ 'section_id' ]         = sanitize_text_field( $new_instance[ 'section_id' ] );
    $instance[ 'background_color' ]   = sanitize_text_field( $new_instance[ 'background_color' ] );
    $instance[ 'text_color' ]         = sanitize_text_field( $new_instance[ 'text_color' ] );
    $instance[ 'widget_title_color' ] = sanitize_text_field( $new_instance[ 'widget_title_color' ] );
    $instance[ 'background_image' ]   = esc_url_raw( $new_instance[ 'background_image' ] );

    for( $i=0; $i<12; $i++ ) {
      $instance[ 'social_icon_'. $i ]    = esc_url_raw( $new_instance[ 'social_icon_'. $i ] );
    }
    return $instance;
  }

  function widget( $args, $instance ) {
    ob_start();
    extract( $args );

    $title              = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
    $section_id         = isset( $instance[ 'section_id' ] ) ? $instance[ 'section_id' ] : '';
    $background_color   = isset( $instance[ 'background_color' ] ) ? $instance[ 'background_color' ] : null;
    $text_color         = isset( $instance[ 'text_color' ] ) ? $instance[ 'text_color' ] : null;
    $widget_title_color = isset( $instance[ 'widget_title_color' ] ) ? $instance[ 'widget_title_color' ] : null;
    $background_image   = isset( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';

    $font_icon = array(
      '0' =>  'fa-facebook', 
      '1' =>  'fa-twitter',
      '2' =>  'fa-google-plus',
      '3' =>  'fa-instagram',
      '4' =>  'fa-github',
      '5' =>  'fa-flickr',
      '6' =>  'fa-pinterest',
      '7' =>  'fa-wordpress',
      '8' =>  'fa-youtube',
      '9' =>  'fa-vimeo',
      '10'  =>  'fa-linkedin',
      '11'  =>  'fa-behance',
      '12'  =>  'fa-dribbble'
    );
    $social_icon        = array();
    for( $i=0; $i<12; $i++ ) {
      $social_icon[]    = isset( $instance[ 'social_icon_'. $i ] ) ? $instance[ 'social_icon_'. $i ] : '';
    }
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

    echo $args['before_widget'] = str_replace('<section', '<section' . esc_attr( $id ) . ' data-color="' . esc_attr( $inherit ) . '" style="color:' . esc_attr( $text_color ) . ';background-color:' . esc_attr( $background_color ) . ';background-image:url(' . esc_url( $background_image ) . ');"', $args['before_widget']); ?>

      <div class="widget aop-social-icons">
        <div class="aop-section-title-wrapper">
          <?php if ( !empty( $title ) ) : ?> 
            <h2 class="widget-title" style="color: <?php echo esc_attr( $widget_title_color );?>"><?php echo esc_attr( $title ); ?></h2> 
          <?php endif; ?>
        </div><!-- .aop-section-title-wrapper -->

        <div class="aop-section-content-wrapper">
          <div class="entry-content">
            <ul>
              <?php for( $i=0; $i<12; $i++ ) : 
              if ( !empty( $social_icon[$i] ) ) : ?>
                <li><a href="<?php echo esc_url( $social_icon[$i] ); ?>" target="_blank"><i class="fa <?php echo esc_attr( $font_icon[$i] )?>"></i></a> </li>
              <?php endif;
              endfor; ?>
            </ul>                  
          </div><!-- .entry-content -->
        </div><!-- .aop-section-content-wrapper -->
      </div><!-- .aop-social-icons -->

    <?php echo $args['after_widget'];
    ob_end_flush();
  }
}