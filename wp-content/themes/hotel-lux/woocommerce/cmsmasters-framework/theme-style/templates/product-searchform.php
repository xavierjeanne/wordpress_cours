<?php
/**
 * @cmsmasters_package 	Hotel LUX
 * @cmsmasters_version 	1.0.7
 */


?>
<div class="search_bar_wrap">
	<form method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<p class="search_field">
			<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search products&hellip;', 'hotel-lux' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
			<input type="hidden" name="post_type" value="product" />
		</p>
		<p class="search_button">
			<button type="submit" class="cmsmasters_theme_icon_search"></button>
		</p>
	</form>
</div>
