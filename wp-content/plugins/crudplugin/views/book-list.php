<?php
	require MY_PLUGIN_DIRECTORY_PATH . '/functions/create_table.php';
	global $wpdb;
	$allbooks = $wpdb->get_results(
		$wpdb->prepare(
			"select * from " . Cretetable::table_name()
 . " order by id DESC", ""
		),ARRAY_A
	);
 ?>
<div class="container">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Book List
			</div>
			<div class="panel-body">
				<table id="my-book" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>SR. Number</th>
				<th>Name</th>
				<th>Author</th>
				<th>About</th>
				<th>Book Image</th>
				<th>Created at</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				if (count($allbooks) > 0) {
					$i = 1;
					foreach ($allbooks as $key => $value) {
						# code...
				
			 ?>
			<tr>
				<th><?php echo $i++; ?></th>
				<th><?php echo $value['name']; ?></th>
				<th><?php echo $value['author']; ?></th>
				<th><?php echo $value['about']; ?></th>
				<th><img src="<?php echo $value['book_image']; ?>" style="height:80px;width: 80px"> </th>
				<th><?php echo $value['created_at']; ?></th>
				<th>
					<a class="btn btn-info" href="admin.php?page=edit-book&edit=<?php echo $value['id']; ?>">Edit</a>
					<a class="btn btn-danger btnbookdelete" href="javascript:void(0)" data-id="<?php echo $value['id']; ?>">Delete</a>
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
</div>