<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package russell
 */

get_header();

$subtitle = __( 'Archives', 'russell' );

if ( is_category() ) {
	$title = single_cat_title( '', false );
	$subtitle = __( 'Categories', 'russell' );
} elseif ( is_tag() ) {
	$title = single_tag_title( '', false );
	$subtitle = __( 'Tags', 'russell' );
} elseif ( is_author() ) {
	$title = get_the_author();
	$subtitle = __( 'Author', 'russell' );
} elseif ( is_year() ) {
	$title = get_the_date( _x( 'Y', 'yearly archives date format' ) );
	$subtitle = __( 'Yearly Archives', 'russell' );
} elseif ( is_month() ) {
	$title = get_the_date( _x( 'F Y', 'monthly archives date format' ) );
	$subtitle = __( 'Monthly Archives', 'russell' );
} elseif ( is_day() ) {
	$title = get_the_date( _x( 'F j, Y', 'daily archives date format' ) );
	$subtitle = __( 'Daily Archives', 'russell' );
} elseif ( is_tax( 'post_format' ) ) {
	if ( is_tax( 'post_format', 'post-format-aside' ) ) {
		$title = _x( 'Asides', 'post format archive title' );
	} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
		$title = _x( 'Galleries', 'post format archive title' );
	} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
		$title = _x( 'Images', 'post format archive title' );
	} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
		$title = _x( 'Videos', 'post format archive title' );
	} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
		$title = _x( 'Quotes', 'post format archive title' );
	} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
		$title = _x( 'Links', 'post format archive title' );
	} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
		$title = _x( 'Statuses', 'post format archive title' );
	} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
		$title = _x( 'Audio', 'post format archive title' );
	} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
		$title = _x( 'Chats', 'post format archive title' );
	}
} elseif ( is_post_type_archive() ) {
	$title = sprintf( __( 'Archives: %s' ), post_type_archive_title( '', false ) );
} elseif ( is_tax() ) {
	$tax = get_taxonomy( get_queried_object()->taxonomy );
	/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
	$title = single_term_title( '', false );
	$subtitle = ucwords( $tax->labels->singular_name );
} else {
	$title = __( 'Archives' );
}

?>
<div id="content" class="russell-content-wrapper russell-content-reverse">
	
	<section class="russell-content-large russell-content-image">
		<div id="loader-wrapper">
			<div id="loader"></div>
		</div>
	</section>
	
	<section class="russell-content-small russell-content-area">
		<div>
			<h1 class="russell-site-title">
				<a href='#'><?php echo $title ?></a>
				<span><?php echo $subtitle ?></span>
			</h1>

		</div>
		
		<?php russell_selected_post_tags(); ?>
		
		<div class="russell-copyright">
            <?php russell_copyright(); ?>
        </div>
	</section>
</div>
<?php

get_footer();
