<?php
/**
 * @package sunset-classic-theme
 */

$activate_form = get_option( 'activate_form' );
if ( isset( $activate_form ) && '1' === $activate_form ) {
	add_action( 'init', 'sunset_contact_custom_post_type' );
}

/** Contact CPT */
function sunset_contact_custom_post_type() {
	$labels = array(
		'name'           => 'Message',
		'singular_name'  => 'Message',
		'menu_name'      => 'Messages',
		'name_admin_bar' => 'Message',
	);

	$args = array(
		'labels'          => $labels,
		'show_ui'         => true,
		'show_in_menu'    => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'menu_position'   => 26,
		'menu_icon'       => 'dashicons-email-alt',
		'supports'        => array( 'title', 'editor', 'author' ),
	);

	register_post_type( 'sunset_contact', $args );
}
