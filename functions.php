<?php
/**
 * russell functions and definitions
 *
 * @package russell
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'russell_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function russell_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on russell, use a find and replace
	 * to change 'russell' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'russell', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'russell' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'russell_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // russell_setup
add_action( 'after_setup_theme', 'russell_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function russell_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'russell' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'russell_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function russell_scripts() {
	wp_enqueue_style( 'russell-style', get_stylesheet_uri() );

	wp_enqueue_script( 'russell-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'russell-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'russell_scripts' );

/**
*   Get 20 Latest Posts
*/
function russell_latest_post( $num = 10, $page = 1, $tagID = null ) {
    
    if ( ! empty( $_GET['num'] ) ) {
        $num = $_GET['num'];
    }
    if ( ! empty( $_GET['page'] ) ) {
        $page = $_GET['page'];  
    }
    if ( ! empty( $_GET['tagID'] ) ) {
        $tagID = $_GET['tagID'];
    }
    
    $args = array( 
        'posts_per_page' => $num,
        'order' => 'DESC',
        'paged' => $page,
    );
    
    if ( ! empty( $tagID ) ) {
        $args['tag__in'] = $tagID;
    }    
    
    $data = array();
    
    $posts = get_posts( $args );
    
    foreach( $posts as $post ) {
        
        $postTags = get_the_tags( $post );
        $tags = array();
        
        if ( ! empty( $postTags ) ) {
            foreach ( $postTags as $postTag ) {
                $tags[ $postTag->term_id ] = $postTag->name;
            }
        }
        
        $postCategories = get_the_category( $post );
        $categories = array();
        
        if ( ! empty( $postCategories ) ) {
            foreach ( $postCategories as $postCategory ) {
                $categories[ $postCategory->term_id ] = $postCategory->name;
            }
        }
        
        $featuredImageID = get_post_thumbnail_id( $post->ID );
        $url = '';
        if ( ! empty( $featuredImageID ) ) {
            $url = wp_get_attachment_url( $featuredImageID, 'full' );
        }
        
        $data[] = array(
            'image' => $url,
            'post_id' => $post->ID,
            'title' => $post->post_title,
            'categories' => $categories,
            'tags' => $tags,
        );
    } 
    echo json_encode( $data );
    die();
}
add_action( 'wp_ajax_get_latest_post', 'russell_latest_post' );
add_action( 'wp_ajax_nopriv_get_latest_post', 'russell_latest_post' );


/**
*   Get post author, avatar, date & content
*/
function russell_get_post( $id ) {
    
    if ( ! empty( $_GET['id'] ) ) {
        $id = $_GET['id'];
    }
    
    $post = get_post( $id );
    
    $data = array();
    
    $date = $post->post_date;
    $content = $post->post_content;
    $authorId = $post->post_author;
    $authorName = get_the_author_meta( 'display_name', $authorId );
    $authorEmail = get_the_author_meta( 'user_email', $authorId );
    $avatar = get_avatar( $authorId, 32 );
    
    $data[] = array(   
        'author' => $authorName,
        'author_email' => $authorEmail,
        'avatar' => $avatar,
        'date' => $date,
        'content' => $content,
    );
    
    echo json_encode(  $data );
    die();
}
add_action( 'wp_ajax_get_post', 'russell_get_post' );
add_action( 'wp_ajax_nopriv_get_post', 'russell_get_post' );

/**
*   Get all tags of all posts
*/
function russell_get_post_tags() {
    $tags = get_terms( 'post_tag', array('fields' => 'id=>name', 'get' => 'all', ) );
    
    echo json_encode( $tags );
    die();
}
add_action( 'wp_ajax_get_post_tags', 'russell_get_post_tags' );
add_action( 'wp_ajax_nopriv_get_post_tags', 'russell_get_post_tags' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Titan Framework plugin checker
 */
require get_template_directory() . '/titan-framework-checker.php';

/**
 * Load Titan Framework options
 */
require get_template_directory() . '/titan-options.php';