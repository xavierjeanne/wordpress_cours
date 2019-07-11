<?php 
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version 	1.0.1
 * 
 * Admin Panel Element Options
 * Created by CMSMasters
 * 
 */


function hotel_lux_options_element_tabs() {
	$tabs = array();
	
	$tabs['sidebar'] = esc_attr__('Sidebars', 'hotel-lux');
	
	if (class_exists('Cmsmasters_Content_Composer')) {
		$tabs['icon'] = esc_attr__('Social Icons', 'hotel-lux');
	}
	
	$tabs['lightbox'] = esc_attr__('Lightbox', 'hotel-lux');
	$tabs['sitemap'] = esc_attr__('Sitemap', 'hotel-lux');
	$tabs['error'] = esc_attr__('404', 'hotel-lux');
	$tabs['code'] = esc_attr__('Custom Codes', 'hotel-lux');
	
	if (class_exists('Cmsmasters_Form_Builder')) {
		$tabs['recaptcha'] = esc_attr__('reCAPTCHA', 'hotel-lux');
	}
	
	return apply_filters('cmsmasters_options_element_tabs_filter', $tabs);
}


function hotel_lux_options_element_sections() {
	$tab = hotel_lux_get_the_tab();
	
	switch ($tab) {
	case 'sidebar':
		$sections = array();
		
		$sections['sidebar_section'] = esc_attr__('Custom Sidebars', 'hotel-lux');
		
		break;
	case 'icon':
		$sections = array();
		
		$sections['icon_section'] = esc_attr__('Social Icons', 'hotel-lux');
		
		break;
	case 'lightbox':
		$sections = array();
		
		$sections['lightbox_section'] = esc_attr__('Theme Lightbox Options', 'hotel-lux');
		
		break;
	case 'sitemap':
		$sections = array();
		
		$sections['sitemap_section'] = esc_attr__('Sitemap Page Options', 'hotel-lux');
		
		break;
	case 'error':
		$sections = array();
		
		$sections['error_section'] = esc_attr__('404 Error Page Options', 'hotel-lux');
		
		break;
	case 'code':
		$sections = array();
		
		$sections['code_section'] = esc_attr__('Custom Codes', 'hotel-lux');
		
		break;
	case 'recaptcha':
		$sections = array();
		
		$sections['recaptcha_section'] = esc_attr__('Form Builder Plugin reCAPTCHA Keys', 'hotel-lux');
		
		break;
	default:
		$sections = array();
		
		
		break;
	}
	
	return apply_filters('cmsmasters_options_element_sections_filter', $sections, $tab);	
} 


function hotel_lux_options_element_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = hotel_lux_get_the_tab();
	}
	
	
	$options = array();
	
	
	$defaults = hotel_lux_settings_element_defaults();
	
	
	switch ($tab) {
	case 'sidebar':
		$options[] = array( 
			'section' => 'sidebar_section', 
			'id' => 'hotel-lux' . '_sidebar', 
			'title' => esc_html__('Custom Sidebars', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'sidebar', 
			'std' => $defaults[$tab]['hotel-lux' . '_sidebar'] 
		);
		
		break;
	case 'icon':
		$options[] = array( 
			'section' => 'icon_section', 
			'id' => 'hotel-lux' . '_social_icons', 
			'title' => esc_html__('Social Icons', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'social', 
			'std' => $defaults[$tab]['hotel-lux' . '_social_icons'] 
		);
		
		break;
	case 'lightbox':
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_skin', 
			'title' => esc_html__('Skin', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_skin'], 
			'choices' => array( 
				esc_html__('Dark', 'hotel-lux') . '|dark', 
				esc_html__('Light', 'hotel-lux') . '|light', 
				esc_html__('Mac', 'hotel-lux') . '|mac', 
				esc_html__('Metro Black', 'hotel-lux') . '|metro-black', 
				esc_html__('Metro White', 'hotel-lux') . '|metro-white', 
				esc_html__('Parade', 'hotel-lux') . '|parade', 
				esc_html__('Smooth', 'hotel-lux') . '|smooth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_path', 
			'title' => esc_html__('Path', 'hotel-lux'), 
			'desc' => esc_html__('Sets path for switching windows', 'hotel-lux'), 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_path'], 
			'choices' => array( 
				esc_html__('Vertical', 'hotel-lux') . '|vertical', 
				esc_html__('Horizontal', 'hotel-lux') . '|horizontal' 
			) 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_infinite', 
			'title' => esc_html__('Infinite', 'hotel-lux'), 
			'desc' => esc_html__('Sets the ability to infinite the group', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_infinite'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_aspect_ratio', 
			'title' => esc_html__('Keep Aspect Ratio', 'hotel-lux'), 
			'desc' => esc_html__('Sets the resizing method used to keep aspect ratio within the viewport', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_aspect_ratio'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_mobile_optimizer', 
			'title' => esc_html__('Mobile Optimizer', 'hotel-lux'), 
			'desc' => esc_html__('Make lightboxes optimized for giving better experience with mobile devices', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_mobile_optimizer'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_max_scale', 
			'title' => esc_html__('Max Scale', 'hotel-lux'), 
			'desc' => esc_html__('Sets the maximum viewport scale of the content', 'hotel-lux'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_max_scale'], 
			'min' => 0.1, 
			'max' => 2, 
			'step' => 0.05 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_min_scale', 
			'title' => esc_html__('Min Scale', 'hotel-lux'), 
			'desc' => esc_html__('Sets the minimum viewport scale of the content', 'hotel-lux'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_min_scale'], 
			'min' => 0.1, 
			'max' => 2, 
			'step' => 0.05 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_inner_toolbar', 
			'title' => esc_html__('Inner Toolbar', 'hotel-lux'), 
			'desc' => esc_html__('Bring buttons into windows, or let them be over the overlay', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_inner_toolbar'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_smart_recognition', 
			'title' => esc_html__('Smart Recognition', 'hotel-lux'), 
			'desc' => esc_html__('Sets content auto recognize from web pages', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_smart_recognition'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_fullscreen_one_slide', 
			'title' => esc_html__('Fullscreen One Slide', 'hotel-lux'), 
			'desc' => esc_html__('Decide to fullscreen only one slide or hole gallery the fullscreen mode', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_fullscreen_one_slide'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_fullscreen_viewport', 
			'title' => esc_html__('Fullscreen Viewport', 'hotel-lux'), 
			'desc' => esc_html__('Sets the resizing method used to fit content within the fullscreen mode', 'hotel-lux'), 
			'type' => 'select', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_fullscreen_viewport'], 
			'choices' => array( 
				esc_html__('Center', 'hotel-lux') . '|center', 
				esc_html__('Fit', 'hotel-lux') . '|fit', 
				esc_html__('Fill', 'hotel-lux') . '|fill', 
				esc_html__('Stretch', 'hotel-lux') . '|stretch' 
			) 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_controls_toolbar', 
			'title' => esc_html__('Toolbar Controls', 'hotel-lux'), 
			'desc' => esc_html__('Sets buttons be available or not', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_controls_toolbar'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_controls_arrows', 
			'title' => esc_html__('Arrow Controls', 'hotel-lux'), 
			'desc' => esc_html__('Enable the arrow buttons', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_controls_arrows'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_controls_fullscreen', 
			'title' => esc_html__('Fullscreen Controls', 'hotel-lux'), 
			'desc' => esc_html__('Sets the fullscreen button', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_controls_fullscreen'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_controls_thumbnail', 
			'title' => esc_html__('Thumbnails Controls', 'hotel-lux'), 
			'desc' => esc_html__('Sets the thumbnail navigation', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_controls_thumbnail'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_controls_keyboard', 
			'title' => esc_html__('Keyboard Controls', 'hotel-lux'), 
			'desc' => esc_html__('Sets the keyboard navigation', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_controls_keyboard'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_controls_mousewheel', 
			'title' => esc_html__('Mouse Wheel Controls', 'hotel-lux'), 
			'desc' => esc_html__('Sets the mousewheel navigation', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_controls_mousewheel'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_controls_swipe', 
			'title' => esc_html__('Swipe Controls', 'hotel-lux'), 
			'desc' => esc_html__('Sets the swipe navigation', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_controls_swipe'] 
		);
		
		$options[] = array( 
			'section' => 'lightbox_section', 
			'id' => 'hotel-lux' . '_ilightbox_controls_slideshow', 
			'title' => esc_html__('Slideshow Controls', 'hotel-lux'), 
			'desc' => esc_html__('Enable the slideshow feature and button', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_ilightbox_controls_slideshow'] 
		);
		
		break;
	case 'sitemap':
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'hotel-lux' . '_sitemap_nav', 
			'title' => esc_html__('Website Pages', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_sitemap_nav'] 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'hotel-lux' . '_sitemap_categs', 
			'title' => esc_html__('Blog Archives by Categories', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_sitemap_categs'] 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'hotel-lux' . '_sitemap_tags', 
			'title' => esc_html__('Blog Archives by Tags', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_sitemap_tags'] 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'hotel-lux' . '_sitemap_month', 
			'title' => esc_html__('Blog Archives by Month', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_sitemap_month'] 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'hotel-lux' . '_sitemap_pj_categs', 
			'title' => esc_html__('Portfolio Archives by Categories', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_sitemap_pj_categs'] 
		);
		
		$options[] = array( 
			'section' => 'sitemap_section', 
			'id' => 'hotel-lux' . '_sitemap_pj_tags', 
			'title' => esc_html__('Portfolio Archives by Tags', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_sitemap_pj_tags'] 
		);
		
		break;
	case 'error':
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'hotel-lux' . '_error_color', 
			'title' => esc_html__('Text Color', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'rgba', 
			'std' => $defaults[$tab]['hotel-lux' . '_error_color'] 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'hotel-lux' . '_error_bg_color', 
			'title' => esc_html__('Background Color', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'rgba', 
			'std' => $defaults[$tab]['hotel-lux' . '_error_bg_color'] 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'hotel-lux' . '_error_bg_img_enable', 
			'title' => esc_html__('Background Image Visibility', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_error_bg_img_enable'] 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'hotel-lux' . '_error_bg_image', 
			'title' => esc_html__('Background Image', 'hotel-lux'), 
			'desc' => esc_html__('Choose your custom error page background image.', 'hotel-lux'), 
			'type' => 'upload', 
			'std' => $defaults[$tab]['hotel-lux' . '_error_bg_image'], 
			'frame' => 'select', 
			'multiple' => false 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'hotel-lux' . '_error_bg_rep', 
			'title' => esc_html__('Background Repeat', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_error_bg_rep'], 
			'choices' => array( 
				esc_html__('No Repeat', 'hotel-lux') . '|no-repeat', 
				esc_html__('Repeat Horizontally', 'hotel-lux') . '|repeat-x', 
				esc_html__('Repeat Vertically', 'hotel-lux') . '|repeat-y', 
				esc_html__('Repeat', 'hotel-lux') . '|repeat' 
			) 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'hotel-lux' . '_error_bg_pos', 
			'title' => esc_html__('Background Position', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['hotel-lux' . '_error_bg_pos'], 
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
			'section' => 'error_section', 
			'id' => 'hotel-lux' . '_error_bg_att', 
			'title' => esc_html__('Background Attachment', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_error_bg_att'], 
			'choices' => array( 
				esc_html__('Scroll', 'hotel-lux') . '|scroll', 
				esc_html__('Fixed', 'hotel-lux') . '|fixed' 
			) 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'hotel-lux' . '_error_bg_size', 
			'title' => esc_html__('Background Size', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio', 
			'std' => $defaults[$tab]['hotel-lux' . '_error_bg_size'], 
			'choices' => array( 
				esc_html__('Auto', 'hotel-lux') . '|auto', 
				esc_html__('Cover', 'hotel-lux') . '|cover', 
				esc_html__('Contain', 'hotel-lux') . '|contain' 
			) 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'hotel-lux' . '_error_search', 
			'title' => esc_html__('Search Line', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_error_search'] 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'hotel-lux' . '_error_sitemap_button', 
			'title' => esc_html__('Sitemap Button', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_error_sitemap_button'] 
		);
		
		$options[] = array( 
			'section' => 'error_section', 
			'id' => 'hotel-lux' . '_error_sitemap_link', 
			'title' => esc_html__('Sitemap Page URL', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_error_sitemap_link'], 
			'class' => '' 
		);
		
		break;
	case 'code':
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'hotel-lux' . '_custom_css', 
			'title' => esc_html__('Custom CSS', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'textarea', 
			'std' => $defaults[$tab]['hotel-lux' . '_custom_css'], 
			'class' => 'allowlinebreaks' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'hotel-lux' . '_custom_js', 
			'title' => esc_html__('Custom JavaScript', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'textarea', 
			'std' => $defaults[$tab]['hotel-lux' . '_custom_js'], 
			'class' => 'allowlinebreaks' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'hotel-lux' . '_gmap_api_key', 
			'title' => esc_html__('Google Maps API key', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_gmap_api_key'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'hotel-lux' . '_api_key', 
			'title' => esc_html__('Twitter API key', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_api_key'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'hotel-lux' . '_api_secret', 
			'title' => esc_html__('Twitter API secret', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_api_secret'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'hotel-lux' . '_access_token', 
			'title' => esc_html__('Twitter Access token', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_access_token'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'code_section', 
			'id' => 'hotel-lux' . '_access_token_secret', 
			'title' => esc_html__('Twitter Access token secret', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_access_token_secret'], 
			'class' => '' 
		);
		
		break;
	case 'recaptcha':
		$options[] = array( 
			'section' => 'recaptcha_section', 
			'id' => 'hotel-lux' . '_recaptcha_public_key', 
			'title' => esc_html__('reCAPTCHA Public Key', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_recaptcha_public_key'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'recaptcha_section', 
			'id' => 'hotel-lux' . '_recaptcha_private_key', 
			'title' => esc_html__('reCAPTCHA Private Key', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_recaptcha_private_key'], 
			'class' => '' 
		);
		
		break;
	}
	
	return apply_filters('cmsmasters_options_element_fields_filter', $options, $tab);	
}

