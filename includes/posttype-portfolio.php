<?php

/*-----------------------------------------------------------------------------------
/*	Add Portfolio Post Type
/*---------------------------------------------------------------------------------*/

function zilla_post_type_portfolio() 
{
	$args = array(
		'labels' => zilla_post_type_labels( __('Portfolio', 'zilla') ),
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'menu_icon'  => 'dashicons-portfolio',
		// Uncomment the folowing line to change the slug
		//'rewrite' => array( 'slug' => 'portfolio-slug' ), 
		'supports' => array('title','editor','thumbnail','custom-fields', 'page-attributes')
	);
	
	register_post_type( 'portfolio', $args );
}
add_action( 'init', 'zilla_post_type_portfolio', 1 );


/* Add Custom Taxonomy ----------------------------------------------------------*/
function zilla_taxonomy_portfolio_type(){
	// Edit this to change the "portfolio type"
	$type_name = __('Portfolio Type', 'zilla');
	
	register_taxonomy(
		'portfolio-type', 
		array('portfolio'), 
		array(
			'hierarchical' => true, 
			'labels' => zilla_taxonomy_labels( $type_name ), 
			'rewrite' => array( 'slug' => 'portfolio-type', 'hierarchical' => true )
		)
	); 
}
add_action( 'init', 'zilla_taxonomy_portfolio_type', 1 );


/*-------------------------------------------------------------------------------*/
/* Add Custom Icon for Portfolios 
/*-------------------------------------------------------------------------------*/


/*--------------------------------------------------------------------------------*/
/*  Add Custom Columns for Portfolios 
/*--------------------------------------------------------------------------------*/
function zilla_edit_columns_portfolio($portfolio_columns){  
	$portfolio_columns = array(  
		'cb' => '<input type="checkbox" />',  
		'title' => _x( 'Title', 'column name', 'zilla' ),
		'thumbnail' => __( 'Thumbnail', 'zilla'),
		'type' => __( 'Portfolio Type', 'zilla' )
	);  
	
	return $portfolio_columns;  
}  
add_filter('manage_edit-portfolio_columns', 'zilla_edit_columns_portfolio');  
  
function zilla_custom_columns_portfolio($portfolio_columns, $post_id){  

	switch ($portfolio_columns) {
	    case 'thumbnail':
	        $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
	        
	        if( $thumbnail_id ) {
	            $thumb = wp_get_attachment_image( $thumbnail_id, 'portfolio-admin-thumb', true );
	        }
	        
	        if( isset($thumb) ) {
	            echo $thumb;
	        } else {
	            echo __('None', 'zilla');
	        }
	        
	        break;
	        
		case 'type':  
			echo get_the_term_list( $post_id, 'portfolio-type', '', ', ', '' );
			break;
	}  
}  
add_action('manage_posts_custom_column',  'zilla_custom_columns_portfolio', 10, 2);  


/*-------------------------------------------------------------------------------*/
/*  Enable Sorting of the Portfolio 
/*-------------------------------------------------------------------------------*/

function zilla_create_portfolio_sort_page() {
    $zilla_sort_page = add_submenu_page('edit.php?post_type=portfolio', 'Sort Portfolios', __('Sort Portfolios', 'zilla'), 'edit_posts', basename(__FILE__), 'zilla_portfolio_sort');
    
    add_action('admin_print_styles-' . $zilla_sort_page, 'zilla_print_sort_styles');
    add_action('admin_print_scripts-' . $zilla_sort_page, 'zilla_print_sort_scripts');
}
add_action('admin_menu', 'zilla_create_portfolio_sort_page');


function zilla_portfolio_sort() {
    $portfolios = new WP_Query('post_type=portfolio&posts_per_page=-1&orderby=menu_order&order=ASC');    
	?>
    <div class="wrap">
        <div id="icon-edit" class="icon32 icon32-posts-portfolio"><br /></div>
        <h2><?php _e('Sort Portfolios', 'zilla'); ?></h2>
        <p><?php _e('Click, drag, re-order. Repeat as neccessary. Portfolio at the top will appear first.', 'zilla'); ?></p>

        <ul id="portfolio_list">
            <?php while( $portfolios->have_posts() ) : $portfolios->the_post(); ?>        
                <?php if( get_post_status() == 'publish' ) { ?>
                    <li id="<?php the_id(); ?>" class="menu-item">
                        <dl class="menu-item-bar">
                            <dt class="menu-item-handle">
                                <span class="item-title"><?php the_title(); ?></span>
                            </dt>
                        </dl>
                        <ul class="menu-item-transport"></ul>
                    </li>
                <?php } ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </ul>
    </div>
	<?php 
}


function zilla_save_portfolio_sorted_order() {
    global $wpdb;
    
    $order = explode(',', $_POST['order']);
    $counter = 0;
    
    foreach($order as $portfolio_id) {
        $wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $portfolio_id));
        $counter++;
    }
    die(1);
}
add_action('wp_ajax_portfolio_sort', 'zilla_save_portfolio_sorted_order');


function zilla_print_sort_scripts() {
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('zilla_portfolio_sort', get_template_directory_uri() . '/includes/js/zilla_portfolio_sort.js');
}

function zilla_print_sort_styles() {
    wp_enqueue_style('nav-menu');
}

?>