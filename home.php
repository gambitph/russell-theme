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

get_header();

?>
<section class="russell-home-left-content content-small">
    
    <div>
		
        <h1 class="site-title">
			<?php
			
			if ( function_exists( 'jetpack_the_site_logo' ) && function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {    
				jetpack_the_site_logo();
			} else {
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
				<?php
			}
			
			$description = get_bloginfo( 'description' );
			if ( ! empty( $description ) ) {
				?>
				<span><?php echo $description ?></span>
				<?php
			}
			?>
		</h1>
		
		<?php
	    if ( class_exists( 'TitanFramework' ) ) {
		    $titan = TitanFramework::getInstance( 'russell' ); 
		    ?> <div class="site-elaboration"> <?php
			echo esc_attr( $titan->getOption( 'russell_site_elaboration' ) ); 
		    ?> </div> <?php        
		} ?> 	
			
	</div>
	
	
    <div class="copyright">
        <?php russell_copyright(); ?>
    </div>

</section><!-- .russell-home-left-content -->

<div class="russell-home-right-content"></div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>