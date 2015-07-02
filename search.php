<?php
/**
 * The template for displaying search results pages.
 *
 * @package russell
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'russell' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php russell_selected_post_tags(); ?>
            <?php get_footer(); ?>

		<?php endif; ?>

		</main><!-- #main -->
		
	</section><!-- #primary -->

<?php //get_sidebar(); ?>
