<?php  

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * 
 */

// if ( !class_exists( 'Save_Contact' ) ) {
// class Save_Contact {
	


add_action('wp_ajax_nopriv_save_user_contact_form', 'save_contact');
add_action('wp_ajax_save_user_contact_form', 'save_contact');




function save_contact()
{ 
//	if (isset($_POST['submit'])) {
		$title = wp_strip_all_tags($_POST['name']);
		$email = wp_strip_all_tags($_POST['email']);
		$message = wp_strip_all_tags($_POST['message']);
		$number = wp_strip_all_tags($_POST['number']);

echo $title . $email . $message;

	
	$args = array(
		'post_title' => $title,
		'post_content' => $message,
		'post_type' => 'custom-contact',
		'post_status' => 'publish',
		'meta_input' => array(
			'_contact_email_value_key' => $email,
			'_contact_phonenumber_value_key' => $number
		)
	);
$postID = wp_insert_post($args);
echo $postID;

    if ($postID !== 0) {
        $to = get_bloginfo('admin_email');
        $subject = 'Contact Form - '.$title;

        $headers[] = 'From: '.get_bloginfo('name').' <'.$to.'>'; 
        $headers[] = 'Reply-To: '.$title.' <'.$email.'>';
        $headers[] = 'Content-Type: text/html: charset=UTF-8';

        wp_mail($to, $subject, $message, $headers);

    }

die();
	}


function mailtrap($phpmailer) {
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '156e9fa096c8a2';
  $phpmailer->Password = '53eb3902fa30cf';
}

//add_action('phpmailer_init', 'mailtrap');


//}

