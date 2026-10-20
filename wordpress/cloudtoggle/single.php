<?php
/**
 * Single blog post (matches the Astro post layout).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
while ( have_posts() ) :
	the_post();
	$cats = get_the_category();
	?>
	<article <?php post_class( 'mx-auto max-w-3xl px-5 pb-8 pt-14 sm:px-8 sm:pt-20' ); ?>>
		<nav aria-label="<?php esc_attr_e( 'Breadcrumb', 'cloudtoggle' ); ?>" class="font-mono text-xs text-ink-400">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-ink-950"><?php esc_html_e( 'Home', 'cloudtoggle' ); ?></a> /
			<a href="<?php echo esc_url( ct_blog_url() ); ?>" class="hover:text-ink-950"><?php esc_html_e( 'Blog', 'cloudtoggle' ); ?></a>
		</nav>
		<h1 class="h-display mt-5 text-3xl sm:text-5xl sm:leading-[1.08]"><?php the_title(); ?></h1>
		<p class="mt-5 font-mono text-xs text-ink-400">
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></time>
			<span> &middot; <?php echo esc_html( ct_reading_time() ); ?></span>
		</p>
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'large', [ 'class' => 'mt-10 aspect-[16/9] w-full rounded-2xl border border-ink-100 object-cover', 'fetchpriority' => 'high' ] ); ?>
		<?php endif; ?>

		<div class="prose-ct mt-10"><?php the_content(); ?></div>

		<aside class="relative isolate mt-16 overflow-hidden rounded-2xl bg-night p-8 text-center sm:p-10">
			<div class="pointer-events-none absolute -top-24 left-1/2 -z-10 h-56 w-[500px] -translate-x-1/2 rounded-full bg-brand-500/30 blur-3xl" aria-hidden="true"></div>
			<h2 class="text-2xl font-semibold tracking-tight text-white"><?php esc_html_e( "Stop paying for servers you're not using", 'cloudtoggle' ); ?></h2>
			<p class="mx-auto mt-3 max-w-md text-ink-200"><?php esc_html_e( 'Schedule your AWS and Azure servers off outside working hours with CLOUD TOGGLE.', 'cloudtoggle' ); ?></p>
			<div class="mt-6 flex flex-col justify-center gap-3 sm:flex-row">
				<a href="<?php echo esc_url( ct_cta_url( 'trial' ) ); ?>" class="inline-flex h-10 items-center justify-center rounded-full bg-white px-5 text-sm font-medium text-ink-950 transition hover:bg-brand-50"><?php esc_html_e( 'Start Free Trial', 'cloudtoggle' ); ?></a>
				<a href="<?php echo esc_url( ct_cta_url( 'demo' ) ); ?>" rel="noopener" class="inline-flex h-10 items-center justify-center rounded-full border border-white/25 px-5 text-sm font-medium text-white transition hover:bg-white/10"><?php esc_html_e( 'Book a Demo', 'cloudtoggle' ); ?></a>
			</div>
		</aside>
	</article>

	<?php
	$related = new WP_Query( [
		'post_type'           => 'post',
		'posts_per_page'      => 3,
		'post__not_in'        => [ get_the_ID() ],
		'category__in'        => wp_list_pluck( $cats, 'term_id' ),
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	] );
	if ( $related->have_posts() ) :
		?>
		<section class="mx-auto max-w-6xl px-5 pb-24 pt-12 sm:px-8">
			<h2 class="text-xl font-semibold tracking-tight text-ink-950"><?php esc_html_e( 'More from the blog', 'cloudtoggle' ); ?></h2>
			<div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
				<?php
				while ( $related->have_posts() ) {
					$related->the_post();
					get_template_part( 'template-parts/post-card' );
				}
				wp_reset_postdata();
				?>
			</div>
		</section>
	<?php endif; ?>
<?php endwhile;
get_footer();
