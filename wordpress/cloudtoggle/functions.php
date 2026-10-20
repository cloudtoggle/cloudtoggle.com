<?php
/**
 * CLOUD TOGGLE theme functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CT_VERSION', '1.0.0' );

require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/seo-fallback.php';

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'cloudtoggle', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption', 'style', 'script' ] );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-logo', [
		'height'      => 66,
		'width'       => 88,
		'flex-height' => true,
		'flex-width'  => true,
	] );
	// WooCommerce is used for plan purchases, so declare support to avoid the "not compatible" notice.
	add_theme_support( 'woocommerce' );
	add_image_size( 'ct-card', 800, 450, true );

	register_nav_menus( [
		'primary' => __( 'Primary navigation', 'cloudtoggle' ),
	] );
} );

add_action( 'wp_enqueue_scripts', function () {
	$dir = get_template_directory();
	$uri = get_template_directory_uri();
	wp_enqueue_style( 'cloudtoggle', $uri . '/assets/css/theme.css', [], filemtime( $dir . '/assets/css/theme.css' ) );
	wp_enqueue_script( 'cloudtoggle', $uri . '/assets/js/theme.js', [], filemtime( $dir . '/assets/js/theme.js' ), [
		'in_footer' => true,
		'strategy'  => 'defer',
	] );
} );

// Preload the main variable font to avoid a text flash.
add_action( 'wp_head', function () {
	printf(
		'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
		esc_url( get_template_directory_uri() . '/assets/fonts/geist-latin-wght-normal.woff2' )
	);
	// Lets CSS reveal animations depend on JS being available.
	echo "<script>document.documentElement.classList.add('js');</script>\n";
}, 1 );

// Tidy: this theme does not use emoji scripts or the block-library "global styles" duplicate.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Keep excerpts short and clean on blog cards.
add_filter( 'excerpt_length', fn() => 28 );
add_filter( 'excerpt_more', fn() => '…' );
