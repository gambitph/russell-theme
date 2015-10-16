<?php
/**
 * Template for featured images of posts.
 * @package russell
 */

$bodyClasses = '';

/**
 * Get the header image to display
 */
$headerImageUrl = '';
$headerImageGradientColor = '';

$stop1Opacity = 0.5;
$stop2Opacity = 0.4;
$stop3Opacity = 0.14;
if ( get_header_image() ) {
	$headerImageUrl = get_header_image();
	$headerImageGradientColor = '41,51,56';
}
if ( ( is_single() || is_page() ) && has_post_thumbnail() ) {
	$imageAttachment = wp_get_attachment_image_src( get_post_thumbnail_id(), 'russell-featured-image' );

	if ( ! empty( $imageAttachment ) ) {
		$headerImageUrl = $imageAttachment[0];
	}
}
if ( is_single() || is_page() ) {

	$headerImageGradientColor = '41,51,56';
	$stop1Opacity = 0.7;
	$stop2Opacity = 0.5;

}
if ( ! empty( $headerImageUrl ) ) {
	$bodyClasses = ' has-featured-image';
} ?>

<?php
if ( ! empty( $headerImageUrl )  ) { ?>
    <section class="russell-content-large russell-content-image">
        <?php
		if ( ( is_page() || is_single() ) && has_post_thumbnail() ) { ?>
            <div class="item" style="background-image: linear-gradient(45deg, rgba(<?php echo $headerImageGradientColor ?>,<?php echo $stop1Opacity ?>) 0%,rgba(<?php echo $headerImageGradientColor ?>,<?php echo $stop2Opacity ?>) 48%,rgba(<?php echo $headerImageGradientColor ?>, <?php echo $stop3Opacity ?>) 100%), url(<?php echo esc_url( $headerImageUrl ) ?>); background-size: cover; background-position: center;">
				<?php
				$id = get_post_thumbnail_id();
				if ( ! empty( $id ) ) {
					russell_image_caption( $id );
				}
				?>
            </div>
        <?php } ?>
        <?php russell_single_scripts_and_styles(); ?>
    </section>
    
<?php } ?>
