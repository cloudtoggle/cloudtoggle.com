<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<section class="mx-auto flex max-w-2xl flex-col items-center px-5 py-28 text-center sm:py-40">
	<p class="eyebrow">404</p>
	<h1 class="h-display mt-3 text-4xl sm:text-5xl"><?php esc_html_e( 'This page is switched off.', 'cloudtoggle' ); ?></h1>
	<p class="mt-4 text-lg text-ink-500"><?php esc_html_e( "We couldn't find what you were looking for. Try the homepage or the blog.", 'cloudtoggle' ); ?></p>
	<div class="mt-8 flex gap-3">
		<?php
		ct_button( home_url( '/' ), __( 'Back to home', 'cloudtoggle' ) );
		ct_button( ct_blog_url(), __( 'Read the blog', 'cloudtoggle' ), 'secondary' );
		?>
	</div>
</section>
<?php
get_footer();
