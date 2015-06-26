<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package russell
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->
            
            
            <?php /* Start the Loop */ ?>
            <div class="tangina"></div>
            <?php asdasdasD ?>
            <?php $tags = get_terms( 'post_tag', array('fields' => 'id=>name', 'get' => 'all', ) );
            var_dump($tags);
            echo $tags; ?>
            
            <?php //russell_get_post_tags(); ?>
            
			<?php russell_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
