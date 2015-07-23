<?php
/**
 * The template for displaying search results pages.
 *
 * @package russell
 */

get_header(); ?>
<div class="russell-search-left-content">

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( '%s', 'russell' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    			<span><?php printf( __( 'Search') ); ?></span>
			</header><!-- .page-header -->
            
            <?php russell_selected_post_tags(); ?>
		
		<?php endif; ?>
		</main><!-- #main -->
		<?php //get_sidebar(); ?>
        
        <div class="russell-copyright">
            <?php russell_copyright(); ?>
        </div>
	</section><!-- #primary -->

</div>
<?php get_footer(); ?>