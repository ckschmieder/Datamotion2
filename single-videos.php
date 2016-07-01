<?php
/**
 * Template Name: Single Post Template
 */
?>

<?php get_header('page'); ?>

	<div class="row single_page">

		<div class="two_column post_content">
			<h1><?php the_title(); ?></h1>
			<?php if (have_posts()): while (have_posts()): the_post(); ?>
				<?php
				$pod = pods('videos', $post->ID);
				$youtube_url = $pod->field('youtube_url');
				$user_id = get_the_author_meta('ID');
				$author = pods('authors', array(
					'where' => "user_account.ID = $user_id",
					'limit' => 1
				));
				$categories = get_the_category();
				$avatar = get_avatar($user_id, 102);
				$author = pods('authors', array(
					'where' => "user_account.ID = $user_id",
				));
				$is_news = in_category('news');
				$embed_code = wp_oembed_get($youtube_url);
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
					<div class="clearfix"></div>
				</div>

				<div id="video_embed">
					<?php echo $embed_code; ?>
				</div>
		
				<?php the_content(); ?>

			<?php endwhile; endif; ?>

		</div>

		<?php get_sidebar('video'); ?>

	</div>

<?php get_footer(); ?>
