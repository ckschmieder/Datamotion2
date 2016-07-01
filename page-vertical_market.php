<?php
/**
 * Template Name: DataMotion Vertical Market Page
 */

global $post;

// Set remember cookie if user filled out form to get here.
if (array_key_exists('ty', $_GET)) {
	$cookie_exptime = time() + 60 * 60 * 24 * 30;
	setcookie('dm_library', true, $cookie_exptime, '/');
}

$cats = pods('library_categories', array(
	'limit' => -1,
	'order' => 't.name ASC',
));

$banner_link = get_post_meta($post->ID, 'banner_link', true);
?>

<?php get_header('page'); ?>

	<div class="vertical-market">

		<div class="row single_page">

      <?php if (!empty($banner_link)): ?>
        <a href="<?php echo esc_url($banner_link); ?>">
      <?php endif; ?>
        <?php the_post_thumbnail( 'full', array('class'	=> 'vertical-hero') ); ?>
      <?php if (!empty($banner_link)): ?>
        </a>
      <?php endif; ?>

			<div class="two_column post_content library">

				<?php if (have_posts()): while (have_posts()): the_post(); ?>
					<h1><?php the_title(); ?></h1>
          <?php $GLOBALS['page_content'] = get_the_content(); ?>
          <?php
          $vertical_market_links = get_field('vertical_market_links');
          foreach ($vertical_market_links as $vertical_market_link) {
          ?>
<a href="<?php echo $vertical_market_link['learn_more_link'] ?>" class="vertical-market-link <?php echo $vertical_market_link['call_out_type'] ?> <?php if ($vertical_market_link['new_marker']) { echo "new-marker"; } ?>" style="background-image: url(<?php echo $vertical_market_link['call_out_image']['url'] ?>);">
	<div class="vertical-market-container">
		<div class="vertical-market-name"><?php echo $vertical_market_link['call_out_name'] ?></div>
		<div class="vertical-market-text"><?php echo $vertical_market_link['call_out_text'] ?></div>
<?php

$learn_more_link_text = $vertical_market_link['learn_more_link_text'];
$last_word_start      = strrpos ( $learn_more_link_text , " ") + 1;

// $new_learn_more_link_text = substr_replace($learn_more_link_text, '<span style="white-space: nowrap;">', $last_word_start, 0) . "</span>";

$new_learn_more_link_text = substr($learn_more_link_text, 0, $last_word_start) . '<span style="white-space: nowrap;">' . substr($learn_more_link_text, $last_word_start) . '<span class="more-arrow"></span></span>';
?>
		<div class="call-out-link"><?php echo $new_learn_more_link_text ?></div>
	</div>
</a>
<?php
}
?>

				<?php endwhile; endif; ?>
				<div class="clearfix"></div>

				</div>
			</div>

			<?php get_sidebar('vertical_market') ?>

		</div>

	</div>

<?php get_footer(); ?>
