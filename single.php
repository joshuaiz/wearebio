<?php 
/**
 * Template for displaying single post view
 *
 * @package Mesh
 * @since Mesh 1.0
 */

get_header(); ?>

<!--BEGIN #primary -->
<div id="primary" role="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php zilla_post_before(); ?>
	<!--BEGIN .hentry -->
	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<?php zilla_post_start(); ?>

		<?php 
		$format = get_post_format(); 
		get_template_part( 'content', $format ); 
		?>

		<!--BEGIN .entry-content -->
		<div class="entry-content">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		
			<?php the_content(__('Read more...', 'zilla')); ?>
			<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'zilla').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		<!--END .entry-content -->
		</div>

		<?php zilla_post_meta_single(); ?>
              
	<?php zilla_post_end(); ?>
	<!--END .hentry-->  
	</article>
	<?php zilla_post_after(); ?>

	<?php 
	    zilla_comments_before();
	    comments_template('', true); 
	    zilla_comments_after();
	?>

	<?php endwhile; else: ?>

	<!--BEGIN #post-0-->
	<article id="post-0" <?php post_class() ?>>
	
		<h1 class="entry-title"><?php _e('Error 404 - Not Found', 'zilla') ?></h1>
	
		<!--BEGIN .entry-content-->
		<div class="entry-content">
			<p><?php _e("Sorry, but you are looking for something that isn't here.", "zilla") ?></p>
		<!--END .entry-content-->
		</div>
	
	<!--END #post-0-->
	</article>

<?php endif; ?>
<!--END #primary -->
</div>

<?php get_footer(); ?>