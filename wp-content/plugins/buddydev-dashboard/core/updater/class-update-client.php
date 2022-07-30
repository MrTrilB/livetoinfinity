<?php
// Do not allow direct access over web.
defined( 'ABSPATH' ) || exit;

/**
 * Handles checking update for plugins
 */
class BuddyDev_Update_Client {

	/**
	 * We store api urls for various endpoints
	 *
	 * @var array
	 */
	private $api_urls = array();

	/**
	 * An array of buddydev plugin slugs which are installed on this site
	 *
	 * @var array
	 */
	private $installed_plugins = array();// will keep all the slugs of our plugin.

	/**
	 * An array of buddydev themes slugs which are installed on this site
	 *
	 * @var array
	 */
	private $installed_themes = array();// will keep all the slugs of our themes.

	/**Installed plugins list key.
	 *
	 * @var string
	 */
	private $key_installed = 'buddydev_installed_plugins';

	/**
	 * Installed themes list key.
	 *
	 * @var string
	 */
	private $key_installed_themes = 'buddydev_installed_themes';

	/**
	 * Plugins needing update key.
	 *
	 * @var string
	 */
	private $key_updatable = 'buddydev_updatable_plugins';

	/**
	 * Themes needing update key.
	 *
	 * @var string
	 */
	private $key_updatable_themes = 'buddydev_updatable_themes';

	/**
	 * Singleton.
	 *
	 * @var BuddyDev_Update_Client
	 */
	private static $instance;

	/**
	 * BuddyDev_Update_Client constructor.
	 */
	private function __construct() {

		$base = buddydev_dashboad()->get_api_base_url();

		$this->api_urls['check-update'] = $base . 'check-update/';// api end point.
		$this->api_urls['plugin-info']  = $base . 'get-plugin-info/';// api end point.
		$this->api_urls['theme-info']   = $base . 'get-theme-info/';// api end point.

		$this->installed_plugins = get_site_option( $this->key_installed, array() );
		$this->installed_themes  = get_site_option( $this->key_installed_themes, array() );

		// just for testing.
		add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'check_update' ) );
		add_filter( 'pre_set_site_transient_update_themes', array( $this, 'check_theme_update' ) );
		// get info, view changelog screen.
		add_filter( 'plugins_api', array( $this, 'get_plugin_info' ), 10, 3 );

		add_filter( 'upgrader_pre_download', array( $this, 'download_package' ), 10, 3 );
	}

	/**
	 * Get singleton.
	 *
	 * @return BuddyDev_Update_Client
	 */
	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Check if a BuddyDev plugin is available for update
	 *
	 * @global string $pagenow
	 *
	 * @param stdClass $current current list.
	 *
	 * @return \stdClass
	 */
	public function check_update( $current ) {

		global $pagenow;

		if ( ! is_object( $current ) ) {
			$current = new stdClass();
		}

		$current->last_checked = time();

		if ( ! function_exists( 'get_plugins' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		$plugins = get_plugins();

		// convert plugin to object.
		$plugin_list = $this->build_plugin_list( $plugins ); // array( 'dir/file.php'=, 'dir2/file.php )/...

		// we have all slugs ready now.
		$slugs = array_keys( $plugin_list );

		$to_send = array( 'component_slugs' => $slugs );
		// send all the slugs to our server.
		/**
		 * API will return data for only the plugins that weer from buddydev
		 */
		$response = $this->get_response( $this->api_urls['check-update'], $to_send );


		if ( empty( $response ) || is_wp_error( $response ) ) {
			return $current;
		}

		foreach ( $response as &$plugin ) {
			$plugin = (object) $plugin;
		}

		$buddydev_plugins = array_keys( $response );

		update_site_option( $this->key_installed, $buddydev_plugins );

		$this->installed_plugins = $buddydev_plugins;

		$updatable = array();

		$access_params = array(
			'buddydev_package' => 1,
		);

		$settings = buddydev_dashboard_get_acocunt_settings();

		if ( ! empty( $settings['access_key'] ) && ! empty( $settings['username'] ) ) {
			$access_params['access_key'] = $settings['access_key'];
			$access_params['u']          = $settings['username'];
		}

		foreach ( $response as $update_candidate => $data ) {
			$current_plugin = $plugin_list[ $update_candidate ]; // ['basename'].

			if ( version_compare( $current_plugin['Version'], $data->new_version, '<' ) ) {

				$base_name   = $current_plugin['basename'];
				$package     = add_query_arg( $access_params, $data->package );
				$plugin_data = array(
					'id'          => $data->id,
					'slug'        => $update_candidate,
					'plugin'      => $base_name,
					'new_version' => $data->new_version,
					'url'         => $current_plugin['PluginURI'],
					'package'     => $package,

				);

				$updatable[] = $update_candidate;

				$current->response[ $base_name ] = (object) $plugin_data;
				unset( $current->no_update[ $base_name ] );
			}
		}

		// save a copy of the slugs of our updatetable plugin.
		update_site_option( $this->key_updatable, $updatable );

		return $current;
	}

	/**
	 * Check for theme update.
	 *
	 * @param stdClass $current current list.
	 *
	 * @return stdClass
	 */
	public function check_theme_update( $current ) {

		if ( ! is_object( $current ) ) {
			$current = new stdClass();
		}

		$current->last_checked = time();

		if ( ! function_exists( 'wp_get_themes' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/theme.php' );
		}

		$themes = wp_get_themes();

		// convert plugin to object.
		$list = $this->build_themes_list( $themes ); // array( 'dir/file.php'=, 'dir2/file.php )/...

		// we have all slugs ready now.
		$slugs = array_keys( $list );

		$to_send = array( 'component_slugs' => $slugs );
		// send all the slugs to our server.
		/**
		 * API will return data for only the plugins that weer from buddydev
		 */
		$response = $this->get_response( $this->api_urls['check-update'], $to_send );

		if ( empty( $response ) || is_wp_error( $response ) ) {
			return $current;
		}

		foreach ( $response as &$package ) {
			$package = (object) $package;
		}

		$buddydev_themes = array_keys( $response );

		update_site_option( $this->key_installed_themes, $buddydev_themes );

		$this->installed_themes = $buddydev_themes;

		$updatable = array();

		$access_params = array(
			'buddydev_package' => 1,
		);

		$settings = buddydev_dashboard_get_acocunt_settings();

		if ( ! empty( $settings['access_key'] ) && ! empty( $settings['username'] ) ) {
			$access_params['access_key'] = $settings['access_key'];
			$access_params['u']          = $settings['username'];
		}

		foreach ( $response as $update_candidate => $data ) {
			$current_theme = $list[ $update_candidate ];

			if ( version_compare( $current_theme['Version'], $data->new_version, '<' ) ) {

				$base_name   = $current_theme['Stylesheet'];
				$package     = add_query_arg( $access_params, $data->package );
				$plugin_data = array(
					'id'          => $data->id,
					'slug'        => $update_candidate,
					'theme'       => $base_name,
					'new_version' => $data->new_version,
					'url'         => $this->api_urls['theme-info'] . '?slug=' . $base_name,
					'package'     => $package,
				);

				$updatable[] = $update_candidate;

				$current->response[ $base_name ] = $plugin_data;
				unset( $current->no_update[ $base_name ] );
			}
		}

		// save a copy of the slugs of our updatetable plugin.
		update_site_option( $this->key_updatable_themes, $updatable );

		return $current;
	}

	/**
	 * Create an array of themes.
	 *
	 * @param WP_Theme[] $themes themes array.
	 *
	 * @return array
	 */
	public function build_themes_list( $themes ) {
		$theme_details = array();

		foreach ( $themes as $theme ) {
			$theme_details[ $theme->get_stylesheet() ] = array(
				'Name'       => $theme->get( 'Name' ),
				'Title'      => $theme->get( 'Name' ),
				'Version'    => $theme->get( 'Version' ),
				'Author'     => $theme->get( 'Author' ),
				'Author URI' => $theme->get( 'AuthorURI' ),
				'ThemeURI'   => $theme->get( 'ThemeURI' ),
				'Template'   => $theme->get_template(),
				'Stylesheet' => $theme->get_stylesheet(),
			);
		}

		return $theme_details;
	}

	/**
	 * Hook to plugins_api and shows the plugin details if it is from BuddyDev
	 *
	 * @param Object $data data.
	 * @param string $action action.
	 * @param array  $args extra args.
	 *
	 * @return Object
	 */
	public function get_plugin_info( $data, $action = '', $args = null ) {

		/**
		 * stdClass Object (
		 * [slug] => plugin-slug
		 * [is_ssl] =>
		 * [fields] => Array (
		 *                [banners] => 1
		 *                [reviews] => 1
		 *                [downloaded] =>
		 *                [active_installs] => 1
		 *  )
		 * [per_page] => 24
		 * [locale] => en_US )
		 */
		// it is not what we are looking for.
		if ( $action != 'plugin_information' ) {
			return $data;
		}

		// make sure it is our buddydev plugin.
		if ( ! isset( $args->slug ) || ! in_array( $args->slug, $this->installed_plugins ) ) {
			return $data;
		}

		$to_send = array(
			'slug'   => $args->slug,
			'is_ssl' => is_ssl(),
			'fields' => array(
				'banners' => false, // These will be supported soon hopefully.
				'reviews' => false,
			),
		);

		$response = $this->get_response( $this->api_urls['plugin-info'], $to_send );

		if ( empty( $response ) || is_wp_error( $response ) ) {
			return $data;
		}
		$data = (object) $response;

		return $data;
	}

	/**
	 * Filet rhe download_package on upgrader and handle downloading from BuddyDev site if the access key is provide, if access key is not provided, It is normal update, no worries about it.
	 *
	 * @param string      $downloaded downloaded url.
	 * @param string      $package package url.
	 * @param WP_Upgrader $upgrader upgrader object.
	 *
	 * @return \WP_Error
	 */
	public function download_package( $downloaded, $package, $upgrader ) {


		if ( empty( $package ) ) {
			return new WP_Error( 'no_package', $upgrader->strings['no_package'] );
		}
		// parse quer.
		$args = parse_url( $package, PHP_URL_QUERY );

		if ( empty( $args ) ) {
			return $downloaded;
		}

		$args = wp_parse_args( $args );
		// not our package.
		if ( empty( $args['buddydev_package'] ) ) {
			return $downloaded;
		}

		$package  = explode( '?', $package );
		$package  = $package[0];// original url.
		$settings = buddydev_dashboard_get_acocunt_settings();

		if ( empty( $settings['access_key'] ) || empty( $settings['username'] ) ) {
			return $downloaded;
		}

		$access_params = array(
			'buddydev_package' => 1,
			'access_key'       => $settings['access_key'],
			'u'                => $settings['username'],
		);

		$package = add_query_arg( $access_params, $package );

		$upgrader->skin->feedback( 'downloading_package', $package );

		$download_file = download_url( $package );

		if ( is_wp_error( $download_file ) ) {
			//	$response = $this->get_response( $this->api_urls['check_key'], $data)
			$error_code = $download_file->get_error_code();

			if ( $error_code === 'http_404' ) {
				$message = 'If it is a BuddyDev premium plugin or theme, Please make sure that you have a valid BuddyDev access key and an active membership/purchase for this item';
			} else {
				$message = $download_file->get_error_message();
			}

			return new WP_Error( 'download_failed', $upgrader->strings['download_failed'], $message );
		}

		return $download_file;
		// download.
	}

	/**
	 * Post a request to the given url and assuming that the returned data is json, decode it and return
	 *
	 * @global string $wp_version
	 *
	 * @param string $url api url.
	 * @param array  $data data to be sent.
	 *
	 * @return boolean
	 */
	private function get_response( $url, $data ) {

		global $wp_version;

		// build request.
		$timeout = 15;
		$options = array(
			'timeout'    => $timeout,
			'body'       => $data,
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo( 'url' ),
		);

		$raw_response = wp_remote_post( $url, $options );

		if ( is_wp_error( $raw_response ) || 200 != wp_remote_retrieve_response_code( $raw_response ) ) {
			return false;
		}

		$response = json_decode( trim( wp_remote_retrieve_body( $raw_response ) ), true );

		return $response;
	}


	/**
	 * Build an array keyed by the slug, keep original plugin main file in the data
	 * $new_plugins[$plugin-slug] = array('plugin object etc )
	 *
	 * @param array $plugins plugin array.
	 *
	 * @return array
	 */
	private function build_plugin_list( $plugins ) {

		$new_plugins = array();

		foreach ( $plugins as $plugin_file => $data ) {
			// extract slug based on the premise that dir name is same as slug.
			$slug = $this->strip_file( $plugin_file );

			// store original plugin file 'some-dir-something/some-plugin-name.php' as the basename for futuer use.
			$data['basename'] = $plugin_file;

			$new_plugins[ $slug ] = $data;
		}

		return $new_plugins;
	}

	/**
	 * Breaks a string of the format something/alphabeta and returns first part without any slash
	 *
	 * @param string $plugin plugin path.
	 *
	 * @return string
	 */
	private function strip_file( $plugin ) {
		$plugin = explode( '/', $plugin );

		// first part.
		return stripslashes( $plugin[0] );
	}

}

BuddyDev_Update_Client::get_instance();
