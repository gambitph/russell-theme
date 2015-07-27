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
	add_theme_support( 'post-thumbnails' );

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
		'name'          => __( 'Footer Sidebar', 'russell' ),
		'id'            => 'footer-sidebar',
		'description'   => __( 'The footer widget area', 'russell' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( '404 Sidebar', 'russell' ),
		'id'            => '404-sidebar',
		'description'   => __( 'The 404 widget area', 'russell' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'russell_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function russell_scripts() {
    
    // Use our copy of genericons instead of Jetpack's since we are using a newer version
	// wp_deregister_style( 'genericons' );

	if ( ! wp_script_is( 'genericons', 'registered' ) ) {
		wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css' );
	}
	
	if ( class_exists( 'Dynamic_Featured_Image' ) ) {
	    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/min/owl.carousel.min.js', array( 'jquery' ), '20150623', true );
        wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css' );
        wp_enqueue_style( 'owl-carousel-theme', get_template_directory_uri() . '/css/owl.theme.css' );
        wp_enqueue_script( 'single-php', get_template_directory_uri() . '/js/min/single-min.js', array(), '20150623', true );
    }
    
    if ( !class_exists( 'TitanFramework' ) ) {
        wp_register_style( 'russell-font-monserrat', 'http://fonts.googleapis.com/css?family=Montserrat:400,700' );
        wp_register_style( 'russell-font-roboto', 'http://fonts.googleapis.com/css?family=Roboto+Slab:300,700' );
        wp_enqueue_style( 'russell-font-monserrat' );
        wp_enqueue_style( 'russell-font-roboto' );
    }
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
function ajax_russell_get_post_tags() {
    echo json_encode( russell_get_post_tags() );
    die();
}

function russell_get_post_tags() {
    $tags = get_terms( 'post_tag', array('fields' => 'id=>name', 'get' => 'all', ) );
    return $tags;
}
add_action( 'wp_ajax_get_post_tags', 'ajax_russell_get_post_tags' );
add_action( 'wp_ajax_nopriv_get_post_tags', 'ajax_russell_get_post_tags' );

/**
*   Get caption of featured image
*/
function russell_image_caption( $id ) {
    $attachment = get_post( $id );
    	$imageInfo =  array(
    		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
    		'caption' => $attachment->post_excerpt,
    		'description' => $attachment->post_content,
    		'href' => get_permalink( $attachment->ID ),
    		'src' => $attachment->guid,
    		'title' => $attachment->post_title
    );
    echo $imageInfo['caption'];
}

/**
*   Get copyright
*/
function russell_copyright() {
    if ( class_exists( 'TitanFramework' ) ) {
        $titan = TitanFramework::getInstance( 'russell' );
        echo $titan->getOption( 'russell_footer_copyright_text' );
    } else {
        echo '&copy ' . date( 'Y' ) . ' ' .  get_bloginfo( 'name' ) . ' Theme created by <a href="http://www.gambit.ph" target="_blank">Gambit Technologies, Inc.</a>';
    }
}

/**
*   Get tags of the selected posts
*/
function russell_selected_post_tags() {
    if ( have_posts() ) {
        // get tags for found posts
        $recent_tags = array();
        
        $tags = get_the_tags();
        if ( $tags ) {
            while ( have_posts() ) : the_post();
                foreach( $tags as $t ) { $recent_tags[$t->slug] = $t->name; } // this adds to the array in the form ['slug']=>'name'
            endwhile;
        }
        // de-dupe
        $recent_tags = array_unique($recent_tags);
        // sort
        natcasesort($recent_tags);
		if ( ! empty ( $recent_tags ) ) {
			?>
			
			<div>
				<?php
				echo "<ul class='russell-taglist'>";
			    foreach( $recent_tags as $tags ) {
			        ?>
				    <li><?php echo $tags ?></li>
				    <?php    
			    }
				echo "</ul>";
				?>
			</div>
			
			<?php
		} else {
			?>
			<span class="nothing-found"><?php _e( 'Nothing Found', 'russell' ); ?></span>
			<?php
		}
    }                     
}

/**
 * Enqueue Owl Carousel for Single Post template.
 */
function russell_single_scripts_and_styles() {
	
	if( class_exists( 'Dynamic_Featured_Image' ) ) {
         global $dynamic_featured_image;
         $featuredImages = $dynamic_featured_image->get_featured_images( $postId );
         foreach( $featuredImages as $featuredImage ) {
             ?>
             <div class="item" style="background-image: url(<?php echo esc_url( $featuredImage['full'] ) ?>); background-size: cover; background-position: center">
                <span class="featured-image-caption">    
                    <?php 
                        $caption = $dynamic_featured_image -> get_image_caption( $featuredImage["full"] );
                        echo $caption;
                    ?>
                </span>
         	 </div>
             <?php
         }
         //wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.theme.css' );
        //You can now loop through the image to display them as required
     }
}
//add_filter( "single_template", "russell_single_scripts_and_styles" );

/**
 *  Makes it so that archives are pulled with infinite amount all the time.
 */
function russell_all_archives( $query ) {
    if ( is_archive() ) {
        $query->set( 'posts_per_page', -1 );
        return;
    }
}
add_action( 'pre_get_posts', 'russell_all_archives', 1 );

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