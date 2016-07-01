<?php
/**
 * DataMotion Navigation Menus
 */

function register_my_menus() {
  register_nav_menus(
	  array(
		  'header-menu'  => 'Header Menu',
		  'info-buttons' => 'Info Buttons',
		  'info-new' => 'Info Buttons New',
		  'slider-links' => 'Slider Links',
		  'footer-links' => 'Footer Links',
		  'cta-menu' => 'CTA Menu',
	  )
  );
}
add_action( 'init', 'register_my_menus' );
?>
