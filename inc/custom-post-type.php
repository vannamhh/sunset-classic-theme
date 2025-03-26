<?php
/**
 * @package sunset-classic-theme
 */

$activate_form = get_option( 'activate_form' );
if ( isset( $activate_form ) && '1' === $activate_form ) {
	add_action( 'init', 'sunset_contact_custom_post_type' );
	add_filter( 'manage_sunset-contact_posts_columns', 'sunset_set_contact_columns' );
	add_filter( 'manage_sunset-contact_posts_custom_column', 'sunset_contact_custom_column', 10, 2 );
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

	register_post_type( 'sunset-contact', $args );
}

function sunset_set_contact_columns( $columns ) {
	$new_columns            = array();
	$new_columns['title']   = 'Full Name';
	$new_columns['message'] = 'Message';
	$new_columns['email']   = 'Email';
	$new_columns['date']    = 'Date';
	return $new_columns;
}

function sunset_contact_custom_column( $column, $post_id ) {
	switch ( $column ) {
		case 'message':
			echo get_the_excerpt();
			break;

		case 'email':
			echo 'email address';
			break;
		default:
			break;
	}
}
