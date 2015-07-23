<?php
/**
 * The template for displaying search results pages.
 *
 * @package backup
 */

get_header(); ?>
<?php
    if ( is_search() ) {
        ?>
        <div class="russell-search-left-content">
        <?php 
    }
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( '%s', 'russell' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    			<i class='line'></i>
                <h4 class="search"><?php printf( __( 'Search') ); ?></h4>
			</header><!-- .page-header -->
            
            <?php russell_selected_post_tags(); ?>
		
		<?php endif; ?>
		</main><!-- #main -->
		<?php //get_sidebar(); ?>
        
        <div class="russell-copyright">
            <?php russell_copyright(); ?>
        </div>
	</section><!-- #primary -->

<?php
    if ( is_search() ) {
        ?>
        </div>
        <?php 
    }
?>
<?php get_footer(); ?>