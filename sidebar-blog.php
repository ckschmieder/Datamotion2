
<?php

/**
* Sidebar for Blog
*/

?>
<div id="sidebar" class="first column sidebar_blog">

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
		<h4 id="archives"><?php _e('Blog Archive'); ?></h4>
		    <ul>
				<?php wp_get_archives('type=yearly'); ?>
     		</ul>
	</div>

	<div id="posts-by-author" class="sidebox">
		<div class="box-header">
			<h4>Authors</h4>
			<div class="clear"></div>
		</div>
		<ul>
			<?php //wp_list_authors(array('show_fullname' => true)); ?>
			<?php dm_list_authors(); ?>
		</ul>
	</div>



	<div id="posts-by-tag" class="sidebox">	
		<h4>Category</h4>
		<ul>
			<?php
			wp_list_categories(array(
				'taxonomy' => 'category',
				'title_li' => null,
				'show_count' => 1,
				'child_of' => 2
			));
			?>
		</ul>
	</div>



</div>
