<?php

/**
 * Fun Facts Widget section.
 */
class aop_fun_facts_widget extends WP_Widget {
  function __construct() {
      $widget_ops = array( 'classname' => 'widget_fun_facts_block', 'description' => esc_html__( 'Show your visitors some facts about your organization.', 'awesome-one-page' ) );
      $control_ops = array( 'width' => 200, 'height' =>250 );
        parent::__construct( false, $name = esc_html__( 'AOP: Fun Facts', 'awesome-one-page' ), $widget_ops, $control_ops);
    }

    function form( $instance ) {
      $defaults             = array();
      $defaults[ 'title' ]  = '';
      $defaults[ 'text' ]   = '';
      for ($i=0; $i<4 ; $i++) {
        $defaults[ 'fact_detail_'. $i ] = '';
        $defaults[ 'fact_num_'. $i ]    = '';
        $defaults[ 'fact_icon_'. $i ]   = '';
      }
      $defaults[ 'section_id' ]         = '';
      $defaults[ 'background_color' ]   = '';
      $defaults[ 'text_color' ]         = '';
      $defaults[ 'widget_title_color' ] = '';
      $defaults[ 'background_image' ]   = '';
      $instance = wp_parse_args( (array) $instance, $defaults );
    ?>

      <div class="aop-fun-facts">
        <div class="aop-admin-input-wrap">
          <p><em><?php esc_html_e('Show your visitors some facts about your organization.', 'awesome-one-page'); ?></em></p>
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'awesome-one-page' ); ?></label>
          <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance[ 'title'] ); ?>" placeholder="<?php esc_html_e( 'Title', 'awesome-one-page' ); ?>">
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <?php esc_html_e( 'Description:','awesome-one-page' ); ?>
           <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name('text'); ?>" placeholder="<?php esc_html_e( 'Description', 'awesome-one-page' ); ?>" ><?php echo esc_textarea( $instance[ 'text' ] ); ?></textarea>
        </div><!-- .aop-admin-input-wrap -->

        <?php for ( $i=0; $i<4 ; $i++ ) : ?>

          <div class="aop-admin-input-wrap">
            <label for="<?php echo $this->get_field_id( 'fact_detail_'. $i ); ?>"><?php esc_html_e( 'Fact Detail:', 'awesome-one-page' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'fact_detail_'. $i ); ?>" name="<?php echo $this->get_field_name( 'fact_detail_'. $i ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'fact_detail_'. $i ] ); ?>" placeholder="<?php esc_html_e( 'Achievement', 'awesome-one-page' ); ?>"/>
          </div><!-- .aop-admin-input-wrap -->

          <div class="aop-admin-input-wrap">
            <label for="<?php echo $this->get_field_id( 'fact_num_'. $i ); ?>"><?php esc_html_e( 'Fact number: ', 'awesome-one-page' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'fact_num_'. $i ); ?>" name="<?php echo $this->get_field_name( 'fact_num_'. $i ); ?>" type="text" min="1" step="1" value="<?php echo absint( $instance[ 'fact_num_'. $i ] ); ?>" />
          </div><!-- .aop-admin-input-wrap -->

          <div class="aop-admin-input-wrap">
            <label for="<?php echo $this->get_field_id( 'fact_icon_'. $i ); ?>"><?php esc_html_e( 'Icon Class:', 'awesome-one-page' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'fact_icon_'. $i ); ?>" name="<?php echo $this->get_field_name( 'fact_icon_'. $i ); ?>" placeholder="fa-trophy" type="text" value="<?php echo esc_attr( $instance[ 'fact_icon_'. $i ] ); ?>" />
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
                  <p><em><?php esc_html_e('Tip: Enter the Fun Facts Section ID and use same for Menu item. Only used for One Page Menu.', 'awesome-one-page'); ?></em></p>
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'section_id' ); ?>"><?php esc_html_e( 'Section ID', 'awesome-one-page' ); ?></label>
                  <input type="text" id="<?php echo $this->get_field_id( 'section_id' ); ?>" name="<?php echo $this->get_field_name( 'section_id' ); ?>" value="<?php echo esc_attr( $instance[ 'section_id'] ); ?>" placeholder="<?php esc_html_e( 'fun-facts', 'awesome-one-page' ); ?>">
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

      </div><!-- .aop-fun-facts -->
    <?php }

    function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      
      $instance[ 'title' ]              = sanitize_text_field( $new_instance[ 'title' ] );
      $instance[ 'section_id' ]         = sanitize_text_field( $new_instance[ 'section_id' ] );
      $instance[ 'background_color' ]   = sanitize_text_field( $new_instance[ 'background_color' ] );
      $instance[ 'text_color' ]         = sanitize_text_field( $new_instance[ 'text_color' ] );
      $instance[ 'widget_title_color' ] = sanitize_text_field( $new_instance[ 'widget_title_color' ] );
      $instance[ 'background_image' ]   = esc_url_raw( $new_instance[ 'background_image' ] );

      for( $i=0; $i<4; $i++ ) {
        $instance[ 'fact_num_'. $i ]    = absint( $new_instance[ 'fact_num_'. $i ] );
        $instance[ 'fact_detail_'. $i ] = sanitize_text_field( $new_instance[ 'fact_detail_'. $i ] );
        $instance[ 'fact_icon_'. $i ]   = sanitize_text_field( $new_instance[ 'fact_icon_'. $i ] );
      }

      if ( current_user_can('unfiltered_html') )
        $instance[ 'text' ] =  $new_instance[ 'text' ];
      else
        $instance[ 'text' ] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'text' ] ) ) ); // wp_filter_post_kses() expects slashed
      return $instance;
    }

    function widget( $args, $instance ) {
      ob_start();
      extract( $args );

      $title              = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
      $text               = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $section_id         = isset( $instance[ 'section_id' ] ) ? $instance[ 'section_id' ] : '';
      $background_color   = isset( $instance[ 'background_color' ] ) ? $instance[ 'background_color' ] : null;
      $text_color         = isset( $instance[ 'text_color' ] ) ? $instance[ 'text_color' ] : null;
      $widget_title_color = isset( $instance[ 'widget_title_color' ] ) ? $instance[ 'widget_title_color' ] : null;
      $background_image   = isset( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';

      $fact_nums    = array();
      $fact_deatils = array();
      $fact_icons   =array();
      for( $i=0; $i<4; $i++ ) {
        $fact_nums[]    = isset( $instance[ 'fact_num_'. $i ] ) ? $instance[ 'fact_num_'. $i ] : '';
        $fact_deatils[] = isset( $instance[ 'fact_detail_'. $i ] ) ? $instance[ 'fact_detail_'. $i ] : '';
        $fact_icons[]   = isset( $instance[ 'fact_icon_'. $i ] ) ? $instance[ 'fact_icon_'. $i ] : '';
      }
      if ( $text_color ) {
        $inherit = 'inherit';
      } else {
        $inherit = 'noinherit';
      }

      $section = '';
      if ( !empty( $section_id ) )
        $section = 'id="' . esc_attr( $section_id ) . '"';

      $background_style = '';
      if ( !empty( $background_image ) ) {
         $background_style .= 'background-image:url(' . esc_url( $background_image ) . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;';
      }else {
         $background_style .= 'background-color:' . esc_attr( $background_color ) . ';';
      }

      echo $args['before_widget']; ?>

      <div <?php echo $section; ?> >
        <div class="widget aop-fun-facts-pages" style="<?php echo $background_style; ?>">
          <div class="aop-section-title-wrapper">
            <?php if ( !empty( $title ) ) : ?> 
              <h2 class="widget-title" style="color: <?php echo esc_attr( $widget_title_color );?>"><?php echo esc_attr( $title ); ?></h2> 
            <?php endif; ?>
            <?php if ( !empty( $text ) ) : ?> 
              <p class="widget-desciption" style="color: <?php echo esc_attr( $text_color );?>"><?php echo esc_textarea( $text ); ?></p> 
            <?php endif; ?>
          </div><!-- .aop-section-title-wrapper -->

          <div class="aop-section-content-wrapper" data-color="<?php echo esc_attr( $inherit );?>" style="color:<?php echo esc_attr( $text_color ); ?>">
            <div class="entry-content">
              
                <?php for( $i=0; $i<4; $i++ ) : ?>
                  <div class="counter-wrapper">
                    <?php if ( !empty( $fact_nums[$i] ) ) : ?>
                      <span class="count-number" data-delay="10" data-time="1000"><?php echo intval( $fact_nums[ $i ] ); ?></span>
                    <?php  endif; if ( !empty( $fact_deatils[$i] ) ) : ?>
                      <span class="count-text"><?php echo esc_html( $fact_deatils[ $i ] ); ?></span>
                    <?php endif; if ( !empty( $fact_icons[$i] ) ) : ?>
                      <span class="count-icon"><i class="fa <?php echo esc_html( $fact_icons[ $i ] ); ?>"></i></span>
                    <?php endif; ?>
                  </div><!-- .counter-wrapper -->
                <?php endfor; ?>
              
            </div><!-- .entry-content -->
          </div><!-- .aop-section-title-wrapper -->
        </div><!-- .aop-fun-facts-pages -->
      </div>
      <?php echo $args['after_widget'];
      ob_end_flush();
    }
}