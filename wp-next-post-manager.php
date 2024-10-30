<?php if ( ! defined( 'WPINC' ) ) die;
/**
 * Plugin Name: Infinite Related Next Post Manager for WordPress
 * Description: Infinite Related Next Post Manager for WordPress
 * Version: 1.0
 * Author: Hitesh Khunt
 * Author URI: https://codecanyon.net/user/saragna/portfolio
 * Plugin URI: https://codecanyon.net/item/wordpress-next-post-manager/21800899
 * License: GPLv2 or later
 * Text Domain: next-post-manager
 *
 */

$svc_next_Version = "1.0";
$currentFile = __FILE__;
$winpm_currentFolder = dirname($currentFile);
require_once $winpm_currentFolder . '/inc/animate-options.php';
require_once $winpm_currentFolder . '/inc/comman_class.php';
require_once $winpm_currentFolder . '/inc/admin_class.php';
require_once $winpm_currentFolder . '/inc/all_function.php';

class WINPM_Next_Article_Layout extends WINPM_Next_Article_Layout_Grid {

	function __construct() {
		parent::__construct();
		$options = self::sblog_get_options();
		add_action('admin_menu', array( $this, 'add_animate_setting_page'));
		add_action('wp_head', array('WINPM_Next_Article_Layout_Grid', 'next_print_script_in_header'));
		add_action('wp_footer', array('WINPM_Next_Article_Layout_Grid', 'next_print_script_in_footer'));
	}

	public function add_animate_setting_page() {
		add_menu_page( 'Next Post', 'Next Post', 'manage_options', 'next-post', array( $this, 'my_sblog_layout_page'), self::animate_plugin_url( '../assets/image/icon.png' ));

	}
	public function my_sblog_layout_page(){
	global $wpdb;
		include('admin/setting.php');
	}
	
	public static function sblog_get_options() {
		return new WINPM_Next_Post_Options( '_winpm_next_post_option', array(
			'layout_style' => '',
			'post_type' => array('post'),
			'related_by' => 'by_cat',
			'post_count' => '2',
			'post_thumbnail' => 'yes',
			'ajax_disable' => '',
			'title_length' => '90',
			'more_stories_text' => 'MORE STORIES',
			'artical_selector' => '',
			'artical_parent_selector' => '',
			'slider_warpper' => '',
			'hide_selector' => '',
			'buffer_pixel' => '350',
			'thcolor' => '',
			'title_size' => '13',
			'next_arrow' => 'yes',
			'next_post_text' => 'NEXT STORY',
			'next_text_color' => '#cccccc',
			'next_line_color' => '#cccccc',
			'next_text_size' => '20',
			'after_content_enable' => 'yes',
			'after_content' => '',
			'after_content_align' => '',
			'after_content_padding_top' => '10',
			'after_content_padding_right' => '10',
			'after_content_padding_bottom' => '10',
			'after_content_padding_left' => '10',
			'after_content_bgcolor' => '#f2f2f2',
			'after_content_margin_top' => '20',
			'after_content_margin_bottom' => '20',
			'on_start_callback_enable' => '',
			'on_start_callback' => '',
			'on_end_callback_enable' => '',
			'on_end_callback' => '',
			'call_back_end_timeout' => 0,
			'custom_css' => ''
			
		) );
	}
}
$next_article_layout = new WINPM_Next_Article_Layout();
?>