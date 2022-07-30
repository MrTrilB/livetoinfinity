<?php

/**
 * Plugin Name: BuddyDev Dashboard
 * Version: 1.0.4
 * Author: BuddyDev.com
 * Author URI: https://buddydev.com
 * Plugin URI: https://buddydev.com/plugins/buddydev-dashboard/
 * Network: true
 * Description: Helps you to Update BuddyDev Themes & Plugins. Also includes common libraries used by BuddyDev plugins.
 */
class BuddyDev_Client_Dashboard_Manager {

	/**
	 * File stsyem path to this plugin dir.
	 *
	 * @var string
	 */
	private $path;

	/**
	 * Plugin basename.
	 *
	 * @var string
	 */
	private $basename;

	/**
	 * API base url.
	 *
	 * @var string
	 */
	private $api_base_url;

	/**
	 * Messages array.
	 *
	 * @var array
	 */
	private $messages = array();

	/**
	 * Singleton instance.
	 *
	 * @var BuddyDev_Client_Dashboard_Manager
	 */
	private static $instance = null;

	/**
	 * BuddyDev_Client_Dashboard_Manager constructor.
	 */
	private function __construct() {

		$this->path = plugin_dir_path( __FILE__ );

		$this->api_base_url = 'https://buddydev.com/api/v1/';

		add_action( 'plugins_loaded', array(
			$this,
			'load',
		), 0 );// too early because we don't want our other plugins to load options buddy.

		$this->basename = plugin_basename( __FILE__ );
	}

	/**
	 * Get singleton instance.
	 *
	 * @return BuddyDev_Client_Dashboard_Manager
	 */
	public static function get_instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Load required files
	 */
	public function load() {

		$path = $this->path;

		$files = array(
			'core/functions.php',
			'core/updater/class-update-client.php',
		);

		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			// load OptionsBuddy if we are inside the admin
			// should we check that the request is not for ajax?
			$files[] = 'core/lib/options-buddy/ob-loader.php';
			$files[] = 'admin/admin.php';
		}

		foreach ( $files as $file ) {
			require_once $path . $file;
		}

		do_action( 'buddydash_loaded' );
	}

	/**
	 * Is this plugin network active?
	 *
	 * @return boolean
	 */
	public function is_network_active() {

		if ( ! is_multisite() ) {
			return false;
		}

		$plugins = get_site_option( 'active_sitewide_plugins' );

		if ( isset( $plugins[ $this->basename ] ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Get api base url.
	 *
	 * @return string
	 */
	public function get_api_base_url() {
		return $this->api_base_url;
	}

	/**
	 * Get notices.
	 *
	 * @return array
	 */
	public function get_notices() {
		return $this->messages;
	}

	/**
	 * Add notice.
	 *
	 * @param string $code code.
	 * @param string $message message.
	 */
	public function add_notice( $code, $message ) {
		$this->messages[ $code ] = $message;
	}

	/**
	 * Remove a notice by code.
	 *
	 * @param string $code code.
	 */
	public function remove_notice( $code ) {
		unset( $this->messages[ $code ] );
	}

	/**
	 * Reset all notices.
	 */
	public function reset_notices() {
		$this->messages = array();
	}
}

/**
 * Shortcut helper function.
 *
 * @return BuddyDev_Client_Dashboard_Manager
 */
function buddydev_dashboad() {
	return BuddyDev_Client_Dashboard_Manager::get_instance();
}

buddydev_dashboad();
