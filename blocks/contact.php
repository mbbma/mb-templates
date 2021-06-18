<?php
	/**
	 * Contact Block Template.
	 */
	$block = get_field('contact_block');
	$blockID = get_field('block_id') ? 'id="'.get_field('block_id').'"' : '';
	$padding = blockPadding(get_field('block_padding'));
?>

<?php
	if($block){
		echo !$is_preview ? '[raw]' : '';
?>
	<article <?php echo $blockID; ?> class="contact <?php echo $padding; ?>">
		<div class="content-wrapper">
			<div class="columns-12 center">
				<div class="wrapper">
					<div class="form">
						<?php
							$title = new BlockTitle(
								$blockTitle['title'],
								$blockTitle['title_type']
							);

							if($blockTitle['title_link']){
								$title->setLink(
									$blockTitle['title_link']['url'],
									$blockTitle['title_link']['title'],
									$blockTitle['title_link']['target'],
								);
							}

							if($blockTitle['suptitle']){
								$title->setSuptitle(
									$blockTitle['suptitle']
								);
							}

							$title->setLook('h2');

							echo $title->getTitle();


							gravity_form($block['form_id'], false, false, false, '', true);
						?>
					</div>
				</div>
			</div>
		</div>
	</article>
<?php
		echo !$is_preview ? '[/raw]' : '';
	}
?>