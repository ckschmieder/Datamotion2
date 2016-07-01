<?php
/**
 * Template Name: DataMotion FAQ Template
 */
?>

<?php get_header('page'); ?>


	<div class="row single_page">

		<a name="top"></a>

		<div class="two_column faq">
			<?php if (have_posts()): while (have_posts()): the_post(); ?>
        <h1><?php the_title(); ?></h1>

				<?php the_content(); ?>

			<?php endwhile; endif; ?>

			<div id="scroll_to_top">
				<a href="#top"><span></span>Back to Top</a>
			</div>
		</div>



		<?php get_sidebar(); ?>
	</div>


<?php get_footer(); ?>
