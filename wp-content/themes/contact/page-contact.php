<?php get_header();  ?>

<?php if (have_posts()) {
	while (have_posts()) {
		the_post();
		the_content();
	}
}	else{
get_template_part(404);

	}
 ?>
<?php get_footer();  ?>
