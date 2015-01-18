<?php 
/**
 * Template to display our archives
 * 
 * @package Mesh
 * @since Mesh 1.0
 */

get_header(); ?>
<?php /* Get author data */
	if(get_query_var('author_name')) {
		$curauth = get_user_by( 'login', get_query_var('author_name') );
	} else {
		$curauth = get_userdata(get_query_var('author'));
	}
?>
			
<!--BEGIN #primary -->
<div id="primary" role="main">
<?php if (have_posts()) : ?>			

		<h1 class="page-title">
		<?php 
			// Hack. Set $post so that the_date() works.
			$post = $posts[0]; 
			
			if( is_category() ) {
				/* If this is a category archive */ 
				printf( __('All posts in: %s', 'zilla'), single_cat_title('',false) ); 
			} elseif( is_tag() ) { 
				/* If this is a tag archive */
				printf( __('All posts tagged: %s', 'zilla'), single_tag_title('',false) ); 
			} elseif( is_day() ) { 
				/* If this is a daily archive */
				printf( __('Archive for: %s', 'zilla'), get_the_time( get_option('date_format') ) );
			} elseif( is_month() ) { 
				/* If this is a monthly archive */
				printf( __('Archive for: %s', 'zilla'), get_the_time('F, Y') );
			} elseif( is_year() ) { 
				/* If this is a yearly archive */
				printf( __('Archive for: %s', 'zilla'), get_the_time('Y') ); 
			} elseif( is_author() ) { 
				/* If this is an author archive */ 
				printf( __('All posts by: %s', 'zilla'), $curauth->display_name );
			} elseif( isset($_GET['paged']) && !empty($_GET['paged']) ) {
				/* If this is a paged archive */
				_e('Blog Archives', 'zilla');
			}
			?>
		</h1>

		<!--BEGIN .hfeed -->
		<div class="hfeed">

	<?php while (have_posts()) : the_post(); ?>
		
		<?php zilla_post_before(); ?>
		<!--BEGIN .hentry -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php zilla_post_start(); ?>
				
			<?php
			$format = get_post_format(); 
			get_template_part( 'content', $format ); 
			?>

			<!--BEGIN .entry-content -->
			<div class="entry-content">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zilla' ), the_title_attribute( 'echo=0' ) ) ); ?>"> <?php the_title(); ?></a></h2>
				<?php the_excerpt(); ?>
			<!--END .entry-content -->
			</div>
			
			<?php zilla_post_meta_index(); ?>
								
		<?php zilla_post_end(); ?>
		<!--END .hentry -->
		</article>
		<?php zilla_post_after(); ?>

	<?php endwhile; ?>

	<!--END .hfeed -->
	</div>

	<?php zilla_paging_nav(); ?>

	<?php else :
		echo '<h2>';
		if ( is_category() ) { // If this is a category archive
			printf(__('Sorry, but there aren\'t any posts in the %s category yet.', 'zilla'), single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo(__('Sorry, but there aren\'t any posts with this date.', 'zilla'));
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf(__('Sorry, but there aren\'t any posts by %s yet.', 'zilla'), $userdata->display_name);
		} else {
			echo(__('No posts found.', 'zilla'));
		}
		echo '</h2>';

	endif; ?>

<!--END #primary .hfeed-->
</div>

<?php get_footer(); ?>