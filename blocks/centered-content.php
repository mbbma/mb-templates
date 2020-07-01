<?php
/**
 * Gecentreerde content Block Template.
 */
$block = get_field('centered_content_block');
$blockID = get_field('block_id');
$padding = blockPadding(get_field('block_padding'));
?>

<?php echo do_shortcode('[raw]'); ?>
<?php if($block){ ?>
	<article id="<?php echo $blockID; ?>" class="centered-content <?php echo $padding; ?>">
		<div class="columns-12 center">
			<div class="content-wrapper">
				<?php
					if($block['content']):
						foreach ($block['content'] as $key => $value) {
							switch ($value['acf_fc_layout']) {
								case 'title':
									echo blockTitle(
										$value['title'],
										$value['title_link'],
										$value['title_title'],
										$value['title_type'],
										'h3',
										false,
										''
									);
									break;

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

								case 'image':
									echo '
										<div class="image">
											<img src="'.wp_get_attachment_image_src($value['image'],'full')[0].'" alt="'.get_post_meta($value['image'], '_wp_attachment_image_alt', TRUE).'">
										</div>
									';
									break;

								case 'buttons':
									echo '<div class="buttons">';
									foreach ($value['buttons'] as $key => $row) {
										echo '
											<a href="'.$row['button_link'].'" title="'.$row['button_text'].'" class="btn-secondary">
												'.$row['button_text'].'
											</a>
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
<?php } ?>
<?php echo do_shortcode('[/raw]'); ?>