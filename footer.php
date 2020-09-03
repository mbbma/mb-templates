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
		</main>

		<footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">
			<div id="zone-footer-wrapper">
				<div id="zone-footer">
					<?php if (is_active_sidebar('footer-columns-1')) : ?>
						<div class="footer-columns footer-columns-first">
							<?php dynamic_sidebar('footer-columns-1'); ?>
						</div>
					<?php endif; ?>
					<?php if (is_active_sidebar('footer-columns-2')) : ?>
						<div class="footer-columns footer-columns-second">
							<?php dynamic_sidebar('footer-columns-2'); ?>
						</div>
					<?php endif; ?>
					<?php if (is_active_sidebar('footer-columns-3')) : ?>
						<div class="footer-columns footer-columns-third">
							<?php dynamic_sidebar('footer-columns-3'); ?>
						</div>
					<?php endif; ?>
					<?php if (is_active_sidebar('footer-columns-4')) : ?>
						<div class="footer-columns footer-columns-fourth">
							<?php dynamic_sidebar('footer-columns-4'); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div id="zone-footer-wrapper-2">
				<div id="zone-footer-2">
				&copy; <?php echo date('Y'); ?>: <a href="https://www.mbbedrijfskundigmarketingadvies.nl/" title="MB - Bedrijfskundig Marketing Advies" target="_blank">MB - Bedrijfskundig Marketing Advies</a> | <a href="/contact/sitemap/" title="Sitemap">Sitemap</a> | <a href="/contact/samenwerkingen/" title="Samenwerkingen">Samenwerkingen</a> | <a href="/contact/privacy-statement/" title="Privacy statement">Privacy statement</a> | <a href="/contact/disclaimer/" title="Disclaimer">Disclaimer</a>
				</div>
			</div>
		</footer>
	</div>

	<?php wp_footer(); ?>

	</body>
</html>
