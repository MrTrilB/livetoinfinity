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
<div class="wb-ads-adming-setting">
	<div class="wb-ads-tab-header">
		<h3><?php esc_html_e( 'FAQ(s) ', 'buddypress-ads-rotator' ); ?></h3>
		<input type="hidden" class="wb-ads-tab-active" value="support"/>
	</div>

	<div class="wb-ads-admin-settings-block">
		<div id="wb-ads-settings-tbl" class="wb-ads-table">
			<div class="wb-ads-admin-row border">
				<div class="wb-ads-admin-col-12">
					<button class="wb-ads-accordion">
						<?php esc_html_e( 'Does This plugin requires BuddyPress?', 'buddypress-ads-rotator' ); ?>
					</button>
					<div class="wb-ads-panel">
						<p> 
							<?php esc_html_e( 'Yes, It needs you to have BuddyPress installed and activated.', 'buddypress-ads-rotator' ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="wb-ads-admin-row border">
				<div class="wb-ads-admin-col-12">
					<button class="wb-ads-accordion">
						<?php esc_html_e( 'What to do after activated the plugin?', 'buddypress-ads-rotator' ); ?>
					</button>
					<div class="wb-ads-panel">
						<p> 
							<?php esc_html_e( 'You need to add your Ads from WB Ads CPT.', 'buddypress-ads-rotator' ); ?>     
						</p>
					</div>
				</div>
			</div>
			<div class="wb-ads-admin-row border">
				<div class="wb-ads-admin-col-12">
					<button class="wb-ads-accordion">
						<?php esc_html_e( 'Where can we display the Ads?', 'buddypress-ads-rotator' ); ?>
					</button>
					<div class="wb-ads-panel">
						<p> 
							<?php esc_html_e( 'You can display the ads on buddypress Acivity Stream, Group Activity Stream and Members Activity Stream. and you can manage the activity positions for particular ads.', 'buddypress-ads-rotator' ); ?>    
						</p>
					</div>
				</div>
			</div>
			<div class="wb-ads-admin-row border">
				<div class="wb-ads-admin-col-12">
					<button class="wb-ads-accordion">
						<?php esc_html_e( 'Can I hide the spacific Ad?', 'buddypress-ads-rotator' ); ?>
					</button>
					<div class="wb-ads-panel">
						<p> 
							<?php esc_html_e( 'Yes, you can hide the spepcific ad from the CPT ads listing.', 'buddypress-ads-rotator' ); ?>    
						</p>
					</div>
				</div>
			</div>
			<div class="wb-ads-admin-row border">
				<div class="wb-ads-admin-col-12">
					<button class="wb-ads-accordion">
						<?php esc_html_e( 'Can I display and hide ads for mobile and desktop device?', 'buddypress-ads-rotator' ); ?>
					</button>
					<div class="wb-ads-panel">
						<p> 
							<?php esc_html_e( 'Yes, you can display and hide the ads for specific device( Mobile and Desktop ) .', 'buddypress-ads-rotator' ); ?>    
						</p>
					</div>
				</div>
			</div>
			<div class="wb-ads-admin-row border">
				<div class="wb-ads-admin-col-12">
					<button class="wb-ads-accordion">
						<?php esc_html_e( 'Can I display and hide the ads for logged-in visitor or logged-out visitor?', 'buddypress-ads-rotator' ); ?>
					</button>
					<div class="wb-ads-panel">
						<p> 
							<?php esc_html_e( 'Yes, you can display and hide the ads for logged-in visitor or logged-out visitor.', 'buddypress-ads-rotator' ); ?>    
						</p>
					</div>
				</div>
			</div>
			<div class="wb-ads-admin-row border">
				<div class="wb-ads-admin-col-12">
					<button class="wb-ads-accordion">
						<?php esc_html_e( 'Can I manage the ads layout?', 'buddypress-ads-rotator' ); ?>
					</button>
					<div class="wb-ads-panel">
						<p> 
							<?php esc_html_e( 'Yes, you can manage the ads layout with following options :-', 'buddypress-ads-rotator' ); ?>    
						</p>
						<ul>
							<li><?php esc_html_e( 'Ads Position ( left,center,right )', 'buddypress-ads-rotator' ); ?></li>
							<li><?php esc_html_e( 'Margin ( margin-top,margin-right,margin-bottom,margin-left )', 'buddypress-ads-rotator' ); ?></li>
							<li><?php esc_html_e( 'Container ID ( you can add custom ID for ads. )', 'buddypress-ads-rotator' ); ?></li>
							<li><?php esc_html_e( 'Container Classes ( you can add custom Class for ads. )', 'buddypress-ads-rotator' ); ?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

