<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); ?>

<div class="woocommerce-background">
	<div class="columns-12 center">
		<div class="pad-both">
			<div class="webshop-slider center mobile-none">
				<?php if ( ! dynamic_sidebar( 'woocommerce-slider' ) ) : ?>
				<?php endif; // end sidebar widget area ?>
			</div>

			<div class="primary-wrapper archive-product">
				<?php
					/**
					 * woocommerce_before_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					do_action( 'woocommerce_before_main_content' );
				?>
				<header class="woocommerce-products-header">

					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<!-- <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1> -->
					<?php endif; ?>
					
					<?php
					/**
					 * Hook: woocommerce_archive_description.
					 *
					 * @hooked woocommerce_taxonomy_archive_description - 10
					 * @hooked woocommerce_product_archive_description - 10
					 */
					//do_action( 'woocommerce_archive_description' );
					?>
				</header>
							
				<!-- Dit is de content van de webshop pagina -->
				<div class="wc-intro">
					<h1 class="title-archive"><?php woocommerce_page_title(); ?></h1>
				</div>

				<!-- Hier komen de producten -->
				<div class="wrapper">
					<div class="producten-archive-sidebar">
						<?php if(is_active_sidebar('sidebar-1')) : ?>
							<?php if(is_active_sidebar('sidebar-1')){ dynamic_sidebar('sidebar-1');}?>
						<?php endif; ?>

						<div class="mobile-none">
							<script type="text/javascript" src="https://www.feedbackcompany.com/widgets/feedback-company-widget.min.js"></script>
							<script type="text/javascript" id="__fbcw__d5081670-d5da-4809-9588-d5e5dcbf1c03">
								new FeedbackCompanyWidget('d5081670-d5da-4809-9588-d5e5dcbf1c03');
							</script>
						</div>

						<br class="mobile-none">

						<div class="mobile-none">
							<a href="https://www.qshops.org/webshop/view/17448"><img src="https://www.qshops.org/uploads/qshops_logo/keurmerk.svg" width="100px" height="100px" alt="Qshops webwinkel Keurmerk"></a>
						</div>
					</div>
					<div class="producten-overzicht">
						<?php
						if ( woocommerce_product_loop() ) {

							/**
							 * Hook: woocommerce_before_shop_loop.
							 *
							 * @hooked wc_print_notices - 10
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );

							woocommerce_product_loop_start();

							if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();

									/**
									 * Hook: woocommerce_shop_loop.
									 *
									 * @hooked WC_Structured_Data::generate_product_data() - 10
									 */
									do_action( 'woocommerce_shop_loop' );

									wc_get_template_part( 'content', 'product' );
								}
							}

							woocommerce_product_loop_end();

							/**
							 * Hook: woocommerce_after_shop_loop.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
						} else {
							/**
							 * Hook: woocommerce_no_products_found.
							 *
							 * @hooked wc_no_products_found - 10
							 */
							do_action( 'woocommerce_no_products_found' );

							} ?>

					</div>
				</div>
				<?php
					/**
					 * woocommerce_after_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					 */
					do_action( 'woocommerce_after_main_content' );
					
					/**
					 * woocommerce_sidebar hook
					 *
					 * @hooked woocommerce_get_sidebar - 10
					 */
					do_action( 'woocommerce_sidebar' );
				?>
			
				<div class="columns-12">
					<?php do_action( 'before_sidebar' ); ?>
					<?php if ( ! dynamic_sidebar( 'woocommerce-content' ) ) : ?>
					<?php endif; // end sidebar widget area ?>
					<?php do_action( 'woocommerce_archive_description' ); ?>
				</div>

			</div>
		</div>
	</div>
</div>
<?php get_footer('shop' ); 
