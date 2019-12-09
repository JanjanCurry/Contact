<?php
	require MY_PLUGIN_DIRECTORY_PATH . '/functions/create_table.php';
	global $wpdb;
		$students = $wpdb->get_results(
		$wpdb->prepare(
			"select * from " . Cretetable::table_name_students()
 . " order by id DESC", ""
		)
	);	
 ?>
<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Author List
			</div>
			<div class="panel-body">
				<table id="my-book" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>SR. Number</th>
				<th>Name</th>
				<th>Email</th>
				<th>Username</th>
				<th>Created at</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
					<?php 
				if (count($students) > 0) {
					$i = 1;
					foreach ($students as $key => $value) {
				$user_details = get_userdata( $value->user_login_id );
			 ?>
			<tr>
				<th><?php echo $i++; ?></th>
				<th><?php echo $value->name; ?></th>
				<th><?php echo $value->email ?></th>
				<th><?php echo $user_details->user_login ?></th>
				<th><?php echo $value->created_at ?></th>
				<th>
					<a class="btn btn-danger btnstudentdelete" href="javascript:void(0)" data-id="<?php echo $value->id; ?>">Delete</a>
				</th>
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