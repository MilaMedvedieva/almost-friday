<?php
## Добавляем блоки в основную колонку на страницах постов и пост. страниц
add_action('add_meta_boxes', 'myplugin_add_custom_box');
function myplugin_add_custom_box(){
    global $post;

    add_meta_box( 'myplugin_sectionid', 'Choose a date', 'myplugin_meta_box_callback', 'event_type' );

}
// HTML код блока
function myplugin_meta_box_callback( $post){

    $post_id = $post->ID;
    $meta_values = get_post_meta( $post_id, 'datepicker_value', true );

    ?>
    <div id="datepicker"></div>
    <input type="hidden" name="datepicker_value" id="datepicker_value" value="<?php echo $meta_values ?>">



    <script type="text/javascript">
        let dates = [];
            dates = <?php echo json_encode( get_post_meta( $post_id, 'datepicker_value', true ) ); ?>;
        if ( isEmpty(dates) ){
             dates = new Array();
        }

        function addDate(date) {
            if (jQuery.inArray(date, dates) < 0)
                dates.push(date);
        }

        function removeDate(index) {
            dates.splice(index, 1);
        }

        // Adds a date if we don't have it yet, else remove it
        function addOrRemoveDate(date) {
            var index = jQuery.inArray(date, dates);
            if (index >= 0)
                removeDate(index);
            else
                addDate(date);

        }

        function isEmpty(value){
            return (value == null || value.length === 0);
        }
        // Takes a 1-digit number and inserts a zero before it
        function padNumber(number) {
            var ret = new String(number);
            if (ret.length == 1)
                ret = "0" + ret;
            return ret;
        }

        jQuery(function () {
            jQuery("#datepicker").datepicker({
                dateFormat: 'd.mm.yy', // Unix timestamp
                onSelect: function(dateText, inst){
                    console.log(dateText);
                    addOrRemoveDate(dateText);
                    console.log(dates)
                    // jQuery("#datepicker_value").val(dates);
                    jQuery.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'updateMetaDatepicker',
                            data: dates,
                            post_id: <?php echo $post->ID ?>
                        },
                        success:function(response) {
                            console.log( 'success', response.data );
                        },
                        complete: function (data) {
                            //console.log( 'complete', data);
                        },
                        error:function(data) {
                            console.log( 'error', data);
                        }
                    });

                },
                beforeShowDay: function(date){
                    var gotDate = jQuery.inArray(jQuery.datepicker.formatDate(jQuery(this).datepicker('option', 'dateFormat'), date), dates);
                    if (gotDate >= 0) {
                        return [true,"ui-state-highlight", "Available"];
                    }
                    return [true, ""];
                }
            });
        });
    </script>
    <?php
}


## Добавляем блоки в основную колонку на страницах постов и пост. страниц
add_action('add_meta_boxes', 'event_offline_datepicker');
function event_offline_datepicker(){
    global $post;
    $post_id = $post->ID;
    $post_type = get_post_type($post_id);
    $post_taxonomy = get_object_taxonomies( array( 'post_type' => $post_type ) )[0];
    $terms = get_the_terms( $post_id, $post_taxonomy );
	add_meta_box( 'my_datepicker', 'Choose a date', 'set_event_datepicker', 'events' );
//     if($terms[0]->name == 'offline'){
//         add_meta_box( 'my_datepicker', 'Choose a date', 'set_event_offline_datepicker', 'events' );
//     }
}
// HTML код блока
function set_event_datepicker( $post){

    $post_id = $post->ID;
    $meta_values = get_post_meta( $post_id, 'datepicker_value', true );

    ?>
    <div id="datepicker"></div>
    <input type="hidden" name="datepicker_value" id="datepicker_value" value="<?php echo $meta_values ?>">
    <script type="text/javascript">
        let dates = [];
        dates = <?php echo json_encode( get_post_meta( $post_id, 'datepicker_value', true ) ); ?>;
        if ( isEmpty(dates) ){
            dates = new Array();
        }

        function addDate(date) {
            if (jQuery.inArray(date, dates) < 0)
                dates.push(date);
        }

        function removeDate(index) {
            dates.splice(index, 1);
        }

        // Adds a date if we don't have it yet, else remove it
        function addOrRemoveDate(date) {
            var index = jQuery.inArray(date, dates);
            if (index >= 0)
                removeDate(index);
            else
                addDate(date);

        }

        function isEmpty(value){
            return (value == null || value.length === 0);
        }
        // Takes a 1-digit number and inserts a zero before it
        function padNumber(number) {
            var ret = new String(number);
            if (ret.length == 1)
                ret = "0" + ret;
            return ret;
        }

        jQuery(function () {
            jQuery("#datepicker").datepicker({
                dateFormat: 'd.mm.yy', // Unix timestamp
                onSelect: function(dateText, inst){
                    console.log(dateText);
                    addOrRemoveDate(dateText);
                    console.log(dates)
                    // jQuery("#datepicker_value").val(dates);
                    jQuery.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'updateMetaDatepicker',
                            data: dates,
                            post_id: <?php echo $post->ID ?>
                        },
                        success:function(response) {
                            console.log( 'success', response.data );
                        },
                        complete: function (data) {
                            //console.log( 'complete', data);
                        },
                        error:function(data) {
                            console.log( 'error', data);
                        }
                    });

                },
                beforeShowDay: function(date){
                    var gotDate = jQuery.inArray(jQuery.datepicker.formatDate(jQuery(this).datepicker('option', 'dateFormat'), date), dates);
                    if (gotDate >= 0) {
                        return [true,"ui-state-highlight", "Available"];
                    }
                    return [true, ""];
                }
            });
        });
    </script>
    <?php
}

