<?php
/**
 * Template Name: Single Library Document Template
 */

include('includes/Inflector.php');
?>

<?php get_header('page'); ?>

	<div class="row single_page">

		<div class="two_column post_content single_library">
			<?php if (have_posts()): while (have_posts()): the_post(); ?>
				<h1><?php the_title(); ?></h1>
				<?php
				$doc = pods('library_documents', $post->ID);
				$desc = $doc->field('short_description');
				$size = $doc->field('size');
				$size = format_file_size($size);
				$attachment = $doc->field('attachment');
				$attach_path = get_attached_file($attachment['ID']);
				$attach_ext = pathinfo($attach_path, PATHINFO_EXTENSION);
				$doc_categories = get_the_terms($post->ID, 'library_categories');
				$main_category = reset($doc_categories);
				$main_category = pods('library_categories', $main_category->term_id);
				$category_icon = $main_category->field('icon');
				$retina_cat_icon = $main_category->field('hi_res_icon');
				$category_name = $main_category->field('name');
				$category_name = Inflector::singularize($category_name);
				$category_icon_src = wp_get_attachment_image_src($category_icon['ID'], 'full');
				$data_attr = $retina_cat_icon ? ' data-retina-src="' . $retina_cat_icon['guid'] . '"' : '';
				?>

				<div class="date_author">
					<p class="date">
						<?php the_date('F j, Y'); ?>
					</p>
					<div class="clearfix"></div>
				</div>

				<p class="short_description">
					<em><?php echo $desc; ?></em>
				</p>

				<?php the_content(); ?>

				<?php if ($attachment): ?>
					<p class="file_info">
						<div class="download_doc_contain">
							<div class="category_icon">
								<!-- Library Category Icon -->
								<img src="<?php echo $category_icon_src[0]; ?>" width="<?php echo $category_icon_src[1]; ?>" height="<?php echo $category_icon_src[2]; ?>" alt="category icon"<?php echo $data_attr; ?>>
							</div>
							<div class="download">
                <a href="<?php echo $attachment['guid']; ?>"<?php if ($category_name === "Webcasts") { ?> data-track-event="Webinar" data-event-action="Download" data-event-label="<?php echo esc_attr(get_the_title()); ?>"<?php } ?>>Download This <?php echo $category_name; ?> &raquo;</a>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="size">
							<strong>Size: <?php echo $size; ?></strong>
							<span class="file_icon <?php echo $attach_ext; ?>"><?php echo $attach_ext; ?></span>
						</div>
						<div class="doc_tags"><strong>Tags:</strong>
							<?php the_terms($post->ID, 'products', '', ', ', ''); ?>
							<?php the_terms($post->ID, 'solutions', '', ', ', ''); ?>
						</div>


					</p>
				<?php endif; ?>

			<?php endwhile; endif; ?>

		</div>

		<?php get_sidebar('library'); ?>

	</div>

<?php get_footer(); ?>
