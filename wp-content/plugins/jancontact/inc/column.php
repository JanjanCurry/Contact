<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


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
