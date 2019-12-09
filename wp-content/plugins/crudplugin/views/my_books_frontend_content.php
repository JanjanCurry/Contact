<?php wp_enqueue_media(); ?>
<?php 
require MY_PLUGIN_DIRECTORY_PATH . '/functions/create_table.php';
$book_id = $_GET['id']; 
global $wpdb;
$book_detail = $wpdb->get_row(
	$wpdb->prepare(
		"SELECT * FROM " . Cretetable::table_name() . " WHERE id = %d ", $book_id
	),ARRAY_A
);

?>
<div class="container">
	<div class="row">
			<div class="panel-body">
		
			<h3><?php echo $book_detail['name']; ?></h3>
			<p>By: <small><?php echo get_author_details($book_detail['author'])['name']; ?></small></p>
			<p><?php echo $book_detail['about']; ?></p>
			</div>
		
		
	</div>
</div>