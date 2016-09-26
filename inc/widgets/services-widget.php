<?php
/**
 * Services Widget section.
 */
class aop_service_widget extends WP_Widget {
	function __construct() {
    	$widget_ops = array( 'classname' => 'widget_service_block', 'description' => esc_html__( 'Display some pages as services.', 'awesome-one-page' ) );
    	$control_ops = array( 'width' => 200, 'height' =>250 );
      	parent::__construct( false, $name = esc_html__( 'AOP: Services', 'awesome-one-page' ), $widget_ops, $control_ops);
   	}

   	function form( $instance ) {
      $instance = wp_parse_args(
        (array) $instance, array(
            'title'             => '',
            'text'              => '',
            'no_of_posts'       => '4',
            'exclude_page_ids'  => '',
            'section_id'        => '',
            'background_color'  => '',
            'text_color'        => '',
            'widget_title_color'=> '',
            'background_image'  => ''  
        )
      ); ?>

    	<div class="aop-services">
    		<div class="aop-admin-input-wrap">
          <p><?php esc_html_e('This widget displays all pages related to Single Service Template.', 'awesome-one-page'); ?></p>
          <p><em><?php esc_html_e('Tip: to rearrange the services order, edit each service page and add a value in Page Attributes > Order', 'awesome-one-page'); ?></em></p>
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'awesome-one-page' ); ?></label>
          <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance[ 'title'] ); ?>" placeholder="<?php esc_html_e( 'Title', 'awesome-one-page' ); ?>">
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <?php esc_html_e( 'Description:','awesome-one-page' ); ?>
  			   <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name('text'); ?>" placeholder="<?php esc_html_e( 'Description', 'awesome-one-page' ); ?>" ><?php echo esc_textarea( $instance[ 'text' ] ); ?></textarea>
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php esc_html_e( 'Number of pages to display', 'awesome-one-page' ); ?></label>
          <input type="number" id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo esc_attr( $instance[ 'no_of_posts' ] ); ?>">
        </div><!-- .aop-admin-input-wrap -->

        <div class="aop-admin-input-wrap">
          <label for="<?php echo $this->get_field_id( 'exclude_page_ids' ); ?>"><?php esc_html_e( 'Exclude Page IDs', 'awesome-one-page' ); ?></label>
          <input type="text" id="<?php echo $this->get_field_id( 'exclude_page_ids' ); ?>" name="<?php echo $this->get_field_name( 'exclude_page_ids' ); ?>" value="<?php echo esc_attr( $instance[ 'exclude_page_ids'] ); ?>" placeholder="<?php esc_html_e( '11,43,50', 'awesome-one-page' ); ?>">
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
                  <p><em><?php esc_html_e('Tip: Enter the Service Section ID and use same for Menu item. Only used for One Page Menu.', 'awesome-one-page'); ?></em></p>
                </div><!-- .aop-admin-input-wrap -->

                <div class="aop-admin-input-wrap">
                  <label for="<?php echo $this->get_field_id( 'section_id' ); ?>"><?php esc_html_e( 'Section ID', 'awesome-one-page' ); ?></label>
                  <input type="text" id="<?php echo $this->get_field_id( 'section_id' ); ?>" name="<?php echo $this->get_field_name( 'section_id' ); ?>" value="<?php echo esc_attr( $instance[ 'section_id'] ); ?>" placeholder="<?php esc_html_e( 'service', 'awesome-one-page' ); ?>">
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

      </div><!-- .aop-services -->
   	<?php }

   	function update( $new_instance, $old_instance ) {
    	$instance = $old_instance;
    	
    	$instance[ 'title' ]             = sanitize_text_field( $new_instance[ 'title' ] );
    	$instance[ 'no_of_posts' ]       = absint( $new_instance[ 'no_of_posts' ] );
      $instance[ 'exclude_page_ids' ]  = sanitize_text_field( $new_instance[ 'exclude_page_ids' ] );
      $instance[ 'section_id' ]        = sanitize_text_field( $new_instance[ 'section_id' ] );
      $instance[ 'background_color' ]  = sanitize_text_field( $new_instance[ 'background_color' ] );
      $instance[ 'text_color' ]        = sanitize_text_field( $new_instance[ 'text_color' ] );
      $instance[ 'widget_title_color' ]= sanitize_text_field( $new_instance[ 'widget_title_color' ] );
      $instance[ 'background_image' ]  = esc_url_raw( $new_instance[ 'background_image' ] );

    	if ( current_user_can('unfiltered_html') )
       	$instance[ 'text' ] =  $new_instance[ 'text' ];
    	else
       	$instance[ 'text' ] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'text' ] ) ) ); // wp_filter_post_kses() expects slashed
    	return $instance;
   	}

   	function widget( $args, $instance ) {
    	ob_start();
      extract($args);

    	$title              = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
    	$text               = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
    	$no_of_posts        = empty( $instance[ 'no_of_posts' ] ) ? 4 : intval( $instance[ 'no_of_posts' ] );
      $exclude_page_ids   = isset( $instance[ 'exclude_page_ids' ] ) ? $instance[ 'exclude_page_ids' ] : '';
      $section_id         = isset( $instance[ 'section_id' ] ) ? $instance[ 'section_id' ] : '';
      $background_color   = isset( $instance[ 'background_color' ] ) ? $instance[ 'background_color' ] : null;
      $text_color         = isset( $instance[ 'text_color' ] ) ? $instance[ 'text_color' ] : null;
      $widget_title_color = isset( $instance[ 'widget_title_color' ] ) ? $instance[ 'widget_title_color' ] : null;
      $background_image   = isset( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';

      if ($text_color) {
        $inherit = 'inherit';
      } else {
        $inherit = 'noinherit';
      }
      $section = '';
      if ( !empty( $section_id ) ) {
        $section = 'id="' . esc_attr( $section_id ) . '"';
      }
      $background_style = '';
      if ( !empty( $background_image ) ) {
         $background_style .= 'background-image:url('.esc_url( $background_image ).');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;';
      }else {
         $background_style .= 'background-color:'.esc_attr( $background_color ).';';
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
              'key'   => '_wp_page_template',
              'value' => 'page-templates/template-services.php'
            )
          )
      ) );

      echo $args['before_widget']; ?>

      <div <?php echo $section; ?> >
	    	<div class="widget aop-services-pages" style="<?php echo $background_style; ?>">
	    		<div class="aop-section-title-wrapper">
          	<?php if ( !empty( $title ) ) : ?> 
          		<h2 class="widget-title" style="color: <?php echo esc_attr( $widget_title_color );?>"><?php echo esc_attr( $title ); ?></h2> 
          	<?php endif; ?>
          	<?php if ( !empty( $text ) ) : ?> 
          		<p class="widget-desciption" style="color: <?php echo esc_attr( $text_color );?>"><?php echo esc_textarea( $text ); ?></p> 
          	<?php endif; ?>
         	</div><!-- .aop-section-title-wrapper -->

         	<div class="aop-section-content-wrapper">
          	<?php if ( $get_featured_pages->have_posts() ) : ?>
          		<div class="entry-content" data-color="<?php echo esc_attr( $inherit ); ?>" style="color: <?php echo esc_attr( $text_color );?>">
                <?php while( $get_featured_pages->have_posts() ) : $get_featured_pages->the_post(); 
                  $title_attribute  = the_title_attribute( 'echo=0' );
                  $image_id         = get_post_thumbnail_id();
                  $image_path       = wp_get_attachment_image_src( $image_id, 'thumbnail', true );
                  $image_alt        = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                  $service_icon     = get_post_meta( $post->ID, 'aop_service_font_icon', true );
                  $service_icon     = isset( $service_icon ) ? $service_icon : '';
                  $service_class    = '' ;
                  if( has_post_thumbnail() ) {
                    $service_class = 'service-thumbnail';
                    $service_image_holder = '<figure><img src="'.esc_url( $image_path[0] ).'" alt="'.esc_attr( $image_alt ).'" title="'.esc_attr( $title_attribute ).'" /></figure>';
                  } else {
                    $service_class = 'service-icon';
                    $service_image_holder = '<i class="fa '.esc_attr( $service_icon ).'"></i>';;
                  } ?>
                  <div class="service-column-3">
                    <?php if( has_post_thumbnail() || !empty( $service_icon ) ) : ?>
                      <div class="<?php echo esc_attr( $service_class ); ?>">
                        <?php echo $service_image_holder; ?>
                      </div><!-- .thumbnail -->
                    <?php endif; ?>
                    <h2 class="service-title" >
                      <a title="<?php esc_attr( $title_attribute ); ?>" href="<?php the_permalink(); ?>" alt="<?php esc_attr( $title_attribute ); ?>" style="color: <?php echo esc_attr( $inherit );?>"> <?php the_title(); ?></a>                    
                    </h2><!-- .service-title -->
                    <div class="service-content">
                       <?php the_excerpt(); ?>
                    </div><!-- .service-content -->
                  </div><!-- .service-column-3 -->
                <?php endwhile; 
                // Reset Post Data
                wp_reset_postdata();?>
              </div><!-- .entry-content -->
          	<?php endif; ?>
         	</div><!-- .aop-section-title-wrapper -->
	      </div><!-- .aop-services-pages -->
	    </div>
    	<?php echo $args['after_widget'];
      ob_end_flush();
   	}
}