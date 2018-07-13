<?php

/*
Template Name: Sitemap
*/

get_header(); ?>
	<div id="primary" class="content-area content-sidebar columns-12 center">
		<section id="main" class="site-main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

					<h1>Overzicht van alle pagina's</h1>  
					<?php wp_nav_menu( array( 'theme_location' => 'sitemap' ) ); ?>
				
			<?php endwhile; ?>

		</section>
	</div>
<?php get_footer(); ?>
