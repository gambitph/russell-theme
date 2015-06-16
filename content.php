<?php
/**
 * @package russel
 */

$featuredImage = null;

// If  the post has a featured image, show it
if ( has_post_thumbnail() ) {
    $featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'russell-featured-image' );
}

if ( ! empty( $featuredImage ) ) {
    ?>
	<style>
	article.post-<?php the_ID(); ?> {
        background: linear-gradient(45deg, rgba(41,51,56,0.7) 0%,rgba(41,51,56,0.4) 48%,rgba(41,51,56,0.14) 100%), url( <?php echo esc_url( $featuredImage[0] ) ?> );
	}
	</style>
	<?php
    
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<i class='line'></i>
        <?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php russel_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'russel' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
			asdasda
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'russel' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php russel_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->