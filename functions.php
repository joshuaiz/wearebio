<?php

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!

-------------------------------------------------------------------------------------*/


/**
 * Set Max Content Width
 *
 * @since Mesh 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 800;

if( !function_exists( 'zilla_content_width' ) ) :
/**
 * Adjust the content_width for the full width page and single image
 * attachment templates.
 *
 * @since Mesh 1.0
 *
 * @return void
 */
function zilla_content_width() {
	if ( is_page_template( 'template-full-width.php' ) || is_attachment() ) {
		global $content_width;
		$content_width = 1440;
	}
}
endif; 
add_action( 'template_redirect', 'zilla_content_width' );


if ( !function_exists( 'zilla_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers various features supported
 * by Mesh
 * 
 * @uses load_theme_textdoman() For translation support
 * @uses register_nav_menu() To add support for navigation menu
 * @uses add_theme_support() To add support for post-thumbnails and post-formats
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size
 * @uses add_image_size() To add additional image sizes
 *
 * @since Mesh 1.0
 *
 * @return void
 */
function zilla_theme_setup() {

	/* Load translation domain --------------------------------------------------*/
	load_theme_textdomain( 'zilla', get_template_directory() . '/languages' );

	/* Register WP 3.0+ Menus ---------------------------------------------------*/
	register_nav_menu( 'mobile-menu', __('Mobile Menu', 'zilla') );

	/* Configure WP 2.9+ Thumbnails ---------------------------------------------*/
	add_theme_support( 'post-thumbnails' );
	// set_post_thumbnail_size( 600, 450, true ); // Normal post thumbnails

	// add_image_size('portfolio-thumb', 400, 300, true); // Main portfolio and archive pages

	add_image_size( 'portfolio-admin-thumb', 35, 35, true ); // Used in the portfolio edit page

	/* Add support for post formats ---------------------------------------------*/
	add_theme_support( 'post-formats', array('audio', 'gallery', 'image', 'link', 'quote', 'video' ) );
	/* Add support for automatic feed links ---------------------------------------*/
	add_theme_support( 'automatic-feed-links' );

}
endif;
add_action( 'after_setup_theme', 'zilla_theme_setup' );


if ( !function_exists( 'zilla_sidebars_init' ) ) :
/**
 * Register the sidebars for the theme
 *
 * @since Mesh 1.0
 *
 * @uses register_sidebar() To add sidebar areas
 * @return void
 */
function zilla_sidebars_init() {
	register_sidebar(array(
		'name' => __('Main Sidebar', 'zilla'),
		'description' => __('Primary sidebar.', 'zilla'),
		'id' => 'sidebar-main',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebars(4, array(
		'name' => __('Footer Column %d', 'zilla'),
		'id' => 'footer-column',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
}
endif;
add_action( 'widgets_init', 'zilla_sidebars_init' );


if ( !function_exists( 'zilla_excerpt_length' ) ) :
/**
 * Sets a custom excerpt length for portfolios
 *
 * @since Mesh 1.0
 *
 * @param int $length Excerpt length
 * @return int New excerpt length
 */
function zilla_excerpt_length($length) {
	return 150;
}
endif;
add_filter('excerpt_length', 'zilla_excerpt_length', 10, 1);


if ( !function_exists( 'zilla_wp_title' ) ) :
/**
 * Creates formatted and more specific title element for output based
 * on current view
 *
 * @since Mesh 1.0
 *
 * @param string $title Default title text
 * @param string $sep Optional separator
 * @return string Formatted title
 */
function zilla_wp_title( $title, $sep ) {
	if( !zilla_is_third_party_seo() ){
		global $paged, $page;

		if( is_feed() ) {
			return $title;
		}

		$title .= get_bloginfo( 'name' );

		$site_description = get_bloginfo( 'description', 'display' );
		if( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}

		if( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( __('Page %s', 'zilla'), max( $paged, $page ) );
		}
	}
	return $title;
}
endif;
add_filter('wp_title', 'zilla_wp_title', 10, 2);


if ( !function_exists( 'zilla_enqueue_scripts' ) ) :
/**
 * Enqueues scripts and styles for front end
 *
 * @since Mesh 1.0
 *
 * @return void
 */
function zilla_enqueue_scripts() {
	/* Register our scripts -----------------------------------------------------*/
	wp_register_script('validation', '//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery', '1.9', true);
	wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2.min.js', '', '2.6.2', false);
	wp_register_script('cycle2', get_template_directory_uri() . '/js/jquery.cycle2.min.js', 'jquery', '2', true);
	wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', 'jquery', '1.5.25', true);
	wp_register_script('jplayer', get_template_directory_uri() . '/js/jquery.jplayer.min.js', 'jquery', '2.5', true);
	wp_register_script('dotdotdot', get_template_directory_uri() . '/js/jquery.dotdotdot.min.js', 'jquery', '1.6.5', true);
	wp_register_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', 'jquery', '1.0', true);
	wp_register_script('zilla-custom', get_template_directory_uri() . '/js/jquery.custom.js', array('jquery', 'cycle2', 'isotope',  'jplayer', 'fitvids', 'dotdotdot'), '', true);

	/* Enqueue our scripts ------------------------------------------------------*/
	wp_enqueue_script('modernizr');
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-migrate');
	wp_enqueue_script('cycle2');
	wp_enqueue_script('isotope');
	wp_enqueue_script('jplayer');
	wp_enqueue_script('dotdotdot');
	wp_enqueue_script('fitvids');
	wp_enqueue_script('zilla-custom');

	/* loads the javascript required for threaded comments ----------------------*/
	if( is_singular() && comments_open() && get_option( 'thread_comments') ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if( is_page_template('template-contact.php') ) {
		wp_enqueue_script('validation');
	}

	wp_localize_script('zilla-custom', 'zillaMesh', array(
		'jsFolder' => get_template_directory_uri() . '/js',
		'portfolioFilterAll' => __('All', 'zilla')
	));

	/* Load our stylesheet ------------------------------------------------------*/
	$zilla_options = get_option('zilla_framework_options');
	wp_enqueue_style( $zilla_options['theme_name'], get_template_directory_uri() . '/css/style.css' );
}
endif;
add_action('wp_enqueue_scripts', 'zilla_enqueue_scripts');


if ( !function_exists( 'zilla_enqueue_admin_scripts' ) ) :
/**
 * Enqueues scripts for back end
 *
 * @since Mesh 1.0
 *
 * @return void
 */
function zilla_enqueue_admin_scripts() {
	wp_register_script( 'zilla-admin', get_template_directory_uri() . '/includes/js/jquery.custom.admin.js', 'jquery' );
	wp_enqueue_script( 'zilla-admin' );
}
endif;
add_action( 'admin_enqueue_scripts', 'zilla_enqueue_admin_scripts' );


if ( !function_exists( 'zilla_add_portfolio_to_rss' ) ) :
/**
 * Adds portfolios to RSS feed
 *
 * @since Mesh 1.0
 *
 * @param obj $request
 * @return obj Updated request
 */
function zilla_add_portfolio_to_rss( $request ) {
	if (isset($request['feed']) && !isset($request['post_type'])) {
		$request['post_type'] = array('post', 'portfolio');
	}

	return $request;
}
endif;
add_filter('request', 'zilla_add_portfolio_to_rss');


if( !function_exists('zilla_post_meta_index') ) :
/**
 * Print HTML meta information for current post
 *
 * @since Mesh 1.0
 *
 * @return void
 */
function zilla_post_meta_index() {
?>

	<!--BEGIN .entry-meta .entry-index-->
	<footer class="entry-meta entry-meta-index">
	<?php 
		printf( ' <span class="published"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_html( get_the_time( get_option('date_format') ) ) 
		);
		
		edit_post_link( __('edit', 'zilla'), '<span class="edit-post">', '</span>' ); 
	?>
	<!--END .entry-meta entry-header -->
	</footer>
<?php
} 
endif;


if( !function_exists('zilla_post_meta_single') ) :
/**
 * Print HTML meta information for current post
 *
 * @since Mesh 1.0
 *
 * @return void
 */
function zilla_post_meta_single() {
?>

	<!--BEGIN .entry-meta .entry-index-->
	<footer class="entry-meta entry-meta-single">
	<?php 
		printf( ' <span class="published"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_html( get_the_time( get_option('date_format') ) ) 
		);
		printf( '<span class="author">%1$s <a href="%2$s" title="%3$s" rel="author">%4$s</a></span>',
			__('By', 'zilla'),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __('View all posts by %s', 'zilla' ), get_the_author() ) ),
			get_the_author()
		);
	?>
		<span class="entry-categories"><?php the_category(', ') ?></span>
		<span class="entry-tags"><?php the_tags(' ', ', ', ''); ?></span>
	<?php	
		edit_post_link( __('edit', 'zilla'), '<span class="edit-post">', '</span>' ); 
	?>
	<!--END .entry-meta entry-header -->
	</footer>
<?php
} 
endif;


if( ! function_exists( 'zilla_paging_nav' ) ) :
/**
 * Display navigation to next/prev if needed
 *
 * @since Mesh 1.0
 *
 * @return void
 */
function zilla_paging_nav() {
	global $wp_query;

	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() || is_single() ) ) {
		echo '<div class="no-paging-clear"></div>';
		return;
	}
	?>

	<!--BEGIN .navigation .page-navigation -->
	<nav class="navigation page-navigation" role="navigation">
		<?php if( get_next_posts_link() ) { ?>
			<div class="nav-previous"><?php next_posts_link(__('Older Posts', 'zilla')) ?></div>
		<?php } ?>

		<?php if( get_previous_posts_link() ) { ?>
			<div class="nav-next"><?php previous_posts_link(__('Newer Posts', 'zilla')) ?></div>
		<?php } ?>
	<!--END .navigation .page-navigation -->
	</nav>

	<?php
}
endif;

    
if ( !function_exists( 'zilla_comment' ) ) :
/**
 * Custom comment HTML output
 *
 * @since Mesh 1.0
 *
 * @param $comment
 * @param $args
 * @param $depth
 * @return void
 */
function zilla_comment($comment, $args, $depth) {

	$isByAuthor = false;

	if($comment->comment_author_email == get_the_author_meta('email')) {
		$isByAuthor = true;
	}

	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

		<div id="comment-<?php comment_ID(); ?>">

			<?php echo get_avatar($comment, $size = '45'); ?>

			<div class="comment-author vcard">
				<?php printf(__('<cite class="fn">%s</cite> ', 'zilla'), get_comment_author_link()) ?> <?php if($isByAuthor) { ?><span class="author-tag"><?php _e('(Author)', 'zilla') ?></span><?php } ?>
			</div>

			<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'zilla'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'zilla'),'  ','') ?> &middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
			
			<div class="comment-body">
				<?php comment_text() ?>
			</div>

			<?php if ($comment->comment_approved == '0') { ?>
				<em class="moderation"><?php _e('Your comment is awaiting moderation.', 'zilla') ?></em><br />
			<?php } ?>

		</div>
<?php
}
endif;


if ( !function_exists( 'zilla_list_pings' ) ) :
/**
 * Separate pings from comments 
 *
 * @since Mesh 1.0
 *
 * @param $comment
 * @param $args 
 * @param $depth
 * @return void
 */
function zilla_list_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
	<?php 
}
endif;


if ( !function_exists('zilla_exclude_pages_from_search') ) :
/**
 * Exclude pages from search results
 * 
 * @since Mesh 1.0
 *
 * @param obj $query The query object
 * @return void
 */
function zilla_exclude_pages_from_search($query)
{
	if( !is_admin() && $query->is_main_query() ) {
		if( $query->is_search ) {
			$query->set('post_type', 'post');
		}
	}
}
endif;
add_action('pre_get_posts', 'zilla_exclude_pages_from_search');


if ( !function_exists( 'zilla_gallery' ) ) :
/**
 * Print the HTML for galleries
 *
 * @since Mesh 1.0
 *
 * @param int $id ID of the post
 * @param string $imagesize Optional size of image
 * @param string $layout Optional layout format
 * @param int/string $imagesize the image size 
 * @return string $content of the HTML content
 */
function zilla_gallery( $postid, $imagesize = '', $layout = 'stacked' ) {

	$image_ids_raw = get_post_meta($postid, '_zilla_image_ids', true);

	if( $image_ids_raw != '' ) {
		// custom gallery created
		$image_ids = explode(',', $image_ids_raw);
		$orderby = 'post__in';
		$post_parent = null;
	} else {
		// pull all images attached to post
		$image_ids = '';
		$orderby = 'menu_order';
		$post_parent = $postid;
	}

	// get the gallery images
	$args = array(
		'include' => $image_ids,
		'numberposts' => -1,
		'orderby' => $orderby,
		'order' => 'ASC',
		'post_type' => 'attachment',
		'post_parent' => $post_parent,
		'post_mime_type' => 'image',
		'post_status' => 'null'
	);
	$attachments = get_posts($args);

	$content = '';
	if( !empty($attachments) ) {
		$content .= '<!--BEGIN #zilla-gallery-' . $postid . '--><ul id="zilla-gallery-' . $postid . '" class="zilla-gallery ' . $layout . '">';

		foreach( $attachments as $attachment ) {
			$src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
			$caption = $attachment->post_excerpt;
			$caption = ($caption) ? '<span class="slide-caption">' . $caption . '</span>' : '';
			$alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
			$content .= '<li>' . $caption . '<img height="' . $src[2] . '" width="' . $src[1] . '" src="' . $src[0] . '" alt="' . $alt . '" /></li>';
		}

		$content .= '</ul>';

		if( $layout != 'stacked' ) {
			$content .= '<a href="#" id="zilla-slide-prev-'. $postid .'" class="zilla-slide-prev">' . __('Previous', 'zilla') . '</a>';
			$content .= '<a href="#" id="zilla-slide-next-'. $postid .'" class="zilla-slide-next">' . __('Next', 'zilla') . '</a>';
		}
	}

	return $content;
}
endif;

if ( !function_exists( 'zilla_media_player' ) ) :
/**
 * Print HTML for audio post format media
 *
 * @since Mesh 1.0
 *
 * @param int $postid Post ID
 * @param int $width Width of the media area
 * @param int $height Height of the media area
 * @return void
 */
function zilla_media_player($postid, $width = 600, $player_type = 'video') {
	$height = 450;

	if( $player_type == 'video' ) {
		$m4v = get_post_meta($postid, '_zilla_video_m4v', true);
		$ogv = get_post_meta($postid, '_zilla_video_ogv', true);
		$poster = get_post_meta($postid, '_zilla_video_poster_url', true);
		$height = get_post_meta($postid, '_zilla_video_height', true);		
		$media_data = array(
			"ancestor" => '#jp-container-' . $postid,
			"m" => $m4v,
			"o" => $ogv,
			"p" => $poster
		);
	} else {
		$mp3 = get_post_meta($postid, '_zilla_audio_mp3', TRUE);
		$ogg = get_post_meta($postid, '_zilla_audio_ogg', TRUE);
		$poster = get_post_meta($postid, '_zilla_audio_poster_url', TRUE);
		$height = get_post_meta($postid, '_zilla_audio_height', TRUE); 
		$media_data = array(
			"ancestor" => '#jp-container-' . $postid,
			"m" => $mp3,
			"o" => $ogg,
			"p" => $poster
		);

	}

?>
    
    <div id="jquery-jplayer-<?php echo $player_type . '-' . $postid; ?>" class="jp-jplayer" data-orig-width="<?php echo esc_attr($width); ?>" data-orig-height="<?php echo esc_attr($height); ?>" data-player-type="<?php echo esc_attr($player_type); ?>" data-media-info=<?php echo esc_attr(json_encode($media_data)); ?>></div>

	<div id="jp-container-<?php echo $postid; ?>" class="jp-<?php echo $player_type; ?>">
		<div id="jp-<?php echo $player_type; ?>-interface-<?php echo esc_attr($postid); ?>" class="jp-interface">
			<ul class="jp-controls">
				<li><a href="#" class="jp-play" tabindex="1" title="play">play</a></li>
				<li><a href="#" class="jp-pause" tabindex="1" title="pause">pause</a></li>
			</ul>
			<div class="jp-progress">
				<div class="jp-seek-bar">
					<div class="jp-play-bar"></div>
				</div>
			</div>
		</div>
	</div>
    <?php 
}
endif;

if( !function_exists( 'zilla_set_portfolio_args' ) ) :
/**
 * Set up the query args for the portfolio type taxonomy
 *
 * @since Mesh 1.0
 * 
 * @param obj $query
 * @return void
 */
function zilla_set_portfolio_args( $query ) {
	if( is_admin() || !$query->is_main_query() )
		return;

	if( is_tax( 'portfolio_type' ) ) {
		$query->set( 'posts_per_page', -1 );
		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'ASC' );
		return;
	}
}
endif;
add_action( 'pre_get_posts', 'zilla_set_portfolio_args' );


if( !function_exists( 'zilla_portfolio_template_selector' ) ) :
/**
 * Override the default portfolio type archive to use the portfolio archive
 * http://billerickson.net/reusing-wordpress-theme-files/
 * 
 * @since Mesh 1.0
 * 
 * @param $template
 * @return $template
 */
function zilla_portfolio_template_selector( $template ) {
	if( is_tax( 'portfolio-type' ) ) {
		$template = get_query_template( 'archive-portfolio' );
	}

	if( is_post_type_archive( 'portfolio' ) ) {
		$template = get_query_template( 'template-portfolio' );
	}

	return $template;
}
endif;
add_filter( 'template_include', 'zilla_portfolio_template_selector' );


if( !function_exists( 'zilla_add_menu_filter_attributes' ) ) :
/**
 * Add data-portfolio-filter attribute to menus
 * 
 * @since Mesh 1.0
 *
 * @param array $atts current attributes
 * @param obj $item object of nav item
 * @return array $atts updated attributes array
 */
function zilla_add_menu_filter_attributes( $atts, $item ) {

	if( $item->object == 'portfolio-type' ) {
		$url = untrailingslashit( $item->url );
		$temp = explode('/', $url);
		$slug = end($temp);
		$portfolio_type = 'portfolio-type-' . $slug;
		$atts['data-portfolio-filter'] = $portfolio_type;
	}

	return $atts;
}
endif;
add_filter( 'nav_menu_link_attributes', 'zilla_add_menu_filter_attributes', 10, 2);


if( !function_exists( 'zilla_add_menu_classes' ) ) :
/**
 * Add custom classes to menus
 * 
 * @since Mesh 1.0
 *
 * @param array $class current classes
 * @param obj $item object of nav item
 * @return array $class updated classes
 */
function zilla_add_menu_classes( $class, $item ) {

	if( $item->object == 'portfolio-type' ) {
		$class[] = 'portfolio-filter';
	}

	return $class;
}
endif;
add_filter( 'nav_menu_css_class', 'zilla_add_menu_classes', 10, 2 );


if( !function_exists( 'zilla_image_filter_quality' ) ) :
/**
 * Filters the image quality for thumbnails to be at the highest ratio possible.
 *
 * Supports the new 'wp_editor_set_quality' filter added in WP 3.5.
 *
 * @since Mesh 1.0
 *
 * @param int $quality The default quality (90)
 * @return int $quality Amended quality (100)
 */
function zilla_image_filter_quality( $quality ) { 
    return 100;
}
endif;
add_filter( 'jpeg_quality', 'zilla_image_filter_quality' );
add_filter( 'wp_editor_set_quality', 'zilla_image_filter_quality' );

/*-----------------------------------------------------------------------------------*/
/*	Include the framework
/*-----------------------------------------------------------------------------------*/

$tempdir = get_template_directory();
require_once($tempdir .'/framework/init.php');
require_once($tempdir .'/includes/init.php');


// Page Slug Body Class
function add_slug_body_class( $classes ) {
global $post;
if ( isset( $post ) ) {
/* $classes[] = $post->post_type . '-' . $post->post_name; *//*Un comment this if you want the post_type-post_name body class */
$classes[] = $post->post_name;
}

if (is_page()) {
        global $post;
        
        // If we *do* have an ancestors list, process it
        // http://codex.wordpress.org/Function_Reference/get_post_ancestors
        if ($parents = get_post_ancestors($post->ID)) {
            foreach ((array)$parents as $parent) {
                // As the array contains IDs only, we need to get each page
                if ($page = get_page($parent)) {
                    // Add the current ancestor to the body class array
                    $classes[] = "{$page->post_type}-{$page->post_name}";
                }
            }
        }
 
        // Add the current page to our body class array
        $classes[] = "{$post->post_type}-{$post->post_name}";
    }

return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );


function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');


// add_action( 'gform_post_add_subscription_payment', function ( $entry ) {
//     if ( rgar( $entry, 'payment_status' ) == 'Active' ) {
//         $feed       = gf_stripe()->get_payment_feed( $entry );
//         $feed_name  = rgars( $feed, 'meta/feedName' );
//         $feed_names = array( 'Subscription' ); // update this line

//         if ( in_array( $feed_name, $feed_names ) ) {
//             global $wpdb;
//             $count = $wpdb->get_var( $wpdb->prepare( "SELECT count(id) FROM {$wpdb->prefix}gf_addon_payment_transaction WHERE lead_id=%d", $entry['id'] ) );

//             if ( $count == 6 ) { // update this line
//                 $result = gf_stripe()->cancel( $entry, $feed );
//                 gf_stripe()->log_debug( "gform_post_add_subscription_payment: Cancelling subscription (feed #{$feed['id']} - {$feed_name}) for entry #{$entry['id']}. Result: " . print_r( $result, 1 ) );
//             }
//         }
//     }
// } );

?>