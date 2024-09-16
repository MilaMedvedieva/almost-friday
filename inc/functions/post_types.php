<?php
add_action('init', 'create_event' );
add_action('init', 'create_gallery' );
//add_action('init', 'create_event_type' );
add_action('init', 'create_subscribers');
add_action('init', 'create_order_form');
add_action('init', 'create_tax_category_event');

function create_event() {
    register_post_type('events',
        array(
            'labels' => array(
                'name'          => __('Events'),
                'singular_name' => __('event'),
            ),
            'public' => true,
            'show_in_nav_menus' => true,
            'menu_icon'  => 'dashicons-feedback',
            'hierarchical' => true,
            'has_archive' => true,
            'supports' => array('title', 'thumbnail', 'page-attributes', 'revisions'),
        ));
}

function create_gallery() {
    register_post_type('gallery',
        array(
            'labels' => array(
                'name'          => __('Gallery'),
                'singular_name' => __('Folder'),
            ),
            'public' => true,
            'show_in_nav_menus' => true,
            'menu_icon'  => 'dashicons-format-gallery',
            'hierarchical' => true,
            'has_archive' => true,
            'supports' => array('title', 'thumbnail', 'page-attributes', 'revisions'),
        ));
}

function create_event_type() {
    register_post_type('event_type',
        array(
            'labels' => array(
                'name'          => __('Type'),
                'singular_name' => __('type'),
            ),
            'public' => true,
            'show_in_nav_menus' => true,
            'menu_icon'  => 'dashicons-editor-kitchensink',
            'hierarchical' => true,
            'has_archive' => false,
            'supports' => array('title', 'thumbnail', 'page-attributes', 'revisions'),
        ));
}

function create_subscribers() {

    register_post_type('subscribers',
        array(
            'labels' => array(
                'name' => __('Contact Request'),
                'singular_name' => __('subscribers')
            ),
            'public' => true,
            'menu_icon'  => 'dashicons-email-alt',
            'has_archive' => true,
            'rewrite' => array('slug' => 'subscribers'),
        )
    );

}

function create_order_form() {
    register_post_type('orders',
        array(
            'labels' => array(
                'name' => __('Order Form'),
                'singular_name' => __('order')
            ),
            'public' => true,
            'menu_icon'  => 'dashicons-email',
            'has_archive' => true,
            'rewrite' => array('slug' => 'order'),
        )
    );

}

function create_tax_category_event(){
    $labels = array(
        'name'              => 'Categories',
        'singular_name'     => 'Category',
    );
    $args = array(
        'label'                 => '',
        'labels'                => $labels,
        'description'           => '',
        'public'                => true,
        'publicly_queryable'    => false,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => true,
        'hierarchical'          => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        //'query_var'           => $taxonomy,
        'capabilities'          => array(),
        'meta_box_cb'           => 'post_categories_meta_box',
        'show_admin_column'     => true,
    );
    register_taxonomy('category_events', array('events'), $args );
}
