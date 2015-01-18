<?php
/**
 * Template to display default page 
 *
 * @package  Mesh
 * @since  Mesh 1.0
 */
get_header(); ?>

<!--BEGIN #primary -->
<div id="primary" role="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php zilla_page_before(); ?>
	<!--BEGIN .hentry-->
	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<?php zilla_page_start(); ?>
	
		<h1 class="entry-title"><?php the_title(); ?></h1>
	              
		<?php if ( current_user_can( 'edit_post', $post->ID ) ): ?>
			<!--BEGIN .entry-meta .entry-header-->
			<div class="entry-meta entry-header">
				<?php edit_post_link( __('edit', 'zilla'), '<span class="edit-post">', '</span>' ); ?>
			<!--END .entry-meta .entry-header-->
			</div>
		<?php endif; ?>

		<!--BEGIN .entry-content -->
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'zilla').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		<!--END .entry-content -->
		</div>
	          
	<?php zilla_page_end(); ?>
	<!--END .hentry-->
	</article>
	<?php zilla_page_after(); ?>
	
	<?php 
	zilla_comments_before();
	comments_template('', true); 
	zilla_comments_after();
	?>

<?php endwhile; endif; ?>

<!--END #primary -->
</div>

<?php get_footer(); ?>