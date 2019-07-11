<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version 	1.1.1
 * 
 * Content Composer Quotes Shortcode
 * Created by CMSMasters
 * 
 */


extract(shortcode_atts($new_atts, $atts));


if ($columns == '4') {
	$new_columns = 'quote_four';
} elseif ($columns == '3') {
	$new_columns = 'quote_three';
} elseif ($columns == '2') {
	$new_columns = 'quote_two';
} else {
	$new_columns = 'quote_one';
}


$this->quotes_atts = array(
	'quote_mode' => 	$mode, 
	'quote_type' => 	$type, 
	'quote_counter' => 	0, 
	'column_count' => 	$columns, 
	'quote_content' => 	'', 
	'quote_image' => 	'', 
	'quote_name' => 	'', 
	'quote_subtitle' => '', 
	'quote_link' => 	'', 
	'quote_website' => 	'' 
);


$unique_id = $shortcode_id;

$quotes_out = '';


$quote_out = do_shortcode($content);


if ($this->quotes_atts['quote_mode'] == 'slider') {
	$autoplay = ($speed > 0 ? $speed * 1000 : 'false');
	
	$quotes_out .= '<div class="cmsmasters_quotes_slider_wrap' . (($classes != '') ? ' ' . esc_attr($classes) : '') . '"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . "\n" . 
		"<div" . 
			" id=\"cmsmasters_quotes_slider_" . esc_attr($unique_id) . "\"" . 
			" class=\"cmsmasters_quotes cmsmasters_quotes_slider cmsmasters_quotes_slider_type_" . esc_attr($this->quotes_atts['quote_type']) . " cmsmasters_owl_slider owl-carousel\"" . 
			" data-auto-play=\"" . esc_attr($autoplay) . "\"" . 
			" data-pagination=\"false\"" . 
			" data-navigation=\"true\"" . 
		">" . 
			$quote_out . 
		'</div>' . "\n" . 
	'</div>';
} else {
	$quotes_out .= '<div class="cmsmasters_quotes cmsmasters_quotes_grid ' . esc_attr($new_columns) . 
	(($classes != '') ? ' ' . esc_attr($classes) : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . esc_attr($animation) . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . esc_attr($animation_delay) . '"' : '') . 
	'>' . "\n" . 
		'<span class="cmsmasters_quotes_vert"><span></span></span>' . 
		'<div class="cmsmasters_quotes_list">' . "\n" . 
			$quote_out . 
			'<span class="cl"></span>' . 
		'</div>' . "\n" . 
	'</div>';
}


echo hotel_lux_return_content($quotes_out);