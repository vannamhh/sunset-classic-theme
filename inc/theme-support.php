<?php
/**
 * Theme Support Options
 * Not use
 *
 * @package sunsettheme
 */

$option_list = get_option( 'post-formats' );
$format_list = array(
	'aside',
	'gallery',
	'link',
	'image',
	'quote',
	'status',
	'video',
	'audio',
	'chat',
);
$output      = array();

foreach ( $format_list as $format ) {
	$output[] = ( isset( $option_list[ $format ] ) && '1' === $option_list[ $format ] ) ? $format : '';
}
if ( ! empty( $option_list ) ) {
	add_theme_support( 'post-format', $output );
}

/**
 * Add custom header.
 */
function sunset_custom_header_setup() {
	add_theme_support(
		'custom-header',
		array(
			'width'       => 1200,
			'height'      => 280,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'sunset_custom_header_setup' );
