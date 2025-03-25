<?php
/**
 * @package sunset-classic-theme
 */
function sunset_add_admin_page() {
	// Generate Sunset Admin Page.
	add_menu_page(
		'Sunset Theme Options',
		'Sunset',
		'manage_options',
		'vn_sunset',
		'sunset_theme_create_page',
		get_template_directory_uri() . '/img/sunset-icon.png',
		110
	);

	// Generate Sunset Admin Sub Pages.
	add_submenu_page(
		'vn_sunset',
		'Sunset Theme Options',
		'General',
		'manage_options',
		'vn_sunset',
		'sunset_theme_create_page'
	);

	add_submenu_page(
		'vn_sunset',
		'Sunset CSS Options',
		'Custom CSS',
		'manage_options',
		'vn_sunset_css',
		'sunset_theme_settings_page'
	);

	// Activate custom settings.
	add_action( 'admin_init', 'sunset_custom_settings' );
}
add_action( 'admin_menu', 'sunset_add_admin_page' );

function sunset_custom_settings() {
	register_setting( 'sunset-settings-group', 'first_name' );
	register_setting( 'sunset-settings-group', 'last_name' );
	register_setting( 'sunset-settings-group', 'twitter_handler', 'sunset_sanitize_twitter_handler' );
	register_setting( 'sunset-settings-group', 'facebook_handler' );
	register_setting( 'sunset-settings-group', 'gplus_handler' );

	add_settings_section( 'sunset-sidebar-options', 'Sidebar Option', 'sunset_sidebar_options', 'vn_sunset' );

	add_settings_field( 'sidebar-name', 'Full Name', 'sunset_sidebar_name', 'vn_sunset', 'sunset-sidebar-options' );
	add_settings_field( 'sidebar-twitter', 'Twitter handler', 'sunset_sidebar_twitter', 'vn_sunset', 'sunset-sidebar-options' );
	add_settings_field( 'sidebar-facebook', 'Facebook handler', 'sunset_sidebar_facebook', 'vn_sunset', 'sunset-sidebar-options' );
	add_settings_field( 'sidebar-gplug', 'Google+ handler', 'sunset_sidebar_gplus', 'vn_sunset', 'sunset-sidebar-options' );
}

function sunset_sidebar_options() {
	echo 'Customize your Sidebar information';
}

function sunset_sidebar_name() {
	$first_name = get_option( 'first_name' );
	$last_name  = get_option( 'last_name' );
	echo '
  <input type="text" name="first_name" value="' . esc_attr( $first_name ) . '" placeholder="First Name" />
  <input type="text" name="last_name" value="' . esc_attr( $last_name ) . '" placeholder="Last Name" />
  ';
}

function sunset_sidebar_twitter() {
	$twitter = get_option( 'twitter_handler' );
	echo '
  <input type="text" name="twitter_handler" value="' . esc_attr( $twitter ) . '" placeholder="Twitter handler" />
  <p class="description">Input your Twitter username without the @ character.</p>
  ';
}

function sunset_sidebar_facebook() {
	$facebook = get_option( 'facebook_handler' );
	echo '<input type="text" name="facebook_handler" value="' . esc_attr( $facebook ) . '" placeholder="Facebook handler" />';
}

function sunset_sidebar_gplus() {
	$gplus = get_option( 'gplus_handler' );
	echo '<input type="text" name="gplus_handler" value="' . esc_attr( $gplus ) . '" placeholder="Google+ handler" />';
}

// Sanitize Settings.
function sunset_sanitize_twitter_handler( $input ) {
	$output = sanitize_text_field( $input );
	$output = str_replace( '@', '', $output );
	return $output;
}

function sunset_theme_create_page() {
	// generation of our admin page.
	require_once get_template_directory() . '/inc/templates/sunset-admin.php';
}

function sunset_theme_settings_page() {
}
