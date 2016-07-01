<div id="sidebar" class="first column">

	<?php include('includes/partials/social_links.php'); ?>
	
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

	<?php if (is_single()): ?>
		<?php
		global $post;
		$categories = get_the_terms($post->ID, 'library_categories');

		if (!empty($categories)):
			$cat = reset($categories);
			$term_id = $cat->term_id;
			$cat_link = get_term_link($cat, 'library_categories');
		?>
			<div class="category_back">
				<a href="<?php echo $cat_link; ?>">&laquo; Back to <?php echo $cat->name; ?></a>
			</div>
		<?php endif; ?>
		
	<?php else: ?>
		<div class="category_back">
			<a href="<?php echo site_url('/library'); ?>">&laquo; Back to Library</a>
		</div>
	<?php endif; ?>

</div>
