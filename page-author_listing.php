<?php
/**
 * Template Name: DataMotion Author Listing Page
 */
?>

<?php get_header('page'); ?>

	<div class="row single_page">

		<div class="two_column post_content author_listing">
			<h3><?php the_title(); ?></h3>

			<?php if (have_posts()): while (have_posts()): the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; endif; ?>

			<?php
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;
			$author_args = array(
				'post_type' => 'authors',
				'post_status' => 'publish',
				'posts_per_page' => 10,
				'paged' => $paged,
				'orderby' => 'meta_value_num',
				'meta_key' => 'order_number',
			);
			$author_query = new WP_Query($author_args);

			if ($author_query->have_posts()): while ($author_query->have_posts()): $author_query->the_post();
				$user       = pods('authors', $post->ID);
				$slug       = $post->post_name;
				$account    = $user->field('user_account');
				$user_id    = $account['ID'];
				$avatar     = get_avatar($user_id, 102);
				$facebook   = $user->field('facebook');
				$linkedin   = $user->field('linkedin');
				$twitter    = $user->field('twitter');
				$email      = $user->field('email');
				$posts_url  = get_author_posts_url($user_id);
				$author_url = site_url("/authors/$slug");
			?>
				<div class="blog_author_box">
					<div class="author_box_bio">
						<a href="<?php echo $author_url; ?>">
							<?php echo $avatar; ?>
						</a>
						<div class="author_bio">
							<p class="name"><a href="<?php echo $author_url; ?>"><?php the_title(); ?></a></p>
							<p class="bio"><?php echo strip_tags(get_the_excerpt()); ?></p>

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
								<?php if ($email): ?>
									<a href="mailto:<?php echo $email; ?>">
										<div class="email_author_desktop"></div>
									</a>
								<?php endif; ?>
							</div>

						</div>
						<div class="clearfix" style="border-bottom: none; padding: 0;"></div>
						<div class="author_read_more"><a href="<?php echo $posts_url; ?>">Read More By This Author &raquo;</a></div>
					</div>
				</div>
			<?php endwhile; endif; ?>


		</div>

		<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>
