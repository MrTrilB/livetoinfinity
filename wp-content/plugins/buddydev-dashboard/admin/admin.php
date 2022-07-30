<?php

class BuddyDev_Client_Admin {

	private $page;
	private $option_name = 'buddydev-dashboard-settings';

	public function __construct() {

		//create a options page
		//make sure to read the code below
		$this->page = new OptionsBuddy_Settings_Page( $this->option_name );
		//$this->page->use_single_option();//make it to use bp_get_option/bp_update_option
		$this->page->set_network_mode();//make it to use bp_get_option/bp_update_option

		if ( is_multisite() ) {
			$hook = 'network_admin_menu';
		} else {
			$hook = 'admin_menu';
		}

		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( $hook, array( $this, 'admin_menu' ) );
		add_action( 'admin_footer', array( $this, 'admin_css' ) );
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );

		if ( is_multisite() ) {
			add_action( 'pre_update_option_' . $this->option_name, array( $this, 'sync_options' ), 10, 2 );
		}
	}

	public function admin_init() {

		//set the settings

		$page = $this->page;
		//add_section
		//you can pass section_id, section_title, section_description, the section id must be unique for this page, section descriptiopn is optional
		$page->add_section( 'basic_section', __( 'BuddyDev License settings', 'buddydev-dashboard' ), __( 'Use your secret keys.', 'buddydev-dashboard' ) );


		//add fields
		$page->get_section( 'basic_section' )->add_fields( array( //remember, we registered basic section earlier
			/*array(
				'name'		=> 'access_key',
				'label'		=> __( 'Access Key?', 'buddydev-dashboard' ),//you already know it from previous example
				'desc'		=> __( 'Please enter your access key(Required for updating premium plugins ). You can find it under your account->settings on BuddyDev.com', 'buddydev-dashboard' ),// this is used as the description of the field
				'type'		=> 'text',
				'default'	=> '',

			),
			array(
				'name'		=> 'username',
				'label'		=> __( 'Your BuddyDev username?', 'buddydev-dashboard' ),//you already know it from previous example
				'desc'		=> __( 'Please enter your BUddyDev.com username. The combination of accesskey/username is used to validate your subscription', 'buddydev-dashboard' ),// this is used as the description of the field
				'type'		=> 'text',
				'default'	=> '',

			),*/
			array(
				'name'        => 'buddydev-account',
				'type'        => 'buddydevaccount',
				'default'     => array(
					'access_key' => '',
					'username'   => ''
				),
				'sanitize_cb' => 'buddydevaccount_validate',
			)

		) );

		$page->init();
	}

	public function admin_menu() {

		if ( is_multisite() ) {
			$parent = 'settings.php';
		} else {
			$parent = 'options-general.php';//sorry for the repeat, had other plans but ropping at last moment
		}
		add_submenu_page( $parent, __( 'BuddyDev Dashboard', 'buddydev-dashboard' ), __( 'BuddyDev Dashboard', 'buddydev-dashboard' ), 'manage_options', 'buddydev-dashboard', array(
			$this->page,
			'render'
		) );
		//add_management_page( __( 'BuddyDev Dashboard', 'buddydev-dashboard' ), __( 'BuddyDev Dashboard', 'buddydev-dashboard' ), 'manage_options', 'buddydev-dashboard', array( $this->page, 'render' ) );
	}


	/**
	 * Returns all the settings fields
	 *
	 * @return array settings fields
	 */

	public function admin_css() {

		if ( ! isset( $_GET['page'] ) || $_GET['page'] != 'buddydev-dashboard' ) {
			return;
		}

		?>

		<style type="text/css">
			.wrap .form-table {
				margin: 10px;
			}

		</style>

		<?php

	}

	public function admin_notices() {

		$notices = buddydev_dashboad()->get_notices();

		if ( empty( $notices ) ) {
			return;
		}

		$notices = join( '<br>', $notices );
		?>
		<div class="updated">
			<?php echo $notices; ?>
		</div>
		<?php
	}

	public function sync_options( $value, $old_value ) {
		update_site_option( $this->option_name, $value );
		return $value;
	}
}

new BuddyDev_Client_Admin();