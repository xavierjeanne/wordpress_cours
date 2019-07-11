<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version 	1.0.7
 * 
 * WooCommerce Colors Rules
 * Created by CMSMasters
 * 
 */


function hotel_lux_woocommerce_colors($custom_css) {
	$cmsmasters_option = hotel_lux_get_global_options();
	
	
	$cmsmasters_color_schemes = cmsmasters_color_schemes_list();
	
	
	foreach ($cmsmasters_color_schemes as $scheme => $title) {
		$rule = (($scheme != 'default') ? "html .cmsmasters_color_scheme_{$scheme} " : '');
		
		
		$custom_css .= "
/***************** Start {$title} WooCommerce Color Scheme Rules ******************/

	/* Start Main Content Font Color */
	{$rule}.cmsmasters_product .price del, 
	{$rule}.widget > .product_list_widget del .amount, 
	{$rule}.select2-container .select2-choice, 
	{$rule}.select2-container.select2-drop-above .select2-choice, 
	{$rule}.select2-container.select2-container-active .select2-choice, 
	{$rule}.select2-container.select2-container-active.select2-drop-above .select2-choice, 
	{$rule}.select2-drop.select2-drop-active, 
	{$rule}.select2-drop.select2-drop-above.select2-drop-active {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_color']) . "
	}
	/* Finish Main Content Font Color */
	
	
	/* Start Primary Color */
	{$rule}.widget_price_filter .price_slider_amount .price_label .to, 
	{$rule}.widget_price_filter .price_slider_amount .price_label .from, 
	{$rule}.widget_shopping_cart .total .amount, 
	{$rule}.cart_totals td strong > .amount, 
	{$rule}.cart_totals table .cart-subtotal .amount, 
	{$rule}.shop_table td.product-subtotal .amount, 
	{$rule}.cmsmasters_dynamic_cart .widget_shopping_cart_content .total .amount, 
	{$rule}.cmsmasters_single_product .product_meta a:hover, 
	{$rule}.cmsmasters_product_cat a:hover, 
	{$rule}.cmsmasters_product .cmsmasters_product_title a:hover, 
	{$rule}.required, 
	{$rule}.cmsmasters_star_rating .cmsmasters_star_color_wrap, 
	{$rule}.comment-form-rating .stars > span a:hover, 
	{$rule}.comment-form-rating .stars > span a.active, 
	{$rule}#page .remove:hover, 
	{$rule}.cmsmasters_product .price ins, 
	{$rule}.cmsmasters_single_product .price ins, 
	{$rule}.shop_table .product-name a:hover, 
	{$rule}.shop_table.woocommerce-checkout-review-order-table .order-total th, 
	{$rule}.shop_table.woocommerce-checkout-review-order-table .order-total td, 
	{$rule}.shop_table.woocommerce-checkout-review-order-table .product-name strong, 
	{$rule}.shop_table.order_details tfoot tr:last-child th, 
	{$rule}.shop_table.order_details tfoot tr:last-child td, 
	{$rule}.shop_table.order_details .product-name strong, 
	{$rule}.shop_table.order_details tfoot tr:first-child th, 
	{$rule}.shop_table.order_details tfoot tr:first-child td, 
	{$rule}.widget_layered_nav ul li a:hover, 
	{$rule}.widget_layered_nav ul li.chosen a, 
	{$rule}.widget_layered_nav_filters ul li a:hover, 
	{$rule}.widget_layered_nav_filters ul li.chosen a, 
	{$rule}.widget_product_categories ul li a:hover, 
	{$rule}.widget_product_categories ul li.current-cat a, 
	{$rule}.widget > .product_list_widget a:hover, 
	{$rule}.widget > .product_list_widget ins .amount, 
	{$rule}.widget_shopping_cart .cart_list a:hover, 
	{$rule}.widget_shopping_cart .cart_list .quantity, 
	{$rule}.cmsmasters_products .product.product-category h2:hover, 
	{$rule}.cmsmasters_products .product.product-category mark, 
	{$rule}.woocommerce-store-notice .woocommerce-store-notice__dismiss-link {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.input-checkbox + label:after, 
	{$rule}.input-radio + label:after, 
	{$rule}input.shipping_method + label:after, 
	{$rule}.onsale span, 
	{$rule}ul.order_details li, 
	{$rule}.widget_price_filter .ui-slider-range, 
	{$rule}.woocommerce-store-notice {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.select2-container.select2-container-active .select2-choice, 
	{$rule}.select2-container.select2-container-active.select2-drop-above .select2-choice, 
	{$rule}.select2-drop.select2-drop-active, 
	{$rule}.select2-drop.select2-drop-above.select2-drop-active,
	{$rule}.select2-container.select2-container--open .select2-selection--single,
	{$rule}.select2-container.select2-container--focus .select2-selection--single {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
	}
	/* Finish Primary Color */
	
	
	/* Start Highlight Color */
	{$rule}.select2-container .select2-selection--single .select2-selection__rendered, 
	{$rule}.cmsmasters_product .button_to_cart {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_hover']) . "
	}
	
	{$rule}.link_hover_color {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_hover']) . "
	}
	/* Finish Highlight Color */
	
	
	/* Start Headings Color */
	{$rule}.widget_shopping_cart .total,
	{$rule}.shop_table.woocommerce-checkout-review-order-table .cart-subtotal th, 
	{$rule}.shop_table.woocommerce-checkout-review-order-table .cart-subtotal td, 
	{$rule}.cart_totals table .cart-subtotal th, 
	{$rule}.cart_totals table .order-total th, 
	{$rule}.shop_table thead th, 
	{$rule}.cmsmasters_single_product .product_meta a, 
	{$rule}.cmsmasters_product .cmsmasters_product_title a, 
	{$rule}.cmsmasters_product_cat a, 
	{$rule}.woocommerce-info, 
	{$rule}.woocommerce-message, 
	{$rule}.woocommerce-error li, 
	{$rule}#page .remove, 
	{$rule}.cmsmasters_woo_wrap_result .woocommerce-result-count, 
	{$rule}.cmsmasters_product .cmsmasters_product_cat, 
	{$rule}.cmsmasters_product .price, 
	{$rule}.shop_attributes th, 
	{$rule}.shop_table .product-name a, 
	{$rule}ul.order_details strong, 
	{$rule}.widget_layered_nav ul li, 
	{$rule}.widget_layered_nav ul li a, 
	{$rule}.widget_layered_nav_filters ul li, 
	{$rule}.widget_layered_nav_filters ul li a, 
	{$rule}.widget_product_categories ul li, 
	{$rule}.widget_product_categories ul li a, 
	{$rule}.widget > .product_list_widget a, 
	{$rule}.widget > .product_list_widget .amount, 
	{$rule}.widget_shopping_cart .cart_list a, 
	{$rule}.widget_shopping_cart .cart_list .quantity .amount, 
	{$rule}.widget_price_filter .price_slider_amount .price_label {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.out-of-stock span, 
	{$rule}.stock span, 
	{$rule}.widget_price_filter .ui-slider-handle {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_heading']) . "
	}
	/* Finish Headings Color */
	
	
	/* Start Main Background Color */
	{$rule}.woocommerce-store-notice, 
	{$rule}.woocommerce-store-notice p a, 
	{$rule}.woocommerce-store-notice p a:hover,
	{$rule}.onsale, 
	{$rule}.out-of-stock, 
	{$rule}.stock {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.select2-container .select2-choice, 
	{$rule}.woocommerce-store-notice .woocommerce-store-notice__dismiss-link {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	/* Finish Main Background Color */
	
	
	/* Start Alternate Background Color */
	{$rule}ul.order_details {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_alternate']) . "
	}
	
	{$rule}.shop_table.woocommerce-checkout-review-order-table .cart-subtotal,
	{$rule}.cart_totals table .cart-subtotal, 
	{$rule}.cart_totals table .order-total, 
	{$rule}.woocommerce-info, 
	{$rule}.woocommerce-message, 
	{$rule}.woocommerce-error, 
	{$rule}.select2-container.select2-drop-above .select2-choice, 
	{$rule}.select2-container.select2-container-active .select2-choice, 
	{$rule}.select2-container.select2-container-active.select2-drop-above .select2-choice, 
	{$rule}.select2-drop.select2-drop-active, 
	{$rule}.select2-drop.select2-drop-above.select2-drop-active, 
	{$rule}.input-checkbox + label:before, 
	{$rule}.input-radio + label:before, 
	{$rule}input.shipping_method + label:before, 
	{$rule}.shop_table thead th, 
	{$rule}.shop_table .actions, 
	{$rule}.select2-container--default .select2-selection--single, 
	{$rule}.shop_table.woocommerce-checkout-review-order-table .order-total th, 
	{$rule}.shop_table.woocommerce-checkout-review-order-table .order-total td, 
	{$rule}.shop_table.order_details tfoot tr:last-child th, 
	{$rule}.shop_table.order_details tfoot tr:last-child td, 
	{$rule}ul.order_details strong {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_alternate']) . "
	}
	/* Finish Alternate Background Color */
	
	
	/* Start Borders Color */
	{$rule}.cmsmasters_star_rating .cmsmasters_star_trans_wrap, 
	{$rule}.comment-form-rating .stars > span {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.widget_layered_nav ul li, 
	{$rule}.widget_layered_nav_filters ul li, 
	{$rule}.widget_product_categories ul li, 
	{$rule}.woocommerce-checkout-payment, 
	{$rule}.shop_table td, 
	{$rule}.shop_table th, 
	{$rule}.woocommerce-message, 
	{$rule}.woocommerce-info, 
	{$rule}.woocommerce-error, 
	{$rule}.shop_attributes tr, 
	{$rule}.select2-container .select2-choice, 
	{$rule}.select2-container.select2-drop-above .select2-choice, 
	{$rule}.select2-container--default .select2-selection--single, 
	{$rule}.input-checkbox + label:before, 
	{$rule}.input-radio + label:before, 
	{$rule}input.shipping_method + label:before, 
	{$rule}.cart_totals table th, 
	{$rule}.cart_totals table td, 
	{$rule}.widget_price_filter .price_slider, 
	{$rule}.shop_table .cart_item {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.widget_product_categories ul li:before,
	{$rule}.widget_price_filter .price_slider {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_border']) . "
	}
	/* Finish Borders Color */

/***************** Finish {$title} WooCommerce Color Scheme Rules ******************/

";
	}
	
	
	return $custom_css;
}

add_filter('hotel_lux_theme_colors_secondary_filter', 'hotel_lux_woocommerce_colors');

