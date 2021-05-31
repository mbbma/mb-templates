<?php
	/**
	 * Gecentreerde content Block Template.
	 */
	$block = get_field('centered_content_block');
	$blockID = get_field('block_id') ? 'id="'.get_field('block_id').'"' : '';
	$padding = blockPadding(get_field('block_padding'));
	$blockTitle = get_field('block_title');
?>

<?php if($block){ ?>
	[raw]
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

								case 'buttons':
									echo '<div class="buttons">';
									if($value['buttons']){
										foreach ($value['buttons'] as $key => $row) {
											$button = new BlockButton($row['button_text']);
	
											switch ($row['button_type']) {
												case 'link':
													$button->setLink(
														$row['button_link']['url'],
														$row['button_link']['title'],
														$row['button_link']['target'],
													);
													break;
	
												case 'popup':
													add_global_popup($row['button_popup']);
													$button->setPopup($row['button_popup']);
													break;
												
												default:
													break;
											}
											echo $button->getButton();
	
											if($row['phone']){
												echo '
													<div class="phone">
														of bel <a href="'.contactDetails(array('detail' => 'phone_link')).'" title="Bel ons">'.contactDetails(array('detail' => 'phone')).'</a>
													</div>
												';
											}
										}
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
	[/raw]
	
<?php } ?>