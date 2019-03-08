<?php

/*
Template Name: Sitemap
*/

get_header(); ?>
	<div id="primary" class="content-area content-sidebar columns-12 center">
		<section id="main" class="site-main">

			<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'page' );
				endwhile;
			?>
			<h1>Overzicht van alle pagina's</h1>  
			<?php wp_nav_menu( array( 'theme_location' => 'sitemap' ) ); ?>

		</section>
	</div>
<?php get_footer(); ?>
