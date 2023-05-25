<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package NirTheme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bootstrap_version = get_theme_mod( 'NirTheme_bootstrap_version', 'bootstrap4' );
$navbar_type       = get_theme_mod( 'NirTheme_navbar_type', 'collapse' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php NirTheme_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<header id="wrapper-navbar">

	<?php if(is_front_page()){?> <div class="home-content home-banner-cs" style="background-image: url('https://dev.quantumtech.asia/wp-content/uploads/2023/05/pexels-frans-van-heerden-1438832.jpg');"><div class="overlay-banner-cs"><?php } ?>


		<a class="skip-link <?php echo NirTheme_get_screen_reader_class( true ); ?>" href="#content">
			<?php esc_html_e( 'Skip to content', 'NirTheme' ); ?>
		</a>

		<?php get_template_part( 'global-templates/navbar', $navbar_type . '-' . $bootstrap_version ); ?>
		<?php if(is_front_page()){?><div class="banner-box upper-box-banner banner-box">
			<div class="centered-box-cs">
				<div class="banner-section">
					<div class="banner-row-1 banner-row"><span class="banner-heading-cs">
						By your side from search to close
					</span></div>
					<div class="banner-row-1 banner-row">
					<div class="search"><!----> <div class="autocomplete home"><div class="input right"><input id="textboxGeo" type="text" placeholder="Where do you want to live?" autocomplete="off"> <label for="textboxGeo" style="display: none;">Input box</label> <a href="javascript:;" aria-label="icon-search" rel="nofollow" class="btn normal link"><i class="icon-search"></i></a></div> <div class="autocomplete-list"><!----> <div><ul class="geo-list"><!----> <li class="geo-loc"><a rel="nofollow" class="row">
						<!-- <div class="col-xs-12 ellipsis geo-loc-title">Current Location <span></span></div> -->
						<!----></a> <i class="right icon-location-arrow"></i> <!----></li> <!----></ul></div></div></div></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
		
		<?php } ?>

	</header><!-- #wrapper-navbar -->