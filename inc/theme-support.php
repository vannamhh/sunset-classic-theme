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

/**
 * Activate Nav Menu Option
 */
function sunset_register_nav_menu() {
	register_nav_menu( 'primary', 'Header Navigation Menu' );
}
add_action( 'after_setup_theme', 'sunset_register_nav_menu' );

/**
 * Add class bootstrap to menu link
 */
function add_bootstrap_link_class( $atts, $item, $args, $depth ) {
	if ( isset( $args->menu_class ) && strpos( $args->menu_class, 'navbar-nav' ) !== false ) {
			$atts['class'] = 'nav-link';
	}
	return $atts;
}
// add_filter( 'nav_menu_link_attributes', 'add_bootstrap_link_class', 10, 4 );
