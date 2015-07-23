<?php
/**
 * @package backup
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
			<?php backup_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'backup' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php backup_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
