<?php

/*
Template Name: Sitemap
*/

get_header(); ?>
		<div id="primary" class="content-area content-sidebar columns-12 center">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

						<h1>Overzicht van alle pagina's</h1>  
						<ul class="arrowlist sitemaplist">
							<?php wp_list_pages( array(
							/* Neem de menustructuur over */
							'sort_column' => 'menu_order',
							'title_li' => '',
							/* Page id om niet weer te geven */
							'exclude' => '()'
							) ); ?>
						</ul>
					
				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->
<?php get_footer(); ?>
