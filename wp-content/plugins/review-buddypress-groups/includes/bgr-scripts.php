<?php
/**
 * Class to add custom scripts and styles.
 *
 * @link       https://wbcomdesigns.com/
 * @since      1.0.0
 *
 * @package    BuddyPress_Group_Review
 * @subpackage BuddyPress_Group_Review/includes
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


if ( ! class_exists( 'BGRScriptsStyles' ) ) {
	/**
	 * Class to add custom scripts and styles.
	 *
	 * @link       https://wbcomdesigns.com/
	 * @since      1.0.0
	 *
	 * @package    BuddyPress_Group_Review
	 * @subpackage BuddyPress_Group_Review/includes
	 */
	class BGRScriptsStyles {

		/**
		 * Constructor
		 *
		 * @since   1.0.0
		 * @author  Wbcom Designs
		 *
		 * @return void
		 */
		public function __construct() {

			// Add Scripts only on reviews tab.
			add_action( 'wp_enqueue_scripts', array( $this, 'bgr_custom_variables' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'bgr_admin_custom_variables' ) );
		}

		/**
		 * Actions performed for enqueuing scripts and styles for site front.
		 *
		 * @since   1.0.0
		 * @author  Wbcom Designs
		 *
		 * @return void
		 */
		public function bgr_custom_variables() {
			wp_enqueue_style( 'bgr-font-awesome', 'https://use.fontawesome.com/releases/v5.4.2/css/all.css', array(), BGR_PLUGIN_VERSION, 'all' );
			wp_enqueue_style( 'bgr-reviews-css', BGR_PLUGIN_URL . 'assets/css/bgr-reviews.css', array(), BGR_PLUGIN_VERSION, 'all' );
			wp_enqueue_style( 'bgr-front-css', BGR_PLUGIN_URL . 'assets/css/bgr-front.css', array(), BGR_PLUGIN_VERSION, 'all' );
			wp_enqueue_script( 'bgr-front-js', BGR_PLUGIN_URL . 'assets/js/bgr-front.js', array( 'jquery' ), BGR_PLUGIN_VERSION, false );
			wp_localize_script(
				'bgr-front-js',
				'bgr_front_js_object',
				array(
					'view_more_text' => esc_html__( 'View More..', 'bp-group-reviews' ),
					'view_less_text' => esc_html__( 'View Less..', 'bp-group-reviews' ),
					'wbcom_nonce'    => wp_create_nonce( 'ajax-nonce' ),
				)
			);
			wp_enqueue_style( 'bgr-ratings-css', BGR_PLUGIN_URL . 'assets/css/bgr-ratings.css', array(), BGR_PLUGIN_VERSION, 'all' );
			wp_enqueue_script( 'bgr-ratings-js', BGR_PLUGIN_URL . 'assets/js/bgr-ratings.js', array( 'jquery' ), BGR_PLUGIN_VERSION, false );
		}

		/*
		*  	@since   1.0.0
		*  	@author  Wbcom Designs
		*/

		/**
		 * Actions performed for enqueuing scripts and styles for admin page.
		 *
		 * @since 1.0.0
		 * @author Wbcom Designs
		 *
		 * @return void
		 */
		public function bgr_admin_custom_variables() {
			$curr_url = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
			$screen   = get_current_screen();
			if ( ( strpos( $curr_url, 'review' ) == true ) || ( 'wb-plugins_page_group-review-settings' == $screen->base ) ) {
				wp_enqueue_script( 'bgr-js-admin', BGR_PLUGIN_URL . 'admin/assets/js/bgr-admin.js', array( 'jquery' ), BGR_PLUGIN_VERSION, false );
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script( 'bgr-colorpicker-handle', BGR_PLUGIN_URL . 'admin/assets/js/bgr-colorpicker.js', array( 'wp-color-picker' ), BGR_PLUGIN_VERSION, false );
				if ( ! wp_style_is( 'wbcom-selectize-css', 'enqueued' ) ) {
					wp_enqueue_style( 'wbcom-selectize-css', BGR_PLUGIN_URL . 'admin/assets/css/selectize.css', array(), BGR_PLUGIN_VERSION, 'all' );
				}
				wp_enqueue_style( 'bgr-css-admin', BGR_PLUGIN_URL . 'admin/assets/css/bgr-admin.css', array(), BGR_PLUGIN_VERSION, 'all' );
				if ( ! wp_script_is( 'wbcom-selectize-js', 'enqueued' ) ) {
					wp_enqueue_script( 'wbcom-selectize-js', BGR_PLUGIN_URL . 'admin/assets/js/selectize.min.js', array( 'jquery' ), BGR_PLUGIN_VERSION, false );
				}
				if ( ! wp_script_is( 'jquery-ui-sortable', 'enqueued' ) ) {
					wp_enqueue_script( 'jquery-ui-sortable' );
				}
			}
		}
	}
	new BGRScriptsStyles();
}
