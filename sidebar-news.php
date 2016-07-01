
<?php

/**
* Sidebar for News and Events
*/
?>
<div id="sidebar" class="first column news_sidebar">

	<?php include('includes/partials/social_links.php'); ?>

	<?php
	$sidebar_images = pods('sidebar_images', array(
		'where' => 't.published = 1',
		'limit' => 1,
		'orderby' => 'RAND()'
	));

	if ($sidebar_images->total_found()):
		$sidebar_images->fetch();
		$img = $sidebar_images->field('image');
		$alt = $sidebar_images->field('name');
		$src = wp_get_attachment_image_src($img['ID'], 'post-thumbnail');
	?>
		<img src="<?php echo $src[0]; ?>" width="<?php echo $src[1]; ?>" height="<?php echo $src[2]; ?>" alt="<?php echo $alt; ?>">
	<?php else: ?>
		<img width="283" height="281" src="<?php bloginfo('url'); ?>/wp-content/uploads/2013/03/sidebar_placeholder.jpg" class="attachment-post-thumbnail wp-post-image" alt="sidebar_placeholder" />
	<?php endif; ?>

	<div>
		<h4 id="archives"><?php _e('Yearly Archive'); ?></h4>
		    <ul>
				<?php wp_get_archives('type=yearly'); ?>
     		</ul>
	</div>

	<div class="sidebar_secondary_links">
		<h4>DataMotion In The News</h4>
		<?php
		$links = pods('news_links', array(
			'orderby' => 't.order_number ASC',
			'limit' => -1
		));

		if ($links->total()):
		?>
			<ul>
				<?php while ($links->fetch()): ?>
					<li>
						<a href="<?php echo $links->field('link_url'); ?>" target="_blank">
							<?php echo $links->field('name'); ?>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
		<?php endif; ?>
	</div>

</div>
