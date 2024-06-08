<?php defined('ABSPATH') or die;

if (class_exists('CoderThemes')) {
    require_once sprintf('%s/theme-setup.php',__DIR__);
}

add_action('wp_ajax_coders_list_request', function() {
	
    $request = filter_input_array(INPUT_POST);

    print json_encode($request);

    wp_die();
});

add_action('init', function() {
    add_action('wp_head', function() {
        //wp_enqueue_script('awhitepixel-ajaxscript', get_stylesheet_directory_uri() . '/assets/js/frontendajax.js', ['jquery']);
        wp_localize_script('coders-localize-script', 'CoderVars', array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('coders-nonce')
        ));
    });
});


