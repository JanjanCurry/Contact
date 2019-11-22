<?php
/**
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

	
	

function simple_shortcode(){
	$info = "This is a simple site";
	return $info;
}
//	add_shortcode( 'simple', 'simple_shortcode' );

function contact_shortcode( $atts, $content= null ){

$atts = shortcode_atts( 
		array(),
		$atts,
		'contact_form'
);


ob_start();
include 'contact-form.php';
$myvariable = ob_get_clean();
return $myvariable;
}


return add_shortcode( 'contact_form', 'contact_shortcode');



