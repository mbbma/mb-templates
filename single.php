<?php
/**
 * The Template for displaying all single posts.
 *
 * @package mbbma
 */

get_header(); ?>

<div class="columns-12 center">
	<section id="main" class="site-main" role="main">

		<?php
			while (have_posts()) : the_post();
				get_template_part('content', 'single');
			endwhile;
		?>

	</section>
</div>
<?php get_footer(); ?>