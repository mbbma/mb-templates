<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package mbbma
 */

get_header(); ?>

	<div id="primary" class="content-area columns-12 center">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
				</header><!-- .page-header -->

				<div class="page-content">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><div id="img-404">
						<div class="img-404-txt">
							We hebben gezocht in alle hoekjes.<br/>
							Helaas konden we de gewenste <br/>
							pagina niet vinden.. <br/>
							<a class="bt-404" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Terug naar home</a>
						</div>
					</div></a>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"></a>
					<div class="columns-6"><?php get_search_form(); ?></div>


				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>