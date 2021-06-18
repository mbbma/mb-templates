<?php
	/**
	 * FAQ Block Template.
	 */
	$block = get_field('faq_block');
	$blockID = get_field('block_id') ? 'id="'.get_field('block_id').'"' : '';
	$padding = blockPadding(get_field('block_padding'));
	$blockTitle = get_field('block_title');
?>

<?php
	if($block){
		echo !$is_preview ? '[raw]' : '';
?>
	<article <?php echo $blockID; ?> class="faq-block <?php echo $padding; ?>">
		<div class="columns-12 center">
			<div class="content">
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

					if($blockTitle['subtitle']){
						$title->setSubtitle(
							$blockTitle['subtitle']
						);
					}

					$title->setLook('h2');

					echo $title->getTitle();
				?>

				<div class="block">
					<?php
						if(is_array($block['faq'])){
							foreach ($block['faq'] as $question) {
								echo '
									<div class="item">
										<div class="question">
											'.$question['question'].'
										</div>
										<div class="answer">
											'.$question['answer'].'
										</div>
									</div>
								';
							}
						}
					?>
				</div>
			</div>
		</div>
	</article>
<?php
		echo !$is_preview ? '[/raw]' : '';
	}
?>