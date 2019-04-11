<?php
	/*
	Author: Alex van Mosel
	URL: http://www.mbbma.nl

	This is where you can drop your custom functions or
	just edit things like thumbnail sizes, header images,
	sidebars, comments, etc.
	*/

	// LOAD MBBMA CORE 
	require_once( 'library/mbbma.php' );
	require_once( 'library/query.php' );


	function mbbma_setup() {
		// let's get language support going, if you need it
		load_theme_textdomain( 'mbbma', get_template_directory() . '/library/translation' );

		// launching operation cleanup
		add_action( 'init', 'mbbma_head_cleanup' );
		// A better title
		add_filter( 'wp_title', 'rw_title', 10, 3 );
		// remove WP version from RSS
		add_filter( 'the_generator', 'mbbma_rss_version' );
		// remove pesky injected css for recent comments widget
		add_filter( 'wp_head', 'mbbma_remove_wp_widget_recent_comments_style', 1 );
		// clean up comment styles in the head
		add_action( 'wp_head', 'mbbma_remove_recent_comments_style', 1 );

		// enqueue base scripts and styles
		add_action( 'wp_enqueue_scripts', 'mbbma_scripts_and_styles', 999 );

		// launching this stuff after theme setup
		mbbma_theme_support();

		// cleaning up random code around images
		add_filter( 'the_content', 'mbbma_filter_ptags_on_images' );
		// cleaning up excerpt
		add_filter( 'excerpt_more', 'mbbma_excerpt_more' );
	}

	// let's get this party started
	add_action( 'after_setup_theme', 'mbbma_setup' );


	/************* ACTIVE WIDGETS ********************/
	function mbbma_widgets_init() {
		register_sidebar( array(
			'name' 			=> 'Sidebar',
			'id'            => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'			=> 'Topbar',
			'id' 			=> 'topbar-1',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4 class="widget-title">',
			'after_title' 	=> '</h4>',
		) );
		register_sidebar( array(
			'name'			=> 'Content Preface First',
			'id'			=> 'content-preface-1',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		) );
		register_sidebar( array(
			'name'			=> 'Content Postscript First',
			'id'			=> 'content-postscript-1',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		) );
		register_sidebar( array(
			'name'			=> 'Footer Columns First',
			'id'			=> 'footer-columns-1',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		) );
		register_sidebar( array(
			'name'			=> 'Footer Columns Second',
			'id'			=> 'footer-columns-2',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		) );
		register_sidebar( array(
			'name'			=> 'Footer Columns Third',
			'id'			=> 'footer-columns-3',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		) );
		register_sidebar( array(
			'name'			=> 'Footer Columns Fourth',
			'id'			=> 'footer-columns-4',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		) );
	}

	add_action( 'widgets_init', 'mbbma_widgets_init' );

	/************* COMMENT LAYOUT *********************/
	// Comment Layout
	function mbbma_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; ?>
		<div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
			<article  class="cf">
				<header class="comment-author vcard">
					<?php
					// create variable
					$bgauthemail = get_comment_author_email();
					?>
					<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
					<?php // end custom gravatar call ?>
					<?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'mbbma' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'mbbma' ),'  ','') ) ?>
					<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'mbbma' )); ?> </a></time>
				</header>
				<?php if ($comment->comment_approved == '0') : ?>
					<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'mbbma' ) ?></p>
					</div>
				<?php endif; ?>
				<section class="comment_content cf">
					<?php comment_text() ?>
				</section>
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</article>
		</div>
<?php
}
	/**
	 * Implement the Custom Header feature.
	 */
	//require get_template_directory() . 'library/inc/custom-header.php';

	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/library/inc/template-tags.php';

	/**
	 * Custom functions that act independently of the theme templates.
	 */
	require get_template_directory() . '/library/inc/extras.php';

	/**
	 * Load Woocommerce compatibility file.
	 */
	//require get_template_directory() . '/library/inc/woocommerce.php';

	/* Login page aanpassingen */

	//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
	function mbbma_login_css() {
		wp_enqueue_style( 'mbbma_login_css', get_template_directory_uri() . '/library/css/login.css', false );
	}

	// changing the alt text on the logo to show your site name
	function mbbma_login_title() { return get_option( 'blogname' ); }

	// changing the logo link from wordpress.org to your site
	function mbbma_login_url() {  return home_url(); }

	// calling it only on the login page
	add_action( 'login_enqueue_scripts', 'mbbma_login_css', 10 );
	add_filter( 'login_headerurl', 'mbbma_login_url' );
	add_filter( 'login_headertitle', 'mbbma_login_title' );

?>