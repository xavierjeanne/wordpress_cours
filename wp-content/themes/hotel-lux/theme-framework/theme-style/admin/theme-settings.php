<?php 
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.0.4
 * 
 * Theme Admin Settings
 * Created by CMSMasters
 * 
 */


/* General Settings */
function hotel_lux_theme_options_general_fields($options, $tab) {
	$new_options = array();
	
	if ($tab == 'general') {
		foreach ($options as $option) {
			if ($option['id'] == 'hotel-lux_logo_url_retina') {
				$new_options[] = $option;
				
				$new_options[] = array( 
					'section' => 'general_section', 
					'id' => 'hotel-lux' . '_logo_url_small', 
					'title' => esc_html__('Logo Image For Small Resolutions', 'hotel-lux'), 
					'desc' => esc_html__('Choose your website logo image for small resolutions in header default.', 'hotel-lux'), 
					'type' => 'upload', 
					'std' => '|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo_small.png', 
					'frame' => 'select', 
					'multiple' => false 
				);
				
				$new_options[] = array( 
					'section' => 'general_section', 
					'id' => 'hotel-lux' . '_logo_url_retina_small', 
					'title' => esc_html__('Retina Logo Image For Small Resolutions', 'hotel-lux'), 
					'desc' => esc_html__('Choose logo image for retina displays on small resolutions in header default. Logo for Retina displays should be twice the size of the default one.', 'hotel-lux'), 
					'type' => 'upload', 
					'std' => '|' . get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/img/logo_small_retina.png', 
					'frame' => 'select', 
					'multiple' => false 
				);
			} else {
				$new_options[] = $option;
			}
		}
		
		$options = $new_options;
	} elseif ($tab == 'header') {
		foreach ($options as $option) {
			if ($option['id'] == 'hotel-lux_header_styles') {
				$option['choices'][] = esc_html__('Fullwidth Header Style', 'hotel-lux') . '|fullwidth';
				
				$new_options[] = $option;
			} else {
				$new_options[] = $option;
			}
		}
		
		$new_options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux_header_button', 
			'title' => esc_html__('Header Button', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => '1'
		);
		
		
		$new_options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux_header_button_text', 
			'title' => esc_html__('Header Button Text', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '', 
			'class' => '' 
		);
		
		
		$new_options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux_header_button_link', 
			'title' => esc_html__('Header Button Link', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => '', 
			'class' => '' 
		);
		
		$new_options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux_header_button_target', 
			'title' => esc_html__('Open link in a new tab/window?', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => '1'
		);
		
		$options = $new_options;
	}
	
	
	return $options;
}

add_filter('cmsmasters_options_general_fields_filter', 'hotel_lux_theme_options_general_fields', 10, 2);



/* Single Settings */
function hotel_lux_theme_options_single_fields($options, $tab) {
	$new_options = array();
	
	$defaults = hotel_lux_settings_single_defaults();
	
		if ($tab == 'project') {
			$new_options[] = array(
				'section' => 'project_section', 
				'id' => 'hotel-lux' . '_portfolio_project_layout', 
				'title' => esc_html__('Layout Type', 'hotel-lux'), 
				'desc' => '', 
				'type' => 'radio_img', 
				'std' => $defaults[$tab]['hotel-lux' . '_portfolio_project_layout'], 
				'choices' => array( 
					esc_html__('Right Sidebar', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
					esc_html__('Left Sidebar', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
					esc_html__('Full Width', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
				) 
			);
			
			foreach ($options as $option) {
				if ($option['id'] == 'hotel-lux_portfolio_project_title') {
					$option['title'] = esc_html__('Room Title', 'hotel-lux');
					
					$new_options[] = $option;
				} elseif ($option['id'] == 'hotel-lux_portfolio_project_details_title') {
					$option['title'] = esc_html__('Room Details Title', 'hotel-lux');
					$option['desc'] = esc_html__('Enter a room details block title', 'hotel-lux');
					
					$new_options[] = $option;
				} elseif ($option['id'] == 'hotel-lux_portfolio_project_date') {
					// this field removed
				} elseif ($option['id'] == 'hotel-lux_portfolio_project_cat') {
					$option['title'] = esc_html__('Room Categories', 'hotel-lux');
					
					$new_options[] = $option;
				} elseif ($option['id'] == 'hotel-lux_portfolio_project_author') {
					// this field removed
				} elseif ($option['id'] == 'hotel-lux_portfolio_project_comment') {
					// this field removed
				} elseif ($option['id'] == 'hotel-lux_portfolio_project_tag') {
					$option['title'] = esc_html__('Room Tags', 'hotel-lux');
					
					$new_options[] = $option;
				} elseif ($option['id'] == 'hotel-lux_portfolio_project_like') {
					// this field removed
				} elseif ($option['id'] == 'hotel-lux_portfolio_project_link') {
					$option['title'] = esc_html__('Room Link', 'hotel-lux');
					
					$new_options[] = $option;
				} elseif ($option['id'] == 'hotel-lux_portfolio_project_nav_box') {
					$option['title'] = esc_html__('Rooms Navigation Box', 'hotel-lux');
					
					$new_options[] = $option;
				} elseif ($option['id'] == 'hotel-lux_portfolio_project_nav_order_cat') {
					$option['title'] = esc_html__('Rooms Navigation Order by Category', 'hotel-lux');
					
					$new_options[] = $option;
				} elseif ($option['id'] == 'hotel-lux_portfolio_more_projects_box') {
					$option['title'] = esc_html__('More Rooms Box', 'hotel-lux');
					$option['choices'] = array( 
						esc_html__('Show Related Rooms', 'hotel-lux') . '|related', 
						esc_html__('Show Popular Rooms', 'hotel-lux') . '|popular', 
						esc_html__('Show Recent Rooms', 'hotel-lux') . '|recent', 
						esc_html__('Hide More Rooms Box', 'hotel-lux') . '|hide' 
					);
					
					$new_options[] = $option;
				} elseif ($option['id'] == 'hotel-lux_portfolio_more_projects_count') {
					$option['title'] = esc_html__('More Rooms Box Items Number', 'hotel-lux');
					$option['desc'] = esc_html__('rooms', 'hotel-lux');
					
					$new_options[] = $option;
				} elseif ($option['id'] == 'hotel-lux_portfolio_more_projects_pause') {
					$option['title'] = esc_html__('More Rooms Slider Pause Time', 'hotel-lux');
					
					$new_options[] = $option;
				} elseif ($option['id'] == 'hotel-lux_portfolio_project_slug') {
					$option['title'] = esc_html__('Room Slug', 'hotel-lux');
					$option['desc'] = esc_html__('Enter a page slug that should be used for your rooms single item', 'hotel-lux');
					
					$new_options[] = $option;
				} elseif ($option['id'] == 'hotel-lux_portfolio_pj_categs_slug') {
					$option['title'] = esc_html__('Room Categories Slug', 'hotel-lux');
					$option['desc'] = esc_html__('Enter page slug that should be used on rooms categories archive page', 'hotel-lux');
					
					$new_options[] = $option;
				} elseif ($option['id'] == 'hotel-lux_portfolio_pj_tags_slug') {
					$option['title'] = esc_html__('Room Tags Slug', 'hotel-lux');
					$option['desc'] = esc_html__('Enter page slug that should be used on rooms tags archive page', 'hotel-lux');
					
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

add_filter('cmsmasters_options_single_fields_filter', 'hotel_lux_theme_options_single_fields', 10, 2);



/* Single Tabs */
function hotel_lux_theme_options_single_tabs($tabs) {
	$tabs['project'] = esc_attr__('Room', 'hotel-lux');
	
	return $tabs;
}

add_filter('cmsmasters_options_single_tabs_filter', 'hotel_lux_theme_options_single_tabs', 10, 2);



/* Single Sections */
function hotel_lux_theme_options_single_sections($sections, $tab) {
	if ($tab == 'project') {
		$sections['project_section'] = esc_attr__('Room Options', 'hotel-lux');
	}
	
	return $sections;
}

add_filter('cmsmasters_options_single_sections_filter', 'hotel_lux_theme_options_single_sections', 10, 2);

