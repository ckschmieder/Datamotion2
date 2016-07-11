<?php
/**
 * @package Wordpress
 * @subpackage DataMotion_Theme
 */

// Social Links
$facebook_link = get_option('dm_social_facebook');
$linkedin_link = get_option('dm_social_linkedin');
$twitter_link = get_option('dm_social_twitter');
$youtube_link = get_option('dm_social_youtube');
$email_link = get_option('dm_social_email');
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js ie lt-ie9"> <![endif]-->
<!--[if IE 9]>    	   <html class="no-js ie lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->




<head>

	<title><?php wp_title('//', true, 'left'); ?> <?php bloginfo('name'); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<?php wp_head(); ?>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico">
	<link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" type="image/ico">


	<!-- TypeKit -->
	<script type="text/javascript" src="//use.typekit.net/tfv1nxp.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	<!-- Feed Autodiscovery -->
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="RSS 2.0">
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>">
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>">

	<!--[if lt IE 9]>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/js/html5shiv.js"></script>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/js/selectivizr-min.js"></script>
	<![endif]-->
	<link rel="author" href="https://plus.google.com/111376157391593599628/posts"/>

  <!--Start of Zopim Live Chat Script-->
  <script type="text/javascript">
  window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
  d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
  _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
  $.src='//v2.zopim.com/?2JFpfbtgh8i6gDmfdF1jd2YxO46Uh683';z.t=+new Date;$.
  type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
  </script>
  <!--End of Zopim Live Chat Script-->
</head>


<body>

  <!-- ClickTale Top part -->
  <script type="text/javascript">
    var WRInitTime=(new Date()).getTime();
  </script>
  <!-- ClickTale end of Top part -->

	<div class="container" id="nav_contain">
		<div class="row" id="search">
			<div class="search_contain">
				<span class="header_phone"><a href="/about-us/contact-us">1-800-672-7233</a></span>
				<?php get_search_form(); ?>
				<a href="https://ssl.datamotion.com/" class="account" data-track-event="Login" data-event-action="Click" data-event-label="My Account Link">My Account</a>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row" id="navigation">

			<nav>
				<div class="mobile_phone_account">
					<a href="https://ssl.datamotion.com/" class="account" data-track-event="Login" data-event-action="Click" data-event-label="Mobile My Account Link">My Account</a>
					<span class="header_phone">1-800-672-7233</span>
				</div>

				<div class="logo">
					<a href="/"><div class="datamotion_logo">DataMotion</div></a>
				</div>
				<div class="row" id="mobile_social_and_drop">
					<div id="mobile_nav_icon" class="mobile_nav_drop_icon"></div>
					<div class="clearfix"></div>
					<div class="mobile_navigation">
						<?php wp_nav_menu(array('items_wrap' => '%3$s', 'theme_location' => 'header-menu', 'walker' => new Walker_Title_Item())); ?>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="main_menu_contain">
					<?php wp_nav_menu(array('items_wrap' => '%3$s', 'theme_location' => 'header-menu')); ?>
				</div>
			</nav>
		</div>
	</div>

	<div class="container" id="main">













