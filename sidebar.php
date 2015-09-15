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
	$activeSidebars += is_active_sidebar( '404-sidebar' ) ? 1 : 0;


?>

<?php
if ( is_active_sidebar( 'footer-sidebar' ) ) {
	?>
	<div id="footer-sidebar" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-sidebar' ); ?>
	</div><!-- #footer-left --><?php
}
if ( is_active_sidebar( '404-sidebar' ) ) {
	?>
	<div id="404-sidebar" class="widget-area" role="complementary">
		<?php dynamic_sidebar( '404-sidebar' ); ?>
	</div><!-- #footer-left --><?php
}
?>
