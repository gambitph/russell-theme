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
			
			<?php russell_selected_post_tags() ?>
			
            <?php /* Start the Loop */ ?>
            <?php //while ( have_posts() ) : the_post(); ?>
            <?php
                // if ( have_posts() ) {
                //                     // get tags for found posts
                //                 $recent_tags = array();
                //                     var_dump($recent_tags);
                //                 while ( $loop->have_posts() ) : $loop->the_post();
                //                     foreach(get_the_tags() as $t) $recent_tags[$t->slug] = $t->name; // this adds to the array in the form ['slug']=>'name'
                //                 endwhile;
                // 
                //             } 
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					//get_template_part( 'content', get_post_format() );
				?>

				<?php //endwhile; ?>
			
         	<?php // russell_paging_nav(); ?>

			<?php //else : ?>

			<?php //get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
        <?php get_footer(); ?>
	</div><!-- #primary -->
