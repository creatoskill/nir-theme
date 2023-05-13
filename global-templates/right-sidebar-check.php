<?php
/**
 * Right sidebar check
 *
 * @package NirTheme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Closing the primary container from /global-templates/left-sidebar-check.php.
?>
</div><!-- #primary -->

<?php
$sidebar_pos = get_theme_mod( 'NirTheme_sidebar_position' );

if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) {
	get_template_part( 'sidebar-templates/sidebar', 'right' );
}
