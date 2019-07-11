/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.0.0
 * 
 * Theme Admin Settings Toggles Scripts
 * Created by CMSMasters
 * 
 */


(function ($) { 
	"use strict";

	
	/* General 'Header' Tab Fields Load */
	if ($('input[name*="' + cmsmasters_theme_settings.shortname + '_header_styles"]:checked').val() === 'fullwidth') {
		$('#' + cmsmasters_theme_settings.shortname + '_header_button').parents('tr').show();
			if ($('#' + cmsmasters_theme_settings.shortname + '_header_button').is(':checked')) {
				$('#' + cmsmasters_theme_settings.shortname + '_header_button_text').parents('tr').show();
				$('#' + cmsmasters_theme_settings.shortname + '_header_button_link').parents('tr').show();
				$('#' + cmsmasters_theme_settings.shortname + '_header_button_target').parents('tr').show();
			} else {
				$('#' + cmsmasters_theme_settings.shortname + '_header_button_text').parents('tr').hide();
				$('#' + cmsmasters_theme_settings.shortname + '_header_button_link').parents('tr').hide();
				$('#' + cmsmasters_theme_settings.shortname + '_header_button_target').parents('tr').hide();
			}
		
	} else {
		$('#' + cmsmasters_theme_settings.shortname + '_header_button').parents('tr').hide();
		$('#' + cmsmasters_theme_settings.shortname + '_header_button_text').parents('tr').hide();
		$('#' + cmsmasters_theme_settings.shortname + '_header_button_link').parents('tr').hide();
		$('#' + cmsmasters_theme_settings.shortname + '_header_button_target').parents('tr').hide();
	}
	
	
	/* General 'Header' Tab Fields Change */
	$('input[name*="' + cmsmasters_theme_settings.shortname + '_header_styles"]').on('change', function () {
		if ($('input[name*="' + cmsmasters_theme_settings.shortname + '_header_styles"]:checked').val() === 'fullwidth') {
			$('#' + cmsmasters_theme_settings.shortname + '_header_button').parents('tr').show();
			
			if ($('#' + cmsmasters_theme_settings.shortname + '_header_button').is(':checked')) {
				$('#' + cmsmasters_theme_settings.shortname + '_header_button_text').parents('tr').show();
				$('#' + cmsmasters_theme_settings.shortname + '_header_button_link').parents('tr').show();
				$('#' + cmsmasters_theme_settings.shortname + '_header_button_target').parents('tr').show();
			} else {
				$('#' + cmsmasters_theme_settings.shortname + '_header_button_text').parents('tr').hide();
				$('#' + cmsmasters_theme_settings.shortname + '_header_button_link').parents('tr').hide();
				$('#' + cmsmasters_theme_settings.shortname + '_header_button_target').parents('tr').hide();
			}
		} else {
			$('#' + cmsmasters_theme_settings.shortname + '_header_button').parents('tr').hide();
			$('#' + cmsmasters_theme_settings.shortname + '_header_button_text').parents('tr').hide();
			$('#' + cmsmasters_theme_settings.shortname + '_header_button_link').parents('tr').hide();
			$('#' + cmsmasters_theme_settings.shortname + '_header_button_target').parents('tr').hide();
		}
	} );
	
	
	$('#' + cmsmasters_theme_settings.shortname + '_header_button').on('change', function () { 
		if ($('#' + cmsmasters_theme_settings.shortname + '_header_button').is(':checked')) {
			$('#' + cmsmasters_theme_settings.shortname + '_header_button_text').parents('tr').show();
			$('#' + cmsmasters_theme_settings.shortname + '_header_button_link').parents('tr').show();
			$('#' + cmsmasters_theme_settings.shortname + '_header_button_target').parents('tr').show();
		} else {
			$('#' + cmsmasters_theme_settings.shortname + '_header_button_text').parents('tr').hide();
			$('#' + cmsmasters_theme_settings.shortname + '_header_button_link').parents('tr').hide();
			$('#' + cmsmasters_theme_settings.shortname + '_header_button_target').parents('tr').hide();
		}
	} );
} )(jQuery);

