<?php
	/**
	 * Content met afbeelding Block Template.
	 */
	$block = get_field('content_image_block');
	$blockID = get_field('block_id') ? 'id="'.get_field('block_id').'"' : '';
	$padding = blockPadding(get_field('block_padding'));
	$blockTitle = get_field('block_title');
?>

<?php
	if($block){
		echo !$is_preview ? '[raw]' : '';
		
		$order = 'order-' . $block['order'];
	?>
	<article <?php echo $blockID; ?> class="content-image light-background <?php echo $padding; ?>">
		<div class="content-wrapper pad-both <?php echo $order; ?>">
			<div class="columns-12 center">
				<div class="grid">
					<?php
						if($block['image']){
							echo '
								<div class="image">
									<img src="'.$block['image']['url'].'" alt="'.$block['image']['alt'].'" loading="lazy" width="'.$block['image']['width'].'" height="'.$block['image']['height'].'">
								</div>
							';
						}
					?>
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
		
											$title->setLook('h3');
		
											echo $title->getTitle();
											break;

										case 'content':
											echo $value['content'];
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
			</div>
		</div>
	</article>
<?php
		echo !$is_preview ? '[/raw]' : '';
	}
?>