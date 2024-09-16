<?php
// Get Current Event type ( online/offline)
add_action('wp_ajax_getCurrentEventType', 'getCurrentEventType');
add_action('wp_ajax_nopriv_getCurrentEventType', 'getCurrentEventType');

// Get Current Country
add_action('wp_ajax_getCurrentCountry', 'getCurrentCountry');
add_action('wp_ajax_nopriv_getCurrentCountry', 'getCurrentCountry');

// Get Current Event
add_action('wp_ajax_getCurrentEvent', 'getCurrentEvent');
add_action('wp_ajax_nopriv_getCurrentEvent', 'getCurrentEvent');

// Get Current Type
add_action('wp_ajax_getCurrentType', 'getCurrentType');
add_action('wp_ajax_nopriv_getCurrentType', 'getCurrentType');

function getCurrentEventType() {

    global $SVG;
    $current_types_of_events = $_POST['data'];
    $events = get_field('events_list',18);


    if ( is_array( $events )):

        ob_start();

        if ( $current_types_of_events === 'Offline') {
            if ( $events ) {
                foreach ( $events as $event ) {
                    $svg = get_field('svg_name', $event->ID);
                    $content = get_field('preview_content', $event->ID);
                    ?>
                    <div class="item" data-event-id="<?php echo $event->ID ?>">
                        <h3 class="title"><?php echo $event->post_title ?></h3>
                        <?php
                        if ( $svg ) {
                            echo $SVG[$svg];
                        }
                        else {
                            echo $SVG['Yoga'];
                        }
                        ?>
                        <div class="description">
                            <?php
                            if ($content) {
                                echo wp_trim_words($content, 15, ' ...');
                            }
                            ?>
                        </div>
                        <div>
                            <a href="javascript:void(0)"  style="color: #fff;text-decoration-line: underline;text-transform: capitalize; text-align: center;" class="buttonClickHere">click here</a>
                        </div>
                    </div>
                    <?php
                }
            }
        }

        $response = ob_get_clean();
        wp_send_json_success($response);

    else:
        wp_send_json_error();
    endif;
}

function getCurrentCountry() {

    global $SVG;
    $current_country = $_POST['data'];
    $events_online = get_field('events_list',16);
    $event_type = get_posts( array('posts_per_page' => -1, 'post_type' => 'event_type'));
    $events     = get_posts( array('posts_per_page' => -1, 'post_type' => 'events'));

    if ( is_array( $event_type )):

        ob_start();

        $needed_event_types_prague = [];
        $needed_event_types_world = [];

        foreach ( $event_type as $type )
        {

            $location = get_field('packages', $type->ID);

            foreach ($location as $single_location)
            {
                if ($single_location['location'] === 'prague') {
                    array_push($needed_event_types_prague, $type->ID);
                    $needed_event_types_prague = array_unique($needed_event_types_prague);
                }
                array_push($needed_event_types_world, $type->ID);
                $needed_event_types_world = array_unique($needed_event_types_world);
            }

        }

        if ( $current_country === 'Prague')
        {
            $correct_arr = array_unique($needed_event_types_prague);
        }
        else{
            $correct_arr = array_unique($needed_event_types_world);
        }

        if ( $events_online ) {
            $final_events = [];

            foreach ( $events_online as $event ) {

                $choose_type = get_field( 'choose_type' , $event->ID);

                foreach ( $choose_type as $item)
                {
                    if ( in_array( $item->ID, $correct_arr ) )
                    {
                        array_push($final_events, $event->ID);
                    }
                    continue;
                }

            }

            $result = array_unique($final_events);

            foreach ( $events as $event ) {
                if ( in_array($event->ID, $result) ) {
                    $svg = get_field('svg_name', $event->ID);
                    $content = get_field('preview_content', $event->ID);
                    ?>

                    <div class="item" data-event-id="<?php echo $event->ID ?>">
                        <h3 class="title"><?php echo $event->post_title ?></h3>
                        <?php
                            if ( $svg ) {
                                echo $SVG[$svg];
                            }
                            else {
                                echo $SVG['Yoga'];
                            }
                        ?>
                        <div class="description">
                            <?php
                                if ($content) {
                                    echo wp_trim_words($content, 15, ' ...');
                                }
                            ?>
                        </div>
                        <div>
                        <a href="javascript:void(0)"  style="color: #fff;text-decoration-line: underline;text-transform: capitalize; text-align: center;" class="buttonClickHere">click here</a>
                        </div>
                    </div>

                    <?php
                }
            }
        }

        $response = ob_get_clean();
        wp_send_json_success($response);

    else:
        wp_send_json_error();
    endif;
}

function getCurrentEvent() {
    global $SVG;
    $event_type_id = $_POST['data'];
    $current_country = $_POST['country'];
    $type_event =$_POST['type_event'];

    $packages_offline = get_field('packages_offline', $event_type_id);

    $event_type = get_field('choose_type', $event_type_id);

    if($type_event == 'Online'):
        ob_start();
        if ( is_array($event_type) ) :
            $needed_event_types_prague = [];
            $needed_event_types_world = [];

            foreach ( $event_type as $type )
            {

                $location = get_field('packages', $type->ID);

                foreach ($location as $single_location)
                {
                    if ($single_location['location'] === 'prague') {
                        array_push($needed_event_types_prague, $type->ID);
                        $needed_event_types_prague = array_unique($needed_event_types_prague);
                    }
                    array_push($needed_event_types_world, $type->ID);
                    $needed_event_types_world = array_unique($needed_event_types_world);
                }

            }

            if ( $current_country === 'Prague')
            {
                $correct_arr = array_unique($needed_event_types_prague);
            }
            else{
                $correct_arr = array_unique($needed_event_types_world);
            }

            foreach ( $event_type as $item ) {
                if ( in_array($item->ID, $correct_arr) ) {
                    $svg = get_field('svg_name', $item->ID);
                    $content = get_field('preview_content', $item->ID);
                    ?>

                    <div class="item" data-type-id="<?php echo $item->ID ?>">

                        <a href="#" class="type" >

                            <h3 class="title"><?php echo $item->post_title ?></h3>

                            <div class="svg">

                                <?php

                                if ($svg) {
                                    echo $SVG[$svg];
                                } else {
                                    echo $SVG['Yoga'];
                                }

                                ?>

                            </div>

                            <div class="description"><?php echo wp_trim_words($content, 17, ' ...'); ?></div>
                            <div>
                                <a href="javascript:void(0)"  style="color: #fff;text-decoration-line: underline;text-transform: capitalize; text-align: center;" class="buttonClickHere">click here</a></div>
                        </a>

                    </div>

                    <?php
                }
            }

            $response = ob_get_clean();
            wp_send_json_success($response);
        endif;
    elseif($type_event == 'Offline'):
        ob_start();
    ?>
        <script>
            let dates_array = <?php echo json_encode( get_post_meta( $event_type_id, 'datepicker_value', true ) ); ?>;
        </script>
    <?php
        foreach ( $packages_offline as $item ) {
                ?>

                <div class="package">
                    <h3 class="title"><?php echo $item['name'] ?></h3>
                    <div class="price"><?php echo $item['price'] ?></div>
                    <div class="content"><?php echo $item['content'] ?></div>
                </div>
                <?php
        }

        $response = ob_get_clean();
        wp_send_json_success($response);
    else:
        wp_send_json_error();

    endif;

}

function getCurrentType()
{
    $event_package_id = $_POST['data'];
    $current_country = $_POST['country'];

    $event_package = get_field('packages', $event_package_id);

    if ( is_array($event_package) ) :

        ob_start();

        ?>
        <script>
            let dates_array = <?php echo json_encode( get_post_meta( $event_package_id, 'datepicker_value', true ) ); ?>;
        </script>
        <?php

        if ( $current_country != 'Prague') {

            foreach ($event_package as $item):

                    ?>
                    <div class="package">
                        <h3 class="title"><?php echo $item['name'] ?></h3>
                        <div class="price"><?php echo $item['price'] ?></div>
                        <div class="content"><?php echo $item['content'] ?></div>
                    </div>
                    <?php

            endforeach;

        }

        else {
            foreach ($event_package as $item):
                ?>
                <div class="package">
                    <h3 class="title">
                        <?php echo $item['name'] ?>

                        <?php if($item['location'] === 'prague'): ?>
                            <span><?php echo $item['location'] ?></span>
                        <?php endif; ?>
                    </h3>
                    <div class="price"><?php echo $item['price'] ?></div>
                    <div class="content"><?php echo $item['content'] ?></div>
                </div>
            <?php
            endforeach;
        }

        $response = ob_get_clean();
        wp_send_json_success($response);

    else:
        wp_send_json_error();
    endif;

}


