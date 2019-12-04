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
	}elseif ($_REQUEST['param']=="edit_book") {
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
		wp_die();


}
