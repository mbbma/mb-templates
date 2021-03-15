<?php
	// New custom user role
	add_action('init', 'cloneRole');

	function cloneRole(){
		global $wp_roles;
		if ( ! isset( $wp_roles ) )
			$wp_roles = new WP_Roles();
		
		$admin = $wp_roles->get_role('administrator');
		
		$wp_roles->add_role('subadmin', 'Subbeheerder', $admin->capabilities);
	}


	// Remove Administrator role from roles list
	add_action( 'editable_roles' , 'hide_adminstrator_editable_roles' );
	function hide_adminstrator_editable_roles( $roles ){
		if ( isset( $roles['administrator'] ) ){
			$current_user = wp_get_current_user();
			if ( $current_user->roles[0] != 'administrator' )
				unset( $roles['administrator'] );
		}
		return $roles;
	}

	// Make subadmin the default user role
	add_filter('pre_option_default_role', function($default_role){
		return 'subadmin';
		return $default_role;
	});
?>
