<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package NirTheme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'body_class', 'NirTheme_body_classes' );

if ( ! function_exists( 'NirTheme_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function NirTheme_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a body class based on the presence of a sidebar.
		$sidebar_pos = get_theme_mod( 'NirTheme_sidebar_position' );
		if ( is_page_template(
			array(
				'page-templates/fullwidthpage.php',
				'page-templates/no-title.php',
			)
		) ) {
			$classes[] = 'NirTheme-no-sidebar';
		} elseif (
			is_page_template(
				array(
					'page-templates/both-sidebarspage.php',
					'page-templates/left-sidebarpage.php',
					'page-templates/right-sidebarpage.php',
				)
			)
		) {
			$classes[] = 'NirTheme-has-sidebar';
		} elseif ( 'none' !== $sidebar_pos ) {
			$classes[] = 'NirTheme-has-sidebar';
		} else {
			$classes[] = 'NirTheme-no-sidebar';
		}

		return $classes;
	}
}

if ( function_exists( 'NirTheme_adjust_body_class' ) ) {
	/*
	 * NirTheme_adjust_body_class() deprecated in v0.9.4. We keep adding the
	 * filter for child themes which use their own NirTheme_adjust_body_class.
	 */
	add_filter( 'body_class', 'NirTheme_adjust_body_class' );
}

// Filter custom logo with correct classes.
add_filter( 'get_custom_logo', 'NirTheme_change_logo_class' );

if ( ! function_exists( 'NirTheme_change_logo_class' ) ) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return string
	 */
	function NirTheme_change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="img-fluid"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"', $html );

		return $html;
	}
}

if ( ! function_exists( 'NirTheme_pingback' ) ) {
	/**
	 * Add a pingback url auto-discovery header for single posts of any post type.
	 */
	function NirTheme_pingback() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">' . "\n";
		}
	}
}
add_action( 'wp_head', 'NirTheme_pingback' );

if ( ! function_exists( 'NirTheme_mobile_web_app_meta' ) ) {
	/**
	 * Add mobile-web-app meta.
	 */
	function NirTheme_mobile_web_app_meta() {
		echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr( get_bloginfo( 'name' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'NirTheme_mobile_web_app_meta' );

if ( ! function_exists( 'NirTheme_default_body_attributes' ) ) {
	/**
	 * Adds schema markup to the body element.
	 *
	 * @param array<string,string> $atts An associative array of attributes.
	 * @return array<string,string>
	 */
	function NirTheme_default_body_attributes( $atts ) {
		$atts['itemscope'] = '';
		$atts['itemtype']  = 'http://schema.org/WebSite';
		return $atts;
	}
}
add_filter( 'NirTheme_body_attributes', 'NirTheme_default_body_attributes' );

// Escapes all occurances of 'the_archive_description'.
add_filter( 'get_the_archive_description', 'NirTheme_escape_the_archive_description' );

if ( ! function_exists( 'NirTheme_escape_the_archive_description' ) ) {
	/**
	 * Escapes the description for an author or post type archive.
	 *
	 * @param string $description Archive description.
	 * @return string Maybe escaped $description.
	 */
	function NirTheme_escape_the_archive_description( $description ) {
		if ( is_author() || is_post_type_archive() ) {
			return wp_kses_post( $description );
		}

		/*
		 * All other descriptions are retrieved via term_description() which returns
		 * a sanitized description.
		 */
		return $description;
	}
} // End of if function_exists( 'NirTheme_escape_the_archive_description' ).

// Escapes all occurances of 'the_title()' and 'get_the_title()'.
add_filter( 'the_title', 'NirTheme_kses_title' );

// Escapes all occurances of 'the_archive_title' and 'get_the_archive_title()'.
add_filter( 'get_the_archive_title', 'NirTheme_kses_title' );

if ( ! function_exists( 'NirTheme_kses_title' ) ) {
	/**
	 * Sanitizes data for allowed HTML tags for titles.
	 *
	 * @param string $data Title to filter.
	 * @return string Filtered title with allowed HTML tags and attributes intact.
	 */
	function NirTheme_kses_title( $data ) {

		// Get allowed tags and protocols.
		$allowed_tags      = wp_kses_allowed_html( 'post' );
		$allowed_protocols = wp_allowed_protocols();
		if (
			in_array( 'polylang/polylang.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true )
			|| in_array( 'polylang-pro/polylang.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true )
		) {
			if ( ! in_array( 'data', $allowed_protocols, true ) ) {
				$allowed_protocols[] = 'data';
			}
		}

		if ( has_filter( 'NirTheme_kses_title' ) ) {
			/**
			 * Filters the allowed HTML tags and attributes in titles.
			 *
			 * @param array<string,array<string,bool>> $allowed_tags Allowed HTML tags and attributes in titles.
			 */
			$allowed_tags = apply_filters_deprecated( 'NirTheme_kses_title', array( $allowed_tags ), '1.2.0' );
		}

		return wp_kses( $data, $allowed_tags, $allowed_protocols );
	}
} // End of if function_exists( 'NirTheme_kses_title' ).

if ( ! function_exists( 'NirTheme_hide_posted_by' ) ) {
	/**
	 * Hides the posted by markup in `NirTheme_posted_on()`.
	 *
	 * @since 1.0.0
	 *
	 * @param string $byline Posted by HTML markup.
	 * @return string Maybe filtered posted by HTML markup.
	 */
	function NirTheme_hide_posted_by( $byline ) {
		if ( is_author() ) {
			return '';
		}
		return $byline;
	}
}
add_filter( 'NirTheme_posted_by', 'NirTheme_hide_posted_by' );


add_filter( 'excerpt_more', 'NirTheme_custom_excerpt_more' );

if ( ! function_exists( 'NirTheme_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function NirTheme_custom_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = '';
		}
		return $more;
	}
}

add_filter( 'wp_trim_excerpt', 'NirTheme_all_excerpts_get_more_link' );

if ( ! function_exists( 'NirTheme_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function NirTheme_all_excerpts_get_more_link( $post_excerpt ) {
		if ( is_admin() || ! get_the_ID() ) {
			return $post_excerpt;
		}

		$permalink = esc_url( get_permalink( (int) get_the_ID() ) ); // @phpstan-ignore-line -- post exists

		return $post_excerpt . ' [...]<p><a class="btn btn-secondary NirTheme-read-more-link" href="' . $permalink . '">' . __(
			'Read More...',
			'NirTheme'
		) . '<span class="screen-reader-text"> from ' . get_the_title( get_the_ID() ) . '</span></a></p>';

	}
}
