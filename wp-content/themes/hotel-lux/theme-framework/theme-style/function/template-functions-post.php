<?php 
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.0.9
 * 
 * Template Functions for Blog & Post
 * Created by CMSMasters
 * 
 */


/* Get Posts Heading Function */
function hotel_lux_post_heading($cmsmasters_id, $tag = 'h1', $show = true) { 
	$out = '';
	
	
	if (cmsmasters_title($cmsmasters_id, false) != $cmsmasters_id) {
		$out = '<header class="cmsmasters_post_header entry-header">' . 
			'<' . esc_html($tag) . ' class="cmsmasters_post_title entry-title">' . 
				'<a href="' . esc_url(get_permalink()) . '">' . cmsmasters_title($cmsmasters_id, false) . '</a>' . 
			'</' . esc_html($tag) . '>' . 
		'</header>';
	}
	
	
	if ($show) {
		echo wp_kses_post($out);
	} else {
		return wp_kses_post($out);
	}
}



/* Get Posts Heading Without Link Function */
function hotel_lux_post_title_nolink($cmsmasters_id, $tag = 'h1', $show = true) { 
	$out = '';
	
	
	if (cmsmasters_title($cmsmasters_id, false) != $cmsmasters_id) {
		$out = '<header class="cmsmasters_post_header entry-header">' . 
			'<' . esc_html($tag) . ' class="cmsmasters_post_title entry-title">' . 
				esc_html(strip_tags(get_the_title($cmsmasters_id) ? get_the_title($cmsmasters_id) : $cmsmasters_id)) . 
			'</' . esc_html($tag) . '>' . 
		'</header>';
	}
	
	
	if ($show) {
		echo wp_kses_post($out);
	} else {
		return wp_kses_post($out);
	}
}



/* Get Posts Date Function */
function hotel_lux_get_post_date($template_type = 'page', $layout_type = 'default', $show = true) {
	if ($template_type == 'page') {
		if ($layout_type == 'timeline') {
			$out = '<span class="cmsmasters_post_date">' . 
				'<abbr class="published" title="' . esc_attr(get_the_date()) . '">' . 
					'<span class="cmsmasters_post_day">' . esc_html(get_the_date('d')) . '</span>' . 
					'<span class="cmsmasters_post_mon_year">' . esc_html(get_the_date('F, Y')) . '</span>' . 
				'</abbr>' . 
				'<abbr class="dn date updated" title="' . esc_attr(get_the_modified_date()) . '">' . 
					esc_html(get_the_modified_date()) . 
				'</abbr>' . 
			'</span>';
		} else {
			$out = '<span class="cmsmasters_post_date">' . 
				'<abbr class="published" title="' . esc_attr(get_the_date()) . '">' . 
					esc_html(get_the_date()) . 
				'</abbr>' . 
				'<abbr class="dn date updated" title="' . esc_attr(get_the_modified_date()) . '">' . 
					esc_html(get_the_modified_date()) . 
				'</abbr>' . 
			'</span>';
		}
		
		
		if (cmsmasters_title(get_the_ID(), false) == get_the_ID()) {
			$out = '<a href="' . esc_url(get_permalink()) . '">' . $out . '</a>';
		}
	} elseif ($template_type == 'post') {
		$cmsmasters_option = hotel_lux_get_global_options();
		
		$out = '';
		
		if ($cmsmasters_option['hotel-lux' . '_blog_post_date']) {
			$out .= '<span class="cmsmasters_post_date">' . 
				'<abbr class="published" title="' . esc_attr(get_the_date()) . '">' . 
					esc_html(get_the_date()) . 
				'</abbr>' . 
				'<abbr class="dn date updated" title="' . esc_attr(get_the_modified_date()) . '">' . 
					esc_html(get_the_modified_date()) . 
				'</abbr>' . 
			'</span>';
		}
	}
	
	
	if ($show) {
		echo wp_kses_post($out);
	} else {
		return wp_kses_post($out);
	}
}



/* Get Posts Author Function */
function hotel_lux_get_post_author($template_type = 'page', $show = true) {
	if ($template_type == 'page') {
		$out = '<span class="cmsmasters_post_author">' . 
			'<span class="cmsmasters_post_author_suf">' . esc_html__('by', 'hotel-lux') . ' </span>' . 
			'<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" title="' . esc_attr__('Posts by', 'hotel-lux') . ' ' . esc_attr(get_the_author_meta('display_name')) . '" class="vcard author" rel="author">' . 
				'<span class="fn">' . esc_html(get_the_author_meta('display_name')) . '</span>' . 
			'</a>' . 
		'</span>';
	} elseif ($template_type == 'post') {
		$cmsmasters_option = hotel_lux_get_global_options();
		$out = '';
		
		if ($cmsmasters_option['hotel-lux' . '_blog_post_author']) {
			$out .= '<span class="cmsmasters_post_author">' . 
				esc_html__('by', 'hotel-lux') . ' ' . 
				'<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" title="' . esc_attr__('Posts by', 'hotel-lux') . ' ' . esc_attr(get_the_author_meta('display_name')) . '" class="vcard author" rel="author">' . 
					'<span class="fn">' . esc_html(get_the_author_meta('display_name')) . '</span>' . 
				'</a>' . 
			'</span>';
		}
	}
	
	
	if ($show) {
		echo wp_kses_post($out);
	} else {
		return wp_kses_post($out);
	}
}



/* Get Posts Category Function */
function hotel_lux_get_post_category($cmsmasters_id, $taxonomy, $template_type = 'page', $show = true) {
	$out = '';
	
	
	if (get_the_terms($cmsmasters_id, $taxonomy)) {
		if ($template_type == 'page') {
			$out .= '<span class="cmsmasters_post_category">' . 
				'<span class="cmsmasters_post_cat_suf">' . esc_html__('in', 'hotel-lux') . ' </span>' . 
				hotel_lux_get_the_category_list($cmsmasters_id, $taxonomy, ', ') . 
			'</span>';
		} elseif ($template_type == 'post') {
			$cmsmasters_option = hotel_lux_get_global_options();
			
			
			if ($cmsmasters_option['hotel-lux' . '_blog_post_cat']) {
				$out .= '<span class="cmsmasters_post_category">' . 
					esc_html__('in', 'hotel-lux') . ' ' . 
					hotel_lux_get_the_category_list($cmsmasters_id, $taxonomy, ', ') . 
				'</span>';
			}
		}
	}
	
	
	if ($show) {
		echo wp_kses_post($out);
	} else {
		return wp_kses_post($out);
	}
}



/* Get Posts Tags Function */
function hotel_lux_get_post_tags($show = true) {
	if (get_the_tags()) {
		$cmsmasters_option = hotel_lux_get_global_options();
		$out = '';
		
		if ($cmsmasters_option['hotel-lux' . '_blog_post_tag']) {
			$out .= '<span class="cmsmasters_post_tags">' . 
				get_the_tag_list(esc_html__('tags', 'hotel-lux') . ' ', ', ', '') . 
			'</span>';
		}
		
		
		if ($show) {
			echo wp_kses_post($out);
		} else {
			return wp_kses_post($out);
		}
	}
}



/* Get Posts Content/Excerpt Function */
function hotel_lux_post_exc_cont($length = 20, $show = true) {
	$out = cmsmasters_divpdel('<div class="cmsmasters_post_content entry-content">' . "\n" . 
		wpautop(hotel_lux_excerpt($length, false)) . 
	'</div>' . "\n");
	
	
	if (hotel_lux_excerpt($length, false) != '') {
		if ($show) {
			echo hotel_lux_return_content($out);
		} else {
			return $out;
		}
	}
}



/* Get Posts Like Function */
function hotel_lux_get_post_likes($template_type = 'page', $show = true) {
	$out = '';
	
	
	if ($template_type == 'page') {
		$out = cmsmasters_like('cmsmasters_post_likes');
	} elseif ($template_type == 'post') {
		$cmsmasters_option = hotel_lux_get_global_options();
		
		if ($cmsmasters_option['hotel-lux' . '_blog_post_like']) {
			$out = cmsmasters_like('cmsmasters_post_likes');
		}
	}
	
	
	if ($show) {
		echo hotel_lux_return_content($out);
	} else {
		return $out;
	}
}



/* Get Posts Comments Function */
function hotel_lux_get_post_comments($template_type = 'page', $show = true) {
	$out = '';
	
	
	if (comments_open()) {
		if ($template_type == 'page') {
			$out = hotel_lux_get_comments('cmsmasters_post_comments');
		} elseif ($template_type == 'post') {
			$cmsmasters_option = hotel_lux_get_global_options();
			
			if ($cmsmasters_option['hotel-lux' . '_blog_post_comment']) {
				$out = hotel_lux_get_comments('cmsmasters_post_comments');
			}
		}
	}
	
	
	if ($show) {
		echo hotel_lux_return_content($out);
	} else {
		return $out;
	}
}



/* Get Posts More Button/Link Function */
function hotel_lux_post_more($cmsmasters_id, $show = true) {
	$cmsmasters_post_read_more = get_post_meta($cmsmasters_id, 'cmsmasters_post_read_more', true);
	
	
	if ($cmsmasters_post_read_more == '') {
		$cmsmasters_post_read_more = esc_html__('Read More', 'hotel-lux');
	}
	
	
	$out = '<a class="cmsmasters_post_read_more" href="' . esc_url(get_permalink($cmsmasters_id)) . '">' . esc_html($cmsmasters_post_read_more) . '</a>';
	
	
	if ($show) {
		echo wp_kses_post($out);
	} else {
		return wp_kses_post($out);
	}
}



/* Get Post Format Icon Placeholder Function */
function hotel_lux_post_format_icon_placeholder($cmsmasters_id, $format = 'std', $show = true) {
	$out = '<figure class="cmsmasters_img_wrap">' . 
		'<a href="' . esc_url(get_permalink()) . '" title="' . cmsmasters_title($cmsmasters_id, false) . '" class="preloader cmsmasters_theme_icon_' . esc_attr($format) . '"></a>' . 
	'</figure>';
	
	
	if ($show) {
		echo wp_kses_post($out);
	} else {
		return wp_kses_post($out);
	}
}

