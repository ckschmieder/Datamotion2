<?php
/**
 * The template for displaying Search Results pages.
 *
 */

get_header('page'); ?>

	<div class="row single_page">



		<div class="two_column search_page">
			<?php if ( have_posts() ) : ?>

					<h1 class="page-title"><?php printf( __( 'Search Results for "%s"', 'twentyeleven' ), '<span>' . get_search_query() . '</span>' ); ?></h1>


				<?php /* Start the Loop */ ?>
				<?php while (have_posts()): the_post(); ?>
					<?php
					$post_type = get_post_type($post->ID);
					$post_type_obj = get_post_type_object($post_type);
					$post_type_name = $post_type_obj->labels->singular_name;
					?>
					<div class="search_result">
						<h4>
							<span class="post_type <?php echo $post_type; ?>">
								<?php echo $post_type_name; ?>:
							</span>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h4>
						<?php the_excerpt(); ?>
					</div>
				<?php endwhile; ?>


				<?php
				global $wp_query;
				$max_pages = $wp_query->max_num_pages;

				if ($max_pages > 1) {
					$current_page = max(1, get_query_var('paged'));

					echo '<div class="pagination">';
					echo paginate_links(array(
						'base'    => get_pagenum_link(1) . '%_%',
						'format'  => '&paged=%#%',
						'current' => $current_page,
						'total'   => $max_pages,
						'prev_text' => '&laquo;',
						'next_text' => '&raquo;',
					));
					echo '</div>';
				}
				?>
			<?php else : ?>

					<h3 class="page-title"><?php printf( __( 'No Results found for "%s"', 'twentyeleven' ), '<span>' . get_search_query() . '</span>' ); ?></h3>

					<div class="no_results">
						<p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
					</div>

			<?php endif; ?>

		</div>

		<?php get_sidebar('search'); ?>
		
	</div>
<?php get_footer(); ?>

