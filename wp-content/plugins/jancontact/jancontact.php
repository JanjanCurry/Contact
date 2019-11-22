<?php
/**
 * @package Jancontact
 */
/*
Plugin Name: Jan Contact
Plugin URI: https://jancontact.com/
Description: My first attempt in creating a plugin
Version: 4.1.3
Author: Janjan Curry
Author URI: https://facebook.com
License: GPLv2 or later
Text Domain: jancontact
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



require plugin_dir_path( __FILE__ ) . 'inc/allshort-codes.php';
require plugin_dir_path( __FILE__ ) . 'inc/savecontacts.php';
require plugin_dir_path( __FILE__ ) . 'inc/column.php';


register_activation_hook( __FILE__, 'activate_contact_form' );

register_deactivation_hook( __FILE__, 'deactivate_contact_form[' );


function activate_contact_form() {
	contact_init();
	contact_metabox();
	allenqueue();


	flush_rewrite_rules();
}

function deactivate_contact_form() {
	
	require_once plugin_dir_path( __FILE__ ) . 'inc/enqueue.php';
	Allenqueue::unloadscripts();
	
	require_once plugin_dir_path( __FILE__ ) . 'inc/allpost-type.php';
	Posttypes::unregister_posttype_custom_contact();
	     
     flush_rewrite_rules();
}

require plugin_dir_path( __FILE__ ) . 'inc/allmetabox.php';
	
function contact_init()
{
	require plugin_dir_path( __FILE__ ) . 'inc/allpost-type.php';	
	Posttypes::custom_contact();
}
add_action( 'init', 'contact_init' );


function contact_metabox(){
	add_meta_box( 'contact_email', 'Contact Email', 'this_contact_email_callback','custom-contact','side');
	add_meta_box( 'contact_phonenumber', 'Contact Phone Number', 'this_contact_phonenumber_callback','custom-contact','side');
}

function this_contact_email_callback($post){

	Metabox::contact_phonenumber_callback($post);
	
}
function this_contact_phonenumber_callback($post){
	Metabox::contact_email_callback($post);
	}
	add_action( 'add_meta_boxes', 'contact_metabox');



function allenqueue(){

	require plugin_dir_path( __FILE__ ) . 'inc/enqueue.php';
	Allenqueue::sunset_load_scripts();
	
}
add_action( 'wp_enqueue_scripts', 'allenqueue' );

 function save_email(){
 	require plugin_dir_path( __FILE__ ) . 'inc/allmetabox.php';
	Metabox::contact_save_email_data();
 }

 function save_phonenumber(){
 	require plugin_dir_path( __FILE__ ) . 'inc/allmetabox.php';
	Metabox::contact_save_phonenumber_data();
 }
