<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.1.1
 * 
 * Website WP-PostRating Functions
 * Created by CMSMasters
 * 
 */



// WP-PostRatings Unregister Widget & Pages & Override Plugin Defaults
if(is_admin()) {
	function cmsmasters_rating_settings_page_removing() {
		remove_submenu_page('wp-postratings/postratings-manager.php', 'wp-postratings/postratings-templates.php');
	}
	
	add_action('admin_menu', 'cmsmasters_rating_settings_page_removing');
	
	
	function cmsmasters_rating_unregister_widget() {
		unregister_widget('WP_Widget_PostRatings');
	}
	
	add_action( 'widgets_init', 'cmsmasters_rating_unregister_widget' );
}



function hotel_lux_custom_rating_options() {
	$current_value = get_option('postratings_image');
	$custom_value = 'stars(png)';
	
	if($current_value != $custom_value) {
	
		// Ratings Options
		update_option('postratings_image', $custom_value);
		
		update_option('postratings_logging_method', '4');
		
		// Ratings Templates
		update_option('postratings_template_vote', '%RATINGS_IMAGES_VOTE%');
		
		update_option('postratings_template_text', '%RATINGS_IMAGES%');
		
		update_option('postratings_template_permission', '%RATINGS_IMAGES%');
		
		update_option('postratings_template_none', '%RATINGS_IMAGES_VOTE%');
		
		update_option('postratings_template_highestrated', '' );
		
		update_option('postratings_template_mostrated', '' );
	}
}

add_action('wp_enqueue_scripts', 'hotel_lux_custom_rating_options');


/* Load Parts */
require_once(get_template_directory() . '/cmsmasters-wp-postratings/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/admin/plugin-settings.php');


/* Register CSS Styles and Scripts */
function hotel_lux_rating_register_styles_scripts() {

	// WP-PostRating styles
	wp_enqueue_style('theme-cmsmasters-rating-style', get_template_directory_uri() . '/cmsmasters-wp-postratings/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/plugin-style.css', array(), '1.0.0', 'screen');

}

add_action('wp_enqueue_scripts', 'hotel_lux_rating_register_styles_scripts');



// WP Post Ratings Override plugin images, from plugin source
function cmsmasters_rating_deregister_script() {
	$postratings_max = intval(get_option('postratings_max'));
	$postratings_ajax_style = get_option('postratings_ajax_style');
	$postratings_custom = intval(get_option('postratings_customrating'));
	
	if($postratings_custom) {
		for($i = 1; $i <= $postratings_max; $i++) {
			$postratings_javascript .= 'var ratings_' . $i . '_mouseover_image=new Image();ratings_' . $i . '_mouseover_image.src=ratingsL10n.plugin_url+"/images/"+ratingsL10n.image+"/rating_' . $i . '_over."+ratingsL10n.image_ext;';
		}
	} else {
		$postratings_javascript = 'var ratings_mouseover_image=new Image();ratings_mouseover_image.src=ratingsL10n.plugin_url+"/images/"+ratingsL10n.image+"/rating_over."+ratingsL10n.image_ext;';
	}
	
	wp_dequeue_script('wp-postratings');
	
	wp_enqueue_script('wp-postratings', plugins_url('wp-postratings/postratings-js.js'), array('jquery'), WP_POSTRATINGS_VERSION, true);
	
	wp_localize_script('wp-postratings', 'ratingsL10n', array(
		'plugin_url'		=> get_template_directory_uri() . '/cmsmasters-wp-postratings/cmsmasters-framework/theme-style',
		'ajax_url' 			=> admin_url('admin-ajax.php'),
		'text_wait'			=> esc_html__('Please rate only 1 post at a time.', 'hotel-lux'),
		'image'				=> get_option('postratings_image'),
		'image_ext' 		=> 'png',
		'max' 				=> $postratings_max,
		'show_loading' 		=> intval($postratings_ajax_style['loading']),
		'show_fading' 		=> intval($postratings_ajax_style['fading']),
		'custom' 			=> $postratings_custom,
		'l10n_print_after' 	=> $postratings_javascript
	));
}

add_action('wp_print_scripts', 'cmsmasters_rating_deregister_script', 100);



// Fixing WP Post Ratings plugin initial output, to match Design
function cmsmasters_rating_prefix_fix($html) {
	$search = plugins_url( '/wp-postratings/images/stars(png)/' );
	
	$replace = get_template_directory_uri() . '/cmsmasters-wp-postratings/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/images/stars(png)/';
	
	$html = str_replace($search, $replace, $html);
	
	
	return $html;
}

add_filter( 'expand_ratings_template', 'cmsmasters_rating_prefix_fix', 999, 1 );



// Set WP Post Ratings default image format to PNG
function cmsmasters_rating_custom_image_extension() {
    return 'png';
}

add_filter('wp_postratings_image_extension', 'cmsmasters_rating_custom_image_extension');



// Display functions
function hotel_lux_custom_rating($cmsmasters_id, $template_type = 'page', $show = true) {	
	$cmsmasters_option = hotel_lux_get_global_options();
	$out = '';
	
	if (!isset($cmsmasters_option['hotel-lux' . '_portfolio_project_rating']) || (isset($cmsmasters_option['hotel-lux' . '_portfolio_project_rating'])) && $cmsmasters_option['hotel-lux' . '_portfolio_project_rating']) {
		if ($template_type == 'page') {
			$out = '<div class="cmsmasters_portfolio_project_rating cmsmasters_rating">' . 
				expand_ratings_template('<span>%RATINGS_IMAGES%</span>', $cmsmasters_id) . 
			'</div>';
		} else if ($template_type == 'post') {
			$out = '<div class="cmsmasters_project_rating cmsmasters_rating">' . 
					the_ratings('div', $cmsmasters_id, false) . 
			'</div>';
		}
	}
	
	if ($show) {
		echo hotel_lux_return_content($out);
	} else {
		return $out;
	}
}

