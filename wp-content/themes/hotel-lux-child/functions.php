<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX Child
 * @version		1.0.0
 * 
 * Child Theme Functions File
 * Created by CMSMasters
 * 
 */


function hotel_lux_child_enqueue_styles() {
    wp_enqueue_style('hotel-lux-child-style', get_stylesheet_uri(), array(), '1.0.0', 'screen, print');
}

add_action('wp_enqueue_scripts', 'hotel_lux_child_enqueue_styles', 11);
?>