<?php

/*
Template Name: Contact
*/

get_header(); ?>

	<div id="primary" class="content-area">
		<section id="main" class="site-main">

			<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'page' );
				endwhile;
			?>

		</section>
	</div>

<?php get_footer(); ?>
