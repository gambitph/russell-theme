<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package russell
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function russell_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'russell_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function russell_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'russell' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'russell_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function russell_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'russell_render_title' );
endif;

/**
 * Get featured logo using Jetpack.
 */
function russell_feature_logo() {
	if ( function_exists( 'jetpack_the_site_logo' ) && function_exists( 'jetpack_has_site_logo' ) ) {
		if ( jetpack_has_site_logo() ) {
			echo "<div class='logo'>";
			jetpack_the_site_logo();
			echo '</div>';
			return;
		}
	}

	echo '<div class="logo"><a href="' . esc_url( get_home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></div>';
}

/**
 * Get social icons using TitanFramework.
 */
function russell_create_social_icons() {

	if ( ! class_exists( 'TitanFramework' ) ) {
		return;
	}
	$titan = TitanFramework::getInstance( 'russell' );

	$socialIcons = '';
	for ( $i = 0; $i <= 10; $i++ ) {
	    $url = $titan->getOption( 'social_' . $i );
		if ( empty( $url ) ) {
			continue;
		}
		$socialIcons .= "<a href='{$url}' target='_social'></a>";
	}
	if ( ! empty( $socialIcons ) ) {
		echo "<div class='social-navigation'>" . $socialIcons . '</div>';
	}
}

/**
 * Customize comment form.
 */
function russell_comment_form() {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields = array(

	  'author' =>
	    '<div><p class="comment-form-author"><label for="author">' . __( 'Name', 'domainreference' ) . '</label> ' .
	    ( $req ? '<span class="required">*</span>' : '' ) .
	    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
	    '" size="28"' . $aria_req . ' /></p>',

	  'email' =>
	    '<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' .
	    ( $req ? '<span class="required">*</span>' : '' ) .
	    '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
	    '" size="28"' . $aria_req . ' /></p>',

	  'url' =>
	    '<p class="comment-form-url"><label for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
		( $req ? '<span class="required">*</span>' : '' ) .
	    '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
	    '" size="28" /></p></div>',
	);

	comment_form( array(
		'fields' => $fields,
	) );
	 // Apply_filters( 'russell_comment_form', $fields );.
}

/**
 * Gathers all the sidebar IDs and the replacement IDs
 */
add_action( 'cs_predetermineReplacements', 'russell_custom_sidebars_determine_replacements' );
function russell_custom_sidebars_determine_replacements( $defaults ) {
	global $_russell_sidebar_ids_to_replace;
	$_russell_sidebar_ids_to_replace = array();

	$customSidebarReplacer = CustomSidebarsReplacer::instance();

	$replacements = $customSidebarReplacer->determine_replacements( $defaults );

	foreach ( $replacements as $sb_id => $replace_info ) {

		if ( ! is_array( $replace_info ) || count( $replace_info ) < 3 ) {
			continue;
		}

		// Fix rare message "illegal offset type in isset or empty"
		$replacement = (string) @$replace_info[0];
		$replacement_type = (string) @$replace_info[1];
		$extra_index = (string) @$replace_info[2];

		$check = $customSidebarReplacer->is_valid_replacement( $sb_id, $replacement, $replacement_type, $extra_index );

		if ( $check ) {
			$_russell_sidebar_ids_to_replace[ $sb_id ] = $replacement;
		}
	}
}


/**
 * Checks the sidebars being replaced and make corresponding is_active_sidebar calls to work
 */
add_filter( 'is_active_sidebar', 'russell_custom_sidebars_is_active_sidebar', 10, 2 );
function russell_custom_sidebars_is_active_sidebar( $is_active_sidebar, $index ) {
	global $_russell_sidebar_ids_to_replace;

	if ( empty( $_russell_sidebar_ids_to_replace ) ) {
		return $is_active_sidebar;
	}

	if ( ! empty( $_russell_sidebar_ids_to_replace[ $index ] ) ) {
		// Return the current value if it's the same replacement
		if ( $_russell_sidebar_ids_to_replace[ $index ] == $index ) {
			return $is_active_sidebar;
		}

		return is_active_sidebar( $_russell_sidebar_ids_to_replace[ $index ] );
	}

	return $is_active_sidebar;
}
