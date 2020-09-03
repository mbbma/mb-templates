<?php
	/**
	 * Content met afbeelding Block Template.
	 */
	$block = get_field('content_image_block');
	$blockID = get_field('block_id') ? 'id="'.get_field('block_id').'"' : '';
	$padding = blockPadding(get_field('block_padding'));
?>

<?php echo do_shortcode('[raw]'); ?>
<?php if($block){ ?>
	<?php
		$order = 'order-' . $block['order'];
	?>
	<article <?php echo $blockID; ?> class="content-image <?php echo $padding; ?>">
		<div class="content-wrapper <?php echo $order; ?>">
			<div class="columns-12 center">
				<div class="grid">
					<?php
						if($block['image']){
							echo '
								<div class="image">
									<img src="'.wp_get_attachment_image_src($block['image'],'full')[0].'" alt="'.get_post_meta($block['image'], '_wp_attachment_image_alt', TRUE).'">
								</div>
							';
						}
					?>
					<div class="content">
						<?php
							$title = new BlockTitle(
								$block['title'],
								$block['title_type']
							);

							if($block['title_link']){
								$title->setLink(
									$block['title_link'],
									$block['title_title']
								);
							}

							$title->setLook('h2');
							
							echo $title;

							if($block['content']):
								foreach ($block['content'] as $key => $value) {
									switch ($value['acf_fc_layout']) {
										case 'text':
											echo $value['text'];
											break;

										case 'list':
											$listItems = '';
											foreach ($value['list'] as $key => $row) {
												$listItems .= '<li>' . $row['item'] . '</li>';
											}
											echo '<ul class="caret">' . $listItems . '</ul>';
											break;

										case 'buttons':
											echo '<div class="buttons">';
											foreach ($value['buttons'] as $key => $row) {
												switch ($row['button_type']) {
													case 'Link':
														echo '
															<a href="'.$row['button_link'].'" title="'.$row['button_text'].'" class="btn-primary">
																'.$row['button_text'].'
															</a>
														';
														break;
													case 'Popup':
														echo '
															<div class="btn-primary show-popup" data-value="'.$row['button_popup'].'">
																'.$row['button_text'].'
															</div>
														';
														break;
													
													default:
														# code...
														break;
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
			</div>
		</div>
	</article>
<?php } ?>
<?php echo do_shortcode('[/raw]'); ?>