<?php
// Do not allow direct access over web.
defined( 'ABSPATH' ) || exit;

/**
 * Get settings.
 *
 * @return array
 */
function buddydev_dashboard_get_settings() {
	return get_site_option( 'buddydev-dashboard-settings' );
}

/**
 * Get settings array.
 *
 * @return array (username=>'', 'access_key' => '' )
 */
function buddydev_dashboard_get_acocunt_settings() {

	$option = buddydev_dashboard_get_settings();

	if ( ! isset( $option['buddydev-account'] ) ) {
		return array();
	}

	return $option['buddydev-account'];
}
