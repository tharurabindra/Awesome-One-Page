<?php
/**
 * Awesome One Page Theme Customizer.
 *
 * @package Awesome_One_Page
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function awesome_one_page_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    // Remove
    $wp_customize->remove_section( 'header_image' );
    //$wp_customize->remove_control( 'header_textcolor' );

    //Custom Controls
    if ( class_exists( 'WP_Customize_Control' ) ):

        // Custom Checkbox Control Class
        class WP_Customize_Checkbox_Control extends WP_Customize_Control {
            public $type = 'checkbox';

            public function render_content() {
                ?>

                <label>
                    <span class="dt-checkbox-label"><?php echo esc_html( $this->label ); ?></span>

                    <span class="dt-on-off-switch">
                        <input class="dt-on-off-switch-checkbox"  type="checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> />
                        <span class="dt-on-off-switch-label"></span>
                    </span>

                    <?php if ( ! empty( $this->description ) ) : ?>
                        <span class="description customize-control-description"><?php echo $this->description; ?></span>
                    <?php endif; ?>
                </label>
                <?php
            }
        }

        // Custom Font Size Control Class
        class WP_Customize_Font_Control extends WP_Customize_Control {

            public function render_content() {
                ?>

                <label class="dt-customizer-font">
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <input type="range" min="0" max="100" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
                    <input type="number" min="0" max="100" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
                </label>

                <?php
            }
        }

        // Date Picker
        class Date_Picker_Custom_Control extends WP_Customize_Control {

            public function render_content() {
                ?>
                <label>
                    <span class="customize-date-picker-control"><?php echo esc_html( $this->label ); ?></span>
                    <input type="date" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>">
                </label>
                <?php
            }

        }

        // Demo Import Button
        class WP_Customize_Demo_Import_Control extends WP_Customize_Control {

            public function render_content() {

                ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <input type="submit" id="<?php echo $this->id; ?>" name="<?php echo $this->id; ?>" value="<?php _e( 'Import Demo Content', 'awesome-one-page' ); ?>" class="dt-demo-data-import" />
                </label>
                <?php
            }
        }

        // Blank
        class WP_Customize_Blank_Control extends WP_Customize_Control {

            public function render_content() {

                ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <span class="dt-customize-description"><i><?php echo esc_html( $this->description ); ?></i></span>
                </label>
                <?php
            }
        }

        // Help & Support
        class WP_Customize_Help_support_Control extends WP_Customize_Control {

            public function render_content() {

                ?>
                <div class="dt-customizer-supports">
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <ul>
                        <li><a href="#"><i class="dashicons dashicons-welcome-learn-more"></i> <?php _e( 'Documentation', 'awesome-one-page' ); ?></a></li>
                        <li><a href="#"><i class="dashicons dashicons-groups"></i> <?php _e( 'Support Forum', 'awesome-one-page' ); ?></a></li>
                        <li><a href="#"><i class="dashicons dashicons-tickets-alt"></i> <?php _e( 'Create Support Ticket', 'awesome-one-page' ); ?></a></li>
                        <li><?php _e( 'If you like the GoodNews theme, we would love to receive a', 'awesome-one-page' ); ?> <a href="#"><span class="dt-customizer-stars">★★★★★</span></a> <?php _e( 'rating.', 'awesome-one-page' ); ?> <a href="#"><?php _e( 'Click Here', 'awesome-one-page' ); ?></a><?php _e( 'to rate this theme. Thanks', 'awesome-one-page' ); ?> <i class="dashicons dashicons-smiley"></i></li>
                    </ul>
                </div>
                <?php
            }
        }

        // Layout Picker
        class good_news_pro_layout_picker_custom_control extends WP_Customize_Control {

            /**
             * Render the content on the theme customizer page
             */
            public function render_content() {

                if ( empty( $this->choices ) )
                    return;

                $name = $this->id;

                ?>
                <h3 class="awesome-one-page-layout-title"><?php echo esc_html( $this->label ); ?></h3>

                <?php foreach ( $this->choices as $value => $label ) : ?>

                    <input type="radio" id="<?php echo esc_attr( $value ); ?>" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />

                    <label for="<?php echo esc_attr( $value ); ?>">
                        <span class="awesome-one-page-radio-img">
                            <span class="awesome-one-page-checked"></span>
                        </span>

                        <?php echo esc_html( $label ); ?>
                    </label>

                    <?php

                endforeach;
            }
        }

        // Theme Color
        class good_news_pro_theme_color_picker extends WP_Customize_Control {

            /**
             * Render the content on the theme customizer page
             */
            public function render_content() {

                if ( empty( $this->choices ) )
                    return;

                $name = $this->id;

                ?>

                <h3 class="awesome-one-page-layout-title"><?php echo esc_html( $this->label ); ?></h3>

                <?php foreach ( $this->choices as $value => $label ) : ?>

                    <input type="radio" id="<?php echo esc_attr( $value ); ?>" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />

                    <label for="<?php echo esc_attr( $value ); ?>">
                        <?php echo esc_html( $label ); ?>

                        <span class="awesome-one-page-radio-color">
                            <span class="awesome-one-page-color-checked"></span>
                        </span>
                    </label>

                    <?php

                endforeach;
            }
        }

    endif;

    // General Settings
    $wp_customize->add_panel( 'awesome_one_page_general', array(
        'priority'              => 2,
        'title'                 => esc_html__( 'General', 'awesome-one-page' )
    ) );

    // Pre Loader
    $wp_customize->add_section( 'awesome_one_page_basic', array(
        'priority'              => 1,
        'title'                 => esc_html__( 'Basic', 'awesome-one-page' ),
        'panel'                 => 'awesome_one_page_general'
    ) );

    // Activate Pre Loader
    $wp_customize->add_setting( 'awesome_one_page_pre_loader_activate', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_pre_loader_activate', array(
        'label'                 => esc_html__( 'Activate Pre Loader', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_basic',
        'settings'              => 'awesome_one_page_pre_loader_activate'
    ) ) );

    // Activate Smooth Scrolling
    $wp_customize->add_setting( 'awesome_one_page_smooth_scroll_activate', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_smooth_scroll_activate', array(
        'label'                 => esc_html__( 'Activate Smooth Scroll', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_basic',
        'settings'              => 'awesome_one_page_smooth_scroll_activate'
    ) ) );

    // Activate Breadcrumbs
    $wp_customize->add_setting( 'awesome_one_page_breadcrumbs_activate', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_breadcrumbs_activate', array(
        'label'                 => esc_html__( 'Activate Breadcrumbs', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_basic',
        'settings'              => 'awesome_one_page_breadcrumbs_activate'
    ) ) );

    // Breadcrumbs Delimiter
    $wp_customize->add_setting( 'awesome_one_page_breadcrumbs_sep', array(
        'default'               => '/',
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_nohtml'
    ) );

    $wp_customize->add_control( 'awesome_one_page_breadcrumbs_sep', array(
        'type'                  => 'text',
        'label'                 => esc_html__( 'Breadcrumbs Delimiter', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_basic',
        'settings'              => 'awesome_one_page_breadcrumbs_sep'
    ) );

    //  Website Layout sections
    $wp_customize->add_setting( 'awesome_one_page_website_layout', array(
        'default'            => 'wide',
        'capability'         => 'edit_theme_options',
        'sanitize_callback'  => 'awesome_one_page_sanitize_website_layout'
    ) );

    $wp_customize->add_control( 'awesome_one_page_website_layout', array(
        'type'               => 'radio',
        'label'              => esc_html__( 'Website Layout', 'awesome-one-page'),
        'description'        => esc_html__( 'Choose your site layout. The change is reflected in whole site.', 'awesome-one-page' ),
        'section'            => 'awesome_one_page_basic',
        'choices'            => array(
            'box'    => esc_html__('Boxed layout', 'awesome-one-page'),
            'wide'   => esc_html__('Wide layout', 'awesome-one-page')
            ),
        'settings'           => 'awesome_one_page_website_layout'
    ) );

    // Background Image
    $wp_customize->add_section( 'background_image', array(
        'priority'              => 5,
        'title'                 => esc_html__( 'Background Image', 'awesome-one-page' ),
        'panel'                 => 'awesome_one_page_general'
    ) );

/*--------------------------------------------------------------------------------------------------*/

    // Header Panel
    $wp_customize->add_panel( 'awesome_one_page_header', array(
        'priority'              => 3,
        'title'                 => esc_html__( 'Header', 'awesome-one-page' )
    ) );

    // Site Title & Tag-line
    $wp_customize->add_section( 'title_tagline', array(
        'priority'              => 3,
        'title'                 => esc_html__( 'Site Title & Tagline', 'awesome-one-page' ),
        'panel'                 => 'awesome_one_page_header'
    ) );

    // Sticky Menu
    $wp_customize->add_section( 'awesome_one_page_menu_style', array(
        'priority'              => 4,
        'title'                 => esc_html__( 'Menu Style', 'awesome-one-page'),
        'panel'                 => 'awesome_one_page_header'
    ) );

    // Activate Sticky Menu
    $wp_customize->add_setting( 'awesome_one_page_sticky_menu_activate', array(
        'default'               => '',
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_sticky_menu_activate', array(
        'label'                 => esc_html__( 'Activate Sticky Menu', 'awesome-one-page'),
        'section'               => 'awesome_one_page_menu_style',
        'settings'              => 'awesome_one_page_sticky_menu_activate'
    ) ) );

    // Menu Style
    $wp_customize->add_setting( 'awesome_one_page_menu_display_style', array(
        'default'               => 'inline',
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_sanitize_menu_style'
    ) );

    $wp_customize->add_control( 'awesome_one_page_menu_display_style', array(
        'type'      => 'radio',
        'label'                 => esc_html__( 'Menu style', 'awesome-one-page'),
        'section'               => 'awesome_one_page_menu_style',
        'settings'              => 'awesome_one_page_menu_display_style',
        'choices'   => array(
                'inline'     => esc_html__('Inline', 'awesome-one-page'),
                'centered'   => esc_html__('Centered', 'awesome-one-page'),
            ),
    ) );

    // Header Image
    $wp_customize->add_section( 'header_image', array(
        'priority'              => 4,
        'title'                 => esc_html__( 'Header Image', 'awesome-one-page' ),
        'panel'                 => 'awesome_one_page_header'
    ) );


/*--------------------------------------------------------------------------------------------------*/

    // Colors
    $wp_customize->add_panel( 'good_news_pro_colors', array(
        'priority'              => 101,
        'title'                 => esc_html__( 'Colors', 'awesome-one-page' )
    ) );

    // Background Colors
    $wp_customize->add_section( 'colors', array(
        'priority'              => 1,
        'title'                 => esc_html__( 'Background Color', 'awesome-one-page' ),
        'panel'                 => 'good_news_pro_colors'
    ) );

    // Theme Color
    $wp_customize->add_section( 'good_news_pro_custom_theme_color_sec', array(
        'priority'              => 1,
        'title'                 => esc_html__( 'Theme Color', 'awesome-one-page' ),
        'panel'                 => 'good_news_pro_colors'
    ) );

    // Custom Primary Color
    $wp_customize->add_setting( 'good_news_pro_custom_primary_color', array(
        'default'               => null,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'sanitize_hex_color'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'good_news_pro_custom_primary_color', array(
        'label'                 => esc_html__( 'Primary Color', 'awesome-one-page' ),
        'section'               => 'good_news_pro_custom_theme_color_sec',
        'settings'              => 'good_news_pro_custom_primary_color',
    ) ) );

    // Custom Secondary Color
    $wp_customize->add_setting( 'good_news_pro_custom_secondary_color', array(
        'default'               => null,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'sanitize_hex_color'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'good_news_pro_custom_secondary_color', array(
        'label'                 => esc_html__( 'Secondary Color', 'awesome-one-page' ),
        'section'               => 'good_news_pro_custom_theme_color_sec',
        'settings'              => 'good_news_pro_custom_secondary_color',
    ) ) );


    // Posts Settings
    $wp_customize->add_panel( 'good_news_pro_post_settings', array(
        'priority'              => 112,
        'title'                 => __( 'Post Settings', 'awesome-one-page' ),
    ) );

    // Post Settings
    $wp_customize->add_section( 'good_news_pro_post_settings_sec', array(
        'title'                 => __( 'General Settings', 'awesome-one-page' ),
        'panel'                 => 'good_news_pro_post_settings',
    ) );

    // Post Author Box
    $wp_customize->add_setting( 'good_news_pro_post_author_box', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_post_author_box', array(
        'label'                 => __( 'Post Author Box', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_settings_sec',
        'settings'              => 'good_news_pro_post_author_box',
    ) ) );

    // Post Nex/Prev article
    $wp_customize->add_setting( 'good_news_pro_post_nex_prev_article', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_post_nex_prev_article', array(
        'label'                 => __( 'Next/Previous Article', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_settings_sec',
        'settings'              => 'good_news_pro_post_nex_prev_article',
    ) ) );

    // Featured Image
    $wp_customize->add_setting( 'good_news_pro_post_featured_image', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_post_featured_image', array(
        'label'                 => __( 'First Image as Featured Image', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_settings_sec',
        'settings'              => 'good_news_pro_post_featured_image',
    ) ) );

    // Default Post Image
    $wp_customize->add_setting( 'good_news_pro_post_default_post_image', array(
        'default'               => __( '', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'esc_url_raw'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'good_news_pro_post_default_post_image', array(
        'label'                 => __( 'Default Image', 'awesome-one-page' ),
        'description'           => __( 'Select the image(3:2 ratio) to be used for no image found.', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_settings_sec',
        'settings'              => 'good_news_pro_post_default_post_image',
    ) ) );

    // Post Template Layout
    $wp_customize->add_section( 'good_news_pro_post_template', array(
        'title'                 => __( 'Post Templates', 'awesome-one-page' ),
        'panel'                 => 'good_news_pro_post_settings',
    ) );

    $wp_customize->add_setting( 'good_news_pro_post_template_layout', array(
        'default'               => __( 'post-template1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_post_template_layout'
    ) );

    $wp_customize->add_control( new good_news_pro_layout_picker_custom_control( $wp_customize, 'good_news_pro_post_template_layout', array(
        'label'                 => __( 'Select Post Layout Template', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_template',
        'settings'              => 'good_news_pro_post_template_layout',
        'type'                  => 'radio',
        'choices'               => array(
            'post-template1'            => __( 'Post Template 1', 'awesome-one-page' ),
            'post-template2'            => __( 'Post Template 2', 'awesome-one-page' ),
            'post-template3'            => __( 'Post Template 3', 'awesome-one-page' ),
            'post-template4'            => __( 'Post Template 4', 'awesome-one-page' ),
            'post-template5'            => __( 'Post Template 5', 'awesome-one-page' ),
            'post-template6'            => __( 'Post Template 6', 'awesome-one-page' ),
            'post-template7'            => __( 'Post Template 7', 'awesome-one-page' ),
            'post-template8'            => __( 'Post Template 8', 'awesome-one-page' ),
            'post-template9'            => __( 'Post Template 9', 'awesome-one-page' ),
            'post-template10'           => __( 'Post Template 10', 'awesome-one-page' )
        )
    ) ) );

    // Posts meta Settings
    $wp_customize->add_section( 'good_news_pro_post_meta_settings', array(
        'title'                 => __( 'Post Meta', 'awesome-one-page' ),
        'panel'                 => 'good_news_pro_post_settings',
    ) );

    // Post Author
    $wp_customize->add_setting( 'good_news_pro_post_meta_author', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_post_meta_author', array(
        'label'                 => __( 'Post Author', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_meta_settings',
        'settings'              => 'good_news_pro_post_meta_author',
    ) ) );

    // Post Date
    $wp_customize->add_setting( 'good_news_pro_post_meta_date', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_post_meta_date', array(
        'label'                 => __( 'Post Date', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_meta_settings',
        'settings'              => 'good_news_pro_post_meta_date',
    ) ) );

    // Post Categories
    $wp_customize->add_setting( 'good_news_pro_post_meta_categories', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_post_meta_categories', array(
        'label'                 => __( 'Post Categories', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_meta_settings',
        'settings'              => 'good_news_pro_post_meta_categories',
    ) ) );

    // Post Tags
    $wp_customize->add_setting( 'good_news_pro_post_meta_tags', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_post_meta_tags', array(
        'label'                 => __( 'Post Tags', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_meta_settings',
        'settings'              => 'good_news_pro_post_meta_tags',
    ) ) );

    // Post Comments
    $wp_customize->add_setting( 'good_news_pro_post_meta_comments', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_post_meta_comments', array(
        'label'                 => __( 'Post Comments', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_meta_settings',
        'settings'              => 'good_news_pro_post_meta_comments',
    ) ) );

    // Post Views
    $wp_customize->add_setting( 'good_news_pro_post_meta_views', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_post_meta_views', array(
        'label'                 => __( 'Post Views', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_meta_settings',
        'settings'              => 'good_news_pro_post_meta_views',
    ) ) );

    // Posts Social Share
    $wp_customize->add_section( 'good_news_pro_post_social_share_settings', array(
        'title'                 => __( 'Social Share', 'awesome-one-page' ),
        'panel'                 => 'good_news_pro_post_settings',
    ) );

    // Activate Social Share
    $wp_customize->add_setting( 'good_news_pro_post_social_share_activate', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_post_social_share_activate', array(
        'label'                 => __( 'Activate Social Share', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_social_share_settings',
        'settings'              => 'good_news_pro_post_social_share_activate',
    ) ) );

    // Facebook
    $wp_customize->add_setting( 'good_news_pro_post_social_share_facebook', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_post_social_share_facebook', array(
        'label'                 => __( 'Facebook', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_social_share_settings',
        'settings'              => 'good_news_pro_post_social_share_facebook',
    ) ) );

    // Twitter
    $wp_customize->add_setting( 'good_news_pro_post_social_share_twitter', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_post_social_share_twitter', array(
        'label'                 => __( 'Twitter', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_social_share_settings',
        'settings'              => 'good_news_pro_post_social_share_twitter',
    ) ) );

    // Google+
    $wp_customize->add_setting( 'good_news_pro_post_social_share_google_plus', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_post_social_share_google_plus', array(
        'label'                 => __( 'Google+', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_social_share_settings',
        'settings'              => 'good_news_pro_post_social_share_google_plus',
    ) ) );

    // Linkedin
    $wp_customize->add_setting( 'good_news_pro_post_social_share_linkedin', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_post_social_share_linkedin', array(
        'label'                 => __( 'Linkedin', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_social_share_settings',
        'settings'              => 'good_news_pro_post_social_share_linkedin',
    ) ) );

    // Pinterest
    $wp_customize->add_setting( 'good_news_pro_post_social_share_pinterest', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_post_social_share_pinterest', array(
        'label'                 => __( 'Pinterest', 'awesome-one-page' ),
        'section'               => 'good_news_pro_post_social_share_settings',
        'settings'              => 'good_news_pro_post_social_share_pinterest',
    ) ) );

    // Social Share Type
    $wp_customize->add_setting( 'good_news_pro_post_social_share_type', array(
        'default'               => __( 'social-share-inside-post', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_select'
    ) );

    $wp_customize->add_control( 'good_news_pro_post_social_share_type', array(
        'label'                 => __( 'Social Share Type', 'awesome-one-page' ),
        'type'                  => 'select',
        'choices'               => array(
            'social-share-floating'         => 'Floating',
            'social-share-inside-article'   => 'Inside Article',
        ),
        'section'               => 'good_news_pro_post_social_share_settings',
        'settings'              => 'good_news_pro_post_social_share_type',
    ) );

    // Social Share Positions (Inside Article)
    $wp_customize->add_setting( 'good_news_pro_post_social_share_inside_article_position', array(
        'default'               => __( 'after-content', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_select'
    ) );

    $wp_customize->add_control( 'good_news_pro_post_social_share_inside_article_position', array(
        'label'                 => __( 'Social Icons Position', 'awesome-one-page' ),
        'description'           => __( 'Apply only for Social Share Type: Inside Article', 'awesome-one-page' ),
        'type'                  => 'select',
        'choices'               => array(
            'after-title'               => 'After Title',
            'after-content'             => 'After Content',
        ),
        'section'               => 'good_news_pro_post_social_share_settings',
        'settings'              => 'good_news_pro_post_social_share_inside_article_position',
    ) );

    // Social Share Positions (Floating)
    $wp_customize->add_setting( 'good_news_pro_post_social_share_floating_position', array(
        'default'               => __( 'right-bottom', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_select'
    ) );

    $wp_customize->add_control( 'good_news_pro_post_social_share_floating_position', array(
        'label'                 => __( 'Social Icons Position', 'awesome-one-page' ),
        'description'           => __( 'Apply only for Social Share Type: Floating', 'awesome-one-page' ),
        'type'                  => 'select',
        'choices'               => array(
            'left-top'              => 'Left Top',
            'left-middle'           => 'Left Middle',
            'left-bottom'           => 'Left Bottom',
            'right-top'             => 'Right Top',
            'right-middle'          => 'Right Middle',
            'right-bottom'          => 'Right Bottom',
        ),
        'section'               => 'good_news_pro_post_social_share_settings',
        'settings'              => 'good_news_pro_post_social_share_floating_position',
    ) );

    // Related Posts
    $wp_customize->add_section( 'good_news_pro_related_posts_settings', array(
        'title'                 => __( 'Related Posts', 'awesome-one-page' ),
        'panel'                 => 'good_news_pro_post_settings',
    ) );

    // Activate
    $wp_customize->add_setting( 'good_news_pro_related_posts_activate', array(
        'default'               => __( '1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_related_posts_activate', array(
        'label'                 => __( 'Activate Related Posts', 'awesome-one-page' ),
        'section'               => 'good_news_pro_related_posts_settings',
        'settings'              => 'good_news_pro_related_posts_activate',
    ) ) );

    // Related Posts Header Title
    $wp_customize->add_setting( 'good_news_pro_related_posts_title', array(
        'default'               => __( 'Related Posts', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_nohtml'
    ) );

    $wp_customize->add_control( 'good_news_pro_related_posts_title', array(
        'label'                 => __( 'Block Title', 'awesome-one-page' ),
        'section'               => 'good_news_pro_related_posts_settings',
        'settings'              => 'good_news_pro_related_posts_title',
        'type'                  => 'text',
    ) );

    // Related Posts Type
    $wp_customize->add_setting( 'good_news_pro_related_posts_type', array(
        'default'               => __( 'normal', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_select'
    ) );

    $wp_customize->add_control( 'good_news_pro_related_posts_type', array(
        'label'                 => __( 'Related Posts Type', 'awesome-one-page' ),
        'type'                  => 'select',
        'choices'               => array(
            'normal'                => 'Normal',
            'slider'                => 'Slider'
        ),
        'section'               => 'good_news_pro_related_posts_settings',
        'settings'              => 'good_news_pro_related_posts_type',
    ) );

    // Related posts query
    $wp_customize->add_setting( 'good_news_pro_related_posts_query', array(
        'default'               => __( 'same-category', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_select'
    ) );

    $wp_customize->add_control( 'good_news_pro_related_posts_query', array(
        'label'                 => __( 'Posts Query', 'awesome-one-page' ),
        'type'                  => 'select',
        'choices'               => array(
            'same-category'         => 'From same Category',
            'same-tag'              => 'From same Tag',
            'same-author'           => 'From same Author'
        ),
        'section'               => 'good_news_pro_related_posts_settings',
        'settings'              => 'good_news_pro_related_posts_query',
    ) );

    // Number of Posts
    $wp_customize->add_setting( 'good_news_pro_related_posts_number', array(
        'default'               => '3',
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_number_range'
    ) );

    $wp_customize->add_control( new WP_Customize_Font_Control(  $wp_customize, 'good_news_pro_post_meta_font_size', array(
        'label'                 => __( 'Number of Posts', 'awesome-one-page' ),
        'section'               => 'good_news_pro_related_posts_settings',
        'settings'              => 'good_news_pro_related_posts_number',
    ) ) );

    // Archive/Category Settings
    $wp_customize->add_panel( 'good_news_pro_archive_settings', array(
        'priority'              => 113,
        'title'                 => __( 'Archive/Category', 'awesome-one-page' ),
    ) );

    // General Settings
    $wp_customize->add_section( 'good_news_pro_archive_settings_sec', array(
        'title'                 => __( 'General Settings', 'awesome-one-page' ),
        'panel'                 => 'good_news_pro_archive_settings',
    ) );

    // Show Social Icons
    $wp_customize->add_setting( 'good_news_pro_archive_social_share', array(
        'default'               => __( '', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_archive_social_share', array(
        'label'                 => __( 'Show Social Icons', 'awesome-one-page' ),
        'section'               => 'good_news_pro_archive_settings_sec',
        'settings'              => 'good_news_pro_archive_social_share',
    ) ) );

    // Author
    $wp_customize->add_setting( 'good_news_pro_archive_post_author', array(
        'default'               => __( '', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_archive_post_author', array(
        'label'                 => __( 'Post Author', 'awesome-one-page' ),
        'section'               => 'good_news_pro_archive_settings_sec',
        'settings'              => 'good_news_pro_archive_post_author',
    ) ) );

    // Date
    $wp_customize->add_setting( 'good_news_pro_archive_post_date', array(
        'default'               => __( '', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_archive_post_date', array(
        'label'                 => __( 'Post Date', 'awesome-one-page' ),
        'section'               => 'good_news_pro_archive_settings_sec',
        'settings'              => 'good_news_pro_archive_post_date',
    ) ) );

    // Comments
    $wp_customize->add_setting( 'good_news_pro_archive_post_comments', array(
        'default'               => __( '', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_archive_post_comments', array(
        'label'                 => __( 'Post Comments', 'awesome-one-page' ),
        'section'               => 'good_news_pro_archive_settings_sec',
        'settings'              => 'good_news_pro_archive_post_comments',
    ) ) );

    // Views
    $wp_customize->add_setting( 'good_news_pro_archive_post_views', array(
        'default'               => __( '', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'good_news_pro_archive_post_views', array(
        'label'                 => __( 'Post Views', 'awesome-one-page' ),
        'section'               => 'good_news_pro_archive_settings_sec',
        'settings'              => 'good_news_pro_archive_post_views',
    ) ) );

    // Excerpt Length
    $wp_customize->add_setting( 'good_news_pro_archive_post_excerpt_length', array(
        'default'               => '60',
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_number_range'
    ) );

    $wp_customize->add_control( new WP_Customize_Font_Control(  $wp_customize, 'good_news_pro_archive_post_excerpt_length', array(
        'label'                 => __( 'Excerpt Length', 'awesome-one-page' ),
        'section'               => 'good_news_pro_archive_settings_sec',
        'settings'              => 'good_news_pro_archive_post_excerpt_length',
    ) ) );

    // Pagination Position
    $wp_customize->add_setting( 'good_news_pro_pagination_position', array(
        'default'               => __( 'left', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_select'
    ) );

    $wp_customize->add_control( 'good_news_pro_pagination_position', array(
        'label'                 => __( 'Pagination Position', 'awesome-one-page' ),
        'type'                  => 'select',
        'choices'               => array(
            'left'                  => 'Left',
            'center'                => 'Center',
            'right'                 => 'Right'
        ),
        'section'               => 'good_news_pro_archive_settings_sec',
        'settings'              => 'good_news_pro_pagination_position',
    ) );

    // Pagination Type
    $wp_customize->add_setting( 'good_news_pro_pagination_type', array(
        'default'               => __( 'light', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_select'
    ) );

    $wp_customize->add_control( 'good_news_pro_pagination_type', array(
        'label'                 => __( 'Pagination Type', 'awesome-one-page' ),
        'type'                  => 'select',
    'choices'                   => array(
            'light'                 => 'Light',
            'dark'                  => 'Dark',
        ),
        'section'               => 'good_news_pro_archive_settings_sec',
        'settings'              => 'good_news_pro_pagination_type',
    ) );

    // Pagination Style
    $wp_customize->add_setting( 'good_news_pro_pagination_style', array(
        'default'               => __( 'square', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_select'
    ) );

    $wp_customize->add_control( 'good_news_pro_pagination_style', array(
        'label'                 => __( 'Pagination Style', 'awesome-one-page' ),
        'type'                  => 'select',
        'choices'               => array(
            'square'                    => 'Square',
            'rounded'                   => 'Rounded Corner',
            'circle'                    => 'Circle'
        ),
        'section'               => 'good_news_pro_archive_settings_sec',
        'settings'              => 'good_news_pro_pagination_style',
    ) );

    // Archive Header Layout
    $wp_customize->add_section( 'good_news_pro_archive_header_layouts', array(
        'title'                 => __( 'Header Layout', 'awesome-one-page' ),
        'panel'                 => 'good_news_pro_archive_settings',
    ) );

    $wp_customize->add_setting( 'good_news_pro_archive_header_layout', array(
        'default'               => __( 'archive-header1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_archive_header_layout'
    ) );

    $wp_customize->add_control( new good_news_pro_layout_picker_custom_control( $wp_customize, 'good_news_pro_archive_header_layout', array(
        'label'                 => __( 'Select Archive Header Layout', 'awesome-one-page' ),
        'section'               => 'good_news_pro_archive_header_layouts',
        'settings'              => 'good_news_pro_archive_header_layout',
        'type'                  => 'radio',
        'choices'               => array(
            'archive-header1'           => __( 'Header Layout 1', 'awesome-one-page' ),
            'archive-header2'           => __( 'Header Layout 2', 'awesome-one-page' ),
            'archive-header3'           => __( 'Header Layout 3', 'awesome-one-page' ),
            'archive-header4'           => __( 'Header Layout 4', 'awesome-one-page' ),
            'archive-header5'           => __( 'Header Layout 5', 'awesome-one-page' )
        )
    ) ) );

    // Default Archive Layout
    $wp_customize->add_section( 'good_news_pro_default_archive_layouts', array(
        'title'                 => __( 'Default Archive Layout', 'awesome-one-page' ),
        'panel'                 => 'good_news_pro_archive_settings',
    ) );

    $wp_customize->add_setting( 'good_news_pro_default_archive_layout', array(
        'default'               => __( 'archive-layout1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_default_archive_layout'
    ) );

    $wp_customize->add_control( new good_news_pro_layout_picker_custom_control( $wp_customize, 'good_news_pro_default_archive_layout', array(
        'label'                 => __( 'Select Default Archive Layout', 'awesome-one-page' ),
        'section'               => 'good_news_pro_default_archive_layouts',
        'settings'              => 'good_news_pro_default_archive_layout',
        'type'                  => 'radio',
        'choices'               => array(
            'archive-layout1'           => __( 'Default Layout 1', 'awesome-one-page' ),
            'archive-layout2'           => __( 'Default Layout 2', 'awesome-one-page' ),
            'archive-layout3'           => __( 'Default Layout 3', 'awesome-one-page' ),
            'archive-layout4'           => __( 'Default Layout 4', 'awesome-one-page' ),
            'archive-layout5'           => __( 'Default Layout 5', 'awesome-one-page' ),
            'archive-layout6'           => __( 'Default Layout 6', 'awesome-one-page' ),
            'archive-layout7'           => __( 'Default Layout 7', 'awesome-one-page' ),
            'archive-layout8'           => __( 'Default Layout 8', 'awesome-one-page' ),
            'archive-layout9'           => __( 'Default Layout 9', 'awesome-one-page' ),
            'archive-layout10'          => __( 'Default Layout 10', 'awesome-one-page' )
        )
    ) ) );

    // Category Layout
    $wp_customize->add_section( 'good_news_pro_archive_category_layouts', array(
        'title'                 => __( 'Category Layout', 'awesome-one-page' ),
        'panel'                 => 'good_news_pro_archive_settings',
    ) );

    $wp_customize->add_setting( 'good_news_pro_archive_category_layout', array(
        'default'               => __( 'archive-category-layout1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_archive_category_layout'
    ) );

    $wp_customize->add_control( new good_news_pro_layout_picker_custom_control( $wp_customize, 'good_news_pro_archive_category_layout', array(
        'label'                 => __( 'Select Category Page Layout', 'awesome-one-page' ),
        'section'               => 'good_news_pro_archive_category_layouts',
        'settings'              => 'good_news_pro_archive_category_layout',
        'type'                  => 'radio',
        'choices'               => array(
            'archive-category-layout1'          => __( 'Category Page Layout 1', 'awesome-one-page' ),
            'archive-category-layout2'          => __( 'Category Page Layout 2', 'awesome-one-page' ),
            'archive-category-layout3'          => __( 'Category Page Layout 3', 'awesome-one-page' ),
            'archive-category-layout4'          => __( 'Category Page Layout 4', 'awesome-one-page' ),
            'archive-category-layout5'          => __( 'Category Page Layout 5', 'awesome-one-page' ),
            'archive-category-layout6'          => __( 'Category Page Layout 6', 'awesome-one-page' ),
            'archive-category-layout7'          => __( 'Category Page Layout 7', 'awesome-one-page' ),
            'archive-category-layout8'          => __( 'Category Page Layout 8', 'awesome-one-page' ),
            'archive-category-layout9'          => __( 'Category Page Layout 9', 'awesome-one-page' ),
            'archive-category-layout10'         => __( 'Category Page Layout 10', 'awesome-one-page' )
        )
    ) ) );

    // Default Tag Layout
    $wp_customize->add_section( 'good_news_pro_archive_tag_layouts', array(
        'title'                 => __( 'Tag Page Layout', 'awesome-one-page' ),
        'panel'                 => 'good_news_pro_archive_settings',
    ) );

    $wp_customize->add_setting( 'good_news_pro_archive_tag_layout', array(
        'default'               => __( 'archive-tag-layout1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_archive_tag_layout'
    ) );

    $wp_customize->add_control( new good_news_pro_layout_picker_custom_control( $wp_customize, 'good_news_pro_archive_tag_layout', array(
        'label'                 => __( 'Select Tag Page Layout', 'awesome-one-page' ),
        'section'               => 'good_news_pro_archive_tag_layouts',
        'settings'              => 'good_news_pro_archive_tag_layout',
        'type'                  => 'radio',
        'choices'               => array(
            'archive-tag-layout1'           => __( 'Tag Page Layout 1', 'awesome-one-page' ),
            'archive-tag-layout2'           => __( 'Tag Page Layout 2', 'awesome-one-page' ),
            'archive-tag-layout3'           => __( 'Tag Page Layout 3', 'awesome-one-page' ),
            'archive-tag-layout4'           => __( 'Tag Page Layout 4', 'awesome-one-page' ),
            'archive-tag-layout5'           => __( 'Tag Page Layout 5', 'awesome-one-page' ),
            'archive-tag-layout6'           => __( 'Tag Page Layout 6', 'awesome-one-page' ),
            'archive-tag-layout7'           => __( 'Tag Page Layout 7', 'awesome-one-page' ),
            'archive-tag-layout8'           => __( 'Tag Page Layout 8', 'awesome-one-page' ),
            'archive-tag-layout9'           => __( 'Tag Page Layout 9', 'awesome-one-page' ),
            'archive-tag-layout10'          => __( 'Tag Page Layout 10', 'awesome-one-page' )
        )
    ) ) );

    // Default Author Layout
    $wp_customize->add_section( 'good_news_pro_archive_author_layouts', array(
        'title'                 => __( 'Author Page Layout', 'awesome-one-page' ),
        'panel'                 => 'good_news_pro_archive_settings',
    ) );

    $wp_customize->add_setting( 'good_news_pro_archive_author_layout', array(
        'default'               => __( 'archive-author-layout1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_archive_author_layout'
    ) );

    $wp_customize->add_control( new good_news_pro_layout_picker_custom_control( $wp_customize, 'good_news_pro_archive_author_layout', array(
        'label'                 => __( 'Select Author Page Layout', 'awesome-one-page' ),
        'section'               => 'good_news_pro_archive_author_layouts',
        'settings'              => 'good_news_pro_archive_author_layout',
        'type'                  => 'radio',
        'choices'               => array(
            'archive-author-layout1'            => __( 'Author Page Layout 1', 'awesome-one-page' ),
            'archive-author-layout2'            => __( 'Author Page Layout 2', 'awesome-one-page' ),
            'archive-author-layout3'            => __( 'Author Page Layout 3', 'awesome-one-page' ),
            'archive-author-layout4'            => __( 'Author Page Layout 4', 'awesome-one-page' ),
            'archive-author-layout5'            => __( 'Author Page Layout 5', 'awesome-one-page' ),
            'archive-author-layout6'            => __( 'Author Page Layout 6', 'awesome-one-page' ),
            'archive-author-layout7'            => __( 'Author Page Layout 7', 'awesome-one-page' ),
            'archive-author-layout8'            => __( 'Author Page Layout 8', 'awesome-one-page' ),
            'archive-author-layout9'            => __( 'Author Page Layout 9', 'awesome-one-page' ),
            'archive-author-layout10'           => __( 'Author Page Layout 10', 'awesome-one-page' )
        )
    ) ) );

    // Default Search Layout
    $wp_customize->add_section( 'good_news_pro_archive_search_layouts', array(
        'title'                 => __( 'Search Page Layout', 'awesome-one-page' ),
        'panel'                 => 'good_news_pro_archive_settings',
    ) );

    $wp_customize->add_setting( 'good_news_pro_archive_search_layout', array(
        'default'               => __( 'archive-search-layout1', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_archive_search_layout'
    ) );

    $wp_customize->add_control( new good_news_pro_layout_picker_custom_control( $wp_customize, 'good_news_pro_archive_search_layout', array(
        'label'                 => __( 'Select Search Page Layout', 'awesome-one-page' ),
        'section'               => 'good_news_pro_archive_search_layouts',
        'settings'              => 'good_news_pro_archive_search_layout',
        'type'                  => 'radio',
        'choices'               => array(
            'archive-search-layout1'            => __( 'Search Page Layout 1', 'awesome-one-page' ),
            'archive-search-layout2'            => __( 'Search Page Layout 2', 'awesome-one-page' ),
            'archive-search-layout3'            => __( 'Search Page Layout 3', 'awesome-one-page' ),
            'archive-search-layout4'            => __( 'Search Page Layout 4', 'awesome-one-page' ),
            'archive-search-layout5'            => __( 'Search Page Layout 5', 'awesome-one-page' ),
            'archive-search-layout6'            => __( 'Search Page Layout 6', 'awesome-one-page' ),
            'archive-search-layout7'            => __( 'Search Page Layout 7', 'awesome-one-page' ),
            'archive-search-layout8'            => __( 'Search Page Layout 8', 'awesome-one-page' ),
            'archive-search-layout9'            => __( 'Search Page Layout 9', 'awesome-one-page' ),
            'archive-search-layout10'           => __( 'Search Page Layout 10', 'awesome-one-page' )
        )
    ) ) );

/*--------------------------------------------------------------------------------------------------*/
    // Footer
    $wp_customize->add_panel( 'awesome_one_page_footer_settings', array(
        'priority'              => 124,
        'title'                 => esc_html__( 'Footer', 'awesome-one-page' ),
    ) );

    // General Settings
    $wp_customize->add_section( 'awesome_one_page_footer_settings_sec', array(
        'title'                 => esc_html__( 'General Settings', 'awesome-one-page' ),
        'panel'                 => 'awesome_one_page_footer_settings',
    ) );

    // Go To Top Button
    $wp_customize->add_setting( 'awesome_one_page_footer_go_to_top', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_footer_go_to_top', array(
        'label'                 => esc_html__( 'Go To Top Button', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_footer_settings_sec',
        'settings'              => 'awesome_one_page_footer_go_to_top',
    ) ) );

    // Footer Widgets
    $wp_customize->add_section( 'awesome_one_page_footer_widgets_sec', array(
        'title'                 => esc_html__( 'Footer Widgets', 'awesome-one-page' ),
        'panel'                 => 'awesome_one_page_footer_settings',
    ) );

    $wp_customize->add_setting( 'awesome_one_page_footer_widgets_area', array(
        'default'            => 3,
        'capability'         => 'edit_theme_options',
        'sanitize_callback'  => 'awesome_one_page_fwidgets'
    ) );

    $wp_customize->add_control( 'awesome_one_page_footer_widgets_area', array(
            'label'    => esc_html__( 'Footer widget area', 'awesome-one-page' ),
            'description'    => esc_html__( 'Choose the number of widget areas in the footer, then go to Appearance &gt; Widgets and add your widgets.', 'awesome-one-page' ),
            'section'  => 'awesome_one_page_footer_widgets_sec',
            'type'     => 'radio',
            'choices'    => array(
                '1' => esc_html__('One', 'awesome-one-page'),
                '2' => esc_html__('Two', 'awesome-one-page'),
                '3' => esc_html__('Three', 'awesome-one-page'),
                '4' => esc_html__('Four', 'awesome-one-page')
            ),
        )
    );

    // Show Footer contact and logo area.
    $wp_customize->add_setting( 'awesome_one_page_footer_contact_area_activate', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_footer_contact_area_activate', array(
        'label'                 => esc_html__( 'Show Footer Widgets', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_footer_widgets_sec',
        'settings'              => 'awesome_one_page_footer_contact_area_activate',
    ) ) );


    // Footer Bar
    $wp_customize->add_section( 'good_news_pro_footer_bar', array(
        'title'                 => __( 'Footer Bar', 'awesome-one-page' ),
        'panel'                 => 'awesome_one_page_footer_settings',
    ) );

    // Footer Copyright
    $wp_customize->add_setting( 'good_news_pro_footer_bar_copyright', array(
        'default'               => __( '© Copyright %year%, All Rights Reserved', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_html'
    ) );

    $wp_customize->add_control( 'good_news_pro_footer_bar_copyright', array(
        'label'                 => __( 'Copyrights', 'awesome-one-page' ),
        'section'               => 'good_news_pro_footer_bar',
        'settings'              => 'good_news_pro_footer_bar_copyright',
        'type'                  => 'textarea',
    ) );

    // Footer Developer
    $wp_customize->add_setting( 'good_news_pro_footer_bar_developer', array(
        'default'               => __( 'Designed by <a href="http://daisythemes.com/">Daisy Themes</a>', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_html'
    ) );

    $wp_customize->add_control( 'good_news_pro_footer_bar_developer', array(
        'label'                 => __( 'Developer', 'awesome-one-page' ),
        'section'               => 'good_news_pro_footer_bar',
        'settings'              => 'good_news_pro_footer_bar_developer',
        'type'                  => 'textarea',
    ) );


    // Custom CSS
    $wp_customize->add_section( 'good_news_pro_custom_css', array(
        'priority'              => 125,
        'title'                 => esc_html__( 'Custom CSS', 'awesome-one-page' ),
    ) );

    $wp_customize->add_setting( 'good_news_pro_custom_css_code', array(
        'default'               => '',
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_nohtml'
    ) );

    $wp_customize->add_control( 'good_news_pro_custom_css_code', array(
        'label'                 => esc_html__( 'Add Custom CSS Code', 'awesome-one-page' ),
        'section'               => 'good_news_pro_custom_css',
        'settings'              => 'good_news_pro_custom_css_code',
        'type'                  => 'textarea',
    ) );

    // Help & Support
    $wp_customize->add_section( 'good_news_pro_help_support', array(
        'priority'              => 126,
        'title'                 => esc_html__( 'Help & Support', 'awesome-one-page' ),
    ) );

    $wp_customize->add_setting( 'good_news_pro_help_support_links', array(
        'default'               => esc_html__( '', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'good_news_pro_sanitize_nohtml'
    ) );

    $wp_customize->add_control( new WP_Customize_Help_support_Control( $wp_customize, 'good_news_pro_help_support_links', array(
        'label'                 => esc_html__( 'Help & Support', 'awesome-one-page' ),
        'section'               => 'good_news_pro_help_support',
        'settings'              => 'good_news_pro_help_support_links',
    ) ) );

    /**
     * Checkbox Sanitize
     */
    function awesome_one_page_checkbox_sanitize( $input ) {
        if ( $input == 1 ) {
            return 1;
        } else {
            return '';
        }
    }

    //Menu style
    function awesome_one_page_sanitize_website_layout( $input ) {
        if ( in_array( $input, array( 'box', 'wide' ), true ) ) {
            return $input;
        }
    }

    //Menu style
    function awesome_one_page_sanitize_menu_style( $input ) {
        if ( in_array( $input, array( 'inline', 'centered' ), true ) ) {
            return $input;
        }
    }

    //Menu style
    function awesome_one_page_fwidgets( $input ) {
        if ( in_array( $input, array( '1', '2', '3', '4' ), true ) ) {
            return $input;
        }
    }

    /**
     * No-HTML sanitization callback
     */
    function good_news_pro_sanitize_nohtml( $nohtml ) {
        return wp_filter_nohtml_kses( $nohtml );
    }

    /**
     * HTML sanitization callback
     */
    function good_news_pro_sanitize_html( $html ) {
        $allowed_html = array(
            'a' => array(
                'href' => array(),
            )
        );

        return wp_kses( $html, $allowed_html );
    }

    /**
     * Header Layout Sanitize
     */
    function good_news_pro_sanitize_header_layout( $value ) {
        if ( ! in_array( $value, array( 'header-layout1', 'header-layout2', 'header-layout3', 'header-layout4' ) ) )
            $value = 'header-layout1';

        return $value;
    }

    /**
     * Header Layout Sanitize
     */
    function good_news_pro_sanitize_theme_color( $value ) {
        if ( ! in_array( $value, array( 'watermelon', 'red', 'orange', 'yellow', 'lime', 'green', 'mint', 'teal', 'sky-blue', 'blue', 'purple', 'pink', 'magenta', 'plum', 'brown', 'maroon' ) ) )
            $value = 'sky-blue';

        return $value;
    }

    /**
     * Select Sanitize
     */
    function good_news_pro_sanitize_select( $input, $setting ) {

        // Ensure input is a slug.
        $input = sanitize_key( $input );

        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }

    /**
     * Google Fonts Sanitize
     */
    function good_news_pro_sanitize_google_fonts( $value ) {
        if ( '0' == $value ) {
            return '0';
        } else if ( array_key_exists( $value, good_news_pro_google_font_list() ) ) {
            return $value;
        } else {
            return 'Roboto';
        }
    }

    /**
     * Number Sanitize
     */
    function good_news_pro_sanitize_number_absint( $number, $setting ) {
        // Ensure $number is an absolute integer (whole number, zero or greater).
        $number = absint( $number );

        // If the input is an absolute integer, return it; otherwise, return the default
        return ( $number ? $number : $setting->default );
    }

    /**
     * Sidebar Layout Sanitize
     */
    function good_news_pro_sanitize_sidebar_layout( $value ) {
        if ( ! in_array( $value, array( 'sidebar-right', 'sidebar-left', 'sidebar-none' ) ) )
            $value = 'sidebar-right';

        return $value;
    }

    /**
     * Post Template Sanitize
     */
    function good_news_pro_sanitize_post_template_layout( $value ) {
        if ( ! in_array( $value, array( 'post-template1', 'post-template2', 'post-template3', 'post-template4', 'post-template5', 'post-template6', 'post-template7', 'post-template8', 'post-template9', 'post-template10' ) ) )
            $value = 'post-template1';

        return $value;
    }

    /**
     * Number Range Sanitize
     */
    function good_news_pro_sanitize_number_range( $number, $setting ) {

        // Ensure input is an absolute integer.
        $number = absint( $number );

        // Get the input attributes associated with the setting.
        $atts = $setting->manager->get_control( $setting->id )->input_attrs;

        // Get minimum number in the range.
        $min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

        // Get maximum number in the range.
        $max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

        // Get step.
        $step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

        // If the number is within the valid range, return it; otherwise, return the default
        return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
    }

    /**
     * Archive Header Layout Sanitize
     */
    function good_news_pro_sanitize_archive_header_layout( $value ) {
        if ( ! in_array( $value, array( 'archive-header1', 'archive-header2',  'archive-header3' , 'archive-header4' , 'archive-header5' ) ) )
            $value = 'archive-header1';

        return $value;
    }

    /**
     * Default Archive Layout Sanitize
     */
    function good_news_pro_sanitize_default_archive_layout( $value ) {
        if ( ! in_array( $value, array( 'archive-layout1', 'archive-layout2', 'archive-layout3', 'archive-layout4', 'archive-layout5', 'archive-layout6', 'archive-layout7', 'archive-layout8', 'archive-layout9', 'archive-layout10' ) ) )
            $value = 'archive-layout1';

        return $value;
    }

    /**
     * Category Layout Sanitize
     */
    function good_news_pro_sanitize_archive_category_layout( $value ) {
        if ( ! in_array( $value, array( 'archive-category-layout1', 'archive-category-layout2', 'archive-category-layout3', 'archive-category-layout4', 'archive-category-layout5', 'archive-category-layout6', 'archive-category-layout7', 'archive-category-layout8', 'archive-category-layout9', 'archive-category-layout10' ) ) )
            $value = 'archive-category-layout1';

        return $value;
    }

    /**
     * Tag Layout Sanitize
     */
    function good_news_pro_sanitize_archive_tag_layout( $value ) {
        if ( ! in_array( $value, array( 'archive-tag-layout1', 'archive-tag-layout2', 'archive-tag-layout3', 'archive-tag-layout4', 'archive-tag-layout5', 'archive-tag-layout6', 'archive-tag-layout7', 'archive-tag-layout8', 'archive-tag-layout9', 'archive-tag-layout10' ) ) )
            $value = 'archive-tag-layout1';

        return $value;
    }

    /**
     * User Layout Sanitize
     */
    function good_news_pro_sanitize_archive_author_layout( $value ) {
        if ( ! in_array( $value, array( 'archive-author-layout1', 'archive-author-layout2', 'archive-author-layout3', 'archive-author-layout4', 'archive-author-layout5', 'archive-author-layout6', 'archive-author-layout7', 'archive-author-layout8', 'archive-author-layout9', 'archive-author-layout10' ) ) )
            $value = 'archive-author-layout1';

        return $value;
    }

    /**
     * Search Layout Sanitize
     */
    function good_news_pro_sanitize_archive_search_layout( $value ) {
        if ( ! in_array( $value, array( 'archive-search-layout1', 'archive-search-layout2', 'archive-search-layout3', 'archive-search-layout4', 'archive-search-layout5', 'archive-search-layout6', 'archive-search-layout7', 'archive-search-layout8', 'archive-search-layout9', 'archive-search-layout10' ) ) )
            $value = 'archive-search-layout1';

        return $value;
    }

    /**
     * Footer Widgets Layout Sanitize
     */
    function good_news_pro_sanitize_footer_widgets_layout( $value ) {
        if ( ! in_array( $value, array( 'footer-widgets1', 'footer-widgets2', 'footer-widgets3', 'footer-widgets4', 'footer-widgets5', 'footer-widgets6', 'footer-widgets7', 'footer-widgets8', 'footer-widgets9', 'footer-widgets10' ) ) )
            $value = 'footer-widgets1';

        return $value;
    }

    /**
     * Footer Bar Layout Sanitize
     */
    function good_news_pro_sanitize_footer_bar_layout( $value ) {
        if ( ! in_array( $value, array( 'footer-bar-layout1', 'footer-bar-layout2', 'footer-bar-layout3', 'footer-bar-layout4', 'footer-bar-layout5' ) ) )
            $value = 'footer-bar-layout1';

        return $value;
    }

}
add_action( 'customize_register', 'awesome_one_page_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function awesome_one_page_customize_preview_js() {
	wp_enqueue_script( 'awesome_one_page_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'awesome_one_page_customize_preview_js' );