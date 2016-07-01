<?php
/**
 * Login Form Customizations
 */

// Custom logo
function dm_login_custom_logo() {
	$logo = get_bloginfo('stylesheet_directory') . '/images/datamotion_logo.png';
?>
	<style type="text/css">
	body.login div#login h1 a {
		background-image: url(<?php echo $logo; ?>);
		background-size: 282px 59px;
	}
	</style>
<?php
}
add_action('login_enqueue_scripts', 'dm_login_custom_logo');

// Make logo link to main DataMotion site
function dm_login_logo_url() {
	return get_bloginfo('url');
}
add_filter('login_headerurl', 'dm_login_logo_url');

// Custom logo link title
function dm_login_logo_title() {
	return 'DataMotion';
}
add_filter('login_headertitle', 'dm_login_logo_title');

// IP address whitelist for the Limit Login Attempts plugin
function dm_ip_whitelist($ip, $allow) {
  return ($ip == '173.54.184.25') ? true : $allow;
}
add_filter('limit_login_whitelist_ip', 'dm_ip_whitelist', 10, 2);

?>
