<?php
/**
 * The header for our theme
 *
 * @package sunsettheme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
	</head>

<body <?php body_class(); ?>>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="header-container position-relative w-100 d-flex flex-column align-items-center background-image" style="background-image: url(<?php header_image(); ?>);">
				<div class="header-content d-flex flex-column justify-content-center align-items-center flex-fill">
					<h1 class="site-title text-light sunset-icon">
						<span class="sunset-logo"></span>
						<span class="d-none">
							<?php bloginfo( 'name' ); ?>
						</span>
					</h1>
					<h2 class="site-description text-light fw-bold small">
						<?php bloginfo( 'description' ); ?>
					</h2>
				</div>
				<div class="nav-container">

				</div>
			</div>
		</div>
	</div>
</div>
