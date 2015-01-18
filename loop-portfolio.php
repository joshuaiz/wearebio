<?php
/**
 * For displaying portfolios on archive pages 
 *
 * @package Mesh
 * @since Mesh 1.0
 */
?>

<div id="primary" role="main">

<?php if( have_posts() ) : ?>
	
	<div id="portfolio-feed" class="portfolio-feed">

	<?php while( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<a href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>">
				<div class="post-media">
					<?php the_post_thumbnail('portfolio-thumb'); ?>
				</div>
				<h2 class="entry-title"><?php the_title(); ?></h2>
			</a>
		</article>

	<?php endwhile; ?>

	<!--END .portfolio-feed -->
	</div>

<?php endif; ?>

<!--END #primary -->
</div>