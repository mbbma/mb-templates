<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package mbbma
 */

get_header(); ?>

	<section id="primary" class="content-area columns-12 center">
		<div id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Zoekresultaten voor: %s', 'mbbma' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php mbbma_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</div>
	</section>

<?php get_footer(); ?>
