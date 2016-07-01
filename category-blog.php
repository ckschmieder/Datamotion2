<?php

/**
* Blog Category 
*/

?>

<?php get_header('page'); ?>


	<div class="row archive">

		<div class="two_column">
			<h1>DataMotion Blog</h1>
			<?php if (have_posts()): while (have_posts()): the_post(); ?>
				<?php
				$user_id = get_the_author_meta('ID');
				$author = pods('authors', array(
					'where' => "user_account.ID = $user_id",
					'limit' => 1
				));
				?>

				<div class="date_author">
					<p class="date">
						<?php the_date('F j, Y'); ?>
					</p>
					
					<?php if ($author->total_found()): ?>
						<?php
						$author->fetch();
						$author_slug = $author->field('post_name');
						$author_url = site_url("/authors/$author_slug");
						?>
						<a href="<?php echo $author_url; ?>" class="author"><?php the_author(); ?></a>
					<?php endif; ?>
				</div>
				<div class="clearfix"></div>
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		
				<?php if (has_post_thumbnail($post->ID)): ?>
					<?php echo get_the_post_thumbnail($post->ID); ?>
				<?php endif; ?>

				<?php the_excerpt(); ?>
				

			<?php endwhile; endif; ?>
			<?php
			global $wp_query;
			$max_pages = $wp_query->max_num_pages;

			if ($max_pages > 1) {
				$current_page = max(1, get_query_var('paged'));

				echo '<div class="pagination">';
				echo paginate_links(array(
					'base' => get_pagenum_link(1) . '%_%',
					'format' => 'page/%#%',
					'current' => $current_page,
					'total' => $max_pages,
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
				));
				echo '</div>';
			}
			?>

		</div>

		<?php get_sidebar('blog'); ?>

	</div>


<?php get_footer(); ?>
