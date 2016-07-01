<?php
/**
 * Pods Framework API Hooks
 */

function dm_library_document_set_file_size($pieces, $is_new_item) {

	$size_val = $pieces['fields']['size']['value'];

	if (!$size_val) {
		$pod_name = $pieces['params']->pod;
		$field_name = $pod_name == 'product_brochures' ? 'brochure_pdf' : 'attachment';
		$attachment = $pieces['fields'][$field_name]['value'];
		$attachment_id = reset($attachment);

		if ($attachment_id) {
			$attachment_id = $attachment_id['id'];
			$file_path = get_attached_file($attachment_id);
			$file_size = filesize($file_path) / 1024; // get size in kilobytes
			$file_size = round($file_size, 2);

			$pieces['fields']['size']['value'] = (string)$file_size;
		}
	}

	return $pieces;
}

// Autodetect file size on library documents and product brochures
add_filter('pods_api_pre_save_pod_item_library_documents', 'dm_library_document_set_file_size', 10, 2);
add_filter('pods_api_pre_save_pod_item_product_brochures', 'dm_library_document_set_file_size', 10, 2);

// Grab YouTube default thumbnail image for a video and save it
function dm_video_set_youtube_thumbnail($pieces, $is_new_item) {
	$existing_thumb = $pieces['fields']['youtube_thumbnail']['value'];

	if (!$existing_thumb) {
		$youtube_url = $pieces['fields']['youtube_url']['value'];
		$thumb_url = get_youtube_thumbnail($youtube_url);

		if ($thumb_url) {
			// Check to see if thumbnail exists
			$headers = @get_headers($thumb_url);

			if (preg_match('/200/', $headers[0])) {
				$pieces['fields']['youtube_thumbnail']['value'] = $thumb_url;
			}
		}
	}

	return $pieces;
}
add_filter('pods_api_pre_save_pod_item_videos', 'dm_video_set_youtube_thumbnail', 10, 2);

function pods_debug_log($file, $value) {
	$f = fopen($file, 'a+');

	ob_start();
	print_r($value);
	$output = ob_get_clean();
	fwrite($f, $output);
	fclose($f);
}

?>
