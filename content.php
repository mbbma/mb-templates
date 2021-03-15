<?php
/**
 * @package mbbma
 */
?>

<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="block">
	<div class="image">
		<?php echo get_the_post_thumbnail(get_the_ID(),'full'); ?>
	</div>
	<div class="content">
		<div class="date">
			<?php echo get_the_time('d / m / Y'); ?>
		</div>
		<h3>
			<?php echo get_the_title(); ?>
		</h3>
		<p>
			<?php echo get_the_excerpt(); ?>
		</p>
		<div class="btn-secondary-alt">
			Lees meer
		</div>
	</div>
</a>
