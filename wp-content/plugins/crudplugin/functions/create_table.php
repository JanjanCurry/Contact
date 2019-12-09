<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * 
 */
if ( !class_exists( 'Cretetable' ) ) {
class Cretetable {

function table_name(){
	global $wpdb;
	return $wpdb->prefix."my_books";//TABLE NAME


}

function table_name_authors(){
	global $wpdb;
	return $wpdb->prefix."my_authors";//TABLE NAME


}

function table_name_students(){
	global $wpdb;
	return $wpdb->prefix."my_students";//TABLE NAME


}

function table_name_enroll(){
	global $wpdb;
	return $wpdb->prefix."my_enroll";//TABLE NAME


}
function create_scripts(){
		global $wpdb;
	$table_name = $wpdb->prefix."my_books";
	$table_name_authors = $wpdb->prefix."my_authors";
	$table_name_students = $wpdb->prefix."my_students";
	$table_name_enroll = $wpdb->prefix."my_enroll";
	require_once ABSPATH.'wp-admin/includes/upgrade.php';
	$sql = "
		CREATE TABLE ".  $table_name ."(
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) NOT NULL,
 `author` varchar(255) NOT NULL,
 `about` text NOT NULL,
 `book_image` text NOT NULL,
 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
	";
	dbDelta($sql);

	$sql1 = "
	CREATE TABLE ".  $table_name_authors ."(
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(250) NOT NULL,
 `fb_link` text NOT NULL,
 `about` text NOT NULL,
 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
";
	dbDelta($sql1);

	$sql2 = "
CREATE TABLE ".  $table_name_students ."(
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) NOT NULL,
 `email` varchar(255) NOT NULL,
 `user_login_id` int(11) NOT NULL,
 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
";
	dbDelta($sql2);

	$sql3 = "
CREATE TABLE ".  $table_name_enroll ."(
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `student_id` int(11) NOT NULL,
 `book_id` int(11) NOT NULL,
 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	dbDelta($sql3);

add_role( "wp_book_user_key", "My Book User", array(
	"read" => true,
) );

$my_post = array(
'post_title' => "Book Page",
'post_content' => "[book_page]",
'post_status' => "publish",
'post_type' => "page",
'post_name' => 'my_book'
);
$book_id = wp_insert_post( $my_post );
add_option( "my_book_page_id", $book_id );

$my_post1 = array(
'post_title' => "Book Page Content",
'post_content' => "[book_page_content]",
'post_status' => "publish",
'post_type' => "page",
'post_name' => 'my_book_content'
);
$book_id = wp_insert_post( $my_post1 );
add_option( "my_book_page_content_id", $book_id );
}


}

}
