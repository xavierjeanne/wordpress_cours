<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version 	1.0.8
 * 
 * Theme Vars Functions
 * Created by CMSMasters
 * 
 */


/* Register CSS Styles */
function hotel_lux_vars_register_css_styles() {
	wp_enqueue_style('hotel-lux-theme-vars-style', get_template_directory_uri() . '/theme-vars/theme-style' . CMSMASTERS_THEME_STYLE . '/css/vars-style.css', array('hotel-lux-retina'), '1.0.0', 'screen, print');
}

add_action('wp_enqueue_scripts', 'hotel_lux_vars_register_css_styles');

