<?php
/*
Template Name: Content/Sidebar
*/

get_header(); ?>
	<div class="columns-12 center">
		<div id="primary" class="content-area content-sidebar columns-8 float-left">
			<section id="main" class="site-main">
				<?php
					while (have_posts()) : the_post();
						get_template_part('content', 'page');
					endwhile;
				?>
			</section>
		</div>
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>
