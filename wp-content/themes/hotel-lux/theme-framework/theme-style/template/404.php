<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version 	1.0.8
 * 
 * 404 Error Page Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_option = hotel_lux_get_global_options();

?>

</div>

<!-- Start Content -->
<div class="entry">
	<div class="error">
		<div class="error_bg">
			<div class="error_inner">
				<h1 class="error_title"><?php echo esc_html__('404', 'hotel-lux'); ?></h1>
				<h2 class="error_subtitle"><?php echo esc_html__("We're sorry, but the page you were looking for doesn't exist.", 'hotel-lux'); ?></h2>
			</div>
		</div>
	</div>
</div>
<div class="content_wrap fullwidth">
	<div class="error_cont">
		<?php 
		if ($cmsmasters_option['hotel-lux' . '_error_search']) { 
			get_search_form(); 
		}
		
		
		if ($cmsmasters_option['hotel-lux' . '_error_sitemap_button'] && $cmsmasters_option['hotel-lux' . '_error_sitemap_link'] != '') {
			echo '<div class="error_button_wrap"><a href="' . esc_url($cmsmasters_option['hotel-lux' . '_error_sitemap_link']) . '" class="button">' . esc_html__('Sitemap', 'hotel-lux') . '</a></div>';
		}
		?>
	</div>
<!-- Finish Content -->

