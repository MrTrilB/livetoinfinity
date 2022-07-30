<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://wbcomdesigns.com
 * @since      1.0.0
 *
 * @package    Buddypress_Ads_Rotator
 * @subpackage Buddypress_Ads_Rotator/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Buddypress_Ads_Rotator
 * @subpackage Buddypress_Ads_Rotator/includes
 * @author     WB COM <admin@wbcomdesigns.com>
 */
class Buddypress_Ads_Rotator {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Buddypress_Ads_Rotator_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'BUDDYPRESS_ADS_ROTATOR_VERSION' ) ) {
			$this->version = BUDDYPRESS_ADS_ROTATOR_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'buddypress-ads-rotator';
		$this->define_constants();
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Define plugin constants that are use entire plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function define_constants() {
		$this->define( 'BUDDYPRESS_ADS_ROTATOR_FILE', __FILE__ );
		$this->define( 'BUDDYPRESS_ADS_ROTATOR_URL', plugin_dir_url( dirname( __FILE__ ) ) );
		$this->define( 'BUDDYPRESS_ADS_ROTATOR_PATH', plugin_dir_path( dirname( __FILE__ ) ) );
		$this->define( 'BUDDYPRESS_ADS_ROTATOR_DIR', trailingslashit( dirname( __FILE__ ) ) );
	}

	/**
	 * Define constant if not already defined
	 *
	 * @since 1.0.0
	 *
	 * @param string      $name Name.
	 * @param string|bool $value Value.
	 *
	 * @return void
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Buddypress_Ads_Rotator_Loader. Orchestrates the hooks of the plugin.
	 * - Buddypress_Ads_Rotator_i18n. Defines internationalization functionality.
	 * - Buddypress_Ads_Rotator_Admin. Defines all hooks for the admin area.
	 * - Buddypress_Ads_Rotator_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-buddypress-ads-rotator-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-buddypress-ads-rotator-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-buddypress-ads-rotator-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-buddypress-ads-rotator-public.php';

		/**
		* The class responsible add wrapper of admin settings.
		*/
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wbcom/wbcom-admin-settings.php';

		$this->loader = new Buddypress_Ads_Rotator_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Buddypress_Ads_Rotator_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Buddypress_Ads_Rotator_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Buddypress_Ads_Rotator_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'wb_ads_rotator_add_submenu_page_admin_settings' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'wb_ads_rotator_init_plugin_settings' );

		$this->loader->add_action( 'init', $plugin_admin, 'wb_ads_rotator_add_cpt' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'wb_ads_rotator_add_metaboxes' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'wb_ads_rotator_save_post_meta' );
		$this->loader->add_action( 'wp_ajax_wb_ads_rotator_image', $plugin_admin, 'wb_ads_rotator_image' );
		$this->loader->add_action( 'wp_ajax_wb_ads_rotator_remove_image', $plugin_admin, 'wb_ads_remove_uploaded_image' );

		$this->loader->add_filter( 'manage_wb-ads_posts_columns', $plugin_admin, 'wb_ads_rotator_add_disable_admin_columns', 10, 1 );
		$this->loader->add_action( 'manage_wb-ads_posts_custom_column', $plugin_admin, 'wb_ads_rotator_add_disable_column_content', 10, 2 );
		$this->loader->add_action( 'transition_post_status', $plugin_admin, 'wb_ads_rotator_update_default_value_on_ads_publish', 10, 3 );
		$this->loader->add_action( 'wp_ajax_wb_ads_rotator_enable', $plugin_admin, 'wb_ads_rotator_ajax_enable_callback' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Buddypress_Ads_Rotator_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_action( 'bp_before_activity_entry', $plugin_public, 'wb_ads_display_before_activity_entry' );
		$this->loader->add_action( 'bp_activity_entry_content', $plugin_public, 'wb_ads_display_activity_entry_content' );
		$this->loader->add_action( 'bp_after_activity_entry', $plugin_public, 'wb_ads_display_after_activity_entry' );
		$this->loader->add_action( 'bp_before_activity_entry_comments', $plugin_public, 'wb_ads_display_before_activity_entry_comments' );
		$this->loader->add_action( 'bp_activity_entry_comments', $plugin_public, 'wb_ads_display_activity_entry_comments' );
		$this->loader->add_action( 'bp_after_activity_entry_comments', $plugin_public, 'wb_ads_display_after_activity_entry_comments' );

		$this->loader->add_shortcode( 'ads-shortcode', $plugin_public, 'wb_ads_rotator_shortcode_ads' );
		$this->loader->add_action( 'bp_before_directory_activity_content', $plugin_public, 'wb_ads_rotator_check_ads' );
		$this->loader->add_action( 'bp_after_member_activity_post_form', $plugin_public, 'wb_ads_rotator_check_ads' );
		$this->loader->add_action( 'bp_after_group_activity_post_form', $plugin_public, 'wb_ads_rotator_check_ads' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Buddypress_Ads_Rotator_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
