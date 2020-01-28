<?php
/**
 * FAQ Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'centered-content-white-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Load values and assing defaults.
$questions = get_field('faq_block');
?>

<?php echo do_shortcode('[raw]'); ?>
<?php if($questions){ ?>
	<article class="faq-block">
		<div class="columns-12 center">
			<div class="content">
				<div class="titles text-center">
					<h2>Veelgestelde vragen</h2>
				</div>
				<div class="block">
					<?php
						foreach ($questions as $question) {
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
					?>
				</div>
			</div>
		</div>
	</article>
<?php } ?>
<?php echo do_shortcode('[/raw]'); ?>