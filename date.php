<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package russell
 */

get_header(); ?>
<div class="russell-date-left-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					$title = get_the_archive_title();
					$description = get_the_archive_description();
				?>
				<h1 class="page-title">
				    <?php echo $title; 
				    if ( ! empty( $description ) ) {
				        ?>
				        <span><?php echo $description; ?></span>
				        <?php
				    } else {
				        ?>
				        <span><?php echo __( 'Archive' ); ?></span>
				        <?php
				    }
				    ?>
				</h1>
			</header><!-- .page-header -->
            
            <?php russell_selected_post_tags(); ?>
		
		<?php endif; ?>
		</main><!-- #main -->
        
        <?php //get_sidebar(); ?>
        
        <div class="russell-copyright">
            <?php russell_copyright(); ?>
        </div>
	</div><!-- #primary -->

</div>
<?php get_footer(); ?>