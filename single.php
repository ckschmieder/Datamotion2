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
				$user_id = get_the_author_meta('ID');
				$categories = get_the_category();
				$root_category = get_root_category($categories[0]);
				$avatar = get_avatar($user_id, 102);
				$author = pods('authors', array(
					'where' => "user_account.ID = $user_id",
				));
				$is_news = $root_category->slug == 'news';
				$is_blog = $root_category->slug == 'blog';
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
						$author->reset();
						?>
						<a href="<?php echo $author_url; ?>" class="author"><?php the_author(); ?></a>
					<?php endif; ?>
					<div class="clearfix"></div>
				</div>
		
				<?php the_content(); ?>

				<div class="blog_author_box">
					<div class="author_box_categories">
						<p>
							<strong>Categories:</strong>
							<?php dm_category_links($categories); ?>
						</p>
					</div>
					<?php if ($author->total_found() && !$is_news): ?>
						<?php
						$author->fetch();
						$slug = $author->field('post_name');
						$facebook = $author->field('facebook');
						$linkedin = $author->field('linkedin');
						$twitter = $author->field('twitter');
						$bio = $author->field('post_content');
						$bio = apply_filters('the_excerpt', $bio);
						$posts_url = get_author_posts_url($user_id);
						$author_url = site_url("/authors/$slug");
						?>
						<div class="author_box_bio">
							<?php echo $avatar; ?>
							<div class="author_bio">
								<p class="name"><a href="<?php echo $author_url; ?>"><?php the_author(); ?></a></p>
								<p class="bio">
									<?php echo $bio; ?>
								</p>

								<div class="author_social_icons">
									<?php if ($facebook): ?>
										<a href="<?php echo $facebook; ?>" target="_blank">
											<div class="facebook_desktop"></div>
										</a>
									<?php endif; ?>
									<?php if ($linkedin): ?>
										<a href="<?php echo $linkedin; ?>" target="_blank">
											<div class="linkedin_desktop"></div>
										</a>
									<?php endif; ?>
									<?php if ($twitter): ?>
										<a href="<?php echo $twitter; ?>" target="_blank">
											<div class="twitter_desktop"></div>
										</a>
									<?php endif; ?>
								</div>

							</div>
							<div class="clearfix" style="border-bottom: none; padding: 0;"></div>
							<div class="author_read_more"><a href="<?php echo $posts_url; ?>">Read More By This Author &raquo;</a></div>
						</div>
					<?php endif; ?>
				</div>
			
			<?php endwhile; endif; ?>

		</div>

		<?php
		if ($is_news) {
			get_sidebar('news');
		} elseif ($is_blog) {
			get_sidebar('blog');
		} else {
			get_sidebar();
		}
		?>

	</div>

<?php get_footer(); ?>
