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
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
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
	global $wp_query;

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

	if ( ! class_exists( 'TitanFramework' ) ) {
		wp_register_style( 'russell-font-monserrat', 'http://fonts.googleapis.com/css?family=Montserrat:400,700' );
		wp_register_style( 'russell-font-roboto', 'http://fonts.googleapis.com/css?family=Roboto+Slab:300,700' );
		wp_enqueue_style( 'russell-font-monserrat' );
		wp_enqueue_style( 'russell-font-roboto' );
	}
	wp_enqueue_style( 'russell-style', get_stylesheet_uri() );

	wp_enqueue_script( 'russell-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'loading-bar', get_template_directory_uri() . '/js/loading-bar.js', array( ' jquery' ), '20150908', true );

	wp_enqueue_script( 'russell-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'bottom-scroll', get_template_directory_uri() . '/js/bottom-scroll.js', array( 'jquery' ), '20150810', true );

	wp_localize_script(
	    'bottom-scroll',
	    'bottomScrollParams',
	    array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'query' => $wp_query->query,
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'russell_scripts' );

function ajax_russell_large_content() {

	$page = 1;
	if ( ! empty( $_GET['page'] ) ) {
		$page = $_GET['page'];
	}

	$query = null;
	if ( ! empty( $_GET['query'] ) ) {
		$query = $_GET['query'];
	}

	$tagID = null;
	if ( ! empty( $_GET['tag_id'] ) ) {
		$tagID = $_GET['tag_id'];
	}

	echo json_encode( russell_large_content( 10, $page, $query, $tagID ) );
	die();
}
add_action( 'wp_ajax_russell_large_content', 'ajax_russell_large_content' );
add_action( 'wp_ajax_nopriv_russell_large_content', 'ajax_russell_large_content' );

function russell_large_content( $num = 10, $page = 1, $query = null, $tagID = null ) {
	$args = array(
		'posts_per_page' => $num,
		'order' => 'DESC',
		'paged' => $page,
		'ignore_sticky_posts' => 1,
		'meta_query' => array(
			array(
				'key' => '_thumbnail_id',
				'compare' => 'EXISTS',
			),
		),
	);
	if ( empty( $query ) ) {
		global $wp_query;
		$query = $wp_query->query;
	}

	if ( ! empty( $query ) ) {
		foreach ( $query as $key => $value ) {
			$args[ $key ] = $value;
		}
	}

	if ( ! empty( $tagID ) ) {
		$args['tag_id'] = $tagID;
	}

	$query = new WP_Query( $args );

	$data = array();

	while ( $query->have_posts() ) {
		$query->the_post();

		$title = get_the_title();
		$postId = get_the_ID();
		$link = get_permalink( $postId );

		$featuredImageID = get_post_thumbnail_id( $postId );
		$url = '';
		if ( ! empty( $featuredImageID ) ) {
			$url = wp_get_attachment_url( $featuredImageID, 'full' );
		}

		$postTags = get_the_tags();
		$tags = array();

		if ( ! empty( $postTags ) ) {
			foreach ( $postTags as $postTag ) {
				$tags[ $postTag->term_id ] = $postTag->name;
			}
		}

		$postCategories = get_the_category( );
		$categories = array();
		$catLinks = array();

		if ( ! empty( $postCategories ) ) {
			foreach ( $postCategories as $postCategory ) {
			    $categories[ $postCategory->term_id ] = $postCategory->name;
				$catID = $postCategory->term_id;
				$catLinks[ $postCategory->term_id ] = get_category_link( $catID );

			}
		}
		$data[] = array(
			'image' => $url,
			'post_id' => $postId,
			'title' => $title,
			'categories' => $categories,
			'tags' => $tags,
			'link' => $link,
			'cat_link' => $catLinks,
		);
	}

	wp_reset_postdata();
	return $data;

}

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

	echo json_encode( $data );
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
	$tags = get_terms( 'post_tag', array( 'fields' => 'id=>name', 'get' => 'all' ) );
	return $tags;
}
add_action( 'wp_ajax_get_post_tags', 'ajax_russell_get_post_tags' );
add_action( 'wp_ajax_nopriv_get_post_tags', 'ajax_russell_get_post_tags' );

/**
 *   Get caption of featured image
 */
function russell_image_caption( $id ) {
	$attachment = get_post( $id );
		$imageInfo = array(
			'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption' => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href' => get_permalink( $attachment->ID ),
			'src' => $attachment->guid,
			'title' => $attachment->post_title,
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

function ajax_russell_selected_post_tags() {

	$page = 1;
	if ( ! empty( $_GET['page'] ) ) {
		$page = $_GET['page'];
	}

	$query = null;
	if ( ! empty( $_GET['query'] ) ) {
		$query = $_GET['query'];
	}

	echo json_encode( russell_archive_post( 10, $page, $query ) );
	die();
}
add_action( 'wp_ajax_russell_selected_post_tags', 'ajax_russell_selected_post_tags' );
add_action( 'wp_ajax_nopriv_russell_selected_post_tags', 'ajax_russell_selected_post_tags' );

/**
 *   Get tags of the selected posts
 */
function russell_selected_post_tags() {

	$args = array(
		'posts_per_archive_page' => 10,
		'order' => 'DESC',
		'paged' => 1,
		'ignore_sticky_posts' => 1,
		'meta_query' => array(
	        array(
	         'key' => '_thumbnail_id',
	         'compare' => 'EXISTS',
	        ),
	  	),
	);
	if ( empty( $query ) ) {
		global $wp_query;
		$query = $wp_query->query;
	}

	if ( ! empty( $query ) ) {
		foreach ( $query as $key => $value ) {
			$args[ $key ] = $value;
		}
	}
	$query = new WP_Query( $args );

	// Get tags for found posts.
	$recent_tags = array();

	while ( $query->have_posts() ) {
		$query->the_post();

		// this adds to the array in the form ['slug']=>'name'
		$tags = get_the_tags();
		foreach ( $tags as $t ) {
			$recent_tags[ $t->slug ] = $t->name;
		}
		// var_dump( $recent_tags);
	}

	wp_reset_postdata();
	// sort
	natcasesort( $recent_tags );
	if ( ! empty( $recent_tags ) ) {
		?>
		
		<div>
			<?php
			echo "<ul class='russell-taglist'>";
		    foreach ( $recent_tags as $tags ) {
				$tag = get_term_by( 'name', $tags, 'post_tag' );
				if ( ! empty( $tag ) ) {
					$tagID = $tag->term_id;
					$args['tag_id'] = $tagID;
				}
				?>
			    <li><a href="#" data-tag-id="<?php echo $tagID ?>"><?php echo $tags ?></a></li>
			    <?php
		    }
			echo '</ul>';
			?>
		</div>
		
		<?php
	}
}

/**
 * Enqueue Owl Carousel for Single Post template.
 */
function russell_single_scripts_and_styles() {

	if ( class_exists( 'Dynamic_Featured_Image' ) ) {
		 global $dynamic_featured_image;
		 $featuredImages = $dynamic_featured_image->get_featured_images( $postId );
		foreach ( $featuredImages as $featuredImage ) {
			?>
			<div class="item" style="background-image: url(<?php echo esc_url( $featuredImage['full'] ) ?>); background-size: cover; background-position: center">
                <span class="featured-image-caption">    
					<?php
					   $caption = $dynamic_featured_image -> get_image_caption( $featuredImage['full'] );
					   echo $caption;
					?>
                </span>
         	 </div>
				<?php
		}
		 // wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.theme.css' );
		// You can now loop through the image to display them as required
	}
}
// add_filter( "single_template", "russell_single_scripts_and_styles" );
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
// require get_template_directory() . '/inc/custom-header.php';
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
