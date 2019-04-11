<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package mbbma
 */
?>
<div id="secondary" class="widget-area columns-4 gutter">
	<?php
		do_action('before_sidebar');
		if (!dynamic_sidebar('sidebar-1')) :
		endif;
	?>
</div>
