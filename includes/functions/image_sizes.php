<?php
/**
 * DataMotion Image Size Definitions
 */

function dm_define_image_sizes() {
	if (function_exists('add_theme_support') && function_exists('add_image_size')) {
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(283, 281);
	}
}
add_action('init', 'dm_define_image_sizes');

?>
