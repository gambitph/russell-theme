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
 * @package russell
 */

get_header(); ?>

    <div class="russell_left_content">
        <h1>RUSSELL</h1>
        <i class='line'></i>
        <!--<h5 class='small'>Lorem ipsum dolor sit amet</h5>-->
    	<small>Lorem ipsum dolor sit amet</small>
    	<div class='content'>
    		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed lacus erat. Pellentesque tristique ut nunc sit vamet feugiat. Pellentesque sit amet sollicitudin nisi, eget ultricies elit. Maecenas dui orci, consequat vitae blandit vitae, pulvinar non diam. Mauris eu tortor placerat, bibendum massa quis, sodales ligula.</p>
    		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed lacus erat. Pellentesque tristique ut nunc sit vamet feugiat. Pellentesque sit amet sollicitudin nisi, eget ultricies elit. Maecenas dui orci, consequat vitae blandit vitae, pulvinar non diam. Mauris eu tortor placerat, bibendum massa quis, sodales ligula.</p>
    	</div>
    </div>
    
    <div class='russell_right_images'>
    	<div class='russell_right_images_wrapper'></div>
    </div>
    
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php russell_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
