<?php
/**
 * Template Name: DataMotion Author Page
 */

$slug      = pods_url_variable('last');
$author    = pods('authors', $slug);
$account   = $author->field('user_account');
$facebook  = $author->field('facebook');
$linkedin  = $author->field('linkedin');
$twitter   = $author->field('twitter');
$email     = $author->field('email');
$user_id   = $account['ID'];
$avatar    = get_avatar($user_id, 102);
$posts_url = get_author_posts_url($user_id);
?>

<?php get_header('page'); ?>

	<div class="row single_page">

		<div class="two_column post_content single_author">
			<h1>About <?php the_title(); ?>
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
			</h1>
			<?php if (have_posts()): while (have_posts()): the_post(); ?>
				<?php echo $avatar; ?>	
				<?php the_content(); ?>

				<div class="single_author_cat">	
					<?php
					$categories = dm_get_author_categories($account['ID']);
					
					if (!empty($categories)):
					?>
						<p class="categories"><strong>Categories:</strong> <?php dm_category_links($categories); ?></p>
					<?php endif; ?>
				</div>

				<div class="author_read_more">
					<a href="<?php echo $posts_url; ?>">Read More by This Author &raquo;</a>
				</div>

				<div class="clearfix"></div>

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

			<?php endwhile; endif; ?>

		</div>

		<?php get_sidebar('author'); ?>

	</div>

<?php get_footer(); ?>
