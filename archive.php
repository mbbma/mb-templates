<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mbbma
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

	<header class="entry-header page-head">
		<div class="columns-12 center">
			<h1 class="page-title">
				<?php
					if (is_category()){
						single_cat_title();
					}
				?>
			</h1>
		
			<?php
				$term_description = term_description();
				if ( ! empty( $term_description ) ) :
					printf( '<div class="taxonomy-description">%s</div>', $term_description );
				endif;
			?>
		</div>
	</header>

	<div class="columns-12 center">
		<section id="primary" class="content-area content-sidebar columns-8 float-left">
			<div id="main" class="site-main" role="main">
				<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() );
					
					endwhile;
				?>

				<div class="page-number-wrapper">
					<?php wpex_pagination(); ?>
				</div>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

			</div>
		</section>

		<?php get_sidebar(); ?>

	</div>
<?php get_footer(); ?>
