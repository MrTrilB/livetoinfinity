<?php
/**
 * BuddyPress Group Review plugin review feedback.
 *
 * @link       https://wbcomdesigns.com/
 * @since      1.0.0
 *
 * @package    BuddyPress_Group_Review
 * @subpackage BuddyPress_Group_Review/admin
 */

if ( ! class_exists( 'BGR_Admin_Feedback' ) ) :

	/**
	 * The feedback.
	 */
	class BGR_Admin_Feedback {

		/**
		 * Slug.
		 *
		 * @var string $slug
		 */
		private $slug;

		/**
		 * Name.
		 *
		 * @var string $name
		 */
		private $name;

		/**
		 * Time limit.
		 *
		 * @var string $time_limit
		 */
		private $time_limit;

		/**
		 * No Bug Option.
		 *
		 * @var string $nobug_option
		 */
		public $nobug_option;

		/**
		 * Activation Date Option.
		 *
		 * @var string $date_option
		 */
		public $date_option;

		/**
		 * Class constructor.
		 *
		 * @param string $args Arguments.
		 */
		public function __construct( $args ) {
			$this->slug = $args['slug'];
			$this->name = $args['name'];

			$this->date_option  = $this->slug . '_activation_date';
			$this->nobug_option = $this->slug . '_no_bug';

			if ( isset( $args['time_limit'] ) ) {
				$this->time_limit = $args['time_limit'];
			} else {
				$this->time_limit = WEEK_IN_SECONDS;
			}

			// Add actions.
			add_action( 'admin_init', array( $this, 'check_installation_date' ) );
			add_action( 'admin_init', array( $this, 'set_no_bug' ), 5 );
		}

		/**
		 * Seconds to words.
		 *
		 * @param string $seconds Seconds in time.
		 */
		public function seconds_to_words( $seconds ) {

			// Get the years.
			$years = ( intval( $seconds ) / YEAR_IN_SECONDS ) % 100;
			if ( $years > 1 ) {
				/* translators: Number of years */
				return sprintf( __( '%s years', 'bp-group-reviews' ), $years );
			} elseif ( $years > 0 ) {
				return __( 'a year', 'bp-group-reviews' );
			}

			// Get the weeks.
			$weeks = ( intval( $seconds ) / WEEK_IN_SECONDS ) % 52;
			if ( $weeks > 1 ) {
				/* translators: Number of weeks */
				return sprintf( __( '%s weeks', 'bp-group-reviews' ), $weeks );
			} elseif ( $weeks > 0 ) {
				return __( 'a week', 'bp-group-reviews' );
			}

			// Get the days.
			$days = ( intval( $seconds ) / DAY_IN_SECONDS ) % 7;
			if ( $days > 1 ) {
				/* translators: Number of days */
				return sprintf( __( '%s days', 'bp-group-reviews' ), $days );
			} elseif ( $days > 0 ) {
				return __( 'a day', 'bp-group-reviews' );
			}

			// Get the hours.
			$hours = ( intval( $seconds ) / HOUR_IN_SECONDS ) % 24;
			if ( $hours > 1 ) {
				/* translators: Number of hours */
				return sprintf( __( '%s hours', 'bp-group-reviews' ), $hours );
			} elseif ( $hours > 0 ) {
				return __( 'an hour', 'bp-group-reviews' );
			}

			// Get the minutes.
			$minutes = ( intval( $seconds ) / MINUTE_IN_SECONDS ) % 60;
			if ( $minutes > 1 ) {
				/* translators: Number of minutes */
				return sprintf( __( '%s minutes', 'bp-group-reviews' ), $minutes );
			} elseif ( $minutes > 0 ) {
				return __( 'a minute', 'bp-group-reviews' );
			}

			// Get the seconds.
			$seconds = intval( $seconds ) % 60;
			if ( $seconds > 1 ) {
				/* translators: Number of seconds */
				return sprintf( __( '%s seconds', 'bp-group-reviews' ), $seconds );
			} elseif ( $seconds > 0 ) {
				return __( 'a second', 'bp-group-reviews' );
			}
		}

		/**
		 * Check date on admin initiation and add to admin notice if it was more than the time limit.
		 */
		public function check_installation_date() {
			if ( ! get_site_option( $this->nobug_option ) || false === get_site_option( $this->nobug_option ) ) {
				add_site_option( $this->date_option, time() );

				// Retrieve the activation date.
				$install_date = get_site_option( $this->date_option );

				// If difference between install date and now is greater than time limit, then display notice.
				if ( ( time() - $install_date ) > $this->time_limit ) {
					add_action( 'admin_notices', array( $this, 'display_admin_notice' ) );
				}
			}
		}

		/**
		 * Display the admin notice.
		 */
		public function display_admin_notice() {
			$screen = get_current_screen();

			if ( isset( $screen->base ) && 'plugins' === $screen->base ) {
				$no_bug_url = wp_nonce_url( admin_url( '?' . $this->nobug_option . '=true' ), 'bp-group-reviews-feedback-nounce' );
				$time       = $this->seconds_to_words( time() - get_site_option( $this->date_option ) );
				?>

<style>
.notice.bp-group-reviews-notice {
	border-left-color: #008ec2 !important;
	padding: 20px;
}

.rtl .notice.bp-group-reviews-notice {
	border-right-color: #008ec2 !important;
}

.notice.notice.bp-group-reviews-notice .bp-group-reviews-notice-inner {
	display: table;
	width: 100%;
}

.notice.bp-group-reviews-notice .bp-group-reviews-notice-inner .bp-group-reviews-notice-icon,
.notice.bp-group-reviews-notice .bp-group-reviews-notice-inner .bp-group-reviews-notice-content,
.notice.bp-group-reviews-notice .bp-group-reviews-notice-inner .bp-group-reviews-install-now {
	display: table-cell;
	vertical-align: middle;
}

.notice.bp-group-reviews-notice .bp-group-reviews-notice-icon {
	color: #509ed2;
	font-size: 50px;
	width: 60px;
}

.notice.bp-group-reviews-notice .bp-group-reviews-notice-icon img {
	width: 64px;
}

.notice.bp-group-reviews-notice .bp-group-reviews-notice-content {
	padding: 0 40px 0 20px;
}

.notice.bp-group-reviews-notice p {
	padding: 0;
	margin: 0;
}

.notice.bp-group-reviews-notice h3 {
	margin: 0 0 5px;
}

.notice.bp-group-reviews-notice .bp-group-reviews-install-now {
	text-align: center;
}

.notice.bp-group-reviews-notice .bp-group-reviews-install-now .bp-group-reviews-install-button {
	padding: 6px 50px;
	height: auto;
	line-height: 20px;
}

.notice.bp-group-reviews-notice a.no-thanks {
	display: block;
	margin-top: 10px;
	color: #72777c;
	text-decoration: none;
}

.notice.bp-group-reviews-notice a.no-thanks:hover {
	color: #444;
}

@media (max-width: 767px) {

	.notice.notice.bp-group-reviews-notice .bp-group-reviews-notice-inner {
		display: block;
	}

	.notice.bp-group-reviews-notice {
		padding: 20px !important;
	}

	.notice.bp-group-reviews-noticee .bp-group-reviews-notice-inner {
		display: block;
	}

	.notice.bp-group-reviews-notice .bp-group-reviews-notice-inner .bp-group-reviews-notice-content {
		display: block;
		padding: 0;
	}

	.notice.bp-group-reviews-notice .bp-group-reviews-notice-inner .bp-group-reviews-notice-icon {
		display: none;
	}

	.notice.bp-group-reviews-notice .bp-group-reviews-notice-inner .bp-group-reviews-install-now {
		margin-top: 20px;
		display: block;
		text-align: left;
	}

	.notice.bp-group-reviews-notice .bp-group-reviews-notice-inner .no-thanks {
		display: inline-block;
		margin-left: 15px;
	}
}
</style>
			<div class="notice updated bp-group-reviews-notice">
				<div class="bp-group-reviews-notice-inner">
					<div class="bp-group-reviews-notice-icon">
						<img src="<?php echo esc_url( BGR_PLUGIN_URL ) . 'admin/wbcom/assets/imgs/bgr.png'; ?>" alt="<?php echo esc_attr__( 'BuddyPress Group Reviews', 'bp-group-reviews' ); ?>" />
					</div>
					<div class="bp-group-reviews-notice-content">
						<h3><?php echo esc_html__( 'Are you enjoying BuddyPress Group Reviews?', 'bp-group-reviews' ); ?></h3>
						<p>
							<?php /* translators: 1. Name */ ?>
							<?php printf( esc_html__( 'We hope you\'re enjoying %1$s! Could you please do us a BIG favor and give it a 5-star rating on WordPress to help us spread the word and boost our motivation?', 'bp-group-reviews' ), esc_html( $this->name ) ); ?>
						</p>
					</div>
					<div class="bp-group-reviews-install-now">
						<?php printf( '<a href="%1$s" class="button button-primary bp-group-reviews-install-button" target="_blank">%2$s</a>', esc_url( 'https://wordpress.org/support/plugin/review-buddypress-groups/reviews/' ), esc_html__( 'Leave a Review', 'bp-group-reviews' ) ); ?>
						<a href="<?php echo esc_url( $no_bug_url ); ?>" class="no-thanks"><?php echo esc_html__( 'No thanks / I already have', 'bp-group-reviews' ); ?></a>
					</div>
				</div>
			</div>
				<?php
			}
		}

		/**
		 * Set the plugin to no longer bug users if user asks not to be.
		 */
		public function set_no_bug() {

			// Bail out if not on correct page.
			if ( ! isset( $_GET['_wpnonce'] ) || ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'bp-group-reviews-feedback-nounce' ) || ! is_admin() || ! isset( $_GET[ $this->nobug_option ] ) || ! current_user_can( 'manage_options' ) ) ) {
				return;
			}

			add_site_option( $this->nobug_option, true );
		}
	}
endif;

/*
* Instantiate the BGR_Admin_Feedback class.
*/
new BGR_Admin_Feedback(
	array(
		'slug'       => 'bp_group_types',
		'name'       => __( 'BuddyPress Group Reviews', 'bp-group-reviews' ),
		'time_limit' => WEEK_IN_SECONDS,
	)
);
