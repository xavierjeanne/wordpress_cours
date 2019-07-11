<?php
/**
 * @package 	WordPress
 * @subpackage 	Hotel LUX
 * @version		1.0.8
 * 
 * Website Footer Template
 * Created by CMSMasters
 * 
 */

$cmsmasters_option = hotel_lux_get_global_options();

?>


		</div>
	</div>
</div>
<!-- Finish Middle -->
<?php 

get_sidebar('bottom');

?>
<a href="<?php echo esc_js("javascript:void(0)"); ?>" id="slide_top" class="cmsmasters_theme_icon_slide_top"><span></span></a>
</div>
<!-- Finish Main -->

<!-- Start Footer -->
<footer id="footer" class="<?php echo 'cmsmasters_color_scheme_' . $cmsmasters_option['hotel-lux' . '_footer_scheme'] . ($cmsmasters_option['hotel-lux' . '_footer_type'] == 'default' ? ' cmsmasters_footer_default' : ' cmsmasters_footer_small'); ?>">
	<?php 
	get_template_part('theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/template/footer');
	?>
</footer>
<!-- Finish Footer -->

<?php do_action('cmsmasters_after_page', $cmsmasters_option); ?>
</div>
<span class="cmsmasters_responsive_width"></span>
<!-- Finish Page -->

<?php do_action('cmsmasters_after_body', $cmsmasters_option); ?>
<?php wp_footer(); ?>
</body>
</html>
