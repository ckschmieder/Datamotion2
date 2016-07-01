<?php
/**
 * Template Name: DataMotion Default Template
 */
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
