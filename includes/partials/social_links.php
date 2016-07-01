<?php
/**
 * Social Links Partial
 */

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
