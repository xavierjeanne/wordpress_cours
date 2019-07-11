<?php 
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version 	1.1.2
 * 
 * Admin Panel General Options
 * Created by CMSMasters
 * 
 */


function hotel_lux_options_general_tabs() {
	$cmsmasters_option = hotel_lux_get_global_options();
	
	$tabs = array();
	
	$tabs['general'] = esc_attr__('General', 'hotel-lux');
	
	if ($cmsmasters_option['hotel-lux' . '_theme_layout'] === 'boxed') {
		$tabs['bg'] = esc_attr__('Background', 'hotel-lux');
	}
	
	if (CMSMASTERS_THEME_STYLE_COMPATIBILITY) {
		$tabs['theme_style'] = esc_attr__('Theme Style', 'hotel-lux');
	}
	
	$tabs['header'] = esc_attr__('Header', 'hotel-lux');
	$tabs['content'] = esc_attr__('Content', 'hotel-lux');
	$tabs['footer'] = esc_attr__('Footer', 'hotel-lux');
	
	return apply_filters('cmsmasters_options_general_tabs_filter', $tabs);
}


function hotel_lux_options_general_sections() {
	$tab = hotel_lux_get_the_tab();
	
	switch ($tab) {
	case 'general':
		$sections = array();
		
		$sections['general_section'] = esc_attr__('General Options', 'hotel-lux');
		
		break;
	case 'bg':
		$sections = array();
		
		$sections['bg_section'] = esc_attr__('Background Options', 'hotel-lux');
		
		break;
	case 'theme_style':
		$sections = array();
		
		$sections['theme_style_section'] = esc_attr__('Theme Design Style', 'hotel-lux');
		
		break;
	case 'header':
		$sections = array();
		
		$sections['header_section'] = esc_attr__('Header Options', 'hotel-lux');
		
		break;
	case 'content':
		$sections = array();
		
		$sections['content_section'] = esc_attr__('Content Options', 'hotel-lux');
		
		break;
	case 'footer':
		$sections = array();
		
		$sections['footer_section'] = esc_attr__('Footer Options', 'hotel-lux');
		
		break;
	default:
		$sections = array();
		
		
		break;
	}
	
	return apply_filters('cmsmasters_options_general_sections_filter', $sections, $tab);
} 


function hotel_lux_options_general_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = hotel_lux_get_the_tab();
	}
	
	$options = array();
	
	
	$defaults = hotel_lux_settings_general_defaults();
	
	
	switch ($tab) {
	case 'general':
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'hotel-lux' . '_theme_layout', 
			'title' => esc_html__('Theme Layout', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_theme_layout'], 
			'choices' => array( 
				esc_html__('Liquid', 'hotel-lux') . '|liquid', 
				esc_html__('Boxed', 'hotel-lux') . '|boxed' 
			) 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'hotel-lux' . '_logo_type', 
			'title' => esc_html__('Logo Type', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_logo_type'], 
			'choices' => array( 
				esc_html__('Image', 'hotel-lux') . '|image', 
				esc_html__('Text', 'hotel-lux') . '|text' 
			) 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'hotel-lux' . '_logo_url', 
			'title' => esc_html__('Logo Image', 'hotel-lux'), 
			'desc' => esc_html__('Choose your website logo image.', 'hotel-lux'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['hotel-lux' . '_logo_url'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'hotel-lux' . '_logo_url_retina', 
			'title' => esc_html__('Retina Logo Image', 'hotel-lux'), 
			'desc' => esc_html__('Choose logo image for retina displays. Logo for Retina displays should be twice the size of the default one.', 'hotel-lux'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['hotel-lux' . '_logo_url_retina'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'hotel-lux' . '_logo_title', 
			'title' => esc_html__('Logo Title', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_logo_title'], 
			'class' => 'nohtml' 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'hotel-lux' . '_logo_subtitle', 
			'title' => esc_html__('Logo Subtitle', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_logo_subtitle'], 
			'class' => 'nohtml' 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'hotel-lux' . '_logo_custom_color', 
			'title' => esc_html__('Custom Text Colors', 'hotel-lux'), 
			'desc' => esc_html__('enable', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_logo_custom_color'] 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'hotel-lux' . '_logo_title_color', 
			'title' => esc_html__('Logo Title Color', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'rgba', 
			'std' => $defaults[$tab]['hotel-lux' . '_logo_title_color'] 
		);
		
		$options[] = array( 
			'section' => 'general_section', 
			'id' => 'hotel-lux' . '_logo_subtitle_color', 
			'title' => esc_html__('Logo Subtitle Color', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'rgba', 
			'std' => $defaults[$tab]['hotel-lux' . '_logo_subtitle_color'] 
		);
		
		break;
	case 'bg':
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'hotel-lux' . '_bg_col', 
			'title' => esc_html__('Background Color', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'color', 
			'std' => $defaults[$tab]['hotel-lux' . '_bg_col'] 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'hotel-lux' . '_bg_img_enable', 
			'title' => esc_html__('Background Image Visibility', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_bg_img_enable'] 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'hotel-lux' . '_bg_img', 
			'title' => esc_html__('Background Image', 'hotel-lux'), 
			'desc' => esc_html__('Choose your custom website background image url.', 'hotel-lux'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['hotel-lux' . '_bg_img'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'hotel-lux' . '_bg_rep', 
			'title' => esc_html__('Background Repeat', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_bg_rep'], 
			'choices' => array( 
				esc_html__('No Repeat', 'hotel-lux') . '|no-repeat', 
				esc_html__('Repeat Horizontally', 'hotel-lux') . '|repeat-x', 
				esc_html__('Repeat Vertically', 'hotel-lux') . '|repeat-y', 
				esc_html__('Repeat', 'hotel-lux') . '|repeat' 
			) 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'hotel-lux' . '_bg_pos', 
			'title' => esc_html__('Background Position', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['hotel-lux' . '_bg_pos'], 
			'choices' => array( 
				esc_html__('Top Left', 'hotel-lux') . '|top left', 
				esc_html__('Top Center', 'hotel-lux') . '|top center', 
				esc_html__('Top Right', 'hotel-lux') . '|top right', 
				esc_html__('Center Left', 'hotel-lux') . '|center left', 
				esc_html__('Center Center', 'hotel-lux') . '|center center', 
				esc_html__('Center Right', 'hotel-lux') . '|center right', 
				esc_html__('Bottom Left', 'hotel-lux') . '|bottom left', 
				esc_html__('Bottom Center', 'hotel-lux') . '|bottom center', 
				esc_html__('Bottom Right', 'hotel-lux') . '|bottom right' 
			) 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'hotel-lux' . '_bg_att', 
			'title' => esc_html__('Background Attachment', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_bg_att'], 
			'choices' => array( 
				esc_html__('Scroll', 'hotel-lux') . '|scroll', 
				esc_html__('Fixed', 'hotel-lux') . '|fixed' 
			) 
		);
		
		$options[] = array( 
			'section' => 'bg_section', 
			'id' => 'hotel-lux' . '_bg_size', 
			'title' => esc_html__('Background Size', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_bg_size'], 
			'choices' => array( 
				esc_html__('Auto', 'hotel-lux') . '|auto', 
				esc_html__('Cover', 'hotel-lux') . '|cover', 
				esc_html__('Contain', 'hotel-lux') . '|contain' 
			) 
		);
		
		break;
	case 'theme_style':
		$options[] = array( 
			'section' => 'theme_style_section', 
			'id' => 'hotel-lux' . '_theme_style', 
			'title' => esc_html__('Choose Theme Style', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'select_theme_style', 
			'std' => '', 
			'choices' => hotel_lux_all_theme_styles() 
		);
		
		break;
	case 'header':
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux' . '_fixed_header', 
			'title' => esc_html__('Fixed Header', 'hotel-lux'), 
			'desc' => esc_html__('enable', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_fixed_header'] 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux' . '_header_overlaps', 
			'title' => esc_html__('Header Overlaps Content by Default', 'hotel-lux'), 
			'desc' => esc_html__('enable', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_header_overlaps'] 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux' . '_header_top_line', 
			'title' => esc_html__('Top Line', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_header_top_line'] 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux' . '_header_top_height', 
			'title' => esc_html__('Top Height', 'hotel-lux'), 
			'desc' => esc_html__('pixels', 'hotel-lux'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['hotel-lux' . '_header_top_height'], 
			'min' => '10' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux' . '_header_top_line_short_info', 
			'title' => esc_html__('Top Short Info', 'hotel-lux'), 
			'desc' => '<strong>' . esc_html__('HTML tags are allowed!', 'hotel-lux') . '</strong>', 
			'type' => 'textarea', 
			'std' => $defaults[$tab]['hotel-lux' . '_header_top_line_short_info'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux' . '_header_top_line_add_cont', 
			'title' => esc_html__('Top Additional Content', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_header_top_line_add_cont'], 
			'choices' => array( 
				esc_html__('None', 'hotel-lux') . '|none', 
				esc_html__('Top Line Social Icons (will be shown if Cmsmasters Content Composer plugin is active)', 'hotel-lux') . '|social', 
				esc_html__('Top Line Navigation (will be shown if set in Appearance - Menus tab)', 'hotel-lux') . '|nav' 
			) 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux' . '_header_styles', 
			'title' => esc_html__('Header Styles', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_header_styles'], 
			'choices' => array( 
				esc_html__('Default Style', 'hotel-lux') . '|default', 
				esc_html__('Compact Style Left Navigation', 'hotel-lux') . '|l_nav', 
				esc_html__('Compact Style Right Navigation', 'hotel-lux') . '|r_nav', 
				esc_html__('Compact Style Center Navigation', 'hotel-lux') . '|c_nav'
			) 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux' . '_header_mid_height', 
			'title' => esc_html__('Header Middle Height', 'hotel-lux'), 
			'desc' => esc_html__('pixels', 'hotel-lux'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['hotel-lux' . '_header_mid_height'], 
			'min' => '40' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux' . '_header_bot_height', 
			'title' => esc_html__('Header Bottom Height', 'hotel-lux'), 
			'desc' => esc_html__('pixels', 'hotel-lux'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['hotel-lux' . '_header_bot_height'], 
			'min' => '20' 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux' . '_header_search', 
			'title' => esc_html__('Header Search', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_header_search'] 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux' . '_header_add_cont', 
			'title' => esc_html__('Header Additional Content', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_header_add_cont'], 
			'choices' => array( 
				esc_html__('None', 'hotel-lux') . '|none', 
				esc_html__('Header Social Icons (will be shown if Cmsmasters Content Composer plugin is active)', 'hotel-lux') . '|social', 
				esc_html__('Header Custom HTML', 'hotel-lux') . '|cust_html' 
			) 
		);
		
		$options[] = array( 
			'section' => 'header_section', 
			'id' => 'hotel-lux' . '_header_add_cont_cust_html', 
			'title' => esc_html__('Header Custom HTML', 'hotel-lux'), 
			'desc' => '<strong>' . esc_html__('HTML tags are allowed!', 'hotel-lux') . '</strong>', 
			'type' => 'textarea', 
			'std' => $defaults[$tab]['hotel-lux' . '_header_add_cont_cust_html'], 
			'class' => '' 
		);
		
		break;
	case 'content':
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_layout', 
			'title' => esc_html__('Layout Type by Default', 'hotel-lux'), 
			'desc' => esc_html__('Choosing layout with a sidebar please make sure to add widgets to the Sidebar in the Appearance - Widgets tab. The empty sidebar won\'t be displayed.', 'hotel-lux'), 
			'type' => 'radio_img', 
			'std' => $defaults[$tab]['hotel-lux' . '_layout'], 
			'choices' => array( 
				esc_html__('Right Sidebar', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_archives_layout', 
			'title' => esc_html__('Archives Layout Type', 'hotel-lux'), 
			'desc' => esc_html__('Choosing layout with a sidebar please make sure to add widgets to the Archive Sidebar in the Appearance - Widgets tab. The empty sidebar won\'t be displayed.', 'hotel-lux'), 
			'type' => 'radio_img', 
			'std' => $defaults[$tab]['hotel-lux' . '_archives_layout'], 
			'choices' => array( 
				esc_html__('Right Sidebar', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_search_layout', 
			'title' => esc_html__('Search Layout Type', 'hotel-lux'), 
			'desc' => esc_html__('Choosing layout with a sidebar please make sure to add widgets to the Search Sidebar in the Appearance - Widgets tab. The empty sidebar won\'t be displayed.', 'hotel-lux'), 
			'type' => 'radio_img', 
			'std' => $defaults[$tab]['hotel-lux' . '_search_layout'], 
			'choices' => array( 
				esc_html__('Right Sidebar', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_other_layout', 
			'title' => esc_html__('Other Layout Type', 'hotel-lux'), 
			'desc' => esc_html__('Layout for pages of non-listed types. Choosing layout with a sidebar please make sure to add widgets to the Sidebar in the Appearance - Widgets tab. The empty sidebar won\'t be displayed.', 'hotel-lux'), 
			'type' => 'radio_img', 
			'std' => $defaults[$tab]['hotel-lux' . '_other_layout'], 
			'choices' => array( 
				esc_html__('Right Sidebar', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_heading_alignment', 
			'title' => esc_html__('Heading Alignment by Default', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_heading_alignment'], 
			'choices' => array( 
				esc_html__('Left', 'hotel-lux') . '|left', 
				esc_html__('Right', 'hotel-lux') . '|right', 
				esc_html__('Center', 'hotel-lux') . '|center' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_heading_scheme', 
			'title' => esc_html__('Heading Color Scheme by Default', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'select_scheme', 
			'std' => $defaults[$tab]['hotel-lux' . '_heading_scheme'], 
			'choices' => cmsmasters_color_schemes_list() 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_heading_bg_image_enable', 
			'title' => esc_html__('Heading Background Image Visibility by Default', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_heading_bg_image_enable'] 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_heading_bg_image', 
			'title' => esc_html__('Heading Background Image by Default', 'hotel-lux'), 
			'desc' => esc_html__('Choose your custom heading background image by default.', 'hotel-lux'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['hotel-lux' . '_heading_bg_image'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_heading_bg_repeat', 
			'title' => esc_html__('Heading Background Repeat by Default', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_heading_bg_repeat'], 
			'choices' => array( 
				esc_html__('No Repeat', 'hotel-lux') . '|no-repeat', 
				esc_html__('Repeat Horizontally', 'hotel-lux') . '|repeat-x', 
				esc_html__('Repeat Vertically', 'hotel-lux') . '|repeat-y', 
				esc_html__('Repeat', 'hotel-lux') . '|repeat' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_heading_bg_attachment', 
			'title' => esc_html__('Heading Background Attachment by Default', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_heading_bg_attachment'], 
			'choices' => array( 
				esc_html__('Scroll', 'hotel-lux') . '|scroll', 
				esc_html__('Fixed', 'hotel-lux') . '|fixed' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_heading_bg_size', 
			'title' => esc_html__('Heading Background Size by Default', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_heading_bg_size'], 
			'choices' => array( 
				esc_html__('Auto', 'hotel-lux') . '|auto', 
				esc_html__('Cover', 'hotel-lux') . '|cover', 
				esc_html__('Contain', 'hotel-lux') . '|contain' 
			) 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_heading_bg_color', 
			'title' => esc_html__('Heading Background Color Overlay by Default', 'hotel-lux'), 
			'desc' => '',  
			'type' => 'rgba', 
			'std' => $defaults[$tab]['hotel-lux' . '_heading_bg_color'] 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_heading_height', 
			'title' => esc_html__('Heading Height by Default', 'hotel-lux'), 
			'desc' => esc_html__('pixels', 'hotel-lux'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['hotel-lux' . '_heading_height'], 
			'min' => '0' 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_breadcrumbs', 
			'title' => esc_html__('Breadcrumbs Visibility by Default', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_breadcrumbs'] 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_bottom_scheme', 
			'title' => esc_html__('Bottom Color Scheme', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'select_scheme', 
			'std' => $defaults[$tab]['hotel-lux' . '_bottom_scheme'], 
			'choices' => cmsmasters_color_schemes_list() 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_bottom_sidebar', 
			'title' => esc_html__('Bottom Sidebar Visibility by Default', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux') . '<br><br>' . esc_html__('Please make sure to add widgets in the Appearance - Widgets tab. The empty sidebar won\'t be displayed.', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_bottom_sidebar'] 
		);
		
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_bottom_sidebar_layout', 
			'title' => esc_html__('Bottom Sidebar Layout by Default', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['hotel-lux' . '_bottom_sidebar_layout'], 
			'choices' => array( 
				'1/1|11', 
				'1/2 + 1/2|1212', 
				'1/3 + 2/3|1323', 
				'2/3 + 1/3|2313', 
				'1/4 + 3/4|1434', 
				'3/4 + 1/4|3414', 
				'1/3 + 1/3 + 1/3|131313', 
				'1/2 + 1/4 + 1/4|121414', 
				'1/4 + 1/2 + 1/4|141214', 
				'1/4 + 1/4 + 1/2|141412', 
				'1/4 + 1/4 + 1/4 + 1/4|14141414' 
			) 
		);
		
		break;
	case 'footer':
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'hotel-lux' . '_footer_scheme', 
			'title' => esc_html__('Footer Color Scheme', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'select_scheme', 
			'std' => $defaults[$tab]['hotel-lux' . '_footer_scheme'], 
			'choices' => cmsmasters_color_schemes_list() 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'hotel-lux' . '_footer_type', 
			'title' => esc_html__('Footer Type', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_footer_type'], 
			'choices' => array( 
				esc_html__('Default', 'hotel-lux') . '|default', 
				esc_html__('Small', 'hotel-lux') . '|small' 
			) 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'hotel-lux' . '_footer_additional_content', 
			'title' => esc_html__('Footer Additional Content', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_footer_additional_content'], 
			'choices' => array( 
				esc_html__('None', 'hotel-lux') . '|none', 
				esc_html__('Footer Navigation (will be shown if set in Appearance - Menus tab)', 'hotel-lux') . '|nav', 
				esc_html__('Social Icons (will be shown if Cmsmasters Content Composer plugin is active)', 'hotel-lux') . '|social', 
				esc_html__('Custom HTML', 'hotel-lux') . '|text' 
			) 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'hotel-lux' . '_footer_logo', 
			'title' => esc_html__('Footer Logo', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_footer_logo'] 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'hotel-lux' . '_footer_logo_url', 
			'title' => esc_html__('Footer Logo', 'hotel-lux'), 
			'desc' => esc_html__('Choose your website footer logo image.', 'hotel-lux'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['hotel-lux' . '_footer_logo_url'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'hotel-lux' . '_footer_logo_url_retina', 
			'title' => esc_html__('Footer Logo for Retina', 'hotel-lux'), 
			'desc' => esc_html__('Choose your website footer logo image for retina.', 'hotel-lux'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['hotel-lux' . '_footer_logo_url_retina'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'hotel-lux' . '_footer_nav', 
			'title' => esc_html__('Footer Navigation', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_footer_nav'] 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'hotel-lux' . '_footer_social', 
			'title' => esc_html__('Footer Social Icons (will be shown if Cmsmasters Content Composer plugin is active)', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_footer_social'] 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'hotel-lux' . '_footer_html', 
			'title' => esc_html__('Footer Custom HTML', 'hotel-lux'), 
			'desc' => '<strong>' . esc_html__('HTML tags are allowed!', 'hotel-lux') . '</strong>', 
			'type' => 'textarea', 
			'std' => $defaults[$tab]['hotel-lux' . '_footer_html'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'footer_section', 
			'id' => 'hotel-lux' . '_footer_copyright', 
			'title' => esc_html__('Copyright Text', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_footer_copyright'], 
			'class' => '' 
		);
		
		break;
	}
	
	return apply_filters('cmsmasters_options_general_fields_filter', $options, $tab);
}

