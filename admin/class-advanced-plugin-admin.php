<?php
class Advanced_Plugin_Admin
{

	private $plugin_name;

	private $version;

	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-advanced-plugin-activator.php';
		$activator = new Advanced_Plugin_Activator;
		$this->table_activator = $activator;
	}

	//Register the stylesheets for the admin area.

	public function enqueue_styles()
	{

		$valid_page = array('book-management', 'create-book', 'list-book', 'create-bookshelf', 'list-book-shelf');
		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
		if (in_array($page, $valid_page)) {

			wp_enqueue_style('bootstrap.min', plugin_dir_url(dirname(__FILE__))  . 'assets/css/bootstrap.min.css', array(), $this->version, 'all');

			wp_enqueue_style('jquery.dataTables.min', plugin_dir_url(dirname(__FILE__)) . 'assets/css/jquery.dataTables.min.css', array(), $this->version, 'all');
			wp_enqueue_style('sweetalert', plugin_dir_url(dirname(__FILE__)) . 'assets/css/sweetalert.css', array(), $this->version, 'all');
		}

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/advanced-plugin-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Advanced_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Advanced_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */


		$valid_page = array('book-management', 'create-book', 'list-book', 'create-bookshelf', 'list-book-shelf');
		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
		if (in_array($page, $valid_page)) {
			wp_enqueue_script('jquery');
			wp_enqueue_script('bootstrap.min.js', plugin_dir_url(dirname(__FILE__)) . 'assets/js/bootstrap.min.js', array('jquery'), $this->version, false);

			//wp_enqueue_script('jquery.min.js', plugin_dir_url(dirname(__FILE__)) . 'assets/js/jquery.min.js', array('jquery'), $this->version, false);


			wp_enqueue_script('jquery.dataTables.min.js', plugin_dir_url(dirname(__FILE__)) . 'assets/js/jquery.dataTables.min.js', array('jquery'), $this->version, false);
			wp_enqueue_script('jquery.validate.min.js', plugin_dir_url(dirname(__FILE__)) . 'assets/js/jquery.validate.min.js', array('jquery'), $this->version, false);
			wp_enqueue_script('sweetalert.js', plugin_dir_url(dirname(__FILE__)) . 'assets/js/sweetalert.js', array('jquery'), $this->version, false);
			wp_enqueue_script($this->plugin_name, plugin_dir_url(dirname(__FILE__)) . 'admin/js/advanced-plugin-admin.js', array('jquery'), $this->version, false);

			wp_localize_script($this->plugin_name, 'ad_book', array(
				"ajaxurl" => admin_url("admin-ajax.php"),
			));
		}
	}
	public function advanced_menu_section()
	{
		add_menu_page('Book Management', 'Book Management', 'manage_options', 'book-management', array($this, "book_management_dashboard"));

		add_submenu_page("book-management", "Dashboard", "Dashboard", "manage_options", "book-management", array($this, "book_management_dashboard"));

		add_submenu_page("book-management", "Create Book", "Create Book", "manage_options", "create-book", array($this, "callback_create_book"));

		add_submenu_page("book-management", "List Book", "List Book", "manage_options", "list-book", array($this, "callback_list_book"));

		add_submenu_page("book-management", "Creat Book Shelf", "Create Book Shelf", "manage_options", "create-bookshelf", array($this, "callback_create_book_shelf"));

		add_submenu_page("book-management", "List Book Shelf", "List Book Shelf", "manage_options", "list-book-shelf", array($this, "callback_list_book_shelf"));
	}
	public function book_management_dashboard()
	{
		echo "<h2>Book Management</h2>";
		global $wpdb;
		/* $user_email = $wpdb->get_var("select user_email from wp_users");
		echo $user_email; */

		/* $user_Data = $wpdb->get_row("select * from wp_users",ARRAY_A);
		echo "<pre>";
		print_r($user_Data); */

		/* 	$all_posts = $wpdb->get_results("select * from wp_posts",ARRAY_A);
		echo "<pre>";
		print_r($all_posts);  */

		/* $post_title = $wpdb->get_row(
			$wpdb->prepare("select * from wp_posts where id =%d", 1)
		); */
	}

	public function callback_create_book()
	{
		// To get value for create book dropdown
		global $wpdb;
		$book_shelf = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT id, shelf_name FROM " . $this->table_activator->Book_Table_Shelf_Prefix(),
				""
			)
		);
		ob_start();
		require_once plugin_dir_path(__FILE__) . 'partials/tem-book-create.php';
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}
	public function callback_list_book()
	{
		global $wpdb;
		$books_data = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT book.*, book_shelf.shelf_name from " . $this->table_activator->Book_Table_Prefix() . " as book LEFT JOIN " . $this->table_activator->Book_Table_Shelf_Prefix() . " as book_shelf ON book.shelf_id = book_shelf.id ORDER BY id DESC",
				""
			)
		);
		ob_start();
		require_once plugin_dir_path(__FILE__) . 'partials/tem-create-book-list.php';
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}
	public function callback_create_book_shelf()
	{
		ob_start();
		require_once plugin_dir_path(__FILE__) . 'partials/tem-create-book-self.php';
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}
	public function callback_list_book_shelf()
	{
		// Get data from the wp_book_table_shelf  table for showing the template file
		global $wpdb;
		$book_shelf = $wpdb->get_results(
			$wpdb->prepare("SELECT * FROM " . $this->table_activator->Book_Table_Shelf_Prefix(), "")
		);

		ob_start(); //start buffer
		require_once plugin_dir_path(__FILE__) . 'partials/tem-list-book-self.php'; //include template file
		$template = ob_get_contents();	//reading content
		ob_end_clean();	//closing and cleaning buffer
		echo $template;
	}
	// this Ajax function is called in includes/class-advanced-plugin.php
	public function first_ajax_call()
	{
		global $wpdb;
		$getParam = isset($_REQUEST['param']) ? $_REQUEST['param'] : '';
		if (!empty($getParam)) {
			if ($getParam == "simple_first_ajax") {
				echo json_encode(array(
					"name" => "smart coder",
					"author" => "Faisal Mia"
				));
			} elseif ($getParam == 'create_book_self') {
				$shelf_name = isset($_REQUEST['shelf_name']) ? ($_REQUEST['shelf_name']) : '';
				$text_capacity = isset($_REQUEST['text_capacity']) ? ($_REQUEST['text_capacity']) : '';
				$shelf_loc = isset($_REQUEST['shelf_loc']) ? ($_REQUEST['shelf_loc']) : '';
				$status = isset($_REQUEST['status']) ? ($_REQUEST['status']) : '';

				$wpdb->insert($this->table_activator->Book_Table_Shelf_Prefix(), array(
					"shelf_name"	=> $shelf_name,
					"capacity"	=> $text_capacity,
					"shelf_location"	=> $shelf_loc,
					"status"	=> $status,
				));

				if ($wpdb->insert_id > 0) {
					echo json_encode(array(
						"status" => 1,
						"message" => "Book shelf add successfully",
					));
				} else {
					echo json_encode(array(
						"status" => 0,
						"message" => "Book shelf insert failed",
					));
				}
				wp_die();
			} elseif ($getParam == 'delete_book_self') {
				$book_shelf_id = isset($_REQUEST['book_shelf_id']) ? $_REQUEST['book_shelf_id'] : 0;
				if ($book_shelf_id > 0) {
					$wpdb->delete($this->table_activator->Book_table_Shelf_Prefix(), array(
						"id" => $book_shelf_id
					));
					echo json_encode(array(
						"status" => 1,
						"message" => "Book Shelf delete successfully",
					));
				} else {
					echo json_encode(array(
						"status" => 0,
						"message" => "Failed to delete Book Shelf",
					));
				}
				wp_die();
			} elseif ($getParam == 'create_book') {

				//getting value from form name 
				$dd_bok_shelf = isset($_REQUEST['dd_bok_shelf']) ? ($_REQUEST['dd_bok_shelf']) : '';
				$text_name = isset($_REQUEST['text_name']) ? ($_REQUEST['text_name']) : '';

				$text_publication = isset($_REQUEST['text_publication']) ? ($_REQUEST['text_publication']) : '';
				$text_description = isset($_REQUEST['text_description']) ? ($_REQUEST['text_description']) : '';
				$book_cover_image = isset($_REQUEST['book_cover_image']) ? ($_REQUEST['book_cover_image']) : '';
				$text_book_cost = isset($_REQUEST['text_book_cost']) ? ($_REQUEST['text_book_cost']) : '';
				$status = isset($_REQUEST['status']) ? ($_REQUEST['status']) : '';
				// insert the data to wp_book table 
				$wpdb->insert($this->table_activator->Book_Table_Prefix(), array(
					"name"	=> $text_name,
					"amount"	=> $text_book_cost,
					"description"	=> $text_description,
					"book_image"	=> $book_cover_image,
					"publication"	=> $text_publication,
					"shelf_id"	=> $dd_bok_shelf,
					"status"	=> $status,
				));

				if ($wpdb->insert_id > 0) {
					echo json_encode(array(
						"status" => 1,
						"message" => "Book add successfully",
					));
				} else {
					echo json_encode(array(
						"status" => 0,
						"message" => "Book  insert failed",
					));
				}
				wp_die();
			}
			//Delete Book 
			elseif ($getParam == 'delete_book') {
				$delete_book_id = isset($_REQUEST['book__id']) ? $_REQUEST['book__id'] : 0;
				if ($delete_book_id > 0) {
					$wpdb->delete($this->table_activator->Book_Table_Prefix(), array(
						"id" => $delete_book_id
					));
					echo json_encode(array(
						"status" => 1,
						"message" => "Book delete successfully",
					));
				} else {
					echo json_encode(array(
						"status" => 0,
						"message" => "Failed to delete Book ",
					));
				}
				wp_die();
			}
		}
	}
}
