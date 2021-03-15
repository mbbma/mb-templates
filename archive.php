<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mbbma
 */

get_header(); ?>
	<article class="news-overview pad-bottom">
		<div class="columns-12 center">
			<div class="titles text-center">
				<h1 class="h2">
					Nieuws
				</h1>
			</div>
			
			<?php
				echo get_search_form();


				if ( have_posts() ) :
					echo '<div class="grid">';
					while ( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() );
					endwhile;
					echo '</div>';
			?>

				<div class="page-number-wrapper">
					<?php wpex_pagination(); ?>
				</div>

			<?php
				else :
					get_template_part( 'content', 'none' );
				endif;
			?>
		</div>
	</article>
<?php get_footer(); ?>
