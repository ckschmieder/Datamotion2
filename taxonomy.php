<?php
/**
 * Template Name: DataMotion Taxonomy Archive Template
 */

global $wp_query;
$term = $wp_query->queried_object;
$taxonomy = get_taxonomy($term->taxonomy);
$tax_name = $taxonomy->labels->name;
?>



<?php get_header('page'); ?>


	<div class="row archive">
		<div class="two_column taxonomy_page">
			<h1><?php echo $tax_name; ?> Archive: <?php echo $term->name; ?></h1>
			<?php if (have_posts()): while (have_posts()): the_post(); ?>
				<?php
				$post_type = get_post_type($post->ID);
				$post_type_obj = get_post_type_object($post_type);
				$post_type_name = $post_type_obj->labels->singular_name;
				?>
				<div class="date_author">
					<p class="date">
						<?php the_date('F j, Y'); ?>
					</p>
				</div>
				<div class="clearfix"></div>
				<h4>
					<span class="post_type <?php echo $post_type; ?>">
						<?php echo $post_type_name; ?>:
					</span>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h4>

				<?php
				if ($post_type == 'library_documents'):
					$doc = pods('library_documents', $post->ID);
					$desc = $doc->field('short_description');
				?>
					<p>
						<?php echo $desc; ?>
					</p>
				<?php else: ?>		
					<?php the_excerpt(); ?>
				<?php endif; ?>
			
			<?php endwhile; ?>
 
			<?php
			$max_pages = $wp_query->max_num_pages;

			if ($max_pages > 1) {
				$current_page = max(1, get_query_var('paged'));

				echo '<div class="pagination">';
				echo paginate_links(array(
					'base'    => get_pagenum_link(1) . '%_%',
					'format'  => 'page/%#%',
					'current' => $current_page,
					'total'   => $max_pages,
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
				));
				echo '</div>';
			}
			?>
			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>

	</div>


<?php get_footer(); ?>
