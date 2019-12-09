<?php
	require MY_PLUGIN_DIRECTORY_PATH . '/functions/create_table.php';
	global $wpdb;

	$authors = $wpdb->get_results(
		$wpdb->prepare(
			"select * from " . Cretetable::table_name_authors()
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
				<th>FB Link</th>
				<th>About</th>
				<th>Created at</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
				<?php 
				if (count($authors) > 0) {
					$i = 1;
					foreach ($authors as $key => $value) {
						# code...
				
			 ?>
			<tr>
				<th><?php echo $i++; ?></th>
				<th><?php echo $value->name; ?></th>
				<th><?php echo $value->fb_link ?></th>
				<th><?php echo $value->about ?></th>
				<th><?php echo $value->created_at ?></th>
				<th>
					<a class="btn btn-danger btnauthordelete" href="javascript:void(0)" data-id="<?php echo $value->id; ?>">Delete</a>
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