<?php
	// Enable shortcodes in text widgets
	add_filter('widget_text','do_shortcode');

	// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
	function mbbma_filter_ptags_on_images($content){
		return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	}

	// This removes the annoying […] to a Read More link
	function mbbma_excerpt_more($more) {
		global $post;
		// edit here if you like
		return '...';
	}

	/* excerpt length */
	function custom_excerpt_length( $length ) {
		return 10;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

	/* raw text */
	function my_formatter($content) {
		$new_content = '';
		$pattern_full = '{(\[raw\].*?\[/raw\])}is';
		$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
		$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

		foreach ($pieces as $piece) {
			if (preg_match($pattern_contents, $piece, $matches)) {
				$new_content .= $matches[1];
			} else {
				$new_content .= wptexturize(wpautop($piece));
			}
		}

		return $new_content;
	}
		
	remove_filter('the_content', 'wpautop');
	remove_filter('the_content', 'wptexturize');
	add_filter('the_content', 'my_formatter', 99);

	/* Email Return Path */
	class email_return_path {
		function __construct() {
			add_action( 'phpmailer_init', array( $this, 'fix' ) );    
		}
		function fix( $phpmailer ) {
			$phpmailer->Sender = $phpmailer->From;
		}
	}
	new email_return_path();

	/* Gravity Forms anker */
	add_filter( 'gform_confirmation_anchor', '__return_true' );

	// Slaat GF inzendingen in op zonder returns
	// https://docs.gravityforms.com/gform_export_field_value/ --> 7
	add_filter( 'gform_export_field_value', 'decode_export_values' );
	function decode_export_values( $value ) {
		$value = str_replace(array("\n", "\t", "\r"), ' ', $value);
		return $value;
	}

	// Automatische <p>'tjes weggehaald
	function get_rid_of_wpautop(){
		if(!is_singular()){
			remove_filter ('the_content', 'wpautop');
			remove_filter ('the_excerpt', 'wpautop');
		}
	}
	add_action( 'template_redirect', 'get_rid_of_wpautop' );

	// https://codeless.co/remove-type-attribute-from-wordpress/
	add_filter('style_loader_tag', 'codeless_remove_type_attr', 10, 2);
	add_filter('script_loader_tag', 'codeless_remove_type_attr', 10, 2);
	function codeless_remove_type_attr($tag, $handle) {
		return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
	}

	/**
	 * Filters the next, previous and submit buttons.
	 * Replaces the forms <input> buttons with <button> while maintaining attributes from original <input>.
	 *
	 * @param string $button Contains the <input> tag to be filtered.
	 * @param object $form Contains all the properties of the current form.
	 *
	 * @return string The filtered button.
	 */
	add_filter( 'gform_next_button', 'input_to_button', 10, 2 );
	add_filter( 'gform_previous_button', 'input_to_button', 10, 2 );
	add_filter( 'gform_submit_button', 'input_to_button', 10, 2 );
	function input_to_button( $button, $form ) {
		$dom = new DOMDocument();
		$dom->loadHTML( $button );
		$input = $dom->getElementsByTagName( 'input' )->item(0);
		$new_button = $dom->createElement( 'button' );
		$new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
		$input->removeAttribute( 'value' );
		foreach( $input->attributes as $attribute ) {
			$new_button->setAttribute( $attribute->name, $attribute->value );
		}
		$input->parentNode->replaceChild( $new_button, $input );

		return $dom->saveHtml( $new_button );
	}

	// Removes the "Bevestig het gebruik van een zwak wachtwoord" check, so strong passwords will be enforced.
	function remove_weak_password_check_script() {
		?>
			<script>
				jQuery(document).ready(function() {
					jQuery('.pw-weak').remove();
				});
			</script>
		<?php
	}
	add_action('admin_head','remove_weak_password_check_script');

	function remove_weak_password_check_script_2() {
		?>
			<script>
				document.addEventListener("DOMContentLoaded", function(event) { 
					var elements = document.getElementsByClassName('pw-weak');
					var requiredElement = elements[0];
					requiredElement.remove();
				});
			</script>
		<?php
	}
	add_action('login_enqueue_scripts','remove_weak_password_check_script_2');

	// Hide Updates counters on customer account
	function custom_admin_css() {
		global $current_user;
		get_currentuserinfo();
		if ($current_user->ID != 1) {
			echo '<style type="text/css">.update-plugins, .update-count {display: none!important; }</style>';
		}
	}
	add_action('admin_head','custom_admin_css');


	// SVG compatible
	function cc_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');
?>
