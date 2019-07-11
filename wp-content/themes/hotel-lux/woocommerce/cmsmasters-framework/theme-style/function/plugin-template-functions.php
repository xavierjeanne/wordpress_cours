<?php 
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.1.2
 * 
 * WooCommerce Template Functions
 * Created by CMSMasters
 * 
 */


/* Dynamic Cart */
function hotel_lux_woocommerce_cart_dropdown($cmsmasters_option) {
	global $woocommerce;
	
	$cart_count = $woocommerce->cart->get_cart_contents_count();
	
	
	if ($cmsmasters_option['hotel-lux' . '_header_styles'] != 'c_nav' &&
		isset($cmsmasters_option['hotel-lux' . '_woocommerce_cart_dropdown']) &&
		$cmsmasters_option['hotel-lux' . '_woocommerce_cart_dropdown']) {
		
		echo '<div class="cmsmasters_dynamic_cart_wrap">' . 
			'<div class="cmsmasters_dynamic_cart' . ($cart_count > 0 ? ' cmsmasters_active' : '') . '">' .  
				'<a href="' . esc_url(wc_get_cart_url()) . '" class="cmsmasters_dynamic_cart_button"><span class="cmsmasters_theme_icon_basket"><span>' . esc_html($cart_count) . '</span></span></a>' . 
				'<div class="cmsmasters_dynamic_cart_button_hide"></div>' . 
				'<div class="widget_shopping_cart_content"></div>' . 
			'</div>' . 
		'</div>';
	}
}



/* Add to Cart Button */
function hotel_lux_woocommerce_add_to_cart_button() {
	global $woocommerce, 
		$product;
	
	
	if ( 
		$product->is_purchasable() && 
		$product->is_type( 'simple' ) && 
		$product->is_in_stock() 
	) {
		echo '<div class="button_to_cart_wrap">' . 
			'<a href="' . esc_url($product->add_to_cart_url()) . '" data-product_id="' . esc_attr($product->get_id()) . '" data-product_sku="' . esc_attr($product->get_sku()) . '" class="button_to_cart add_to_cart_button cmsmasters_add_to_cart_button ajax_add_to_cart product_type_simple" title="' . esc_attr__('Add to Cart', 'hotel-lux') . '">' . 
				'<span>' . esc_html__('Add to Cart', 'hotel-lux') . '</span>' . 
			'</a>' . 
			'<a href="' . esc_url(wc_get_cart_url()) . '" class="button_to_cart added_to_cart wc-forward" title="' . esc_attr__('View Cart', 'hotel-lux') . '">' . 
				'<span>' . esc_html__('View Cart', 'hotel-lux') . '</span>' . 
			'</a>' . 
		'</div>';
	}
}


/* Rating */
function hotel_lux_woocommerce_rating($icon_trans = '', $icon_color = '', $in_review = false, $comment_id = '', $show = true) {
	global $product;
	
	
	if (get_option( 'woocommerce_enable_review_rating') === 'no') {
		return;
	}
	
	
	$rating = (($in_review) ? intval(get_comment_meta($comment_id, 'rating', true)) : ($product->get_average_rating() ? $product->get_average_rating() : '0'));
	
	$itemtype = $in_review ? 'Rating' : 'AggregateRating';
	
	
	$out = "
<div class=\"cmsmasters_star_rating\" itemscope itemtype=\"http://schema.org/{$itemtype}\" title=\"" . sprintf(esc_html__('Rated %s out of 5', 'hotel-lux'), $rating) . "\">
<div class=\"cmsmasters_star_trans_wrap\">
	<span class=\"{$icon_trans} cmsmasters_star\"></span>
	<span class=\"{$icon_trans} cmsmasters_star\"></span>
	<span class=\"{$icon_trans} cmsmasters_star\"></span>
	<span class=\"{$icon_trans} cmsmasters_star\"></span>
	<span class=\"{$icon_trans} cmsmasters_star\"></span>
</div>
<div class=\"cmsmasters_star_color_wrap\" data-width=\"width:" . (($rating / 5) * 100) . "%\">
	<div class=\"cmsmasters_star_color_inner\">
		<span class=\"{$icon_color} cmsmasters_star\"></span>
		<span class=\"{$icon_color} cmsmasters_star\"></span>
		<span class=\"{$icon_color} cmsmasters_star\"></span>
		<span class=\"{$icon_color} cmsmasters_star\"></span>
		<span class=\"{$icon_color} cmsmasters_star\"></span>
	</div>
</div>
<span class=\"rating dn\"><strong itemprop=\"ratingValue\">" . esc_html($rating) . "</strong> " . esc_html__('out of 5', 'hotel-lux') . "</span>
</div>
";
	
	
	if ($show) {
		echo hotel_lux_return_content($out);
	} else {
		return $out;
	}
}


/* Price Format */
function hotel_lux_woocommerce_price_format($format, $currency_pos) {
	$format = '%2$s<span>%1$s</span>';

	switch ( $currency_pos ) {
		case 'left' :
			$format = '<span>%1$s</span>%2$s';
		break;
		case 'right' :
			$format = '%2$s<span>%1$s</span>';
		break;
		case 'left_space' :
			$format = '<span>%1$s&nbsp;</span>%2$s';
		break;
		case 'right_space' :
			$format = '%2$s<span>&nbsp;%1$s</span>';
		break;
	}
	
	return $format;
}
 
add_action('woocommerce_price_format', 'hotel_lux_woocommerce_price_format', 1, 2);


/* Woocommerce Onsale Filter */
add_filter('woocommerce_sale_flash', 'hotel_lux_woocommerce_change_on_sale');

function hotel_lux_woocommerce_change_on_sale() {
	return '<span class="onsale"><span>' . esc_html__('Sale!', 'hotel-lux') . '</span></span>';
}


/* Woocommerce Dynamic cart count update after ajax */
function hotel_lux_woocommerce_header_add_to_cart_count($dynamic_count) {
	global $woocommerce;
	
	ob_start();
	
	?>
	<span><?php echo hotel_lux_return_content($woocommerce->cart->cart_contents_count); ?></span>
	<?php
	
	$dynamic_count['.cmsmasters_dynamic_cart_button span span'] = ob_get_clean();
	
	return $dynamic_count;
}

add_filter('add_to_cart_fragments', 'hotel_lux_woocommerce_header_add_to_cart_count');

