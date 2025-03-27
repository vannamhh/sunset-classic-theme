<h1>Sunset Contact Form</h1>
<?php settings_errors(); ?>

<form action="options.php" method="post" class="sunset-general-form">
	<?php settings_fields( 'sunset-contact-options' ); ?>
	<?php do_settings_sections( 'vn_sunset_contact' ); ?>
	<?php submit_button(); ?>
</form>

</div>
