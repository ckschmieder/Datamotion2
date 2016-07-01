<?php
/**
 * DataMotion Utility Functions
 */

function dm_get_post_term_ids($post_id, $taxonomy) {
	$terms = get_the_terms($post_id, $taxonomy);
	$term_ids = array();

	if (empty($terms)) return array();

	foreach ($terms as $id => $term) {
		$term_ids[] = $term->term_id;
	}
	return $term_ids;
}

function dm_get_author_categories($user_id) {
	$cache_key = "dm_author_categories_{$user_id}";
	$user_categories = get_transient($cache_key);

	if ($user_categories) {
		return $user_categories;
	}

	$user_categories = array();
	$query = new WP_Query(array(
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'author' => $user_id,
	));

	if ($query->have_posts()) {
		while($query->have_posts()) {
			$query->the_post();
			$cats = get_the_category($post->ID);

			foreach ($cats as $cat) {
				if ($cat->term_id > 1) {
					if (!array_key_exists($cat->term_id, $user_categories)) {
						$user_categories[$cat->term_id] = $cat;
					}
				}
			}
		}
	}

	set_transient($cache_key, $user_categories, 21600);
	return $user_categories;
}

function dm_get_author_tags($user_id) {
	$cache_key = "dm_author_tags_{$user_id}";
	$user_tags = get_transient($cache_key);

	if ($user_tags) {
		return $user_tags;
	}

	$user_tags = array();
	$query = new WP_Query(array(
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'author' => $user_id,
	));

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$tags = (array)get_the_tags();

			foreach ($tags as $key => $val) {
				if ($val->term_id > 0) {
					if (!array_key_exists($val->term_id, $user_tags)) {
						$user_tags[$val->term_id] = $val;
					}
				}
			}
		}
	}

	set_transient($cache_key, $user_tags, 21600);
	return $user_tags;
}

// Test whether an avatar exists for a given email
function validate_gravatar($email) {
	$hash = md5(strtolower(trim($email)));
	$uri = "http://www.gravatar.com/avatar/" . $hash . "?d=404";
	$headers = @get_headers($uri);

	if (preg_match('/200/', $headers[0])) {
		return true;
	}
	return false;
}

// Grab a video's thumbnail URL from YouTube
function get_youtube_thumbnail($video_url, $thumb_num = 0) {
	if (preg_match('/youtu\.be/', $video_url)) {
		$url_regexp = '/\/([0-9A-Za-z]+)$/';
	} else {
		$url_regexp = '/\?v=([0-9A-Z-a-z]+)$/';
	}
	preg_match($url_regexp, $video_url, $matches);

	if (count($matches) > 1) {
		return "http://img.youtube.com/vi/{$matches[1]}/{$thumb_num}.jpg";
	}
	return null;
}

// Get a category's root parent
function get_root_category($category) {
	$category = is_object($category) ? $category : get_category($category);
	$cache_key = 'root_category_' . $category->term_id;
	$cached_root = wp_cache_get($cache_key, 'categories');

	if ($cached_root) {
		return $cached_root;
	}
	
	while ($category->parent > 0) {
		$category = get_category($category->parent);
	}

	wp_cache_set($cache_key, $category, 'categories', 86400);
	return $category;
}

// Changing excerpt more

   function new_excerpt_more($more) {
   global $post;
   return '… <a href="'. get_permalink($post->ID) . '" class="read_more_excerpt">' . 'Read More &raquo;' . '</a>';
   }

   add_filter('excerpt_more', 'new_excerpt_more');

?>
