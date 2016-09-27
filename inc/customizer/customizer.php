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

        // Image radio control
        class WP_Customizer_Image_Radio_Control extends WP_Customize_Control {

            public function render_content() {

            if ( empty( $this->choices ) )
                return;

            $name = '_customize-radio-' . $this->id;

            ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <ul class="controls" id = 'aop-img-container'>

                <?php   foreach ( $this->choices as $value => $label ) :

                    $class = ($this->value() == $value)?'aop-radio-img-selected aop-radio-img-img':'aop-radio-img-img';

                    ?>

                    <li style="display: inline;">

                    <label>

                        <input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />

                        <img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo esc_attr( $class) ; ?>' />

                    </label>

                    </li>

                <?php   endforeach; ?>

            </ul>

            <?php
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
        'sanitize_callback'     => 'awesome_one_page_sanitize_nohtml'
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

/*--------------------------------------------------------------------------------------------------*/

    // Posts Settings
    $wp_customize->add_panel( 'awesome_one_page_post_settings', array(
        'priority'              => 112,
        'title'                 => esc_html__( 'Post Settings', 'awesome-one-page' )
    ) );

    // Post Settings
    $wp_customize->add_section( 'awesome_one_page_post_settings_general_sec', array(
        'title'                 => esc_html__( 'General Settings', 'awesome-one-page' ),
        'panel'                 => 'awesome_one_page_post_settings'
    ) );

    // Post global sidebar.
    $wp_customize->add_setting( 'awesome_one_page_post_global_sidebar', array(
        'default'           => 'right_sidebar',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'awesome_one_page_sanitize_post_sidebar'                 
    ) );

    $wp_customize->add_control( new WP_Customizer_Image_Radio_Control( $wp_customize, 'awesome_one_page_post_global_sidebar', array(
        'type'               => 'radio',
        'priority'           => 1,
        'label'              => esc_html__('Available Sidebar', 'awesome-one-page'),
        'description'        => esc_html__('Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for specific post.', 'awesome-one-page'),
        'section'            => 'awesome_one_page_post_settings_general_sec',
        'settings'          => 'awesome_one_page_post_global_sidebar',
        'choices'            => array(
            'right_sidebar'                 => get_template_directory_uri() . '/inc/assets/images/right-sidebar.png',
            'left_sidebar'                  => get_template_directory_uri() . '/inc/assets/images/left-sidebar.png',
            'no_sidebar_full_width'         => get_template_directory_uri() . '/inc/assets/images/no-sidebar-full-width-layout.png',
            'no_sidebar_content_centered'   => get_template_directory_uri() . '/inc/assets/images/no-sidebar-content-centered-layout.png'
        ) )
    ) );

    // Post Nex/Prev article
    $wp_customize->add_setting( 'awesome_one_page_post_nex_prev_article', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_post_nex_prev_article', array(
        'label'                 => esc_html__( 'Next/Previous Article', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_post_settings_general_sec',
        'settings'              => 'awesome_one_page_post_nex_prev_article'
    ) ) );

    // Featured Image show
    $wp_customize->add_setting( 'awesome_one_page_post_featured_image', array(
        'default'               => '',
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_post_featured_image', array(
        'label'                 => esc_html__( 'Show Featured Image', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_post_settings_general_sec',
        'settings'              => 'awesome_one_page_post_featured_image',
    ) ) );

    // Posts meta Settings
    $wp_customize->add_section( 'awesome_one_page_post_meta_settings_sec', array(
        'title'                 => esc_html__( 'Post Meta', 'awesome-one-page' ),
        'panel'                 => 'awesome_one_page_post_settings',
    ) );

    // Post Author
    $wp_customize->add_setting( 'awesome_one_page_post_meta_author', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_post_meta_author', array(
        'label'                 => esc_html__( 'Post Author', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_post_meta_settings_sec',
        'settings'              => 'awesome_one_page_post_meta_author',
    ) ) );

    // Post Date
    $wp_customize->add_setting( 'awesome_one_page_post_meta_date', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_post_meta_date', array(
        'label'                 => esc_html__( 'Post Date', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_post_meta_settings_sec',
        'settings'              => 'awesome_one_page_post_meta_date',
    ) ) );

    // Post Categories
    $wp_customize->add_setting( 'awesome_one_page_post_meta_categories', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_post_meta_categories', array(
        'label'                 => esc_html__( 'Post Categories', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_post_meta_settings_sec',
        'settings'              => 'awesome_one_page_post_meta_categories',
    ) ) );

    // Post Tags
    $wp_customize->add_setting( 'awesome_one_page_post_meta_tags', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_post_meta_tags', array(
        'label'                 => esc_html__( 'Post Tags', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_post_meta_settings_sec',
        'settings'              => 'awesome_one_page_post_meta_tags',
    ) ) );

    
/*--------------------------------------------------------------------------------------------------*/

    // Archive/Category Settings
    $wp_customize->add_panel( 'awesome_one_page_blog_settings', array(
        'priority'              => 113,
        'title'                 => esc_html__( 'Blog Settings', 'awesome-one-page' ),
    ) );

    // General Settings
    $wp_customize->add_section( 'awesome_one_page_blog_general_sec', array(
        'title'                 => esc_html__( 'General Settings', 'awesome-one-page' ),
        'panel'                 => 'awesome_one_page_blog_settings',
    ) );

    // blog global sidebar.
    $wp_customize->add_setting( 'awesome_one_page_blog_global_sidebar', array(
        'default'           => 'right_sidebar',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'awesome_one_page_sanitize_post_sidebar'                 
    ) );

    $wp_customize->add_control( new WP_Customizer_Image_Radio_Control( $wp_customize, 'awesome_one_page_blog_global_sidebar', array(
        'type'               => 'radio',
        'priority'           => 1,
        'label'              => esc_html__('Available Sidebar', 'awesome-one-page'),
        'description'        => esc_html__('Select default sidebar. This sidebar will be reflected in all pages unless unique layout is set for specific page as well as reflected in whole site archives, categories, search page etc.', 'awesome-one-page'),
        'section'            => 'awesome_one_page_blog_general_sec',
        'settings'          => 'awesome_one_page_blog_global_sidebar',
        'choices'            => array(
            'right_sidebar'                 => get_template_directory_uri() . '/inc/assets/images/right-sidebar.png',
            'left_sidebar'                  => get_template_directory_uri() . '/inc/assets/images/left-sidebar.png',
            'no_sidebar_full_width'         => get_template_directory_uri() . '/inc/assets/images/no-sidebar-full-width-layout.png',
            'no_sidebar_content_centered'   => get_template_directory_uri() . '/inc/assets/images/no-sidebar-content-centered-layout.png'
        ) )
    ) );

    // Excerpt Length
    $wp_customize->add_setting( 'awesome_one_page_blog_post_excerpt_length', array(
        'default'               => '40',
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_sanitize_number_range'
    ) );

    $wp_customize->add_control( new WP_Customize_Font_Control(  $wp_customize, 'awesome_one_page_blog_post_excerpt_length', array(
        'label'                 => esc_html__( 'Excerpt Length', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_blog_general_sec',
        'settings'              => 'awesome_one_page_blog_post_excerpt_length',
    ) ) );

    // Show Thumbnail
    $wp_customize->add_setting( 'awesome_one_page_blog_post_thumb_image', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_blog_post_thumb_image', array(
        'label'                 => esc_html__( 'Show Thumbnail', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_blog_general_sec',
        'settings'              => 'awesome_one_page_blog_post_thumb_image',
    ) ) );

    // Show Read More
    $wp_customize->add_setting( 'awesome_one_page_blog_show_read_more', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_blog_show_read_more', array(
        'label'                 => esc_html__( 'Show Read More', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_blog_general_sec',
        'settings'              => 'awesome_one_page_blog_show_read_more',
    ) ) );

    // Read More Text
    $wp_customize->add_setting( 'awesome_one_page_blog_read_more_text', array(
        'default'               => esc_html__( 'Read More', 'awesome-one-page' ),
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_sanitize_text'
    ) );

    $wp_customize->add_control( 'awesome_one_page_blog_read_more_text', array(
        'type'                  => 'text',
        'label'                 => esc_html__( 'Read More Text', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_blog_general_sec',
        'settings'              => 'awesome_one_page_blog_read_more_text',
    ) );


    // Posts meta Settings
    $wp_customize->add_section( 'awesome_one_page_blog_post_meta_sec', array(
        'title'                 => esc_html__( 'Post Meta', 'awesome-one-page' ),
        'panel'                 => 'awesome_one_page_blog_settings',
    ) );

    // Date
    $wp_customize->add_setting( 'awesome_one_page_blog_post_date', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_blog_post_date', array(
        'label'                 => esc_html__( 'Post Date', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_blog_post_meta_sec',
        'settings'              => 'awesome_one_page_blog_post_date'
    ) ) );


    // Categories
    $wp_customize->add_setting( 'awesome_one_page_blog_post_categories', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_blog_post_categories', array(
        'label'                 => esc_html__( 'Post Categories', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_blog_post_meta_sec',
        'settings'              => 'awesome_one_page_blog_post_categories',
    ) ) );

    // Tags
    $wp_customize->add_setting( 'awesome_one_page_blog_post_tags', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_blog_post_tags', array(
        'label'                 => esc_html__( 'Show Tags', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_blog_post_meta_sec',
        'settings'              => 'awesome_one_page_blog_post_tags',
    ) ) ); 

    // Comments
    $wp_customize->add_setting( 'awesome_one_page_blog_post_comments', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_checkbox_sanitize'
    ) );

    $wp_customize->add_control( new WP_Customize_Checkbox_Control( $wp_customize, 'awesome_one_page_blog_post_comments', array(
        'label'                 => esc_html__( 'Post Comments', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_blog_post_meta_sec',
        'settings'              => 'awesome_one_page_blog_post_comments',
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
        'sanitize_callback'  => 'awesome_one_page_post_sanitize_fwidget_area'
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

/*--------------------------------------------------------------------------------------------------*/

    // Custom CSS
    $wp_customize->add_section( 'awesome_one_page_custom_css', array(
        'priority'              => 125,
        'title'                 => esc_html__( 'Custom CSS', 'awesome-one-page' ),
    ) );

    $wp_customize->add_setting( 'awesome_one_page_custom_css_code', array(
        'default'               => '',
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_sanitize_nohtml'
    ) );

    $wp_customize->add_control( 'awesome_one_page_custom_css_code', array(
        'label'                 => esc_html__( 'Add Custom CSS Code', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_custom_css',
        'settings'              => 'awesome_one_page_custom_css_code',
        'type'                  => 'textarea',
    ) );

/*--------------------------------------------------------------------------------------------------*/

    // Help & Support
    $wp_customize->add_section( 'awesome_one_page_help_support', array(
        'priority'              => 126,
        'title'                 => esc_html__( 'Help & Support', 'awesome-one-page' ),
    ) );

    $wp_customize->add_setting( 'awesome_one_page_help_support_links', array(
        'default'               => '',
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'awesome_one_page_sanitize_nohtml'
    ) );

    $wp_customize->add_control( new WP_Customize_Help_support_Control( $wp_customize, 'awesome_one_page_help_support_links', array(
        'label'                 => esc_html__( 'Help & Support', 'awesome-one-page' ),
        'section'               => 'awesome_one_page_help_support',
        'settings'              => 'awesome_one_page_help_support_links',
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

    //Footer Widgets
    function awesome_one_page_post_sanitize_fwidget_area( $input ) {
        if ( in_array( $input, array( '1', '2', '3', '4' ), true ) ) {
            return $input;
        }
    }

    //Footer Widgets
    function awesome_one_page_sanitize_post_sidebar( $input ) {
        if ( in_array( $input, array( 'right_sidebar', 'left_sidebar', 'no_sidebar_full_width', 'no_sidebar_content_centered' ), true ) ) {
            return $input;
        }
    }

    //Text
    function awesome_one_page_sanitize_text( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }

    /**
     * No-HTML sanitization callback
     */
    function awesome_one_page_sanitize_nohtml( $nohtml ) {
        return wp_filter_nohtml_kses( $nohtml );
    }

    /**
     * Number Range Sanitize
     */
    function awesome_one_page_sanitize_number_range( $number, $setting ) {

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
}
add_action( 'customize_register', 'awesome_one_page_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function awesome_one_page_customize_preview_js() {
	wp_enqueue_script( 'awesome_one_page_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'awesome_one_page_customize_preview_js' );