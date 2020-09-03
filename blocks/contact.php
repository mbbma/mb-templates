<?php
	/**
	 * Contact Block Template.
	 */
	$block = get_field('contact_block');
	$blockID = get_field('block_id') ? 'id="'.get_field('block_id').'"' : '';
	$padding = blockPadding(get_field('block_padding'));
?>

<?php echo do_shortcode('[raw]'); ?>
<?php if($block){ ?>
	<article <?php echo $blockID; ?> class="contact <?php echo $padding; ?>">
		<div class="content-wrapper">
			<div class="columns-12 center">
				<div class="wrapper">
					<div class="form">
						<?php
							echo '
								<div class="titles">
									<h1>'.$block['title'].'</h1>
									<h3>'.$block['subtitle'].'</h3>
								</div>
							';
							gravity_form( $block['form_id'], $display_title = false, $ajax = true);
						?>
					</div>
				</div>
			</div>
		</div>
	</article>
<?php } ?>
<?php echo do_shortcode('[/raw]'); ?>