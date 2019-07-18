<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.0.9
 * 
 * Project Single Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_option = hotel_lux_get_global_options();


$cmsmasters_project_title = get_post_meta(get_the_ID(), 'cmsmasters_project_title', true);
$cmsmasters_project_subtitle = get_post_meta(get_the_ID(), 'cmsmasters_project_subtitle', true);

$cmsmasters_project_features = get_post_meta(get_the_ID(), 'cmsmasters_project_features', true);

$cmsmasters_project_image_show = get_post_meta(get_the_ID(), 'cmsmasters_project_image_show', true);


$cmsmasters_project_link_text = get_post_meta(get_the_ID(), 'cmsmasters_project_link_text', true);
$cmsmasters_project_link_url = get_post_meta(get_the_ID(), 'cmsmasters_project_link_url', true);
$cmsmasters_project_link_target = get_post_meta(get_the_ID(), 'cmsmasters_project_link_target', true);


$cmsmasters_project_details_title = get_post_meta(get_the_ID(), 'cmsmasters_project_details_title', true);

$cmsmasters_project_price = get_post_meta(get_the_ID(), 'cmsmasters_project_price', true);


$cmsmasters_project_features_one_title = get_post_meta(get_the_ID(), 'cmsmasters_project_features_one_title', true);
$cmsmasters_project_features_one = get_post_meta(get_the_ID(), 'cmsmasters_project_features_one', true);

$cmsmasters_project_features_two_title = get_post_meta(get_the_ID(), 'cmsmasters_project_features_two_title', true);
$cmsmasters_project_features_two = get_post_meta(get_the_ID(), 'cmsmasters_project_features_two', true);

$cmsmasters_project_features_three_title = get_post_meta(get_the_ID(), 'cmsmasters_project_features_three_title', true);
$cmsmasters_project_features_three = get_post_meta(get_the_ID(), 'cmsmasters_project_features_three', true);


$project_details = '';

if (
	$cmsmasters_option['hotel-lux' . '_portfolio_project_link'] || 
	(
		!empty($cmsmasters_project_features[0][0]) || 
		!empty($cmsmasters_project_features[0][1])
	) || (
		!empty($cmsmasters_project_features[1][0]) || 
		!empty($cmsmasters_project_features[1][1])
	)
) {
	$project_details = 'true';
}


$cmsmasters_post_format = get_post_format();


$project_tags = get_the_terms(get_the_ID(), 'pj-tags');


$cmsmasters_project_sharing_box = get_post_meta(get_the_ID(), 'cmsmasters_project_sharing_box', true);

$cmsmasters_project_author_box = get_post_meta(get_the_ID(), 'cmsmasters_project_author_box', true);

$cmsmasters_project_more_posts = get_post_meta(get_the_ID(), 'cmsmasters_project_more_posts', true);

?>
<!-- Start Project Single Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_open_project'); ?>>
	<?php
	if ($cmsmasters_project_title == 'true' && CMSMASTERS_RATING) {
		echo '<header class="cmsmasters_project_header rating entry-header">';
			hotel_lux_project_title_nolink(get_the_ID(), 'h2');
			
			hotel_lux_custom_rating(get_the_ID(), 'post');
		echo '</header>';
	} elseif ($cmsmasters_project_title == 'true') {
		echo '<header class="cmsmasters_project_header entry-header">';
			hotel_lux_project_title_nolink(get_the_ID(), 'h2');
		echo '</header>';
	}
	
	if (
		CMSMASTERS_RATING ||
		$cmsmasters_project_subtitle != '' ||
		$cmsmasters_project_price != ''
	) {
		echo '<div class="cmsmasters_project_info_wrap">';
		
			hotel_lux_project_subtitle($cmsmasters_project_subtitle);
	
			hotel_lux_project_price($cmsmasters_project_price);
			
			if ($cmsmasters_project_title == 'false' && CMSMASTERS_RATING) {
				hotel_lux_custom_rating(get_the_ID(), 'post');
			}
		
		echo '</div>';
	}
	
	if ($cmsmasters_post_format == 'gallery') {
		$cmsmasters_project_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsmasters_project_images', true))));
		$cmsmasters_project_columns = get_post_meta(get_the_ID(), 'cmsmasters_project_columns', true);
		
		hotel_lux_post_type_gallery(get_the_ID(), $cmsmasters_project_images, $cmsmasters_project_columns, 'cmsmasters-project-thumb', 'cmsmasters-project-full-thumb');
	} elseif ($cmsmasters_post_format == 'video') {
		$cmsmasters_project_video_type = get_post_meta(get_the_ID(), 'cmsmasters_project_video_type', true);
		$cmsmasters_project_video_link = get_post_meta(get_the_ID(), 'cmsmasters_project_video_link', true);
		$cmsmasters_project_video_links = get_post_meta(get_the_ID(), 'cmsmasters_project_video_links', true);
		
		hotel_lux_post_type_video(get_the_ID(), $cmsmasters_project_video_type, $cmsmasters_project_video_link, $cmsmasters_project_video_links, 'cmsmasters-project-full-thumb');
	} elseif ($cmsmasters_post_format == '') {
		$cmsmasters_project_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsmasters_project_images', true))));
		
		if ($cmsmasters_project_image_show == 'true' && $cmsmasters_project_images[0] == '') {
			echo '';
		} else {
			hotel_lux_post_type_slider(get_the_ID(), $cmsmasters_project_images, 'cmsmasters-full-masonry-thumb');
		}
	}
	
	hotel_lux_get_project_category(get_the_ID(), 'pj-categs', 'post');
	
	echo '<div class="project_content">';
		if (get_the_content() != '') {
			echo '<div class="cmsmasters_project_content entry-content">' . "\n";
				
				the_content();
				
				
				wp_link_pages(array( 
					'before' => '<div class="subpage_nav">' . '<strong>' . esc_html__('Pages', 'hotel-lux') . ':</strong>', 
					'after' => '</div>', 
					'link_before' => '<span>', 
					'link_after' => '</span>' 
				));
				
			echo '</div>';
		}
		
	echo '</div>';
	
	
	if ($project_details == 'true') {
		if ($cmsmasters_project_details_title != '') {
			echo '<h5 class="project_details_title">' . esc_html($cmsmasters_project_details_title) . '</h5>';
		}
		
		echo '<div class="project_details entry-meta">';
			
			hotel_lux_get_project_tags(get_the_ID(), 'pj-tags');
			
			hotel_lux_get_project_features('details', $cmsmasters_project_features, false, 'h5', true);
			
			hotel_lux_project_link($cmsmasters_project_link_text, $cmsmasters_project_link_url, $cmsmasters_project_link_target);
			
		echo '</div>';
	}
	
	
	hotel_lux_get_project_features('features', $cmsmasters_project_features_one, $cmsmasters_project_features_one_title, 'h5', true);
	
	hotel_lux_get_project_features('features', $cmsmasters_project_features_two, $cmsmasters_project_features_two_title, 'h5', true);
	
	hotel_lux_get_project_features('features', $cmsmasters_project_features_three, $cmsmasters_project_features_three_title, 'h5', true);
	?>
</article>
<!-- Finish Project Single Article -->
<?php 

if ($cmsmasters_project_sharing_box == 'true') {
	hotel_lux_sharing_box(esc_html__('Like this room?', 'hotel-lux'));
}


/*if ($cmsmasters_option['hotel-lux' . '_portfolio_project_nav_box']) {
	$order_cat = (isset($cmsmasters_option['hotel-lux' . '_portfolio_project_nav_order_cat']) ? $cmsmasters_option['hotel-lux' . '_portfolio_project_nav_order_cat'] : false);
	
	hotel_lux_prev_next_posts($order_cat, 'pj-categs');
}
*/

if ($cmsmasters_project_author_box == 'true') {
	hotel_lux_author_box(esc_html__('About author', 'hotel-lux'), 'h3', 'h5');
}


if ($project_tags) {
	$tgsarray = array();
	
	
	foreach ($project_tags as $tagone) {
		$tgsarray[] = $tagone->term_id;
	}
} else {
	$tgsarray = '';
}


if ($cmsmasters_project_more_posts != 'hide') {
	hotel_lux_related( 
		'h3', 
		esc_html__('More rooms', 'hotel-lux'), 
		esc_html__('No rooms found', 'hotel-lux'), 
		$cmsmasters_project_more_posts, 
		$tgsarray, 
		$cmsmasters_option['hotel-lux' . '_portfolio_more_projects_count'], 
		$cmsmasters_option['hotel-lux' . '_portfolio_more_projects_pause'], 
		'project', 
		'pj-tags' 
	);
}


comments_template();

