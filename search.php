<?php
/**
 * The template for displaying search results pages.
 *
 * @package russell
 */

get_header(); ?>

<div class="russell_left_search_content">
    <section id="primary" class="content-area">
    	<main id="main" class="site-main" role="main">
       
    	<?php if ( have_posts() ) : ?>

    		<header class="page-header">
    			<h1 class="page-title"><?php printf( __( '%s', 'russell' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    			<i class='line'></i>
                <h4 class="search"><?php printf( __( 'Search') ); ?></h4>
    		</header><!-- .page-header -->

    		<?php /* Start the Loop */ ?>
    		<?php russell_selected_post_tags(); ?>
        
    	<?php endif; ?>
    	</main><!-- #main -->
    </section><!-- #primary -->

    <div id="primary" class="content-area">

        <?php //get_sidebar(); ?>
    
        <?php get_footer(); ?>
    
    </div>
    </div><!-- #primary -->
