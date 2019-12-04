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

function create_scripts(){
		global $wpdb;
	$table_name = $wpdb->prefix."my_books";
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


}


}

}
