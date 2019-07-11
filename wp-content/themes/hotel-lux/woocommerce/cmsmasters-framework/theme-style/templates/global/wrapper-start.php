<?php
/**
 * @cmsmasters_package 	Hotel LUX
 * @cmsmasters_version 	1.0.8
 */


list($cmsmasters_layout) = hotel_lux_theme_page_layout_scheme();


echo '<!-- Start Content -->' . "\n";


if ($cmsmasters_layout == 'r_sidebar') {
	echo '<div class="content entry" role="main">' . "\n\t";
} elseif ($cmsmasters_layout == 'l_sidebar') {
	echo '<div class="content entry fr" role="main">' . "\n\t";
} else {
	echo '<div class="middle_content entry">';
}
