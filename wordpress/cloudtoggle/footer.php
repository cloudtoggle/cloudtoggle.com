<?php
/**
 * Site footer (indigo, matches the Astro site).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$cols = [
	__( 'Product', 'cloudtoggle' )   => [
		[ __( 'Features', 'cloudtoggle' ), home_url( '/#features' ) ],
		[ __( 'How it works', 'cloudtoggle' ), home_url( '/#how-it-works' ) ],
		[ __( 'Savings calculator', 'cloudtoggle' ), home_url( '/#calculator' ) ],
		[ __( 'Pricing', 'cloudtoggle' ), home_url( '/#pricing' ) ],
	],
	__( 'Resources', 'cloudtoggle' ) => [
		[ __( 'Blog', 'cloudtoggle' ), ct_blog_url() ],
		[ __( 'Help centre', 'cloudtoggle' ), 'https://cloudtoggle.featurebase.app/help' ],
		[ __( 'AWS setup guide', 'cloudtoggle' ), 'https://cloudtoggle.featurebase.app/help/articles/13695884123036-creating-a-new-aws-cloud-connection' ],
		[ __( 'Azure setup guide', 'cloudtoggle' ), 'https://cloudtoggle.featurebase.app/help/articles/13673200443932-creating-a-new-azure-cloud-connection' ],
	],
	__( 'Company', 'cloudtoggle' )   => [
		[ __( 'Contact', 'cloudtoggle' ), home_url( '/contact/' ) ],
		[ __( 'Book a demo', 'cloudtoggle' ), ct_cta_url( 'demo' ) ],
		[ __( 'Log in', 'cloudtoggle' ), ct_cta_url( 'login' ) ],
		[ __( 'X (Twitter)', 'cloudtoggle' ), 'https://x.com/cloudtoggle' ],
		[ __( 'YouTube', 'cloudtoggle' ), 'https://www.youtube.com/@cloudtoggle' ],
	],
];
?>
</main>

<footer class="bg-nav text-white">
	<div class="mx-auto max-w-6xl px-5 py-14 sm:px-8">
		<div class="grid gap-10 md:grid-cols-[1.4fr_repeat(3,1fr)]">
			<div>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2.5" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> home">
					<?php ct_logo(); ?>
					<span class="text-[15px] font-semibold tracking-[0.04em] text-white">CLOUD TOGGLE</span>
				</a>
				<p class="mt-4 max-w-xs text-sm leading-6 text-white/75"><?php esc_html_e( "Schedule your AWS and Azure servers to run only when they're needed.", 'cloudtoggle' ); ?></p>
			</div>
			<?php foreach ( $cols as $title => $links ) : ?>
				<nav aria-label="<?php echo esc_attr( $title ); ?>">
					<h2 class="text-sm font-semibold text-white"><?php echo esc_html( $title ); ?></h2>
					<ul class="mt-4 space-y-2.5">
						<?php foreach ( $links as [ $label, $href ] ) : ?>
							<li><a href="<?php echo esc_url( $href ); ?>"<?php echo 0 === strpos( $href, 'http' ) && false === strpos( $href, home_url() ) ? ' rel="noopener"' : ''; ?> class="text-sm text-white/75 transition-colors hover:text-white"><?php echo esc_html( $label ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</nav>
			<?php endforeach; ?>
		</div>
		<div class="mt-12 flex flex-col gap-3 border-t border-white/15 pt-6 text-sm text-white/70 sm:flex-row sm:items-center sm:justify-between">
			<p>Copyright &copy; CLOUD TOGGLE <?php echo esc_html( gmdate( 'Y' ) ); ?>. <?php esc_html_e( 'All rights reserved.', 'cloudtoggle' ); ?></p>
			<p class="flex gap-5">
				<a href="<?php echo esc_url( home_url( '/terms-and-conditions/' ) ); ?>" class="hover:text-white"><?php esc_html_e( 'Terms and Conditions', 'cloudtoggle' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="hover:text-white"><?php esc_html_e( 'Privacy Policy', 'cloudtoggle' ); ?></a>
			</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
