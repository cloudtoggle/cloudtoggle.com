<?php
/**
 * Site header (indigo bar, matches the Astro site).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$nav = ct_nav_items();
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#3850a4">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="ct-header sticky top-0 z-50 bg-nav text-white shadow-[0_1px_0_rgb(255_255_255/0.08)_inset,0_8px_24px_-16px_rgb(17_26_63/0.6)]">
	<a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-3 focus:z-50 focus:rounded-md focus:bg-white focus:px-3 focus:py-2 focus:text-ink-950 focus:shadow-card"><?php esc_html_e( 'Skip to content', 'cloudtoggle' ); ?></a>
	<div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-5 sm:px-8">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2.5" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> home">
			<?php ct_logo(); ?>
			<span class="text-[15px] font-semibold tracking-[0.04em] text-white">CLOUD TOGGLE</span>
		</a>

		<nav class="hidden items-center gap-1 md:flex" aria-label="<?php esc_attr_e( 'Primary', 'cloudtoggle' ); ?>">
			<?php foreach ( $nav as $item ) : ?>
				<a href="<?php echo esc_url( $item['href'] ); ?>"<?php echo $item['external'] ? ' rel="noopener"' : ''; ?> class="rounded-full px-3.5 py-2 text-sm text-white/80 transition-colors hover:bg-white/10 hover:text-white"><?php echo esc_html( $item['label'] ); ?></a>
			<?php endforeach; ?>
		</nav>

		<div class="hidden items-center gap-2 md:flex">
			<?php
			ct_button( ct_cta_url( 'login' ), __( 'Log in', 'cloudtoggle' ), 'navGhost' );
			ct_button( ct_cta_url( 'demo' ), __( 'Book a Demo', 'cloudtoggle' ), 'navSecondary', '', true );
			ct_button( ct_cta_url( 'trial' ), __( 'Start Free Trial', 'cloudtoggle' ), 'navPrimary' );
			?>
		</div>

		<button type="button" class="inline-flex size-10 items-center justify-center rounded-full text-white hover:bg-white/10 md:hidden" aria-expanded="false" aria-controls="mobile-menu" aria-label="<?php esc_attr_e( 'Open menu', 'cloudtoggle' ); ?>" data-menu-toggle>
			<svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" aria-hidden="true">
				<path d="M4 7h16M4 12h16M4 17h16" data-icon-open />
				<path d="M6 6l12 12M18 6L6 18" data-icon-close class="hidden" />
			</svg>
		</button>
	</div>

	<div id="mobile-menu" class="hidden border-t border-white/10 bg-nav-700 md:hidden" data-menu>
		<nav class="mx-auto flex max-w-6xl flex-col px-5 py-4" aria-label="<?php esc_attr_e( 'Mobile', 'cloudtoggle' ); ?>">
			<?php foreach ( $nav as $item ) : ?>
				<a href="<?php echo esc_url( $item['href'] ); ?>"<?php echo $item['external'] ? ' rel="noopener"' : ''; ?> class="rounded-lg px-3 py-3 text-base text-white/90 hover:bg-white/10"><?php echo esc_html( $item['label'] ); ?></a>
			<?php endforeach; ?>
			<a href="<?php echo esc_url( ct_cta_url( 'login' ) ); ?>" class="rounded-lg px-3 py-3 text-base text-white/90 hover:bg-white/10"><?php esc_html_e( 'Log in', 'cloudtoggle' ); ?></a>
			<div class="mt-3 grid grid-cols-2 gap-3">
				<?php
				ct_button( ct_cta_url( 'demo' ), __( 'Book a Demo', 'cloudtoggle' ), 'navSecondary', '', true );
				ct_button( ct_cta_url( 'trial' ), __( 'Start Free Trial', 'cloudtoggle' ), 'navPrimary' );
				?>
			</div>
		</nav>
	</div>
</header>

<main id="main">
