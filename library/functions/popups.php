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

// Adding GLOBAL VAR
function add_global_popup_var() {
	global $popups;
	$popups = [];
	global $popups_names;
	$popups_names = [];
	global $popups_forms_ids;
	$popups_forms_ids = [];
}
add_action( 'after_setup_theme', 'add_global_popup_var' );

// Adding GLOBAL VAR
function add_global_popup($popup_name) {
	global $popups;
	global $popups_names;
	global $popups_forms_ids;


	if( have_rows('pop_ups_group', 'option') ):
		while (have_rows('pop_ups_group', 'option')) : the_row();
			if( have_rows('pop_ups_repeater', 'option') ):
				while (have_rows('pop_ups_repeater', 'option')) : the_row();
					if (strtolower(str_replace(" ", "-", get_sub_field('pop_up_name'))) == $popup_name) {
						if(!in_array(strtolower(str_replace(" ", "-", get_sub_field('pop_up_name'))), $popups_names, true)){
							if(!in_array(get_sub_field('pop_up_form'),$popups_forms_ids)){
								$popups_temp = [
									'popup_name' 	=>	strtolower(str_replace(" ", "-", get_sub_field('pop_up_name'))),
									'title' 		=> 	get_sub_field('pop_up_title'),
									'form_id'		=>	get_sub_field('pop_up_form'),
									'multi-titles'	=>	false,
								];
								$popups[] = $popups_temp;
								$popups_names[] = strtolower(str_replace(" ", "-", get_sub_field('pop_up_name')));
								$popups_forms_ids[] = get_sub_field('pop_up_form');
							}else{
								$popups_temp = [
									'popup_name' 	=>	strtolower(str_replace(" ", "-", get_sub_field('pop_up_name'))),
									'title' 		=> 	get_sub_field('pop_up_title'),
									'form_id'		=>	get_sub_field('pop_up_form'),
									'multi-titles'	=>	true,
								];
								$popups[] = $popups_temp;
								$popups_names[] = strtolower(str_replace(" ", "-", get_sub_field('pop_up_name')));
								$popups_forms_ids[] = get_sub_field('pop_up_form');
							}
						}
					}
				endwhile;
			endif;
		endwhile;
	endif;
}


function footer_popups(){
	
	// VARS
	global $popups;
    $multi_popup = [];
    $popups_multi_forms_ids = [];
	$multi_popups_counter = 1;
	

	if($popups):
		foreach($popups as $key => $popup):
			if($popup['multi-titles']){
				$form_id = $popup['form_id'];
				foreach($popups as $key => $popup_check){
					if($popup_check['form_id'] == $form_id){
						$popups[$key]['multi-titles'] = true;
						if(!in_array($popup_check['popup_name'], array_column($multi_popup, 'name'))){
							$multi_popup[] = [
								'title' => $popup_check['title'],
								'name'	=> $popup_check['popup_name'],
								'id'	=> $popup_check['form_id']
							];
						}
					}
				}
			}
		endforeach;
	endif;
	
	if($popups):
		foreach($popups as $key => $popup):
			$popup_object = new BlockPopup($popup['popup_name'],$popup['title'],$popup['form_id']);
			if($popup['multi-titles']){
				if(!in_array($popup['form_id'],$popups_multi_forms_ids)){
					$popups_multi_forms_ids[] = $popup['form_id'];
					$popup_object->set_multi_titles($multi_popup,$multi_popups_counter);
					$popup_object->set_multi_names($multi_popup,$multi_popups_counter);
					echo $popup_object->get_multi_titles_popup($multi_popup);
					$multi_popups_counter++;
				}
			}else{
				echo $popup_object->get_popup();
			}
		endforeach;
	endif;
}

?>

