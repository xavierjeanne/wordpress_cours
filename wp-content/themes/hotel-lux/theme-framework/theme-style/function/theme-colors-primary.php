<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version 	1.0.9
 * 
 * Theme Primary Color Schemes Rules
 * Created by CMSMasters
 * 
 */


function hotel_lux_theme_colors_primary() {
	$cmsmasters_option = hotel_lux_get_global_options();
	
	
	$cmsmasters_color_schemes = cmsmasters_color_schemes_list();
	
	
	$custom_css = "/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version 	1.0.9
 * 
 * Theme Primary Color Schemes Rules
 * Created by CMSMasters
 * 
 */

";
	
	
	foreach ($cmsmasters_color_schemes as $scheme => $title) {
		$rule = (($scheme != 'default') ? "html .cmsmasters_color_scheme_{$scheme} " : '');
		
		
		$custom_css .= "
/***************** Start {$title} Color Scheme Rules ******************/

	/* Start Main Content Font Color */
	" . (($scheme == 'default') ? "body," : '') . "
	" . (($scheme != 'default') ? ".cmsmasters_color_scheme_{$scheme}," : '') . "
	{$rule}.share_posts a,
	{$rule}.widget_custom_contact_info_entries a,
	{$rule}.widget_pages ul li a, 
	{$rule}.widget_categories ul li a, 
	{$rule}.widget_archive ul li a, 
	{$rule}.widget_meta ul li a, 
	{$rule}.widget_text ul li a, 
	{$rule}.post_nav .post_nav_sub,
	{$rule}.cmsmasters_likes a,
	{$rule}.cmsmasters_comments a,
	{$rule}.cmsmasters_likes a span, 
	{$rule}.cmsmasters_comments a span, 
	{$rule}.cmsmasters_likes a:hover span, 
	{$rule}.cmsmasters_comments a:hover span, 
	{$rule}.cmsmasters_notice .notice_close,
	{$rule}.cmsmasters_post_timeline .published,
	{$rule}.cmsmasters_project_grid .cmsmasters_project_category a,
	{$rule}.cmsmasters_stats.stats_mode_circles .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner:before, 
	{$rule}.cmsmasters_stats.stats_mode_bars.stats_type_vertical .cmsmasters_stat_wrap .cmsmasters_stat_counter_wrap,
	{$rule}.cmsmasters_open_project .project_sidebar .cmsmasters_likes a span, 
	{$rule}.cmsmasters_open_profile .profile_details .cmsmasters_likes span,
	{$rule}.cmsmasters_open_project .project_sidebar .cmsmasters_comments a span, 
	{$rule}.search_bar_wrap .search_button button:before {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_color']) . "
	}
	
	{$rule}.owl-pagination .owl-page:hover,
	{$rule}.owl-pagination .owl-page.active {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_color']) . "
	}
	
	{$rule}.custom_subscribe .wysija-input {
		background-color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['hotel-lux' . '_' . $scheme . '_color']) . ", 0.08) !important;
	}
	/* Finish Main Content Font Color */
	
	
	/* Start Primary Color */
	{$rule}a,
	{$rule}h1 a:hover,
	{$rule}h2 a:hover,
	{$rule}h3 a:hover,
	{$rule}h4 a:hover,
	{$rule}h5 a:hover,
	{$rule}h6 a:hover,
	{$rule}.color_2,
	{$rule}.post_nav a:hover,
	{$rule}.cmsmasters_header_search_form .cmsmasters_header_search_form_close, 
	{$rule}.cmsmasters_header_search_form button, 
	{$rule}.cmsmasters_wrap_more_items.cmsmasters_loading:before,
	{$rule}.footer_inner .cmsmasters_social_icon,
	{$rule}#today,
	{$rule}.widget_custom_contact_info_entries > span:before, 
	{$rule}.widget_custom_contact_info_entries .adress_wrap:before,
	{$rule}.widget_nav_menu ul li a:hover,
	{$rule}.widget_nav_menu ul li.current_page_item > a,
	{$rule}.cmsmasters_widget_project_cont_info .cmsmasters_slider_project_category a:hover, 
	{$rule}.widget_custom_twitter_entries .tweet_time:before, 
	{$rule}.widget_pages ul li a:hover, 
	{$rule}.widget_categories ul li a:hover, 
	{$rule}.widget_archive ul li a:hover, 
	{$rule}.widget_meta ul li a:hover, 
	{$rule}.widget_text ul li a:hover, 
	{$rule}.cmsmasters_slider_project .cmsmasters_slider_project_cont_info a:hover,
	{$rule}.cmsmasters_slider_post .cmsmasters_slider_post_cont_info a:hover,
	{$rule}.cmsmasters_twitter_wrap .twr_icon,
	{$rule}.cmsmasters_pricing_table .cmsmasters_currency, 
	{$rule}.cmsmasters_pricing_table .cmsmasters_price, 
	{$rule}.cmsmasters_pricing_table .cmsmasters_coins,
	{$rule}.stats_mode_bars.stats_type_vertical .cmsmasters_stat_title.stat_has_titleicon:before,
	{$rule}.cmsmasters_quotes_slider_type_center .cmsmasters_quote_placeholder:before,
	{$rule}.cmsmasters_quote_title,
	{$rule}.cmsmasters_toggles .cmsmasters_toggle_title a:hover,
	{$rule}.cmsmasters_toggles .current_toggle .cmsmasters_toggle_title a,
	{$rule}.cmsmasters_tabs .cmsmasters_tabs_list_item.current_tab a,
	{$rule}.cmsmasters_tabs .cmsmasters_tabs_list_item a:hover,
	{$rule}.cmsmasters_archive_item_info a:hover,
	{$rule}.cmsmasters_open_profile .cmsmasters_profile_title,
	{$rule}.cmsmasters_social_icon:hover,
	{$rule}.cmsmasters_slider_project .cmsmasters_img_rollover .cmsmasters_theme_icon_post_link,
	{$rule}.cmsmasters_project_grid .cmsmasters_img_rollover .cmsmasters_theme_icon_post_link,
	{$rule}.project_details_item_desc a:hover, 
	{$rule}.project_features_item_desc a:hover,
	{$rule}.profile_details a:hover, 
	{$rule}.profile_features a:hover,
	{$rule}.cmsmasters_project_grid .cmsmasters_project_category a:hover,
	{$rule}.blog.timeline .post:hover .cmsmasters_post_day,
	{$rule}.share_posts a:hover,
	{$rule}.post.cmsmasters_post_puzzle .cmsmasters_post_footer > span a:hover,
	{$rule}.cmsmasters_wrap_pagination ul li .page-numbers.current,
	{$rule}.cmsmasters_wrap_pagination ul li a.page-numbers:hover,
	{$rule}.cmsmasters_likes a:hover:before,
	{$rule}.cmsmasters_likes a.active:before,
	{$rule}.cmsmasters_comments a:hover:before,
	{$rule}.post_nav .cmsmasters_next_post:hover .cmsmasters_next_arrow span, 
	{$rule}.post_nav .cmsmasters_prev_post:hover .cmsmasters_prev_arrow span, 
	{$rule}.cmsmasters_post_cont_info .cmsmasters_post_tags a,
	{$rule}.cmsmasters_post_cont_info .cmsmasters_post_author a,
	{$rule}.cmsmasters_post_cont_info .cmsmasters_post_category a,
	{$rule}.cmsmasters_slider_project .cmsmasters_slider_project_cont_info a,
	{$rule}.cmsmasters_slider_post .cmsmasters_slider_post_cont_info a,
	{$rule}.cmsmasters_items_filter_wrap .cmsmasters_items_sort_but:hover,
	{$rule}.cmsmasters_items_filter_wrap .cmsmasters_items_sort_but.current,
	{$rule}.cmsmasters_items_filter_wrap .cmsmasters_items_sort_but.current:before,
	{$rule}.cmsmasters_items_filter_wrap .cmsmasters_items_sort_but:hover:before,
	{$rule}.cmsmasters_items_filter_wrap .cmsmasters_items_filter_list li.current a,
	{$rule}.cmsmasters_items_filter_wrap .cmsmasters_items_filter_list li a:hover,
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=checkbox] + span.wpcf7-list-item-label:after, 
	{$rule}.cmsmasters-form-builder .check_parent input[type=checkbox] + label:after, 
	{$rule}.cmsmasters_dropcap.type1,
	{$rule}.cmsmasters_post_default .cmsmasters_post_cont > a .published, 
	{$rule}.cmsmasters_open_project .cmsmasters_project_category a:hover,
	{$rule}.cmsmasters_single_slider .cmsmasters_project_price,
	{$rule}.cmsmasters_open_project .cmsmasters_project_price,
	{$rule}.cmsmasters_project_grid .cmsmasters_project_price,
	{$rule}.cmsmasters_project_puzzle .cmsmasters_project_price,
	{$rule}.cmsmasters_slider_project .cmsmasters_project_price, 
	{$rule}.widget_custom_popular_projects_entries .cmsmasters_project_price, 
	{$rule}.widget_custom_latest_projects_entries .cmsmasters_project_price, 
	{$rule}.cmsmasters_project_read_more:hover, 
	{$rule}.cmsmasters_slider_post_read_more:hover, 
	{$rule}.cmsmasters_slider_project .cmsmasters_slider_post_read_more:hover, 
	{$rule}.cmsmasters_quotes_slider_type_center .cmsmasters_prev_arrow:hover, 
	{$rule}.cmsmasters_quotes_slider_type_center .cmsmasters_next_arrow:hover, 
	{$rule}.cmsmasters_quotes_slider_type_center .cmsmasters_quote_subtitle_wrap .cmsmasters_quote_subtitle,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_top:before,
	{$rule}.cmsmasters_icon_wrap a .cmsmasters_simple_icon,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_heading_left .icon_box_heading:before,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_icon .cmsmasters_icon_list_icon:before,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_border .cmsmasters_icon_list_icon:before,
	{$rule}.bypostauthor > .comment-body .alignleft:before,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li > a:hover,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li > ul > li > a:hover,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap_category > li > a:hover,
	{$rule}.cmsmasters_attach_img .cmsmasters_attach_img_edit a, 
	{$rule}.cmsmasters_attach_img .cmsmasters_attach_img_meta a,
	{$rule}#tribe-bar-views .tribe-bar-views-option.tribe-bar-active, 
	{$rule}#tribe-bar-views .tribe-bar-views-option:hover {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
	}
	
	" . (($scheme == 'default') ? "#slide_top:hover," : '') . "
	" . (($scheme == 'default') ? "mark," : '') . "
	" . (($scheme != 'default') ? ".cmsmasters_color_scheme_{$scheme} mark," : '') . "
	{$rule}.custom_subscribe .wysija-submit-field,
	{$rule}.widget_nav_menu ul li a:before,
	{$rule}.cmsmasters_notice .notice_close:hover,
	{$rule}.pricing_best .cmsmasters_price_wrap,
	{$rule}.cmsmasters_content_slider .owl-buttons > div:hover > span,
	{$rule}.cmsmasters_content_slider .owl-pagination .owl-page:hover span,
	{$rule}.cmsmasters_content_slider .owl-pagination .owl-page.active span,
	{$rule}.post.cmsmasters_post_puzzle:hover .puzzle_post_content_wrapper,
	{$rule}.post.cmsmasters_post_puzzle:hover .puzzle_post_content_wrapper .cmsmasters_post_footer,
	{$rule}.cmsmasters_dropcap.type2,
	{$rule}.cmsmasters_button, 
	{$rule}.button, 
	{$rule}input[type=submit], 
	{$rule}input[type=button], 
	{$rule}button,
	{$rule}.cmsmasters_table thead tr,
	{$rule}.cmsmasters_prev_arrow:hover, 
	{$rule}.cmsmasters_next_arrow:hover, 
	{$rule}.cmsmasters_tabs.tabs_mode_tab .cmsmasters_tabs_list_item:before, 
	{$rule}.blog .post.format-gallery .cmsmasters_owl_slider .cmsmasters_prev_arrow:hover, 
	{$rule}.blog .post.format-gallery .cmsmasters_owl_slider .cmsmasters_next_arrow:hover,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_top:before,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_left_top:before,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_left:before,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_bg .cmsmasters_icon_list_item .cmsmasters_icon_list_icon,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_icon .cmsmasters_icon_list_item:hover .cmsmasters_icon_list_icon,
	{$rule}.cmsmasters_stats.stats_mode_bars .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner, 
	{$rule}.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner:before, 
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=radio] + span.wpcf7-list-item-label:after, 
	{$rule}.cmsmasters-form-builder .check_parent input[type=radio] + label:after,
	{$rule}#tribe-events-sub-nav a:hover .cmsmasters_next_arrow,
	{$rule}#tribe-events-sub-nav a:hover .cmsmasters_prev_arrow {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
	}
	
	" . (($scheme == 'default') ? "#slide_top:hover," : '') . "
	{$rule}.cmsmasters_content_slider .owl-pagination .owl-page:before,
	{$rule}.cmsmasters_content_slider .owl-pagination .owl-page:hover,
	{$rule}.cmsmasters_content_slider .owl-pagination .owl-page.active,
	{$rule}.cmsmasters_notice .notice_close:hover,
	{$rule}.pricing_best .cmsmasters_price_wrap,
	{$rule}.cmsmasters_content_slider .owl-buttons > div:hover > span,
	{$rule}.post.cmsmasters_post_puzzle:hover .puzzle_post_content_wrapper .cmsmasters_post_footer,
	{$rule}.post.cmsmasters_post_puzzle:hover .puzzle_post_content_wrapper:before,
	{$rule}.cmsmasters_prev_arrow:hover, 
	{$rule}.cmsmasters_next_arrow:hover, 
	{$rule}button:hover,
	{$rule}.cmsmasters_table thead th,
	{$rule}.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner:before, 
	{$rule}input:not([type=submit]):not([type=button]):not([type=radio]):not([type=checkbox]):focus,
	{$rule}select:focus,
	{$rule}textarea:focus {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.nf-form-cont .nf-field-element select:focus, 
	{$rule}.post.cmsmasters_post_puzzle:hover .puzzle_post_content_wrapper,
	{$rule}input:not([type=submit]):not([type=button]):not([type=radio]):not([type=checkbox]):focus,
	{$rule}textarea:focus,
	{$rule}select:focus {
		-webkit-box-shadow:inset 0 0 0 1px " . $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link'] . ";
		box-shadow:inset 0 0 0 1px " . $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link'] . ";
	}
	/* Finish Primary Color */
	
	
	/* Start Highlight Color */
	{$rule}a:hover,
	{$rule}.cmsmasters_header_search_form button:hover, 
	{$rule}.cmsmasters_header_search_form .cmsmasters_header_search_form_close:hover, 
	{$rule}.footer_inner .cmsmasters_social_icon:hover,
	{$rule}input:not([type=submit]):not([type=button]):not([type=radio]):not([type=checkbox]),
	{$rule}textarea,
	{$rule}select,
	{$rule}option,
	{$rule}blockquote:before,
	{$rule}q:before,
	{$rule}.published,
	{$rule}.cmsmasters_post_timeline .cmsmasters_post_day, 
	{$rule}.cmsmasters_likes a:before,
	{$rule}.cmsmasters_comments a:before,
	{$rule}.widget_categories ul li:before, 
	{$rule}.widget_archive ul li:before,
	{$rule}.cmsmasters_post_cont_info .cmsmasters_post_tags a:hover,
	{$rule}.cmsmasters_post_cont_info .cmsmasters_post_author a:hover,
	{$rule}.cmsmasters_post_cont_info .cmsmasters_post_category a:hover,
	{$rule}.cmsmasters_slider_project .cmsmasters_slider_project_cont_info a:hover,
	{$rule}.cmsmasters_slider_post .cmsmasters_slider_post_cont_info a:hover,
	{$rule}.cmsmasters_attach_img .cmsmasters_attach_img_edit a:hover, 
	{$rule}.cmsmasters_attach_img .cmsmasters_attach_img_meta a:hover,
	{$rule}.cmsmasters_social_icon,
	{$rule}.cmsmasters_archive_item_type,
	{$rule}#wp-calendar caption:before,
	{$rule}.cmsmasters_quote_subtitle_wrap,
	{$rule}.cmsmasters_project_subtitle,
	{$rule}.cmsmasters_icon_wrap a:hover .cmsmasters_simple_icon,
	{$rule}.cmsmasters_quotes_slider_type_center .cmsmasters_prev_arrow, 
	{$rule}.cmsmasters_quotes_slider_type_center .cmsmasters_next_arrow, 
	{$rule}.cmsmasters_breadcrumbs_inner a:hover,
	{$rule}.cmsmasters_project_read_more, 
	{$rule}.cmsmasters_slider_post_read_more, 
	{$rule}.cmsmasters_post_default .cmsmasters_post_cont > a:hover .published, 
	{$rule}.cmsmasters_slider_project .cmsmasters_slider_post_read_more, 
	{$rule}.cmsmasters_quote_subtitle_wrap .cmsmasters_quote_subtitle,
	{$rule}.cmsmasters_quotes_slider_type_box .cmsmasters_quote_header:before,
	{$rule}.cmsmasters_open_profile .cmsmasters_profile_header .cmsmasters_profile_subtitle,
	{$rule}.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner .cmsmasters_counter_title, 
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quotes_list:after,
	{$rule}.cmsmasters_profile .cmsmasters_profile_subtitle,
	{$rule}.subpage_nav > span {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_hover']) . "
	}
	
	{$rule}input::-webkit-input-placeholder {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_hover']) . "
	}
	
	{$rule}input:-moz-placeholder {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_hover']) . "
	}
	/* Finish Highlight Color */
	
	
	/* Start Headings Color */
	" . (($scheme == 'default') ? "#slide_top," : '') . "
	{$rule}h1,
	{$rule}h2,
	{$rule}h3,
	{$rule}h4,
	{$rule}h5,
	{$rule}h6,
	{$rule}h1 a,
	{$rule}h2 a,
	{$rule}h3 a,
	{$rule}h4 a,
	{$rule}h5 a,
	{$rule}h6 a,
	{$rule}.widget_nav_menu ul li a,
	{$rule}#wp-calendar th,
	{$rule}.widget_rss ul li .rsswidget:hover,
	{$rule}.cmsmasters_widget_project_cont_info .cmsmasters_slider_project_category a, 
	{$rule}.widget_custom_twitter_entries .tweet_time,
	{$rule}.cmsmasters_twitter_wrap .cmsmasters_twitter_item_content,
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quote_content,
	{$rule}.cmsmasters_quotes_slider_type_center .cmsmasters_quote_content,
	{$rule}.cmsmasters_quotes_slider_type_box .cmsmasters_quote_content,
	{$rule}.cmsmasters_toggles .cmsmasters_toggle_title a,
	{$rule}.cmsmasters_tabs .cmsmasters_tabs_list_item a,
	{$rule}.cmsmasters_archive_item_info a,
	{$rule}.cmsmasters_open_profile .profile_details_item_title, 
	{$rule}.cmsmasters_open_profile .profile_features_item_title,
	{$rule}.profile_details a, 
	{$rule}.profile_features a,
	{$rule}.post.cmsmasters_post_puzzle .cmsmasters_post_footer > span a,
	{$rule}.cmsmasters_items_filter_wrap .cmsmasters_items_sort_but:before,
	{$rule}.search_bar_wrap .search_button button:hover:before,
	{$rule}fieldset legend,
	{$rule}blockquote,
	{$rule}q,
	{$rule}blockquote footer,
	{$rule}table caption,
	{$rule}.img_placeholder_small, 
	{$rule}.cmsmasters_table tfoot td, 
	{$rule}.cmsmasters_post_read_more:hover,
	{$rule}.cmsmasters_slider_post_read_more:hover,
	{$rule}.cmsmasters_wrap_pagination ul li .page-numbers,
	{$rule}.post_nav a, 
	{$rule}.cmsmasters_prev_arrow, 
	{$rule}.cmsmasters_next_arrow,
	{$rule}.cmsmasters_quotes_slider_type_center .cmsmasters_quote_title, 
	{$rule}.cmsmasters_open_project .cmsmasters_project_header .cmsmasters_project_title,
	{$rule}.cmsmasters_open_post .cmsmasters_post_header .cmsmasters_post_title,
	{$rule}.cmsmasters_stats.stats_mode_bars.stats_type_horizontal .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner .cmsmasters_stat_title,
	{$rule}.cmsmasters_stats.stats_mode_bars.stats_type_vertical .cmsmasters_stat_wrap .cmsmasters_stat_title,
	{$rule}.cmsmasters_stats.stats_mode_circles .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner .cmsmasters_stat_counter,
	{$rule}.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner .cmsmasters_counter_counter_wrap, 
	{$rule}.cmsmasters_open_project .cmsmasters_project_category a,
	{$rule}.cmsmasters_post_default .cmsmasters_post_sticky,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li > a,
	{$rule}.cmsmasters_items_filter_wrap .cmsmasters_items_sort_but, 
	{$rule}.cmsmasters_items_filter_wrap .cmsmasters_items_filter_list li a, 
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li > ul > li > a,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li > ul > li > ul li a:before,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap_category > li > a,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap_category > li > ul li a:before,
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap_archive > li a:before {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.cmsmasters_project_puzzle .project_outer:hover .project_inner {
		background-color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['hotel-lux' . '_' . $scheme . '_heading']) . ", 0.7);
	}
	
	" . (($scheme == 'default') ? ".headline_outer," : '') . "
	{$rule}.cmsmasters_hover_slider .cmsmasters_hover_slider_thumbs a:before,
	{$rule}.cmsmasters_button:hover, 
	{$rule}.button:hover, 
	{$rule}input[type=submit]:hover, 
	{$rule}input[type=button]:hover, 
	{$rule}button:hover,
	{$rule}form .formError .formErrorContent {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.cmsmasters_header_search_form {
		background-color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['hotel-lux' . '_' . $scheme . '_heading']) . ", 0.95);
	}
	
	{$rule}.header_mid .search_opened .search_bar_wrap {
		background-color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['hotel-lux' . '_' . $scheme . '_heading']) . ", 0.95);
	}
	
	{$rule}.cmsmasters_profile .cmsmasters_img_rollover_wrap:hover .cmsmasters_img_rollover {
		background-color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['hotel-lux' . '_' . $scheme . '_heading']) . ", 0.5);
	}
	
	{$rule}.post.cmsmasters_post_puzzle .preloader:after {
		background-color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['hotel-lux' . '_' . $scheme . '_heading']) . ", 0.6);
	}
	/* Finish Headings Color */
	
	
	/* Start Main Background Color */
	" . (($scheme == 'default') ? "#slide_top:hover," : '') . "
	{$rule}.custom_subscribe .wysija-submit-field,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_bg .cmsmasters_icon_list_icon:before,
	{$rule}.cmsmasters_notice .notice_close:hover,
	{$rule}.cmsmasters_content_slider .owl-buttons > div:hover > span span,
	{$rule}.pricing_best .cmsmasters_price_wrap *,
	{$rule}.cmsmasters_profile .cmsmasters_img_rollover_wrap .cmsmasters_open_post_link,
	{$rule}.cmsmasters_project_puzzle .project_inner,
	{$rule}.cmsmasters_project_puzzle .project_inner a,
	{$rule}.cmsmasters_project_puzzle .project_inner a:hover,
	{$rule}.cmsmasters_project_puzzle .project_inner .cmsmasters_likes a:before, 
	{$rule}.cmsmasters_project_puzzle .project_inner .cmsmasters_comments a:before,
	{$rule}.post.cmsmasters_post_puzzle:hover .puzzle_post_content_wrap,
	{$rule}.post.cmsmasters_post_puzzle:hover .puzzle_post_content_wrap a,
	{$rule}.post.cmsmasters_post_puzzle:hover .puzzle_post_content_wrap .cmsmasters_post_comments span,
	{$rule}.post.cmsmasters_post_puzzle:hover .puzzle_post_content_wrap .cmsmasters_post_footer > span a:hover,
	{$rule}.post.cmsmasters_post_puzzle:hover .puzzle_post_content_wrap .cmsmasters_post_footer_info a:before,
	{$rule}.cmsmasters_button, 
	{$rule}.button, 
	{$rule}input[type=submit], 
	{$rule}input[type=button], 
	{$rule}button,
	{$rule}.cmsmasters_button:hover, 
	{$rule}.button:hover, 
	{$rule}input[type=submit]:hover, 
	{$rule}input[type=button]:hover, 
	{$rule}button:hover,
	{$rule}mark,
	{$rule}.headline_text,
	{$rule}.headline_text *,
	{$rule}.cmsmasters_prev_arrow:hover, 
	{$rule}.cmsmasters_next_arrow:hover, 
	{$rule}.cmsmasters_breadcrumbs a,
	{$rule}.cmsmasters_breadcrumbs_inner,
	{$rule}.cmsmasters_header_search_form input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]),
	{$rule}.blog .post.format-gallery .cmsmasters_owl_slider .cmsmasters_prev_arrow:hover span, 
	{$rule}.blog .post.format-gallery .cmsmasters_owl_slider .cmsmasters_next_arrow:hover span,
	{$rule}.cmsmasters_table thead th,
	{$rule}form .formError .formErrorContent,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_left_top:before,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_left:before,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_top:before,
	{$rule}#tribe-events-sub-nav a:hover .cmsmasters_next_arrow span,
	{$rule}#tribe-events-sub-nav a:hover .cmsmasters_prev_arrow span  {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_breadcrumbs .cmsmasters_breadcrumbs_inner > span:not([class]),
	{$rule}.cmsmasters_breadcrumbs .cmsmasters_breadcrumbs_inner a:hover {
		color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . ", 0.8);
	}
	
	{$rule}.wp-caption,
	{$rule}.cmsmasters_notice .notice_close,
	{$rule}.cmsmasters_content_slider .owl-page,
	{$rule}.cmsmasters_toggles .cmsmasters_toggle_title a,
	{$rule}.post.cmsmasters_post_puzzle .puzzle_post_content_wrapper .cmsmasters_post_footer,
	{$rule}.post.cmsmasters_post_puzzle .cmsmasters_post_cont,
	{$rule}.cmsmasters_post_timeline .cmsmasters_post_date,
	{$rule}.cmsmasters_wrap_pagination ul li .page-numbers,
	" . (($scheme == 'default') ? "body," : '') . "
	" . (($scheme != 'default') ? ".cmsmasters_color_scheme_{$scheme}," : '') . "
	" . (($scheme == 'default') ? ".middle_inner," : '') . "
	{$rule}.search_wrap .search_bar_wrap .search_field:before, 
	{$rule}.search_wrap .search_bar_wrap .search_field:after, 
	{$rule}.search_wrap .search_icon_close:before, 
	{$rule}.search_wrap .search_icon_close:after, 
	{$rule}.cmsmasters_table, 
	{$rule}.cmsmasters_prev_arrow, 
	{$rule}.cmsmasters_next_arrow, 
	{$rule}.cmsmasters_img.with_caption, 
	{$rule}.cmsmasters_tabs.tabs_mode_tour .cmsmasters_tabs_list_item.current_tab, 
	{$rule}.cmsmasters_header_search_form .cmsmasters_header_search_form_close:before,
	{$rule}.cmsmasters_header_search_form .cmsmasters_header_search_form_close:after,
	{$rule}.cmsmasters_header_search_form .cmsmasters_header_search_form_field:before,
	{$rule}.cmsmasters_header_search_form .cmsmasters_header_search_form_field:after,
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quotes_list:after,
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=checkbox] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsmasters-form-builder .check_parent input[type=checkbox] + label:before, 
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=radio] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsmasters-form-builder .check_parent input[type=radio] + label:before {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.post.cmsmasters_post_puzzle .puzzle_post_content_wrapper:before {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.search_wrap .search_bar_wrap .search_field input::-webkit-input-placeholder {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.search_wrap .search_bar_wrap .search_field input:-moz-placeholder {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
		
	{$rule}.cmsmasters_header_search_form input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range])::-webkit-input-placeholder {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_header_search_form input:not([type=button]):not([type=checkbox]):not([type=file]):not([type=hidden]):not([type=image]):not([type=radio]):not([type=reset]):not([type=submit]):not([type=color]):not([type=range]):-moz-placeholder {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_slider_project .cmsmasters_img_rollover_wrap:hover .cmsmasters_img_rollover,
	{$rule}.cmsmasters_project_grid .cmsmasters_img_rollover_wrap:hover .cmsmasters_img_rollover {
		background-color:rgba(" . cmsmasters_color2rgb($cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . ", 0.98);
	}
	
	{$rule}#header .search_wrap .search_bar_wrap .search_field input {
		background:none;
	}
	/* Finish Main Background Color */
	
	
	/* Start Alternate Background Color */
	{$rule}.cmsmasters_dropcap.type2,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_icon .cmsmasters_icon_list_icon_wrap, 
	{$rule}.cmsmasters_counters .cmsmasters_counter_wrap .cmsmasters_counter .cmsmasters_counter_inner:before {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_alternate']) . "
	}
	
	" . (($scheme == 'default') ? "#slide_top," : '') . "
	{$rule}.post.cmsmasters_post_puzzle .preloader[class^=\"cmsmasters_theme_icon_\"], 
	{$rule}.post.cmsmasters_post_puzzle .preloader[class*=\" cmsmasters_theme_icon_\"],
	{$rule}fieldset,
	{$rule}fieldset legend,
	{$rule}.img_placeholder, 
	{$rule}.img_placeholder_small, 
	{$rule}.cmsmasters_featured_block,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_top,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_left,
	{$rule}input:not([type=submit]):not([type=button]):not([type=radio]):not([type=checkbox]), 
	{$rule}textarea, 
	{$rule}option, 
	{$rule}.cmsmasters_slider_project .cmsmasters_slider_project_inner,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_border .cmsmasters_icon_list_icon, 
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_icon .cmsmasters_icon_list_icon,
	{$rule}.gallery-item .gallery-icon,
	{$rule}.gallery-item .gallery-caption {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_alternate']) . "
	}
	/* Finish Alternate Background Color */
	
	
	/* Start Borders Color */
	
	" . (($scheme == 'footer') ? ".cmsmasters_footer_default .footer_nav > li:after," : '') . "
	{$rule}.cmsmasters_slider_project:before, 
	{$rule}.cmsmasters_icon_list_items.cmsmasters_icon_list_type_block .cmsmasters_icon_list_item:before, 
	{$rule}.cmsmasters_stats.stats_mode_bars.stats_type_horizontal .cmsmasters_stat_wrap:before, 
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quotes_vert:before, 
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quotes_vert:after, 
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quotes_vert span, 
	{$rule}.blog.timeline:before, 
	{$rule}.widget_categories ul li:before, 
	{$rule}.widget_archive ul li:before, 
	{$rule}.widget_meta ul li:before, 
	{$rule}.widget_text ul li:before, 
	{$rule}.owl-pagination .owl-page, 
	{$rule}.cmsmasters_sitemap_wrap .cmsmasters_sitemap > li:before {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_border']) . "
	}
	
	" . (($scheme == 'default') ? "#slide_top," : '') . "
	{$rule}.sidebar,
	{$rule}.wp-caption,
	{$rule}.widget_nav_menu ul li a,
	{$rule}.widget_rss ul li, 
	{$rule}.cmsmasters_widget_project_cont_info, 
	{$rule}.sidebar .widget, 
	{$rule}.border_list li, 
	{$rule}.widget_pages li, 
	{$rule}.widget_categories li, 
	{$rule}.widget_archive li, 
	{$rule}.widget_meta li, 
	{$rule}.widget_text li, 
	{$rule}.widget_recent_comments li, 
	{$rule}.widget_recent_entries li,
	{$rule}.cmsmasters_slider_post .cmsmasters_slider_post_inner, 
	{$rule}.cmsmasters_notice .notice_close, 
	{$rule}.cmsmasters_pricing_item, 
	{$rule}.cmsmasters_pricing_table .cmsmasters_price_wrap, 
	{$rule}.cmsmasters_pricing_table .feature_list li, 
	{$rule}.cmsmasters_stats.stats_mode_bars.stats_type_vertical .cmsmasters_stat_wrap .cmsmasters_stat_title, 
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quotes_list:after, 
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quotes_list, 
	{$rule}.cmsmasters_quotes_grid .cmsmasters_quote,
	{$rule}.cmsmasters_quotes_slider_type_box .cmsmasters_quote_header, 
	{$rule}.toggles_mode_accordion .cmsmasters_toggle, 
	{$rule}.cmsmasters_tabs .cmsmasters_tabs_wrap, 
	{$rule}.cmsmasters_toggles .cmsmasters_toggle_title a, 
	{$rule}.cmsmasters_archive_item_info, 
	{$rule}.post_nav, 
	{$rule}.profile_details_item, 
	{$rule}.profile_features_item,
	{$rule}.post.cmsmasters_post_puzzle .puzzle_post_content_wrapper .cmsmasters_post_footer,
	{$rule}.cmsmasters_open_post .cmsmasters_post_cont_info,
	{$rule}.cmsmasters_post_timeline .cmsmasters_post_cont_info,
	{$rule}.cmsmasters_post_masonry .cmsmasters_post_cont_info,
	{$rule}.cmsmasters_post_default .cmsmasters_post_cont_info, 
	{$rule}.cmsmasters_attach_img .cmsmasters_attach_img_info, 
	{$rule}input:not([type=submit]):not([type=button]):not([type=radio]):not([type=checkbox]),
	{$rule}textarea,
	{$rule}select,
	{$rule}option,
	{$rule}hr,
	{$rule}.img_placeholder, 
	{$rule}.img_placeholder_small, 
	{$rule}.project_details_item, 
	{$rule}.project_features_item,
	{$rule}.cmsmasters_button, 
	{$rule}.button, 
	{$rule}input[type=submit], 
	{$rule}input[type=button], 
	{$rule}button,
	{$rule}.footer_in_inner,
	{$rule}.share_posts,
	{$rule}.about_author,
	{$rule}.post_comments,
	{$rule}.comment-respond,
	{$rule}.cmsmasters_comment_item,
	{$rule}.cmsmasters_single_slider,
	{$rule}.cmsmasters_pings_list,
	{$rule}.pingslist .pingback,
	{$rule}.cmsmasters_wrap_pagination ul li .page-numbers,
	{$rule}.cmsmasters_prev_arrow, 
	{$rule}.cmsmasters_next_arrow, 
	{$rule}.cmsmasters_post_default,
	{$rule}table td,
	{$rule}table th,
	{$rule}.bottom_bg,
	{$rule}.cmsmasters_table tbody td,
	{$rule}.cmsmasters_table tbody th,
	{$rule}.cmsmasters_table tfoot td,
	{$rule}.cmsmasters_table tfoot th,
	{$rule}.cmsmasters_divider,
	{$rule}.cmsmasters_widget_divider,
	{$rule}.cmsmasters_img.with_caption,
	{$rule}.cmsmasters_tabs.tabs_mode_tour .cmsmasters_tabs_list_item, 
	{$rule}.cmsmasters_tabs.tabs_mode_tab .cmsmasters_tabs_list_item,
	{$rule}.cmsmasters_icon_wrap .cmsmasters_simple_icon, 
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_top,
	{$rule}.cmsmasters_icon_box.cmsmasters_icon_box_left,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_icon_list_type_block .cmsmasters_icon_list_item,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_bg .cmsmasters_icon_list_icon:after,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_border .cmsmasters_icon_list_icon:after,
	{$rule}.cmsmasters_icon_list_items.cmsmasters_color_type_icon .cmsmasters_icon_list_icon:after, 
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=checkbox] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsmasters-form-builder .check_parent input[type=checkbox] + label:before, 
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=radio] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsmasters-form-builder .check_parent input[type=radio] + label:before,
	{$rule}.owl-pagination .owl-page:before,
	{$rule}.owl-pagination .owl-page {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.cmsmasters_stats.stats_mode_circles .cmsmasters_stat_wrap .cmsmasters_stat .cmsmasters_stat_inner, 
	{$rule}.post.cmsmasters_post_puzzle .puzzle_post_content_wrapper {
		-webkit-box-shadow:inset 0 0 0 1px " . $cmsmasters_option['hotel-lux' . '_' . $scheme . '_border'] . ";
		box-shadow:inset 0 0 0 1px " . $cmsmasters_option['hotel-lux' . '_' . $scheme . '_border'] . ";
	}
	/* Finish Borders Color */
	
	
	/* Start Custom Rules */
	{$rule}::selection {
		" . cmsmasters_color_css('background', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . ";
	}
	
	{$rule}::-moz-selection {
		" . cmsmasters_color_css('background', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	";
	
	
	if ($scheme != 'default') {
		$custom_css .= "
		.cmsmasters_color_scheme_{$scheme}.cmsmasters_row_top_zigzag:before, 
		.cmsmasters_color_scheme_{$scheme}.cmsmasters_row_bot_zigzag:after {
			background-image: -webkit-linear-gradient(135deg, " . $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg'] . " 25%, transparent 25%), 
					-webkit-linear-gradient(45deg, " . $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg'] . " 25%, transparent 25%);
			background-image: -moz-linear-gradient(135deg, " . $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg'] . " 25%, transparent 25%), 
					-moz-linear-gradient(45deg, " . $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg'] . " 25%, transparent 25%);
			background-image: -ms-linear-gradient(135deg, " . $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg'] . " 25%, transparent 25%), 
					-ms-linear-gradient(45deg, " . $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg'] . " 25%, transparent 25%);
			background-image: -o-linear-gradient(135deg, " . $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg'] . " 25%, transparent 25%), 
					-o-linear-gradient(45deg, " . $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg'] . " 25%, transparent 25%);
			background-image: linear-gradient(315deg, " . $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg'] . " 25%, transparent 25%), 
					linear-gradient(45deg, " . $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg'] . " 25%, transparent 25%);
		}
		";
	}
	
	
	$custom_css .= "
	/* Finish Custom Rules */

/***************** Finish {$title} Color Scheme Rules ******************/


/***************** Start {$title} Button Color Scheme Rules ******************/
	
	{$rule}.cmsmasters_button.cmsmasters_but_bg_hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_bg_hover:hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	
	{$rule}.cmsmasters_button.cmsmasters_but_bd_underline {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_bd_underline:hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
	}
	
	
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_left, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_right, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_top, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_bottom, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_vert, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_hor, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_diag {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_left:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_right:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_top:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_bottom:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_vert:hover, 
	{$rule}.cmsmasters_button.cm.sms_but_bg_expand_hor:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_diag:hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_left:after, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_right:after, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_top:after, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_slide_bottom:after, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_vert:after, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_hor:after, 
	{$rule}.cmsmasters_button.cmsmasters_but_bg_expand_diag:after {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
	}
	
	
	{$rule}.cmsmasters_button.cmsmasters_but_shadow {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_shadow:hover {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_dark_bg, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_light_bg, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_divider {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_dark_bg:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_light_bg:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_divider:hover {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_divider:after {
		" . cmsmasters_color_css('border-right-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_inverse {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_inverse:before {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_inverse:after {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_inverse:hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_inverse:hover:before {
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_inverse:hover:after {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
	}
	
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_slide_left, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_slide_right {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_slide_left:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_slide_right:hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_left, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_right, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_top, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_bottom {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_left:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_right:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_top:hover, 
	{$rule}.cmsmasters_button.cmsmasters_but_icon_hover_slide_bottom:hover {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_link']) . "
		" . cmsmasters_color_css('color', $cmsmasters_option['hotel-lux' . '_' . $scheme . '_bg']) . "
	}

/***************** Finish {$title} Button Color Scheme Rules ******************/


";
	}
	
	
	return apply_filters('hotel_lux_theme_colors_primary_filter', $custom_css);
}

