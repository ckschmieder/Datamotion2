<?php
/**
 * Template Name: DataMotion Library Access Template
 */

// Redirect user to library page if they have already filled out the form.
if ($_COOKIE['dm_library']) {
	wp_redirect(site_url('/library'));
	die();
}
?>

<?php get_header('page'); ?>


	<div class="row single_page">



		<div class="two_column">
			<?php if (have_posts()): while (have_posts()): the_post(); ?>
        <h1><?php the_title(); ?></h1>

				<?php the_content(); ?>

			<?php endwhile; endif; ?>
		</div>



		<?php get_sidebar(); ?>
	</div>


<?php get_footer(); ?>
