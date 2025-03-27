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
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<title>
		<?php
		bloginfo( 'name' );
		wp_title();
		?>
	</title>
	<?php wp_head(); ?>
	</head>

<body <?php body_class(); ?>>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<header class="header-container position-relative w-100 d-flex flex-column align-items-center background-image" style="background-image: url(<?php header_image(); ?>);">
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
				<div class="nav-container w-100">
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<nav class="navbar navbar-expand-lg nav-sunset" data-bs-theme="dark">

							<?php
								wp_nav_menu(
									array(
										'theme_location'  => 'primary',
										'container_class' => 'collapse navbar-collapse justify-content-center',
										'container_id'    => 'navbarNav',
										'menu_class'      => 'navbar-nav text-uppercase fw-bold text-light-emphasis gap-5',
										'walker'          => new Sunset_Walker_Nav_Primary(),
									)
								);
								?>
					</nav><!-- .navbar -->
				</div><!-- .nav-container -->
			</header>
		</div>
	</div>
</div>
