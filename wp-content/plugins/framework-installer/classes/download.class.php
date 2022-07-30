<?php
/**
 * User: gen
 * Date: 05/04/18
 * Time: 10:32
 */

class Toolset_Framework_Installer_Download extends Toolset_Framework_Installer_Install_Step {

	/**
	 * Step 1. Download files
	 * @return array
	 */
	function download_site(){
		$this->remove_speed_test_results();

		$demo_file_name = 'files' . $this->use_optimized_prefix() . '.zip';
		if ( isset( $_POST['wpml'] ) && $_POST['wpml'] === 'wpml' ) {
			$demo_file_name = 'files_wpml' . $this->use_optimized_prefix() . '.zip';
		}

		$download_demo_file = $this->is_file_downloaded( true, $demo_file_name );

		if ( $download_demo_file ) {
			$download_url = $this->current_site->download_url . '/' . $demo_file_name;

			$status = $this->framework_installer->download_file( $download_url, $this->dest );

			if ( ! $status ) {
				return $this->generate_respose( false, __( 'Cannot download demo files', 'wpvdemo' ) );
			}
		}

		//Download theme files only on standalone site.
		if ( ! $this->framework_installer->is_discoverwp() && ! is_multisite() ) {
			$theme = $this->get_selected_theme();
			if ( ! $this->is_theme_installed( $theme, $this->get_theme_version() ) ) {
				$theme_url = FIDEMO_URL . '/_reference_sites/_themes/' . $theme . '.zip';
				$status = $this->framework_installer->download_file( $theme_url, $this->theme_dest );

				if ( ! $status ) {
					return $this->generate_respose( false, __( 'Cannot download demo files', 'wpvdemo' ) );
				}
			}

			$parent_theme = $this->get_parent_theme();
			if ( ! empty( $parent_theme ) ) {
				if ( ! $this->is_theme_installed( $this->get_parent_theme(), $this->get_parent_theme_version() ) ) {
					$theme_url = FIDEMO_URL . '/_reference_sites/_themes/' . $this->get_parent_theme() . '.zip';
					$status = $this->framework_installer->download_file( $theme_url, $this->theme_parent_dest );

					if ( ! $status ) {
						return $this->generate_respose( false, __( 'Cannot download demo files', 'wpvdemo' ) );
					}
				}
			}
		}

		return $this->generate_respose( true, __( 'Files successfully downloaded', 'wpvdemo' ) );
	}

	/**
	 * Remove speed test result before download
	 */
	function remove_speed_test_results() {
		delete_option('fidemo_connection_test');
	}

	/**
	 * Checks whether the current site download file exists and matches the destination one for a temptative download.
	 *
	 * Depite its name, returns FALSE if the files exist and match, $download_demo_file otherwise.
	 * Hence returns FALSE when a new ownload is not required, ergo file is already donloaded. Yeah.
	 *
	 * @param bool $download_demo_file
	 * @param string $demo_file_name
	 * @return bool
	 */
	function is_file_downloaded( $download_demo_file, $demo_file_name ) {
		if ( file_exists( $this->dest ) ) {
			if ( isset( $this->current_site->downloads->$demo_file_name ) ) {
				$local_file_size = filesize( $this->dest );
				if ( $local_file_size === $this->current_site->downloads->$demo_file_name ) {
					$download_demo_file = false;
				}
			}
		}
		return $download_demo_file;
	}

}
