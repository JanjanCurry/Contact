<?php 
require MY_PLUGIN_DIRECTORY_PATH . '/functions/create_table.php';
	global $wpdb;
	global $user_ID;
	$books = $wpdb->get_results(
		$wpdb->prepare(
			"select * from " . Cretetable::table_name()
 . " order by id DESC", ""
		)
	);	

	 ?>

<?php 
	if (count($books) > 0) {
		foreach ($books as $key => $value) {
	?>
		
<div class="col-sm-4 owt-layout" >
	<p><img src="<?php echo $value->book_image; ?>" style="height:100px; width: 100px" alt=""></p>
	<p><?php echo $value->name; ?></p>
	<p><?php echo get_author_details($value->author)['name']; ?></p>
	
	<p>

<?php 

	$enroll = $wpdb->get_results(
		$wpdb->prepare(
		"SELECT e.id as enroll_id FROM " . Cretetable::table_name_enroll() . " as e LEFT JOIN " . Cretetable::table_name_students() . " as s ON s.id = e.student_id LEFT JOIN " . Cretetable::table_name() . " b ON b.id = e.book_id WHERE e.student_id = " . $user_ID . " AND e.book_id = " . $value->id, ""

		),ARRAY_A
	);	

	
if ($user_ID > 0 && empty($enroll)) {

?>
	<a class="btn btn-success owt-enroll-btn" id="<?php echo $user_ID; ?>" href="javascript:void(0)" data-id="<?php echo $value->id; ?>"> Enroll Now </a>
<?php
	}elseif($user_ID > 0 && !empty($enroll)){

?>
	<a class="btn btn-success owt-read-btn" href="<?php echo site_url() . "/my_book_content?id=" . $value->id ?>" data-id="<?php echo $value->id; ?>"> Read Now <?php echo $value->id; ?></a>
<?php
	}
	else{ 
?>
	<a class="btn btn-success" href="<?php echo wp_login_url(); ?>">Login Enroll Now </a>
	
<?php

	 } ?>
</p>
</div>

	<?php		

		}
	}
 ?>