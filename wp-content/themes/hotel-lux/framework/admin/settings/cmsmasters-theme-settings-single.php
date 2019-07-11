<?php 
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.1.1
 * 
 * Admin Panel Post, Project, Profile Settings
 * Created by CMSMasters
 * 
 */


function hotel_lux_options_single_tabs() {
	$tabs = array();
	
	
	$tabs['post'] = esc_attr__('Post', 'hotel-lux');
	
	if (CMSMASTERS_PROJECT_COMPATIBLE && class_exists('Cmsmasters_Projects')) {
		$tabs['project'] = esc_attr__('Project', 'hotel-lux');
	}
	
	if (CMSMASTERS_PROFILE_COMPATIBLE && class_exists('Cmsmasters_Profiles')) {
		$tabs['profile'] = esc_attr__('Profile', 'hotel-lux');
	}
	
	
	return apply_filters('cmsmasters_options_single_tabs_filter', $tabs);
}


function hotel_lux_options_single_sections() {
	$tab = hotel_lux_get_the_tab();
	
	
	switch ($tab) {
	case 'post':
		$sections = array();
		
		$sections['post_section'] = esc_attr__('Blog Post Options', 'hotel-lux');
		
		
		break;
	case 'project':
		$sections = array();
		
		$sections['project_section'] = esc_attr__('Portfolio Project Options', 'hotel-lux');
		
		
		break;
	case 'profile':
		$sections = array();
		
		$sections['profile_section'] = esc_attr__('Person Block Profile Options', 'hotel-lux');
		
		
		break;
	default:
		$sections = array();
		
		
		break;
	}
	
	
	return apply_filters('cmsmasters_options_single_sections_filter', $sections, $tab);
} 


function hotel_lux_options_single_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = hotel_lux_get_the_tab();
	}
	
	
	$options = array();
	
	
	$defaults = hotel_lux_settings_single_defaults();
	
	
	switch ($tab) {
	case 'post':
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'hotel-lux' . '_blog_post_layout', 
			'title' => esc_html__('Layout Type', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'radio_img', 
			'std' => $defaults[$tab]['hotel-lux' . '_blog_post_layout'], 
			'choices' => array( 
				esc_html__('Right Sidebar', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'hotel-lux') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'hotel-lux' . '_blog_post_title', 
			'title' => esc_html__('Post Title', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_blog_post_title'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'hotel-lux' . '_blog_post_date', 
			'title' => esc_html__('Post Date', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_blog_post_date'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'hotel-lux' . '_blog_post_cat', 
			'title' => esc_html__('Post Categories', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_blog_post_cat'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'hotel-lux' . '_blog_post_author', 
			'title' => esc_html__('Post Author', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_blog_post_author'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'hotel-lux' . '_blog_post_comment', 
			'title' => esc_html__('Post Comments', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_blog_post_comment'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'hotel-lux' . '_blog_post_tag', 
			'title' => esc_html__('Post Tags', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_blog_post_tag'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'hotel-lux' . '_blog_post_like', 
			'title' => esc_html__('Post Likes', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_blog_post_like'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'hotel-lux' . '_blog_post_nav_box', 
			'title' => esc_html__('Posts Navigation Box', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_blog_post_nav_box'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'hotel-lux' . '_blog_post_nav_order_cat', 
			'title' => esc_html__('Posts Navigation Order by Category', 'hotel-lux'), 
			'desc' => esc_html__('enable', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_blog_post_nav_order_cat'] 
		);
		
		if (class_exists('Cmsmasters_Content_Composer')) {
			$options[] = array( 
				'section' => 'post_section', 
				'id' => 'hotel-lux' . '_blog_post_share_box', 
				'title' => esc_html__('Sharing Box', 'hotel-lux'), 
				'desc' => esc_html__('show', 'hotel-lux'), 
				'type' => 'checkbox', 
				'std' => $defaults[$tab]['hotel-lux' . '_blog_post_share_box'] 
			);
		}
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'hotel-lux' . '_blog_post_author_box', 
			'title' => esc_html__('About Author Box', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_blog_post_author_box'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'hotel-lux' . '_blog_more_posts_box', 
			'title' => esc_html__('More Posts Box', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['hotel-lux' . '_blog_more_posts_box'], 
			'choices' => array( 
				esc_html__('Show Related Posts', 'hotel-lux') . '|related', 
				esc_html__('Show Popular Posts', 'hotel-lux') . '|popular', 
				esc_html__('Show Recent Posts', 'hotel-lux') . '|recent', 
				esc_html__('Hide More Posts Box', 'hotel-lux') . '|hide' 
			) 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'hotel-lux' . '_blog_more_posts_count', 
			'title' => esc_html__('More Posts Box Items Number', 'hotel-lux'), 
			'desc' => esc_html__('posts', 'hotel-lux'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['hotel-lux' . '_blog_more_posts_count'], 
			'min' => '2', 
			'max' => '20' 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'hotel-lux' . '_blog_more_posts_pause', 
			'title' => esc_html__('More Posts Slider Pause Time', 'hotel-lux'), 
			'desc' => esc_html__("in seconds, if '0' - autoslide disabled", 'hotel-lux'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['hotel-lux' . '_blog_more_posts_pause'], 
			'min' => '0', 
			'max' => '20' 
		);
		
		
		break;
	case 'project':
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_project_title', 
			'title' => esc_html__('Project Title', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_project_title'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_project_details_title', 
			'title' => esc_html__('Project Details Title', 'hotel-lux'), 
			'desc' => esc_html__('Enter a project details block title', 'hotel-lux'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_project_details_title'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_project_date', 
			'title' => esc_html__('Project Date', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_project_date'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_project_cat', 
			'title' => esc_html__('Project Categories', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_project_cat'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_project_author', 
			'title' => esc_html__('Project Author', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_project_author'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_project_comment', 
			'title' => esc_html__('Project Comments', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_project_comment'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_project_tag', 
			'title' => esc_html__('Project Tags', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_project_tag'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_project_like', 
			'title' => esc_html__('Project Likes', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_project_like'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_project_link', 
			'title' => esc_html__('Project Link', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_project_link'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_project_share_box', 
			'title' => esc_html__('Sharing Box', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_project_share_box'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_project_nav_box', 
			'title' => esc_html__('Projects Navigation Box', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_project_nav_box'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_project_nav_order_cat', 
			'title' => esc_html__('Projects Navigation Order by Category', 'hotel-lux'), 
			'desc' => esc_html__('enable', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_project_nav_order_cat'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_project_author_box', 
			'title' => esc_html__('About Author Box', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_project_author_box'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_more_projects_box', 
			'title' => esc_html__('More Projects Box', 'hotel-lux'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_more_projects_box'], 
			'choices' => array( 
				esc_html__('Show Related Projects', 'hotel-lux') . '|related', 
				esc_html__('Show Popular Projects', 'hotel-lux') . '|popular', 
				esc_html__('Show Recent Projects', 'hotel-lux') . '|recent', 
				esc_html__('Hide More Projects Box', 'hotel-lux') . '|hide' 
			) 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_more_projects_count', 
			'title' => esc_html__('More Projects Box Items Number', 'hotel-lux'), 
			'desc' => esc_html__('projects', 'hotel-lux'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_more_projects_count'], 
			'min' => '2', 
			'max' => '20' 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_more_projects_pause', 
			'title' => esc_html__('More Projects Slider Pause Time', 'hotel-lux'), 
			'desc' => esc_html__("in seconds, if '0' - autoslide disabled", 'hotel-lux'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_more_projects_pause'], 
			'min' => '0', 
			'max' => '20' 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_project_slug', 
			'title' => esc_html__('Project Slug', 'hotel-lux'), 
			'desc' => esc_html__('Enter a page slug that should be used for your projects single item', 'hotel-lux'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_project_slug'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_pj_categs_slug', 
			'title' => esc_html__('Project Categories Slug', 'hotel-lux'), 
			'desc' => esc_html__('Enter page slug that should be used on projects categories archive page', 'hotel-lux'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_pj_categs_slug'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'hotel-lux' . '_portfolio_pj_tags_slug', 
			'title' => esc_html__('Project Tags Slug', 'hotel-lux'), 
			'desc' => esc_html__('Enter page slug that should be used on projects tags archive page', 'hotel-lux'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_portfolio_pj_tags_slug'], 
			'class' => '' 
		);
		
		
		break;
	case 'profile':
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'hotel-lux' . '_profile_post_title', 
			'title' => esc_html__('Profile Title', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_profile_post_title'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'hotel-lux' . '_profile_post_details_title', 
			'title' => esc_html__('Profile Details Title', 'hotel-lux'), 
			'desc' => esc_html__('Enter a profile details block title', 'hotel-lux'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_profile_post_details_title'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'hotel-lux' . '_profile_post_cat', 
			'title' => esc_html__('Profile Categories', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_profile_post_cat'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'hotel-lux' . '_profile_post_comment', 
			'title' => esc_html__('Profile Comments', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_profile_post_comment'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'hotel-lux' . '_profile_post_like', 
			'title' => esc_html__('Profile Likes', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_profile_post_like'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'hotel-lux' . '_profile_post_nav_box', 
			'title' => esc_html__('Profiles Navigation Box', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_profile_post_nav_box'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'hotel-lux' . '_profile_post_nav_order_cat', 
			'title' => esc_html__('Profiles Navigation Order by Category', 'hotel-lux'), 
			'desc' => esc_html__('enable', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_profile_post_nav_order_cat'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'hotel-lux' . '_profile_post_share_box', 
			'title' => esc_html__('Sharing Box', 'hotel-lux'), 
			'desc' => esc_html__('show', 'hotel-lux'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['hotel-lux' . '_profile_post_share_box'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'hotel-lux' . '_profile_post_slug', 
			'title' => esc_html__('Profile Slug', 'hotel-lux'), 
			'desc' => esc_html__('Enter a page slug that should be used for your profiles single item', 'hotel-lux'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_profile_post_slug'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'hotel-lux' . '_profile_pl_categs_slug', 
			'title' => esc_html__('Profile Categories Slug', 'hotel-lux'), 
			'desc' => esc_html__('Enter page slug that should be used on profiles categories archive page', 'hotel-lux'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['hotel-lux' . '_profile_pl_categs_slug'], 
			'class' => '' 
		);
		
		
		break;
	}
	
	
	return apply_filters('cmsmasters_options_single_fields_filter', $options, $tab);
}

