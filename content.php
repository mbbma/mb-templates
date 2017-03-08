<?php
/**
 * @package mbbma
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="posts-row">
		<div class="posts-col-left"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'full' ); ?></a>
			
		</div>
		<div class="posts-col-right">
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				Datum : <?php mbbma_posted_on(); ?> |
				Auteur: <?php the_author(); ?> |
				<span class="comments-link"><?php comments_popup_link( __( 'Geef een reactie', 'mbbma' ), __( '1 Reactie', 'mbbma' ), __( '% Reacties', 'mbbma' ) ); ?></span>
				| <?php the_tags(); ?>
		<?php endif; ?>
		

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_excerpt(); ?>
		<?php /* the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mbbma' ) ); */ ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'mbbma' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'mbbma' ) );
				if ( $categories_list && mbbma_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Categoriën %1$s', 'mbbma' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'mbbma' ) );
				if ( $tags_list ) :
			?>
			
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>
		<div class="bt-blog"><a class="bt" href="<?php the_permalink(); ?>">Lees verder</a></div>

		<span class="comments-link-footer"><?php comments_popup_link( __( 'Geef een reactie', 'mbbma' ), __( '1 Reactie', 'mbbma' ), __( '% Reacties', 'mbbma' ) ); ?></span>

		<?php edit_post_link( __( 'Edit', 'mbbma' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	</div>
	</div>

</article><!-- #post-## -->
