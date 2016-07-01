<?php 

$shortname = "datamotion";

// Nav Menu Walker Classes
include("includes/walkers/walker_title_item.php");
include("includes/walkers/walker_info_buttons.php");

// Front End JavaScripts
include("includes/functions/scripts.php");

// Misc Utility Functions
include("includes/functions/utilities.php");

// Theme Options in Admin
include("includes/functions/options.php");

// WordPress Nav Menus
include("includes/functions/nav_menus.php");

// Post Thumbnails and Image Sizes
include("includes/functions/image_sizes.php");

// Twitter Functions
include("includes/functions/twitter.php");

// Front End Functions
include("includes/functions/front_end.php");

// Shortcodes
include("includes/functions/shortcodes.php");

// Customize standard WordPress login form
include("includes/functions/login_form.php");

// Pods API Hooks
include("includes/functions/pods.php");
?>
