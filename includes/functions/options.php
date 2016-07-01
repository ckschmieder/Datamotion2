<?php
/**
 * DataMotion Theme Options Functions
 */

function dm_theme_options_admin_menu() {
	add_theme_page('Theme Options', 'Theme Options', 'edit_themes', basename(__FILE__), 'dm_theme_options');
}
add_action('admin_menu', 'dm_theme_options_admin_menu');

function dm_update_theme_options() {
	// Flush cached data
	delete_transient('dm_twitter_timeline');
	delete_transient('dm_contact_info');

	// Homepage
	update_option('dm_homepage_news_count', $_POST['homepage_news_count']);
	update_option('dm_homepage_blog_count', $_POST['homepage_blog_count']);
	update_option('dm_homepage_alert_speed', $_POST['homepage_alert_speed']);

	// Social Links
	update_option('dm_social_facebook', $_POST['social_facebook']);
	update_option('dm_social_linkedin', $_POST['social_linkedin']);
	update_option('dm_social_twitter', $_POST['social_twitter']);
	update_option('dm_social_youtube', $_POST['social_youtube']);
	update_option('dm_social_email', $_POST['social_email']);

	// Twitter API
	update_option('dm_twitter_refresh_delay', $_POST['twitter_refresh_delay']);
	update_option('dm_twitter_num_tweets', $_POST['twitter_num_tweets']);
	update_option('dm_twitter_username', $_POST['twitter_username']);
	update_option('dm_twitter_consumer_token', $_POST['twitter_consumer_token']);
	update_option('dm_twitter_consumer_secret', $_POST['twitter_consumer_secret']);
	update_option('dm_twitter_access_token', $_POST['twitter_access_token']);
	update_option('dm_twitter_access_secret', $_POST['twitter_access_secret']);

	// Company Info
	update_option('dm_company_name', $_POST['company_name']);
	update_option('dm_company_address', $_POST['company_address']);
	update_option('dm_company_phone_1', $_POST['company_phone_1']);
	update_option('dm_company_phone_2', $_POST['company_phone_2']);
	update_option('dm_company_fax', $_POST['company_fax']);
	update_option('dm_company_map_link', $_POST['company_map_link']);
	update_option('dm_company_portland_address', $_POST['company_portland_address']);
	update_option('dm_company_portland_map_link', $_POST['company_portland_map_link']);
}

function dm_theme_options() {
	if (isset($_POST['dm_update_options'])) {
		$dm_updated = true;
		dm_update_theme_options();
	}
?>
<style type="text/css">
fieldset.dm-fieldset {
	width: 400px;
	float: left;
}
.dm-field label {
	font-weight: bold;
}
button.button {
	clear: both;
	float: right;
}
</style>
<div class="wrap">
	<div id="icon-themes" class="icon32"><br></div>
	<h2>DataMotion Theme Options</h2>

	<?php if ($dm_updated): ?>
		<div id="message" class="updated below-h2">
			<p>Options Updated!</p>
		</div>
	<?php endif; ?>

	<form action="" method="post">
		<input type="hidden" name="dm_update_options" value="true">

		<fieldset id="company-info" class="dm-fieldset">
			<h3>Company Info</h3>
			<?php dm_options_input('text', 'company_name', 'Company Name'); ?>
			<?php dm_options_input('text', 'company_address', 'Company Address'); ?>
			<?php dm_options_input('text', 'company_phone_1', 'Company Phone (Toll Free)'); ?>
			<?php dm_options_input('text', 'company_phone_2', 'Company Phone (Local)'); ?>
			<?php dm_options_input('text', 'company_fax', 'Company Fax'); ?>
			<?php dm_options_input('text', 'company_map_link', 'Map Link'); ?>
			<?php dm_options_input('text', 'company_portland_address', 'Portland Office Address'); ?>
			<?php dm_options_input('text', 'company_portland_map_link', 'Portland Office Map Link'); ?>
		</fieldset>

		<fieldset id="post-counts" class="dm-fieldset">
			<h3>Homepage Configuration</h3>
			<?php dm_options_input('text', 'homepage_news_count', 'News &amp; Events Post Count'); ?>
			<?php dm_options_input('text', 'homepage_blog_count', 'Blog Post Count'); ?>
			<?php dm_options_input('text', 'homepage_alert_speed', 'Alert Cycle Speed (in seconds)'); ?>
		</fieldset>

		<fieldset id="social-links" class="dm-fieldset">
			<h3>Social Links</h3>
			
			<?php dm_options_input('text', 'social_facebook', 'Facebook'); ?>
			<?php dm_options_input('text', 'social_linkedin', 'LinkedIn'); ?>
			<?php dm_options_input('text', 'social_twitter', 'Twitter'); ?>
			<?php dm_options_input('text', 'social_youtube', 'YouTube'); ?>
			<?php dm_options_input('text', 'social_email', 'E-mail'); ?>
		</fieldset>

		<fieldset id="twitter-api" class="dm-fieldset">
			<h3>Twitter API</h3>

			<?php dm_options_input('text', 'twitter_refresh_delay', 'Tweet Cache Time (in minutes)'); ?>
			<?php dm_options_input('text', 'twitter_num_tweets', 'Number of Tweets to Show'); ?>
			<?php dm_options_input('text', 'twitter_username', 'Twitter Username'); ?>
			<?php dm_options_input('text', 'twitter_consumer_token', 'OAuth Consumer Token'); ?>
			<?php dm_options_input('text', 'twitter_consumer_secret', 'OAuth Consumer Secret'); ?>
			<?php dm_options_input('text', 'twitter_access_token', 'OAuth Access Token'); ?>
			<?php dm_options_input('text', 'twitter_access_secret', 'OAuth Access Secret'); ?>
		</fieldset>

		<p>
			<button class="button button-primary button-large" type="submit">Save Options</button>
		</p>
	</form>
</div>
<?php
}

function dm_options_input($type, $name, $label) {
	$id = str_replace('_', '-', $name);
	$value = get_option("dm_$name");
?>
<p class="dm-field">
	<label for="<?php echo $id; ?>"><?php echo $label; ?></label>
	<br>
	<input type="<?php echo $type; ?>" name="<?php echo $name; ?>" id="<?php echo $id; ?>" value="<?php echo $value; ?>">
</p>
<?php
}


?>
