<?php

/*
Template Name: Bedanktpagina
*/

get_header(); ?>
	<div id="primary" class="content-area">
		<section id="main" class="site-main">

			<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'page' );
				endwhile;
			?>

				<div class="pad-both">
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

		</section>
	</div>
<?php get_footer(); ?>
