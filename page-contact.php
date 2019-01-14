<?php

/*
Template Name: Contact
*/

get_header(); ?>

	<div id="primary" class="content-area">
		<section id="main" class="site-main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; ?>

		</section>
	</div>

<?php get_footer(); ?>
