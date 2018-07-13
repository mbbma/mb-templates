<?php
/**
 * @package mbbma
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="posts-row">
		<div class="posts-col-left">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_post_thumbnail( 'full' ); ?>
			</a>
		</div>
		<div class="posts-col-right">
			<header class="entry-header">
				<h1 class="entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h1>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
						Datum : <?php mbbma_posted_on(); ?> |
						Auteur: <?php the_author(); ?> |
						<span class="comments-link"><?php comments_popup_link( __( 'Geef een reactie', 'mbbma' ), __( '1 Reactie', 'mbbma' ), __( '% Reacties', 'mbbma' ) ); ?></span>
						| <?php the_tags(); ?>
				<?php endif; ?>
			</header>

			<?php if ( is_search() ) : ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div>
			<?php else : ?>
				<div class="entry-content">
					<?php the_excerpt(); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'mbbma' ),
							'after'  => '</div>',
						) );
					?>
				</div>
			<?php endif; ?>

			<footer class="entry-meta">
				<?php if ( 'post' == get_post_type() ) : ?>
					<?php
						$categories_list = get_the_category_list( __( ', ', 'mbbma' ) );
						if ( $categories_list && mbbma_categorized_blog() ) :
					?>
					<span class="cat-links">
						<?php printf( __( 'Categoriën %1$s', 'mbbma' ), $categories_list ); ?>
					</span>
					<?php endif; ?>

					<?php
						$tags_list = get_the_tag_list( '', __( ', ', 'mbbma' ) );
						if ( $tags_list ) :
					?>
					
					<?php endif; ?>
				<?php endif; ?>
				<div class="bt-blog">
					<a class="bt" href="<?php the_permalink(); ?>">Lees verder</a>
				</div>

				<?php edit_post_link( __( 'Edit', 'mbbma' ), '<span class="edit-link">', '</span>' ); ?>
			</footer>
		</div>
	</div>
</article>
