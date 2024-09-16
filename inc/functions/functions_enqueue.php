<?php
// Add Theme Scripts
add_action('wp_enqueue_scripts', 'theme_scripts');
function theme_scripts(){
    wp_enqueue_script('app', get_stylesheet_directory_uri() . '/dist/js/app.js', array(), '1.0.0', true );

    if (is_page_template('templates/tp-registration.php') ) {
        wp_enqueue_script('form', get_stylesheet_directory_uri() . '/dist/js/form.js', array(), '1.0.0', true );
        wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.10.3/jquery-ui.js', array(), '1.0.0', true );
    }
}

// Add Theme Stylesheet
add_action('wp_enqueue_scripts', 'theme_styles');
function theme_styles(){
    wp_enqueue_style('app', get_stylesheet_directory_uri() . '/dist/css/app.css', array(), '1.0', 'all');
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), '1.0', 'all');

}

// Add Admin Stylesheet
add_action( 'admin_enqueue_scripts', 'admin_assets' );
function admin_assets() {
    //wp_enqueue_style('jquery-ui-css', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', [], '1.0', 'all');
   // wp_enqueue_script('jquery-ui-datepicker', 'https://code.jquery.com/ui/1.10.3/jquery-ui.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'theme-admin-script', get_template_directory_uri() . '/dist/admin/admin_script.js',  array('jquery'), '1.0.0', true );
    wp_localize_script( 'theme-admin-script', 'object_name', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ) );
    wp_enqueue_style( 'theme-admin-style', get_template_directory_uri() . '/dist/admin/admin_style.css' );
}
