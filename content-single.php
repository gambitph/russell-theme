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
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <i class="line"></i>
        <div class="category">
            <?php 
                $category = get_the_category();
                echo $category[0]->cat_name;
            ?>
        </div>
		<div class="entry-meta">
			<?php russell_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

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
