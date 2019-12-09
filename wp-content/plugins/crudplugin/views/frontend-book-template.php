<?php 
/*
Template Name: Front End Bookb Page Layout
*/
get_header();
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="alert alert-success">
				<h3>Book Courses List</h3>
			</div>
			<?php 
				echo do_shortcode("[book_page]");
			 ?>
		</div>
	</div>
</div>
<?php 
get_footer();
 ?>