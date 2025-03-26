<h1>Sunset Theme Support</h1>
<?php settings_errors(); ?>
<?php
	// $picture     = get_option( 'profile_picture' );
?>



<form action="options.php" method="post" class="sunset-general-form">
	<?php settings_fields( 'sunset-theme-support' ); ?>
	<?php do_settings_sections( 'vn_sunset_theme' ); ?>
	<?php submit_button(); ?>
</form>

</div>
