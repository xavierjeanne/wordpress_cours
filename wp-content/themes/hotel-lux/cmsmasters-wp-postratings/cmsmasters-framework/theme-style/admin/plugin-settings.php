<?php 
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version 	1.0.0
 * 
 * WP-PostRating Admin Settings
 * Created by CMSMasters
 * 
 */


/* Single Settings */
function hotel_lux_rating_options_single_fields($options, $tab) {
	$new_options = array();
	
	
	if ($tab == 'project') {
		foreach($options as $option) {
			if ($option['id'] == 'hotel-lux_portfolio_project_cat') {
				$new_options[] = array( 
					'section' => 'project_section', 
					'id' => 'hotel-lux' . '_portfolio_project_rating', 
					'title' => esc_html__('Room Rating', 'hotel-lux'), 
					'desc' => esc_html__('show', 'hotel-lux'), 
					'type' => 'checkbox', 
					'std' => 1
				);
				
				$new_options[] = $option;
			} else {
				$new_options[] = $option;
			}
		}
	} else {
		$new_options = $options;
	}
	
	
	return $new_options;
}

add_filter('cmsmasters_options_single_fields_filter', 'hotel_lux_rating_options_single_fields', 10, 2);

