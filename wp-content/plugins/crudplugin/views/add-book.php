<?php 	wp_enqueue_media(); ?>
<div class="container">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Add Book Page
			</div>
			<div class="panel-body">
				<form action="javascript:void(0)" class="form-horizontal" id="frmAddBook">
					<div class="form-group">
						<label for="" class="control-label col-sm-2" for="">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" required id="name" name="name" placeholder="Name">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-sm-2" for="">Author</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="autho" required name="author" placeholder="Author">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-sm-2" for="">About</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="about" name="about" placeholder="Description">
						</div>

						<br><br><br>
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