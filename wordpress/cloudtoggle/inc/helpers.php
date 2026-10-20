<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Resolve a root-relative path against the site URL; leave absolute URLs alone. */
function ct_url( $url ) {
	return ( is_string( $url ) && '' !== $url && '/' === $url[0] ) ? home_url( $url ) : $url;
}

function ct_cta_url( $key ) {
	$defaults = [
		'trial' => '/?add-to-cart=285',
		'demo'  => 'https://calendly.com/cloudtoggle/30min',
		'login' => '/app/',
	];
	return ct_url( get_theme_mod( 'ct_' . $key . '_url', $defaults[ $key ] ) );
}

function ct_asset( $path ) {
	return get_template_directory_uri() . '/assets/' . ltrim( $path, '/' );
}

/** Button markup matching the Astro Button component. */
function ct_button( $href, $label, $variant = 'primary', $extra = '', $external = false ) {
	$base     = 'group inline-flex items-center justify-center gap-2 rounded-full font-medium whitespace-nowrap transition duration-200 active:scale-[0.98] h-10 px-5 text-sm';
	$variants = [
		'primary'      => 'bg-brand-600 text-white shadow-[0_1px_0_rgb(255_255_255/0.25)_inset,0_6px_18px_-6px_rgb(56_80_164/0.55)] hover:bg-brand-700',
		'secondary'    => 'border border-ink-200 bg-white text-ink-900 shadow-sm hover:border-ink-400 hover:bg-ink-50',
		'navPrimary'   => 'bg-white text-nav shadow-sm hover:bg-brand-50',
		'navSecondary' => 'border border-white/40 text-white hover:bg-white/10',
		'navGhost'     => 'text-white/85 hover:text-white',
	];
	printf(
		'<a href="%s"%s class="%s %s %s">%s</a>',
		esc_url( $href ),
		$external ? ' rel="noopener"' : '',
		esc_attr( $base ),
		esc_attr( $variants[ $variant ] ?? $variants['primary'] ),
		esc_attr( $extra ),
		esc_html( $label )
	);
}

/** Top-level nav items from the assigned menu, or the default marketing links. */
function ct_nav_items() {
	$locations = get_nav_menu_locations();
	if ( ! empty( $locations['primary'] ) ) {
		$items = wp_get_nav_menu_items( $locations['primary'] );
		if ( $items ) {
			$out = [];
			foreach ( $items as $item ) {
				if ( 0 === (int) $item->menu_item_parent ) {
					$out[] = [ 'href' => $item->url, 'label' => $item->title, 'external' => false === strpos( $item->url, home_url() ) && 0 === strpos( $item->url, 'http' ) ];
				}
			}
			return $out;
		}
	}
	return [
		[ 'href' => home_url( '/#features' ), 'label' => __( 'Features', 'cloudtoggle' ), 'external' => false ],
		[ 'href' => home_url( '/#how-it-works' ), 'label' => __( 'How it works', 'cloudtoggle' ), 'external' => false ],
		[ 'href' => home_url( '/#pricing' ), 'label' => __( 'Pricing', 'cloudtoggle' ), 'external' => false ],
		[ 'href' => ct_blog_url(), 'label' => __( 'Blog', 'cloudtoggle' ), 'external' => false ],
		[ 'href' => 'https://cloudtoggle.featurebase.app/help', 'label' => __( 'Help', 'cloudtoggle' ), 'external' => true ],
	];
}

/** Blog index URL: the "blog-en" category if present (legacy URL), else the posts page. */
function ct_blog_url() {
	$cat = get_category_by_slug( 'blog-en' );
	if ( $cat ) {
		return get_category_link( $cat->term_id );
	}
	$page = (int) get_option( 'page_for_posts' );
	return $page ? get_permalink( $page ) : home_url( '/' );
}

function ct_reading_time( $post_id = null ) {
	$words   = str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ) );
	$minutes = max( 1, (int) ceil( $words / 220 ) );
	/* translators: %d: minutes */
	return sprintf( _n( '%d minute read', '%d minutes read', $minutes, 'cloudtoggle' ), $minutes );
}

/** Logo: the Customizer custom logo if set, otherwise the theme's bundled logo. */
function ct_logo( $class = 'h-8 w-auto' ) {
	if ( has_custom_logo() ) {
		$id = get_theme_mod( 'custom_logo' );
		echo wp_get_attachment_image( $id, 'full', false, [ 'class' => $class, 'alt' => '' ] );
		return;
	}
	printf( '<img src="%s" alt="" width="44" height="33" class="%s">', esc_url( ct_asset( 'img/logo.png' ) ), esc_attr( $class ) );
}

/** Prev/next pagination styled like the Astro blog index. */
function ct_pagination() {
	global $wp_query;
	$total = (int) $wp_query->max_num_pages;
	if ( $total < 2 ) {
		return;
	}
	$current = max( 1, (int) get_query_var( 'paged' ) );
	$link    = 'rounded-full border border-ink-200 px-5 py-2.5 text-sm font-medium hover:border-ink-400 hover:bg-ink-50';
	echo '<nav class="mt-14 flex items-center justify-between" aria-label="' . esc_attr__( 'Pagination', 'cloudtoggle' ) . '">';
	echo $current > 1 ? '<a href="' . esc_url( get_pagenum_link( $current - 1 ) ) . '" rel="prev" class="' . esc_attr( $link ) . '">&larr; ' . esc_html__( 'Newer posts', 'cloudtoggle' ) . '</a>' : '<span></span>';
	/* translators: 1: current page, 2: total pages */
	echo '<p class="font-mono text-xs text-ink-400">' . esc_html( sprintf( __( 'Page %1$d of %2$d', 'cloudtoggle' ), $current, $total ) ) . '</p>';
	echo $current < $total ? '<a href="' . esc_url( get_pagenum_link( $current + 1 ) ) . '" rel="next" class="' . esc_attr( $link ) . '">' . esc_html__( 'Older posts', 'cloudtoggle' ) . ' &rarr;</a>' : '<span></span>';
	echo '</nav>';
}
