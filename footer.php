<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package mbbma
 */
?>
					<div class="popups">
						<?php footer_popups(); ?>
					</div>
					<div class="popup-background"></div>
				</div>
			</main>

			<footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">
				<div id="zone-footer-wrapper">
					<div id="zone-footer">
						<div class="footer-columns footer-columns-first">

						</div>
						<div class="footer-columns footer-columns-second">
							
						</div>
						<div class="footer-columns footer-columns-third">
							
						</div>
						<div class="footer-columns footer-columns-fourth">
							
						</div>
					</div>
				</div>
				<div id="zone-footer-wrapper-2">
					<div id="zone-footer-2">
					&copy; <?php echo date('Y'); ?>: <a href="https://www.mbbedrijfskundigmarketingadvies.nl/" title="MB - Bedrijfskundig Marketing Advies" target="_blank">MB - Bedrijfskundig Marketing Advies</a> | <a href="/sitemap/" title="Sitemap">Sitemap</a> | <a href="/contact/online-samenwerkingen/" title="Samenwerkingen">Samenwerkingen</a> | <a href="/contact/privacy-statement/" title="Privacy statement">Privacy statement</a> | <a href="/contact/disclaimer/" title="Disclaimer">Disclaimer</a>
					</div>
				</div>
			</footer>
		</div>

		<?php wp_footer(); ?>

	</body>
</html>
