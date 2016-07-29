<?php
/**
 * Template Name: DataMotion Home Template
 */
?>

<?php get_header(); ?>


	<div class="row" id="slider_and_cta">

		<?php
		$alert_args = array(
			'post_status'    => 'publish',
			'posts_per_page' => 5,
			'category_name'  => 'alerts',
			'orderby'        => 'date',
			'order'          => 'DESC',
		);
		$alert_query = new WP_Query($alert_args);

		if ($alert_query->have_posts()):
		?>
		<div id="alert" data-speed="<?php echo get_option('dm_homepage_alert_speed'); ?>">
			<a href="#" class="close_alert">x</a>
			<?php while ($alert_query->have_posts()): $alert_query->the_post(); ?>
				<p>
					<strong>Alert:</strong>
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>	
				</p>
			<?php endwhile; ?>
		</div>
		<?php endif; ?>
		<?php
		$slider_images = pods('slider_images', array(
			'where' => 't.published = 1',
			'orderby' => 't.order_number ASC',
			'limit' => 10,
		));
		?>
		<div id="slider">
			<ul class="slides">
				<?php while ($slider_images->fetch()): ?>
					<?php
					$img = $slider_images->field('image');
					$link_url = $slider_images->field('link_url');
					?>
					<li>
						<?php if ($link_url): ?>
						<a href="<?php echo $link_url; ?>">
						<?php endif; ?>
						<img src="<?php echo $img['guid']; ?>" alt="<?php echo $slider_images->field('name'); ?>">
						<?php if ($link_url): ?>
						</a>
						<?php endif; ?>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>

		<?php
		// Mobile under-slider links
		wp_nav_menu(array(
			'theme_location'  => 'slider-links',
			'menu_class'      => 'ca-menu',
			'container_class' => 'cta_mobile',
			'link_before'     => '<h2 class="ca-main">',
			'link_after'      => '</h2>',
		));
		?>

		<div class="spacer">
		</div>


		<div class="cta_desktop">
			<?php
			// Slider side links
			wp_nav_menu(array(
				'theme_location' => 'slider-links',
				'menu_class'     => 'ca-menu',
				'container'      => false,
				'link_before'    => '<div class="ca-content"><h2 class="ca-main">',
				'link_after'     => '</h2></div>',
			));

			// Social Links
			$facebook_link = get_option('dm_social_facebook');
			$linkedin_link = get_option('dm_social_linkedin');
			$twitter_link = get_option('dm_social_twitter');
			$youtube_link = get_option('dm_social_youtube');
			$email_link = get_option('dm_social_email');
			?>
			<div class="social_icons_web">
				<a href="<?php echo $facebook_link; ?>" target="_blank">
					<div class="facebook_desktop">
						<span>Facebook</span>
					</div>
				</a>
				<a href="<?php echo $linkedin_link; ?>" target="_blank">
					<div class="linkedin_desktop">
						<span>LinkedIn</span>
					</div>
				</a>
				<a href="<?php echo $twitter_link; ?>" target="_blank">
					<div class="twitter_desktop">
						<span>Twitter</span>
					</div>
				</a>
				<a href="<?php echo $youtube_link; ?>" target="_blank">
					<div class="youtube_desktop">
						<span>YouTube</span>
					</div>
				</a>
				<a href="<?php echo $email_link; ?>">
					<div class="email_desktop">
						<span>Subscribe</span>
					</div>
				</a>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>



	<div class="row" id="front_page_main">

		<div class="company_and_form column first">
					<div class="column info_mobile">
			<div class="information_links_mobile">
				<h3>Information For</h3>
				<?php
				wp_nav_menu(array(
					'items_wrap' => '%3$s',
					'theme_location' => 'info-buttons',
					'walker' => new Walker_Info_Buttons(),
				));
				?>
			</div>		
		</div>
			<div class="clearfix"></div>

			<!--HubSpot Call-to-Action Code -->
			<span class="hs-cta-wrapper" id="hs-cta-wrapper-41b5ee89-f9f8-4544-9b12-905983ec4c2d">
				<span class="hs-cta-node hs-cta-41b5ee89-f9f8-4544-9b12-905983ec4c2d" id="hs-cta-41b5ee89-f9f8-4544-9b12-905983ec4c2d">
					<!--[if lte IE 8]><div id="hs-cta-ie-element"></div><![endif]-->
					<a href="http://cta-redirect.hubspot.com/cta/redirect/219987/41b5ee89-f9f8-4544-9b12-905983ec4c2d"><img class="hs-cta-img" id="hs-cta-img-41b5ee89-f9f8-4544-9b12-905983ec4c2d" style="border-width:0px;" src="http://no-cache.hubspot.com/cta/default/219987/41b5ee89-f9f8-4544-9b12-905983ec4c2d.png" /></a>
				</span>
				<script type="text/javascript">
					(function(){
						var s='hubspotutk',r,c=((r=new RegExp('(^|; )'+s+'=([^;]*)').exec(document.cookie))?r[2]:''),w=window;w[s]=w[s]||c,
							hsjs = document.createElement("script"), el=document.getElementById("hs-cta-41b5ee89-f9f8-4544-9b12-905983ec4c2d");
						hsjs.type = "text/javascript";hsjs.async = true;
						hsjs.src = "//cta-service-cms2.hubspot.com/cs/loader-v2.js?pg=41b5ee89-f9f8-4544-9b12-905983ec4c2d&pid=219987&hsutk=" + encodeURIComponent(c);
						(document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]).appendChild(hsjs);
						try{el.style.visibility="hidden";}catch(err){}
						setTimeout(function() {try{el.style.visibility="visible";}catch(err){}}, 2500);
					})();
				</script>
			</span>
			<!-- end HubSpot Call-to-Action Code -->

			<div class="company_description">
				<div class="yellow_box"></div>
				<?php if (have_posts()): while (have_posts()): the_post(); ?>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				<?php endwhile; endif; ?>
			</div>

			<?php //echo do_shortcode('[subscribe_form]'); ?>
		</div>
		<div class="second column recent_news_blog">
			<?php
			$news_post_count = get_option('dm_homepage_news_count') ? get_option('dm_homepage_news_count') : 6;
			$news_args = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'category_name'  => 'news',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => $news_post_count,
			);
			$news_query = new WP_Query($news_args);
			$news_link = get_term_link('news', 'category');
			?>
			<h3>Recent News and Events</h3>
			<?php if ($news_query->have_posts()): while ($news_query->have_posts()): $news_query->the_post(); ?>
				<div class="excerpt">
					<p>
						<?php the_title(); ?>
						<a href="<?php echo get_permalink($post->ID); ?>">READ MORE &raquo;</a>
					</p>
				</div>
			<?php endwhile; endif; wp_reset_postdata(); ?>
			<a href="<?php echo $news_link; ?>" class="archive_link">
				All News &amp; Events &raquo;
			</a>
		</div>
		<div class="third column last">	
			<div class="information_links">
				<h3>Information For</h3>
				<?php
				wp_nav_menu(array(
					'items_wrap' => '%3$s',
					'theme_location' => 'info-buttons',
					'walker' => new Walker_Info_Buttons(),
				));
				?>
			</div>
			<div class="clearfix"></div>
			<div class="recent_news_blog">
				<?php
				$blog_post_count = get_option('dm_homepage_blog_count') ? get_option('dm_homepage_blog_count') : 6;
				$blog_args = array(
					'post_type'      => 'post',
					'post_status'    => 'publish',
					'category_name'  => 'blog',
					'orderby'        => 'date',
					'order'          => 'DESC',
					'posts_per_page' => $blog_post_count,
				);
				$blog_query = new WP_Query($blog_args);
				$blog_link = get_term_link('blog', 'category');
				?>
				<h3><a href="<?php echo $blog_link; ?>">Our Blog</a></h3>
				<?php if ($blog_query->have_posts()): while ($blog_query->have_posts()): $blog_query->the_post(); ?>
					<div class="excerpt">
						<p>
							<strong><?php the_time('n/j/Y'); ?>:</strong>
							<?php echo the_title(); ?>
							<a href="<?php echo get_permalink($post->ID); ?>">READ MORE &raquo;</a>
						</p>
					</div>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				<a href="<?php echo $blog_link; ?>" class="archive_link">
					All Blog Entries &raquo;
				</a>
			</div>
		</div>
		<div class="two_column first media_container">
			<?php
			$twitter_feed = get_twitter_timeline();

			if ($twitter_feed !== false && !empty($twitter_feed)):
			?>
				<div class="twitter_feed column first">
					<h3>@Datamotion Tweets</h3>
					<div class="tweet_roll">
						<?php foreach ($twitter_feed as $index => $tweet): ?>
							<div class="tweet" id="tweet-<?php echo $tweet->id; ?>">
								<p>
									<?php echo link_twitter_hashtags(link_twitter_usernames(make_clickable($tweet->text))); ?>
								</p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="featured_video column last">
				<?php
				$video_args = array(
					'post_status' => 'publish',
					'post_type' => 'videos',
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC',
					'meta_query' => array(
						array(
							'key' => 'featured',
							'value' => 1,
							'type' => 'NUMERIC',
						),
					),
				);
				$video_query = new WP_Query($video_args);

				if ($video_query->have_posts()):
				?>
					<h3>Featured Video</h3>
					<?php while ($video_query->have_posts()): $video_query->the_post(); ?>
						<?php
						$pod = pods('videos', $post->ID);
						$thumb = $pod->field('thumbnail');
						$yt_url = $pod->field('youtube_url');

						if (!$thumb) {
							$thumb = $pod->field('youtube_thumbnail');
						} else {
							$thumb = $thumb['guid'];
						}
						?>
						<a href="<?php echo $yt_url; ?>" class="youtube" rel="fancybox" id="video_thumb">
							<img src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" width="200" class="thumb">
							<div class="play_button"></div>
						</a>
						<p class="video_description">
							<strong><?php the_title(); ?>:</strong> <?php echo strip_tags(get_the_excerpt()); ?>
							<a href="<?php the_permalink(); ?>">READ MORE &raquo;</a>
						</p>
					<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="clearfix"></div>

	</div>



















<?php get_footer(); ?>
