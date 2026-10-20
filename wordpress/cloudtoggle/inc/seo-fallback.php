<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Basic description + Open Graph tags, only when no SEO plugin is active.
 * (The live site uses Yoast, which outputs its own tags; this must not duplicate them.)
 */
function ct_has_seo_plugin() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) || defined( 'SEOPRESS_VERSION' ) || defined( 'THE_SEO_FRAMEWORK_VERSION' );
}

add_action( 'wp_head', function () {
	if ( ct_has_seo_plugin() ) {
		return;
	}
	if ( is_singular() ) {
		$title = get_the_title();
		$desc  = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( strip_shortcodes( get_post_field( 'post_content' ) ) ), 30, '…' );
		$url   = get_permalink();
		$img   = has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'large' ) : ct_asset( 'img/og-default.png' );
		$type  = is_single() ? 'article' : 'website';
	} else {
		$title = wp_get_document_title();
		$desc  = get_bloginfo( 'description' );
		$url   = home_url( add_query_arg( [] ) );
		$img   = ct_asset( 'img/og-default.png' );
		$type  = 'website';
	}
	$desc = trim( preg_replace( '/\s+/', ' ', $desc ) );
	$tags = [
		'og:site_name'   => get_bloginfo( 'name' ),
		'og:type'        => $type,
		'og:title'       => $title,
		'og:description' => $desc,
		'og:url'         => $url,
		'og:image'       => $img,
	];
	if ( $desc ) {
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	foreach ( $tags as $property => $content ) {
		if ( $content ) {
			echo '<meta property="' . esc_attr( $property ) . '" content="' . esc_attr( $content ) . '">' . "\n";
		}
	}
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}, 2 );
