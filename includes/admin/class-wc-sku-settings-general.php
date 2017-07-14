<?php
/**
 * SKU for WooCommerce - General Section Settings
 *
 * @version 1.2.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_SKU_Settings_General' ) ) :

class Alg_WC_SKU_Settings_General {

	/**
	 * Constructor.
	 *
	 * @version 1.2.0
	 */
	function __construct() {
		$this->id   = '';
		$this->desc = __( 'General', 'sku-for-woocommerce' );
		add_filter( 'woocommerce_get_sections_alg_sku',              array( $this, 'settings_section' ) );
		add_filter( 'woocommerce_get_settings_alg_sku_' . $this->id, array( $this, 'get_settings' ), PHP_INT_MAX );
	}

	/**
	 * settings_section.
	 */
	function settings_section( $sections ) {
		$sections[ $this->id ] = $this->desc;
		return $sections;
	}

	/**
	 * get_settings.
	 *
	 * @version 1.2.0
	 * @todo    (maybe) "SKU Format Options" etc. to separate section and "Dashboard"
	 */
	function get_settings() {
		$settings = array(
			array(
				'title'     => __( 'SKU Generator for WooCommerce Options', 'sku-for-woocommerce' ),
				'type'      => 'title',
				'id'        => 'alg_sku_for_woocommerce_options',
			),
			array(
				'title'     => __( 'SKU Generator for WooCommerce', 'sku-for-woocommerce' ),
				'desc'      => '<strong>' . __( 'Enable plugin', 'sku-for-woocommerce' ) . '</strong>',
				'desc_tip'  => __( 'Add full SKU support to WooCommerce.', 'sku-for-woocommerce' ),
				'id'        => 'alg_sku_for_woocommerce_enabled',
				'default'   => 'yes',
				'type'      => 'checkbox',
			),
			array(
				'type'      => 'sectionend',
				'id'        => 'alg_sku_for_woocommerce_options',
			),
			array(
				'title'     => __( 'SKU Format Options', 'sku-for-woocommerce' ),
				'desc'      => __( 'This section lets you set format for SKUs.', 'sku-for-woocommerce' ),
				'type'      => 'title',
				'id'        => 'alg_sku_for_woocommerce_format_options',
			),
			array(
				'title'     => __( 'Number Generation', 'sku-for-woocommerce' ),
				'id'        => 'alg_sku_for_woocommerce_number_generation',
				'default'   => 'product_id',
				'type'      => 'select',
				'options'   => array(
					'product_id' => __( 'From product ID', 'sku-for-woocommerce' ),
					'sequential' => __( 'Sequential', 'sku-for-woocommerce' ),
					'hash_crc32' => __( 'Pseudorandom - Hash (max 10 digits)', 'sku-for-woocommerce' ),
				),
				'desc_tip'  => __( 'Possible values: from product ID, sequential or pseudorandom.', 'sku-for-woocommerce' ),
				'desc'      => apply_filters( 'alg_wc_sku_generator_option', sprintf(
						__( 'Get <a target="_blank" href="%s">SKU Generator for WooCommerce Pro</a> plugin to change value.', 'sku-for-woocommerce' ),
						'https://wpcodefactory.com/item/sku-generator-for-woocommerce-plugin/'
					), 'settings'
				),
				'custom_attributes' => apply_filters( 'alg_wc_sku_generator_option', array( 'disabled' => 'disabled' ), 'settings' ),
			),
			array(
				'title'     => __( 'Sequential Number Generation Counter', 'sku-for-woocommerce' ),
				'id'        => 'alg_sku_for_woocommerce_number_generation_sequential',
				'default'   => 1,
				'type'      => 'number',
				'desc_tip'  => __( 'Ignored if "Number Generation" is not "Sequential".', 'sku-for-woocommerce' ),
				'custom_attributes' => array( 'min' => 0 ),
			),
			array(
				'title'     => __( 'Prefix', 'sku-for-woocommerce' ),
				'id'        => 'alg_sku_for_woocommerce_prefix',
				'default'   => '',
				'type'      => 'text',
			),
			array(
				'title'     => __( 'Minimum Number Length', 'sku-for-woocommerce' ),
				'id'        => 'alg_sku_for_woocommerce_minimum_number_length',
				'default'   => 0,
				'type'      => 'number',
			),
			array(
				'title'     => __( 'Suffix', 'sku-for-woocommerce' ),
				'id'        => 'alg_sku_for_woocommerce_suffix',
				'default'   => '',
				'type'      => 'text',
			),
			array(
				'title'     => __( 'Variable Products Variations', 'sku-for-woocommerce' ),
				'id'        => 'alg_sku_for_woocommerce_variations_handling',
				'default'   => 'as_variable',
				'type'      => 'select',
				'options'   => array(
					'as_variable'             => __( 'SKU same as parent\'s product', 'sku-for-woocommerce' ),
					'as_variation'            => __( 'Generate different SKU for each variation', 'sku-for-woocommerce' ),
					'as_variable_with_suffix' => __( 'SKU same as parent\'s product + variation letter suffix', 'sku-for-woocommerce' ),
				),
				'desc_tip'  => __( 'Possible values: SKU same as parent\'s product, generate different SKU for each variation or SKU same as parent\'s product + variation letter suffix.', 'sku-for-woocommerce' ),
				'desc'      => apply_filters( 'alg_wc_sku_generator_option', sprintf(
						__( 'Get <a target="_blank" href="%s">SKU Generator for WooCommerce Pro</a> plugin to change value.', 'sku-for-woocommerce' ),
						'https://wpcodefactory.com/item/sku-generator-for-woocommerce-plugin/'
					), 'settings'
				),
				'custom_attributes' => apply_filters( 'alg_wc_sku_generator_option', array( 'disabled' => 'disabled' ), 'settings' ),
			),
			array(
				'title'     => __( 'Template', 'sku-for-woocommerce' ),
				'desc'      => __( 'Replaced values:', 'sku-for-woocommerce' ) .
					'{category_prefix}, {category_suffix}, {tag_prefix}, {tag_suffix}, {prefix}, {suffix}, {variation_suffix}, {sku_number}.',
				'id'        => 'alg_sku_for_woocommerce_template',
				'default'   => '{category_prefix}{tag_prefix}{prefix}{sku_number}{suffix}{tag_suffix}{category_suffix}{variation_suffix}',
				'type'      => 'text',
				'css'       => 'width:99%;',
			),
			array(
				'type'      => 'sectionend',
				'id'        => 'alg_sku_for_woocommerce_format_options',
			),
			array(
				'title'     => __( 'More Options', 'sku-for-woocommerce' ),
				'type'      => 'title',
				'id'        => 'alg_sku_for_woocommerce_more_options',
			),
			array(
				'title'     => __( 'Automatically Generate SKU for New Products', 'sku-for-woocommerce' ),
				'desc'      => __( 'Enable', 'sku-for-woocommerce' ),
				'desc_tip'  => sprintf(
					__( 'If enabled - all new products will automatically get SKU according to set format values. To change SKUs of existing products, use <a href="%s">Regenerator tool</a>.', 'sku-for-woocommerce' ),
					admin_url( 'admin.php?page=wc-settings&tab=alg_sku&section=regenerator' )
				),
				'id'        => 'alg_sku_new_products_generate_enabled',
				'default'   => 'yes',
				'type'      => 'checkbox',
			),
			array(
				'title'     => __( 'Generate SKUs Only for Products with Empty SKU', 'sku-for-woocommerce' ),
				'desc'      => __( 'Enable', 'sku-for-woocommerce' ),
				'id'        => 'alg_sku_generate_only_for_empty_sku',
				'default'   => 'no',
				'type'      => 'checkbox',
			),
			array(
				'title'     => __( 'Allow Duplicate SKUs', 'sku-for-woocommerce' ),
				'desc'      => __( 'Enable', 'sku-for-woocommerce' ),
				'id'        => 'alg_sku_for_woocommerce_allow_duplicates',
				'default'   => 'no',
				'type'      => 'checkbox',
			),
			array(
				'title'     => __( 'Search by SKU', 'sku-for-woocommerce' ),
				'desc'      => __( 'Add', 'sku-for-woocommerce' ),
				'desc_tip'  => __( 'Add product searching by SKU on frontend.', 'sku-for-woocommerce' ),
				'id'        => 'alg_sku_for_woocommerce_search_enabled',
				'default'   => 'no',
				'type'      => 'checkbox',
			),
			array(
				'title'     => __( 'Add SKU to Customer Emails', 'sku-for-woocommerce' ),
				'desc'      => __( 'Add', 'sku-for-woocommerce' ),
				'id'        => 'alg_sku_add_to_customer_emails',
				'default'   => 'no',
				'type'      => 'checkbox',
			),
			array(
				'type'      => 'sectionend',
				'id'        => 'alg_sku_for_woocommerce_more_options',
			),
			array(
				'title'     => __( 'Reset Section Settings', 'sku-for-woocommerce' ),
				'type'      => 'title',
				'id'        => 'alg_sku' . '_' . $this->id . '_' . 'reset_options',
			),
			array(
				'title'     => __( 'Reset Settings', 'sku-for-woocommerce' ),
				'desc'      => '<strong>' . __( 'Reset', 'sku-for-woocommerce' ) . '</strong>',
				'id'        => 'alg_sku' . '_' . $this->id . '_' . 'reset',
				'default'   => 'no',
				'type'      => 'checkbox',
			),
			array(
				'type'      => 'sectionend',
				'id'        => 'alg_sku' . '_' . $this->id . '_' . 'reset_options',
			),
		);
		return $settings;
	}

}

endif;

return new Alg_WC_SKU_Settings_General();
