<?php
/**
 * SKU for WooCommerce - Settings
 *
 * @version 1.2.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_Settings_SKU' ) ) :

class Alg_WC_Settings_SKU extends WC_Settings_Page {

	/**
	 * Constructor.
	 */
	function __construct() {
		$this->id    = 'alg_sku';
		$this->label = __( 'SKU', 'sku-for-woocommerce' );
		parent::__construct();
	}

	/**
	 * get_settings.
	 *
	 * @version 1.2.0
	 */
	function get_settings() {
		global $current_section;
		return apply_filters( 'woocommerce_get_settings_' . $this->id . '_' . $current_section, array() );
	}

	/**
	 * output.
	 */
	function output() {
		global $current_section, $hide_save_button;
		if ( 'regenerator' === $current_section ) {
			echo do_action( 'alg_sku_for_woocommerce_regenerator_tool' );
			$hide_save_button = true;
		} else {
			parent::output();
		}
	}

	/**
	 * maybe_reset_settings.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
	 */
	function maybe_reset_settings() {
		global $current_section;
		if ( 'yes' === get_option( $this->id . '_' . $current_section . '_' . 'reset', 'no' ) ) {
			foreach ( $this->get_settings() as $value ) {
				if ( isset( $value['default'] ) && isset( $value['id'] ) ) {
					delete_option( $value['id'] );
					$autoload = isset( $value['autoload'] ) ? (bool) $value['autoload'] : true;
					add_option( $value['id'], $value['default'], '', $autoload );
				}
			}
		}
	}

	/**
	 * Save settings.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
	 */
	function save() {
		parent::save();
		$this->maybe_reset_settings();
	}

}

endif;

return new Alg_WC_Settings_SKU();
