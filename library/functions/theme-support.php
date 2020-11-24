<?php
	function mbbma_theme_support() {
		// wp thumbnails
		add_theme_support('post-thumbnails');
		// add_image_size('custom-thumbnail', 574, 225, true);
	
		// wp menus
		add_theme_support('menus');
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'mbbma' ),
				'sitemap' => __( 'Sitemap', 'mbbma' )
			)
		);
	
		// Setup the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'mbbma_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);
	
	
		// rss
		add_theme_support('automatic-feed-links');
	
		// Enable support for HTML5 markup.
		add_theme_support(
			'html5',
			array(
				'comment-list',
				'search-form',
				'comment-form'
			)
		);
	}
?>
