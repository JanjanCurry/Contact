<?php wp_enqueue_media(); ?>
<?php 
require MY_PLUGIN_DIRECTORY_PATH . '/functions/create_table.php';
$book_id = isset($_GET['edit'])?intval($_GET['edit']):0; 
global $wpdb;
$book_detail = $wpdb->get_row(
	$wpdb->prepare(
		"SELECT * FROM " . Cretetable::table_name() . " WHERE id = %d ", $book_id 
	),ARRAY_A
);

?>
<div class="container">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Update Book Details
			</div>
			<div class="panel-body">
				<form action="javascript:void(0)" class="form-horizontal" id="frmEditBook">
					<div class="form-group">
						<label for="" class="control-label col-sm-2" for="">Name</label>
						<div class="col-sm-10">
							<input type="hidden" name="book_id" value="<?php echo isset($_GET['edit'])?intval($_GET['edit']):0; ?>" >
							<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $book_detail['name']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-sm-2" for="">Author</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="autho" name="author" placeholder="Author"  value="<?php echo $book_detail['author']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-sm-2" for="">About</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="about" name="about" placeholder="Description"  value="<?php echo $book_detail['about']; ?>">
						</div>

						<br><br><br>
						<div class="form-group">
						<label for="" class="control-label col-sm-2" for="">Upload Book Image</label>
						<div class="col-sm-10">
							<input type="button" id="btn-upload" class="btn btn-info" value="upload image here">
						<span id="show-image">
							<img src="<?php echo $book_detail['book_image']; ?>" style="height: 80px; width: 80px; ">
						</span>
						<input type="hidden" id="image_name" name="image" value="<?php echo $book_detail['book_image']; ?>" />
						
						</div>
						<br><br><br>
					
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<label for=""></label>
							<button type="submit" class="btn btn-primary">UPDATE</button>
							</div>
					</div>
				</form>

			</div>
		</div>
		
	</div>
</div>