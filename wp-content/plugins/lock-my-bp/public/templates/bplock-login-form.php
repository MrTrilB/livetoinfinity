<?php
/**
 * BuddyPress Login form template.
 *
 * @link       http://www.wbcomdesigns.com
 * @since      1.0.0
 *
 * @package    Bp_Lock
 * @subpackage Bp_Lock/public/templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="bplock-login-form-container">
	<div class="isa_success  bplock-message" id="bplock-login-success">
		<i class="fa fa-check"></i>
	</div>
	<div class="isa_error  bplock-message" id="bplock-login-error">
		<i class="fa fa-times-circle"></i>
	</div>
	<div class="isa_info bplock-message" id="bplock-login-details-empty">
		<i class="fa fa-info-circle"></i><?php esc_html_e( 'Either of the detail is empty!', 'bp-lock' ); ?>
	</div>

	<p><input type="text" placeholder="<?php esc_attr_e( 'Username', 'bp-lock' ); ?>" id="bplock-login-username"></p>
	<p><input type="password" placeholder="<?php esc_attr_e( 'Password', 'bp-lock' ); ?>" id="bplock-login-password"></p>
	<?php do_action( 'bp_lock_after_login_form' ); ?>
	<p><button id="bplock-login-btn"><?php esc_html_e( 'Login', 'bp-lock' ); ?></button>
	<?php $users_can_register = get_option( 'users_can_register' ); ?>
	<?php if ( $users_can_register ) { ?>
		<p><?php esc_html_e( 'New to this site?', 'bp-lock' ); ?> <a href="javascript:void(0);" id="bplock-user-register"><?php esc_html_e( 'Register', 'bp-lock' ); ?></a> <?php esc_html_e( 'here!', 'bp-lock' ); ?></p>
	<?php } ?>
</div>
