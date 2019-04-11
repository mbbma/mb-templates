<?php
/**
 * The template for displaying search forms in mbbma
 *
 * @package mbbma
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Zoek naar:', 'label', 'mbbma' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Zoeken&hellip;', 'placeholder', 'mbbma' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</label>
	<button type="submit" class="btn-primary">Zoek</button>
</form>
