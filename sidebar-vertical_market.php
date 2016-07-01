<?php
global $post;

if (is_page()) {
	$pod = pods('page', $post->ID);
} elseif (is_single()) {
	$pod = pods('post', $post->ID);
}

if (isset($pod)) {
	$sidebar_code = $pod->field('sidebar_content');
}

?>
<div id="sidebar" class="first column">
	
	<div class="sidebar-text"><?php echo $GLOBALS['page_content']; ?></div>

	<?php if ($sidebar_code): ?>
		<?php echo do_shortcode($sidebar_code); ?>
	<?php endif; ?>

	<?php 
		$show_contact = get_field('enable_contact');
		if ($show_contact) { ?>
	<div class="vertical-contact-header">Contact Sales</div>
	<div class="vertical-contact">
		<?php 
		$image = get_field('headshot');
		if( !empty($image) ) { ?>
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
		<?php } ?>
		<div class="vertical-contact-details">
			<div class="name"><?php the_field('contact_name') ?></div>
			<div class="title"><?php the_field('contact_title') ?></div>
			<div class="phone"><?php the_field('contact_phone') ?></div>
			<div class="email"><a href="mailto:<?php the_field('contact_email') ?>"><?php the_field('contact_email') ?></a></div>
			<?php 
				$show_link = get_field('add_contact_link');
				if ($show_link) { ?>
					<div class="link"><a href="<?php the_field('contact_link') ?>"><?php the_field('contact_link_text') ?></a></div>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
	<?php 
		if (get_field('supplemental_text') != "") { ?>
			<div class="supplemental-text"><?php the_field('supplemental_text'); ?></div>
	<?php } ?>

</div>
