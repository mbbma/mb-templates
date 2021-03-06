<?php
	if(post_password_required()) {
		return;
	}
?>

<div id="comments" class="comments-area">
	<?php if(have_comments()) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'Reactie &ldquo;%2$s&rdquo;', 'Reacties &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'mbbma' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'mbbma' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mbbma' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mbbma' ) ); ?></div>
		</nav>
		<?php endif; ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array( 'callback' => 'mbbma_comment' ) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'mbbma' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mbbma' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mbbma' ) ); ?></div>
		</nav>
		<?php endif; ?>

	<?php endif; ?>

	<?php
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'mbbma' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>
</div>
