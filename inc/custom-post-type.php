<?php
/**
 * @package sunsettheme
 */

$activate_form = get_option( 'activate_form' );
if ( isset( $activate_form ) && '1' === $activate_form ) {
	add_action( 'init', 'sunset_contact_custom_post_type' );

	add_filter( 'manage_sunset-contact_posts_columns', 'sunset_set_contact_columns' );
	add_action( 'manage_sunset-contact_posts_custom_column', 'sunset_contact_custom_column', 10, 2 );

	add_action( 'add_meta_boxes', 'sunset_contact_add_meta_box' );
	add_action( 'save_post', 'sunset_save_contact_email_data' );
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
			echo esc_attr( get_the_excerpt() );
			break;
		case 'email':
			$email = get_post_meta( $post_id, '_contact_email_value_key', true );
			echo esc_attr( $email );
			break;
		default:
			break;
	}
}

/** Contact meta boxes */
function sunset_contact_add_meta_box() {
	add_meta_box(
		'contact_email',
		'User Email',
		'sunset_contact_email_callback',
		'sunset-contact',
		'side'
	);
}

function sunset_contact_email_callback( $post ) {
	wp_nonce_field( 'sunset_save_contact_email_data', 'sunset_contact_email_meta_box_nonce' );

	$value = get_post_meta( $post->ID, '_contact_email_value_key', true );

	echo '<label for="sunset_contact_email_field">User Email Adress: </label>';
	echo '<input type="email" id="sunset_contact_email_field" name="sunset_contact_email_field" value="' . esc_attr( $value ) . '" size="25" />';
}

function sunset_save_contact_email_data( $post_id ) {
	if ( ! isset( $_POST['sunset_contact_email_meta_box_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sunset_contact_email_meta_box_nonce'] ) ), 'sunset_save_contact_email_data' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( ! isset( $_POST['sunset_contact_email_field'] ) ) {
		return;
	}

	$email = sanitize_text_field( wp_unslash( $_POST['sunset_contact_email_field'] ) );

	update_post_meta( $post_id, '_contact_email_value_key', $email );
}
