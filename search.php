<?php
/**
 * The template for displaying search results pages.
 *
 * @package russell
 */


get_header();
?>
<div id="content" class="russell-content-wrapper russell-content-reverse">
	
	<section class="russell-content-large russell-content-image">
	
		<div class="russell-gallery">
			<?php get_template_part( 'content', 'archive-gallery' );?>
		</div>
		
	</section>
	
	<section class="russell-content-small russell-content-area">
	
		<div>
			<h1 class="russell-site-title">
				<a href='#'><?php echo get_search_query() ?></a>
				<span><?php _e( 'Search', 'russell' ) ?></span>
			</h1>
		</div>

		<?php russell_selected_post_tags(); ?>

		<div class="russell-copyright">
            <?php russell_copyright(); ?>
        </div>

</div>
<?php

get_footer();
