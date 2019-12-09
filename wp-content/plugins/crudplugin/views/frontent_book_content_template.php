<?php 
/*
Template Name: Front End Bookb Page Layout
*/
get_header();
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			
			<?php 
				echo do_shortcode("[book_page_content]");
			 ?>
		</div>
	</div>
</div>
<?php 
get_footer();
 ?>