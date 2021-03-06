<?php
/**
 * DataMotion Theme JavaScripts
 */
 
add_action( 'wp_enqueue_scripts', 'mytheme_load_modified_bootstrap' );

function dm_enqueue_scripts() {
	$template_uri = get_template_directory_uri();
	$scripts = array(
		'matchmedia-polyfill' => array(
			'src'     => "$template_uri/js/matchMedia.js",
			'deps'    => false,
			'version' => '1',
			'footer'  => false
		),
		'modernizr' => array(
			'src'     => "$template_uri/js/modernizr.min.js",
			'deps'    => false,
			'version' => '2.6.2',
			'footer'  => false,
		),
		'modernizr-tests' => array(
			'src'     => "$template_uri/js/modernizr-tests.js",
			'deps'    => array('matchmedia-polyfill', 'modernizr'),
			'version' => '0.1',
			'footer'  => false,
		),
		'jquery-19' => array(
			'src'     => "$template_uri/js/jquery-1.9.1.js",
			'deps'    => false,
			'version' => '1.9.1',
			'footer'  => true,
		),
		'jquery-migrate' => array(
			'src'     => "$template_uri/js/jquery-migrate-1.1.1.js",
			'deps'    => array('jquery-19'),
			'version' => '1.1.1',
			'footer'  => true,
		),
		'jquery-ui-effects' => array(
			'src'     => "$template_uri/js/jquery-ui-1.10.1.custom.js",
			'deps'    => array('jquery-19'),
			'version' => '1.10.1',
			'footer'  => true,
		),
		'jquery-hoverintent' => array(
			'src'     => "$template_uri/js/jquery.hoverIntent.js",
			'deps'    => array('jquery-19'),
			'version' => 'r6',
			'footer'  => true,
		),
		'jquery-flexslider' => array(
			'src'     => "$template_uri/js/jquery.flexslider.js",
			'deps'    => array('jquery-19'),
			'version' => '2.1',
			'footer'  => true,
		),
		'jquery-fancybox' => array(
			'src'     => "$template_uri/js/jquery.fancybox-1.3.4.js",
			'deps'    => array('jquery-19'),
			'version' => '1.3.4',
			'footer'  => true,
		),
		'jquery-form-validation' => array(
			'src'     => "$template_uri/js/jquery.form-validation.js",
			'deps'    => array('jquery-19'),
			'version' => '0.1',
			'footer'  => true,
		),
		'jquery-imagesloaded' => array(
			'src'     => "$template_uri/js/jquery.imagesloaded.js",
			'deps'    => array('jquery-19'),
			'version' => '2.1.1',
			'footer'  => true,
		),
		'jquery-fitvids' => array(
			'src'     => "$template_uri/js/jquery.fitvids.js",
			'deps'    => array('jquery-19'),
			'version' => '1.0',
			'footer'  => true,
		),
		'jquery-cookie' => array(
			'src'     => "$template_uri/js/jquery.cookie.js",
			'deps'    => array('jquery-19'),
			'version' => '1.3.1',
			'footer'  => true,
		),
		'dm-main' => array(
			'src'     => "$template_uri/js/main.js",
			'deps'    => array(
				'jquery-19',
				'jquery-ui-effects',
				'jquery-hoverintent',
				'jquery-flexslider',
				'jquery-fancybox',
				//'jquery-form-validation',
				'jquery-imagesloaded',
				'jquery-fitvids',
				'jquery-cookie',
			),
			'version' => '0.1',
			'footer'  => true,
		),
		'dm-master' => array(
			'src'     => "$template_uri/js/master.js",
			'deps'    => false,
			'version' => '0.1',
			'footer'  => true,
		),
		'dm-events' => array(
			'src'     => "$template_uri/js/events.js",
			'deps'    => false,
			'version' => '0.1',
			'footer'  => true,
		),
	);

	// Register Scripts
	foreach ($scripts as $name => $info) {
		wp_register_script($name, $info['src'], $info['deps'], $info['version'], $info['footer']);
	}
	/*wp_register_script( 'lander-scripts', get_template_directory_uri() . '/builds/development/js/home-script.js' );*/

	wp_enqueue_script('modernizr-tests');
	//wp_enqueue_script('jquery-migrate');
	//wp_enqueue_script('dm-main');
	wp_enqueue_script('dm-master'); // Enqueue this in production instead of dm-main
	wp_enqueue_script('dm-events');

	/*if ( wp_script_is( 'lander-script', 'registered' ) ) {
        // ...deregister it first...
        wp_deregister_style( 'lander-script' );
        // ...and re-register it with our own, modified bootstrap-main.css...
        wp_register_style( 'lander-script', get_template_directory_uri() . '/builds/development/js/home-script.js' );

    }*/

	if ( is_front_page() ) {
		// wp_enqueue_script( 'slick-carousel-script', 'http://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js' );
		wp_enqueue_script( 'slick-script', 'https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js', array ( 'jquery' ), null, true);
		wp_enqueue_script( 'typed-script', 'https://cdn.rawgit.com/mattboldt/typed.js/master/dist/typed.min.js', array ( 'jquery' ), null, true);
		wp_enqueue_script( 'wow-script', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', false, null, flase);
		wp_enqueue_script( 'lander-script', get_template_directory_uri() . '/builds/development/js/home-script.js', array('jquery'), null, true);

	}
}
add_action('wp_enqueue_scripts', 'dm_enqueue_scripts');


function dm_enqueue_styles() {
	$template_uri = get_template_directory_uri();
	$styles = array(
		'dm-print' => array(
			'src'     => "$template_uri/stylesheets/print.css",
			'deps'    => false,
			'version' => '0.1',
			'media'   => 'print',
		),
		'dm-flexslider' => array(
			'src'     => "$template_uri/stylesheets/flexslider.css",
			'deps'    => false,
			'version' => '2.1',
			'media'   => 'screen'
		),
		'dm-fancybox' => array(
			'src'     => "$template_uri/stylesheets/jquery.fancybox-1.3.4.css",
			'deps'    => false,
			'version' => '1.3.4',
			'media'   => 'screen'
		),
		'dm-style' => array(
			'src'     => "$template_uri/style.css",
			'deps'    => array(
				'dm-print',
				'dm-flexslider',
				'dm-fancybox'
			),
			'version' => '0.1',
			'media'   => 'screen'
		),
	);

	foreach ($styles as $name => $info) {
		wp_register_style($name, $info['src'], $info['deps'], $info['version'], $info['media']);
	}

	wp_enqueue_style('dm-style');
	
	wp_register_style( 'font-awesome', 'https:////maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
	wp_register_style( 'slick-carousel', 'https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css' );
	wp_register_style( 'slick-carousel-theme', 'https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css' );
	// wp_register_style( 'lander-styles', get_template_directory_uri() . '/builds/development/css/home-style.css', array('font-awesome', 'slick-carousel', 'slick-carousel-theme' ), '0.1', 'screen' );

	if ( is_front_page() ) {
		wp_enqueue_style('font-awesome'); 
		wp_enqueue_style('slick-carousel'); 
		wp_enqueue_style('slick-carousel-theme'); 
		wp_enqueue_style( 'lander-styles', get_template_directory_uri() . '/builds/development/css/home-style.css', array('font-awesome', 'slick-carousel', 'slick-carousel-theme' ), null, 'screen' );
		
	}
}
add_action('wp_enqueue_scripts', 'dm_enqueue_styles');

?>
    