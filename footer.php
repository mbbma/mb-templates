<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package mbbma
 */
?>

			
		</div>
		<?php if (is_active_sidebar('content-postscript-1')) : ?>
		<div id="zone-postscript-wrapper">
			<div id="zone-postscript">
				<div class="content-postscript">
					<?php if(is_active_sidebar('content-postscript-1')){ dynamic_sidebar('content-postscript-1');}?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php if (is_active_sidebar('content-postscript-2')) : ?>
		<div id="zone-postscript-wrapper-2">
			<div id="zone-postscript-2">
				<div class="content-postscript-2 columns-12 gutter">
					<?php if(is_active_sidebar('content-postscript-2')){ dynamic_sidebar('content-postscript-2');}?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</section>

	<footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">
		<div id="zone-footer-wrapper">
			<div id="zone-footer">
				<?php if (is_active_sidebar('footer-columns-1')) : ?>
					<div class="footer-columns-first columns-4 gutter">
						<?php if(is_active_sidebar('footer-columns-1')){ dynamic_sidebar('footer-columns-1');}?>
					</div>
				<?php endif; ?>
				<?php if (is_active_sidebar('footer-columns-2')) : ?>
					<div class="footer-columns-second columns-4 gutter">
						<?php if(is_active_sidebar('footer-columns-2')){ dynamic_sidebar('footer-columns-2');}?>
					</div>
				<?php endif; ?>
				<?php if (is_active_sidebar('footer-columns-3')) : ?>
					<div class="footer-columns-third columns-4 gutter">
						<?php if(is_active_sidebar('footer-columns-3')){ dynamic_sidebar('footer-columns-3');}?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div id="zone-footer-wrapper-2">
			<div id="zone-footer-2">
			© <?php echo date('Y'); ?>: <a href="http://www.mbbedrijfskundigmarketingadvies.nl" title="MB - Bedrijfskundig Marketing Advies" target="_blank">MB - Bedrijfskundig Marketing Advies </a>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
