<?php  

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * 
 */

if ( !class_exists( 'Metabox' ) ) {
class Metabox {
	

// METABOX
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

//add_action( 'add_meta_boxes', 'contact_email_metabox_function');


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
//add_action( 'save_post', 'contact_save_email_data');


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
//add_action( 'save_post', 'contact_save_phonenumber_data');

}
}

