<?php
/**
 * @package sunsettheme
 * Theme Support Options
 * Not use
 */

$option_list = get_option( 'post-formats' );
$format_list = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
$output      = array();
foreach ( $format_list as $format ) {
	$output[] = ( isset( $option_list[ $format ] ) && '1' === $option_list[ $format ] ) ? $format : '';
}
if ( ! empty( $option_list ) ) {
	add_theme_support( 'post-format', $output );
}
