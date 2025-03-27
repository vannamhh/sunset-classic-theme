<?php
/**
 * @package sunsettheme
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
		'Sunset Sidebar Options',
		'Sidebar',
		'manage_options',
		'vn_sunset',
		'sunset_theme_create_page'
	);

	add_submenu_page(
		'vn_sunset',
		'Sunset Theme Options',
		'Theme Options',
		'manage_options',
		'vn_sunset_theme',
		'sunset_theme_support_page'
	);

	add_submenu_page(
		'vn_sunset',
		'Sunset Contact Form',
		'Contact',
		'manage_options',
		'vn_sunset_contact',
		'sunset_contact_form_page'
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
	// Sidebar Options
	register_setting( 'sunset-settings-group', 'profile_picture' );
	register_setting( 'sunset-settings-group', 'first_name' );
	register_setting( 'sunset-settings-group', 'last_name' );
	register_setting( 'sunset-settings-group', 'user_description' );
	register_setting( 'sunset-settings-group', 'twitter_handler', 'sunset_sanitize_twitter_handler' );
	register_setting( 'sunset-settings-group', 'facebook_handler' );
	register_setting( 'sunset-settings-group', 'gplus_handler' );

	add_settings_section(
		'sunset-sidebar-options',
		'Sidebar Option',
		'sunset_sidebar_options',
		'vn_sunset'
	);

	add_settings_field(
		'sidebar-profile-picture',
		'Profile picture',
		'sunset_sidebar_profile_picture',
		'vn_sunset',
		'sunset-sidebar-options'
	);
	add_settings_field(
		'sidebar-name',
		'Full Name',
		'sunset_sidebar_name',
		'vn_sunset',
		'sunset-sidebar-options'
	);
	add_settings_field(
		'sidebar-description',
		'Description',
		'sunset_sidebar_description',
		'vn_sunset',
		'sunset-sidebar-options'
	);
	add_settings_field(
		'sidebar-twitter',
		'Twitter handler',
		'sunset_sidebar_twitter',
		'vn_sunset',
		'sunset-sidebar-options'
	);
	add_settings_field(
		'sidebar-facebook',
		'Facebook handler',
		'sunset_sidebar_facebook',
		'vn_sunset',
		'sunset-sidebar-options'
	);
	add_settings_field(
		'sidebar-gplug',
		'Google+ handler',
		'sunset_sidebar_gplus',
		'vn_sunset',
		'sunset-sidebar-options'
	);

	// Theme Support Options.
	register_setting( 'sunset-theme-support', 'post_formats', 'sunset_post_formats_callback' );

	add_settings_section(
		'sunset-theme-options',
		'Theme Options',
		'sunset_theme_options',
		'vn_sunset_theme'
	);

	add_settings_field(
		'post-formats',
		'Post Formats',
		'sunset_post_format',
		'vn_sunset_theme',
		'sunset-theme-options'
	);

	// Theme Contact Form.
	register_setting( 'sunset-contact-options', 'activate_form', 'sunset_sanitize_custom_css' );

	add_settings_section(
		'sunset-contact-section',
		'Contact Form Options',
		'sunset_activate_section',
		'vn_sunset_contact'
	);

	add_settings_field(
		'activate-form',
		'Activate Contact Form',
		'sunset_activate_contact',
		'vn_sunset_contact',
		'sunset-contact-section'
	);

	// Custom CSS Options
	register_setting( 'sunset-custom-css-options', 'sunset_css' );

	add_settings_section(
		'sunset-custom-css-section',
		'Custom CSS',
		'sunset_custom_css_section_callback',
		'vn_sunset_css'
	);

	add_settings_field(
		'custom-css',
		'Insert your Custom CSS',
		'sunset_custom_css_callback',
		'vn_sunset_css',
		'sunset-custom-css-section'
	);
}

function sunset_custom_css_section_callback() {
	echo 'Customize Sunset Theme with your own CSS';
}

function sunset_custom_css_callback() {
	$css = get_option( 'sunset_css' );
	$css = empty( $css ) ? '/* Sunset Theme Custom CSS */' : $css;
	echo '<div id="customCss">' . esc_attr( $css ) . '</div>';
	echo '<textarea id="sunset_css" name="sunset_css" style="display: none; visibility: hidden;">' . esc_attr( $css ) . '</textarea>';
}

// Post Formats Callback Function.
function sunset_post_formats_callback( $input ) {
	return $input;
}

function sunset_theme_options() {
	echo 'Active and Deactive specific Theme Support Options';
}

function sunset_post_format() {
	$option_list = get_option( 'post_formats' );

	$format_list = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
	$output      = '';
	foreach ( $format_list as $format ) {
		$checked = isset( $option_list[ $format ] ) && '1' === $option_list[ $format ] ? 'checked' : '';
		$output .= '<label><input type="checkbox" id="' . $format . '" name="post_formats[' . $format . ']" value="1" ' . $checked . ' /> ' . $format . '</label><br/>';
	}
	echo $output;
}

// Contact Form.
function sunset_activate_section() {
	echo 'Activate and Deactivate the Built-in Contact Form';
}

function sunset_activate_contact() {
	$active  = get_option( 'activate_form' );
	$checked = isset( $active ) && '1' === $active ? 'checked' : '';
	echo '<label><input type="checkbox" name="activate_form" value="1" ' . $checked . '/></label>';
}



// Sidebar Options Functions.
function sunset_sidebar_options() {
}

function sunset_sidebar_profile_picture() {
	$picture = get_option( 'profile_picture' );
	echo '
  <input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"/>
  <input type="hidden" id="profile-picture" name="profile_picture" value="' . esc_attr( $picture ) . '"/>
  ';
}

function sunset_sidebar_name() {
	$first_name = get_option( 'first_name' );
	$last_name  = get_option( 'last_name' );
	echo '
  <input type="text" name="first_name" value="' . esc_attr( $first_name ) . '" placeholder="First Name" />
  <input type="text" name="last_name" value="' . esc_attr( $last_name ) . '" placeholder="Last Name" />
  ';
}

function sunset_sidebar_description() {
	$description = get_option( 'user_description' );
	echo '
  <input type="text" name="user_description" value="' . esc_attr( $description ) . '" placeholder="Description" />
  <p class="description">Write somthing smart.</p>
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

function sunset_sanitize_custom_css( $input ) {
	$output = esc_textarea( $input );
	return $output;
}

// Template submenu functions.
function sunset_theme_create_page() {
	// generation of our admin page.
	require_once get_template_directory() . '/inc/templates/sunset-admin.php';
}

function sunset_theme_support_page() {
	require_once get_template_directory() . '/inc/templates/sunset-theme-support.php';
}

function sunset_theme_settings_page() {
	require_once get_template_directory() . '/inc/templates/sunset-custom-css.php';
}

function sunset_contact_form_page() {
	require_once get_template_directory() . '/inc/templates/sunset-contact-form.php';
}
