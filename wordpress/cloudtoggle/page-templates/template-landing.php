<?php
/**
 * Template Name: Landing page (full width, no title)
 * Template Post Type: page
 *
 * Renders the page content edge to edge with no title or container, so section HTML from
 * wordpress/page-content/ (pasted into a Custom HTML block or page-builder HTML widget) lays out as designed.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
while ( have_posts() ) {
	the_post();
	the_content();
}
get_footer();
