<?php

/*
Template Name: Bedankt
*/

get_header(); ?>
		<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>
				<div class="page-pad">
					<div class="columns-6 center">
						<h1>Bedankt <?php echo htmlspecialchars($_GET["Naam"]) ?>,</h1>
						<br>
						Hartelijk bedankt voor het invullen van het formulier.<br>
						Wij nemen zo snel mogelijk contact met u op.
						<br><br>
						Heeft u eerder vragen kunt u altijd contact met ons opnemen!
						<br><br>
						Met vriendelijke groet,<br>
						Team <?php bloginfo( 'name' ); ?>
					</div>
				</div>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
