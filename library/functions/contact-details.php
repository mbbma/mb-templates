<?php
	function contactDetails( $atts ){
		$a = shortcode_atts( array(
			'detail' => '',
		), $atts );

		$contactDetails = get_field('contact_details', 'options')[$a['detail']];
		
		return $contactDetails;
	}
	// Also add it as a shortcode: [contact_detail detail='phone']
	add_shortcode( 'contact_detail', 'contactDetails' );
?>
