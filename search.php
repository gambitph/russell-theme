<?php
/**
 * The template for displaying search results pages.
 *
 * @package russell
 */


get_header();
?>
<div id="content" class="russell-content-wrapper">
	<?php 
		$recent_tags = get_the_tags();
		if ( empty( $recent_tags ) ) {
			?>
			<section class="russell-content-full russell-content-area">
			<?php
		} else {
			?>
			<section class="russell-content-large russell-content-image"></section>
			<section class="russell-content-small russell-content-area">
			<?php
		}
	?>
		<div>
			<h1 class="russell-site-title">
				<a href='#'><?php echo get_search_query() ?></a>
				<span><?php _e( 'Search', 'russell' ) ?></span>
			</h1>
		</div>

		<?php if ( have_posts() ) : ?>
		<?php russell_selected_post_tags(); ?>
		<?php endif; ?>

		<div class="russell-copyright">
            <?php russell_copyright(); ?>
        </div>
</div>
<?php

get_footer();