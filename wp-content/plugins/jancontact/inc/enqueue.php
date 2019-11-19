<?php
function sunset_load_scripts(){
	
	wp_register_style( 'bootstrap', plugin_dir_url( __FILE__ ) . '/css/bootstrap.min.css', array(), '3.3.6', 'all' );
	wp_enqueue_style('bootstrap');
	wp_register_style( 'contact', plugin_dir_url( __FILE__ )  . '/css/contact.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('contact');

	wp_register_script( 'jquery' , plugin_dir_url( __FILE__ ) . '/js/jquery.js', false, '1.11.3', true );
	wp_enqueue_script( 'jquery' );

	wp_register_script( 'bootstrapjs', plugin_dir_url( __FILE__ )  . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true );
	wp_enqueue_script('bootstrapjs');

	wp_register_script( 'contactjs', plugin_dir_url( __FILE__ )  . '/js/contact.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'contactjs' );
	
}
add_action( 'wp_enqueue_scripts', 'sunset_load_scripts' );

