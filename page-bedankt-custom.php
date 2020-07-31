<?php

/*
Template Name: Bedanktpagina (aanpasbaar)
*/

get_header(); ?>
	<div id="primary" class="content-area">
		<section id="main" class="site-main">
				<div class="pad-both">
					<div class="columns-6 center">
						<h1>Bedankt <?php echo htmlspecialchars($_GET["Naam"]) ?>,</h1>

						<?php
							while ( have_posts() ) : the_post();
								get_template_part( 'content', 'page' );
							endwhile;
						?>
					</div>
				</div>
		</section>
	</div>
<?php get_footer(); ?>
