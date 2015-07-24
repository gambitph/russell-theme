<?php
/**
 * @package russell
 */
$sticky = '';
if ( is_sticky() ) {
	$sticky = 'sticky';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	
	<div class="russell-post-meta">
		<?php russell_posted_on(); ?>
	</div><!-- .entry-meta -->
	
	<?php
	$title = get_the_title();
    $categories = get_the_category();
	?>
	<h1 class="russell-site-title">
		<?php echo $title ?>
		<?php
		if ( ! empty( $categories ) ) {
			?><span><?php
			foreach ( $categories as $i => $category ) {
				if ( $i ) {
					echo ", ";
				}
				?><a href='<?php echo esc_url( get_category_link( $category->cat_ID ) ) ?>'><?php echo $category->cat_name ?></a><?php
			}
			?></span><?php
		}
		?>
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
		<?php russell_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
