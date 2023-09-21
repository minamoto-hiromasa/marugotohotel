<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

?>

<?php
	if ( is_single() ) :
		the_content();
	else :
		the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wp-bootstrap-starter' ) );
	endif;

	wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-starter' ),
		'after'  => '</div>',
	) );
?>
<footer class="entry-footer">
  <?php wp_bootstrap_starter_entry_footer(); ?>
</footer><!-- .entry-footer -->