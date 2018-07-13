<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mbbma
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'mbbma' ); ?></h1>
	</header>

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'mbbma' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, we hebben niks kunnen vinden op basis van uw keywords. Probeer het alstublieft nog een keer', 'mbbma' ); ?></p>
			<div class="columns-6"><?php get_search_form(); ?></div><br/>
			<br/>

			<div> 
				<i class="fa fa-search"></i> Gebruik een ander zoekwoord<br>
				<i class="fa fa-home"></i> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Ga terug naar de homepagina</a>
			</div>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mbbma' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>

	</div>
</section>
