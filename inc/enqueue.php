<?php
/**
 * Enqueue js và css
 *
 * @package sunsettheme
 */

// Admin script.
function sunset_load_admin_scripts( $hook ) {

	if ( 'toplevel_page_vn_sunset' === $hook ) {

		wp_register_style(
			'sunset-admin',
			get_template_directory_uri() . '/css/sunset.admin.css',
			array(),
			'1.0.0',
			'all'
		);
		wp_enqueue_style( 'sunset-admin' );

		wp_enqueue_media();

		wp_register_script(
			'sunset-admin-script',
			get_template_directory_uri() . '/js/sunset.admin.js',
			array( 'jquery' ),
			'1.0.0',
			true
		);
		wp_enqueue_script( 'sunset-admin-script' );

	} elseif ( 'sunset_page_vn_sunset_css' === $hook ) {

		wp_enqueue_style(
			'ace',
			get_template_directory_uri() . '/css/sunset.ace.css',
			array(),
			'1.0.0',
			'all'
		);

		wp_enqueue_script(
			'ace',
			get_template_directory_uri() . '/js/ace/ace.js',
			array( 'jquery' ),
			'1.39.1',
			true
		);

		wp_enqueue_script(
			'sunset-custom-css-script',
			get_template_directory_uri() . '/js/sunset.custom_css.js',
			array( 'jquery' ),
			'1.39.1',
			true
		);

	} else {
		return;
	}
}
add_action( 'admin_enqueue_scripts', 'sunset_load_admin_scripts' );


/**
 * Front end enqueue functions
 */
function sunset_load_scripts() {
	wp_enqueue_style(
		'bootstrap',
		get_template_directory_uri() . '/css/bootstrap.min.css',
		array(),
		'5.3.3',
		'all'
	);

	wp_enqueue_style(
		'sunset',
		get_template_directory_uri() . '/css/sunset.css',
		array(),
		'1.0.0',
		'all'
	);

	wp_enqueue_script(
		'bootstrap',
		get_template_directory_uri() . '/js/bootstrap.bundle.min.js',
		array(),
		'5.3.3',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'sunset_load_scripts' );
