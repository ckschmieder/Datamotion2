<?php
/**
 * Template Name: DataMotion Library Document Archive Template
 */

global $wp_query;
$term = $wp_query->queried_object;
?>



<?php get_header('page'); ?>


	<div class="row archive">

		<div class="two_column">
			<h1><?php echo $term->name; ?> Archive</h1>
			<?php if (have_posts()): while (have_posts()): the_post(); ?>
				<?php
				$doc = pods('library_documents', $post->ID);
				$desc = $doc->field('short_description');
				$size = $doc->field('size');
				$size = format_file_size($size);
				$attachment = $doc->field('attachment');
				$attach_path = get_attached_file($attachment['ID']);
				$attach_ext = pathinfo($attach_path, PATHINFO_EXTENSION);

				$evt_type = "CTA";

				if (strpos(get_the_title(),'SecureMail') !== false) {
					$evt_type = "SecureMail Demo Webinar";
				}

				?>

				<div class="date_author">
					<p class="date">
						<?php the_date('F j, Y'); ?>
					</p>
				</div>
				<div class="clearfix"></div>
        <h4><a href="<?php the_permalink(); ?>"<?php if ($term->name === "Webcasts") { ?> data-track-event="<?php echo esc_attr($evt_type); ?>" data-event-action="Banner" data-event-label="<?php echo esc_attr(get_the_title()); ?>"<?php } ?>><?php the_title(); ?></a></h4>

				<p>
					<?php echo $desc; ?>
				</p>

				<?php if ($attachment): ?>
					<p class="file_info">
						<span class="file_icon <?php echo $attach_ext; ?>"><?php echo $attach_ext; ?></span>
						(<?php echo $size; ?>)
						<?php if (is_user_logged_in()): ?>
              <a href="<?php echo $attachment['guid']; ?>"<?php if ($term->name === "Webcasts") { ?> data-track-event="<?php echo esc_attr($evt_type); ?>" data-event-action="Download" data-event-label="<?php echo esc_attr(get_the_title()); ?>"<?php } ?>>download</a>
						<?php endif; ?>
					</p>
				<?php endif; ?>

			<?php endwhile; endif; ?>

			<div class="pagination">
				<div class="prev">
					<?php previous_posts_link(); ?>
				</div>
				<div class="next">
					<?php next_posts_link(); ?>
				</div>
			</div>

		</div>

		<?php get_sidebar('library'); ?>

	</div>


<?php get_footer(); ?>
