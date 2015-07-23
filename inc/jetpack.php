<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package backup
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function backup_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'backup_jetpack_setup' );

/**
 * Make all videos responsive
 * @see http://jetpack.me/support/site-logo/
 */
function russell_jetpack_site_logo() {
	$args = array(
	    'header-text' => array(
	        'site-title',
	        'site-description',
	    ),
	    'size' => 'full',
	);
	add_theme_support( 'site-logo', $args );
}
add_action( 'after_setup_theme', 'russell_jetpack_site_logo' );