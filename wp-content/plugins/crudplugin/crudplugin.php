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


// TABLE NAME
	require MY_PLUGIN_DIRECTORY_PATH . '/functions/create_table.php';

function my_book_table(){
Cretetable::table_name();
}
// CREATE TABLE UPON ACTIVATION
function my_book_creates_table_scripts(){
Cretetable::create_scripts();
	}

// DROP TABLE UPON DEACTIVATION
function my_book_drop_table_scripts(){
	global $wpdb;
	$wpdb->query(
		"DROP TABLE IF EXISTS " . Cretetable::table_name()
	);	
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

