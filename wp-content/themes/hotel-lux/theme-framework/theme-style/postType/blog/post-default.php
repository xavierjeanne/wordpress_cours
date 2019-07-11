<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.0.8
 * 
 * Post Default Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_post_metadata = !is_home() ? explode(',', $cmsmasters_metadata) : array();


$date = (in_array('date', $cmsmasters_post_metadata) || is_home()) ? true : false;
$categories = (get_the_category() && (in_array('categories', $cmsmasters_post_metadata) || is_home())) ? true : false;
$author = (in_array('author', $cmsmasters_post_metadata) || is_home()) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsmasters_post_metadata) || is_home())) ? true : false;
$likes = (in_array('likes', $cmsmasters_post_metadata) || (is_home() && CMSMASTERS_CONTENT_COMPOSER)) ? true : false;
$more = (in_array('more', $cmsmasters_post_metadata) || is_home()) ? true : false;


$cmsmasters_post_format = get_post_format();

?>
<!-- Start Post Default Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_post_default'); ?>>
	<div class="cmsmasters_post_cont">
		<?php
		if (is_sticky()) { echo '<div class="cmsmasters_post_sticky cmsmasters_theme_icon_sticky"></div>'; }
	
		$date ? hotel_lux_get_post_date('page', 'default') : '';
		
		hotel_lux_post_heading(get_the_ID(), 'h2');
		
		
		if ($author || $categories || $likes || $comments) {
			echo '<div class="cmsmasters_post_cont_info entry-meta">';
				
				$author ? hotel_lux_get_post_author('page') : '';
				
				$categories ? hotel_lux_get_post_category(get_the_ID(), 'category', 'page') : '';
				
				if ($likes || $comments) {
					echo '<div class="cmsmasters_post_info entry-meta">';
					
					$likes ? hotel_lux_get_post_likes('page') : '';
					
					$comments ? hotel_lux_get_post_comments('page') : '';
					
					echo '</div>';
				}
				
			echo '</div>';
		}
		
		
		if ($cmsmasters_post_format == 'image') {
			$cmsmasters_post_image_link = get_post_meta(get_the_ID(), 'cmsmasters_post_image_link', true);
			
			hotel_lux_post_type_image(get_the_ID(), $cmsmasters_post_image_link);
		} elseif ($cmsmasters_post_format == 'gallery') {
			$cmsmasters_post_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsmasters_post_images', true))));
			
			hotel_lux_post_type_slider(get_the_ID(), $cmsmasters_post_images, 'post-thumbnail');
		} elseif ($cmsmasters_post_format == 'video') {
			$cmsmasters_post_video_type = get_post_meta(get_the_ID(), 'cmsmasters_post_video_type', true);
			$cmsmasters_post_video_link = get_post_meta(get_the_ID(), 'cmsmasters_post_video_link', true);
			$cmsmasters_post_video_links = get_post_meta(get_the_ID(), 'cmsmasters_post_video_links', true);
			
			hotel_lux_post_type_video(get_the_ID(), $cmsmasters_post_video_type, $cmsmasters_post_video_link, $cmsmasters_post_video_links);
		} elseif ($cmsmasters_post_format == 'audio') {
			$cmsmasters_post_audio_links = get_post_meta(get_the_ID(), 'cmsmasters_post_audio_links', true);
			
			hotel_lux_post_type_audio($cmsmasters_post_audio_links);
		} elseif ($cmsmasters_post_format == '' && !post_password_required() && has_post_thumbnail()) {
			hotel_lux_thumb(get_the_ID(), 'post-thumbnail', true, false, false, false, false, true, false);
		}
		
		
		hotel_lux_post_exc_cont(100);
		
		
		if ($more) {
			echo '<footer class="cmsmasters_post_footer entry-meta">';
				
				$more ? hotel_lux_post_more(get_the_ID()) : '';
				
			echo '</footer>';
		}
		?>
	</div>
</article>
<!-- Finish Post Default Article -->

