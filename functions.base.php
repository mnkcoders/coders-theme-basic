<?php defined('ABSPATH') or die;

add_action('init', function() {

    //Scripts
    add_action('wp_enqueue_scripts', function() {

        wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        //wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');
        wp_enqueue_style('style', get_stylesheet_uri());
        wp_enqueue_script('script', get_template_directory_uri() . '/script.js', array(), '1.0.0', true);

        $themeVariation = get_theme_mod('coders_theme_color', 'red');

        if (strlen($themeVariation)) {
            wp_enqueue_style('style-' . $themeVariation, sprintf('%s/override/%s.css',
                            get_stylesheet_directory_uri(),
                            $themeVariation));
        }
    });

    //Menus
    register_nav_menus(
            array(
                'top-menu' => __('Top Menu'),
                'main-menu' => __('Main Menu'),
                'bottom-menu' => __('Bottom Menu'),
            )
    );

    add_theme_support('custom-logo', array(
        'width' => 200,
        'height' => 100,
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => array('site-title', 'site-description'),
    ));

    add_theme_support('post-thumbnails', array('post'));
});

add_action('widgets_init', function() {

    $footerWidgets = intval( get_theme_mod('coders_footer_widgets', 0));
    $topBar = get_theme_mod('coders_topbar_layout', '');
    $bottomBar = get_theme_mod('coders_bottom_bar_layout', '');
    
    if( $topBar === 'widget' || $topBar === 'widget_menu' || $topBar === 'menu_widget'){
        register_sidebar(array(
            'name' => __('Top Bar'),
            'id' => 'top-bar',
            'before_widget' => '<div class="widget container left">',
            'after_widget' => '</div>',
            'before_title' => '', //no title here
            'after_title' => '',
        ));
    }

    register_sidebar(array(
        'name' => __('Blog Sidebar'),
        'id' => 'sidebar',
        'before_widget' => '<div class="widget container">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    
    if( $footerWidgets > 0 ){
        for( $i = 0 ; $i < $footerWidgets ; $i++ ){
            register_sidebar(array(
                'id' => 'footer-widget-'.($i+1),
                'name' => __('Footer Widgets ' . ($i+1) ),
                'before_widget' => sprintf( '<div class="widget container bot-md footer-widget-%s">', $i+1 ),
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ));
        }
    }

    if( $bottomBar === 'widget' || $bottomBar === 'widget_menu' || $bottomBar === 'menu_widget'){
        register_sidebar(array(
            'name' => __('Bottom Bar'),
            'id' => 'bottom-bar',
            'before_widget' => '<div class="widget container">',
            'after_widget' => '</div>',
            'before_title' => '', //no title here
            'after_title' => '',
        ));
    }
});

add_action('customize_register', function(WP_Customize_Manager $wp_customize) {

    $themeVaraiationSelect = array(
        'red' => __('Sakura', 'coders_themes'),
        'sunset' => __('Sunset', 'coders_themes'),
        'nature' => __('Nature', 'coders_themes'),
        'ocean' => __('Ocean', 'coders_themes'),
        'organic' => __('Organic', 'coders_themes'),
        'golden' => __('Cornfield', 'coders_themes'),
            //'glass' => __('Glass','coders_themes'),
    );

    $topBottomLayout = array(
        '' => __('Hidden', 'coders_themes'),
        'widget' => __('Widgets Only', 'coders_themes'),
        'menu' => __('Menu Only', 'coders_themes'),
        'widget_menu' => __('Widgets and Menu', 'coders_themes'),
        'menu_widget' => __('Menu and Widgets', 'coders_themes'),
    );

    $themeHeaderMode = array(
        '' => __('Default', 'coders_themes'),
        'fixed' => __('Fixed Header', 'coders_themes'),
    );

    $footerWidgets = array(
        0 => __('Empty','coders_themes'),
        1 => __('One Column','coders_themes'),
        2 => __('Two Columns','coders_themes'),
        3 => __('Three Columns','coders_themes'),
        4 => __('Four Columns','coders_themes'),
    );

    //global $wp_customize;
    $wp_customize->add_setting('coders_theme_color', $themeVaraiationSelect);
    $wp_customize->add_setting('coders_topbar_layout', $topBottomLayout);
    $wp_customize->add_setting('coders_footer_widgets', $footerWidgets);
    $wp_customize->add_setting('coders_theme_fixed_header', $themeHeaderMode);
    $wp_customize->add_setting('coders_bottom_bar_layout', $topBottomLayout);


    $wp_customize->add_section('coders_theme_setup', array(
        'title' => __('Coders Theme Setup', 'coders_themes'),
        'priority' => 30,
    ));

    $wp_customize->add_control(new WP_Customize_Control(
                    $wp_customize, //Pass the $wp_customize object (required)
                    'coders_theme_fixed_header', //Set a unique ID for the control
                    array(
                'label' => __('Fixed Header', 'coders_themes'), //Admin-visible name of the control
                'description' => __('Set your header fixed'),
                'settings' => 'coders_theme_fixed_header', //Which setting to load and manipulate (serialized is okay)
                'priority' => 8, //Determines the order this control appears in for the specified section
                'section' => 'coders_theme_setup', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                'type' => 'select',
                'choices' => $themeHeaderMode)));
    $wp_customize->add_control(new WP_Customize_Control(
                    $wp_customize, //Pass the $wp_customize object (required)
                    'coders_theme_color_select', //Set a unique ID for the control
                    array(
                'label' => __('Color Selection', 'coders_themes'), //Admin-visible name of the control
                'description' => __('Make your choice ;D'),
                'settings' => 'coders_theme_color', //Which setting to load and manipulate (serialized is okay)
                'priority' => 10, //Determines the order this control appears in for the specified section
                'section' => 'coders_theme_setup', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                'type' => 'select',
                'choices' => $themeVaraiationSelect)));
    $wp_customize->add_control(new WP_Customize_Control(
                    $wp_customize, //Pass the $wp_customize object (required)
                    'coders_theme_footer_widgets', //Set a unique ID for the control
                    array(
                'label' => __('Footer Widgets', 'coders_themes'), //Admin-visible name of the control
                'description' => __('Display Footer Widget Areas'),
                'settings' => 'coders_footer_widgets', //Which setting to load and manipulate (serialized is okay)
                'priority' => 12, //Determines the order this control appears in for the specified section
                'section' => 'coders_theme_setup', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                'type' => 'select',
                'choices' => $footerWidgets)));
    $wp_customize->add_control(new WP_Customize_Control(
                    $wp_customize, //Pass the $wp_customize object (required)
                    'coders_theme_top_bar', //Set a unique ID for the control
                    array(
                'label' => __('Top Bar Layout', 'coders_themes'), //Admin-visible name of the control
                'description' => __('Select your topbar layout'),
                'settings' => 'coders_topbar_layout', //Which setting to load and manipulate (serialized is okay)
                'priority' => 11, //Determines the order this control appears in for the specified section
                'section' => 'coders_theme_setup', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                'type' => 'select',
                'choices' => $topBottomLayout)));
    $wp_customize->add_control(new WP_Customize_Control(
                    $wp_customize, //Pass the $wp_customize object (required)
                    'coders_theme_bottom_bar', //Set a unique ID for the control
                    array(
                'label' => __('Bottom Bar Layout', 'coders_themes'), //Admin-visible name of the control
                'description' => __('Select your bottom bar layout'),
                'settings' => 'coders_bottom_bar_layout', //Which setting to load and manipulate (serialized is okay)
                'priority' => 13, //Determines the order this control appears in for the specified section
                'section' => 'coders_theme_setup', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                'type' => 'select',
                'choices' => $topBottomLayout)));
});

/**
 * @param String $part
 */
function coders_theme_part( $part ){

    get_template_part( 'html/' . preg_replace('/_/', '-', $part) );
}

