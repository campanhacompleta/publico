<?php
/**
 * Público functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Público
 */

if ( ! function_exists( 'publico_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function publico_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Público, use a find and replace
	 * to change 'publico' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'publico', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'publico' ),
		'social'  => __( 'Social Links Menu', 'publico' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'publico_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * Enable support for page excerpts
	 */
	add_post_type_support( 'page', 'excerpt' );
}
endif; // publico_setup
add_action( 'after_setup_theme', 'publico_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function publico_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'publico_content_width', 640 );
}
add_action( 'after_setup_theme', 'publico_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function publico_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'publico' ),
		'id'            => 'sidebar-main',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title area__title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Social Engagement Area', 'publico' ),
		'id'            => 'sidebar-social-engagement',
		'description'   => __( 'An area on the Front Page to promote participation and civic engagement', 'publico' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title area__title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Content Secondary', 'publico' ),
		'id'            => 'sidebar-content-secondary',
		'description'   => __( 'A secondary content area for the Front Page', 'publico' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title area__title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Content Bottom', 'publico' ),
		'id'            => 'sidebar-content-bottom',
		'description'   => __( 'A content area that comes before the Footer', 'publico'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title area__title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Call to Action', 'publico' ),
		'id'            => 'sidebar-call-to-action',
		'description'   => __( 'An area for a call to action', 'publico' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title area__title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'publico' ),
		'id'            => 'sidebar-footer',
		'description'   => __( 'The website footer', 'publico' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title area__title">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'publico_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function publico_scripts() {
	wp_enqueue_style( 'publico-style', get_stylesheet_uri() );

	// Foundation
	wp_enqueue_style( 'publico-foundation-css', get_template_directory_uri() . '/assets/css/foundation.min.css', '', '5.5.2' );
	wp_enqueue_style( 'publico-foundation-css' );
	wp_enqueue_script( 'publico-foundation', get_template_directory_uri() . '/assets/js/foundation.min.js', array( 'jquery' ), '5.5.2', true );

	// Google Fonts
	wp_enqueue_style( 'publico-google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic', array(), null );

	// Font Awesome CDN
	wp_enqueue_style( 'publico-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), '4.4.0' );

	// Main theme style
	wp_register_style( 'publico-style-main', get_template_directory_uri() . '/assets/css/style.css' );
	wp_enqueue_style( 'publico-style-main');

	// FitVids.js
	wp_enqueue_script( 'publico-fitvids', get_template_directory_uri() . '/assets/js/jquery.fitvids.js', array( 'jquery' ), '', true );

	// Main JS
	wp_enqueue_script( 'publico-main-scripts', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'publico-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'publico-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_style( 'publico-delibera-css', get_template_directory_uri() . '/assets/css/delibera.css', array('delibera_style'), '1.0' );
	
	if('pauta' == get_post_type())
	{
		wp_enqueue_style( 'publico-delibera-css' );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'publico_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Load custom Widgets
 */
require get_template_directory() . '/inc/custom-widgets.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
