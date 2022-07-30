<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wbcomdesigns.com
 * @since      1.0.0
 *
 * @package    Buddypress_Ads_Rotator
 * @subpackage Buddypress_Ads_Rotator/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="wbcom-tab-content">
	<div class="wbcom-welcome-main-wrapper">
		<div class="wbcom-welcome-head">
			<h2 class="wbcom-welcome-title"><?php esc_html_e( 'BuddyPress Ads', 'buddypress-ads-rotator' ); ?></h2>
			<p class="wbcom-welcome-description">
			<?php esc_html_e( 'BuddyPress Ads Plugin will help you to display your Ads on BuddyPress Activity Streams. You can decide the position where you allow to display ads like on Sitewide Activity Stream , Group Activity Stream, Member Activity Stream.', 'buddypress-ads-rotator' ); ?>
			</p>
		</div><!-- .wbcom-welcome-head -->

		<div class="wbcom-welcome-content">

			<div class="wbcom-video-link-wrapper">

			</div>

			<div class="wbcom-welcome-support-info">
				<h3><?php esc_html_e( 'Help &amp; Support Resources', 'buddypress-ads-rotator' ); ?></h3>
				<p><?php esc_html_e( 'Here are all the resources you may need to get help from us. Documentation is usually the best place to start. Should you require help anytime, our customer care team is available to assist you at the support center.', 'buddypress-ads-rotator' ); ?></p>
				<hr>

				<div class="three-col">

					<div class="col">
						<h3><span class="dashicons dashicons-book"></span><?php esc_html_e( 'Documentation', 'buddypress-ads-rotator' ); ?></h3>
						<p><?php esc_html_e( 'We have prepared an extensive guide on BuddyPress Ads to learn all aspects of the plugin. You will find most of your answers here.', 'buddypress-ads-rotator' ); ?></p>
						<a href="<?php echo esc_url( 'https://wbcomdesigns.com/docs/buddypress-free-addons/buddypress-ads/' ); ?>" class="button button-primary button-welcome-support" target="_blank"><?php esc_html_e( 'Read Documentation', 'buddypress-ads-rotator' ); ?></a>
					</div>

					<div class="col">
						<h3><span class="dashicons dashicons-sos"></span><?php esc_html_e( 'Support Center', 'buddypress-ads-rotator' ); ?></h3>
						<p><?php esc_html_e( 'We strive to offer the best customer care via our support center. Once your theme is activated, you can ask us for help anytime.', 'buddypress-ads-rotator' ); ?></p>
						<a href="<?php echo esc_url( 'https://wbcomdesigns.com/support/' ); ?>" class="button button-primary button-welcome-support" target="_blank"><?php esc_html_e( 'Get Support', 'buddypress-ads-rotator' ); ?></a>
					</div>

					<div class="col">
						<h3><span class="dashicons dashicons-admin-comments"></span><?php esc_html_e( 'Got Feedback?', 'buddypress-ads-rotator' ); ?></h3>
						<p><?php esc_html_e( 'We want to hear about your experience with the plugin. We would also love to hear any suggestions you may for future updates.', 'buddypress-ads-rotator' ); ?></p>
						<a href="<?php echo esc_url( 'https://wbcomdesigns.com/contact/' ); ?>" class="button button-primary button-welcome-support" target="_blank"><?php esc_html_e( 'Send Feedback', 'buddypress-ads-rotator' ); ?></a>
					</div>

				</div>

			</div>
		</div>
	</div><!-- .wbcom-welcome-main-wrapper -->
</div><!-- .wbcom-tab-content -->
