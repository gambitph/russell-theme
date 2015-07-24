<?php
/**
 * The template for displaying all single posts.
 *
 * @package russell
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<div id="content" class="russell-content-wrapper">

    <?php get_template_part( 'content', 'featured-image' );
	
	if ( has_post_thumbnail() ) {
    	$imageAttachment = wp_get_attachment_image_src( get_post_thumbnail_id(), 'russell-featured-image' );

    	if ( ! empty( $imageAttachment ) ) {
    	    $contentClass = "russell-content-small";
    		?>
            <section class="<?php $contentClass ?> russell-content-area">
                <div>
            <?php
    	}
    } else {
        $contentClass = "russell-content-full"
        ?>
        <section class="<?php echo esc_attr( $contentClass ); ?> russell-content-area">
            <div>
        <?php
    }
    
    ?>
    
	<?php get_template_part( 'content', 'single' ); ?>

		<?php russell_post_nav(); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>

    <?php get_sidebar(); ?>
    
    <div class="russell-copyright">
        <?php russell_copyright(); ?>
    </div>
    
    <?php
    if ( has_post_thumbnail() ) {
    	if ( ! empty( $imageAttachment ) ) {
    		?>
    		</section>
    		<?php
		}
    }
    ?>

</div>
	
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>