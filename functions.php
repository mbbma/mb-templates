<?php
	/*
		Author: Alex van Mosel
		URL: http://www.mbbma.nl
	*/

	// Required classes
	require_once('library/classes/title.php');
	require_once('library/classes/button.php');

	// Required functions
	require_once('library/functions/acf-blocks.php');
	require_once('library/functions/acf-options-page.php');
	require_once('library/functions/cleanup.php');
	require_once('library/functions/contact-details.php');
	require_once('library/functions/enqueueing.php');
	require_once('library/functions/login.php');
	require_once('library/functions/pagination.php');
	require_once('library/functions/randomness.php');
	require_once('library/functions/theme-support.php');
	require_once('library/functions/user-roles.php');

	function mbbma_setup() {
		// let's get language support going, if you need it
		load_theme_textdomain( 'mbbma', get_template_directory() . '/library/translation' );

		// launching operation cleanup
		add_action( 'init', 'mbbma_head_cleanup' );
		// A better title
		add_filter( 'wp_title', 'rw_title', 10, 3 );
		// remove WP version from RSS
		add_filter( 'the_generator', 'mbbma_rss_version' );
		// remove pesky injected css for recent comments widget
		add_filter( 'wp_head', 'mbbma_remove_wp_widget_recent_comments_style', 1 );
		// clean up comment styles in the head
		add_action( 'wp_head', 'mbbma_remove_recent_comments_style', 1 );

		// enqueue base scripts and styles
		add_action( 'wp_enqueue_scripts', 'mbbma_scripts_and_styles', 999 );

		// launching this stuff after theme setup
		mbbma_theme_support();

		// cleaning up random code around images
		add_filter( 'the_content', 'mbbma_filter_ptags_on_images' );
		// cleaning up excerpt
		add_filter( 'excerpt_more', 'mbbma_excerpt_more' );
	}

	// let's get this party started
	add_action( 'after_setup_theme', 'mbbma_setup' );	


	// Custom template tags for this theme.
	require get_template_directory() . '/library/inc/template-tags.php';

	// Custom functions that act independently of the theme templates.
	require get_template_directory() . '/library/inc/extras.php';

	// Load Woocommerce compatibility file.
	//require get_template_directory() . '/library/inc/woocommerce.php';
?>