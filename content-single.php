<?php
/**
 * @package mbbma
 */
?>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<article id="post-<?php the_ID(); ?>" class="centered-content news-content pad-both">
	<div class="content-wrapper">
		<div class="titles">
			<h1>
				<?php the_title(); ?>
			</h1>
			<h3 class="subtitle">
				<?php the_time('d / m / Y'); ?> | Auteur: <?php the_author(); ?>
			</h3>
		</div>

		<div class="entry-content">
			<?php the_content(); ?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'mbbma' ),
					'after'  => '</div>',
				) );
			?>
			
			<div class="social-media">
				<h3>Deel dit bericht op</h3>
				<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>','gplusshare','width=600,height=400,left='+(screen.availWidth/2-225)+',top='+(screen.availHeight/2-150)+'');return false;">
					<div class="linkedin laatste">
						<i class="fab fa-linkedin-in"></i>
					</div>
				</a>

				<script>
					function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436'); return false;}
				</script>
				
				<a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank">
					<div class="facebook">
						<i class="fab fa-facebook-square"></i>
					</div>
				</a>
			</div>
		</div>
	</div>
</article>
<article class="news-overview pad-bottom">
	<div class="titles text-center">
		<h2>
			Meer nieuws
		</h2>
	</div>
	<div class="grid">
		<?php
			$args = array(
				'post_type' => 'post',
				'category_name' => 'nieuws',
				'post_status' => 'publish',
				'posts_per_page' => 2,
				'post__not_in' => array(get_the_ID()),
				'orderby' => 'date',
				'order' => 'ASC',
			);
			$query = new WP_Query($args);

			if( $query->have_posts() ):
				while ($query->have_posts()) : $query->the_post();
					echo '
						<a href="'.get_permalink().'" title="'.get_the_title().'" class="block">
							<div class="image">
								'.get_the_post_thumbnail(get_the_ID(),'full').'
							</div>
							<div class="content">
								<div class="date">
									'.get_the_time('d / m / Y').'
								</div>
								<h3>
									'.get_the_title().'
								</h3>
								<p>
									'.get_the_excerpt().'
								</p>
								<div class="btn-secondary-alt">
									Lees meer
								</div>
							</div>
						</a>
					';
				endwhile;
			endif;
		?>
	</div>
</article>
