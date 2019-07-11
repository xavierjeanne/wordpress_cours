<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version 	1.1.2
 * 
 * Gutenberg Functions
 * Created by CMSMasters
 * 
 */


/* Load Parts */
require_once(get_template_directory() . '/gutenberg/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/function/module-colors.php');
require_once(get_template_directory() . '/gutenberg/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/function/module-fonts.php');


/* Register CSS Styles and Scripts */
function hotel_lux_gutenberg_support() {
	$colors = cmsmasters_color_picker_palettes();
	
	$color_palette = array();
	
	
	foreach ($colors as $color) {
		$color_palette[] = array(
			'color' => $color,
		);
	}
	
	
	add_theme_support('editor-color-palette', $color_palette);
}

add_action('after_setup_theme', 'hotel_lux_gutenberg_support');


/* Enqueue Block Editor Styles */
function hotel_lux_gutenberg_editor_styles() {
	wp_deregister_style('wp-block-library-theme');
	wp_register_style('wp-block-library-theme', '');
	
    wp_enqueue_style('hotel-lux-gutenberg-editor-style', get_theme_file_uri( '/gutenberg/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/editor-style.css' ), false, '1.0', 'all');
	
	
	if (is_rtl()) {
		wp_enqueue_style('hotel-lux-gutenberg-editor-style-rtl', get_template_directory_uri() . '/gutenberg/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/module-rtl.css', array(), '1.0.0', 'screen');
	}
	
	
	// Scripts
	wp_enqueue_script('hotel-lux-gutenberg-editor-options-script', get_template_directory_uri() . '/gutenberg/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/js/editor-options.js', array('jquery'), '1.0.0', true);
	
	
	$gutenberg_module_styles = hotel_lux_gutenberg_module_colors('', true);
	$gutenberg_module_styles .= hotel_lux_gutenberg_module_fonts('', true);
	
	wp_add_inline_style('hotel-lux-gutenberg-editor-style', $gutenberg_module_styles);
}

add_action('enqueue_block_editor_assets', 'hotel_lux_gutenberg_editor_styles');


/* Enqueue Frontend Styles */
function hotel_lux_gutenberg_frontend_styles() {
	wp_enqueue_style('hotel-lux-gutenberg-frontend-style', get_template_directory_uri() . '/gutenberg/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/frontend-style.css', array(), '1.0.0', 'screen');
	
	
	if (is_rtl()) {
		wp_enqueue_style('hotel-lux-gutenberg-frontend-rtl', get_template_directory_uri() . '/gutenberg/cmsmasters-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/css/module-rtl.css', array(), '1.0.0', 'screen');
	}
}

add_action('wp_enqueue_scripts', 'hotel_lux_gutenberg_frontend_styles');


/* Get Gutenberg Editor Container Custom Classes */
function hotel_lux_gutenberg_editor_custom_class( $classes ) {
	$cmsmasters_option = hotel_lux_get_global_options();
	$cmsmasters_layout = get_post_meta(get_the_ID(), 'cmsmasters_layout', true);
	$sidebar_id = get_post_meta(get_the_ID(), 'cmsmasters_sidebar_id', true);
	
	
	if (
		(!isset($_GET['action']) && !isset($_GET['post_type'])) ||
		(isset($_POST['post_type']) && $_POST['post_type'] == 'post') ||
		(isset($_GET['post']) && get_post_type($_GET['post']) == 'post')
	) {
		$cmsmasters_layout = ( get_post_meta( get_the_ID(), 'cmsmasters_layout', true ) == '' ) ? $cmsmasters_option['hotel-lux' . '_blog_post_layout'] : get_post_meta( get_the_ID(), 'cmsmasters_layout', true );
	}

	
	if (CMSMASTERS_WOOCOMMERCE && is_shop()) {
		$sidebar_id = get_post_meta(wc_get_page_id('shop'), 'cmsmasters_sidebar_id', true);
	}
	
	
	if ($sidebar_id != '' && $sidebar_id != false) {
		$sidebar_id = $sidebar_id;
	} else {
		$sidebar_id = 'sidebar_default';
	}
	
	
	if (
		$cmsmasters_layout != 'fullwidth' && 
		(is_active_sidebar($sidebar_id) || is_active_sidebar('sidebar_default'))
	) {
		$classes = 'enable_sidebar';
	}
	
	
    return $classes;
}

add_filter('admin_body_class', 'hotel_lux_gutenberg_editor_custom_class');

