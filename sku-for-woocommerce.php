<?php
/*
Plugin Name: SKU Generator for WooCommerce
Plugin URI: https://wpcodefactory.com/item/sku-generator-for-woocommerce-plugin/
Description: Add full SKU support to WooCommerce.
Version: 1.2.0
Author: Algoritmika Ltd
Author URI: http://www.algoritmika.com
Text Domain: sku-for-woocommerce
Domain Path: /langs
Copyright: © 2017 Algoritmika Ltd.
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Check if WooCommerce is active
$plugin = 'woocommerce/woocommerce.php';
if (
	! in_array( $plugin, apply_filters( 'active_plugins', get_option( 'active_plugins', array() ) ) ) &&
	! ( is_multisite() && array_key_exists( $plugin, get_site_option( 'active_sitewide_plugins', array() ) ) )
) {
	return;
}

if ( 'sku-for-woocommerce.php' === basename( __FILE__ ) ) {
	// Check if Pro is active, if so then return
	$plugin = 'sku-for-woocommerce-pro/sku-for-woocommerce-pro.php';
	if (
		in_array( $plugin, apply_filters( 'active_plugins', get_option( 'active_plugins', array() ) ) ) ||
		( is_multisite() && array_key_exists( $plugin, get_site_option( 'active_sitewide_plugins', array() ) ) )
	) {
		return;
	}
}

if ( ! class_exists( 'Alg_WooCommerce_SKU' ) ) :

/**
 * Main Alg_WooCommerce_SKU Class
 *
 * @class   Alg_WooCommerce_SKU
 * @version 1.2.0
 */
final class Alg_WooCommerce_SKU {

	/**
	 * Plugin version.
	 *
	 * @var   string
	 * @since 1.1.2
	 */
	public $version = '1.2.0';

	/**
	 * @var Alg_WooCommerce_SKU The single instance of the class
	 */
	protected static $_instance = null;

	/**
	 * Main Alg_WooCommerce_SKU Instance
	 *
	 * Ensures only one instance of Alg_WooCommerce_SKU is loaded or can be loaded.
	 *
	 * @static
	 * @return Alg_WooCommerce_SKU - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Alg_WooCommerce_SKU Constructor.
	 *
	 * @version 1.2.0
	 * @access  public
	 */
	function __construct() {

		// Set up localisation
		load_plugin_textdomain( 'sku-for-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );

		// Include required files
		$this->includes();

		// Settings
		if ( is_admin() ) {
			add_filter( 'woocommerce_get_settings_pages', array( $this, 'add_woocommerce_settings_tab' ) );
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'action_links' ) );
		}
	}

	/**
	 * Show action links on the plugin screen
	 *
	 * @version 1.2.0
	 * @param   mixed $links
	 * @return  array
	 */
	function action_links( $links ) {
		$custom_links = array();
		$custom_links[] = '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=alg_sku' ) . '">' . __( 'Settings', 'woocommerce' ) . '</a>';
		if ( 'sku-for-woocommerce.php' === basename( __FILE__ ) ) {
			$custom_links[] = '<a target="_blank" href="' . esc_url( 'https://wpcodefactory.com/item/sku-generator-for-woocommerce-plugin/' ) . '">' . __( 'Unlock all', 'sku-for-woocommerce' ) . '</a>';
		}
		return array_merge( $custom_links, $links );
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 *
	 * @version 1.2.0
	 */
	private function includes() {
		// Settings
		$settings = array();
		$settings[] = require_once( 'includes/admin/class-wc-sku-settings-general.php' );
		$settings[] = require_once( 'includes/admin/class-wc-sku-settings-categories.php' );
		$settings[] = require_once( 'includes/admin/class-wc-sku-settings-tags.php' );
		if ( is_admin() && get_option( 'alg_sku_generator_version', '' ) !== $this->version ) {
			foreach ( $settings as $section ) {
				foreach ( $section->get_settings() as $value ) {
					if ( isset( $value['default'] ) && isset( $value['id'] ) ) {
						$autoload = isset( $value['autoload'] ) ? ( bool ) $value['autoload'] : true;
						add_option( $value['id'], $value['default'], '', ( $autoload ? 'yes' : 'no' ) );
					}
				}
			}
			update_option( 'alg_sku_generator_version', $this->version );
		}
		// Tools
		require_once( 'includes/admin/class-wc-sku-tools-regenerator.php' );
		// Core
		require_once( 'includes/class-wc-sku.php' );
	}

	/**
	 * Add Woocommerce settings tab to WooCommerce settings.
	 */
	function add_woocommerce_settings_tab( $settings ) {
		$settings[] = include( 'includes/admin/class-wc-settings-sku.php' );
		return $settings;
	}

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	function plugin_url() {
		return untrailingslashit( plugin_dir_url( __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}
}

endif;

if ( ! function_exists( 'alg_woocommerce_sku' ) ) {
	/**
	 * Returns the main instance of Alg_WooCommerce_SKU to prevent the need to use globals.
	 *
	 * @return  Alg_WooCommerce_SKU
	 * @version 1.1.3
	 */
	function alg_woocommerce_sku() {
		return Alg_WooCommerce_SKU::instance();
	}
}
alg_woocommerce_sku();
