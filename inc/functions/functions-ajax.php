<?php
// Subscribe form
add_action('wp_ajax_subscribeForm', 'subscribeForm');
add_action('wp_ajax_nopriv_subscribeForm', 'subscribeForm');

// Order form
add_action('wp_ajax_orderForm', 'orderForm');
add_action('wp_ajax_nopriv_orderForm', 'orderForm');

add_action('wp_ajax_updateMetaDatepicker', 'updateMetaDatepicker_callback');
add_action('wp_ajax_nopriv_updateMetaDatepicker', 'updateMetaDatepicker_callback');

//formBookNow ( include in poPap)
add_action('wp_ajax_actionFormBookNow', 'actionFormBookNow');
add_action('wp_ajax_nopriv_actionFormBookNow', 'actionFormBookNow');

function subscribeForm()
{
    $name = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['tel'];
    $town = $_POST['town'];
    $message = $_POST['message'];

    $post_content = prepare_info($name, $email, $phone, $town, $message);
    $post_data = [
        'post_title' => $name,
        'post_content' => $post_content,
        'post_author' => 1,
        'post_type' => 'subscribers'
    ];

    $headers = 'From: Almost Friday Events <info@almostfridayevents.com>' . "\r\n" . 'Content-Type: text/html; charset=UTF-8';
    $subj = "New message from the contact form";
    $email_admin = "info@almostfridayevents.com";

    mail("$email_admin", "$subj", "$post_content", "$headers");

    wp_insert_post($post_data);

    wp_die();
}

function prepare_info($name, $email, $phone, $town, $message)
{
    ob_start(); ?>

    <h2>Subscribe information:</h2>

    <p>Name: <?php echo $name ?></p>
    <p>Phone: <?php echo $phone ?></p>
    <p>Email: <?php echo $email ?></p>
    <p>Town: <?php echo $town ?></p>
    <h4>Message:</h4>
    <p><?php echo $message ?></p>

    <?php return ob_get_clean();
}

function orderForm()
{
    $type = $_POST['types_of_events'];

    $country = $_POST['country'];

    $event = $_POST['event'];

    $event_type = $_POST['event-type'];

    $event_package = $_POST['event-package'];

    $date = $_POST['event-date'];

    $name = $_POST['name'];
    $company_name = $_POST['company_name'];
    $company_country = $_POST['company_country'];
    $company_address = $_POST['company_address'];
    $company_number = $_POST['company_number'];
    $company_phone = $_POST['company_phone'];
    $company_email = $_POST['company_email'];
    $participants_number = $_POST['participants_number'];

    $message = $_POST['message'];

    $headers = 'From: Almost Friday Events <info@almostfridayevents.com>' . "\r\n" . 'Content-Type: text/html; charset=UTF-8';

    $subj = "Feedback from the registration form";

    $admin_message = order_info($name, $type, $country, $event, $event_type, $event_package, $date, $company_name, $company_country, $company_address, $company_number, $company_phone, $company_email, $participants_number, $message);
    $user_message = success_info($name, $type, $country, $event, $event_type, $event_package, $date, $company_name, $company_country, $company_address, $company_number, $company_phone, $company_email, $participants_number, $message);


    $email_admin = "info@almostfridayevents.com";

    // mail("$email_admin", "$subj", "$admin_message", "$headers");

    $mail1 = mail("$email_admin", "$subj", "$admin_message", "$headers");
    $mail2 = mail("$company_email", "$subj", "$user_message", "$headers");


    $post_content = order_info($name, $type, $country, $event, $event_type, $event_package, $date, $company_name, $company_country, $company_address, $company_number, $company_phone, $company_email, $participants_number, $message);
    $post_data = [
        'post_title' => $company_name,
        'post_content' => $post_content,
        'post_author' => 1,
        'post_type' => 'orders'
    ];

    wp_insert_post($post_data);

    wp_die();
}

function order_info($name, $type, $country, $event, $event_type, $event_package, $date, $company_name, $company_country, $company_address, $company_number, $company_phone, $company_email, $participants_number, $message)
{
    ob_start(); ?>
    <h2>Order information:</h2>

    <p><strong>Type: </strong><?php echo $type ?></p>
    <p><strong>Country: </strong><?php echo ($type == 'Offline') ? 'Prague' : $country ?></p>
    <p><strong>Event: </strong><?php echo $event ?></p>
    <?php if ($type != 'Offline'): ?><p><strong>Event Type: </strong><?php echo $event_type ?></p><?php endif; ?>
    <p><strong>Event Package: </strong><?php echo $event_package ?></p>
    <p><strong>Date: </strong><?php echo $date ?></p>
    <p><strong>Name: </strong><?php echo $name ?></p>
    <p><strong>Phone: </strong><?php echo $company_phone ?></p>
    <p><strong>Email: </strong><?php echo $company_email ?></p>
    <p><strong>Company Name: </strong><?php echo $company_name ?></p>
    <p><strong>Country: </strong><?php echo $company_country ?></p>
    <p><strong>Company Address: </strong><?php echo $company_address ?></p>
    <p><strong>VAT number: </strong><?php echo $company_number ?></p>
    <p><strong>Number of Participants: </strong><?php echo $participants_number ?></p>
    <h3>Message:</h3>
    <p><?php echo $message ?></p>

    <?php return ob_get_clean();
}

function success_info($name, $type, $country, $event, $event_type, $event_package, $date, $company_name, $company_country, $company_address, $company_number, $company_phone, $company_email, $participants_number, $message)
{
    ob_start(); ?>
    <h2>Dear Sir/Madam,</h2>
    <p>Thank you for registering for the event! We have received your registration and our team will contact you
        shortly. Below you can see the details of your registration.</p>

    <p><strong>Type: </strong><?php echo $type ?></p>
    <p><strong>Country: </strong><?php echo ($type == 'Offline') ? 'Prague' : $country ?></p>
    <p><strong>Event: </strong><?php echo $event ?></p>
    <?php if ($type != 'Offline'): ?><p><strong>Event Type: </strong><?php echo $event_type ?></p><?php endif; ?>
    <p><strong>Event Package: </strong><?php echo $event_package ?></p>
    <p><strong>Date: </strong><?php echo $date ?></p>
    <p><strong>Name: </strong><?php echo $name ?></p>
    <p><strong>Phone: </strong><?php echo $company_phone ?></p>
    <p><strong>Email: </strong><?php echo $company_email ?></p>
    <p><strong>Company Name: </strong><?php echo $company_name ?></p>
    <p><strong>Country: </strong><?php echo $company_country ?></p>
    <p><strong>Company Address: </strong><?php echo $company_address ?></p>
    <p><strong>VAT number: </strong><?php echo $company_number ?></p>
    <p><strong>Number of Participants: </strong><?php echo $participants_number ?></p>
    <h3>Message:</h3>
    <p><?php echo $message ?></p>

    <p>Have a good day!</p>
    <p>Almost Friday Team</p>

    <?php return ob_get_clean();
}

function updateMetaDatepicker_callback()
{
    if ($_POST['data'] && $_POST['post_id']) {
        $response = update_post_meta((int)$_POST['post_id'], 'datepicker_value', $_POST['data']);
        wp_send_json_success($response);
    }
    wp_send_json_error();
}

function actionFormBookNow()
{
    $name = $_POST['user_name'];
    $phone = $_POST['user_tel'];
    $email = $_POST['user_email'];

    $post_content = FormBookNow_info($name, $phone, $email);
    $post_data = [
        'post_title' => $name,
        'post_content' => $post_content,
        'post_author' => 1,
        'post_type' => 'orders'
    ];

    wp_insert_post($post_data);


    $message = $_POST['message'];

    $headers = 'From: Almost Friday Events <info@almostfridayevents.com>' . "\r\n" . 'Content-Type: text/html; charset=UTF-8';

    $subj = "Book it Now";

    $admin_message = FormBookNow_info($name, $phone, $email);
    $user_message = FormBookNow_success_info($name, $phone, $email);


    $email_admin = "info@almostfridayevents.com";


    $mail1 = mail("$email_admin", "$subj", "$admin_message", "$headers");
    $mail2 = mail("$email", "$subj", "$user_message", "$headers");

    wp_die();
}

function FormBookNow_info($name, $phone, $email)
{
    ob_start(); ?>
    <h2>Book it Now information:</h2>


    <p><strong>Name: </strong><?php echo $name ?></p>
    <p><strong>Phone: </strong><?php echo $phone ?></p>
    <p><strong>Email: </strong><?php echo $email ?></p>
    <?php return ob_get_clean();
}
function FormBookNow_success_info($name, $phone, $email)
{
    ob_start(); ?>
    <h2>Dear Sir/Madam,</h2>
    <p>Thank you for your inquiry! We have received your inquiry and our team will contact you shortly to clarify all the necessary details and help you to book your event!</p>

    <p><strong>Name: </strong><?php echo $name ?></p>
    <p><strong>Phone: </strong><?php echo $phone ?></p>
    <p><strong>Email: </strong><?php echo $email ?></p>

    <p>Have a good day!</p>
    <p>Almost Friday Team</p>

    <?php return ob_get_clean();
}


