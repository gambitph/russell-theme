<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package russell
 */
 
global $titan;
$titan = TitanFramework::getInstance( 'russell' );
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<?php 

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
	$bodyClasses = ' has-header-image';
    if ( is_page() || is_single() ) {
        ?>
        <style id="regala_header">
        	header#masthead .russell_left_content{
        		background-image: linear-gradient(45deg, rgba(<?php echo $headerImageGradientColor ?>,<?php echo $stop1Opacity ?>) 0%,rgba(<?php echo $headerImageGradientColor ?>,<?php echo $stop2Opacity ?>) 48%,rgba(<?php echo $headerImageGradientColor ?>, <?php echo $stop3Opacity ?>) 100%), url( <?php echo esc_url( $headerImageUrl ) ?> );
        	}
        </style>
    <?php }
} ?>

</head>

<body <?php body_class( $bodyClasses ); ?>>
<div id="page" class="hfeed site">
   
    <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'russell' ); ?></a>

    <header id="masthead" class="site-header" role="banner">
    <?php 
        if ( is_page() || is_single() ) {
            russell_feature_logo();
        }
    ?>
		<div class="russell_left_content">
		    <?php
    		if ( ( is_page() || is_single() ) && has_post_thumbnail() ) { ?>
    		    <div class="feature-image-caption">
        	        <?php 
                        $id = get_post_thumbnail_id();
                        russell_image_caption( $id );
                    ?>
                </div>
            <?php } ?>
		
    		<?php
    		    if ( is_home() ) { ?>
            		<div class="site-branding">
            			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
            		</div><!-- .site-branding -->
        	<?php } ?> 
    	    <?php //echo russell_get_attached( '1', '12', '14' ); ?>
        
    		<nav id="site-navigation" class="main-navigation" role="navigation">
    			<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Primary Menu', 'russell' ); ?></button>
    			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
    		</nav><!-- #site-navigation -->
    		<span class='social-navigation'><?php russell_create_social_icons() ?></span>
    	</div>
	</header><!-- #masthead -->
    
    
	<div id="content" class="site-content">
        <?php 
    	if ( is_front_page() ) {
    		russell_feature_logo();
    	}
    	?>
