<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version 	1.0.0
 * 
 * Theme Content Composer Functions
 * Created by CMSMasters
 * 
 */


/* Register JS Scripts */
function hotel_lux_theme_register_c_c_scripts() {
	global $pagenow;
	
	
	if ( 
		$pagenow == 'post-new.php' || 
		($pagenow == 'post.php' && isset($_GET['post']) && get_post_type($_GET['post']) != 'attachment') 
	) {
		wp_enqueue_script('hotel-lux-composer-shortcodes-extend', get_template_directory_uri() . '/theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/cmsmasters-c-c/js/cmsmasters-c-c-theme-extend.js', array('cmsmasters_composer_shortcodes_js'), '1.0.0', true);
		
		wp_localize_script('hotel-lux-composer-shortcodes-extend', 'cmsmasters_theme_shortcodes', array( 
			'blog_field_layout_mode_puzzle' => 			esc_attr__('Puzzle', 'hotel-lux'), 
			
			'quotes_field_slider_type_title' => 		esc_attr__('Slider Type', 'hotel-lux'), 
			'quotes_field_slider_type_descr' => 		esc_attr__('Choose your quotes slider style type', 'hotel-lux'), 
			'quotes_field_type_choice_box' => 			esc_attr__('Boxed', 'hotel-lux'), 
			'quotes_field_type_choice_center' => 		esc_attr__('Centered', 'hotel-lux'), 
			'quotes_field_item_color_title' => 			esc_attr__('Color', 'hotel-lux'), 
			'quotes_field_item_color_descr' => 			esc_attr__('Enter this quote custom color', 'hotel-lux'), 
			
			'portfolio_title' => 									esc_attr__('Rooms Portfolio', 'hotel-lux'), 
			'portfolio_field_orderby_descr' => 						esc_attr__('Choose your rooms order by parameter', 'hotel-lux'), 			
			'portfolio_field_pj_number_title' =>					esc_attr__('Rooms Number', 'hotel-lux'),
			'portfolio_field_pj_number_descr' =>					esc_attr__('Enter the number of rooms for showing per page', 'hotel-lux'),
			'portfolio_field_pj_number_descr_note' =>				esc_attr__('number, if empty - show all rooms', 'hotel-lux'), 
			'portfolio_field_categories_descr' =>					esc_attr__('Show rooms associated with certain categories.', 'hotel-lux'),
			'portfolio_field_categories_descr_note' =>				esc_attr__("If you don't choose any room categories, all your rooms will be shown", 'hotel-lux'),			
			'portfolio_field_layout_descr' =>						esc_attr__('Choose layout type for your rooms', 'hotel-lux'),
			'portfolio_field_layout_choice_grid' =>					esc_attr__('Rooms Grid', 'hotel-lux'),
			'portfolio_field_layout_mode_descr' =>					esc_attr__('Choose grid layout mode for your rooms', 'hotel-lux'),			
			'portfolio_field_col_count_descr' =>					esc_attr__('Choose number of rooms per row', 'hotel-lux'),
			'portfolio_field_col_count_descr_note' =>				esc_attr__('4 and 5 columns will be shown for pages with a fullwidth layout only. For pages with a sidebar enabled, maximum columns amount is 3.', 'hotel-lux'),
			'portfolio_field_col_count_descr_note_custom' =>		esc_attr__('And 5 columns will be shown only if custom content width is set and when content area width is 1350px or more.', 'hotel-lux'),
			'portfolio_field_metadata_descr' =>						esc_attr__('Choose rooms metadata that you want to show', 'hotel-lux'),
			'portfolio_field_gap_descr' =>							esc_attr__('Choose the gap between rooms', 'hotel-lux'),
			'portfolio_field_filter_descr' =>						esc_attr__('If checked, enable rooms category filter', 'hotel-lux'),
			'portfolio_field_sorting_descr' =>						esc_attr__('If checked, enable rooms date & name sorting', 'hotel-lux'), 
			'portfolio_price' =>									esc_attr__('Price', 'hotel-lux'), 
			'portfolio_subtitle' =>									esc_attr__('Subtitle', 'hotel-lux'), 
			
			'posts_slider_field_poststype_choice_project' =>		esc_attr__('Rooms', 'hotel-lux'),
			'posts_slider_field_pjcateg_title' =>					esc_attr__('Rooms Categories', 'hotel-lux'),
			'posts_slider_field_pjcateg_descr' =>					esc_attr__('Show rooms associated with certain categories.', 'hotel-lux'),
			'posts_slider_field_pjcateg_descr_note' =>				esc_attr__("If you don't choose any rooms categories, all your rooms will be shown", 'hotel-lux'),			
			'posts_slider_field_col_count_descr' =>					esc_attr__('Choose number of rooms per row', 'hotel-lux'),			
			'posts_slider_field_pjmeta_title' =>					esc_attr__('Rooms Metadata', 'hotel-lux'),
			'posts_slider_field_pjmeta_descr' =>					esc_attr__('Choose rooms metadata you want to be shown', 'hotel-lux')
		));
	}
}

add_action('admin_enqueue_scripts', 'hotel_lux_theme_register_c_c_scripts');



// Quotes Shortcode Attributes Filter
add_filter('cmsmasters_quotes_atts_filter', 'cmsmasters_quotes_atts');

function cmsmasters_quotes_atts() {
	return array( 
		'shortcode_id' => 		'', 
		'mode' => 				'grid', 
		'type' => 				'boxed', 
		'columns' => 			'3', 
		'speed' => 				'10', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
	);
}

