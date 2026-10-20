<?php
/**
 * Blog card (matches PostCard.astro).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article <?php post_class( 'group relative flex flex-col overflow-hidden rounded-2xl border border-ink-100 bg-white shadow-card transition duration-300 hover:-translate-y-1 hover:border-brand-200' ); ?>>
	<div class="aspect-[16/9] overflow-hidden bg-ink-50">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'ct-card', [ 'class' => 'size-full object-cover transition duration-500 group-hover:scale-[1.03]', 'loading' => 'lazy', 'alt' => esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) ] ); ?>
		<?php else : ?>
			<div class="flex size-full items-center justify-center bg-gradient-to-br from-brand-50 to-ink-50 font-mono text-xs text-ink-400">CLOUD TOGGLE</div>
		<?php endif; ?>
	</div>
	<div class="flex flex-1 flex-col p-6">
		<p class="font-mono text-xs text-ink-400">
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'j M Y' ) ); ?></time>
			<span> &middot; <?php echo esc_html( ct_reading_time() ); ?></span>
		</p>
		<h2 class="mt-3 text-lg font-semibold leading-snug tracking-tight text-ink-950">
			<a href="<?php the_permalink(); ?>" class="after:absolute after:inset-0"><?php the_title(); ?></a>
		</h2>
		<p class="mt-2 line-clamp-3 text-sm leading-6 text-ink-500"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
	</div>
</article>
