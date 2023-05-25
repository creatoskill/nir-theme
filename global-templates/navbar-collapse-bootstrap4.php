<?php
/**
 * Header Navbar (bootstrap4)
 *
 * @package NirTheme
 * @since 1.1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'NirTheme_container_type' );
if(is_front_page(  )){
?>
<nav id="main-nav" class="navbar navbar-expand-md navbar-light" aria-labelledby="main-nav-label">

	<h2 id="main-nav-label" class="screen-reader-text">
		<?php esc_html_e( 'Main Navigation', 'NirTheme' ); ?>
	</h2>


<?php if ( 'container' === $container ) : ?>
	<div class="container">
<?php endif; ?>

		<?php get_template_part( 'global-templates/navbar-branding' ); ?>

		<button
			class="navbar-toggler"
			type="button"
			data-toggle="collapse"
			data-target="#navbarNavDropdown"
			aria-controls="navbarNavDropdown"
			aria-expanded="false"
			aria-label="<?php esc_attr_e( 'Toggle navigation', 'NirTheme' ); ?>"
		>
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- The WordPress Menu goes here -->
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'navbarNavDropdown',
				'menu_class'      => 'navbar-nav mr-5 ml-auto',
				'fallback_cb'     => '',
				'menu_id'         => 'main-menu',
				'depth'           => 2,
				'walker'          => new NirTheme_WP_Bootstrap_Navwalker(),
			)
		);
		?>

<?php if ( 'container' === $container ) : ?>
	</div><!-- .container -->
<?php endif; ?>

</nav><!-- #main-nav -->
<?php
}else{
?>
<nav id="main-nav" class="navbar navbar-off-home navbar-expand-md navbar-light" aria-labelledby="main-nav-label">

<h2 id="main-nav-label" class="screen-reader-text">
	<?php esc_html_e( 'Main Navigation', 'NirTheme' ); ?>
</h2>


<?php if ( 'container' === $container ) : ?>
<div class="container">
<?php endif; ?>

	<?php get_template_part( 'global-templates/navbar-branding' ); ?>

	<button
		class="navbar-toggler"
		type="button"
		data-toggle="collapse"
		data-target="#navbarNavDropdown"
		aria-controls="navbarNavDropdown"
		aria-expanded="false"
		aria-label="<?php esc_attr_e( 'Toggle navigation', 'NirTheme' ); ?>"
	>
		<span class="navbar-toggler-icon"></span>
	</button>

	<!-- The WordPress Menu goes here -->
	<?php
	wp_nav_menu(
		array(
			'theme_location'  => 'primary',
			'container_class' => 'collapse navbar-collapse',
			'container_id'    => 'navbarNavDropdown',
			'menu_class'      => 'navbar-nav ml-auto mr-5 nav-off-home-menu',
			'fallback_cb'     => '',
			'menu_id'         => 'main-menu',
			'depth'           => 2,
			'walker'          => new NirTheme_WP_Bootstrap_Navwalker(),
		)
	);
	?>

<?php if ( 'container' === $container ) : ?>
</div><!-- .container -->
<?php endif; ?>

</nav><!-- #main-nav -->
<?php
}
?>
