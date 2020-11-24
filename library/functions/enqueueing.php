<?php
	function mbbma_scripts_and_styles() {
		global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
	
		if (!is_admin()) {
			// register main stylesheet
			wp_register_style( 'mbbma-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), filemtime( get_stylesheet_directory().'/library/css/style.css' ), 'all' );
			
			wp_deregister_script('jquery');
			wp_register_script( 'jquery', get_stylesheet_directory_uri() . '/library/js/libs/jquery-min.js', array(), filemtime ( get_stylesheet_directory(). '/library/js/libs/jquery-min.js'), false );
	
			// comment reply script for threaded comments
			if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
				wp_enqueue_script( 'comment-reply' );
			}
	
			//adding scripts file in the footer
			wp_register_script( 'mbbma-js', get_stylesheet_directory_uri() . '/library/js/all-min.js', array(), filemtime ( get_stylesheet_directory(). '/library/js/all-min.js'), true );
			// enqueue styles and scripts
	
			wp_enqueue_style( 'mbbma-stylesheet' );
	
			/*
			I recommend using a plugin to call jQuery
			using the google cdn. That way it stays cached
			and your site will load faster.
			*/
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'mbbma-js' );
		}
	}
?>
