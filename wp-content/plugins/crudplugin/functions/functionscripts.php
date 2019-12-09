<?php
require MY_PLUGIN_DIRECTORY_PATH . '/functions/create_table.php';


add_action( "wp_ajax_mybook_action", "my_book_ajax_handler" );

function my_book_ajax_handler(){

		global $wpdb;
	if ($_REQUEST['param']=="save_book") {
				$wpdb->insert(Cretetable::table_name(), array(
					"name"=>$_REQUEST['name'],
					"author"=>$_REQUEST['author'],
					"about"=>$_REQUEST['about'],
					"book_image"=>$_REQUEST['image']
				));
				echo json_encode(array("status"=>1,"message"=>"Book Created Successfully"));
	}
	elseif ($_REQUEST['param']=="save_author") {
				$wpdb->insert(Cretetable::table_name_authors(), array(
					"name"=>$_REQUEST['author'],
					"fb_link"=>$_REQUEST['fblink'],
					"about"=>$_REQUEST['about'],
				));
				echo json_encode(array("status"=>1,"message"=>"Author Created Successfully"));
	}
	elseif ($_REQUEST['param']=="save_student") {

				$student_id = $user_id = wp_create_user( $_REQUEST['username'], $_REQUEST['password'], $_REQUEST['email'] );
				$user = new WP_User($student_id);
				$user->set_role("wp_book_user_key");
				$wpdb->insert(Cretetable::table_name_students(), array(
					"name"=>$_REQUEST['name'],
					"email"=>$_REQUEST['email'],
					"user_login_id"=>$user_id,
				));
				echo json_encode(array("status"=>1,"message"=>"Student Created Successfully"));
	}
	elseif ($_REQUEST['param']=="edit_book") {
				$wpdb->update(Cretetable::table_name(), array(
					"name"=>$_REQUEST['name'],
					"author"=>$_REQUEST['author'],
					"about"=>$_REQUEST['about'],
					"book_image"=>$_REQUEST['image']
				),
				array(
					"id" => $_REQUEST['book_id']
				));
				echo json_encode(array("status"=>1,"message"=>"Book Updated Successfully"));
	}
	elseif ($_REQUEST['param']=="delete_book") {
				$wpdb->delete(Cretetable::table_name(),array(
					"id"=>$_REQUEST['id']
				));
				echo json_encode(array("status"=>1,"message"=>"Book Deleted Successfully"));
	}	
	
	elseif ($_REQUEST['param']=="course_tracker") {
				$wpdb->insert(Cretetable::table_name_enroll(), array(
					"student_id"=>$_REQUEST['user_id'],
					"book_id"=>$_REQUEST['book_id']
				));
				echo json_encode(array("status"=>1,"message"=>"Book Deleted Successfully", "book" => $_REQUEST['book_id'] ));
	}	
	
		wp_die();


}


