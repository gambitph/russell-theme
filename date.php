<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package russell
 */

get_header(); ?>

<div class="russell_left_archive_content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
				<i class='line'></i>
                <h4 class="archive"><?php printf( __( 'Archive') ); ?></h4>
			</header><!-- .page-header -->
            
            <?php russell_selected_post_tags(); ?>

		<?php endif; ?>
		</main><!-- #main -->        
		<?php get_footer(); ?>
	</div><!-- #primary -->

