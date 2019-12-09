<?php
/**
 * @package Crudplugin
 */
/*
Plugin Name: Crud Plugin
Plugin URI: https://crudplugin.com/
Description: This is a crud plugin
Version: 1.0.0
Author: Janjan Curry
Author URI: https://facebook.com
License: GPLv2 or later
Text Domain: crudplugin
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


if (! defined('MY_PLUGIN_DIRECTORY_PATH')) {
	define('MY_PLUGIN_DIRECTORY_PATH', plugin_dir_path(__FILE__));
}
if (! defined('MY_PLUGIN_DIRECTORY_URL')) {
	define('MY_PLUGIN_DIRECTORY_URL', plugin_dir_URL(__FILE__));
}



register_activation_hook( __FILE__, "activate_crud_plugin" );

function activate_crud_plugin() {
my_book_creates_table_scripts();
crud_load_scripts();
}
	

// ENQUEUE SCRIPT IN INIT
function crud_load_scripts(){
	
	require MY_PLUGIN_DIRECTORY_PATH . '/functions/enqueue.php';
	Allenqueue::crud_load_enqueue_scripts();
}
add_action( 'init', 'crud_load_scripts' );


// MENUS
function my_book_plugin_menus(){
	require MY_PLUGIN_DIRECTORY_PATH . '/functions/menus.php';
	Allmenu::crud_menus();

}
add_action( "admin_menu", "my_book_plugin_menus");

function book_list()
{
	require MY_PLUGIN_DIRECTORY_PATH . '/views/book-list.php';
}

function add_new_book()
{
	require MY_PLUGIN_DIRECTORY_PATH . '/views/add-book.php';
}

function edit_new_book()
{
	require MY_PLUGIN_DIRECTORY_PATH . '/views/edit-book.php';
}

function add_new_author()
{
	require MY_PLUGIN_DIRECTORY_PATH . '/views/add-author.php';
}

function remove_author()
{
	require MY_PLUGIN_DIRECTORY_PATH . '/views/manage-author.php';
}

function add_new_student()
{
	require MY_PLUGIN_DIRECTORY_PATH . '/views/add-student.php';
}

function remove_students()
{
	require MY_PLUGIN_DIRECTORY_PATH . '/views/manage-student.php';
}

function course_tracker()
{
	require MY_PLUGIN_DIRECTORY_PATH . '/views/course-tracker.php';
}




// TABLE NAME
	require MY_PLUGIN_DIRECTORY_PATH . '/functions/create_table.php';

function my_book_table(){
Cretetable::table_name();
}
// CREATE TABLE UPON ACTIVATION
function my_book_creates_table_scripts(){
Cretetable::create_scripts();
	}

// SHORTCODES
	function my_shortcode()
	{
		require MY_PLUGIN_DIRECTORY_PATH . '/views/my_books_frontend_lists.php';
	}
	add_shortcode( "book_page", "my_shortcode" );
	function my_shortcode_content()
	{
		require MY_PLUGIN_DIRECTORY_PATH . '/views/my_books_frontend_content.php';
	}
	add_shortcode( "book_page_content", "my_shortcode_content" );
// DROP TABLE UPON DEACTIVATION
function my_book_drop_table_scripts(){
	global $wpdb;
	$wpdb->query(
		"DROP TABLE IF EXISTS " . Cretetable::table_name()
	);
	$wpdb->query(
		"DROP TABLE IF EXISTS " . Cretetable::table_name_authors()
	);
	$wpdb->query(
		"DROP TABLE IF EXISTS " . Cretetable::table_name_students()
	);
	$wpdb->query(
		"DROP TABLE IF EXISTS " . Cretetable::table_name_enroll()
	);	
	//DELETE USER ROLE
	if (get_role( "wp_book_user_key" )) {
		remove_role( "wp_book_user_key" );
	}
	//DELETE PAGE
	if (!empty(get_option( "my_book_page_id" ))) {
		$page_id = get_option( "my_book_page_id" );
		wp_delete_post( $page_id, true );
		delete_option( "my_book_page_id" );
	}

}

register_deactivation_hook( __FILE__, "deactivate_crud_plugin" );


function deactivate_crud_plugin() {
	
	my_book_drop_table_scripts();
	require MY_PLUGIN_DIRECTORY_PATH . '/functions/enqueue.php';
	Allenqueue::unloadscripts();
	
	
     flush_rewrite_rules();
}


// AJAX REQUESTS
require MY_PLUGIN_DIRECTORY_PATH . '/functions/functionscripts.php';

add_filter( "page_template", "front_page_layout" );

function front_page_layout($page_template){
	global $post;
	$page_slug = $post->post_name;
	if ($page_slug == "my_book") {
		$page_template = MY_PLUGIN_DIRECTORY_PATH . '/views/frontend-book-template.php';
	}
	return $page_template;
}


add_filter( "page_template", "book_content_front_page_layout" );

function book_content_front_page_layout($page_template){
	global $post;
	$page_slug = $post->post_name;
	if ($page_slug == "my_book_content") {
		$page_template = MY_PLUGIN_DIRECTORY_PATH . '/views/frontent_book_content_template.php';
	}
	return $page_template;
}

function get_author_details($author_id){
	global $wpdb;
	$author_details = $wpdb->get_row(
		$wpdb->prepare(
				"select * from " . Cretetable::table_name_authors()
 . " WHERE id = %d", $author_id
		),ARRAY_A
	); 
	return $author_details;
}
function get_student_details($student_id){
	global $wpdb;
	$student_details = $wpdb->get_row(
		$wpdb->prepare(
				"select * from " . Cretetable::table_name_students()
 . " WHERE id = %d", $student_id
		),ARRAY_A
	); 
	return $author_details;
}

function crud_login_user_role_filter($redirect_to,$request,$user){
		global $user;
		if(isset($user->roles) && is_array($user->roles)){
			if (in_array("wp_book_user_key", $user->roles)) {
				return $redirect_to = site_url() . "/my_book";
			}else{
				return $redirect_to = site_url() . "/wp-admin";
			}
		}
}
add_filter( "login_redirect", "crud_login_user_role_filter", 10, 3 );

function crud_logout_user_role_filter(){
wp_redirect(site_url() . "/my_book");
exit();
}
add_filter( "wp_logout", "crud_logout_user_role_filter");