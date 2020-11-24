<?php
	// Add a custom block category
	function mb_block_category( $categories, $post ) {
		return array_merge(
			$categories,
			array(
				array(
					'slug' => 'mb-blocks',
					'title' => __('MB blokken', 'mb-blocks'),
				),
			)
		);
	}
	add_filter( 'block_categories', 'mb_block_category', 0, 2 );

	// https://www.advancedcustomfields.com/resources/blocks/
	function register_acf_block_types() {
		acf_register_block_type(array(
			'name'				=> 'contact',
			'title'				=> __('Contact'),
			'description'		=> __(''),
			'render_template'	=> 'blocks/contact.php',
			'category'			=> 'mb-blocks',
			'icon'				=> 'admin-comments',
			'mode'				=> 'edit',
			'keywords'			=> array('MB blocks'),
		));
		acf_register_block_type(array(
			'name'				=> 'content-image',
			'title'				=> __('Content met afbeelding'),
			'description'		=> __(''),
			'render_template'	=> 'blocks/content-image.php',
			'category'			=> 'mb-blocks',
			'icon'				=> 'admin-comments',
			'mode'				=> 'edit',
			'keywords'			=> array('MB blocks'),
		));
		acf_register_block_type(array(
			'name'				=> 'centered-content',
			'title'				=> __('Gecentreerde content'),
			'description'		=> __(''),
			'render_template'	=> 'blocks/centered-content.php',
			'category'			=> 'mb-blocks',
			'icon'				=> 'admin-comments',
			'mode'				=> 'edit',
			'keywords'			=> array('MB blocks'),
		));
		acf_register_block_type(array(
			'name'				=> 'faq',
			'title'				=> __('Veelgestelde vragen'),
			'description'		=> __(''),
			'render_template'	=> 'blocks/faq.php',
			'category'			=> 'mb-blocks',
			'icon'				=> 'admin-comments',
			'mode'				=> 'edit',
			'keywords'			=> array('MB blocks'),
		));
	}
	if( function_exists('acf_register_block_type') ) {
		add_action('acf/init', 'register_acf_block_types');
	}

	// Bepaald de padding voor een block
	function blockPadding($cf){
		switch ($cf) {
			case 'Ruimte boven & onder':
				$padding = 'pad-both';
				break;
		
			case 'Ruimte boven':
				$padding = 'pad-top';
				break;
		
			case 'Ruimte onder':
				$padding = 'pad-bottom';
				break;
			
			default:
				$padding = '';
				break;
		}
		return $padding;
	}
?>
