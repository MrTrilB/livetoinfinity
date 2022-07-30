<?php
/**
 * Plugin Name: SuitePlugins - Advanced XProfile Fields for BuddyPress
 * Plugin URI:  http://suiteplugins.com
 * Description: Enhance your BuddyPress profile fields with Advanced XProfile Fields for BuddyPress. Manage fields labels, validation and show fields in admin.
 * Author:      SuitePlugins
 * Author URI:  http://suiteplugins.com
 * Version:     1.0.4.2
 * Text Domain: sp-advanced-xprofile
 * Domain Path: /languages/
 * License:     GPLv2 or later (license.txt)
 *
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 *  XProfile Advanced Labels
 */
if ( ! class_exists( 'SP_Advanced_XProfile' ) ) :
	/**
	*
	*/
	class SP_Advanced_XProfile {
		/**
		 * Current XProfile ID.
		 *
		 * @var integer
		 */
		public $id;

		protected static $_instance = null;
		/**
		 * Main SP_Advanced_XProfile Instance
		 *
		 * Ensures only one instance of SP_Advanced_XProfile is loaded or can be loaded.
		 *
		 * @static
		 * @return SP_Advanced_XProfile - Main instance
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
		/**
		 * Initiate construct
		 */
		public function __construct() {
			$this->id = 'sp_xprofile';
			if ( bp_is_active( 'xprofile' ) ) {
				add_action( 'xprofile_field_after_contentbox', array( $this, 'add_content_box' ), 12, 1 );
				add_action( 'xprofile_fields_saved_field', array( $this, 'save_options' ), 12, 1 );
				add_filter( 'bp_get_the_profile_field_name', array( $this, 'sp_replace_labels' ), 12, 1 );
				add_filter( 'bp_has_profile', array( $this, 'sp_make_noneditable' ), 12, 2 );
				add_filter( 'bp_has_profile', array( $this, 'sp_hide_registration_fields' ), 12, 2 );
				add_action( 'bp_after_profile_edit_content', array( $this, 'add_validation' ) );
				add_action( 'bp_after_register_page', array( $this, 'add_validation' ) );
				add_filter( 'manage_users_columns', array( $this, 'add_bp_field_colums' ) );
				add_action( 'manage_users_custom_column', array( $this, 'bp_field_column_content' ), 10, 3 );
			}
		}
		/**
		 * [field_value description]
		 * @param  [type] $value [description]
		 * @return [type]        [description]
		 */
		public function field_value( $value ) {
			if ( ! empty( $value ) ) {
				return sanitize_text_field( $value );
			}
		}
		/**
		 * [add_content_box description]
		 * @param [type] $field [description]
		 */
		public function add_content_box( $field ) {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui-tabs' );
			do_action( 'sp_before_advanced_xprofile_fields', $field );
			$labels             = bp_xprofile_get_meta( $field->id, 'field', $this->id . '_labels' );
			$r                  = wp_parse_args( $labels, array(
				'registration' => '',
				'self'         => '',
				'user'         => '',
				'edit'         => '',
				'admin'        => '',
			));
			$validation_methods = bp_xprofile_get_meta( $field->id, 'field', $this->id . '_validation' );
			$v                  = wp_parse_args( $validation_methods, array(
				'enable'      => array(
					'char_limit'  => 0,
					'min_chars'   => 0,
					'text_format' => 0,
				),
				'char_limit'  => '',
				'min_chars'   => '',
				'text_format' => '',
			));
			$option_values = bp_xprofile_get_meta( $field->id, 'field', $this->id . '_options' );
			$options = wp_parse_args( $option_values, array(
				'hide_registration' => '',
				'admin_approval'    => '',
				'admin_column'      => '',
				'non_editable'      => '',
			));
			include( 'admin/template/metabox.php' );
			do_action( 'sp_after_advanced_xprofile_fields', $field );
		}

		public function save_options( $field = array() ) {
			$advanced_xprofile = isset( $_POST['advanced_xprofile'] ) ? 
                          wp_unslash( $_POST['advanced_xprofile'] ) :
						  array();
						  
			$advanced_xprofile_validation = isset( $_POST['advanced_xprofile_validation'] ) ? 
                          wp_unslash( $_POST['advanced_xprofile_validation'] ) :
						  array();
						  
			$advanced_xprofile_options = isset( $_POST['advanced_xprofile_options'] ) ? 
                          wp_unslash( $_POST['advanced_xprofile_options'] ) :
                          array();
			bp_xprofile_update_field_meta( $field->id, $this->id . '_labels', $advanced_xprofile );
			if ( ! empty( $advanced_xprofile_options ) ) {
				bp_xprofile_update_field_meta( $field->id, $this->id . '_options', $advanced_xprofile_options );
			} else {
				bp_xprofile_delete_meta( $field->id, 'field', $this->id . '_options' );
			}
			
			if ( ! empty( $advanced_xprofile_validation ) ) {
				bp_xprofile_update_field_meta( $field->id, $this->id . '_validation', $advanced_xprofile_validation );
			} else {
				bp_xprofile_delete_meta( $field->id, 'field', $this->id . '_validation' );
			}
			//Save Admin Columns
			$user_columns = get_option( $this->id . 'user_columns' );
			if ( empty( $user_columns ) ) {
				$user_columns = array();
			}
			if ( ! empty( $_POST['advanced_xprofile_options']['admin_column'] ) ) :
				$user_columns[] = $field->id;
			else :
				if ( in_array( $field->id, $user_columns ) ) {
					if ( ( $key = array_search( $field->id, $user_columns ) ) !== false ) {
						unset( $user_columns[ $key ] );
					}
				}
			endif;

			update_option( $this->id . 'user_columns', $user_columns );
		}

		public function sp_replace_labels( $name ) {
			global $field, $bp;
			$labels = bp_xprofile_get_meta( $field->id, 'field', $this->id . '_labels' );
			$r      = wp_parse_args( $labels, array(
				'registration' => $field->name,
				'self'         => $field->name,
				'user'         => $field->name,
				'edit'         => $field->name,
			));
			if ( 'profile' == $bp->current_component && 'edit' == $bp->current_action ) :
				$name = $r['edit'] ? $r['edit'] : $name;
			elseif ( 'profile' == $bp->current_component && 'public' == $bp->current_action ) :
				if ( $bp->displayed_user->id == $bp->loggedin_user->id ) :
					$name = $r['self'] ? $r['self'] : $name;
				else :
					$name = $r['user'] ? $r['user'] : $name;
				endif;
				elseif ( 'register' == $bp->current_component ) :
					$name = $r['registration'] ? $r['registration'] : $name;
			endif;
				return $name;
		}

		public function sp_hide_registration_fields( $has_groups, $profile_template ) {
			global $bp;
			$user_id = $profile_template->user_id;
			if ( 'register' == $bp->current_component ) {
				if ( ! empty( $profile_template->groups ) ) {
					$keep_group = array();
					$group_inc = 0;
					foreach ( $profile_template->groups as $group ) {
						if ( ! empty( $group->fields ) ) {
								$keep_field = array();
							foreach ( $group->fields as $field) {
								$option_values = bp_xprofile_get_meta( $field->id, 'field', $this->id.'_options' );
								if ( empty( $option_values['hide_registration'] ) || $option_values['hide_registration'] != 1 ) :
									$keep_field[] = $field;
								endif;
							}
							if ( ! empty( $keep_field ) ) :
								$profile_template->groups[ $group_inc ]->fields = $keep_field;
							else :
									unset( $profile_template->groups[ $group_inc ] );
							endif;
						}
						$group_inc++;
					}
				}
			}
			return $profile_template;
		}
		public function sp_make_noneditable( $has_groups = array(), $profile_template) {
			global $bp;
			if ( current_user_can( 'edit_users' ) ) {
				return $profile_template;
			}
			$user_id = $profile_template->user_id;
			if ( $bp->current_component == 'profile' ) {
				if ( ! empty( $profile_template->groups ) ) {
					$keep_group = array();
					$group_inc = 0;
					foreach ( $profile_template->groups as $group ) {
						if ( ! empty( $group->fields ) ) {
							$keep_field = array();
							foreach ( $group->fields as $field) {
								$option_values = bp_xprofile_get_meta( $field->id, 'field', $this->id . '_options' );
								if ( empty( $option_values['non_editable'] ) || 1 != $option_values['non_editable'] && ! empty( $field->value ) ) :
									$keep_field[] = $field;
								endif;
							}
							if ( ! empty( $keep_field ) ) :
								$profile_template->groups[ $group_inc ]->fields = $keep_field;
							else :
									unset( $profile_template->groups[ $group_inc ] );
							endif;
						}
						$group_inc++;
					}
				}
			}
			return $profile_template;
		}
		/**
		 * Add Validation
		 */
		public function add_validation() {
			global $wpdb, $bp;
			$field_ids = $wpdb->get_col( $wpdb->prepare( "SELECT id FROM {$bp->profile->table_name_fields} WHERE group_id = %d", bp_get_current_profile_group_id() ) );
			if ( ! empty( $field_ids ) ) :
			?>
			<script type="text/javascript" src="//cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
			<script type="text/javascript">
			jQuery(document).ready(function($) {
			$.validator.addMethod("alpha", function(value, element) {
				return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
			}, "<?php esc_html_e( 'Please enter only letters', 'sp-advanced-xprofile' ); ?>");

			$.validator.addMethod("alphanumeric", function(value, element) {
				return this.optional(element) || /^\w+$/i.test(value);
			}, "<?php esc_html_e( 'Letters, numbers, and underscores only', 'sp-advanced-xprofile' ); ?>");

			$.validator.addMethod("stateUS", function(value, element, options) {
				var isDefault = typeof options === "undefined",
					caseSensitive = ( isDefault || typeof options.caseSensitive === "undefined" ) ? false : options.caseSensitive,
					includeTerritories = ( isDefault || typeof options.includeTerritories === "undefined" ) ? false : options.includeTerritories,
					includeMilitary = ( isDefault || typeof options.includeMilitary === "undefined" ) ? false : options.includeMilitary,
					regex;

				if (!includeTerritories && !includeMilitary) {
					regex = "^(A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])$";
				} else if (includeTerritories && includeMilitary) {
					regex = "^(A[AEKLPRSZ]|C[AOT]|D[CE]|FL|G[AU]|HI|I[ADLN]|K[SY]|LA|M[ADEINOPST]|N[CDEHJMVY]|O[HKR]|P[AR]|RI|S[CD]|T[NX]|UT|V[AIT]|W[AIVY])$";
				} else if (includeTerritories) {
					regex = "^(A[KLRSZ]|C[AOT]|D[CE]|FL|G[AU]|HI|I[ADLN]|K[SY]|LA|M[ADEINOPST]|N[CDEHJMVY]|O[HKR]|P[AR]|RI|S[CD]|T[NX]|UT|V[AIT]|W[AIVY])$";
				} else {
					regex = "^(A[AEKLPRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])$";
				}

				regex = caseSensitive ? new RegExp(regex) : new RegExp(regex, "i");
				return this.optional(element) || regex.test(value);
			},
			"<?php esc_html_e( 'Please specify a valid state', 'sp-advanced-xprofile' ); ?>");

			$.validator.addMethod("zipcodeUS", function(value, element) {
				return this.optional(element) || /^\d{5}(-\d{4})?$/.test(value);
			}, "<?php esc_html_e( 'The specified US ZIP Code is invalid', 'sp-advanced-xprofile' ); ?>");

			$( "#profile-edit-form,#signup-form" ).validate({
				rules: {
				<?php
				foreach ( $field_ids as $field_key => $field_id ) :
					// Validation methods.
					$validation_methods = bp_xprofile_get_meta( $field_id, 'field', $this->id . '_validation' );

					// Parse defaults.
					$v = wp_parse_args(
						$validation_methods,
						array(
							'enable' => array(
								'char_limit'  => 0,
								'min_chars'   => 0,
								'text_format' => 0,
							),
							'char_limit'  => '',
							'min_chars'   => '',
							'text_format' => '',
						)
					);
					?>
					<?php
					if ( ! empty( $validation_methods['enable'] ) ) :
						// Add the rules
						echo "\n\t\t\t\t\t";
						echo "field_" . absint( $field_id ) . ": {";
						if ( ! empty( $v['enable']['char_limit'] ) ) {
							echo "\n\t\t\t\t\t\t";
							?>
								"maxlength: "<?php echo absint( $v['char_limit'] ); ?>,
							<?php
						}
						if ( ! empty( $v['enable']['min_chars'] ) ) {
							echo "\n\t\t\t\t\t\t";
							if ( $v['min_chars'] ) :
								echo "minlength: " . absint( $v['min_chars'] ) . ",";
							endif;
						}
						if ( ! empty( $v['enable']['text_format'] ) ) {
							echo "\n\t\t\t\t\t\t";
							if ( $v['text_format'] ) :
								switch ( $v['text_format'] ) {
									case 'email':
										echo "email: true,";
										break;
									case 'url':
										echo "url: true,";
										break;
									case 'alpha':
										echo "alpha: true,";
										break;
									case 'alphanumeric':
										echo "alphanumeric: true,";
										break;
								}
							endif;
						}
						echo "\n\t\t\t\t\t";
						echo '},';
					endif;
			endforeach;
			echo "\n\t\t\t\t";
			echo '}';
			echo "\n\t\t\t";
			echo '});';
			echo "\n\t\t\t";
			echo '});';
			echo "\n";
			?>
			</script>
	<?php
			endif;
		}
		
		/**
		 * Create extra admin columns
		 *
		 * @param array $columns
		 */
		public function add_bp_field_colums( $columns = array() ) {
			$user_columns = get_option( $this->id . 'user_columns' );
			if ( ! empty( $user_columns ) ) :
				foreach ( $user_columns as $key => $field_id ) :
					$labels = bp_xprofile_get_meta( $field_id, 'field', $this->id.'_labels' );
					$field  = xprofile_get_field( $field_id );
					$name   = ! empty( $labels['admin'] ) ? $labels['admin'] : $field->name;
					$id     = sanitize_title( $name );
					$id     = str_replace( '-', '_', $id );

					$columns[ 'field_' . $field->id ] = $name;
				endforeach;
			endif;
			return $columns;
		}
		/**
		 * Get field value for table column
		 * @param  string  $value       [description]
		 * @param  string  $column_name [description]
		 * @param  integer $user_id     [description]
		 * @return string
		 */
		public function bp_field_column_content( $value = '', $column_name = '', $user_id = 0 ) {
			$user_columns = get_option( $this->id . 'user_columns' );

			if ( ! empty( $user_columns ) ) :
				$field = str_replace( 'field_', '', $column_name );
				if ( in_array( $field, $user_columns, true ) ) {
					$field_data = xprofile_get_field_data( $field, $user_id, 'comma' );
					return maybe_unserialize( $field_data );
				}
			endif;

			return $value;
		}
	}
endif;

add_action( 'bp_init', 'sp_advanced_xprofile_initiate' );
function sp_advanced_xprofile_initiate() {
	SP_Advanced_XProfile::instance();
}

/**
 * Load language
 */
add_action( 'plugins_loaded', 'bp_advanced_xprofile_language' );
function bp_advanced_xprofile_language() {
	load_plugin_textdomain( 'advanced-xprofile-fields-for-buddypress', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
