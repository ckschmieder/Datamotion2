<?php
global $post;

if (is_page()) {
	$pod = pods('page', $post->ID);
} elseif (is_single()) {
	$pod = pods('post', $post->ID);
}

if (isset($pod)) {
	$sidebar_code = $pod->field('sidebar_content');
}

?>
<div id="sidebar" class="first column">

	<?php include('includes/partials/social_links.php'); ?>
	
	<?php if (has_post_thumbnail($post->ID)): ?>
		<?php echo get_the_post_thumbnail($post->ID); ?>
	<?php else: ?>
		<?php
		$sidebar_images = pods('sidebar_images', array(
			'where' => 't.published = 1',
			'limit' => 1,
			'orderby' => 'RAND()'
		));

		if ($sidebar_images->total_found() > 0):
			$sidebar_images->fetch();
			$img = $sidebar_images->field('image');
			$alt = $sidebar_images->field('name');
			$src = wp_get_attachment_image_src($img['ID'], 'post-thumbnail');

		?>
			<img src="<?php echo $src[0]; ?>" width="<?php echo $src[1]; ?>" height="<?php echo $src[2]; ?>" alt="<?php echo $alt; ?>">
		<?php else: ?>
			<img width="283" height="281" src="<?php bloginfo('url'); ?>/wp-content/uploads/2013/03/sidebar_placeholder.jpg" class="attachment-post-thumbnail wp-post-image" alt="sidebar_placeholder" />
		<?php endif; ?>
	<?php endif; ?>

	<div class="category_back">
		<a href="/videos">&laquo; Back to Videos</a>
	</div>
</div>
