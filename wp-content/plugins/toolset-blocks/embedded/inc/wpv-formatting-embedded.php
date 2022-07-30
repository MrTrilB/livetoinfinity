<?php

/**
* wpv-formatting-embedded.php
*
* Specific formatting functionality, from pseudo-the_content filters to raw shortcodes
*
* @package Views
*
* @since 1.9
*/

WPV_Formatting_Embedded::on_load();

/**
* WPV_Formatting_Embedded
*
* Views formatting on the embedded side
*
* @since 1.9
*/

class WPV_Formatting_Embedded {

    static function on_load() {
        add_action( 'init', array( 'WPV_Formatting_Embedded', 'init' ) );
		add_action( 'admin_init', array( 'WPV_Formatting_Embedded', 'admin_init' ) );

		add_filter( 'wpv_filter_wpv_enccode_arbitrary_shortcode_value', array( 'WPV_Formatting_Embedded', 'enccode_arbitrary_shortcode_value' ) );
		add_filter( 'wpv_filter_wpv_deccode_arbitrary_shortcode_value', array( 'WPV_Formatting_Embedded', 'deccode_arbitrary_shortcode_value' ) );
    }

    static function init() {
		add_shortcode( 'wpv-noautop', array( 'WPV_Formatting_Embedded', 'wpv_shortcode_wpv_noautop' ) );
		add_shortcode( 'wpv-autop', array( 'WPV_Formatting_Embedded', 'wpv_shortcode_wpv_autop' ) );
    }

	static function admin_init() {
		add_action( 'admin_print_footer_scripts', array( 'WPV_Formatting_Embedded', 'add_quicktags' ), 99 );
	}

	static function enccode_arbitrary_shortcode_value( $value ) {
		$value = str_replace( array( '"', "'", '[', ']'), array( '%%QUOTE%%', '%%SQUOTE%%', 'OBRAK', 'CBRAK'), $value );
		return $value;
	}

	static function deccode_arbitrary_shortcode_value( $value ) {
		$value = str_replace( array( '%%QUOTE%%', '%%SQUOTE%%', 'OBRAK', 'CBRAK'), array( '"', "'", '[', ']'), $value );
		return $value;
	}

	/**
	 * Filter the $content early to resolve wpv-noautop shortcodes before applying do_shortcode.
	 *
	 * @param $content string
	 * @return string
	 * @since 1.9.0
	 * @deprecated 3.3.0
	 */
	static function resolve_wpv_noautop_shortcodes( $content ) {
		if ( false === strpos( $content, '[wpv-noautop' ) ) {
			return $content;
		}

		$dic = apply_filters( 'toolset_dic', false );
		if ( false === $dic ) {
			return $content;
		}

		$resolver = $dic->make( '\OTGS\Toolset\Views\Controller\Shortcode\Resolver\Formatting' );
		return $resolver->apply_resolver( $content );
	}

	/**
	 * Parse and resolve wpv-noautop shortcodes.
	 *
	 * @param $content string
	 * @return string
	 * @since 1.9.0
	 * @deprecated 3.3.0
	 */

	static function parse_wpv_noautop_shortcodes( $content ) {
		if ( false === strpos( $content, '[wpv-noautop' ) ) {
			return $content;
		}

		$dic = apply_filters( 'toolset_dic', false );
		if ( false === $dic ) {
			return $content;
		}

		$resolver = $dic->make( '\OTGS\Toolset\Views\Controller\Shortcode\Resolver\Formatting' );
		return $resolver->apply_resolver( $content );
	}

	/**
	* wpv_shortcode_wpv_noautop
	*
	* Callback for the wpv-noautop shortcode
	*
	* @since 1.9
	*/

	static function wpv_shortcode_wpv_noautop( $atts, $content ) {
		$content = str_replace( "\n", "", $content );
		$content = str_replace( "\r", "", $content );
		return do_shortcode( $content );
	}

	/**
	* wpv_shortcode_wpv_autop
	*
	* Callback for the wpv-autop shortcode
	*
	* @since 1.10
	*/

	static function wpv_shortcode_wpv_autop( $atts, $content ) {
		return wpautop( do_shortcode( $content ) );
	}

	/**
	* add_quicktags
	*
	* Add a Quicktag button for the wpv-noautop shortcode
	*
	* @since 1.9
	*/

	static function add_quicktags() {
		if ( wp_script_is( 'quicktags' ) ) {
			?>
			<script type="text/javascript">
				QTags.addButton( 'wpv_noautop', '<?php echo esc_attr( __( 'raw', 'wpv-views' ) ); ?>', '[wpv-noautop]', '[/wpv-noautop]', 'r', '<?php echo esc_attr( __( 'Views raw output', 'wpv-views' ) ); ?>', 118, '', { ariaLabel: '<?php echo esc_attr( __( 'Views raw output', 'wpv-views' ) ); ?>', ariaLabelClose: '<?php echo esc_attr( __( 'Close Views raw output', 'wpv-views' ) ); ?>' } );
				QTags.addButton( 'wpv_autop', '<?php echo esc_attr( __( 'format', 'wpv-views' ) ); ?>', '[wpv-autop]', '[/wpv-autop]', 'r', '<?php echo esc_attr( __( 'Views formatted output', 'wpv-views' ) ); ?>', 119, '', { ariaLabel: '<?php echo esc_attr( __( 'Views formatted output', 'wpv-views' ) ); ?>', ariaLabelClose: '<?php echo esc_attr( __( 'Close Views formatted output', 'wpv-views' ) ); ?>' } );
			</script>
			<?php
		}
	}


}
