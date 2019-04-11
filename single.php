<?php
/**
 * The Template for displaying all single posts.
 *
 * @package mbbma
 */

get_header(); ?>

<div class="columns-12 center">
	<div id="primary" class="content-area content-sidebar columns-8 float-left">
		<section id="main" class="site-main" role="main">

			<?php
				while (have_posts()) : the_post();
					get_template_part('content', 'single');

					mbbma_post_nav();

					if (comments_open() || '0' != get_comments_number()) :
						comments_template();
					endif;

				endwhile;
			?>

		</section>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>