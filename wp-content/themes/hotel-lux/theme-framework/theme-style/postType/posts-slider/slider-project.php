<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.0.8
 * 
 * Posts Slider Project Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_metadata = explode(',', $cmsmasters_project_metadata);


$title = in_array('title', $cmsmasters_metadata) ? true : false;
$subtitle = (in_array('subtitle', $cmsmasters_metadata)) ? true : false;
$price = (in_array('price', $cmsmasters_metadata)) ? true : false;
$excerpt = (in_array('excerpt', $cmsmasters_metadata) && hotel_lux_slider_post_check_exc_cont('project')) ? true : false;
$categories = (get_the_terms(get_the_ID(), 'pj-categs') && in_array('categories', $cmsmasters_metadata)) ? true : false;
$comments = (comments_open() && in_array('comments', $cmsmasters_metadata)) ? true : false;
$likes = in_array('likes', $cmsmasters_metadata) ? true : false;
$more = in_array('more', $cmsmasters_metadata) ? true : false;
$link_href = wp_get_attachment_image_src((int) get_post_thumbnail_id(), 'full');


$cmsmasters_project_subtitle = get_post_meta(get_the_ID(), 'cmsmasters_project_subtitle', true);

$cmsmasters_project_price = get_post_meta(get_the_ID(), 'cmsmasters_project_price', true);

$cmsmasters_project_link_url = get_post_meta(get_the_ID(), 'cmsmasters_project_link_url', true);
$cmsmasters_project_link_redirect = get_post_meta(get_the_ID(), 'cmsmasters_project_link_redirect', true);
$cmsmasters_project_link_target = get_post_meta(get_the_ID(), 'cmsmasters_project_link_target', true);


$cmsmasters_post_format = get_post_format();

?>
<!-- Start Posts Slider Project Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_slider_project'); ?>>
	<div class="cmsmasters_slider_project_outer">
	<?php 
		if (has_post_thumbnail()) {
			echo '<div class="project_img_wrap ' . ((!$title && !$excerpt && !$more && !$price) ? 'empty_content' : '') . '">';
				echo '<div class="cmsmasters_atach_img" style="background-image: url(' . esc_url($link_href[0]) . ')"></div>';
			echo '</div>';
		}
		
		
		if ($title || $categories || $excerpt || $likes || $comments || $more || $price || $subtitle) {
			echo '<div class="cmsmasters_slider_project_inner">';
				
				if ($categories) {
					echo '<div class="cmsmasters_slider_project_cont_info entry-meta">';
						
						hotel_lux_get_slider_post_category(get_the_ID(), 'pj-categs', 'project');
						
					echo '</div>';
				}
				
				
				$title ? hotel_lux_slider_post_heading(get_the_ID(), 'project', 'h3', $cmsmasters_project_link_redirect, $cmsmasters_project_link_url, true, $cmsmasters_project_link_target) : '';
				
				$subtitle ? hotel_lux_project_subtitle($cmsmasters_project_subtitle) : '';
				
				$excerpt ? hotel_lux_slider_post_exc_cont('project') : '';
				
				if ($price || $more) {
					echo '<div class="cmsmasters_slider_project_info_wrap">'; 
					
						$price ? hotel_lux_project_price($cmsmasters_project_price) : '';
						
						$more ? hotel_lux_slider_post_more(get_the_ID(), 'project') : '';
						
					echo '</div>'; 
				}
				
				if ($likes || $comments) {
					echo '<footer class="cmsmasters_slider_project_footer entry-meta">';
						
						($likes) ? hotel_lux_slider_post_like('project') : '';
						
						($comments) ? hotel_lux_get_slider_post_comments('project') : '';
						
					echo '</footer>';
				}
				
			echo '</div>';
		}
	?>
	</div>
</article>
<!-- Finish Posts Slider Project Article -->

