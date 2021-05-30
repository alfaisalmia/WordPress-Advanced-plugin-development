<?php

/**
 * Fired during plugin activation
 *
 * @link       faisal.com
 * @since      1.0.0
 *
 * @package    Advanced_Plugin
 * @subpackage Advanced_Plugin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Advanced_Plugin
 * @subpackage Advanced_Plugin/includes
 * @author     Faisal Mia <af_apon@gmail.com>
 */
class Advanced_Plugin_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

	public function activate()
	{
		$activatore = new Advanced_Plugin_Activator;
		$table_query = "CREATE TABLE `" . $activatore->Book_Table_Prefix() . "` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(255) DEFAULT NULL,
			`amount` int(11) DEFAULT NULL,
			`description` text DEFAULT NULL,
			`book_image` varchar(250) DEFAULT NULL,
			`language` varchar(200) DEFAULT NULL,
			`shelf_id` int(11) DEFAULT NULL ,
			`status` int(11) NOT NULL DEFAULT 1,
			`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
			PRIMARY KEY (`id`)
		  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($table_query);

		$shelf_query = "CREATE TABLE `" . $activatore->Book_Table_Shelf_Prefix() . "` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`shelf_name` varchar(255) NOT NULL,
			`capacity` int(11) NOT NULL,
			`shelf_location` varchar(255) NOT NULL,
			`status` int(11) NOT NULL DEFAULT 1,
			`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
			PRIMARY KEY (`id`)
		  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
		dbDelta($shelf_query);

		// inset data to the table
	/* 	global $wpdb;
		$insert_query = "INSERT into " . $activatore->Book_Table_Shelf_Prefix() . "(shelf_name,capacity,shelf_location) VALUES ('shelf1',222,'left corner')";
		$wpdb->query($insert_query); */


		//create page when plugin active 
		
		$post_arr_data = array(
			'post_title'		=> 'Book Tool',
			'post_name'			=> 'book_tool',
			'post_content'		=> 'Book Tool Page',
			'post_status'		=> 'publish',
			'post_author'		=> 1,
			'post_type'			=> 'page',
		);

		wp_insert_post($post_arr_data);		
	} 

	public function Book_Table_Prefix()
	{
		global $wpdb;
		return $wpdb->prefix . "book_table";
	}
	public function Book_Table_Shelf_Prefix()
	{
		global $wpdb;
		return $wpdb->prefix . "book_table_shelf";
	}
}
