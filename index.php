<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package russel
 */

get_header(); ?>
<div class="russell_left_content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
        
        	<?php if ( have_posts() ) : ?>

    			<?php russel_paging_nav(); ?>

    		<?php else : ?>

    			<?php get_template_part( 'content', 'none' ); ?>

    		<?php endif; ?>
		
		</main><!-- #main -->
        <?php get_footer(); ?>
        
<div class="russell_right_content">asdasdas</div>
        
	</div><!-- #primary -->
    
</div>
