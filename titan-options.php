<?php
/**
 * Titan Framework options sample code. We've placed here some
 * working examples to get your feet wet
 *
 * @see	http://www.titanframework.net/get-started/
 *
 * @package russell
 */

add_action( 'tf_create_options', 'backup_create_options' );

/**
 * Initialize Titan & options here
 */
function backup_create_options() {

	$titan = TitanFramework::getInstance( 'russell' );

	/**
	 * Create a Theme Customizer panel where we can edit some options.
	 * You should put options here that change the look of your theme.
	 */

	$siteDescription = $titan->createThemeCustomizerSection( array(
		'name' => 'title_tagline',
	) );
	$siteDescription->createOption( array(
	    'name' => __( 'Site Description', 'backup' ),
	    'id' => 'russell_site_elaboration',
	    'type' => 'textarea',
	    'desc' => __( 'What is your site all about? You can write the details here.', 'backup' ),
	) );

	/**
	 * Social Icons
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => __( 'Social Icons', 'backup' ),
		'panel' => __( 'Theme Options & Colors', 'backup' ),
		'desc' => 'Social link icons are placed on the top of your site. Paste the links to your social profiles below.',
	) );

	for ( $i = 0; $i <= 10; $i++ ) {
		$section->createOption( array(
		    'name' => $i ? '' : __( 'Social Links', 'backup' ),
		    'id' => 'social_' . $i,
		    'type' => 'text',
		) );
	}

	/**
	 * Create an admin panel & tabs
	 * You should put options here that do not change the look of your theme
	 */

	$adminPanel = $titan->createAdminPanel( array(
	    'name' => __( 'Theme Settings', 'backup' ),
	) );

	$generalTab = $adminPanel->createTab( array(
	    'name' => __( 'General', 'backup' ),
	) );

	$generalTab->createOption( array(
	    'name' => __( 'Custom Javascript Code', 'backup' ),
	    'id' => 'custom_js',
	    'type' => 'code',
	    'desc' => __( 'If you want to add some additional Javascript code into your site, add them here and it will be included in the frontend header. No need to add <code>script</code> tags', 'backup' ),
	    'lang' => 'javascript',
	) );

	$generalTab->createOption( array(
	    'type' => 'save',
	) );

	$footerTab = $adminPanel->createTab( array(
	    'name' => __( 'Footer', 'backup' ),
	) );

	$footerTab->createOption( array(
		'name' => __( 'Copyright Text', 'backup' ),
		'id' => 'copyright',
		'type' => 'text',
		'desc' => __( 'Enter your copyright text here (sample only)', 'backup' ),
	) );

	$footerTab->createOption( array(
	    'type' => 'save',
	) );

	/**
	 * Fonts
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => __( 'Fonts', 'backup' ),
		'panel' => __( 'Theme Options & Colors', 'backup' ),
		'desc' => __( 'Change the fonts used across your site', 'backup' ),
	) );

	$section->createOption( array(
	    'name' => __( 'Highlight Color', 'backup' ),
	    'id' => 'highlight_color',
	    'type' => 'color',
	    'desc' => __( 'The color of links and other theme highlights', 'backup' ),
	    'default' => '#DB0A5B',
		'css' => 'a, a:visited { color: value }',
	) );

	$section->createOption( array(
	    'name' => __( 'Headings Font', 'backup' ),
	    'id' => 'russell_heading_fonts',
	    'type' => 'font',
	    'desc' => __( 'Select the font for all headings in the site', 'backup' ),
		'show_color' => false,
		'show_font_size' => false,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    'show_line_height' => false,
	    'show_letter_spacing' => false,
	    'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-family' => 'Montserrat',
	    ),
		'css' => 'h1, h2, h3, h4, h5, h6, .main-navigation ul a, #masthead .logo a
		{ value }',
	) );

	$section->createOption( array(
	    'name' => __( 'Heading 1 Size', 'backup' ),
	    'id' => 'russell_heading1_fonts',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h1</code> headings', 'backup' ),
		'show_font_family' => false,
		// 'show_color' => false,
		// 'show_font_size' => false,
	    // 'show_font_weight' => false,
	    // 'show_font_style' => false,
	    // 'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    // 'show_text_transform' => false,
	    // 'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'text-transform' => 'uppercase',
			'line-height' => '1.1em',
			'font-size' => '30px',
			'font-weight' => 'bold',
	    ),
		'css' => 'h1, h1 a, h1 a:visited, #masthead .logo a
		{ value }',
	) );
	$section->createOption( array(
	    'name' => __( 'Heading 2 Size', 'backup' ),
	    'id' => 'backup_heading2_fonts',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h2</code> headings', 'backup' ),
		'show_font_family' => false,
		// 'show_color' => false,
		// 'show_font_size' => false,
	    // 'show_font_weight' => false,
	    // 'show_font_style' => false,
	    // 'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    // 'show_text_transform' => false,
	    // 'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '28px',
	        'text-transform' => 'uppercase',
			'line-height' => '1.1em',
			'font-weight' => 'bold',
	    ),
		'css' => 'h2 
		{ value }
		@media screen and (max-width: 710px) {
			h1 { value }
		}',
	) );
	$section->createOption( array(
	    'name' => __( 'Heading 3 Size', 'backup' ),
	    'id' => 'backup_heading3_fonts',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h3</code> headings', 'backup' ),
		'show_font_family' => false,
		// 'show_color' => false,
		// 'show_font_size' => false,
	    // 'show_font_weight' => false,
	    // 'show_font_style' => false,
	    // 'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    // 'show_text_transform' => false,
	    // 'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '26px',
	        'text-transform' => 'uppercase',
			'line-height' => '1.1em',
			'font-weight' => 'bold',
	    ),
		'css' => 'h3 
		{ value }
		@media screen and (max-width: 710px) {
			h2 { value }
		}',
	) );
	$section->createOption( array(
	    'name' => __( 'Heading 4 Size', 'backup' ),
	    'id' => 'backup_heading4_fonts',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h4</code> headings', 'backup' ),
		'show_font_family' => false,
		// 'show_color' => false,
		// 'show_font_size' => false,
	    // 'show_font_weight' => false,
	    // 'show_font_style' => false,
	    // 'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    // 'show_text_transform' => false,
	    // 'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '20px',
	        'text-transform' => 'uppercase',
			'line-height' => '1.1em',
			'font-weight' => 'bold',
	    ),
		'css' => 'h4, #masthead h1,
		body div#jp-relatedposts div.jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-title a
		{ value }
		@media screen and (max-width: 710px) {
			h3, h4 { value }
		}',
	) );

	$section->createOption( array(
	    'name' => __( 'Heading 5 Size', 'backup' ),
	    'id' => 'backup_heading5_fonts',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h5</code> headings', 'backup' ),
		'show_font_family' => false,
		// 'show_color' => false,
		// 'show_font_size' => false,
	    // 'show_font_weight' => false,
	    // 'show_font_style' => false,
	    // 'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    // 'show_text_transform' => false,
	    // 'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '18px',
	        'text-transform' => 'uppercase',
			'line-height' => '1.1em',
			'font-weight' => 'bold',
	    ),
		'css' => 'h5
		{ value }
		@media screen and (max-width: 710px) {
			h5 { value }
		}',
	) );

	$section->createOption( array(
	    'name' => __( 'Heading 6 Size', 'backup' ),
	    'id' => 'russell_heading6_fonts',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h6</code> headings', 'backup' ),
		'show_font_family' => false,
		// 'show_color' => false,
		// 'show_font_size' => false,
	    // 'show_font_weight' => false,
	    // 'show_font_style' => false,
	    // 'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    // 'show_text_transform' => false,
	    // 'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '12px',
	        'text-transform' => 'uppercase',
			'line-height' => '1.1em',
			'font-weight' => 'bold',
	    ),
		'css' => 'h6, .russell-site-title span
		{ value }
		@media screen and (max-width: 710px) {
			h6 { value }
		}',
	) );
	$section->createOption( array(
	    'name' => __( 'Body Font', 'backup' ),
	    'id' => 'body_fonts',
	    'type' => 'font',
	    'desc' => __( 'The normal body font', 'backup' ),
		// 'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    // 'show_font_weight' => false,
	    // 'show_font_style' => false,
	    // 'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    // 'show_text_transform' => false,
	    // 'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
			'font-family' => 'Roboto Slab',
	        'font-size' => '15px',
	        'line-height' => '1.6em',
			'font-weight' => '300',
	    ),
		'css' => 'body { value }',
	) );
	$section->createOption( array(
	    'name' => __( 'Menu Font', 'backup' ),
	    'id' => 'russell_body_fonts',
	    'type' => 'font',
	    'desc' => __( 'The normal body font', 'backup' ),
		// 'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    // 'show_font_weight' => false,
	    // 'show_font_style' => false,
	    'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    // 'show_text_transform' => false,
	    // 'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
			'font-family' => 'Montserrat',
	        'font-size' => '12px',
	        'line-height' => '1.6em',
			'font-weight' => 'bold',
			'text-transform' => 'uppercase',
	    ),
		'css' => 'header nav .menu li a { value }',
	) );

	 /**
	 * Navigation
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => __( 'Header Colors', 'backup' ),
		'panel' => __( 'Theme Options & Colors', 'backup' ),
		'desc' => __( 'The main navigation bar', 'backup' ),
	) );
	$section->createOption( array(
		'name' => __( 'Header Background Color', 'backup' ),
		'id' => 'header_bg_color',
		'type' => 'color',
		'default' => '#ffffff',
		'css' => '#masthead { background-color: value; }',
	) );
	$section->createOption( array(
		'name' => __( 'Header Border Color', 'backup' ),
		'id' => 'header_border_color',
		'type' => 'color',
		'default' => '#e0e0e0',
		'css' => '#masthead { border-color: value; }',
	) );
	$section->createOption( array(
		'name' => __( 'Menu Text Color', 'backup' ),
		'id' => 'menu_text_color',
		'type' => 'color',
		'default' => '#646464',
		'css' => '#site-navigation li a { color: value }',
	) );
	$section->createOption( array(
		'name' => __( 'Menu Submenu Open Background Color', 'backup' ),
		'id' => 'menu_bg_color',
		'type' => 'color',
		'default' => '#646464',
		'css' => '#site-navigation li:hover, #site-navigation ul ul { background-color: value }',
	) );
	$section->createOption( array(
		'name' => __( 'Menu Submenu Open Text Color', 'backup' ),
		'id' => 'menu_submenu_text_color',
		'type' => 'color',
		'default' => '#ffffff',
		'css' => '#site-navigation li:hover > a, #site-navigation li:hover a, ul ul a { color: value }',
	) );
	$section->createOption( array(
		'name' => __( 'Menu Hovered Text Color', 'backup' ),
		'id' => 'menu_hover_text_color',
		'type' => 'color',
		'default' => '#000000',
		'css' => '#site-navigation ul ul li:hover > a { color: value }',
	) );
	$section->createOption( array(
		'name' => __( 'Social Icons Color', 'backup' ),
		'id' => 'russell_social_text_color',
		'type' => 'color',
		'default' => '#646464',
		'css' => '#masthead .social-navigation a:before { color: value }',
	) );
	$section->createOption( array(
		'name' => __( 'Social Icons Hover Color', 'backup' ),
		'id' => 'russell_social_hover_text_color',
		'type' => 'color',
		'default' => '#959595',
		'css' => '#masthead .social-navigation a:hover:before { color: value }',
	) );

	/**
	* Post avatar
	*/
	$section = $titan->createThemeCustomizerSection( array(
		'name' => __( 'Blog Post', 'backup' ),
		'panel' => __( 'Theme Options & Colors', 'backup' ),
		'desc' => __( 'Displaying avatar of the author in blog post', 'backup' ),
	) );
	$section->createOption( array(
		'name' => __( 'Blog Post Avatar', 'backup' ),
		'id' => 'blog_post_avatar',
		'type' => 'checkbox',
		'default' => true,
		'desc' => __( 'Check if you want to display the avatar of the author in blog post.', 'backup' ),
	) );
	$section->createOption( array(
		'name' => __( 'Enable if you want to display posts without featured image', 'backup' ),
		'type' => 'enable',
		'default' => false,
		'id' => 'display_post',
		'desc' => __( 'Enable to display other posts that has no featured image.', 'backup' ),

	) );
	$section->createOption( array(
		'name' => __( 'Background Color', 'backup' ),
		'type' => 'color',
		'default' => '#BDC3C7',
		'id' => 'bg_color_post',
		'css' => '#content .russell-content-large .russell-gallery .gallery-image.has-no-featured-image { background-color: value }',
	) );
	$section->createOption( array(
		'name' => __( 'Overlay Color', 'backup' ),
		'type' => 'color',
		'default' => '#000000',
		'id' => 'overlay_color',
		'css' => '#content .russell-content-large .russell-gallery .gallery-image .overlay { background-color: value }',
	) );
	$section->createOption( array(
	    'name' => __( 'Overlay Opacity', 'backup' ),
	    'id' => 'overlay_opacity',
	    'type' => 'number',
		'default' => '0.0',
		'min' => '0.0',
		'max' => '1.0',
		'step' => '0.01',
		'css' => '#content .russell-content-large .russell-gallery .gallery-image:hover .overlay { opacity: value }',
	) );
	$section->createOption( array(
		'name' => __( 'Gallery Text Color', 'backup' ),
		'type' => 'color',
		'default' => '#fff',
		'id' => 'gallery_text_color',
		'css' => '#content .russell-content-large .russell-gallery .gallery-image:hover span.image-title, #content .russell-content-large .russell-gallery .gallery-image:hover span.image-title:after, #content .russell-content-large .russell-gallery .gallery-image:hover ul li a { color: value }',
	) );

	/**
	 * Footer copyright
	 */
	$section = $titan->createThemeCustomizerSection( array(
		'name' => __( 'Footer Copyright Area', 'backup' ),
		'panel' => __( 'Theme Options & Colors', 'backup' ),
		'desc' => __( 'Colors & text of the bottom-most copyright area of the site', 'backup' ),
	) );
	$section->createOption( array(
		'name' => __( 'Copyright Text', 'backup' ),
		'id' => 'russell_footer_copyright_text',
		'type' => 'text',
		'default' => '&copy ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) . ' Theme created by <a href="http://www.gambit.ph" target="_blank">Gambit Technologies, Inc.</a>',
	) );
	$section->createOption( array(
		'name' => __( 'Text Color', 'backup' ),
		'id' => 'footer_copyright_text_color',
		'type' => 'color',
		'default' => '#000000',
		'css' => '.russell-copyright { color: value }',
	) );

	/**
	 * Loading bar color option
	 */
	$section = $titan->createThemeCustomizerSection( array(
		'name' => __( 'Loading Section Color Option', 'backup' ),
		'panel' => __( 'Theme Options & Colors', 'backup' ),
		'desc' => __( 'Colors of the Loading Circles', 'backup' ),
	) );
	$section->createOption( array(
		'name' => __( 'Large Loading Circle', 'backup' ),
		'id' => 'russell_lloading_circle',
		'type' => 'color',
		'default' => '#3498db',
		'css' => '#content .russell-content-large #loader { border-top-color: value }',
	) );
	$section->createOption( array(
		'name' => __( 'Medium Loading Circle', 'backup' ),
		'id' => 'russell_mloading_circle',
		'type' => 'color',
		'default' => '#e74c3c',
		'css' => '#content .russell-content-large #loader:before { border-top-color: value }',
	) );
	$section->createOption( array(
		'name' => __( 'Small Loading Circle', 'backup' ),
		'id' => 'russell_sloading_circle',
		'type' => 'color',
		'default' => '#f9c922',
		'css' => '#content .russell-content-large #loader:after { border-top-color: value }',
	) );
}
