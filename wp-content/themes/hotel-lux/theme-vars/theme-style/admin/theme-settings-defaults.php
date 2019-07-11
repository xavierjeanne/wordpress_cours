<?php 
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.1.2
 * 
 * Theme Settings Defaults
 * Created by CMSMasters
 * 
 */


/* Theme Settings General Default Values */
if (!function_exists('hotel_lux_settings_general_defaults')) {

function hotel_lux_settings_general_defaults($id = false) {
	$settings = array( 
		'general' => array( 
			'hotel-lux' . '_theme_layout' => 		'liquid', 
			'hotel-lux' . '_logo_type' => 			'image', 
			'hotel-lux' . '_logo_url' => 			'|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo.png', 
			'hotel-lux' . '_logo_url_retina' => 	'|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo_retina.png', 
			'hotel-lux' . '_logo_title' => 			get_bloginfo('name') ? get_bloginfo('name') : 'Hotel LUX', 
			'hotel-lux' . '_logo_subtitle' => 		'', 
			'hotel-lux' . '_logo_custom_color' => 	0, 
			'hotel-lux' . '_logo_title_color' => 	'', 
			'hotel-lux' . '_logo_subtitle_color' => '' 
		), 
		'bg' => array( 
			'hotel-lux' . '_bg_col' => 			'#ffffff', 
			'hotel-lux' . '_bg_img_enable' => 	0, 
			'hotel-lux' . '_bg_img' => 			'', 
			'hotel-lux' . '_bg_rep' => 			'no-repeat', 
			'hotel-lux' . '_bg_pos' => 			'top center', 
			'hotel-lux' . '_bg_att' => 			'scroll', 
			'hotel-lux' . '_bg_size' => 		'cover' 
		), 
		'header' => array( 
			'hotel-lux' . '_fixed_header' => 				1, 
			'hotel-lux' . '_header_overlaps' => 			1, 
			'hotel-lux' . '_header_top_line' => 			0, 
			'hotel-lux' . '_header_top_height' => 			'32', 
			'hotel-lux' . '_header_top_line_short_info' => 	'', 
			'hotel-lux' . '_header_top_line_add_cont' => 	'social', 
			'hotel-lux' . '_header_styles' => 				'fullwidth', 
			'hotel-lux' . '_header_mid_height' => 			'70', 
			'hotel-lux' . '_header_bot_height' => 			'60', 
			'hotel-lux' . '_header_search' => 				1, 
			'hotel-lux' . '_header_add_cont' => 			'none', 
			'hotel-lux' . '_header_add_cont_cust_html' => 	'',
			'hotel-lux' . '_woocommerce_cart_dropdown' => 	0 
		), 
		'content' => array( 
			'hotel-lux' . '_layout' => 					'r_sidebar', 
			'hotel-lux' . '_archives_layout' => 		'r_sidebar', 
			'hotel-lux' . '_search_layout' => 			'r_sidebar', 
			'hotel-lux' . '_other_layout' => 			'r_sidebar', 
			'hotel-lux' . '_heading_alignment' => 		'center', 
			'hotel-lux' . '_heading_scheme' => 			'default', 
			'hotel-lux' . '_heading_bg_image_enable' => 1, 
			'hotel-lux' . '_heading_bg_image' => 		'|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/heading_bg.jpg',  
			'hotel-lux' . '_heading_bg_repeat' => 		'no-repeat', 
			'hotel-lux' . '_heading_bg_attachment' => 	'scroll', 
			'hotel-lux' . '_heading_bg_size' => 		'cover', 
			'hotel-lux' . '_heading_bg_color' => 		'#1c1c1c', 
			'hotel-lux' . '_heading_height' => 			'450', 
			'hotel-lux' . '_breadcrumbs' => 			1, 
			'hotel-lux' . '_bottom_scheme' => 			'first', 
			'hotel-lux' . '_bottom_sidebar' => 			0, 
			'hotel-lux' . '_bottom_sidebar_layout' => 	'131313' 
		), 
		'footer' => array( 
			'hotel-lux' . '_footer_scheme' => 				'footer', 
			'hotel-lux' . '_footer_type' => 				'default', 
			'hotel-lux' . '_footer_additional_content' => 	'social', 
			'hotel-lux' . '_footer_logo' => 				1, 
			'hotel-lux' . '_footer_logo_url' => 			'|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo_footer.png', 
			'hotel-lux' . '_footer_logo_url_retina' => 		'|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo_footer_retina.png', 
			'hotel-lux' . '_footer_nav' => 					0, 
			'hotel-lux' . '_footer_social' => 				1, 
			'hotel-lux' . '_footer_html' => 				'', 
			'hotel-lux' . '_footer_copyright' => 			'&copy; ' . date('Y') . ' ' . 'Hotel LUX' 
		) 
	);
	
	
	$settings = apply_filters('hotel_lux_settings_general_defaults_filter', $settings);
	
	
	if ($id) {
		return $settings[$id];
	} else {
		return $settings;
	}
}

}



/* Theme Settings Fonts Default Values */
if (!function_exists('hotel_lux_settings_font_defaults')) {

function hotel_lux_settings_font_defaults($id = false) {
	$settings = array( 
		'content' => array( 
			'hotel-lux' . '_content_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Dosis:300,400,500,700', 
				'font_size' => 			'18', 
				'line_height' => 		'28', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal' 
			) 
		), 
		'link' => array( 
			'hotel-lux' . '_link_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Dosis:300,400,500,700', 
				'font_size' => 			'18', 
				'line_height' => 		'28', 
				'font_weight' => 		'500', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			), 
			'hotel-lux' . '_link_hover_decoration' => 	'none' 
		), 
		'nav' => array( 
			'hotel-lux' . '_nav_title_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Dosis:300,400,500,700', 
				'font_size' => 			'16', 
				'line_height' => 		'26', 
				'font_weight' => 		'500', 
				'font_style' => 		'normal', 
				'text_transform' => 	'uppercase' 
			), 
			'hotel-lux' . '_nav_dropdown_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Dosis:300,400,500,700', 
				'font_size' => 			'14', 
				'line_height' => 		'20', 
				'font_weight' => 		'500', 
				'font_style' => 		'normal', 
				'text_transform' => 	'uppercase' 
			) 
		), 
		'heading' => array( 
			'hotel-lux' . '_h1_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Cormorant:400,400i', 
				'font_size' => 			'50', 
				'line_height' => 		'58', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'uppercase', 
				'text_decoration' => 	'none' 
			), 
			'hotel-lux' . '_h2_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Cormorant:400,400i', 
				'font_size' => 			'40', 
				'line_height' => 		'46', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'uppercase', 
				'text_decoration' => 	'none' 
			), 
			'hotel-lux' . '_h3_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Cormorant:400,400i', 
				'font_size' => 			'30', 
				'line_height' => 		'38', 
				'font_weight' => 		'400', 
				'font_style' => 		'italic', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			), 
			'hotel-lux' . '_h4_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Cormorant:400,400i', 
				'font_size' => 			'24', 
				'line_height' => 		'32', 
				'font_weight' => 		'400', 
				'font_style' => 		'italic', 
				'text_transform' => 	'none', 
				'text_decoration' => 	'none' 
			), 
			'hotel-lux' . '_h5_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Cormorant:400,400i', 
				'font_size' => 			'20', 
				'line_height' => 		'26', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'uppercase', 
				'text_decoration' => 	'none' 
			), 
			'hotel-lux' . '_h6_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Dosis:300,400,500,700', 
				'font_size' => 			'16', 
				'line_height' => 		'26', 
				'font_weight' => 		'500', 
				'font_style' => 		'normal', 
				'text_transform' => 	'uppercase', 
				'text_decoration' => 	'none' 
			) 
		), 
		'other' => array( 
			'hotel-lux' . '_button_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Dosis:300,400,500,700', 
				'font_size' => 			'16', 
				'line_height' => 		'50', 
				'font_weight' => 		'500', 
				'font_style' => 		'normal', 
				'text_transform' => 	'uppercase' 
			), 
			'hotel-lux' . '_small_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Dosis:300,400,500,700', 
				'font_size' => 			'18', 
				'line_height' => 		'28', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal', 
				'text_transform' => 	'none' 
			), 
			'hotel-lux' . '_input_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Dosis:300,400,500,700', 
				'font_size' => 			'16', 
				'line_height' => 		'26', 
				'font_weight' => 		'400', 
				'font_style' => 		'normal' 
			), 
			'hotel-lux' . '_quote_font' => array( 
				'system_font' => 		"Arial, Helvetica, 'Nimbus Sans L', sans-serif", 
				'google_font' => 		'Cormorant:400,400i', 
				'font_size' => 			'36', 
				'line_height' => 		'46', 
				'font_weight' => 		'400', 
				'font_style' => 		'italic' 
			) 
		),
		'google' => array( 
			'hotel-lux' . '_google_web_fonts' => array( 
				'Titillium+Web:300,300italic,400,400italic,600,600italic,700,700italic|Titillium Web',
				'Roboto:300,300italic,400,400italic,500,500italic,700,700italic|Roboto', 
				'Roboto+Condensed:400,400italic,700,700italic|Roboto Condensed', 
				'Open+Sans:300,300italic,400,400italic,700,700italic|Open Sans', 
				'Open+Sans+Condensed:300,300italic,700|Open Sans Condensed', 
				'Droid+Sans:400,700|Droid Sans', 
				'Droid+Serif:400,400italic,700,700italic|Droid Serif', 
				'PT+Sans:400,400italic,700,700italic|PT Sans', 
				'PT+Sans+Caption:400,700|PT Sans Caption', 
				'PT+Sans+Narrow:400,700|PT Sans Narrow', 
				'PT+Serif:400,400italic,700,700italic|PT Serif', 
				'Ubuntu:400,400italic,700,700italic|Ubuntu', 
				'Ubuntu+Condensed|Ubuntu Condensed', 
				'Headland+One|Headland One', 
				'Source+Sans+Pro:300,300italic,400,400italic,700,700italic|Source Sans Pro', 
				'Lato:400,400italic,700,700italic|Lato', 
				'Cuprum:400,400italic,700,700italic|Cuprum', 
				'Oswald:300,400,700|Oswald', 
				'Yanone+Kaffeesatz:300,400,700|Yanone Kaffeesatz', 
				'Lobster|Lobster', 
				'Lobster+Two:400,400italic,700,700italic|Lobster Two', 
				'Questrial|Questrial', 
				'Raleway:300,400,500,600,700|Raleway', 
				'Dosis:300,400,500,700|Dosis', 
				'Cutive+Mono|Cutive Mono', 
				'Quicksand:300,400,700|Quicksand', 
				'Montserrat:400,700|Montserrat', 
				'Cookie|Cookie', 
				'Cormorant:400,400i|Cormorant',
				'Herr+Von+Muellerhoff|Herr Von Muellerhoff' 
			) 
		)  
	);
	
	
	$settings = apply_filters('hotel_lux_settings_font_defaults_filter', $settings);
	
	
	if ($id) {
		return $settings[$id];
	} else {
		return $settings;
	}
}

}



// WP Color Picker Palettes
if (!function_exists('cmsmasters_color_picker_palettes')) {

function cmsmasters_color_picker_palettes() {
	$palettes = array( 
		'#6a6a6a', 
		'#b99470', 
		'#999999', 
		'#1c1c1c', 
		'#ffffff', 
		'#f5f5f5', 
		'#dddddd' 
	);
	
	
	return apply_filters('cmsmasters_color_picker_palettes_filter', $palettes);
}

}



// Theme Settings Color Schemes Default Colors
if (!function_exists('hotel_lux_color_schemes_defaults')) {

function hotel_lux_color_schemes_defaults($id = false) {
	$settings = array( 
		'default' => array( // content default color scheme
			'color' => 		'#6a6a6a', 
			'link' => 		'#b99470', 
			'hover' => 		'#999999', 
			'heading' => 	'#1c1c1c', 
			'bg' => 		'#ffffff', 
			'alternate' => 	'#f5f5f5', 
			'border' => 	'#dddddd' 
		), 
		'header' => array( // Header color scheme
			'mid_color' => 		'#6a6a6a', 
			'mid_link' => 		'#0b0c0f', 
			'mid_hover' => 		'#b99470', 
			'mid_bg' => 		'#ffffff', 
			'mid_bg_scroll' => 	'#ffffff', 
			'mid_border' => 	'rgba(255,255,255,0)', 
			'bot_color' => 		'#6a6a6a', 
			'bot_link' => 		'#b99470', 
			'bot_hover' => 		'#b99470', 
			'bot_bg' => 		'#ffffff', 
			'bot_bg_scroll' => 	'#ffffff', 
			'bot_border' => 	'rgba(255,255,255,0)' 
		), 
		'navigation' => array( // Navigation color scheme
			'title_link' => 			'#0d0c14', 
			'title_link_hover' => 		'#b99470', 
			'title_link_current' => 	'#1c1c1c', 
			'title_link_subtitle' => 	'#6a6a6a', 
			'title_link_bg' => 			'rgba(255,255,255,0)', 
			'title_link_bg_hover' => 	'rgba(255,255,255,0)', 
			'title_link_bg_current' => 	'rgba(255,255,255,0)', 
			'title_link_border' => 		'rgba(255,255,255,0.1)', 
			'dropdown_text' => 			'#939393', 
			'dropdown_bg' => 			'#151515', 
			'dropdown_border' => 		'rgba(255,255,255,0)', 
			'dropdown_link' => 			'#aaaaaa', 
			'dropdown_link_hover' => 	'#b99470', 
			'dropdown_link_subtitle' => '#6b6b6b', 
			'dropdown_link_highlight' => 'rgba(255,255,255,0)', 
			'dropdown_link_border' => 	'rgba(255,255,255,0)' 
		), 
		'header_top' => array( // Header Top color scheme
			'color' => 					'#6a6a6a', 
			'link' => 					'#6a6a6a', 
			'hover' => 					'#b99470', 
			'bg' => 					'#ffffff', 
			'border' => 				'rgba(255,255,255,0)', 
			'title_link' => 			'#6a6a6a', 
			'title_link_hover' => 		'#b99470', 
			'title_link_bg' => 			'rgba(255,255,255,0)', 
			'title_link_bg_hover' => 	'rgba(255,255,255,0)', 
			'title_link_border' => 		'rgba(255,255,255,0)', 
			'dropdown_bg' => 			'#ffffff', 
			'dropdown_border' => 		'rgba(255,255,255,0)', 
			'dropdown_link' => 			'#6a6a6a', 
			'dropdown_link_hover' => 	'#b99470', 
			'dropdown_link_highlight' => 'rgba(255,255,255,0)', 
			'dropdown_link_border' => 	'rgba(255,255,255,0)' 
		), 
		'footer' => array( // Footer color scheme
			'color' => 		'rgba(255,255,255,0.2)', 
			'link' => 		'#b99470', 
			'hover' => 		'#636363', 
			'heading' => 	'#ffffff', 
			'bg' => 		'#151515', 
			'alternate' => 	'rgba(255,255,255,0.3)', 
			'border' => 	'rgba(255,255,255,0.1)' 
		), 
		'first' => array( // custom color scheme 1
			'color' => 		'#f4f4f4', 
			'link' => 		'#a98868', 
			'hover' => 		'#999999', 
			'heading' => 	'#ffffff', 
			'bg' => 		'#151515', 
			'alternate' => 	'#212121', 
			'border' => 	'#2d2d2d' 
		), 
		'second' => array( // custom color scheme 2
			'color' => 		'#6a6a6a', 
			'link' => 		'#c19b76', 
			'hover' => 		'#999999', 
			'heading' => 	'#1c1c1c', 
			'bg' => 		'#ffffff', 
			'alternate' => 	'#ffffff', 
			'border' => 	'#dddddd' 
		), 
		'third' => array( // custom color scheme 3
			'color' => 		'#6a6a6a', 
			'link' => 		'#c19b76', 
			'hover' => 		'#999999', 
			'heading' => 	'#1c1c1c', 
			'bg' => 		'#ffffff', 
			'alternate' => 	'#ffffff', 
			'border' => 	'#dddddd' 
		) 
	);
	
	
	$settings = apply_filters('hotel_lux_color_schemes_defaults_filter', $settings);
	
	
	if ($id) {
		return $settings[$id];
	} else {
		return $settings;
	}
}

}



// Theme Settings Elements Default Values
if (!function_exists('hotel_lux_settings_element_defaults')) {

function hotel_lux_settings_element_defaults($id = false) {
	$settings = array( 
		'sidebar' => array( 
			'hotel-lux' . '_sidebar' => 	'' 
		), 
		'icon' => array( 
			'hotel-lux' . '_social_icons' => array( 
				'cmsmasters-icon-linkedin|#|' . esc_html__('Linkedin', 'hotel-lux') . '|true||', 
				'cmsmasters-icon-facebook|#|' . esc_html__('Facebook', 'hotel-lux') . '|true||', 
				'cmsmasters-icon-gplus|#|' . esc_html__('Google', 'hotel-lux') . '|true||', 
				'cmsmasters-icon-twitter|#|' . esc_html__('Twitter', 'hotel-lux') . '|true||', 
				'cmsmasters-icon-skype|#|' . esc_html__('Skype', 'hotel-lux') . '|true||' 
			) 
		), 
		'lightbox' => array( 
			'hotel-lux' . '_ilightbox_skin' => 					'dark', 
			'hotel-lux' . '_ilightbox_path' => 					'vertical', 
			'hotel-lux' . '_ilightbox_infinite' => 				0, 
			'hotel-lux' . '_ilightbox_aspect_ratio' => 			1, 
			'hotel-lux' . '_ilightbox_mobile_optimizer' => 		1, 
			'hotel-lux' . '_ilightbox_max_scale' => 			1, 
			'hotel-lux' . '_ilightbox_min_scale' => 			0.2, 
			'hotel-lux' . '_ilightbox_inner_toolbar' => 		0, 
			'hotel-lux' . '_ilightbox_smart_recognition' => 	0, 
			'hotel-lux' . '_ilightbox_fullscreen_one_slide' => 	0, 
			'hotel-lux' . '_ilightbox_fullscreen_viewport' => 	'center', 
			'hotel-lux' . '_ilightbox_controls_toolbar' => 		1, 
			'hotel-lux' . '_ilightbox_controls_arrows' => 		0, 
			'hotel-lux' . '_ilightbox_controls_fullscreen' => 	1, 
			'hotel-lux' . '_ilightbox_controls_thumbnail' => 	1, 
			'hotel-lux' . '_ilightbox_controls_keyboard' => 	1, 
			'hotel-lux' . '_ilightbox_controls_mousewheel' => 	1, 
			'hotel-lux' . '_ilightbox_controls_swipe' => 		1, 
			'hotel-lux' . '_ilightbox_controls_slideshow' => 	0 
		), 
		'sitemap' => array( 
			'hotel-lux' . '_sitemap_nav' => 		1, 
			'hotel-lux' . '_sitemap_categs' => 		1, 
			'hotel-lux' . '_sitemap_tags' => 		1, 
			'hotel-lux' . '_sitemap_month' => 		1, 
			'hotel-lux' . '_sitemap_pj_categs' => 	1, 
			'hotel-lux' . '_sitemap_pj_tags' => 	1 
		), 
		'error' => array( 
			'hotel-lux' . '_error_color' => 			'#292929', 
			'hotel-lux' . '_error_bg_color' => 			'#fcfcfc', 
			'hotel-lux' . '_error_bg_img_enable' => 	0, 
			'hotel-lux' . '_error_bg_image' => 			'', 
			'hotel-lux' . '_error_bg_rep' => 			'no-repeat', 
			'hotel-lux' . '_error_bg_pos' => 			'top center', 
			'hotel-lux' . '_error_bg_att' => 			'scroll', 
			'hotel-lux' . '_error_bg_size' => 			'cover', 
			'hotel-lux' . '_error_search' => 			1, 
			'hotel-lux' . '_error_sitemap_button' => 	1, 
			'hotel-lux' . '_error_sitemap_link' => 		'' 
		), 
		'code' => array( 
			'hotel-lux' . '_custom_css' => 			'', 
			'hotel-lux' . '_custom_js' => 			'', 
			'hotel-lux' . '_gmap_api_key' => 		'', 
			'hotel-lux' . '_api_key' => 			'', 
			'hotel-lux' . '_api_secret' => 			'', 
			'hotel-lux' . '_access_token' => 		'', 
			'hotel-lux' . '_access_token_secret' => '' 
		), 
		'recaptcha' => array( 
			'hotel-lux' . '_recaptcha_public_key' => 	'', 
			'hotel-lux' . '_recaptcha_private_key' => 	'' 
		) 
	);
	
	
	$settings = apply_filters('hotel_lux_settings_element_defaults_filter', $settings);
	
	
	if ($id) {
		return $settings[$id];
	} else {
		return $settings;
	}
}

}



// Theme Settings Single Posts Default Values
if (!function_exists('hotel_lux_settings_single_defaults')) {

function hotel_lux_settings_single_defaults($id = false) {
	$settings = array( 
		'post' => array( 
			'hotel-lux' . '_blog_post_layout' => 		'r_sidebar', 
			'hotel-lux' . '_blog_post_title' => 		1, 
			'hotel-lux' . '_blog_post_date' => 			1, 
			'hotel-lux' . '_blog_post_cat' => 			1, 
			'hotel-lux' . '_blog_post_author' => 		1, 
			'hotel-lux' . '_blog_post_comment' => 		1, 
			'hotel-lux' . '_blog_post_tag' => 			1, 
			'hotel-lux' . '_blog_post_like' => 			1, 
			'hotel-lux' . '_blog_post_nav_box' => 		1, 
			'hotel-lux' . '_blog_post_nav_order_cat' => 0, 
			'hotel-lux' . '_blog_post_share_box' => 	1, 
			'hotel-lux' . '_blog_post_author_box' => 	1, 
			'hotel-lux' . '_blog_more_posts_box' => 	'popular', 
			'hotel-lux' . '_blog_more_posts_count' => 	'3', 
			'hotel-lux' . '_blog_more_posts_pause' => 	'5' 
		), 
		'project' => array( 
			'hotel-lux' . '_portfolio_project_title' => 		1, 
			'hotel-lux' . '_portfolio_project_layout' => 		'r_sidebar', 
			'hotel-lux' . '_portfolio_project_details_title' => esc_html__('Room details', 'hotel-lux'), 
			'hotel-lux' . '_portfolio_project_date' => 			0, 
			'hotel-lux' . '_portfolio_project_cat' => 			1, 
			'hotel-lux' . '_portfolio_project_author' => 		0, 
			'hotel-lux' . '_portfolio_project_comment' => 		0, 
			'hotel-lux' . '_portfolio_project_tag' => 			0, 
			'hotel-lux' . '_portfolio_project_like' => 			0, 
			'hotel-lux' . '_portfolio_project_link' => 			0, 
			'hotel-lux' . '_portfolio_project_share_box' => 	1, 
			'hotel-lux' . '_portfolio_project_nav_box' => 		1, 
			'hotel-lux' . '_portfolio_project_nav_order_cat' => 0, 
			'hotel-lux' . '_portfolio_project_author_box' => 	0, 
			'hotel-lux' . '_portfolio_more_projects_box' => 	'popular', 
			'hotel-lux' . '_portfolio_more_projects_count' => 	'4', 
			'hotel-lux' . '_portfolio_more_projects_pause' => 	'5', 
			'hotel-lux' . '_portfolio_project_slug' => 			'room', 
			'hotel-lux' . '_portfolio_pj_categs_slug' => 		'pj-categs', 
			'hotel-lux' . '_portfolio_pj_tags_slug' => 			'pj-tags' 
		), 
		'profile' => array( 
			'hotel-lux' . '_profile_post_title' => 			1, 
			'hotel-lux' . '_profile_post_details_title' => 	esc_html__('Profile details', 'hotel-lux'), 
			'hotel-lux' . '_profile_post_cat' => 			1, 
			'hotel-lux' . '_profile_post_comment' => 		1, 
			'hotel-lux' . '_profile_post_like' => 			1, 
			'hotel-lux' . '_profile_post_nav_box' => 		1, 
			'hotel-lux' . '_profile_post_nav_order_cat' => 	0, 
			'hotel-lux' . '_profile_post_share_box' => 		0, 
			'hotel-lux' . '_profile_post_slug' => 			'profile', 
			'hotel-lux' . '_profile_pl_categs_slug' => 		'pl-categs' 
		)
	);
	
	
	$settings = apply_filters('hotel_lux_settings_single_defaults_filter', $settings);
	
	
	if ($id) {
		return $settings[$id];
	} else {
		return $settings;
	}
}

}



/* Project Puzzle Proportion */
if (!function_exists('hotel_lux_project_puzzle_proportion')) {

function hotel_lux_project_puzzle_proportion() {
	return 1.55;
}

}

/* Project Puzzle Proportion */
if (!function_exists('hotel_lux_project_puzzle_large_gar_parameters')) {

function hotel_lux_project_puzzle_large_gar_parameters() {
	$parameter = array ( 
		'container_width' 		=> 1160, 
		'bottomStaticPadding' 	=> 3.4 
	);
	
	
	return $parameter;
}

}

/* Theme Image Thumbnails Size */
if (!function_exists('hotel_lux_get_image_thumbnail_list')) {

function hotel_lux_get_image_thumbnail_list() {
	$list = array( 
		'cmsmasters-small-thumb' => array( 
			'width' => 		64, 
			'height' => 	64, 
			'crop' => 		true 
		), 
		'cmsmasters-square-thumb' => array( 
			'width' => 		300, 
			'height' => 	300, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Square', 'hotel-lux') 
		), 
		'cmsmasters-blog-masonry-thumb' => array( 
			'width' => 		580, 
			'height' => 	420, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Masonry Blog', 'hotel-lux') 
		), 
		'cmsmasters-project-grid-thumb' => array( 
			'width' => 		580, 
			'height' => 	420, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Project Grid', 'hotel-lux') 
		), 
		'cmsmasters-project-thumb' => array( 
			'width' => 		580, 
			'height' => 	420, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Project', 'hotel-lux') 
		), 
		'cmsmasters-project-masonry-thumb' => array( 
			'width' => 		580, 
			'height' => 	9999, 
			'title' => 		esc_attr__('Masonry Project', 'hotel-lux') 
		), 
		'post-thumbnail' => array( 
			'width' => 		860, 
			'height' => 	500, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Featured', 'hotel-lux') 
		), 
		'cmsmasters-masonry-thumb' => array( 
			'width' => 		860, 
			'height' => 	9999, 
			'title' => 		esc_attr__('Masonry', 'hotel-lux') 
		), 
		'cmsmasters-full-thumb' => array( 
			'width' => 		1160, 
			'height' => 	650, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Full', 'hotel-lux') 
		), 
		'cmsmasters-project-full-thumb' => array( 
			'width' => 		1160, 
			'height' => 	700, 
			'crop' => 		true, 
			'title' => 		esc_attr__('Project Full', 'hotel-lux') 
		), 
		'cmsmasters-full-masonry-thumb' => array( 
			'width' => 		1160, 
			'height' => 	9999, 
			'title' => 		esc_attr__('Masonry Full', 'hotel-lux') 
		) 
	);
	
	
	return $list;
}

}



/* Project Post Type Registration Rename */
if (!function_exists('hotel_lux_project_labels')) {

function hotel_lux_project_labels() {
	return array( 
		'name' => 					esc_html__('Rooms', 'hotel-lux'), 
		'singular_name' => 			esc_html__('Room', 'hotel-lux'), 
		'menu_name' => 				esc_html__('Rooms', 'hotel-lux'), 
		'all_items' => 				esc_html__('All Rooms', 'hotel-lux'), 
		'add_new' => 				esc_html__('Add New', 'hotel-lux'), 
		'add_new_item' => 			esc_html__('Add New Room', 'hotel-lux'), 
		'edit_item' => 				esc_html__('Edit Room', 'hotel-lux'), 
		'new_item' => 				esc_html__('New Room', 'hotel-lux'), 
		'view_item' => 				esc_html__('View Room', 'hotel-lux'), 
		'search_items' => 			esc_html__('Search Rooms', 'hotel-lux'), 
		'not_found' => 				esc_html__('No rooms found', 'hotel-lux'), 
		'not_found_in_trash' => 	esc_html__('No rooms found in Trash', 'hotel-lux') 
	);
}

}

add_filter('cmsmasters_project_labels_filter', 'hotel_lux_project_labels');


if (!function_exists('hotel_lux_pj_categs_labels')) {

function hotel_lux_pj_categs_labels() {
	return array( 
		'name' => 					esc_html__('Room Categories', 'hotel-lux'), 
		'singular_name' => 			esc_html__('Room Category', 'hotel-lux') 
	);
}

}

add_filter('cmsmasters_pj_categs_labels_filter', 'hotel_lux_pj_categs_labels');


if (!function_exists('hotel_lux_pj_tags_labels')) {

function hotel_lux_pj_tags_labels() {
	return array( 
		'name' => 					esc_html__('Room Tags', 'hotel-lux'), 
		'singular_name' => 			esc_html__('Room Tag', 'hotel-lux') 
	);
}

}

add_filter('cmsmasters_pj_tags_labels_filter', 'hotel_lux_pj_tags_labels');



/* Profile Post Type Registration Rename */
if (!function_exists('hotel_lux_profile_labels')) {

function hotel_lux_profile_labels() {
	return array( 
		'name' => 					esc_html__('Profiles', 'hotel-lux'), 
		'singular_name' => 			esc_html__('Profiles', 'hotel-lux'), 
		'menu_name' => 				esc_html__('Profiles', 'hotel-lux'), 
		'all_items' => 				esc_html__('All Profiles', 'hotel-lux'), 
		'add_new' => 				esc_html__('Add New', 'hotel-lux'), 
		'add_new_item' => 			esc_html__('Add New Profile', 'hotel-lux'), 
		'edit_item' => 				esc_html__('Edit Profile', 'hotel-lux'), 
		'new_item' => 				esc_html__('New Profile', 'hotel-lux'), 
		'view_item' => 				esc_html__('View Profile', 'hotel-lux'), 
		'search_items' => 			esc_html__('Search Profiles', 'hotel-lux'), 
		'not_found' => 				esc_html__('No Profiles found', 'hotel-lux'), 
		'not_found_in_trash' => 	esc_html__('No Profiles found in Trash', 'hotel-lux') 
	);
}

}

// add_filter('cmsmasters_profile_labels_filter', 'hotel_lux_profile_labels');


if (!function_exists('hotel_lux_pl_categs_labels')) {

function hotel_lux_pl_categs_labels() {
	return array( 
		'name' => 					esc_html__('Profile Categories', 'hotel-lux'), 
		'singular_name' => 			esc_html__('Profile Category', 'hotel-lux') 
	);
}

}

// add_filter('cmsmasters_pl_categs_labels_filter', 'hotel_lux_pl_categs_labels');

