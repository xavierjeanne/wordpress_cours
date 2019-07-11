<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version 	1.0.0
 *
 * CMSMasters WooCommerce Admin Settings
 * Created by CMSMasters
 *
 */


/* Single Settings */
function hotel_lux_woocommerce_options_general_fields($options, $tab) {
	$defaults = hotel_lux_settings_general_defaults();
	
	if ($tab == 'header') {
		$options[] = array(
			'section' => 'header_section',
			'id' => 'hotel-lux' . '_woocommerce_cart_dropdown',
			'title' => esc_html__('Header WooCommerce Cart', 'hotel-lux'),
			'desc' => esc_html__('show', 'hotel-lux'),
			'type' => 'checkbox',
			'std' => $defaults[$tab]['hotel-lux' . '_woocommerce_cart_dropdown']
		);
	}

	return $options;
}

add_filter('cmsmasters_options_general_fields_filter', 'hotel_lux_woocommerce_options_general_fields', 10, 2);

