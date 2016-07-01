<?php
/**
 * DataMotion Twitter Feed Functions
 */

$oauth_lib = dirname(__FILE__);
$oauth_lib .= '/../twitter/twitteroauth.php';
require_once($oauth_lib);

// Get Twitter timeline and cache it for 5 minutes to cut down on API requests
function get_twitter_timeline() {
	$timeline = get_transient('dm_twitter_timeline');

	if ($timeline) {
		return $timeline;
	}

	$refresh_delay   = get_option('dm_twitter_refresh_delay') ? (int)(get_option('dm_twitter_refresh_delay') * 60) : 600;
	$num_tweets      = get_option('dm_twitter_num_tweets');
	$username        = get_option('dm_twitter_username');
	$consumer_token  = get_option('dm_twitter_consumer_token');
	$consumer_secret = get_option('dm_twitter_consumer_secret');
	$access_token    = get_option('dm_twitter_access_token');
	$access_secret   = get_option('dm_twitter_access_secret');

	if ($username && $consumer_token && $consumer_secret && $access_token && $access_secret) {
		$oauth = new TwitterOAuth($consumer_token, $consumer_secret, $access_token, $access_secret);
		$timeline = $oauth->get('statuses/user_timeline', array(
			'screen_name'     => $username,
			'exclude_replies' => true,
			'count'           => $num_tweets,
		));

		set_transient('dm_twitter_timeline', $timeline, $refresh_delay);
		return $timeline;
	} else {
		return false;
	}
}

?>
