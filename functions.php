<?php
/**
 * Confetti functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Confetti
 */

if ( ! defined( 'CONFETTI_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'CONFETTI_VERSION', '1.0.0' );
}

if ( ! function_exists( 'confetti_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function confetti_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on AAA, use a find and replace
		 * to change 'confetti' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'confetti', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'confetti' ),
				'menu-2' => esc_html__( 'Footer', 'confetti' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

	}
endif;
add_action( 'after_setup_theme', 'confetti_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function confetti_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'confetti_content_width', 640 );
}
add_action( 'after_setup_theme', 'confetti_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function confetti_scripts() {
	wp_enqueue_style( 'confetti-style', get_stylesheet_uri(), array(), CONFETTI_VERSION );
	wp_enqueue_script( 'confetti-navigation', get_template_directory_uri() . '/js/navigation.js', array(), CONFETTI_VERSION, true );
	
	wp_enqueue_script('jquery');
	wp_enqueue_style( 'swiper-style', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), CONFETTI_VERSION );
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), CONFETTI_VERSION, true  );
	wp_enqueue_script( 'confetti-swiper', get_template_directory_uri() . '/js/swiper-init.js', array(), CONFETTI_VERSION, true  );
	if(is_front_page()){
		wp_enqueue_script( 'confetti-animation', get_template_directory_uri() . '/js/confetti.js', array(), CONFETTI_VERSION, true  );
		wp_enqueue_script( 'confetti-scroll', get_template_directory_uri() . '/js/home-scroll.js', array(), CONFETTI_VERSION, true  );
	}
	if(is_page('whats-on')){
		wp_enqueue_script( 'confetti-filter', get_template_directory_uri() . '/js/filter.js', array(), CONFETTI_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'confetti_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Adding CPTs
 */
require get_template_directory() . '/inc/custom_post_types.php';

/**
 * Functions for Content Blocks
 */
require get_template_directory() . '/inc/get_blocks.php';

/**
  * REST API functions
  */

require get_template_directory() . '/inc/rest.php';

/**
 * Add Tiny MCE Button
 */
require get_template_directory() . '/inc/tinymce.php';

/*Disable Gutenberg*/
add_filter('use_block_editor_for_post', '__return_false', 10);

/*Disabling comments*/
add_action( 'admin_menu', 'confetti_remove_admin_menus' );
function confetti_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}

function confetti_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'confetti_admin_bar_render' );

/**
 *  Enable Options Page for ACF
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Footer Options',
		'menu_title'	=> 'Footer Options',
		'menu_slug' 	=> 'footer_options',
		'capability'	=> 'activate_plugins',
		'position'		=> '9',
		'redirect'		=> false,
	));
}

/*Filters Oembed*/
add_filter( 'embed_oembed_html', 'wrap_oembed_html', 99, 4 );
 
function wrap_oembed_html( $cached_html, $url, $attr, $post_id ) {
    if ( false !== strpos( $url, "youtube.com") || false !== strpos( $url, "youtu.be" )  || false !== strpos($url, "vimeo.com")){
        $cached_html = '<div class="media_container">' . $cached_html . '</div>';
    }
    return $cached_html;
}
