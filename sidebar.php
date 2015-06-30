<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package russell
 */

 if ( ! is_active_sidebar( 'sidebar-left' ) && ! is_active_sidebar( 'sidebar-right' ) ) {
 	return;
 }
 
 $activeSidebars = 0;
 $activeSidebars += is_active_sidebar( 'sidebar-left' ) ? 1 : 0;
 $activeSidebars += is_active_sidebar( 'sidebar-right' ) ? 1 : 0;
 
?>

<div class="footer-widgets active-footers-<?php echo $activeSidebars ?>">

<?php
if ( is_active_sidebar( 'sidebar-left' ) ) {
	?>
	<div id="footer-left" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-left' ); ?>
	</div><!-- #footer-left --><?php
}
if ( is_active_sidebar( 'sidebar-right' ) ) {
	?><div id="footer-right" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-right' ); ?>
	</div><!-- #footer-middle -->
	<?php
}
?>

</div>