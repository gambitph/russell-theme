<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package russell
 */
 
global $titan;
if ( class_exists( 'TitanFramework' ) ) {
    $titan = TitanFramework::getInstance( 'russell' );
}
 
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
$headerImageUrl = '';

if ( get_header_image() ) {
	$headerImageUrl = get_header_image();
}
if ( ( is_single() || is_page() ) && has_post_thumbnail() ) {
	$imageAttachment = wp_get_attachment_image_src( get_post_thumbnail_id(), 'russell-featured-image' );

	if ( ! empty( $imageAttachment ) ) {
		$headerImageUrl = $imageAttachment[0];
	}
}
if ( ! empty( $headerImageUrl ) ) {
	$bodyClasses = ' has-featured-image';
}
?>
</head>
<body <?php body_class( $bodyClasses ); ?>>

<div id="page" class="hfeed site">
    
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'russell' ); ?></a>
	<header id="masthead" class="site-header" role="banner">
	    <?php 
		
        if ( ! is_home() ) {
            russell_feature_logo();
        }
		
        ?>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Primary Menu', 'russell' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
		<?php
	
	    russell_create_social_icons();
		
		?>
	</header><!-- #masthead -->
