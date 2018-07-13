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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="posts-col-left">
		<?php the_post_thumbnail( array(750, 480) ); ?>
	</div>

	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-subtitle">
			Datum: <?php the_date(); ?> / Auteur: <?php the_author(); ?> / 
			<span class="comments-link"><?php comments_popup_link( __( 'Geef een reactie', 'mbbma' ), __( '1 Reactie', 'mbbma' ), __( '% Reacties', 'mbbma' ) ); ?></span>
			/ <?php the_tags(); ?>
		</div>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'mbbma' ),
				'after'  => '</div>',
			) );
		?>
		
		<div class="social-media">
			<script>
				function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436'); return false;}
			</script>
			
			<a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank">
				<div class="facebook">
					<i class="fa fa-facebook"></i>
				</div>
			</a>

			<a href="http://twitter.com/intent/tweet?url=<?php urlencode(the_permalink()); ?>&text=<?php urlencode(the_title()); ?>" onclick="window.open('http://twitter.com/intent/tweet?url=<?php urlencode(the_permalink()); ?>&text=<?php urlencode(the_title()); ?>','gplusshare','width=600,height=400,left='+(screen.availWidth/2-225)+',top='+(screen.availHeight/2-150)+'');return false;">
				<div class="twitter">
					<i class="fa fa-twitter"></i>
				</div>
			</a>

			<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','gplusshare','width=600,height=400,left='+(screen.availWidth/2-225)+',top='+(screen.availHeight/2-150)+'');return false;"> 
				<div class="google">
					<i class="fa fa-google-plus"></i>
				</div>
			</a>

			<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>','gplusshare','width=600,height=400,left='+(screen.availWidth/2-225)+',top='+(screen.availHeight/2-150)+'');return false;">
				<div class="linkedin laatste">
					<i class="fa fa-linkedin"></i>
				</div>
			</a>
		</div>

		<hr>

		<div class="recent-posts-wrapper">
			<h2> Bekijk ook eens: </h2>
			<?php
			$args = array( 
				'numberposts' => '3',
				'category__not_in' => array(1),
				'post__not_in' => array( $post->ID )
			);
			$recent_posts = wp_get_recent_posts( $args );
			foreach( $recent_posts as $recent ){
				if($recent['post_status']=="publish"){
					echo '
						<li class="blog-recent-posts">
							<div class="image">
								<a href="' . get_permalink($recent["ID"]) . '" title="'.esc_attr($recent["post_title"]).'" >
									' .   get_the_post_thumbnail($recent["ID"], 'mbbma').'
								</a>
							</div>
							<div class="title">
								<a href="' . get_permalink($recent["ID"]) . '" title="'.esc_attr($recent["post_title"]).'" >
									'.$recent["post_title"].'
								</a>
							</div>
							<div class="datum">'. date( 'd-m-Y', strtotime($recent['post_date'])) .'</div>
							<div class="datum">
								Door: <a href="' . get_permalink($recent["ID"]) . '">'.get_the_author().'</a>
							</div>
						</li>
					';
				}
			}
			?>
		</div>
	</div>

	<footer class="entry-meta">
		<?php
			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'mbbma' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
</article>
