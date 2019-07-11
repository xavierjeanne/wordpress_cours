<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version 	1.0.0
 * 
 * WooCommerce Content Composer Functions
 * Created by CMSMasters
 * 
 */


/* Register JS Scripts */
function hotel_lux_woocommerce_register_c_c_scripts() {
	global $pagenow;
	
	
	if ( 
		$pagenow == 'post-new.php' || 
		($pagenow == 'post.php' && isset($_GET['post']) && get_post_type($_GET['post']) != 'attachment') 
	) {
		wp_enqueue_script('hotel-lux-woocommerce-extend', get_template_directory_uri() . '/woocommerce/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/cmsmasters-c-c/js/cmsmasters-c-c-plugin-extend.js', array('cmsmasters_composer_shortcodes_js'), '1.0.0', true);
		
		wp_localize_script('hotel-lux-woocommerce-extend', 'cmsmasters_woocommerce_shortcodes', array( 
			'product_ids' => 								hotel_lux_woocommerce_product_ids(), 
			'products_title' =>								esc_html__('Products', 'hotel-lux'), 
			'products_shortcode_title' =>					esc_html__('WooCommerce Shortcode', 'hotel-lux'), 
			'products_shortcode_descr' =>					esc_html__('Choose a WooCommerce shortcode to use', 'hotel-lux'), 
			'choice_recent_products' =>						esc_html__('Recent Products', 'hotel-lux'), 
			'choice_featured_products' =>					esc_html__('Featured Products', 'hotel-lux'), 
			'choice_product_categories' =>					esc_html__('Product Categories', 'hotel-lux'), 
			'choice_sale_products' =>						esc_html__('Sale Products', 'hotel-lux'), 
			'choice_best_selling_products' =>				esc_html__('Best Selling Products', 'hotel-lux'), 
			'choice_top_rated_products' =>					esc_html__('Top Rated Products', 'hotel-lux'), 
			'products_field_orderby_descr' =>				esc_html__("Choose your products 'order by' parameter", 'hotel-lux'), 
			'products_field_orderby_descr_note' =>			esc_html__("Sorting will not be applied for", 'hotel-lux'), 
			'products_field_prod_number_title' =>			esc_html__('Number of Products', 'hotel-lux'), 
			'products_field_prod_number_descr' =>			esc_html__('Enter the number of products for showing per page', 'hotel-lux'), 
			'products_field_col_count_descr' =>				esc_html__('Choose number of products per row', 'hotel-lux'), 
			'selected_products_title' =>					esc_html__('Selected Products', 'hotel-lux'), 
			'selected_products_field_ids' => 				esc_html__('Products', 'hotel-lux'), 
			'selected_products_field_ids_descr' => 			esc_html__('Choose products to be shown', 'hotel-lux'), 
			'selected_products_field_ids_descr_note' => 	esc_html__('All products will be shown if empty', 'hotel-lux') 
		));
	}
}

add_action('admin_enqueue_scripts', 'hotel_lux_woocommerce_register_c_c_scripts');



/* Product IDs */
function hotel_lux_woocommerce_product_ids() {
	$product_ids = get_posts(array(
		'numberposts' => -1, 
		'post_type' => 'product'
	));
	
	
	$out = array();
	
	
	if (!empty($product_ids)) {
		foreach ($product_ids as $product_id) {
			$out[$product_id->ID] = esc_html($product_id->post_title);
		}
	}
	
	
	return $out;
}

