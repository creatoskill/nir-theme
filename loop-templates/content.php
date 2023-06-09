<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package NirTheme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<?php
if(preg_match( '#^register(/.+)?$#', $wp->request) || preg_match( '#^login(/.+)?$#', $wp->request)){
?>
	<header class="entry-header">

</header><!-- .entry-header -->
<?php
}else{
?>
	<header class="entry-header">

	<?php
	the_title(
		sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
		'</a></h2>'
	);
	?>

	<?php if ( 'post' === get_post_type() ) : ?>

		<div class="entry-meta">
			<?php NirTheme_posted_on(); ?>
		</div><!-- .entry-meta -->

	<?php endif; ?>

</header><!-- .entry-header -->
<?php
}
?>
	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php
		the_excerpt();
		NirTheme_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php NirTheme_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
