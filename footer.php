<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package russell
 */
global $titan; 
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
    		<?php
    		if ( class_exists( 'TitanFramework' ) ) {
    		    echo $titan->getOption( 'footer_copyright_text' );
    		} else {
    		    echo '&copy ' . date( 'Y' ) . ' ' .  get_bloginfo( 'name' ) . ' Theme created by <a href="http://www.gambit.ph" target="_blank">Gambit Technologies, Inc.';
    		}
    		?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
