<?php 
/**
 * Template for displaying search results
 *
 * @package Mesh
 * @since Mesh 1.0
 */

get_header(); ?>

<!--BEGIN #primary -->
<div id="primary" role="main">
<?php if (have_posts()) : ?>

	<h1 class="page-title"><?php _e('Search Results for', 'zilla') ?> &#8220;<?php the_search_query(); ?>&#8221;</h1>

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

<?php else : ?>

	<h1 class="page-title"><?php _e('Your search did not match any entries', 'zilla') ?></h1 >

	<!--BEGIN #post-0-->
	<article id="post-0">

		<!--BEGIN .entry-content-->
		<div class="entry-content">
			<?php get_search_form(); ?>
			<p><?php _e('Suggestions:','zilla') ?></p>
			<ul>
				<li><?php _e('Make sure all words are spelled correctly.', 'zilla') ?></li>
				<li><?php _e('Try different keywords.', 'zilla') ?></li>
				<li><?php _e('Try more general keywords.', 'zilla') ?></li>
			</ul>
		<!--END .entry-content-->
		</div>

	<!--END #post-0-->
	</article>

<?php endif; ?>
<!--END #primary -->
</div>

<?php get_footer(); ?>