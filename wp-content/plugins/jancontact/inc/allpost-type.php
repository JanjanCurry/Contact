<?php


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
