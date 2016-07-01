<?php
/**
 * Template Name: DataMotion Default Template
 */
?>


	



<?php get_header('page'); ?>


	<div class="row archive">

		<div class="two_column">
			<h1>News And Events</h1>
				<?php if (have_posts()): while (have_posts()): the_post(); ?>

			<div class="date_author">
				<p class="date">
					<?php the_date('F j, Y'); ?>
				</p>
				<a href="#" class="author"><?php the_author(); ?></a>
			</div>
			<div class="clearfix"></div>
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	
			<?php the_excerpt(); ?>
			
			<?php endwhile; endif; ?>

		</div>

		<?php get_sidebar(); ?>

	</div>


<?php get_footer(); ?>



