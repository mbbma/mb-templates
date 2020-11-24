<?php
	// Get all active forms for pop-ups to pop-ups option page
	function load_popups_forms( $field ) {
		// reset choices
		$field['choices'] = array();


		$myforms = RGFormsModel::get_forms();
			foreach ($myforms as $myform) {
				if($myform ->is_active){
					$value = $myform->id;
					$label = $myform->title;

					// append to choices
					$field['choices'][ $value ] = $label;
				}
		}

		// return the field
		return $field;
	}
	add_filter('acf/load_field/name=pop_up_form', 'load_popups_forms');

	// Get the pop-ups from pop-ups option page to the blocks
	function load_popups_names( $field ) {
		// reset choices
		$field['choices'] = array();

		if( have_rows('pop_ups_group', 'option') ):
			while( have_rows('pop_ups_group', 'option') ) : the_row();
				if( have_rows('pop_ups_repeater', 'option') ):
					while( have_rows('pop_ups_repeater', 'option') ) : the_row();
						$value = strtolower(str_replace(" ", "-", get_sub_field('pop_up_name')));
						$label = get_sub_field('pop_up_name');
						// append to choices
						$field['choices'][ $value ] = $label;
					endwhile;
				endif;
			endwhile;
		endif;
		// return the field
		return $field;
	}
	add_filter('acf/load_field/name=button_popup', 'load_popups_names');


	add_action('wp_ajax_load_popups_by_ajax', 'load_popups_by_ajax_callback');
	add_action('wp_ajax_nopriv_load_popups_by_ajax', 'load_popups_by_ajax_callback');

	function load_popups_by_ajax_callback() {
		$popups = $_POST['popups'];

		$popupsArray[] = explode(",", $popups);
		$count = 0;
		if( have_rows('pop_ups_group', 'option') ):
			while (have_rows('pop_ups_group', 'option')) : the_row();
				if( have_rows('pop_ups_repeater', 'option') ):
					while (have_rows('pop_ups_repeater', 'option')) : the_row();
						if (in_array(strtolower(str_replace(" ", "-", get_sub_field('pop_up_name'))), $popupsArray[0])) {
							echo '<div class="popup" data-name="'.strtolower(str_replace(" ", "-", get_sub_field('pop_up_name'))).'">
									<div class="close">
										<div class="line first-line"></div>
										<div class="line last-line"></div>
									</div>
									<div class="content">
										<div class="text-center">
											<h3 class="h2">
												'.get_sub_field('pop_up_title').'
											</h3>
											<div class="form">
												'.do_shortcode('[gravityform id="'.get_sub_field('pop_up_form')['value'].'" title="false" description="false" ajax="true"]').'
											</div>
										</div>
									</div>
								</div>';
						}
						$count++;
					endwhile;
				endif;
			endwhile;
		endif;

		die();
	}
?>
