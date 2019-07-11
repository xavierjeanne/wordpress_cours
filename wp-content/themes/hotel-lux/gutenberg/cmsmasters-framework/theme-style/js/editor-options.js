/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version 	1.1.2
 * 
 * Editor Styles Wrapper Options Toggles Scripts
 * Created by CMSMasters
 * 
 */


(function ($) { 
	"use strict";
	
	$(document).ready(function () { 
		/* Page Layout Change */
		$('input[name="cmsmasters_layout"]').on('change', function () { 
			if ($(this).val() !== 'fullwidth') {
				$('body').addClass('enable_sidebar');
			} else {
				$('body').removeClass('enable_sidebar');
			}
		} );
	} );
} )(jQuery);

