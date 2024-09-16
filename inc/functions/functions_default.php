<?php
if (function_exists('add_theme_support')) {

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('small', 300, '', true);
    add_image_size('medium', 600, '', true);
    add_image_size('large', 1000, '', true);
    add_image_size('large2', 1500, '', true);
    add_image_size('large3', 1920, '', true);

}

function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

register_nav_menus(array(
    'right' => 'Right side',
    'left' => 'Left side'
));

add_filter('show_admin_bar', '__return_false');


function my_custom_sidebar()
{
    register_sidebar(
        array(
            'name' => __('Custom', 'almost-friday'),
            'id' => 'custom-side-bar',
            'description' => __('Custom Sidebar', 'almost-friday'),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}

add_action('widgets_init', 'my_custom_sidebar');

add_filter('manage_orders_posts_columns', 'manage_orders_posts_columns__callback');
add_action('manage_orders_posts_custom_column', 'manage_orders_posts_custom_column__callback', 10, 2);

function manage_orders_posts_columns__callback($columns)
{
    $columns['status'] = 'Status';
    return $columns;
}

function manage_orders_posts_custom_column__callback($column, $post_id)
{
    switch ($column) {
        case 'status' :
            $date_time_event = get_post_meta($post_id, 'status', true);
            echo $date_time_event;
            break;
    }
}

//function filter_ptags_on_images($content){
//    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
//}
//add_filter('the_content', 'filter_ptags_on_images');


add_filter('wp_nav_menu_objects', 'custom_offline_item_filter',10,2);
function custom_offline_item_filter($items, $args)
{

    $events_offline = get_field('events_list', 18);
    $events_online = get_field('events_list', 16);



    $parent_offline = 0;
    $parent_online_world = 0;
    $parent_online_prague = 0;


    $theme_locations = get_nav_menu_locations();
    $main_manu = wp_get_nav_menu_items( $theme_locations['right'] );

    //перебор пунктов меню
    foreach ($main_manu as $item) {
        //in offline menu item
        if (in_array('offline', $item->classes)) {
            $parent_offline = $item->ID;
        }

        //in online worldwide
        if (in_array('online-worldwide', $item->classes)) {
            $parent_online_world = $item->ID;
        }

        // in online prague
        if (in_array('online-prague', $item->classes)) {
            $parent_online_prague = $item->ID;
        }
    }

    //online ВСЕ
    if (!empty($events_online)) {
        foreach ($events_online as $item) {

            $menu_title = get_field('menu_title_event', $item->ID);
            $location = get_field('location_online', $item->ID);

            if (!empty($menu_title)) {
                $set_title = $menu_title;
            } else {
                $set_title = $item->post_title;
            }

            if (!empty($location)) {

                foreach ($location as $value)
                {

                    $parentMain = 0;

                    if ($value == "prague") {
                        $parentMain = $parent_online_prague;
                    }

                    if ($value == "world") {
                        $parentMain = $parent_online_world;
                    }

                    if ( $args->theme_location == 'right' )
                    {
                        $newItem = array(
                            'title'            => $set_title,
                            'menu_item_parent' => $parentMain,
                            'ID'               => $item->ID,
                            'db_id'            => $item->ID,
                            'url'              => get_permalink( $item->ID ),
                            'target' => '',
                            'xfn' => '',
                            'current' => ''
                        );
                        $items[] = (object) $newItem;
                    }

                }
            }
        }
    }




    if(!empty($events_offline)) {
        foreach ( $events_offline as $item ) {
            $menu_title = get_field('menu_title_event', $item->ID);

            if(!empty($menu_title)){
                $set_title = $menu_title;
            }else{
                $set_title= $item->post_title;
            }

            if ( $args->theme_location == 'right' ) {
                $newItemOff= array(
                    'title'            => $set_title,
                    'menu_item_parent' => $parent_offline,
                    'ID'               => $item->ID,
                    'db_id'            => $item->ID,
                    'url'              => get_permalink( $item->ID ),
                    'target' => '',
                    'xfn' => '',
                    'current' => ''
                );
                $items[] = (object) $newItemOff;

            }
        }
    }
    return $items;
}
