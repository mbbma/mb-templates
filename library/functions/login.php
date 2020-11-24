<?php
	/* Login page aanpassingen */
	//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
	function mbbma_login_css() {
		wp_enqueue_style( 'mbbma_login_css', get_template_directory_uri() . '/library/css/login.css', false );
	}

	// changing the alt text on the logo to show your site name
	function mbbma_login_title() { return get_option( 'blogname' ); }

	// changing the logo link from wordpress.org to your site
	function mbbma_login_url() {  return home_url(); }

	// calling it only on the login page
	add_action( 'login_enqueue_scripts', 'mbbma_login_css', 10 );
	add_filter( 'login_headertitle', 'mbbma_login_title' );
	add_filter( 'login_headerurl', 'mbbma_login_url' );
?>
