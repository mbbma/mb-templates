<?php
//[recent_bericht number_of_results="-1"]
function recent_bericht_func( $atts ){
	// Het standaard aantal resultaten is 1
	$a = shortcode_atts( array(
		'number_of_results' => 1,
	), $atts );


	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'category_name' => 'actueel',
		'posts_per_page' => $a['number_of_results'],
	);
	$query = new WP_Query($args);

	// Voor elk resultaat wordt er een nieuw blok aangemaakt
	$html = '';


	if( $query->have_posts() ):
		while ($query->have_posts()) : $query->the_post();
			$html .= '
				<a href="' . get_permalink() . '" title="Arcabo - ' . get_the_title() . '" class="block">
					<div class="image">
						<img src="' . get_the_post_thumbnail_url(get_the_ID(),'full') . '" alt="' . get_the_title() . '">
					</div>
					<div class="content">
						<h3>' . get_the_title() . '</h3>
						<div class="date">
							' . get_the_date() . '
						</div>
						<div class="arrow">
							<i class="fa fa-angle-right" aria-hidden="true"></i>
						</div>
					</div>
				</a>
			';
		endwhile;
	endif;

	wp_reset_query();

	return $html;
}
add_shortcode( 'recent_bericht', 'recent_bericht_func' );

//[contact_link detail='Variabele']
function contact_link_func( $atts ){
	// Het standaard aantal resultaten is 1
	$a = shortcode_atts( array(
		'detail' => '',
	), $atts );


	$args = array(
		'post_type' => 'page',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => '_wp_page_template',
				'value' => 'page-contact.php',
			)
		)
	);
	$query = new WP_Query($args);

	// Voor elk resultaat wordt er een nieuw blok aangemaakt
	$html = '';


	if( $query->have_posts() ):
		while ($query->have_posts()) : $query->the_post();
			if( have_rows('contactdetails') ):
				while( have_rows('contactdetails') ) : the_row();
					if ($a['detail'] == get_sub_field('contactdetails_var')) {
						$html .= get_sub_field('contactdetails_link');
					}
				endwhile;
			endif;
		endwhile;
	endif;

	wp_reset_query();

	return $html;
}
add_shortcode( 'contact_link', 'contact_link_func' );

//[contact_text detail='Variabele']
function contact_text_func( $atts ){
	// Het standaard aantal resultaten is 1
	$a = shortcode_atts( array(
		'detail' => '',
	), $atts );

	$args = array(
		'post_type' => 'page',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => '_wp_page_template',
				'value' => 'page-contact.php',
			)
		)
	);
	$query = new WP_Query($args);

	// Voor elk resultaat wordt er een nieuw blok aangemaakt
	$html = '';

	if( $query->have_posts() ):
		while ($query->have_posts()) : $query->the_post();
			if( have_rows('contactdetails') ):
				while( have_rows('contactdetails') ) : the_row();
					if ($a['detail'] == get_sub_field('contactdetails_var')) {
						$html .= get_sub_field('contactdetails_text');
					}
				endwhile;
			endif;
		endwhile;
	endif;

	wp_reset_query();

	return $html;
}
add_shortcode( 'contact_text', 'contact_text_func' );
?>