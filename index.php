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
	<div class="site-branding">
		<?php if ( is_home() || is_front_page() ) {
		    if ( class_exists( 'Jetpack' ) ) { 
		        russell_feature_logo();
	        } else { ?>
	            <h1 class="site-title">" rel="home"><?php bloginfo( 'name' ); ?></h1>
	        <?php } }
	        ?>
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	</div><!-- .site-branding -->
    
    <div class="site-elaboration">
	    <?php
		if ( class_exists( 'TitanFramework' ) ) {
			$titan = TitanFramework::getInstance( 'russell' );
			echo esc_attr( $titan->getOption( 'site_elaboration' ) ); 
		} 
		?>
	</div>
	
	<div id="primary" class="content-area">

        <?php get_sidebar(); ?>
        
        <?php get_footer(); ?>
        
    </div>
	</div><!-- #primary -->
