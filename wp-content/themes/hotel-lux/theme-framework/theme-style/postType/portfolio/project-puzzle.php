<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.1.2
 * 
 * Project Puzzle Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_project_metadata = explode(',', $cmsmasters_pj_metadata);


$title = (in_array('title', $cmsmasters_project_metadata)) ? true : false;
$price = (in_array('price', $cmsmasters_project_metadata)) ? true : false;
$categories = (get_the_terms(get_the_ID(), 'pj-categs') && (in_array('categories', $cmsmasters_project_metadata))) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsmasters_project_metadata))) ? true : false;
$likes = (in_array('likes', $cmsmasters_project_metadata)) ? true : false;
$rollover = in_array('rollover', $cmsmasters_project_metadata) ? true : false;


$cmsmasters_project_price = get_post_meta(get_the_ID(), 'cmsmasters_project_price', true);

$cmsmasters_project_link_url = get_post_meta(get_the_ID(), 'cmsmasters_project_link_url', true);

$cmsmasters_project_link_redirect = get_post_meta(get_the_ID(), 'cmsmasters_project_link_redirect', true);

$cmsmasters_project_link_target = get_post_meta(get_the_ID(), 'cmsmasters_project_link_target', true);


$cmsmasters_project_size = get_post_meta(get_the_ID(), 'cmsmasters_project_size', true);

if (!$cmsmasters_project_size) {
    $cmsmasters_project_size = 'one_x_one';
}


$cmsmasters_project_puzzle_large_gap_image = get_post_meta(get_the_ID(), 'cmsmasters_project_puzzle_large_gap_image', true);

if (
	$cmsmasters_pj_gap == 'large' && 
	$cmsmasters_project_puzzle_large_gap_image
) {
	$cmsmasters_project_image_size = 'cmsmasters_project_puzzle_large_gap_image';
} else {
	$cmsmasters_project_image_size = 'cmsmasters_project_puzzle_image';
}

$cmsmasters_project_puzzle_image = get_post_meta(get_the_ID(), $cmsmasters_project_image_size, true);


$project_sort_categs = get_the_terms(0, 'pj-categs');

$project_categs = '';

if ($project_sort_categs != '') {
	foreach ($project_sort_categs as $project_sort_categ) {
		$project_categs .= ' ' . $project_sort_categ->slug;
	}
	
	
	$project_categs = ltrim($project_categs, ' ');
}


$cmsmasters_post_format = get_post_format();

?>
<!-- Start Project Puzzle Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_project_puzzle ' . $cmsmasters_project_size); echo (($project_categs != '') ? ' data-category="' . esc_attr($project_categs) . '"' : '') ?>>
	<div class="project_outer">
	<?php 
		hotel_lux_thumb_rollover(get_the_ID(), 'full', false, $rollover, false, false, false, false, false, false, true, $cmsmasters_project_link_redirect, $cmsmasters_project_link_url, $cmsmasters_project_link_target, 'cmsmasters_theme_icon_image', $cmsmasters_project_puzzle_image);
		
		
		if ($title || $categories || $likes || $comments || $price) {
			echo '<div class="project_inner">';
				
				if ($title || $categories || $price) {
					echo '<div class="project_inner_middle">' . 
						'<div class="project_inner_table">' . 
							'<div class="project_inner_table_cell">';
							
							if ($categories) {
								echo '<div class="cmsmasters_project_cont_info entry-meta">';
									
									hotel_lux_get_project_category(get_the_ID(), 'pj-categs', 'page');
									
								echo '</div>';
							}
							
							$title ? hotel_lux_project_heading(get_the_ID(), 'h3', $cmsmasters_project_link_redirect, $cmsmasters_project_link_url, $cmsmasters_project_link_target) : '';
							
							$price ? hotel_lux_project_price($cmsmasters_project_price) : '';
							
						echo '</div>' . 
						'</div>' . 
					'</div>';
				}
				
				
				if ($likes || $comments) {
					echo '<footer class="cmsmasters_project_footer entry-meta">';
						
						$likes ? hotel_lux_get_project_likes('page') : '';
						
						$comments ? hotel_lux_get_project_comments('page') : '';
						
					echo '</footer>';
				}
				
			echo '</div>';
		}
		
		
		if (!$title) {
			echo '<div class="dn">';
				hotel_lux_project_heading(get_the_ID(), 'h3');
			echo '</div>';
		}
		
		echo '<span class="dn meta-date">' . get_the_time('YmdHis') . '</span>';
	?>
	</div>
</article>
<!-- Finish Project Puzzle Article -->

