<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Lets editors change the three conversion links used in the header and templates. */
add_action( 'customize_register', function ( WP_Customize_Manager $wp_customize ) {
	$wp_customize->add_section( 'ct_links', [
		'title'       => __( 'Conversion links', 'cloudtoggle' ),
		'description' => __( 'Used by the header buttons and blog call-to-action.', 'cloudtoggle' ),
		'priority'    => 30,
	] );
	$fields = [
		'trial' => [ __( 'Start Free Trial URL', 'cloudtoggle' ), '/?add-to-cart=285' ],
		'demo'  => [ __( 'Book a Demo URL', 'cloudtoggle' ), 'https://calendly.com/cloudtoggle/30min' ],
		'login' => [ __( 'Log in URL', 'cloudtoggle' ), '/app/' ],
	];
	foreach ( $fields as $key => [ $label, $default ] ) {
		$wp_customize->add_setting( 'ct_' . $key . '_url', [
			'default'           => $default,
			'sanitize_callback' => 'esc_url_raw',
		] );
		$wp_customize->add_control( 'ct_' . $key . '_url', [
			'label'   => $label,
			'section' => 'ct_links',
			'type'    => 'url',
		] );
	}
} );
