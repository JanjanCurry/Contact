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
		add_submenu_page( "book-list", "Add New Book", "Add New Book", "manage_options", "add-new-book", "add_new_book");
		add_submenu_page( "book-list", "", "", "manage_options", "edit-book", "edit_new_book");
		
		add_submenu_page( "book-list", "Add New Author", "Add New Author", "manage_options", "add-new-author", "add_new_author");
		add_submenu_page( "book-list", "Manage Author", "Manage Author", "manage_options", "remove-author", "remove_author");
		add_submenu_page( "book-list", "Add New Student", "Add New Student", "manage_options", "add-new-student", "add_new_student");
		add_submenu_page( "book-list", "Manage Students", "Manage Students", "manage_options", "remove-students", "remove_students");
		add_submenu_page( "book-list", "Course Tracker", "Course Tracker", "manage_options", "course-tracker", "course_tracker");
		

	}


	}

	}
