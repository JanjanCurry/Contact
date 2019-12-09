<?php 	
require MY_PLUGIN_DIRECTORY_PATH . '/functions/create_table.php';
wp_enqueue_media(); 
?>
<div class="container">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Add Book Page
			</div>
			<div class="panel-body">
				<form action="javascript:void(0)" class="form-horizontal" id="frmAddBook">
					<div class="form-group">
						<label for="" class="control-label col-sm-2" for="">Book Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" required id="name" name="name" placeholder="Name">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-sm-2" for="">Author</label>
						<div class="col-sm-10">
							<select class="form-control" id="author" name="author">
										<option value="-1">--- CHOOSE AUTHOR ---</option>

				<?php 
				global $wpdb;

	$authors = $wpdb->get_results(
		$wpdb->prepare(
			"select * from " . Cretetable::table_name_authors()
 . " order by id DESC", ""
		)
	);	 
foreach ($authors as $key => $value) {
	# code...

	?>
								<option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-sm-2" for="">About</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="about" name="about" placeholder="Description">
						</div>
					</div>
						<div class="form-group">
						<label for="" class="control-label col-sm-2" for="">Upload Book Image</label>
						<div class="col-sm-10">
							<input type="button" id="btn-upload" class="btn btn-info" value="upload image here">
						<span id="show-image"></span>
						<input type="hidden" id="image_name" name="image" />
						
						</div>
						<br><br><br>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<label for=""></label>
							<button type="submit" class="btn btn-primary">SUBMIT</button>
							</div>
					</div>
				</form>

			</div>
		</div>
		
	</div>
</div>