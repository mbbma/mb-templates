<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package mbbma
 */

get_header(); ?>

	<div id="primary" class="content-area columns-12 center">
		<section id="main" class="site-main" role="main">
			<div class="pad-both">
				<div class="error-404 not-found">
					<div class="page-content">
						We hebben gezocht in alle hoekjes.<br/>
						Helaas konden we de gewenste pagina niet vinden.<br/>
						<a class="bt-404" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Terug naar home</a>
						<div class="columns-6">
							<div class="wrapper">
								<?php get_search_form(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

<?php get_footer(); ?>