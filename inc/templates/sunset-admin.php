<h1>Sunset Sidebar Options</h1>
<?php settings_errors(); ?>
<?php
	$picture     = get_option( 'profile_picture' );
	$first_name  = get_option( 'first_name' );
	$last_name   = get_option( 'last_name' );
	$full_name   = $first_name . ' ' . $last_name;
	$description = get_option( 'user_description' );
?>
<div class="sunset-general-container">
<div class="sunset-sidebar-preview">
	<div class="sunset-sidebar">
		<div class="image-container">
			<div class="profile-picture-preview" style="background-image: url(<?php print esc_attr( $picture ); ?>)">
			</div>
		</div>
	<h1 class="sunset-username"><?php print esc_attr( $full_name ); ?></h1>
	<h2 class="sunset-description"><?php print esc_attr( $description ); ?></h2>
	<div class="icons-wrapper">
	  
	</div>
	</div>
</div>

<form action="options.php" method="post" class="sunset-general-form">
	<?php settings_fields( 'sunset-settings-group' ); ?>
	<?php do_settings_sections( 'vn_sunset' ); ?>
	<?php submit_button(); ?>
</form>

</div>
