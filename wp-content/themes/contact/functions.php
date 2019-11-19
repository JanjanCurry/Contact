<?php 


function sunset_load_scripts(){
	
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6', 'all' );
	wp_enqueue_style('bootstrap');
	wp_register_style( 'contact', get_template_directory_uri() . '/css/contact.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('contact');

	wp_register_script( 'jquery' , get_template_directory_uri() . '/js/jquery.js', false, '1.11.3', true );
	wp_enqueue_script( 'jquery' );

	wp_register_script( 'bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true );
	wp_enqueue_script('bootstrapjs');

	wp_register_script( 'contactjs', get_template_directory_uri() . '/js/contact.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'contactjs' );
	
}
add_action( 'wp_enqueue_scripts', 'sunset_load_scripts' );


// CUSTOM POST TYPES
function custom_contact(){
	register_post_type( 'custom-contact',
			array(
				'labels' => array(
					'name' => ('Messages'),
					'singular_name' => ('Message'),
					'menu_name' => ('Messages'),
					'name_admin_bar' => ('Message'),
					'not_found' => ('No Contact Found'),
				),
				'menu_icon' => 'dashicons-email-alt',
				'show_in_menu' => true,
				'menu_position' => 4,
				'hierarchial' => false,
				'show_ui' => true,
				'capability_type' => 'post',
				'supports' => array('title', 'editor',),
				
			));

}
add_action( 'init', 'custom_contact');
// SET COLUMNS
function set_contact_columns(){
$newColumns = array();
$newColumns['title'] = 'Full Name';
$newColumns['message'] = 'Message';
$newColumns['email'] = 'Email';
$newColumns['number'] = 'Phone Number';
$newColumns['date'] = 'Date';
return $newColumns;
}
add_filter( 'manage_custom-contact_posts_columns', 'set_contact_columns');
// CUSTOM COLUMNS
function contact_custom_column($column, $post_id){
switch ($column) {
	case 'message':
		echo get_the_excerpt();
		break;
	
	case 'email':
		echo $value = get_post_meta( $post_id, '_contact_email_value_key', true );
		break;

	case 'number':
		echo $value = get_post_meta( $post_id, '_contact_phonenumber_value_key', true );
		break;
}
}
add_action( 'manage_custom-contact_posts_custom_column', 'contact_custom_column', 10, 2);

// METABOX
function contact_email_metabox_function()
{
	add_meta_box( 'contact_email', 'Contact Email', 'contact_email_callback','custom-contact','side');
	add_meta_box( 'contact_phonenumber', 'Contact Phone Number', 'contact_phonenumber_callback','custom-contact','side');
}
function contact_phonenumber_callback( $post ){
wp_nonce_field( 'contact_save_phonenumber_data', 'contact_phonenumber_box_nonce');
	$value = get_post_meta( $post->ID, '_contact_phonenumber_value_key', true );
	echo '<label for="contact_phonenumber_field"> Phone Number Here</label>';
	echo '<input type="text" id="contact_phonenumber_field" name="contact_phonenumber_field" value=" '. esc_attr( $value ) . '" size="25">';	
}
function contact_email_callback( $post )
{
	wp_nonce_field( 'contact_save_email_data', 'contact_email_box_nonce');
	$value = get_post_meta( $post->ID, '_contact_email_value_key', true );
	echo '<label for="contact_email_field"> Email Address Here</label>';
	echo '<input type="text" id="contact_email_field" name="contact_email_field" value=" '. esc_attr( $value ) . '" size="25">';
}
add_action( 'add_meta_boxes', 'contact_email_metabox_function');


// SAVE METABOX
function contact_save_email_data ( $post_id ) {
	if ( ! isset( $_POST['contact_email_box_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['contact_email_box_nonce'], 'contact_save_email_data' )) {
		return;
	}
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id )) {
		return;
	}
	if ( ! isset( $_POST['contact_email_field'] ) ) {
		return;
	}

	$my_data = sanitize_text_field( $_POST['contact_email_field'] );
	update_post_meta( $post_id, '_contact_email_value_key', $my_data );
}
add_action( 'save_post', 'contact_save_email_data');


function contact_save_phonenumber_data ( $post_id ) {
	if ( ! isset( $_POST['contact_email_box_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['contact_phonenumber_box_nonce'], 'contact_save_phonenumber_data' )) {
		return;
	}
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id )) {
		return;
	}
	if ( ! isset( $_POST['contact_phonenumber_field'] ) ) {
		return;
	}

	$my_data = sanitize_text_field( $_POST['contact_phonenumber_field'] );
	update_post_meta( $post_id, '_contact_phonenumber_value_key', $my_data );
}
add_action( 'save_post', 'contact_save_phonenumber_data');


function contact_shortcode( $atts, $content= null ){

$atts = shortcode_atts( 
		array(),
		$atts,
		'contact_form'
);


ob_start();
include 'inc/contact-form.php';
$myvariable = ob_get_clean();
return $myvariable;
}


add_shortcode( 'contact_form', 'contact_shortcode');



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

add_action('phpmailer_init', 'mailtrap');

