<?php 
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.0.8
 * 
 * Header Middle Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_option = hotel_lux_get_global_options();


echo '<div class="header_mid" data-height="' . esc_attr($cmsmasters_option['hotel-lux' . '_header_mid_height']) . '">' . 
	'<div class="header_mid_outer">' . 
		'<div class="header_mid_inner">';
			do_action('cmsmasters_before_header_mid', $cmsmasters_option);
			
			do_action('cmsmasters_before_logo', $cmsmasters_option);
			echo '<div class="logo_wrap">';
				
				hotel_lux_logo();
				
				hotel_lux_logo_small();
				
			echo '</div>';
			do_action('cmsmasters_after_logo', $cmsmasters_option);
			
			
			if (
				$cmsmasters_option['hotel-lux' . '_header_styles'] == 'fullwidth' &&
				$cmsmasters_option['hotel-lux' . '_header_button_text'] !== '' &&
				$cmsmasters_option['hotel-lux' . '_header_button']
			) {
				echo '<div class="cmsmasters_header_button_wrap"><a href="' . esc_url($cmsmasters_option['hotel-lux' . '_header_button_link']) . '"' . (($cmsmasters_option['hotel-lux' . '_header_button_target']) ? 'target="_blank"' : '') . ' class="cmsmasters_header_button"><span>' . esc_html($cmsmasters_option['hotel-lux' . '_header_button_text']) . '</span></a></div>';
			}
			
			if (
				$cmsmasters_option['hotel-lux' . '_header_styles'] != 'default' && 
				$cmsmasters_option['hotel-lux' . '_header_styles'] != 'c_nav'
			) { 
				if (
					$cmsmasters_option['hotel-lux' . '_header_add_cont'] == 'cust_html' && 
					$cmsmasters_option['hotel-lux' . '_header_add_cont_cust_html'] !== ''
				) {
				echo '<div class="slogan_wrap">' . 
					'<div class="slogan_wrap_inner">' . 
						'<div class="slogan_wrap_text">' . 
							stripslashes($cmsmasters_option['hotel-lux' . '_header_add_cont_cust_html']) . 
						'</div>' . 
					'</div>' . 
				'</div>';
				}
			}
			
			
			if (CMSMASTERS_WOOCOMMERCE) {
				hotel_lux_woocommerce_cart_dropdown($cmsmasters_option);
			}
			
			if (
				$cmsmasters_option['hotel-lux' . '_header_search'] && 
				$cmsmasters_option['hotel-lux' . '_header_styles'] != 'c_nav'
			) {
				echo '<div class="mid_search_but_wrap">' . 
					'<a href="' . esc_js("javascript:void(0)") . '" class="mid_search_but cmsmasters_header_search_but cmsmasters_theme_icon_search"></a>' . 
				'</div>';
			}
			
			
			if ($cmsmasters_option['hotel-lux' . '_header_styles'] != 'c_nav') {
				do_action('cmsmasters_after_header_mid_search', $cmsmasters_option);
			}
			
			
			echo '<div class="resp_mid_nav_wrap">' . 
				'<div class="resp_mid_nav_outer">' . 
					'<a class="responsive_nav resp_mid_nav" href="' . esc_js("javascript:void(0)") . '"><span></span></a>' . 
				'</div>' . 
			'</div>';
			
			
			if (
				$cmsmasters_option['hotel-lux' . '_header_styles'] != 'default' && 
				$cmsmasters_option['hotel-lux' . '_header_styles'] != 'c_nav'
			) { 
				if (
					$cmsmasters_option['hotel-lux' . '_header_add_cont'] == 'social' && 
					isset($cmsmasters_option['hotel-lux' . '_social_icons'])
				) {
					hotel_lux_social_icons();
				}
			}
			
			
			if (
				$cmsmasters_option['hotel-lux' . '_header_styles'] == 'default' || 
				$cmsmasters_option['hotel-lux' . '_header_styles'] == 'fullwidth'
			) {
				echo '<!-- Start Navigation -->' . 
				'<div class="mid_nav_wrap">' . 
					'<nav>';
						
						$nav_args = array( 
							'theme_location' => 	'primary', 
							'menu_id' => 			'navigation', 
							'menu_class' => 		'mid_nav navigation', 
							'link_before' => 		'<span class="nav_item_wrap">', 
							'link_after' => 		'</span>', 
							'fallback_cb' =>         false
						);
						
						
						if (class_exists('Walker_Cmsmasters_Nav_Mega_Menu')) {
							$nav_args['walker'] = new Walker_Cmsmasters_Nav_Mega_Menu();
						}
						
						
						wp_nav_menu($nav_args);
						
					echo '</nav>' . 
				'</div>' . 
				'<!-- Finish Navigation -->';
			}
			
			
			do_action('cmsmasters_after_header_mid', $cmsmasters_option);
		echo '</div>' . 
	'</div>' . 
'</div>';

