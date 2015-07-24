<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package russell
 */

$sticky = '';

if ( is_sticky() ) {
	$sticky = 'sticky';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $sticky ); ?>>
	
	
	<h1 class="russell-site-title">
		<?php the_title(); ?>
	</h1>
	
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'russell' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'russell' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
