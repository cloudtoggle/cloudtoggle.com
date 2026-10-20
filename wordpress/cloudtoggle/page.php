<?php
/**
 * Standard page: readable prose container. WooCommerce / account pages get a wider plain container.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
$is_shop = function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() );
while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'mx-auto px-5 py-16 sm:px-8 sm:py-24 ' . ( $is_shop ? 'max-w-5xl' : 'max-w-3xl' ) ); ?>>
		<h1 class="h-display text-4xl sm:text-5xl"><?php the_title(); ?></h1>
		<div class="<?php echo $is_shop ? 'ct-shop' : 'prose-ct'; ?> mt-10"><?php the_content(); ?></div>
	</article>
<?php endwhile;
get_footer();
