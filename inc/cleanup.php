<?php
/**
 * Remove generator version number
 *
 * @package sunsettheme
 */

/**
 * Remove version string from js and css
 *
 * @param string $src Script or style source URL.
 * @return string Modified source URL without version string.
 */
function sunset_remove_wp_version_strings( $src ) {
	global $wp_version;
	$query_string = wp_parse_url( $src, PHP_URL_QUERY );
	if ( $query_string ) {
		parse_str( $query_string, $query );
		if ( ! empty( $query['ver'] ) && $query['ver'] === $wp_version ) {
			$src = remove_query_arg( 'ver', $src );
		}
	}
	return $src;
}

add_filter( 'script_loader_src', 'sunset_remove_wp_version_strings' );
add_filter( 'style_loader_src', 'sunset_remove_wp_version_strings' );

/**
 * Remove metatag generator from header
 */
function sunset_remove_meta_version() {
	return '';
}
add_filter( 'the_generator', 'sunset_remove_meta_version' );
