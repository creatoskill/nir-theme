<?php
/**
 * NirTheme modify editor
 *
 * @package NirTheme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'admin_init', 'NirTheme_wpdocs_theme_add_editor_styles' );

if ( ! function_exists( 'NirTheme_wpdocs_theme_add_editor_styles' ) ) {
	/**
	 * Registers an editor stylesheet for the theme.
	 */
	function NirTheme_wpdocs_theme_add_editor_styles() {
		add_editor_style( 'css/custom-editor-style.min.css' );
	}
}

add_filter( 'mce_buttons_2', 'NirTheme_tiny_mce_style_formats' );

if ( ! function_exists( 'NirTheme_tiny_mce_style_formats' ) ) {
	/**
	 * Reveals TinyMCE's hidden Style dropdown.
	 *
	 * @param array $buttons Array of Tiny MCE's button ids.
	 * @return array
	 */
	function NirTheme_tiny_mce_style_formats( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}
}

add_filter( 'tiny_mce_before_init', 'NirTheme_tiny_mce_before_init' );

if ( ! function_exists( 'NirTheme_tiny_mce_before_init' ) ) {
	/**
	 * Adds style options to TinyMCE's Style dropdown.
	 *
	 * @param array $settings TinyMCE settings array.
	 * @return array
	 */
	function NirTheme_tiny_mce_before_init( $settings ) {

		$style_formats = array(
			array(
				'title'    => __( 'Lead Paragraph', 'NirTheme' ),
				'selector' => 'p',
				'classes'  => 'lead',
				'wrapper'  => true,
			),
			array(
				'title'  => _x( 'Small', 'Font size name', 'NirTheme' ),
				'inline' => 'small',
			),
			array(
				'title'   => __( 'Blockquote', 'NirTheme' ),
				'block'   => 'blockquote',
				'classes' => 'blockquote',
				'wrapper' => true,
			),
			array(
				'title'   => __( 'Blockquote Footer', 'NirTheme' ),
				'block'   => 'footer',
				'classes' => 'blockquote-footer',
				'wrapper' => true,
			),
			array(
				'title'  => __( 'Cite', 'NirTheme' ),
				'inline' => 'cite',
			),
		);

		if ( isset( $settings['style_formats'] ) ) {
			$orig_style_formats = json_decode( $settings['style_formats'], true );
			if ( is_array( $orig_style_formats ) ) {
				$style_formats = array_merge( $orig_style_formats, $style_formats );
			}
		}

		$settings['style_formats'] = wp_json_encode( $style_formats );
		return $settings;
	}
}

add_filter( 'mce_buttons', 'NirTheme_tiny_mce_blockquote_button' );

if ( ! function_exists( 'NirTheme_tiny_mce_blockquote_button' ) ) {
	/**
	 * Removes the blockquote button from the TinyMCE toolbar.
	 *
	 * We provide the blockquote via the style formats. Using the style formats
	 * blockquote receives the proper Bootstrap classes.
	 *
	 * @since 1.0.0
	 *
	 * @see NirTheme_tiny_mce_before_init()
	 *
	 * @param array $buttons TinyMCE buttons array.
	 * @return array TinyMCE buttons array without the blockquote button.
	 */
	function NirTheme_tiny_mce_blockquote_button( $buttons ) {
		foreach ( $buttons as $key => $button ) {
			if ( 'blockquote' === $button ) {
				unset( $buttons[ $key ] );
			}
		}
		return $buttons;
	}
}
