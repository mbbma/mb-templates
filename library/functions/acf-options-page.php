<?php
	if(function_exists('acf_add_options_page')){
		acf_add_options_page(
			array(
				'page_title' 	=> 'Basisgegevens',
				'menu_title'	=> 'Basisgegevens',
				'menu_slug' 	=> 'basisgegevens',
				'capability'	=> 'edit_posts',
				'redirect'		=> false
			)
		);
		acf_add_options_page(
			array(
				'page_title' 	=> 'Pop-ups',
				'menu_title'	=> 'Pop-ups',
				'menu_slug' 	=> 'popups',
				'capability'	=> 'edit_posts',
				'icon_url'      => 'dashicons-feedback',
				'redirect'		=> false
			)
		);
	}
?>
