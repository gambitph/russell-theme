<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package backup
 */

get_header(); ?>
<?php
    if ( is_archive() ) {
        ?>
        <div class="russell-archive-left-content">
        <?php 
    }
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->
        
            <?php russell_selected_post_tags(); ?>
		
		<?php endif; ?>

		</main><!-- #main -->
		<?php //get_sidebar(); ?>
        
        <div class="russell-copyright">
            <?php russell_copyright(); ?>
        </div>
	</div><!-- #primary -->
	
<?php
    if ( is_archive() ) {
        ?>
        </div>
        <?php 
    }
?>
<?php get_footer(); ?>