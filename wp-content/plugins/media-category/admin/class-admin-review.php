<?php
/**
 * Plugin review class.
 * Prompts users to give a review of the plugin on WordPress.org after a period of usage.
 *
 * Heavily based on code by Rhys Wynne
 * https://winwar.co.uk/2014/10/ask-wordpress-plugin-reviews-week/
 *
 * @package Bp_Lock
 */

if ( ! class_exists( 'WP_Media_Category_Feedback' ) ) :

	/**
	 * The feedback.
	 */
	class WP_Media_Category_Feedback {

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
				return sprintf( __( '%s years', 'media-category' ), $years );
			} elseif ( $years > 0 ) {
				return __( 'a year', 'media-category' );
			}

			// Get the weeks.
			$weeks = ( intval( $seconds ) / WEEK_IN_SECONDS ) % 52;
			if ( $weeks > 1 ) {
				/* translators: Number of weeks */
				return sprintf( __( '%s weeks', 'media-category' ), $weeks );
			} elseif ( $weeks > 0 ) {
				return __( 'a week', 'media-category' );
			}

			// Get the days.
			$days = ( intval( $seconds ) / DAY_IN_SECONDS ) % 7;
			if ( $days > 1 ) {
				/* translators: Number of days */
				return sprintf( __( '%s days', 'media-category' ), $days );
			} elseif ( $days > 0 ) {
				return __( 'a day', 'media-category' );
			}

			// Get the hours.
			$hours = ( intval( $seconds ) / HOUR_IN_SECONDS ) % 24;
			if ( $hours > 1 ) {
				/* translators: Number of hours */
				return sprintf( __( '%s hours', 'media-category' ), $hours );
			} elseif ( $hours > 0 ) {
				return __( 'an hour', 'media-category' );
			}

			// Get the minutes.
			$minutes = ( intval( $seconds ) / MINUTE_IN_SECONDS ) % 60;
			if ( $minutes > 1 ) {
				/* translators: Number of minutes */
				return sprintf( __( '%s minutes', 'media-category' ), $minutes );
			} elseif ( $minutes > 0 ) {
				return __( 'a minute', 'media-category' );
			}

			// Get the seconds.
			$seconds = intval( $seconds ) % 60;
			if ( $seconds > 1 ) {
				/* translators: Number of seconds */
				return sprintf( __( '%s seconds', 'media-category' ), $seconds );
			} elseif ( $seconds > 0 ) {
				return __( 'a second', 'media-category' );
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
				$no_bug_url = wp_nonce_url( admin_url( '?' . $this->nobug_option . '=true' ), 'media-category-feedback-nounce' );
				$time       = $this->seconds_to_words( time() - get_site_option( $this->date_option ) );
				?>

<style>
.notice.media-category-notice {
	border-left-color: #008ec2 !important;
	padding: 20px;
}

.rtl .notice.media-category-notice {
	border-right-color: #008ec2 !important;
}

.notice.notice.media-category-notice .media-category-notice-inner {
	display: table;
	width: 100%;
}

.notice.media-category-notice .media-category-notice-inner .media-category-notice-icon,
.notice.media-category-notice .media-category-notice-inner .media-category-notice-content,
.notice.media-category-notice .media-category-notice-inner .media-category-install-now {
	display: table-cell;
	vertical-align: middle;
}

.notice.media-category-notice .media-category-notice-icon {
	color: #509ed2;
	font-size: 50px;
	width: 60px;
}

.notice.media-category-notice .media-category-notice-icon img {
	width: 64px;
}

.notice.media-category-notice .media-category-notice-content {
	padding: 0 40px 0 20px;
}

.notice.media-category-notice p {
	padding: 0;
	margin: 0;
}

.notice.media-category-notice h3 {
	margin: 0 0 5px;
}

.notice.media-category-notice .media-category-install-now {
	text-align: center;
}

.notice.media-category-notice .media-category-install-now .media-category-install-button {
	padding: 6px 50px;
	height: auto;
	line-height: 20px;
}

.notice.media-category-notice a.no-thanks {
	display: block;
	margin-top: 10px;
	color: #72777c;
	text-decoration: none;
}

.notice.media-category-notice a.no-thanks:hover {
	color: #444;
}

@media (max-width: 767px) {

	.notice.notice.media-category-notice .media-category-notice-inner {
		display: block;
	}

	.notice.media-category-notice {
		padding: 20px !important;
	}

	.notice.media-category-noticee .media-category-notice-inner {
		display: block;
	}

	.notice.media-category-notice .media-category-notice-inner .media-category-notice-content {
		display: block;
		padding: 0;
	}

	.notice.media-category-notice .media-category-notice-inner .media-category-notice-icon {
		display: none;
	}

	.notice.media-category-notice .media-category-notice-inner .media-category-install-now {
		margin-top: 20px;
		display: block;
		text-align: left;
	}

	.notice.media-category-notice .media-category-notice-inner .no-thanks {
		display: inline-block;
		margin-left: 15px;
	}
}
</style>
			<div class="notice updated media-category-notice">
				<div class="media-category-notice-inner">
					<div class="media-category-notice-icon">
						<img src="<?php echo WPMC_PLUGIN_URL . '/admin/images/wbcom.png'; ?>" alt="<?php echo esc_attr__( 'BuddyPress Lock', 'media-category' ); ?>" />
					</div>
					<div class="media-category-notice-content">
						<h3><?php echo esc_html__( 'Are you enjoying WordPress Media Category?', 'media-category' ); ?></h3>
						<p>
							<?php /* translators: 1. Name, 2. Time */ ?>
							<?php printf( esc_html__( 'You have been using %1$s for %2$s now! Mind leaving a quick review and let me know know what you think of the plugin? I\'d really appreciate it!', 'media-category' ), esc_html( $this->name ), esc_html( $time ) ); ?>
						</p>
					</div>
					<div class="media-category-install-now">
						<?php printf( '<a href="%1$s" class="button button-primary media-category-install-button" target="_blank">%2$s</a>', esc_url( 'https://wordpress.org/support/plugin/media-category/reviews/' ), esc_html__( 'Leave a Review', 'media-category' ) ); ?>
						<a href="<?php echo esc_url( $no_bug_url ); ?>" class="no-thanks"><?php echo esc_html__( 'No thanks / I already have', 'media-category' ); ?></a>
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
			if ( ! isset( $_GET['_wpnonce'] ) || ( ! wp_verify_nonce( $_GET['_wpnonce'], 'media-category-feedback-nounce' ) || ! is_admin() || ! isset( $_GET[ $this->nobug_option ] ) || ! current_user_can( 'manage_options' ) ) ) {
				return;
			}

			add_site_option( $this->nobug_option, true );
		}
	}
endif;

/*
* Instantiate the WP_Media_Category_Feedback class.
*/
new WP_Media_Category_Feedback(
	array(
		'slug'       => 'wp_media_category_feedback',
		'name'       => __( 'WordPress Media Category', 'media-category' ),
		'time_limit' => WEEK_IN_SECONDS,
	)
);
