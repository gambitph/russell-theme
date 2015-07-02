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
    		    echo "&copy 2015 theme created by Gambit";
    		}
    		?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
