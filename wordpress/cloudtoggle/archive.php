<?php
/**
 * Archive layout (same as index.php).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

if ( is_category() || is_tag() || is_archive() ) {
	$eyebrow = single_term_title( '', false ) ?: __( 'Archive', 'cloudtoggle' );
} elseif ( is_search() ) {
	$eyebrow = __( 'Search', 'cloudtoggle' );
} else {
	$eyebrow = __( 'Blog', 'cloudtoggle' );
}
?>
<section class="mx-auto max-w-6xl px-5 py-16 sm:px-8 sm:py-24">
	<div class="mx-auto max-w-2xl text-center">
		<p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<h1 class="h-display mt-3 text-3xl sm:text-4xl lg:text-[2.75rem] lg:leading-[1.1]">
			<?php echo is_search() ? esc_html( sprintf( __( 'Results for "%s"', 'cloudtoggle' ), get_search_query() ) ) : esc_html__( 'Cloud cost guides for teams on AWS and Azure.', 'cloudtoggle' ); ?>
		</h1>
		<?php if ( ! is_search() ) : ?>
			<p class="mt-4 text-lg leading-8 text-ink-500"><?php esc_html_e( 'Practical advice on cutting waste, scheduling infrastructure and keeping cloud bills under control.', 'cloudtoggle' ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( have_posts() ) : ?>
		<div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/post-card' );
			}
			?>
		</div>
		<?php ct_pagination(); ?>
	<?php else : ?>
		<p class="mt-14 text-center text-ink-500"><?php esc_html_e( 'Nothing found.', 'cloudtoggle' ); ?></p>
	<?php endif; ?>
</section>
<?php
get_footer();
