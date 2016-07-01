<?php
/**
 * Template Name: DataMotion Library Page
 */

// Set remember cookie if user filled out form to get here.
if (array_key_exists('ty', $_GET)) {
	$cookie_exptime = time() + 60 * 60 * 24 * 30;
	setcookie('dm_library', true, $cookie_exptime, '/');
}

$cats = pods('library_categories', array(
	'limit' => -1,
	'order' => 't.name ASC',
));
?>

<?php get_header('page'); ?>

	<div class="row single_page">

		<div class="two_column post_content library">

			<?php if (have_posts()): while (have_posts()): the_post(); ?>
				<h1>DataMotion Resource <?php the_title(); ?></h1>
	
				<?php the_content(); ?>

			<?php endwhile; endif; ?>
			<div class="clearfix"></div>

			<div class="library_sections">
				<?php while ($cats->fetch()): ?>
					<?php
					$icon            = $cats->field('icon');
					$retina_icon     = $cats->field('hi_res_icon');
					$icon_src        = $icon['guid'];
					$data_attr       = $retina_icon ? ' data-retina-src="' . $retina_icon['guid'] . '"' : '';
					$cat_name        = $cats->field('name');
					$cat_slug        = $cats->field('slug');
					$cat_id          = $cats->field('term_id');
					$cat_class       = str_replace('-', '_', $cat_slug);
					$cat_link        = get_term_link($cat_slug, 'library_categories');

					$doc_args  = array(
						'post_status'    => 'publish',
						'orderby'        => 'date',
						'order'          => 'DESC',
						'posts_per_page' => 5,
						'tax_query'      => array(
							array(
								'taxonomy' => 'library_categories',
								'field'    => 'id',
								'terms'    => array($cat_id),
							)
						)
					);
					$doc_query = new WP_Query($doc_args);

					if ($doc_query->have_posts()):
					?>
					
					<div class="<?php echo $cat_class; ?>">
						<h4>
							<?php echo $cat_name; ?>
							<img src="<?php echo $icon_src; ?>" alt="<?php echo $cat_name; ?>"<?php echo $data_attr; ?>>
						</h4>
						
						<ul>
							<?php while ($doc_query->have_posts()): $doc_query->the_post(); ?>
								<?php
								$doc = pods('library_documents', $post->ID);
								$size = $doc->field('size');
								$size = format_file_size($size);
								$desc = $doc->field('short_description');
								$attachment = $doc->field('attachment');
								$attach_path = get_attached_file($attachment['ID']);
								$attach_ext = pathinfo($attach_path, PATHINFO_EXTENSION);
								?>
								<li>
									<p>
										<?php if ($attachment): ?>
											<span class="file_icon <?php echo $attach_ext; ?>"><?php echo $attach_ext; ?></span>
										<?php endif; ?>
										<strong>
											<a href="<?php echo get_permalink($post->ID); ?>"><?php the_title(); ?></a>
										</strong>
										<?php if ($desc): ?>
										&mdash; <?php echo $desc; ?>
										<?php endif; ?>
										<?php if ($attachment): ?>
											<span class="size">(<?php echo $size; ?>)</span>
										<?php endif; ?>
										<?php the_terms($post->ID, 'products', '', ', ', ''); ?>
										<?php the_terms($post->ID, 'solutions', '', ', ', ''); ?>
									</p>
								</li>
							<?php endwhile; ?>
						</ul>
						<a href="<?php echo $cat_link; ?>" class="see_all">See all <?php echo $cat_name; ?> &raquo;</a>
					</div>
					<?php endif; ?>
				<?php endwhile; ?>
			</div>
		</div>

		<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>
