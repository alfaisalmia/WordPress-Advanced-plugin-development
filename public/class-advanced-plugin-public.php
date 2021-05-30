<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       faisal.com
 * @since      1.0.0
 *
 * @package    Advanced_Plugin
 * @subpackage Advanced_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Advanced_Plugin
 * @subpackage Advanced_Plugin/public
 * @author     Faisal Mia <af_apon@gmail.com>
 */
class Advanced_Plugin_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/advanced-plugin-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/advanced-plugin-public.js', array('jquery'), $this->version, false);

		wp_localize_script($this->plugin_name, "smc_book", array(
			"name" => "Smart Coder",
			"author" => "Faisal Mia",
			"ajaxurl" => admin_url('admin-ajax.php'),
		));
	}

	public function our_own_custom_page_template()
	{
		global $post;
		if ($post->post_name == 'book_tool') {
			$page_template = plugin_dir_path(__FILE__) . 'partials/book-tool-layout.php'; //include template file
		}
		return $page_template;
	}

	public function load_book_tool_content()
	{
		ob_start();
		require_once plugin_dir_path(__FILE__) . 'partials/tem-book-tool-content.php';
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}

	public function handle_ajax_request_public()
	{
		$param = isset($_REQUEST['param']) ? $_REQUEST['param'] : "";
		if (!empty($param)) {
			if ($param == "first_ajax_request") {
				echo json_encode(array(
					"status" => 1,
					"message" => "successfully first ajax request from fontend"
				));
			}
		}
		wp_die();
	}
}
