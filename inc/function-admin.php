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
	add_settings_section( 'sunset-sidebar-options', 'Sidebar Option', 'sunset_sidebar_options', 'vn_sunset' );
	add_settings_field( 'sidebar-name', 'First Name', 'sunset_sidebar_name', 'vn_sunset', 'sunset-sidebar-options' );
}

function sunset_sidebar_options() {
	echo 'Customize your Sidebar information';
}

function sunset_sidebar_name() {
	$first_name = get_option( 'first_name' );
	echo '<input type="text" name="first_name" value="' . esc_attr( $first_name ) . '" placeholder="First Name" />';
}

function sunset_theme_create_page() {
	// generation of our admin page.
	require_once get_template_directory() . '/inc/templates/sunset-admin.php';
}

function sunset_theme_settings_page() {
}
