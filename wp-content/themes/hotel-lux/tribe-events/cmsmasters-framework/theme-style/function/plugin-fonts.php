<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version 	1.0.0
 * 
 * Tribe Events Fonts Rules
 * Created by CMSMasters
 * 
 */


function hotel_lux_tribe_events_fonts($custom_css) {
	$cmsmasters_option = hotel_lux_get_global_options();
	
	
	$custom_css .= "
/***************** Start Tribe Events Font Styles ******************/

	/* Start Content Font */
	.tribe-events-tooltip,
	.tribe-events-tooltip a,
	.cmsmasters_event_big_week,
	table.tribe-events-calendar tbody td div[id*=tribe-events-daynum-], 
	table.tribe-events-calendar tbody td div[id*=tribe-events-daynum-] a, 
	.tribe-mini-calendar tbody, 
	.tribe-mini-calendar tbody a, 
	.tribe-events-countdown-widget .tribe-countdown-time span, 
	.tribe-this-week-events-widget .tribe-this-week-widget-header-date {
		font-family:" . hotel_lux_get_google_font($cmsmasters_option['hotel-lux' . '_content_font_google_font']) . $cmsmasters_option['hotel-lux' . '_content_font_system_font'] . ";
		font-size:" . $cmsmasters_option['hotel-lux' . '_content_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['hotel-lux' . '_content_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['hotel-lux' . '_content_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['hotel-lux' . '_content_font_font_style'] . ";
	}
	
	.cmsmasters_event_big_week {
		font-size:" . ((int) $cmsmasters_option['hotel-lux' . '_content_font_font_size'] + 2) . "px;
	}
	
	table.tribe-events-calendar tbody td div[id*=tribe-events-daynum-], 
	table.tribe-events-calendar tbody td div[id*=tribe-events-daynum-] a, 
	.tribe-this-week-events-widget .tribe-this-week-widget-header-date {
		font-size:" . ((int) $cmsmasters_option['hotel-lux' . '_content_font_font_size'] - 1) . "px;
	}
	
	.tribe-mini-calendar tbody, 
	.tribe-mini-calendar tbody a, 
	.tribe-mini-calendar thead th, 
	.tribe-events-grid .column.first > span,
	.tribe-events-grid .tribe-week-grid-hours div,
	.tribe-events-tooltip .description, 
	.tribe-events-widget-link a, 
	.tribe-this-week-events-widget .tribe-events-viewmore a {
		font-size:" . ((int) $cmsmasters_option['hotel-lux' . '_content_font_font_size'] - 2) . "px;
		line-height:" . ((int) $cmsmasters_option['hotel-lux' . '_content_font_line_height'] - 6) . "px;
	}
	
	.tribe-events-grid .tribe-week-grid-hours div {
		font-size:" . ((int) $cmsmasters_option['hotel-lux' . '_content_font_font_size'] - 5) . "px;
		line-height:" . ((int) $cmsmasters_option['hotel-lux' . '_content_font_line_height'] - 5) . "px;
	}
	
	/* Finish Content Font */
	
	
	/* Start H1 Font */
	.cmsmasters_event_big_day {
		font-family:" . hotel_lux_get_google_font($cmsmasters_option['hotel-lux' . '_h1_font_google_font']) . $cmsmasters_option['hotel-lux' . '_h1_font_system_font'] . ";
		font-size:" . $cmsmasters_option['hotel-lux' . '_h1_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['hotel-lux' . '_h1_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['hotel-lux' . '_h1_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['hotel-lux' . '_h1_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['hotel-lux' . '_h1_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['hotel-lux' . '_h1_font_text_decoration'] . ";
	}
	
	.cmsmasters_event_big_day {
		font-size:80px;
		line-height:70px;
	}
	/* Finish H1 Font */
	
	
	/* Start H2 Font */
	.tribe-events-list-event-title, 
	.tribe-events-list-event-title a, 
	.cmsmasters_sidebar.sidebar_layout_11 .tribe-events-adv-list-widget .tribe-events-list-widget-content-wrap .entry-title a,
	.cmsmasters_sidebar.sidebar_layout_11 .tribe-events-list-widget .tribe-events-list-widget-content-wrap .entry-title a,
	.tribe-mobile-day .tribe-mobile-day-date,
	.tribe-events-countdown-widget .tribe-countdown-time {
		font-family:" . hotel_lux_get_google_font($cmsmasters_option['hotel-lux' . '_h2_font_google_font']) . $cmsmasters_option['hotel-lux' . '_h2_font_system_font'] . ";
		font-size:" . $cmsmasters_option['hotel-lux' . '_h2_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['hotel-lux' . '_h2_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['hotel-lux' . '_h2_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['hotel-lux' . '_h2_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['hotel-lux' . '_h2_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['hotel-lux' . '_h2_font_text_decoration'] . ";
	}
	
	.tribe-events-list-event-title, 
	.tribe-events-list-event-title a {
		font-size:" . ((int) $cmsmasters_option['hotel-lux' . '_h2_font_font_size'] - 6) . "px;
		line-height:" . ((int) $cmsmasters_option['hotel-lux' . '_h2_font_line_height'] - 6) . "px;
	}
	
	.tribe-events-countdown-widget .tribe-countdown-time {
		font-size:36px;
		line-height:40px;
	}
	
	.cmsmasters_sidebar.sidebar_layout_11 .tribe-events-countdown-widget .tribe-countdown-time {
		font-size:48px;
		line-height:48px;
	}
	
	@media only screen and (min-width: 1440px) {
		.cmsmasters_sidebar.sidebar_layout_11 .tribe-events-countdown-widget .tribe-countdown-time {
			font-size:56px;
			line-height:56px;
		}
	}
	/* Finish H2 Font */
	
	
	/* Start H3 Font */
	.tribe-events-related-events-title,
	.tribe-events-page-title {
		font-family:" . hotel_lux_get_google_font($cmsmasters_option['hotel-lux' . '_h3_font_google_font']) . $cmsmasters_option['hotel-lux' . '_h3_font_system_font'] . ";
		font-size:" . $cmsmasters_option['hotel-lux' . '_h3_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['hotel-lux' . '_h3_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['hotel-lux' . '_h3_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['hotel-lux' . '_h3_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['hotel-lux' . '_h3_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['hotel-lux' . '_h3_font_text_decoration'] . ";
	}
	
	.tribe-events-related-events-title {
		font-size:" . ((int) $cmsmasters_option['hotel-lux' . '_h3_font_font_size'] - 2) . "px;
	}
	
	.tribe-events-photo .tribe-events-list-event-title,
	.tribe-events-photo .tribe-events-list-event-title a {
		font-size:" . ((int) $cmsmasters_option['hotel-lux' . '_h3_font_font_size'] - 2) . "px;
		line-height:" . ((int) $cmsmasters_option['hotel-lux' . '_h3_font_line_height'] - 2) . "px;
	}
	/* Finish H3 Font */
	
	
	/* Start H4 Font */
	.cmsmasters_sidebar.sidebar_layout_11 .tribe-events-adv-list-widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info,
	.cmsmasters_sidebar.sidebar_layout_11 .tribe-events-adv-list-widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info a,
	.cmsmasters_sidebar.sidebar_layout_11 .tribe-events-list-widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info,
	.cmsmasters_sidebar.sidebar_layout_11 .tribe-events-list-widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info a,
	.cmsmasters_sidebar.sidebar_layout_11 .tribe-events-countdown-widget .tribe-countdown-text a,
	.tribe-events-venue-widget .tribe-venue-widget-venue-name a {
		font-family:" . hotel_lux_get_google_font($cmsmasters_option['hotel-lux' . '_h4_font_google_font']) . $cmsmasters_option['hotel-lux' . '_h4_font_system_font'] . ";
		font-size:" . $cmsmasters_option['hotel-lux' . '_h4_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['hotel-lux' . '_h4_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['hotel-lux' . '_h4_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['hotel-lux' . '_h4_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['hotel-lux' . '_h4_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['hotel-lux' . '_h4_font_text_decoration'] . ";
	}
	
	.cmsmasters_sidebar.sidebar_layout_11 .tribe-events-adv-list-widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info,
	.cmsmasters_sidebar.sidebar_layout_11 .tribe-events-adv-list-widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info a,
	.cmsmasters_sidebar.sidebar_layout_11 .tribe-events-list-widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info,
	.cmsmasters_sidebar.sidebar_layout_11 .tribe-events-list-widget .tribe-events-list-widget-content-wrap .cmsmasters_widget_event_info a {
		font-size:" . ((int) $cmsmasters_option['hotel-lux' . '_h4_font_font_size'] - 2) . "px;
	}
	/* Finish H4 Font */
	
	
	/* Start H5 Font */
	.tribe-events-list .cmsmasters_featured_event, 
	.tribe-events-photo .tribe-event-featured .cmsmasters_featured_event, 
	.tribe-events-venue-widget .vcalendar .entry-title, 
	.tribe-events-venue-widget .vcalendar .entry-title a, 
	.tribe-events-countdown-widget .tribe-countdown-text, 
	.tribe-events-countdown-widget .tribe-countdown-text a,
	.tribe_mini_calendar_widget .tribe-mini-calendar-list-wrapper .entry-title, 
	.tribe_mini_calendar_widget .tribe-mini-calendar-list-wrapper .entry-title a,
	.tribe-mini-calendar [id*=tribe-mini-calendar-month], 
	.tribe-events-grid .tribe-week-event .vevent .entry-title a,
	.tribe-events-list .tribe-events-day-time-slot > h5, 
	.tribe-events-tooltip .entry-title,
	.cmsmasters_event_big_month,
	.tribe-events-list .tribe-events-list-separator-month,
	.tribe-bar-filters-inner > div label, 
	table.tribe-events-calendar tbody td .tribe-events-month-event-title, 
	table.tribe-events-calendar tbody td .tribe-events-month-event-title a, 
	.tribe-mobile-day .tribe-events-read-more {
		font-family:" . hotel_lux_get_google_font($cmsmasters_option['hotel-lux' . '_h5_font_google_font']) . $cmsmasters_option['hotel-lux' . '_h5_font_system_font'] . ";
		font-size:" . $cmsmasters_option['hotel-lux' . '_h5_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['hotel-lux' . '_h5_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['hotel-lux' . '_h5_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['hotel-lux' . '_h5_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['hotel-lux' . '_h5_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['hotel-lux' . '_h5_font_text_decoration'] . ";
	}
	
	.tribe-this-week-events-widget .tribe-this-week-event .entry-title,
	.tribe-this-week-events-widget .tribe-this-week-event .entry-title a,
	.tribe-events-venue-widget .vcalendar .entry-title, 
	.tribe-events-venue-widget .vcalendar .entry-title a, 
	.tribe_mini_calendar_widget .tribe-mini-calendar-list-wrapper .entry-title, 
	.tribe_mini_calendar_widget .tribe-mini-calendar-list-wrapper .entry-title a,
	.widget .vcalendar .entry-title, 
	.widget .vcalendar .entry-title a, 
	.tribe-mini-calendar-list-wrapper .entry-title,
	.tribe-mini-calendar-list-wrapper .entry-title a,
	.tribe-events-list .tribe-events-day-time-slot > h5, 
	.cmsmasters_event_big_month,
	.tribe-events-list .tribe-events-list-separator-month {
		font-size:" . ((int) $cmsmasters_option['hotel-lux' . '_h5_font_font_size'] - 2) . "px;
		line-height:" . ((int) $cmsmasters_option['hotel-lux' . '_h5_font_line_height'] - 4) . "px;
	}
	
	.tribe-events-photo .tribe-event-featured .cmsmasters_featured_event {
		font-size:" . ((int) $cmsmasters_option['hotel-lux' . '_h5_font_font_size'] - 5) . "px;
		line-height:" . ((int) $cmsmasters_option['hotel-lux' . '_h5_font_line_height'] - 5) . "px;
	}
	
	.tribe-events-list .cmsmasters_featured_event {	
		font-size:" . ((int) $cmsmasters_option['hotel-lux' . '_h5_font_font_size'] - 4) . "px;
		line-height:" . ((int) $cmsmasters_option['hotel-lux' . '_h5_font_line_height'] - 4) . "px;
	}
	
	.tribe-mini-calendar [id*=tribe-mini-calendar-month], 
	.tribe-events-grid .tribe-week-event .vevent .entry-title a,
	.tribe-events-tooltip .entry-title,
	table.tribe-events-calendar tbody td .tribe-events-month-event-title, 
	table.tribe-events-calendar tbody td .tribe-events-month-event-title a {
		font-size:" . ((int) $cmsmasters_option['hotel-lux' . '_h5_font_font_size'] - 4) . "px;
		line-height:" . ((int) $cmsmasters_option['hotel-lux' . '_h5_font_line_height'] - 6) . "px;
	}
	/* Finish H5 Font */
	
	
	/* Start H6 Font */
	.tribe-this-week-events-widget .tribe-this-week-event .duration, 
	.tribe-this-week-events-widget .tribe-this-week-event .tribe-venue,
	.tribe-this-week-events-widget .tribe-this-week-event .tribe-venue a,
	.tribe-this-week-events-widget .tribe-events-page-title, 
	.tribe-events-countdown-widget .tribe-countdown-time .tribe-countdown-under,
	.widget .vcalendar .cmsmasters_widget_event_info, 
	.widget .vcalendar .cmsmasters_widget_event_info a, 
	.tribe-mini-calendar-list-wrapper .cmsmasters_widget_event_info, 
	.tribe-mini-calendar-list-wrapper .cmsmasters_widget_event_info a, 
	.tribe-events-organizer .cmsmasters_events_organizer_header_right a, 
	#tribe-events-content > .tribe-events-button, 
	.tribe-events-tooltip .duration .published,
	table.tribe-events-calendar tbody td .tribe-events-viewmore a,
	.cmsmasters_single_event_meta .cmsmasters_event_meta_info_item,  
	.cmsmasters_single_event_meta .cmsmasters_event_meta_info_item a, 
	.cmsmasters_single_event_meta .cmsmasters_event_meta_info_item .published,
	.cmsmasters_single_event .tribe-events-cost, 
	.cmsmasters_single_event .cmsmasters_single_event_header_right a, 
	.tribe-events-list .tribe-events-event-meta .published, 
	.tribe-events-list .tribe-events-event-meta .published a, 
	.tribe-events-list .tribe-events-event-meta .tribe-events-address,
	.tribe-events-list .tribe-events-event-cost, 
	.tribe-events-list .tribe-events-event-meta,  
	.tribe-events-list .tribe-events-event-meta a, 
	.tribe-events-photo .tribe-events-event-meta, 
	.tribe-events-photo .tribe-events-event-meta a, 
	.cmsmasters_single_event .tribe-events-schedule, 
	.cmsmasters_single_event .tribe-events-schedule a, 
	.tribe-events-venue .tribe-events-event-meta, 
	.tribe-events-venue .tribe-events-event-meta a, 
	.tribe-events-organizer .tribe-events-event-meta, 
	.tribe-events-organizer .tribe-events-event-meta a, 
	.tribe-events-venue .cmsmasters_events_venue_header_right a, 
	.tribe_mini_calendar_widget .tribe-mini-calendar-list-wrapper .cmsmasters_widget_event_info, 
	.tribe_mini_calendar_widget .tribe-mini-calendar-list-wrapper .cmsmasters_widget_event_info a, 
	.tribe-events-venue-widget .vcalendar .cmsmasters_widget_event_info, 
	.tribe-events-venue-widget .vcalendar .cmsmasters_widget_event_info a, 
	.tribe-mobile-day .tribe-events-event-schedule-details, 
	.tribe-mobile-day .tribe-event-schedule-details {
		font-family:" . hotel_lux_get_google_font($cmsmasters_option['hotel-lux' . '_h6_font_google_font']) . $cmsmasters_option['hotel-lux' . '_h6_font_system_font'] . ";
		font-size:" . $cmsmasters_option['hotel-lux' . '_h6_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['hotel-lux' . '_h6_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['hotel-lux' . '_h6_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['hotel-lux' . '_h6_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['hotel-lux' . '_h6_font_text_transform'] . ";
		text-decoration:" . $cmsmasters_option['hotel-lux' . '_h6_font_text_decoration'] . ";
	}
	
	.tribe-events-organizer .tribe-events-event-meta, 
	.tribe-events-organizer .tribe-events-event-meta a, 
	.tribe-events-venue .tribe-events-event-meta, 
	.tribe-events-venue .tribe-events-event-meta a, 
	.cmsmasters_single_event .tribe-events-cost, 
	.cmsmasters_single_event .tribe-events-schedule, 
	.cmsmasters_single_event .tribe-events-schedule a, 
	.tribe-events-list .tribe-events-event-meta .published, 
	.tribe-events-list .tribe-events-event-meta .published a, 
	.tribe-events-list .tribe-events-event-meta .tribe-events-address, 
	.tribe-events-list .tribe-events-event-meta, 
	.tribe-events-list .tribe-events-event-meta a, 
	.tribe-events-list .tribe-events-event-cost {
		font-size:" . ((int) $cmsmasters_option['hotel-lux' . '_h6_font_font_size'] + 2) . "px;
	}
	
	.tribe-this-week-events-widget .tribe-this-week-event .duration, 
	.tribe-this-week-events-widget .tribe-this-week-event .tribe-venue,
	.tribe-this-week-events-widget .tribe-this-week-event .tribe-venue a,
	.tribe-events-countdown-widget .tribe-countdown-time .tribe-countdown-under,
	.tribe_mini_calendar_widget .tribe-mini-calendar-list-wrapper .cmsmasters_widget_event_info, 
	.tribe_mini_calendar_widget .tribe-mini-calendar-list-wrapper .cmsmasters_widget_event_info a, 
	.tribe-mini-calendar-list-wrapper .cmsmasters_widget_event_info, 
	.tribe-mini-calendar-list-wrapper .cmsmasters_widget_event_info a, 
	.widget .vcalendar .cmsmasters_widget_event_info, 
	.widget .vcalendar .cmsmasters_widget_event_info a, 
	.tribe-mini-calendar-list-wrapper .cmsmasters_widget_event_info, 
	.tribe-mini-calendar-list-wrapper .cmsmasters_widget_event_info a, 
	.tribe-events-tooltip .duration .published,
	table.tribe-events-calendar tbody td .tribe-events-viewmore a,
	ul.tribe-related-events .tribe-related-event-info .published {
		font-size:" . ((int) $cmsmasters_option['hotel-lux' . '_h6_font_font_size'] - 2) . "px;
		line-height:" . ((int) $cmsmasters_option['hotel-lux' . '_h6_font_line_height'] - 6) . "px;
	}
	/* Finish H6 Font */
	
	
	/* Start Button Font */
	.cmsmasters_sidebar.sidebar_layout_11 .tribe-events-countdown-widget .tribe-countdown-time .tribe-countdown-under,
	.tribe-events-grid .tribe-grid-header span,
	table.tribe-events-calendar thead th, 
	#tribe-bar-views .tribe-bar-views-list li, 
	#tribe-bar-views .tribe-bar-views-list li a {
		font-family:" . hotel_lux_get_google_font($cmsmasters_option['hotel-lux' . '_button_font_google_font']) . $cmsmasters_option['hotel-lux' . '_button_font_system_font'] . ";
		font-size:" . $cmsmasters_option['hotel-lux' . '_button_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['hotel-lux' . '_button_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['hotel-lux' . '_button_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['hotel-lux' . '_button_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['hotel-lux' . '_button_font_text_transform'] . ";
	}
	
	.cmsmasters_sidebar.sidebar_layout_11 .tribe-events-countdown-widget .tribe-countdown-time .tribe-countdown-under,
	.tribe-events-grid .tribe-grid-header span,
	table.tribe-events-calendar thead th {
		line-height:20px;
	}
	/* Finish Button Font */
	
	
	/* Start Small Text Font */
	
	.cmsmasters_event_month,
	.cmsmasters_event_day {
		font-family:" . hotel_lux_get_google_font($cmsmasters_option['hotel-lux' . '_small_font_google_font']) . $cmsmasters_option['hotel-lux' . '_small_font_system_font'] . ";
		font-size:" . $cmsmasters_option['hotel-lux' . '_small_font_font_size'] . "px;
		line-height:" . $cmsmasters_option['hotel-lux' . '_small_font_line_height'] . "px;
		font-weight:" . $cmsmasters_option['hotel-lux' . '_small_font_font_weight'] . ";
		font-style:" . $cmsmasters_option['hotel-lux' . '_small_font_font_style'] . ";
		text-transform:" . $cmsmasters_option['hotel-lux' . '_small_font_text_transform'] . ";
	}
	
	.cmsmasters_event_day {
		font-size:" . ((int) $cmsmasters_option['hotel-lux' . '_small_font_font_size'] + 10) . "px;
		line-height:" . ((int) $cmsmasters_option['hotel-lux' . '_small_font_line_height'] + 10) . "px;
	}
	
	/* Finish Small Text Font */

/***************** Finish Tribe Events Font Styles ******************/

";
	
	
	return $custom_css;
}

add_filter('hotel_lux_theme_fonts_filter', 'hotel_lux_tribe_events_fonts');

