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
 * @package backup
 */

get_header(); ?>
<?php
    if ( is_home() ) {
        ?>
        <div class="russell-home-left-content">
            
            <div class="site-branding">
        		<?php //wp_head(); 
        		    if ( class_exists( 'Jetpack' ) ) { 
        		        if ( is_home() ) {
        		            russell_feature_logo();
        		            }
        	        } else { ?>
        	            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        	        <?php }
        	        ?>
        		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
        	</div><!-- .site-branding -->
        	
        	<?php
            if ( class_exists( 'TitanFramework' ) ) {
        	    $titan = TitanFramework::getInstance( 'backup' ); 
        	    ?> <div class="site-elaboration"> <?php
        		echo esc_attr( $titan->getOption( 'russell_site_elaboration' ) ); 
        	    ?> </div> <?php        
        	} ?> 	
        	
        	<div id="primary" class="content-area">
        		<main id="main" class="site-main" role="main">
        		</main><!-- #main -->
                <div class="russell-copyright">
                    <?php russell_copyright(); ?>
                </div>
        	</div><!-- #primary -->    
        
        </div><!-- .russell-home-left-content -->
        
        <div class="russell-home-right-content"></div>
        
        <?php } ?>
    
    <?php //get_sidebar(); ?>
    <?php get_footer(); ?>
    