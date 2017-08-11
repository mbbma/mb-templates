<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <section id="content">
 *
 * @package mbbma
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
<?php include('json-ld.php'); ?>
<script type="application/ld+json"><?php echo json_encode($payload); ?></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header">
		<div id="zone-user-wrapper">
			<div id="zone-user">
				<?php if (is_active_sidebar('topbar-1')) : ?>
					<div class="site-user columns-12 gutter">
						<?php if(is_active_sidebar('topbar-1')){ dynamic_sidebar('topbar-1');}?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		
		<div id="zone-header-wrapper">
			<div id="zone-header">
				<div id="region-header">
					<div class="site-branding">
						<div class="logo" itemscope itemtype="http://schema.org/Organization">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img alt="logo" class="logo-normal" src="<?php bloginfo('template_url'); ?>/library/images/logo-feeltastic.png" />
								<img alt="logo" class="logo-mobile" src="<?php bloginfo('template_url'); ?>/library/images/logo-feeltastic.png" />
							</a>
						</div>
					</div>
					<nav id="site-navigation" class="main-navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<div class="menu-toggle"><?php _e( '<span class="line first-line first"></span><span class="line second-line"></span><span class="line last-line last"></span>', 'mbbma' ); ?></div>
						<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'mbbma' ); ?></a>
						<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					</nav>
				</div>
			</div>
		</div>
	</header>

	<section id="content" class="site-content">
		<?php if (is_active_sidebar('content-preface-1')) : ?>
		<div id="zone-preface-first-wrapper">
			<div id="zone-preface-first">
				<div class="content-preface content-preface-first">
					<?php if(is_active_sidebar('content-preface-1')){ dynamic_sidebar('content-preface-1');}?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="columns-12 breadcrumb center">
			<?php if ( function_exists('yoast_breadcrumb') ) 
			{yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
		</div>
		<div id="zone-content-wrapper">
			
