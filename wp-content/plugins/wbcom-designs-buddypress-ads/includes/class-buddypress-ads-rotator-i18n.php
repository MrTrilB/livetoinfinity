<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://wbcomdesigns.com
 * @since      1.0.0
 *
 * @package    Buddypress_Ads_Rotator
 * @subpackage Buddypress_Ads_Rotator/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Buddypress_Ads_Rotator
 * @subpackage Buddypress_Ads_Rotator/includes
 * @author     WB COM <admin@wbcomdesigns.com>
 */
class Buddypress_Ads_Rotator_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'buddypress-ads-rotator',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
