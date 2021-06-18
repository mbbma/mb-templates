<?php
	/**
	 * Gecentreerde content Block Template.
	 */
	$block = get_field('centered_content_block');
	$blockID = get_field('block_id') ? 'id="'.get_field('block_id').'"' : '';
	$padding = blockPadding(get_field('block_padding'));
	$blockTitle = get_field('block_title');
?>

<?php
	if($block){
		echo !$is_preview ? '[raw]' : '';
?>
	<article <?php echo $blockID; ?> class="centered-content <?php echo $padding; ?>">
		<div class="columns-12 center">
			<div class="content-wrapper">
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

					if($block['content']):
						foreach ($block['content'] as $key => $value) {
							switch ($value['acf_fc_layout']) {
								case 'title':
									$title = new BlockTitle(
										$value['title'],
										$value['title_type']
									);

									if($value['title_link']){
										$title->setLink(
											$value['title_link']['url'],
											$value['title_link']['title'],
											$value['title_link']['target'],
										);
									}

									$title->setLook('h4');
									
									$title->setClass('no-margin');

									echo $title->getTitle();
									break;

								case 'content':
									echo $value['content'];
									break;

								case 'image':
									echo '
										<div class="image">
											<img src="'.$value['image']['url'].'" alt="'.$value['image']['alt'].'" loading="lazy" width="'.$value['image']['width'].'" height="'.$value['image']['height'].'">
										</div>
									';
									break;

								case 'button':
									echo '<div class="buttons">';
									$button = new BlockButton($value['button']['button_text']);

									switch ($value['button']['button_type']) {
										case 'link':
											$button->setLink(
												$value['button']['button_link']['url'],
												$value['button']['button_link']['title'],
												$value['button']['button_link']['target'],
											);
											break;

										case 'popup':
											$button->setPopup($value['button']['button_popup']);
											break;
										
										default:
											break;
									}
									echo $button->getButton();

									if($value['button']['phone']){
										echo '
											<div class="phone">
												of bel <a href="'.contactDetails(array('detail' => 'phone_link')).'" title="Bel ons">'.contactDetails(array('detail' => 'phone')).'</a>
											</div>
										';
									}
									echo '</div>';
									break;
								
								default:
									break;
							}
						}
					endif;

				?>
			</div>
		</div>
	</article>
<?php
		echo !$is_preview ? '[/raw]' : '';
	}
?>