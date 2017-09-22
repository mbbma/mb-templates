<?php

/*
Template Name: Sitemap
*/

get_header(); ?>
		<div id="primary" class="content-area content-sidebar columns-12 center">
			<main id="main" class="site-main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

						<h1>Overzicht van alle pagina's</h1>  
						<?php wp_nav_menu( array( 'theme_location' => 'sitemap' ) ); ?>
					
				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->
<?php get_footer(); ?>
