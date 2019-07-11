<?php 
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Contact Form Builder
 * @version 	1.3.6
 * 
 * Contact Form Builder Post Type
 * Created by CMSMasters
 * 
 */


class Cmsmasters_Forms {
	function __construct() { 
		$template_labels = array( 
			'name' => __('Contact Forms', 'cmsmasters-form-builder'), 
			'singular_name' => __('Contact Form', 'cmsmasters-form-builder') 
		);
		
		
		$template_args = array( 
			'labels' => $template_labels, 
			'public' => false, 
			'capability_type' => 'post', 
			'hierarchical' => false, 
			'exclude_from_search' => true, 
			'publicly_queryable' => false, 
			'show_ui' => false, 
			'show_in_nav_menus' => false 
		);
		
		
		register_post_type('cmsmasters_cform', $template_args);
	}
}


function cmsmasters_forms_init() {
	global $frm;
	
	
	$frm = new Cmsmasters_Forms();
}


add_action('init', 'cmsmasters_forms_init');

