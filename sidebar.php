<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package russell
 */


 if ( ! is_active_sidebar( 'footer-sidebar' ) ) {
 	return;
 }
 
 $activeSidebars = 0;
 $activeSidebars += is_active_sidebar( 'footer-sidebar' ) ? 1 : 0;
 
 
?>

<div class="footer-widgets active-footers-<?php echo $activeSidebars ?>">

<?php
if ( is_active_sidebar( 'footer-sidebar' ) ) {
	?>
	<div id="footer-sidebar" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-sidebar' ); ?>
	</div><!-- #footer-left --><?php
}
?>

</div>