<?php 
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.0.0
 * 
 * Admin Panel Theme Settings Import/Export
 * Created by CMSMasters
 * 
 */


function hotel_lux_options_demo_tabs() {
	$tabs = array();
	
	
	$tabs['import'] = esc_attr__('Import', 'hotel-lux');
	$tabs['export'] = esc_attr__('Export', 'hotel-lux');
	
	
	return $tabs;
}


function hotel_lux_options_demo_sections() {
	$tab = hotel_lux_get_the_tab();
	
	
	switch ($tab) {
	case 'import':
		$sections = array();
		
		$sections['import_section'] = esc_html__('Theme Settings Import', 'hotel-lux');
		
		
		break;
	case 'export':
		$sections = array();
		
		$sections['export_section'] = esc_html__('Theme Settings Export', 'hotel-lux');
		
		
		break;
	default:
		$sections = array();
		
		
		break;
	}
	
	
	return $sections;
} 


function hotel_lux_options_demo_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = hotel_lux_get_the_tab();
	}
	
	
	$options = array();
	
	
	switch ($tab) {
	case 'import':
		$options[] = array( 
			'section' => 'import_section', 
			'id' => 'hotel-lux' . '_demo_import', 
			'title' => esc_html__('Theme Settings', 'hotel-lux'), 
			'desc' => esc_html__("Enter your theme settings data here and click 'Import' button", 'hotel-lux') . (CMSMASTERS_THEME_STYLE_COMPATIBILITY ? '<span class="descr_note">' . esc_html__("Please note that when importing theme settings, these settings will be applied to the appropriate Theme Style (with the same name).", 'hotel-lux') . '<br />' . esc_html__("To see these settings applied, please enable appropriate", 'hotel-lux') . ' <a href="' . esc_url(admin_url('admin.php?page=cmsmasters-settings&tab=theme_style')) . '">' . esc_html__("Theme Style", 'hotel-lux') . '</a>.</span>' : ''), 
			'type' => 'textarea', 
			'std' => '', 
			'class' => '' 
		);
		
		
		break;
	case 'export':
		$options[] = array( 
			'section' => 'export_section', 
			'id' => 'hotel-lux' . '_demo_export', 
			'title' => esc_html__('Theme Settings', 'hotel-lux'), 
			'desc' => esc_html__("Click here to export your theme settings data to the file.", 'hotel-lux') . (CMSMASTERS_THEME_STYLE_COMPATIBILITY ? '<span class="descr_note">' . esc_html__("Please note, that when exporting theme settings, you will export settings for the currently active Theme Style.", 'hotel-lux') . '<br />' . esc_html__("Theme Style can be set", 'hotel-lux') . ' <a href="' . esc_url(admin_url('admin.php?page=cmsmasters-settings&tab=theme_style')) . '">' . esc_html__("here", 'hotel-lux') . '</a>.</span>' : ''), 
			'type' => 'button', 
			'std' => esc_html__('Export Theme Settings', 'hotel-lux'), 
			'class' => 'cmsmasters-demo-export' 
		);
		
		
		break;
	}
	
	
	return $options;	
}

