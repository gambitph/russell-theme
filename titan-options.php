<?php

/*
 * Titan Framework options sample code. We've placed here some
 * working examples to get your feet wet
 * @see	http://www.titanframework.net/get-started/
 */


add_action( 'tf_create_options', 'russell_create_options' );

/**
 * Initialize Titan & options here
 */
function russell_create_options() {

	$titan = TitanFramework::getInstance( 'russell' );
	
	
	/**
	 * Create a Theme Customizer panel where we can edit some options.
	 * You should put options here that change the look of your theme.
	 */
	
	$siteDescription = $titan->createThemeCustomizerSection( array(
        'name' => 'title_tagline',
    ) );
	$siteDescription->createOption( array(
	    'name' => __( 'Site Description', 'russell' ),
	    'id' => 'site_elaboration',
	    'type' => 'textarea',
	    'desc' => __( 'What is your site all about? You can write the details here.', 'russell' ),
	) );

	
	/**
	 * Social Icons
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => __( 'Social Icons', 'russell' ),
		'panel' => __( 'Theme Options & Colors', 'russel' ),
		'desc' => 'Social link icons are placed on the top of your site. Paste the links to your social profiles below.'
	) );

	for ( $i = 0; $i <= 10; $i++ ) {
		$section->createOption( array(
		    'name' => $i ? '' : __( 'Social Links', 'russell' ),
		    'id' => 'social_' . $i,
		    'type' => 'text',
		) );
	}
	
	
	/**
	 * Create an admin panel & tabs
	 * You should put options here that do not change the look of your theme
	 */
	
	$adminPanel = $titan->createAdminPanel( array(
	    'name' => __( 'Theme Settings', 'russell' ),
	) );
	
	$generalTab = $adminPanel->createTab( array(
	    'name' => __( 'General', 'russell' ),
	) );

	$generalTab->createOption( array(
	    'name' => __( 'Custom Javascript Code', 'russell' ),
	    'id' => 'custom_js',
	    'type' => 'code',
	    'desc' => __( 'If you want to add some additional Javascript code into your site, add them here and it will be included in the frontend header. No need to add <code>script</code> tags', 'russell' ),
	    'lang' => 'javascript',
	) );
	
	$generalTab->createOption( array(
	    'type' => 'save',
	) );
	
	
	$footerTab = $adminPanel->createTab( array(
	    'name' => __( 'Footer', 'russell' ),
	) );
	
	$footerTab->createOption( array(
		'name' => __( 'Copyright Text', 'russell' ),
		'id' => 'copyright',
		'type' => 'text',
		'desc' => __( 'Enter your copyright text here (sample only)', 'russell' ),
	) );
	
	$footerTab->createOption( array(
	    'type' => 'save',
	) );
	
	
	/**
	 * Fonts
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => __( 'Fonts', 'russell' ),
		'panel' => __( 'Theme Options & Colors', 'russell' ),
		'desc' => __( 'Change the fonts used across your site', 'russell' ),
	) );
	$section->createOption( array(
	    'name' => __( 'Headings Font', 'russell' ),
	    'id' => 'russell_headings_font',
	    'type' => 'font',
	    'desc' => __( 'Select the font for all headings in the site', 'russell' ),
		'show_color' => false,
		'show_font_size' => false,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    //'show_line_height' => false,
	    'show_letter_spacing' => false,
	    //'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-family' => "'Montserrat', sans-serif",
	        'text-transform' => 'capitalize',
			'line-height' => '1.1em',
	    ),
		'css' => 'h1, h2, h3, h4, h5, h6, .main-navigation ul a
		{ value }',
	) );
	$section->createOption( array(
	    'name' => __( 'Heading 1 Size', 'russell' ),
	    'id' => 'russell_heading1_font',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h1</code> headings', 'russell' ),
		'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    // 'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '48px',
			'letter-spacing' => 'normal',
			'text-transform' => 'normal',
	    ),
		'css' => 'body.home h1.site-title
		{ value }',
	) );
	$section->createOption( array(
	    'name' => __( 'Heading 2 Size', 'russell' ),
	    'id' => 'russell_heading2_font',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h2</code> headings', 'russell' ),
		'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    'show_font_weight' => false,
	    //'show_font_style' => false,
	    'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    // 'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '15px',
	        'font-style' => 'italic',
			'letter-spacing' => 'normal',
			'text-transform' => 'normal',
	    ),
		'css' => 'body.home h2.site-description, body.single .category { value }
		@media screen and (max-width: 710px) {
			h1 { value }
		}',
	) );
	$section->createOption( array(
	    'name' => __( 'Heading 3 Size', 'russell' ),
	    'id' => 'russell_heading3_font',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h3</code> headings', 'russell' ),
		'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    // 'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '28px',
			'letter-spacing' => 'normal',
			'text-transform' => 'normal',
	    ),
		'css' => 'h3 { value }
		@media screen and (max-width: 710px) {
			h2 { value }
		}',
	) );
    $section->createOption( array(
	    'name' => __( 'Heading 4 Size', 'russell' ),
	    'id' => 'russell_heading4_font',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h4</code> headings', 'russell' ),
		'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '22px',
			'letter-spacing' => 'normal',
	    ),
		'css' => 'h4,
		body div#jp-relatedposts div.jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-title a
		{ value }
		@media screen and (max-width: 710px) {
			h3, h4 { value }
		}',
	) );
	
	$section->createOption( array(
	    'name' => __( 'Heading 5 Size', 'russell' ),
	    'id' => 'russell_heading5_font',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h5</code> headings', 'russell' ),
		'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '16px',
			'letter-spacing' => 'normal',
	    ),
		'css' => 'h5
		{ value }
		@media screen and (max-width: 710px) {
			h5 { value }
		}',
	) );
	
	$section->createOption( array(
	    'name' => __( 'Heading 6 Size', 'russell' ),
	    'id' => 'russell_heading6_font',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h6</code> headings', 'russell' ),
		'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '14px',
			'letter-spacing' => 'normal',
	    ),
		'css' => 'h6
		{ value }
		@media screen and (max-width: 710px) {
			h6 { value }
		}',
	) );
	$section->createOption( array(
	    'name' => __( 'Body Font', 'russell' ),
	    'id' => 'russell_body_font',
	    'type' => 'font',
	    'desc' => __( 'The normal body font', 'russell' ),
		// 'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    // 'show_font_weight' => false,
	    'show_font_style' => false,
	    // 'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
			'font-family' => "'Roboto Slab', regular",
	        'font-size' => '15px',
	        'line-height' => '1.6em',
			'letter-spacing' => 'normal',
			'font-weight' => '100',
	    ),
		'css' => 'body { value }',
	) );
	// $section->createOption( array(
// 	    'name' => __( 'Smaller Body Font', 'russell' ),
// 	    'id' => 'body_font_small',
// 	    'type' => 'font',
// 	    'desc' => __( 'The smaller body font found in various places in the theme', 'russell' ),
// 		'show_font_family' => false,
// 		'show_color' => false,
// 		// 'show_font_size' => false,
// 	    'show_font_weight' => false,
// 	    'show_font_style' => false,
// 	    'show_line_height' => false,
// 	    // 'show_letter_spacing' => false,
// 	    'show_text_transform' => false,
// 	    'show_font_variant' => false,
// 	    'show_text_shadow' => false,
// 	    'default' => array(
// 	        'font-size' => '12px',
// 			// 'line-height' => '1.5em',
// 			'letter-spacing' => 'normal',
// 	    ),
// 		'css' => 'article .entry-footer,
// 		.entry-meta,
// 		.entry-header .cat-links, .entry-header #breadcrumbs,
// 		.page-header .taxonomy-description,
// 		.navigation .nav-previous a span, .navigation .nav-next a span,
// 		#comments .comment-metadata > a, #comments .comment-metadata > a:visited,
// 		#comments .comment-reply-link,
// 		#comments .logged-in-as,
// 		body div#jp-relatedposts div.jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-context, body div#jp-relatedposts div.jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-date,
// 		.featured-content figcaption span
// 		{ value }
// 		',
// 	) );

    /**
	 *   Site title, font and color options
	 */

	 /**
 	 * Navigation
 	 */
 	$section = $titan->createThemeCustomizerSection( array(
 	    'name' => __( 'Header & Social', 'russell' ),
 		'panel' => __( 'Theme Options & Colors', 'russell' ),
 		'desc' => __( 'The main navigation bar', 'russell' ),
 	) );
 	$section->createOption( array(
	    'name' => __( 'Background Color', 'russell' ),
	    'id' => 'header_color_bg',
	    'type' => 'color',
		'default' => '#ffffff',
		'css' => '#masthead, .sub-menu { background-color: value }'
	) );
    $section->createOption( array(
	    'name' => __( 'Main Menu Text Color', 'russell' ),
	    'id' => 'navbar_text_color',
	    'type' => 'color',
		'default' => '#646464',
		'css' => '#masthead ul > li > a { color: value }'
	) );
	$section->createOption( array(
	    'name' => __( 'Social Icons Color', 'russell' ),
	    'id' => 'social_text_color',
	    'type' => 'color',
		'default' => '#646464',
		'css' => '#masthead .social-navigation a:before { color: value }'
	) );
	$section->createOption( array(
	    'name' => __( 'Social Icons Hover Color', 'russell' ),
	    'id' => 'social_hover_text_color',
	    'type' => 'color',
		'default' => 'orange',
		'css' => '#masthead .social-navigation a:hover:before { color: value }'
	) );   
	
	
	/**
	 * Footer copyright
	 */
	$section = $titan->createThemeCustomizerSection( array(
       'name' => __( 'Footer Copyright Area', 'russell' ),
       'panel' => __( 'Theme Options & Colors', 'russell' ),
       'desc' => __( 'Colors & text of the bottom-most copyright area of the site', 'russell' ),
    ) );
	$section->createOption( array(
       'name' => __( 'Copyright Text', 'russell' ),
       'id' => 'footer_copyright_text',
       'type' => 'text',
       'default' => '&copy; ' . date( 'Y' ) . ', theme created by Gambit',
    ) );
	$section->createOption( array(
       'name' => __( 'Text Color', 'russell' ),
       'id' => 'footer_copyright_text_color',
       'type' => 'color',
       'default' => '#000000',
       'css' => '#colophon.site-footer .site-info { color: value }',
    ) );
}