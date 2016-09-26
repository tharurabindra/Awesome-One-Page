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

    /* Sanitize customizer fields. */
    require get_template_directory() . '/inc/customizer/customizer-sanitize.php';

    /* Custom customizer classes. */
    require get_template_directory() . '/inc/customizer/aop-customizer-classes.php';

	/*--------------------------------------------------------------------------------------------------*/
    	/**
         * Breadcrumbs Settings
         */
        $wp_customize->add_section( 'aop_breadcrumbs_section', array(
            'title'             => esc_html__( 'Breadcrumbs Settings', 'awesome-one-page' ),
            'priority'          => 130
        ) );

        /* Add 'show/hide breadcrumbs' setting */
        $wp_customize->add_setting( 'aop_breadcrumbs_option', array(
            'default'           => '1',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'aop_sanitize_checkbox'
        ) );
        /* Add 'show/hide breadcrumbs' control */
        $wp_customize->add_control( 'aop_breadcrumbs_option', array(
            'type'      	   => 'checkbox',
            'priority'         => 1,                    
            'label'     	   => esc_html__( 'Enable/Disable breadcrumbs in innerpages.', 'awesome-one-page' ),
            'section'   	   => 'aop_breadcrumbs_section'   
        ) );

        /* Add 'breadcrumbs home text' setting */
        $wp_customize->add_setting( 'aop_breadcrumb_home_text', array(
            'default'   		=> esc_html__( 'Home', 'awesome-one-page' ),
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'aop_sanitize_text'                 
        ) );
        /* Add 'breadcrumbs home text' control */ 
        $wp_customize->add_control( 'aop_breadcrumb_home_text', array(
            'type'              => 'text',
            'priority'          => 2,
            'label'             => esc_html__( 'Breadcrumbs Home Text', 'awesome-one-page' ),
            'section'           => 'aop_breadcrumbs_section'
            
        ) );

    /*----------------------------------------HEADER-OPTIONS----------------------------------------------------------*/
        $wp_customize->add_panel( 'aop_header_options', array(
            'title'             => esc_html__( 'Header Options', 'awesome-one-page' ),
            'priority'          => 140
        ) );
    /*--------------------------------------------------------------------------------------------------*/
        /**
         * Slider Settings
         */
        $wp_customize->add_section( 'aop_slider_section', array(
            'title'             => esc_html__( 'Slider Settings', 'awesome-one-page' ),
            'priority'          => 15,
            'panel'             => 'aop_header_options',
            'description'       => '<strong>'.esc_html__( 'Note', 'awesome-one-page').'</strong><br/>'.esc_html__( '1. To display the Slider first check Enable the slider below. Now create the page for each slider and enter title, text and featured image. Choose that pages in the dropdown options.', 'awesome-one-page').'<br/>'.esc_html__( '2. The recommended size for the slider image is 1920 x 790 pixels. For better functioning of slider use equal size images for each slide.', 'awesome-one-page' ).'<br/>'.esc_html__( '3. If page do not have featured Image than that page will not included in slider show.', 'awesome-one-page' ),
        ) );

        /* Add 'show/hide slider' setting */
        $wp_customize->add_setting( 'aop_slider_enable', array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'aop_sanitize_checkbox'
        ) );
        /* Add 'show/hide Slider' control */
        $wp_customize->add_control( 'aop_slider_enable', array(
            'type'             => 'checkbox',
            'priority'         => 1,                    
            'label'            => esc_html__( 'Enable slider in home or front page.', 'awesome-one-page' ),
            'section'          => 'aop_slider_section'   
        ) );

        for( $i = 1; $i <= 4; $i++ ) {
            /* Add 'show/hide slider' setting */
            $wp_customize->add_setting( 'aop_slider_'.$i, array(
                'default'           => '',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'aop_sanitize_integer'
            ) );
            /* Add 'show/hide Slider' control */
            $wp_customize->add_control( 'aop_slider_'.$i, array(                    
                'label'            => esc_html__( 'Slide ', 'awesome-one-page' ).$i,
                'section'          => 'aop_slider_section',
                'type'             => 'dropdown-pages',
                'priority'         => $i+10  
            ) );
        }


    /*----------------------------------------DESIGN-OPTIONS----------------------------------------------------------*/
        $wp_customize->add_panel( 'aop_design_options', array(
            'title'             => esc_html__( 'Design Options', 'awesome-one-page' ),
            'priority'          => 150
        ) );

    /*--------------------------------------------------------------------------------------------------*/
        /**
         * Website Layout sections
         */
        $wp_customize->add_section( 'aop_website_layout_section', array(
            'title'             => esc_html__( 'Website Layout', 'awesome-one-page' ),
            'priority'          => 15,
            'panel'             => 'aop_design_options'
        ) );

        /* Add 'website layout' setting */
        $wp_customize->add_setting( 'aop_website_layout', array(
            'default'           => 'wide',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'aop_sanitize_radio'                 
        ) );
        /* Add 'website layout' control */ 
        $wp_customize->add_control( 'aop_website_layout', array(
            'type'              => 'radio',
            'priority'          => 1,
            'label'             => esc_html__( 'Website Layout.', 'awesome-one-page' ),
            'description'       => esc_html__( 'Choose your site layout. The change is reflected in whole site.', 'awesome-one-page' ),
            'section'           => 'aop_website_layout_section',
            'choices'           => array(
                'box'               => esc_html__('Boxed layout', 'awesome-one-page'),
                'wide'              => esc_html__('Wide layout', 'awesome-one-page')
            )    
        ) );
    /*--------------------------------------------------------------------------------------------------*/
        /**
         * Archive Settings
         */
        $wp_customize->add_section( 'aop_archive_settings_section', array(
            'title'             => esc_html__( 'Archive Settings', 'awesome-one-page' ),
            'priority'          => 20,
            'panel'             => 'aop_design_options'
        ) );

        /* Add 'default sidebar' setting */
        $wp_customize->add_setting( 'aop_archive_sidebar', array(
            'default'           => 'right_sidebar',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'aop_sanitize_radio'                 
        ) );
        /* Add 'default sidebar' control */ 
        $wp_customize->add_control( new Aop_Image_Radio_Control( $wp_customize, 'aop_archive_sidebar', array(
            'type'               => 'radio',
            'priority'           => 1,
            'label'              => esc_html__('Available Sidebar', 'awesome-one-page'),
            'description'        => esc_html__('Select default sidebar. This sidebar will be reflected in whole site archives, categories, search page etc.', 'awesome-one-page'),
            'section'            => 'aop_archive_settings_section',
            'choices'            => array(
                'right_sidebar'                 => get_template_directory_uri() . '/inc/assets/images/right-sidebar.png',
                'left_sidebar'                  => get_template_directory_uri() . '/inc/assets/images/left-sidebar.png',
                'no_sidebar_full_width'         => get_template_directory_uri() . '/inc/assets/images/no-sidebar-full-width-layout.png',
                'no_sidebar_content_centered'   => get_template_directory_uri() . '/inc/assets/images/no-sidebar-content-centered-layout.png'
            ) )
        ) );
    /*--------------------------------------------------------------------------------------------------*/
        /**
         * Page Settings
         */
        $wp_customize->add_section( 'aop_page_settings_section', array(
            'title'             => esc_html__( 'Page Settings', 'awesome-one-page' ),
            'priority'          => 25,
            'panel'             => 'aop_design_options'
        ) );

        /* Add 'page sidebar' setting */
        $wp_customize->add_setting( 'aop_page_sidebar', array(
            'default'           => 'right_sidebar',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'aop_sanitize_radio'                 
        ) );
        /* Add 'page sidebar' control */ 
        $wp_customize->add_control( new Aop_Image_Radio_Control( $wp_customize, 'aop_page_sidebar', array(
            'type'               => 'radio',
            'priority'           => 1,
            'label'              => esc_html__('Available Sidebar', 'awesome-one-page'),
            'description'        => esc_html__('Select default layout for pages. This layout will be reflected in all pages unless unique layout is set for specific page.', 'awesome-one-page'),
            'section'            => 'aop_page_settings_section',
            'choices'            => array(
                'right_sidebar'                 => get_template_directory_uri() . '/inc/assets/images/right-sidebar.png',
                'left_sidebar'                  => get_template_directory_uri() . '/inc/assets/images/left-sidebar.png',
                'no_sidebar_full_width'         => get_template_directory_uri() . '/inc/assets/images/no-sidebar-full-width-layout.png',
                'no_sidebar_content_centered'   => get_template_directory_uri() . '/inc/assets/images/no-sidebar-content-centered-layout.png'
            ) )
        ) );

    /*--------------------------------------------------------------------------------------------------*/
        /**
         * Post Settings
         */
        $wp_customize->add_section( 'aop_post_settings_section', array(
            'title'             => esc_html__( 'Post Settings', 'awesome-one-page' ),
            'priority'          => 30,
            'panel'             => 'aop_design_options'
        ) );

        /* Add 'post sidebar' setting */
        $wp_customize->add_setting( 'aop_post_sidebar', array(
            'default'           => 'right_sidebar',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'aop_sanitize_radio'                 
        ) );
        /* Add 'post sidebar' control */ 
        $wp_customize->add_control( new Aop_Image_Radio_Control( $wp_customize, 'aop_post_sidebar', array(
            'type'               => 'radio',
            'priority'           => 1,
            'label'              => esc_html__('Available Sidebar', 'awesome-one-page'),
            'description'        => esc_html__('Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for specific post.', 'awesome-one-page'),
            'section'            => 'aop_post_settings_section',
            'choices'            => array(
                'right_sidebar'                 => get_template_directory_uri() . '/inc/assets/images/right-sidebar.png',
                'left_sidebar'                  => get_template_directory_uri() . '/inc/assets/images/left-sidebar.png',
                'no_sidebar_full_width'         => get_template_directory_uri() . '/inc/assets/images/no-sidebar-full-width-layout.png',
                'no_sidebar_content_centered'   => get_template_directory_uri() . '/inc/assets/images/no-sidebar-content-centered-layout.png'
            ) )
        ) );

    /*--------------------------------------------------------------------------------------------------*/
        /**
         * Primary Color
         */
        $wp_customize->add_section( 'aop_color_settings_section', array(
            'title'             => esc_html__( 'Color Settings', 'awesome-one-page' ),
            'priority'          => 35,
            'panel'             => 'aop_design_options'
        ) );

        /* Add 'primary color' setting */
        $wp_customize->add_setting( 'aop_primary_color', array(
            'default'              => '#ff4a1c',
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'aop_hex_color_sanitize',
            'sanitize_js_callback' => 'aop_color_escaping_sanitize'                
        ) );
        /* Add 'primary color' control */ 

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aop_primary_color', array(
            'priority'           => 1,
            'label'              => esc_html__( 'Primary Color', 'awesome-one-page' ),
            'description'        => esc_html__( 'This will reflect in links, buttons and many others. Choose a color to match your site', 'awesome-one-page' ),
            'section'            => 'aop_color_settings_section'
            )
        ) );

    /*--------------------------------------------------------------------------------------------------*/
        /**
         * Custom CSS Box
         */
        $wp_customize->add_section( 'aop_css_settings_section', array(
            'title'             => esc_html__( 'Custom CSS', 'awesome-one-page' ),
            'priority'          => 40,
            'panel'             => 'aop_design_options'
        ) );

        /* Add 'custom css' setting */
        $wp_customize->add_setting( 'aop_custom_css', array(
            'default'              => '',
            'capability'           => 'edit_theme_options',
            'sanitize_callback'    => 'wp_filter_nohtml_kses',
            'sanitize_js_callback' => 'wp_filter_nohtml_kses'                
        ) );
        /* Add 'custom css' control */ 

        $wp_customize->add_control( 'aop_custom_css', array(
            'type'               => 'textarea',
            'priority'           => 1,
            'label'              => esc_html__( 'Custom CSS Box', 'awesome-one-page' ),
            'description'        => esc_html__( 'Write your custom css', 'awesome-one-page' ),
            'section'            => 'aop_css_settings_section'
        ) );
}
add_action( 'customize_register', 'awesome_one_page_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function awesome_one_page_customize_preview_js() {
	wp_enqueue_script( 'awesome_one_page_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'awesome_one_page_customize_preview_js' );