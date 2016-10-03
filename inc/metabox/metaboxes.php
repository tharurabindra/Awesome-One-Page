<?php
/**
 * This function is responsible for rendering metaboxes in single post/page area
 * 
 * @package Awesome_One_Page
 */
 
 add_action( 'add_meta_boxes', 'aop_add_layout_metabox' );
/**
 * Add Meta Boxes.
 */
function aop_add_layout_metabox() {
	// Adding layout meta box for Page
	add_meta_box( 'page-layout', esc_html__( 'Select Layout', 'awesome-one-page' ), 'awesome_one_page_layout_call', 'page', 'normal', 'high' );
	// Adding layout meta box for Post
	add_meta_box( 'page-layout', esc_html__( 'Select Layout', 'awesome-one-page' ), 'awesome_one_page_layout_call', 'post', 'normal', 'high' );
}

global $awesome_one_page_spacific_layout;
$awesome_one_page_spacific_layout = array(
	'default-layout' 	=> array(
		'id'			=> 'awesome_one_page_spacific_layout',
		'value' 		=> 'default_layout',
		'label' 		=> esc_html__( 'Default', 'awesome-one-page' ),
		'thumbnail' 	=> get_template_directory_uri() . '/inc/assets/images/default-sidebar.png'
	),
	'right-sidebar' 	=> array(
		'id'			=> 'awesome_one_page_spacific_layout',
		'value' 		=> 'right_sidebar',
		'label' 		=> esc_html__( 'Right Sidebar', 'awesome-one-page' ),
		'thumbnail' 	=> get_template_directory_uri() . '/inc/assets/images/right-sidebar.png'
	),
	'left-sidebar' 		=> array(
		'id'			=> 'awesome_one_page_spacific_layout',
		'value' 		=> 'left_sidebar',
		'label' 		=> esc_html__( 'Left Sidebar', 'awesome-one-page' ),
		'thumbnail' 	=> get_template_directory_uri() . '/inc/assets/images/left-sidebar.png'
	),
	'no-sidebar-full-width' => array(
		'id'			=> 'awesome_one_page_spacific_layout',
		'value' 		=> 'no_sidebar_full_width',
		'label' 		=> esc_html__( 'No Sidebar Full Width', 'awesome-one-page' ),
		'thumbnail' 	=> get_template_directory_uri() . '/inc/assets/images/no-sidebar-full-width-layout.png'
	),
	'no-sidebar-content-centered' => array(
		'id'			=> 'awesome_one_page_spacific_layout',
		'value' 		=> 'no_sidebar_content_centered',
		'label' 		=> esc_html__( 'No Sidebar Content Centered', 'awesome-one-page' ),
		'thumbnail' 	=> get_template_directory_uri() . '/inc/assets/images/no-sidebar-content-centered-layout.png'
	)
);

function awesome_one_page_layout_call() {
	global $awesome_one_page_spacific_layout;
	awesome_one_page_layout_meta_form( $awesome_one_page_spacific_layout );
}

/**
 * Displays metabox to for select layout option
 */
function awesome_one_page_layout_meta_form( $awesome_one_page_layout_metabox_field ) {
	global $post;

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'awesome_one_page_layout_metabox_nonce' ); ?>

	<table class="form-table">
		<tr>
			<td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'awesome-one-page' ); ?></em></td>
		</tr>
		<tr>
			<td>
			<?php 
				$img_count = 0 ;
				foreach ( $awesome_one_page_layout_metabox_field as $field ) {
					$img_count++;
					$layout_meta = get_post_meta( $post->ID, $field['id'], true );
					$default_class ='';
					switch( $field['id'] ) {

						// Layout
						case 'awesome_one_page_spacific_layout':
							if( empty( $layout_meta ) && $img_count == '1' ) { 
								$layout_meta = 'default_layout'; 
								$default_class = 'aop-radio-image-selected'; 
							}
							if ( $field['value'] == $layout_meta ) { $default_class = 'aop-radio-image-selected'; }?>

							<div class="aop-radio-image-wrapper" style="float:left; margin-right:30px;">
				                <label class="aop-description">
					                <img class="aop-radio-image <?php echo esc_attr( $default_class ); ?>" src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="<?php echo esc_attr( $field['label'] );?>" title="<?php echo esc_attr( $field['label'] );?>" />
					                <input style = "display:none" type="radio" name="<?php echo esc_attr($field['id']); ?>" value="<?php echo esc_attr($field['value']); ?>" <?php checked( $field['value'], $layout_meta ); ?>/>
				                </label>
			                </div>
							<?php

						break;
					}
				} 
			?>
			</td>
		</tr>
	</table>
<?php 
}

add_action('save_post', 'awesome_one_page_save_layout_metabox');
/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function awesome_one_page_save_layout_metabox( $post_id ) {
	global $awesome_one_page_spacific_layout, $post;

	// Verify the nonce before proceeding.
   if ( !isset( $_POST[ 'awesome_one_page_layout_metabox_nonce' ] ) || !wp_verify_nonce( $_POST[ 'awesome_one_page_layout_metabox_nonce' ], basename( __FILE__ ) ) )
		return;

	// Stop WP from clearing custom fields on autosave
   if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)
		return;

	if ('page' == $_POST['post_type']) {
		if (!current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	}
	elseif (!current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	foreach ( $awesome_one_page_spacific_layout as $field ) {
		//Execute this saving function
		$old = get_post_meta( $post_id, $field['id'], true);
		$new = sanitize_key( $_POST[$field['id']] );
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	} // end foreach
}

/****************************************************************************************/

add_action( 'add_meta_boxes', 'awesome_one_page_add_page_template_custom_metabox' );
/**
 * Add Meta Boxes.
 */
function awesome_one_page_add_page_template_custom_metabox() {
	//Adding fontawesome icons
	add_meta_box( 'services-icon', esc_html__( 'Icon Class', 'awesome-one-page' ), 'awesome_one_page_service_template_icon_call', 'page', 'side' );
	//Adding Team designation meta box
	add_meta_box( 'team-designation', esc_html__( 'Designation', 'awesome-one-page' ), 'awesome_one_page_team_template_designation_call', 'page', 'side' );
	//Adding Team Social Links meta box
	add_meta_box( 'team-social', esc_html__( 'Social Links', 'awesome-one-page' ), 'awesome_one_page_team_template_social_call', 'page', 'side' );
	//Adding Testimonial designation meta box
	add_meta_box( 'testimonial-designation', esc_html__( 'Designation', 'awesome-one-page' ), 'awesome_one_page_testimonial_template_designation_call', 'page', 'side' );
}

global $awesome_one_page_service_template_icon, $awesome_one_page_team_template_designation, $awesome_one_page_team_template_social, $awesome_one_page_tesimonial_template_designation;

$awesome_one_page_service_template_icon = array(
	array(
		'id'			=> 'awesome_one_page_service_icon'
	)
);

$awesome_one_page_team_template_designation = array(
	array(
		'id'			=> 'awesome_one_page_team_designation'
	)
);

$awesome_one_page_team_template_social = array(
	array(
		'id'			=> 'awesome_one_page_team_social_1' 
	),
	array(
		'id'			=> 'awesome_one_page_team_social_2'
	),
	array(
		'id'			=> 'awesome_one_page_team_social_3'
	)
);

$awesome_one_page_tesimonial_template_designation = array(
	array(
		'id'			=> 'awesome_one_page_testimonial_designation'
	)
);

function awesome_one_page_service_template_icon_call() {
	global $awesome_one_page_service_template_icon;
	aop_metabox_form( $awesome_one_page_service_template_icon );
}

function awesome_one_page_team_template_designation_call() {
	global $awesome_one_page_team_template_designation;
	aop_metabox_form( $awesome_one_page_team_template_designation );
}

function awesome_one_page_team_template_social_call() {
	global $awesome_one_page_team_template_social;
	aop_metabox_form( $awesome_one_page_team_template_social );
}

function awesome_one_page_testimonial_template_designation_call() {
	global $awesome_one_page_tesimonial_template_designation;
	aop_metabox_form( $awesome_one_page_tesimonial_template_designation );
}

/**
 * Displays metabox to for select layout option
 */
function aop_metabox_form( $aop_metabox_fields ) {
	global $post;

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'awesome_one_page_template_nonce' );

	foreach ( $aop_metabox_fields as $field ) {
		$layout_meta = get_post_meta( $post->ID, $field['id'], true );
		switch( $field['id'] ) {

			// Font icon
			case 'awesome_one_page_service_icon': ?>
			<div class="aop-metabox-input-wrap">
	        	<label><?php esc_html_e( 'If featured image is not used than display the icon in Services.', 'awesome-one-page' ); ?></label>
	          	<input type="text" name="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $layout_meta ); ?>"></br>
	          	<?php 
				$url = 'http://fontawesome.io/icons/';
				$link = sprintf( __( '<a href="%s" target="_blank">Refer here</a> for icon class. For example: <strong>fa-mobile</strong>', 'awesome-one-page' ), esc_url( $url ) );
				echo '<span class="aop-metabox-info">'.$link.'</span>'; ?>
	        </div><!-- .aop-metabox-input-wrap -->
			<?php break;

			// Team Designation
			case 'awesome_one_page_team_designation': ?>
			<div class="aop-metabox-input-wrap">
	        	<label><?php esc_html_e( 'Show designation in Team Widget.', 'awesome-one-page' ); ?></label>
	          	<input type="text" name="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $layout_meta ); ?>"></br>
	        </div><!-- .aop-metabox-input-wrap -->
			<?php break;

			// Team Social Links One
			case 'awesome_one_page_team_social_1': ?>
			<div class="aop-metabox-input-wrap">
	        	<label><?php esc_html_e( 'Social Link One:', 'awesome-one-page' ); ?></label>
	          	<input type="text" name="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $layout_meta ); ?>"></br>
	        </div><!-- .aop-metabox-input-wrap -->
			<?php break;

			// Team Social Links Two
			case 'awesome_one_page_team_social_2': ?>
			<div class="aop-metabox-input-wrap">
	        	<label><?php esc_html_e( 'Social Link Two:', 'awesome-one-page' ); ?></label>
	          	<input type="text" name="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $layout_meta ); ?>"></br>
	        </div><!-- .aop-metabox-input-wrap -->
			<?php break;

			// Team Social Links Three
			case 'awesome_one_page_team_social_3': ?>
			<div class="aop-metabox-input-wrap">
	        	<label><?php esc_html_e( 'Social Link Three:', 'awesome-one-page' ); ?></label>
	          	<input type="text" name="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $layout_meta ); ?>"></br>
	        </div><!-- .aop-metabox-input-wrap -->
			<?php break;

			// Testimonial Designation
			case 'awesome_one_page_testimonial_designation': ?>
			<div class="aop-metabox-input-wrap">
	        	<label><?php esc_html_e( 'Testimonial Designation', 'awesome-one-page' ); ?></label>
	          	<input type="text" name="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $layout_meta ); ?>"></br>
	        </div><!-- .aop-metabox-input-wrap -->
			<?php break;
		}
	}
}

add_action('save_post', 'aop_save_custom_meta');
/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function aop_save_custom_meta( $post_id ) {
	global $awesome_one_page_service_template_icon, $awesome_one_page_team_template_designation, $awesome_one_page_team_template_social, $awesome_one_page_tesimonial_template_designation, $post;

	// Verify the nonce before proceeding.
   if ( !isset( $_POST[ 'awesome_one_page_template_nonce' ] ) || !wp_verify_nonce( $_POST[ 'awesome_one_page_template_nonce' ], basename( __FILE__ ) ) )
      return;

	// Stop WP from clearing custom fields on autosave
   if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)
      return;

	if ('page' == $_POST['post_type']) {
      if (!current_user_can( 'edit_page', $post_id ) )
         return $post_id;
   }
   elseif (!current_user_can( 'edit_post', $post_id ) ) {
      return $post_id;
   }

	if ('page' == $_POST['post_type']) {
   	// loop through fields and save the data- Service widget
	   foreach ( $awesome_one_page_service_template_icon as $field ) {
	    	$old = get_post_meta( $post_id, $field['id'], true );
	      $new = $_POST[$field['id']];
	      if ($new && $new != $old) {
	     		update_post_meta( $post_id,$field['id'],$new );
	      } elseif ('' == $new && $old) {
	     	delete_post_meta($post_id, $field['id'], $old);
	    	}
	   } // end foreach

	   // loop through fields and save the data- Team widget
	   foreach ( $awesome_one_page_team_template_designation as $field ) {
	    	$old = get_post_meta( $post_id, $field['id'], true );
	      $new = $_POST[$field['id']];
	      if ($new && $new != $old) {
	     		update_post_meta( $post_id,$field['id'],$new );
	      } elseif ('' == $new && $old) {
	     	delete_post_meta($post_id, $field['id'], $old);
	    	}
	   } // end foreach

	   // loop through fields and save the data- Team widget
	   foreach ( $awesome_one_page_team_template_social as $field ) {
	    	$old = get_post_meta( $post_id, $field['id'], true );
	      $new = $_POST[$field['id']];
	      if ($new && $new != $old) {
	     		update_post_meta( $post_id,$field['id'],$new );
	      } elseif ('' == $new && $old) {
	     	delete_post_meta($post_id, $field['id'], $old);
	    	}
	   } // end foreach

	   // loop through fields and save the data- Testimonial widget
	   foreach ( $awesome_one_page_tesimonial_template_designation as $field ) {
	    	$old = get_post_meta( $post_id, $field['id'], true );
	      $new = $_POST[$field['id']];
	      if ($new && $new != $old) {
	     		update_post_meta( $post_id,$field['id'],$new );
	      } elseif ('' == $new && $old) {
	     	delete_post_meta($post_id, $field['id'], $old);
	    	}
	   } // end foreach
	}
}
