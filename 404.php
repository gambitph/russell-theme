<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package russell
 */

// TODO:
// - cleanup

get_header(); 

?>
<div id="content" class="russell-content-wrapper">

	<section class="russell-content-full russell-content-area">
		<div>
			
			<h1 class="russell-site-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'russell' ); ?></h1>
		
			<div class="page-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'russell' ); ?></p>

				<?php get_search_form(); ?>

				<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

				<?php if ( russell_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php _e( 'Most Used Categories', 'russell' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->

				<?php endif; ?>

				<?php
					/* translators: %1$s: smiley */
					$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'russell' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
				?>

				<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

			</div><!-- .page-content -->
		
		</div>
		
		<div class="russell-copyright">
	        <?php russell_copyright(); ?>
	    </div>
		
	</section><!-- .russell-content-full -->
        
</div>
<?php get_footer(); ?>