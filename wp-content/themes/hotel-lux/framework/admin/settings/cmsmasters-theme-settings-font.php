<?php 
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.1.1
 * 
 * Admin Panel Fonts Options
 * Created by CMSMasters
 * 
 */


function hotel_lux_options_font_tabs() {
	$tabs = array();
	
	$tabs['content'] = esc_attr__('Content', 'hotel-lux');
	$tabs['link'] = esc_attr__('Links', 'hotel-lux');
	$tabs['nav'] = esc_attr__('Navigation', 'hotel-lux');
	$tabs['heading'] = esc_attr__('Heading', 'hotel-lux');
	$tabs['other'] = esc_attr__('Other', 'hotel-lux');
	$tabs['google'] = esc_attr__('Google Fonts', 'hotel-lux');
	
	return apply_filters('cmsmasters_options_font_tabs_filter', $tabs);
}


function hotel_lux_options_font_sections() {
	$tab = hotel_lux_get_the_tab();
	
	switch ($tab) {
	case 'content':
		$sections = array();
		
		$sections['content_section'] = esc_html__('Content Font Options', 'hotel-lux');
		
		break;
	case 'link':
		$sections = array();
		
		$sections['link_section'] = esc_html__('Links Font Options', 'hotel-lux');
		
		break;
	case 'nav':
		$sections = array();
		
		$sections['nav_section'] = esc_html__('Navigation Font Options', 'hotel-lux');
		
		break;
	case 'heading':
		$sections = array();
		
		$sections['heading_section'] = esc_html__('Headings Font Options', 'hotel-lux');
		
		break;
	case 'other':
		$sections = array();
		
		$sections['other_section'] = esc_html__('Other Fonts Options', 'hotel-lux');
		
		break;
	case 'google':
		$sections = array();
		
		$sections['google_section'] = esc_html__('Serving Google Fonts from CDN', 'hotel-lux');
		
		break;
	default:
		$sections = array();
		
		
		break;
	}
	
	return apply_filters('cmsmasters_options_font_sections_filter', $sections, $tab);
} 


function hotel_lux_options_font_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = hotel_lux_get_the_tab();
	}
	
	
	$options = array();
	
	
	$defaults = hotel_lux_settings_font_defaults();
	
	
	switch ($tab) {
	case 'content':
		$options[] = array( 
			'section' => 'content_section', 
			'id' => 'hotel-lux' . '_content_font', 
			'title' => esc_html__('Main Content Font', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['hotel-lux' . '_content_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		break;
	case 'link':
		$options[] = array( 
			'section' => 'link_section', 
			'id' => 'hotel-lux' . '_link_font', 
			'title' => esc_html__('Links Font', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['hotel-lux' . '_link_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'link_section', 
			'id' => 'hotel-lux' . '_link_hover_decoration', 
			'title' => esc_html__('Links Hover Text Decoration', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'select_scheme', 
			'std' => $defaults[$tab]['hotel-lux' . '_link_hover_decoration'], 
			'choices' => hotel_lux_text_decoration_list() 
		);
		
		break;
	case 'nav':
		$options[] = array( 
			'section' => 'nav_section', 
			'id' => 'hotel-lux' . '_nav_title_font', 
			'title' => esc_html__('Navigation Title Font', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['hotel-lux' . '_nav_title_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform' 
			) 
		);
		
		$options[] = array( 
			'section' => 'nav_section', 
			'id' => 'hotel-lux' . '_nav_dropdown_font', 
			'title' => esc_html__('Navigation Dropdown Font', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['hotel-lux' . '_nav_dropdown_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform' 
			) 
		);
		
		break;
	case 'heading':
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'hotel-lux' . '_h1_font', 
			'title' => esc_html__('H1 Tag Font', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['hotel-lux' . '_h1_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'hotel-lux' . '_h2_font', 
			'title' => esc_html__('H2 Tag Font', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['hotel-lux' . '_h2_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'hotel-lux' . '_h3_font', 
			'title' => esc_html__('H3 Tag Font', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['hotel-lux' . '_h3_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'hotel-lux' . '_h4_font', 
			'title' => esc_html__('H4 Tag Font', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['hotel-lux' . '_h4_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'hotel-lux' . '_h5_font', 
			'title' => esc_html__('H5 Tag Font', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['hotel-lux' . '_h5_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		$options[] = array( 
			'section' => 'heading_section', 
			'id' => 'hotel-lux' . '_h6_font', 
			'title' => esc_html__('H6 Tag Font', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['hotel-lux' . '_h6_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform', 
				'text_decoration' 
			) 
		);
		
		break;
	case 'other':
		$options[] = array( 
			'section' => 'other_section', 
			'id' => 'hotel-lux' . '_button_font', 
			'title' => esc_html__('Button Font', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['hotel-lux' . '_button_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform' 
			) 
		);
		
		$options[] = array( 
			'section' => 'other_section', 
			'id' => 'hotel-lux' . '_small_font', 
			'title' => esc_html__('Small Tag Font', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['hotel-lux' . '_small_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style', 
				'text_transform' 
			) 
		);
		
		$options[] = array( 
			'section' => 'other_section', 
			'id' => 'hotel-lux' . '_input_font', 
			'title' => esc_html__('Text Fields Font', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['hotel-lux' . '_input_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		$options[] = array( 
			'section' => 'other_section', 
			'id' => 'hotel-lux' . '_quote_font', 
			'title' => esc_html__('Blockquote Font', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'typorgaphy', 
			'std' => $defaults[$tab]['hotel-lux' . '_quote_font'], 
			'choices' => array( 
				'system_font', 
				'google_font', 
				'font_size', 
				'line_height', 
				'font_weight', 
				'font_style' 
			) 
		);
		
		break;
	case 'google':
		$options[] = array( 
			'section' => 'google_section', 
			'id' => 'hotel-lux' . '_google_web_fonts', 
			'title' => esc_html__('Google Fonts', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'google_web_fonts', 
			'std' => $defaults[$tab]['hotel-lux' . '_google_web_fonts'] 
		);
		
		$options[] = array( 
			'section' => 'google_section', 
			'id' => 'hotel-lux' . '_google_web_fonts_subset', 
			'title' => esc_html__('Google Fonts Subset', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'select_multiple', 
			'std' => '', 
			'choices' => array( 
				esc_html__('Latin Extended', 'hotel-lux') . '|' . 'latin-ext', 
				esc_html__('Arabic', 'hotel-lux') . '|' . 'arabic', 
				esc_html__('Cyrillic', 'hotel-lux') . '|' . 'cyrillic', 
				esc_html__('Cyrillic Extended', 'hotel-lux') . '|' . 'cyrillic-ext', 
				esc_html__('Greek', 'hotel-lux') . '|' . 'greek', 
				esc_html__('Greek Extended', 'hotel-lux') . '|' . 'greek-ext', 
				esc_html__('Vietnamese', 'hotel-lux') . '|' . 'vietnamese', 
				esc_html__('Japanese', 'hotel-lux') . '|' . 'japanese', 
				esc_html__('Korean', 'hotel-lux') . '|' . 'korean', 
				esc_html__('Thai', 'hotel-lux') . '|' . 'thai', 
				esc_html__('Bengali', 'hotel-lux') . '|' . 'bengali', 
				esc_html__('Devanagari', 'hotel-lux') . '|' . 'devanagari', 
				esc_html__('Gujarati', 'hotel-lux') . '|' . 'gujarati', 
				esc_html__('Gurmukhi', 'hotel-lux') . '|' . 'gurmukhi', 
				esc_html__('Hebrew', 'hotel-lux') . '|' . 'hebrew', 
				esc_html__('Kannada', 'hotel-lux') . '|' . 'kannada', 
				esc_html__('Khmer', 'hotel-lux') . '|' . 'khmer', 
				esc_html__('Malayalam', 'hotel-lux') . '|' . 'malayalam', 
				esc_html__('Myanmar', 'hotel-lux') . '|' . 'myanmar', 
				esc_html__('Oriya', 'hotel-lux') . '|' . 'oriya', 
				esc_html__('Sinhala', 'hotel-lux') . '|' . 'sinhala', 
				esc_html__('Tamil', 'hotel-lux') . '|' . 'tamil', 
				esc_html__('Telugu', 'hotel-lux') . '|' . 'telugu' 
			) 
		);
		
		break;
	}
	
	return apply_filters('cmsmasters_options_font_fields_filter', $options, $tab);	
}

