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
add_theme_support( 'custom-header' );
add_theme_support( 'custom-background' );
add_theme_support( 'post-thumbnails' );


/**
 * Activate Nav Menu Option
 */
function sunset_register_nav_menu() {
	register_nav_menu( 'primary', 'Header Navigation Menu' );
}
add_action( 'after_setup_theme', 'sunset_register_nav_menu' );

/**
 * Blog loop custom functions
 */
function sunset_posted_meta() {
	$posted_on  = human_time_diff( get_the_time( 'U' ), time() );
	$categories = get_the_category();
	$separator  = ', ';
	$output     = '';
	$i          = 1;

	if ( ! empty( $categories ) ) :
		foreach ( $categories as $category ) :
			if ( $i > 1 ) :
				$output .= $separator;
			endif;
			/* translators: %s: category name */
			$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( 'View all posts in %s', 'sunsettheme' ), $category->name ) ) . '" >' . esc_html( $category->name ) . '</a>';
			++$i;
		endforeach;
	endif;

	$posted_meta = '
		<span class="posted-on">' . __( 'Posted' ) . ' <a href="' . esc_url( get_permalink() ) . '">' . $posted_on . '</a> ' . esc_html__( 'ago', 'sunsettheme' ) . '</span> / 
		<span class="posted-in">' . $output . '</span>
	';
	return $posted_meta;
}

function sunset_posted_footer() {
	return 'entry footer';
}
