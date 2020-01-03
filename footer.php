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
	</main>

	<footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">
		<div id="zone-footer-wrapper">
			<div id="zone-footer">
				<?php if (is_active_sidebar('footer-columns-1')) : ?>
					<div class="footer-columns footer-columns-first columns-3 gutter">
						<?php if(is_active_sidebar('footer-columns-1')){ dynamic_sidebar('footer-columns-1');}?>
					</div>
				<?php endif; ?>
				<?php if (is_active_sidebar('footer-columns-2')) : ?>
					<div class="footer-columns footer-columns-second columns-3 gutter">
						<?php if(is_active_sidebar('footer-columns-2')){ dynamic_sidebar('footer-columns-2');}?>
					</div>
				<?php endif; ?>
				<?php if (is_active_sidebar('footer-columns-3')) : ?>
					<div class="footer-columns footer-columns-third columns-3 gutter">
						<?php if(is_active_sidebar('footer-columns-3')){ dynamic_sidebar('footer-columns-3');}?>
					</div>
				<?php endif; ?>
				<?php if (is_active_sidebar('footer-columns-4')) : ?>
					<div class="footer-columns footer-columns-fourth columns-3 gutter">
						<?php if(is_active_sidebar('footer-columns-4')){ dynamic_sidebar('footer-columns-4');}?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div id="zone-footer-wrapper-2">
			<div id="zone-footer-2">
			&copy; <?php echo date('Y'); ?>: <a href="https://www.mbbedrijfskundigmarketingadvies.nl" title="MB - Bedrijfskundig Marketing Advies" target="_blank">MB - Bedrijfskundig Marketing Advies</a> | <a href="<?php echo esc_url(home_url('/contact/sitemap/')); ?>" title="Sitemap">Sitemap</a> | <a href="<?php echo esc_url(home_url('/contact/samenwerkingen/')); ?>" title="Samenwerkingen">Samenwerkingen</a> | <a href="<?php echo esc_url(home_url('/contact/privacy-statement/')); ?>" title="Privacy statement">Privacy statement</a> | <a href="<?php echo esc_url(home_url('/contact/disclaimer/')); ?>" title="Disclaimer">Disclaimer</a>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
