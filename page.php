<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package russell
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<div id="content" class="russell-content-wrapper">
    <?php

	$contentClass = 'russell-content-full';
	if ( has_post_thumbnail() ) {

		$imageAttachment = wp_get_attachment_image_src( get_post_thumbnail_id(), 'russell-featured-image' );
		if ( ! empty( $imageAttachment ) ) {

		    $contentClass = 'russell-content-small';
			get_template_part( 'content', 'featured-image' );

		}
	}

	?>
    <section class="<?php echo esc_attr( $contentClass ); ?> russell-content-area">
        <div>    
             
				<?php get_template_part( 'content', 'page' ); ?>

    	    <?php
			    // If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
				endif;
		    ?>
		   	<div class="widget-category">
	        	<?php dynamic_sidebar( 'footer-sidebar' ); ?> 
			</div>
			
        </div>
        
        <div class="russell-copyright">
            <?php russell_copyright(); ?>
        </div>
    
	</section>

</div><!-- .russell-content-wrapper -->

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
