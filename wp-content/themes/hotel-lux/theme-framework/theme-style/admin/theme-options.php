<?php 
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.0.0
 * 
 * Theme Admin Options
 * Created by CMSMasters
 * 
 */


/* Filter for Options */
function hotel_lux_theme_meta_fields($custom_all_meta_fields) {
	$custom_all_meta_fields_new = array();
	
	
	if (
		(isset($_GET['post_type']) && $_GET['post_type'] == 'project') || 
		(isset($_POST['post_type']) && $_POST['post_type'] == 'project') || 
		(isset($_GET['post']) && get_post_type($_GET['post']) == 'project') 
	) {
		foreach ($custom_all_meta_fields as $custom_all_meta_field) {
			if ($custom_all_meta_field['id'] == 'cmsmasters_project_columns') {
				$options_field = array();
				
				$options_field = array( 
					'four' => array(
						'label' => esc_html__('Four', 'hotel-lux'), 
						'value'	=> 'four' 
					)
				);
				
				$custom_all_meta_field['options'] = array_merge($options_field, $custom_all_meta_field['options']);
				
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif ($custom_all_meta_field['id'] == 'cmsmasters_project_more_posts') {
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__("'Read More' Buttons Text", 'hotel-lux'), 
					'desc'	=> esc_html__("Enter the 'Read More' button text that should be used in your room shortcode", 'hotel-lux'), 
					'id'	=> 'cmsmasters_project_read_more', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> esc_html__('Learn More', 'hotel-lux') 
				);
			} elseif ($custom_all_meta_field['id'] == 'cmsmasters_project_title') {
				$custom_all_meta_field['label'] = esc_html__('Room Title', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
				
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Room Subtitle', 'hotel-lux'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_project_subtitle', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> '' 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Room Price', 'hotel-lux'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_project_price', 
					'type'	=> 'text', 
					'hide'	=> '', 
					'std'	=> '' 
				);
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_page_scheme'
			) {
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
				
				$cmsmasters_global_portfolio_project_layout = (isset($cmsmasters_option['hotel-lux' . '_portfolio_project_layout']) && $cmsmasters_option['hotel-lux' . '_portfolio_project_layout'] !== '') ? $cmsmasters_option['hotel-lux' . '_portfolio_project_layout'] : 'r_sidebar';
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Room Layout', 'hotel-lux'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_layout', 
					'type'	=> 'radio_img', 
					'hide'	=> '', 
					'std'	=> $cmsmasters_global_portfolio_project_layout, 
					'options' => array( 
						'r_sidebar' => array( 
							'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg', 
							'label' => esc_html__('Right Sidebar', 'hotel-lux'), 
							'value'	=> 'r_sidebar' 
						), 
						'l_sidebar' => array( 
							'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg', 
							'label' => esc_html__('Left Sidebar', 'hotel-lux'), 
							'value'	=> 'l_sidebar' 
						), 
						'fullwidth' => array( 
							'img'	=> get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg', 
							'label' => esc_html__('Full Width', 'hotel-lux'), 
							'value'	=> 'fullwidth' 
						) 
					) 
				);
				
				$custom_all_meta_fields_new[] = array( 
					'label'	=> esc_html__('Choose Right\Left Sidebar', 'hotel-lux'), 
					'desc'	=> '', 
					'id'	=> 'cmsmasters_sidebar_id', 
					'type'	=> 'select_sidebar', 
					'hide'	=> 'true', 
					'std'	=> '' 
				);
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_images' && 
				$custom_all_meta_field['type'] != 'content_start' 
			) {
				$custom_all_meta_field['label'] = esc_html__('Room Images', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_image_show'
			) {	
				$custom_all_meta_field['label'] = esc_html__('Don\'t Show Featured Image in Open Rooms', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_size'
			) {
				$custom_all_meta_field['label'] = esc_html__('Room Size', 'hotel-lux');
				$custom_all_meta_field['desc'] = esc_html__('Recommended Room Puzzle Image dimensions, or other size, with the same ratio', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_puzzle_image'
			) {	
				$custom_all_meta_field['label'] = esc_html__('Room Puzzle Image', 'hotel-lux');
				$custom_all_meta_field['desc'] = esc_html__('Choose image for Masonry Puzzle portfolio rooms', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_details_title'
			) {
				$custom_all_meta_field['label'] = esc_html__('Room Details Title', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_features'
			) {
				$custom_all_meta_field['label'] = esc_html__('Room Info', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_link_text'
			) {
				$custom_all_meta_field['label'] = esc_html__('Room Link Text', 'hotel-lux');
				$custom_all_meta_field['std'] = esc_html__('View Room', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_link_url'
			) {
				$custom_all_meta_field['label'] = esc_html__('Room Link URL', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_link_redirect'
			) {
				$custom_all_meta_field['desc'] = esc_html__('Redirect to room link URL instead of opening room page', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_link_target'
			) {
				$custom_all_meta_field['label'] = esc_html__('Room Link Target', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_features_one_title'
			) {
				$custom_all_meta_field['label'] = esc_html__('Room Features 1 Title', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_features_one'
			) {
				$custom_all_meta_field['label'] = esc_html__('Room Features 1', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_features_two_title'
			) {
				$custom_all_meta_field['label'] = esc_html__('Room Features 2 Title', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_features_two'
			) {
				$custom_all_meta_field['label'] = esc_html__('Room Features 2', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_features_three_title'
			) {
				$custom_all_meta_field['label'] = esc_html__('Room Features 3 Title', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_features_three'
			) {
				$custom_all_meta_field['label'] = esc_html__('Room Features 3', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} elseif (
				$custom_all_meta_field['id'] == 'cmsmasters_project_tabs'
			) {
				$custom_all_meta_field['options']['cmsmasters_project']['label'] = esc_html__('Chalet', 'hotel-lux');
				
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			} else {
				$custom_all_meta_fields_new[] = $custom_all_meta_field;
			}
		}
	} else {
		$custom_all_meta_fields_new = $custom_all_meta_fields;
	}
	
	
	return $custom_all_meta_fields_new;
}

add_filter('get_custom_all_meta_fields_filter', 'hotel_lux_theme_meta_fields');

