<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * 
 */
if ( !class_exists( 'Allenqueue' ) ) {
class Allenqueue {
	


function crud_load_enqueue_scripts(){
	

	wp_register_style( 'bootstrap', MY_PLUGIN_DIRECTORY_URL . 'assets/css/bootstrap.min.css', array(), '3.3.6', 'all' );
	wp_enqueue_style('bootstrap');
	wp_register_style( 'crud', MY_PLUGIN_DIRECTORY_URL . 'assets/css/crud.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('crud');
	wp_register_style( 'datatable', MY_PLUGIN_DIRECTORY_URL  . 'assets/css/datatables.min.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('datatable');
	wp_register_style( 'notifybar', MY_PLUGIN_DIRECTORY_URL  . 'assets/css/jquery.notifyBar.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('notifybar');


	wp_register_script( 'jquery' , MY_PLUGIN_DIRECTORY_URL . 'assets/js/jquery.js', false, '1.11.3', true );
	wp_enqueue_script( 'jquery' );
	wp_register_script( 'bootstrapjs', MY_PLUGIN_DIRECTORY_URL  . 'assets/js/bootstrap.min.js', array('jquery'), '3.3.6', true );
	wp_enqueue_script('bootstrapjs');
	wp_register_script( 'crudjs', MY_PLUGIN_DIRECTORY_URL  . 'assets/js/crud.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'crudjs' );
	wp_register_script( 'datatablejs', MY_PLUGIN_DIRECTORY_URL  . 'assets/js/datatables.min.js', array(), '1.0.0', true );
	wp_enqueue_script('datatablejs');
	wp_register_script( 'notifybarjs', MY_PLUGIN_DIRECTORY_URL  . 'assets/js/jquery.notifyBar.js', array(), '1.0.0', true );
	wp_enqueue_script('notifybarjs');
	wp_register_script( 'validate', MY_PLUGIN_DIRECTORY_URL  . 'assets/js/validate.min.js', array(), '1.0.0', true );
	wp_enqueue_script('validate');
	wp_localize_script( "crudjs", "mybookajaxurl", admin_url("admin-ajax.php"));
}


function unloadscripts(){

	 wp_dequeue_style( 'bootstrap' );
     wp_deregister_style( 'bootstrap' );
   	 wp_dequeue_style( 'crud' );
     wp_deregister_style( 'crud' );
   	 wp_dequeue_style( 'datatable' );
     wp_deregister_style( 'datatable' );
   	 wp_dequeue_style( 'notifybar' );
     wp_deregister_style( 'notifybar' );    

    


     wp_deregister_script( 'jquery' );
     wp_dequeue_script( 'jquery' );    
     wp_deregister_script( 'bootstrapjs' );
     wp_dequeue_script( 'bootstrapjs' );    
     wp_deregister_script( 'crudjs' );
     wp_dequeue_script( 'crudjs' );
     wp_deregister_script( 'datatablejs' );
     wp_dequeue_script( 'datatablejs' );
     wp_deregister_script( 'notifybarjs' );
     wp_dequeue_script( 'notifybarjs' );    
     wp_deregister_script( 'validate' );
     wp_dequeue_script( 'validate' );
}
}

}
