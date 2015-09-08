<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package russell
 */


get_header();

?>
<div id="content" class="russell-content-wrapper">

	<section class="russell-content-full russell-content-area">
		<div>
			
			<h1 class="russell-site-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'russell' ); ?></h1>
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'russell' ); ?></p>

			<div class="widget-category">
				<?php dynamic_sidebar( '404-sidebar' ); ?>
			</div>
			
		</div>
		
		<div class="russell-copyright">
	        <?php russell_copyright(); ?>
	    </div>
		
	</section><!-- .russell-content-full -->
        
</div>
<?php get_footer(); ?>
