<?php
	require MY_PLUGIN_DIRECTORY_PATH . '/functions/create_table.php';
	global $wpdb;
	$course_tracker = $wpdb->get_results(
	$wpdb->prepare(
		"SELECT  b.name as bookname, s.name as studentname, e.created_at FROM " . Cretetable::table_name_enroll() . " as e LEFT JOIN " . Cretetable::table_name_students() . " as s ON s.user_login_id = e.student_id LEFT JOIN " . Cretetable::table_name() . " as b ON b.id = e.book_id", ""
	),ARRAY_A
 );
 ?>
<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Course Tracker List
			</div>
			<div class="panel-body">
				<table id="my-book" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>SR. Number</th>
				<th>Name</th>
				<th>Course</th>
				<th>Created at</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>			<?php 
				if (count($course_tracker) > 0) {
					$i = 1;
					foreach ($course_tracker as $key => $value) {

			 ?>
			<tr>
				<th><?php echo $i++; ?></th>
				<th><?php echo $value['studentname']; ?></th>
				<th><?php echo $value['bookname']; ?></th>
				<th><?php echo $value['created_at']; ?></th>
				</tr>
		<?php
		 }
		} 
		?>

		</tbody>
		</table>		
			</div>
		</div>
		
	</div>