	<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	/**
	 * 
	 */
	if ( !class_exists( 'Allmenu' ) ) {
	class Allmenu {
		


	function crud_menus(){

		add_menu_page( "My Book", "My Book", "manage_options", "book-list", "book_list", "dashicons-book-alt", 30);
		add_submenu_page( "book-list", "Book List", "Book List", "manage_options", "book-list", "book_list");
		add_submenu_page( "book-list", "Add New", "Add New", "manage_options", "add-new-book", "add_new_book");
		add_submenu_page( "book-list", "", "", "manage_options", "edit-book", "edit_new_book");
		

	}


	}

	}
