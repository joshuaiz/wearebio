<?php 
/**
 * Template for displaying our blog page
 *
 * @package Mesh
 * @since Mesh 1.0
 */
get_header(); ?>

<!--BEGIN #primary -->
<div id="primary" role="main">			
<?php if (have_posts()) : ?>

	<!--BEGIN .hfeed -->
	<div class="hfeed">
	
	<?php while (have_posts()) : the_post(); ?>
	
		<?php zilla_post_before(); ?>
		<!--BEGIN .hentry -->
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
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
		<!--END .hentry-->  
		</article>
		<?php zilla_post_after(); ?>

	<?php endwhile; ?>
	
	<!--END .hfeed -->
	</div>

	<?php zilla_paging_nav(); ?>

<?php else : ?>

	<!--BEGIN #post-0-->
	<article id="post-0" <?php post_class(); ?>>
	
		<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'zilla') ?></h2>
	
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