<?php
/**
 * Date: 05/04/18
 * Time: 10:44
 */
class Toolset_Framework_Installer_Finalize extends Toolset_Framework_Installer_Install_Step {

	/**
	 * Step 5: Send stats and generate final message
	 *
	 * @return array
	 */
	public function finalize_site() {

		// Send stats
		do_action( 'fidemo_log_refsites_to_toolset' );

		// Set current installed site
		update_option( 'fidemo_installed', $this->current_site->shortname );
		$theme = $this->get_selected_theme();

		// Update permalink structure
		$this->update_permlinks_structure();

		// Show final message
		$output = '<div class="fidemo-notice-success">'
			. '<div class="fidemo-notice-icon"><i class="fa fa-check-circle"></i></div>'
			. '<div class="fidemo-notice-content">'
			. sprintf( __( 'The reference site was successfully imported. We\'ve activated the theme: %s. This test site should look the same as our reference site.', 'wpvdemo' ), ucwords( $theme ) ) //phpcs:ignore
			. '</div>'
			. '</div>';

		$output .= '<p>
			<a class="button button-big button-primary" href="'
			. admin_url()
			. '">'
			. __( 'Get Started', 'wpvdemo' )
			. '</a>';

		$output .= '</p>';

		$data = $this->generate_respose_error( true, $output );

		return $data;
	}


	/**
	 * Set permalinks structure to 'Post name' and flush rewrite rules
	 */
	public function update_permlinks_structure() {
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure( '/%postname%/' );
		update_option( 'rewrite_rules', false );
		$wp_rewrite->flush_rules( true );
	}

}
