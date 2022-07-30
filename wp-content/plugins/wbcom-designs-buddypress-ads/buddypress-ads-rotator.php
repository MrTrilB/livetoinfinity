<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wbcomdesigns.com
 * @since             1.0.0
 * @package           Buddypress_Ads
 *
 * @wordpress-plugin
 * Plugin Name:       Wbcom Designs - BuddyPress Ads
 * Plugin URI:        https://wbcomdesigns.com/downloads/buddypress-ads/
 * Description:       Integrate your BuddyPress community to provide a smooth customer experience and increase site engagement.
 * Version:           1.4.0
 * Author:            Wbcom Designs
 * Author URI:        https://wbcomdesigns.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       buddypress-ads-rotator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BUDDYPRESS_ADS_ROTATOR_VERSION', '1.4.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-buddypress-ads-rotator-activator.php
 */
function activate_buddypress_ads_rotator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-buddypress-ads-rotator-activator.php';
	Buddypress_Ads_Rotator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-buddypress-ads-rotator-deactivator.php
 */
function deactivate_buddypress_ads_rotator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-buddypress-ads-rotator-deactivator.php';
	Buddypress_Ads_Rotator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_buddypress_ads_rotator' );
register_deactivation_hook( __FILE__, 'deactivate_buddypress_ads_rotator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-buddypress-ads-rotator.php';

/**
 * This Function checks the required plugin.
 */
function wb_ads_rotator_check_required_plugin() {

	if ( ! class_exists( 'BuddyPress' ) ) {
		add_action( 'admin_notices', 'wb_ads_rotator_admin_notice' );
		add_action( 'admin_init', 'wb_ads_rotator_existing_checkin_plugin' );
	} else {
		register_activation_hook( __FILE__, 'activate_buddypress_ads_rotator' );
	}
}
add_action( 'plugins_loaded', 'wb_ads_rotator_check_required_plugin' );
/**
 * Display required plugin admin notice.
 */
function wb_ads_rotator_admin_notice() {
	$wb_ads_rotator_plugin = __( 'BuddyPress Ads', 'buddypress-ads-rotator' );
	$buddypress_plugin     = __( 'BuddyPress', 'buddypress-ads-rotator' );
	echo '<div class="error"><p>'
	/* translators: %1$s: BuddyPress Ads ;  %2$s: BuddyPress*/
	. sprintf( esc_html__( '%1$s is ineffective as it requires %2$s to be installed and active.', 'buddypress-ads-rotator' ), '<strong>' . esc_attr( $wb_ads_rotator_plugin ) . '</strong>', '<strong>' . esc_attr( $buddypress_plugin ) . '</strong>' )
	. '</p></div>';
	if ( null !== filter_input( INPUT_GET, 'activate' ) ) {
		$activate = filter_input( INPUT_GET, 'activate' );
		unset( $activate );
	}
}

/**
 * Function to remove wb ads rotator plugin if already exist.
 *
 * @since 1.0.0
 */
function wb_ads_rotator_existing_checkin_plugin() {
	$wb_ads_rotator_plugin = plugin_dir_path( __DIR__ ) . 'buddypress-ads-rotator/buddypress-ads-rotator';
	// Check to see if plugin is already active.
	if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}
}

/**
 * Redirect to plugin settings page after activated.
 *
 * @since  1.0.0
 *
 * @param string $plugin Path to the plugin file relative to the plugins directory.
 */
function wb_ads_rotator_activation_redirect_settings( $plugin ) {

	if ( plugin_basename( __FILE__ ) === $plugin && class_exists( 'BuddyPress' ) ) {
		wp_safe_redirect( admin_url( 'admin.php?page=buddypress-ads-rotator-settings' ) );
		exit;
	}
}
add_action( 'activated_plugin', 'wb_ads_rotator_activation_redirect_settings' );


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_buddypress_ads_rotator() {

	$plugin = new Buddypress_Ads_Rotator();
	$plugin->run();
}
run_buddypress_ads_rotator();
